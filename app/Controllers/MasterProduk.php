<?php

namespace App\Controllers;

use App\Models\MasterProdukModel;
use App\Models\PenjualanOfflineModel;
use App\Models\PenjualanShopeeModel;

class MasterProduk extends BaseController
{
    protected MasterProdukModel $model;

    public function __construct()
    {
        $this->model = new MasterProdukModel();
    }

    public function index()
    {
        $q = trim((string) $this->request->getGet('q'));

        $builder = $this->model->orderBy('kode_produk', 'ASC');
        if ($q !== '') {
            $builder = $builder->groupStart()
                ->like('kode_produk', $q)
                ->orLike('nama_produk', $q)
                ->groupEnd();
        }
        $produk = $builder->paginate(15);

        $qtyShopee  = (new PenjualanShopeeModel())->sumQtyPerProduk();
        $qtyOffline = (new PenjualanOfflineModel())->sumQtyPerProduk();

        foreach ($produk as &$p) {
            $terjual = (int) ($qtyShopee[$p['id']] ?? 0) + (int) ($qtyOffline[$p['id']] ?? 0);
            $p['qty_terjual'] = $terjual;
            $p['sisa_stok']   = (int) $p['stok_awal'] - $terjual;
        }
        unset($p);

        return view('master_produk/index', [
            'title'  => 'Master Produk',
            'active' => 'master-produk',
            'produk' => $produk,
            'pager'  => $this->model->pager,
            'q'      => $q,
        ]);
    }

    public function new()
    {
        return view('master_produk/form', [
            'title'  => 'Tambah Produk',
            'active' => 'master-produk',
            'produk' => null,
        ]);
    }

    public function create()
    {
        if (! $this->validateProduk()) {
            return redirect()->to('/master-produk/new')->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert($this->collectPost());

        return redirect()->to('/master-produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = $this->model->find($id);
        if (! $produk) {
            return redirect()->to('/master-produk')->with('error', 'Produk tidak ditemukan.');
        }

        return view('master_produk/form', [
            'title'  => 'Edit Produk',
            'active' => 'master-produk',
            'produk' => $produk,
        ]);
    }

    public function update($id)
    {
        $produk = $this->model->find($id);
        if (! $produk) {
            return redirect()->to('/master-produk')->with('error', 'Produk tidak ditemukan.');
        }

        if (! $this->validateProduk($id)) {
            return redirect()->to("/master-produk/{$id}/edit")->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $this->collectPost());

        return redirect()->to('/master-produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $produk = $this->model->find($id);
        if (! $produk) {
            return redirect()->to('/master-produk')->with('error', 'Produk tidak ditemukan.');
        }

        $this->model->delete($id);

        return redirect()->to('/master-produk')->with('success', 'Produk berhasil dihapus.');
    }

    private function collectPost(): array
    {
        return [
            'kode_produk'        => $this->request->getPost('kode_produk'),
            'nama_produk'        => $this->request->getPost('nama_produk'),
            'satuan'             => $this->request->getPost('satuan'),
            'harga_modal'        => $this->request->getPost('harga_modal'),
            'harga_jual_shopee'  => $this->request->getPost('harga_jual_shopee'),
            'harga_jual_offline' => $this->request->getPost('harga_jual_offline'),
            'stok_awal'          => $this->request->getPost('stok_awal'),
        ];
    }

    private function validateProduk($id = null): bool
    {
        $rules = $this->model->getValidationRules();
        $rules['kode_produk'] .= $id
            ? '|is_unique[master_produk.kode_produk,id,' . $id . ']'
            : '|is_unique[master_produk.kode_produk]';

        return $this->validate($rules);
    }
}
