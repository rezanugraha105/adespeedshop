<?php

namespace App\Controllers;

use App\Libraries\PenjualanCalculator;
use App\Libraries\UploadHelper;
use App\Models\MasterProdukModel;
use App\Models\PenjualanOfflineModel;

class PenjualanOffline extends BaseController
{
    protected PenjualanOfflineModel $model;

    public function __construct()
    {
        $this->model = new PenjualanOfflineModel();
    }

    public function index()
    {
        $filters = [
            'q'    => trim((string) $this->request->getGet('q')),
            'from' => $this->request->getGet('from'),
            'to'   => $this->request->getGet('to'),
        ];

        $rows = $this->model->getListPaginated($filters);

        foreach ($rows as &$row) {
            $row['calc'] = PenjualanCalculator::offline($row);
        }
        unset($row);

        return view('penjualan_offline/index', [
            'title'   => 'Penjualan Offline',
            'active'  => 'penjualan-offline',
            'rows'    => $rows,
            'pager'   => $this->model->pager,
            'filters' => $filters,
        ]);
    }

    public function new()
    {
        return view('penjualan_offline/form', [
            'title'      => 'Tambah Penjualan Offline',
            'active'     => 'penjualan-offline',
            'row'        => null,
            'produkList' => (new MasterProdukModel())->orderBy('kode_produk', 'ASC')->findAll(),
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->buildRules())) {
            return redirect()->to('/penjualan-offline/new')->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('bukti_pembayaran');
        if ($file !== null && $file->isValid() && ! UploadHelper::isGenuineImage($file)) {
            return redirect()->to('/penjualan-offline/new')->withInput()->with('error', 'File bukti pembayaran bukan gambar yang valid (JPG/PNG/WEBP).');
        }

        $data = $this->collectPost();
        $data['bukti_pembayaran'] = UploadHelper::store($file, 'offline');

        $this->model->insert($data);

        return redirect()->to('/penjualan-offline')->with('success', 'Penjualan Offline berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/penjualan-offline')->with('error', 'Data tidak ditemukan.');
        }

        return view('penjualan_offline/form', [
            'title'      => 'Edit Penjualan Offline',
            'active'     => 'penjualan-offline',
            'row'        => $row,
            'produkList' => (new MasterProdukModel())->orderBy('kode_produk', 'ASC')->findAll(),
        ]);
    }

    public function update($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/penjualan-offline')->with('error', 'Data tidak ditemukan.');
        }

        if (! $this->validate($this->buildRules($row))) {
            return redirect()->to("/penjualan-offline/{$id}/edit")->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('bukti_pembayaran');
        if ($file !== null && $file->isValid() && ! UploadHelper::isGenuineImage($file)) {
            return redirect()->to("/penjualan-offline/{$id}/edit")->withInput()->with('error', 'File bukti pembayaran bukan gambar yang valid (JPG/PNG/WEBP).');
        }

        $data = $this->collectPost();

        $newFile = UploadHelper::store($file, 'offline');
        if ($newFile) {
            UploadHelper::delete($row['bukti_pembayaran']);
            $data['bukti_pembayaran'] = $newFile;
        }

        $this->model->update($id, $data);

        return redirect()->to('/penjualan-offline')->with('success', 'Penjualan Offline berhasil diperbarui.');
    }

    public function delete($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/penjualan-offline')->with('error', 'Data tidak ditemukan.');
        }

        UploadHelper::delete($row['bukti_pembayaran']);
        $this->model->delete($id);

        return redirect()->to('/penjualan-offline')->with('success', 'Penjualan Offline berhasil dihapus.');
    }

    private function collectPost(): array
    {
        return [
            'tanggal'           => $this->request->getPost('tanggal'),
            'no_nota'           => $this->request->getPost('no_nota'),
            'nama_pembeli'      => $this->request->getPost('nama_pembeli'),
            'produk_id'         => $this->request->getPost('produk_id'),
            'qty'               => $this->request->getPost('qty'),
            'harga_jual_satuan' => $this->request->getPost('harga_jual_satuan'),
            'diskon'            => $this->request->getPost('diskon') ?: 0,
            'metode_bayar'      => $this->request->getPost('metode_bayar'),
        ];
    }

    private function buildRules(?array $existing = null): array
    {
        $rules = $this->model->getValidationRules();

        $isCash      = $this->request->getPost('metode_bayar') === 'Cash';
        $hasExisting = $existing['bukti_pembayaran'] ?? null;

        if ($isCash) {
            $rules['bukti_pembayaran'] = $hasExisting
                ? 'permit_empty|max_size[bukti_pembayaran,2048]|is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png,image/webp]'
                : 'uploaded[bukti_pembayaran]|max_size[bukti_pembayaran,2048]|is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png,image/webp]';
        } else {
            $rules['bukti_pembayaran'] = 'permit_empty|max_size[bukti_pembayaran,2048]|is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png,image/webp]';
        }

        return $rules;
    }
}
