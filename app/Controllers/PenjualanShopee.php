<?php

namespace App\Controllers;

use App\Libraries\PenjualanCalculator;
use App\Models\MasterProdukModel;
use App\Models\PenjualanShopeeModel;
use App\Models\SettingModel;

class PenjualanShopee extends BaseController
{
    protected PenjualanShopeeModel $model;
    protected SettingModel $settingModel;

    public function __construct()
    {
        $this->model        = new PenjualanShopeeModel();
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $persenAdmin = (float) $this->settingModel->get('biaya_admin_shopee', 0);

        $filters = [
            'q'    => trim((string) $this->request->getGet('q')),
            'from' => $this->request->getGet('from'),
            'to'   => $this->request->getGet('to'),
        ];

        $rows = $this->model->getListPaginated($filters);

        foreach ($rows as &$row) {
            $row['calc'] = PenjualanCalculator::shopee($row, $persenAdmin);
        }
        unset($row);

        return view('penjualan_shopee/index', [
            'title'       => 'Penjualan Shopee',
            'active'      => 'penjualan-shopee',
            'rows'        => $rows,
            'persenAdmin' => $persenAdmin,
            'pager'       => $this->model->pager,
            'filters'     => $filters,
        ]);
    }

    public function updateSetting()
    {
        $persen = $this->request->getPost('biaya_admin_shopee');

        if (! is_numeric($persen)) {
            return redirect()->to('/penjualan-shopee')->with('error', 'Persentase biaya admin tidak valid.');
        }

        $this->settingModel->setValue('biaya_admin_shopee', (string) $persen);

        return redirect()->to('/penjualan-shopee')->with('success', 'Persentase biaya admin Shopee berhasil diperbarui.');
    }

    public function new()
    {
        return view('penjualan_shopee/form', [
            'title'   => 'Tambah Penjualan Shopee',
            'active'  => 'penjualan-shopee',
            'row'     => null,
            'produkList' => (new MasterProdukModel())->orderBy('kode_produk', 'ASC')->findAll(),
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->buildRules())) {
            return redirect()->to('/penjualan-shopee/new')->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert($this->collectPost());

        return redirect()->to('/penjualan-shopee')->with('success', 'Penjualan Shopee berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/penjualan-shopee')->with('error', 'Data tidak ditemukan.');
        }

        return view('penjualan_shopee/form', [
            'title'      => 'Edit Penjualan Shopee',
            'active'     => 'penjualan-shopee',
            'row'        => $row,
            'produkList' => (new MasterProdukModel())->orderBy('kode_produk', 'ASC')->findAll(),
        ]);
    }

    public function update($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/penjualan-shopee')->with('error', 'Data tidak ditemukan.');
        }

        if (! $this->validate($this->buildRules())) {
            return redirect()->to("/penjualan-shopee/{$id}/edit")->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $this->collectPost());

        return redirect()->to('/penjualan-shopee')->with('success', 'Penjualan Shopee berhasil diperbarui.');
    }

    public function delete($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/penjualan-shopee')->with('error', 'Data tidak ditemukan.');
        }

        $this->model->delete($id);

        return redirect()->to('/penjualan-shopee')->with('success', 'Penjualan Shopee berhasil dihapus.');
    }

    private function collectPost(): array
    {
        return [
            'tanggal'                   => $this->request->getPost('tanggal'),
            'no_pesanan'                => $this->request->getPost('no_pesanan'),
            'produk_id'                 => $this->request->getPost('produk_id'),
            'qty'                       => $this->request->getPost('qty'),
            'harga_jual_satuan'         => $this->request->getPost('harga_jual_satuan'),
            'diskon_voucher'            => $this->request->getPost('diskon_voucher') ?: 0,
            'ongkir_ditanggung_penjual' => $this->request->getPost('ongkir_ditanggung_penjual') ?: 0,
            'bukti_invoice'             => $this->request->getPost('bukti_invoice'),
        ];
    }

    private function buildRules(): array
    {
        $rules = $this->model->getValidationRules();
        $rules['bukti_invoice'] = 'permit_empty|max_length[5000]';

        return $rules;
    }
}
