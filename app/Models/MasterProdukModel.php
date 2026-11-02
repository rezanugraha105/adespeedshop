<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterProdukModel extends Model
{
    protected $table         = 'master_produk';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $returnType    = 'array';
    protected $allowedFields = [
        'kode_produk',
        'nama_produk',
        'satuan',
        'harga_modal',
        'harga_jual_shopee',
        'harga_jual_offline',
        'stok_awal',
        'foto',
        'deskripsi',
        'diskon_percent',
        'is_unggulan',
        'is_tampil',
    ];
    protected $validationRules = [
        'kode_produk'        => 'required|max_length[30]',
        'nama_produk'        => 'required|max_length[150]',
        'satuan'             => 'required|max_length[20]',
        'harga_modal'        => 'required|numeric|greater_than_equal_to[0]',
        'harga_jual_shopee'  => 'required|numeric|greater_than_equal_to[0]',
        'harga_jual_offline' => 'required|numeric|greater_than_equal_to[0]',
        'stok_awal'          => 'required|integer|greater_than_equal_to[0]',
        'foto'               => 'permit_empty|max_length[255]',
        'deskripsi'          => 'permit_empty|max_length[5000]',
        'diskon_percent'     => 'permit_empty|decimal|greater_than_equal_to[0]|less_than[100]',
        'is_unggulan'        => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[1]',
        'is_tampil'          => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[1]',
    ];

    /**
     * Ambil daftar produk untuk katalog toko (homepage).
     * Produk yang is_tampil = 0 disembunyikan. Stok terjual dihitung
     * dari penjualan Shopee & offline sehingga "sisa stok" akurat.
     */
    public function getCatalog(): array
    {
        $produk = $this->where('is_tampil', 1)->orderBy('id', 'ASC')->findAll();

        $qtyShopee  = (new PenjualanShopeeModel())->sumQtyPerProduk();
        $qtyOffline = (new PenjualanOfflineModel())->sumQtyPerProduk();

        foreach ($produk as &$p) {
            $terjual    = (int) ($qtyShopee[$p['id']] ?? 0) + (int) ($qtyOffline[$p['id']] ?? 0);
            $p['sisa_stok']   = max(0, (int) $p['stok_awal'] - $terjual);
            $p['qty_terjual'] = $terjual;
        }
        unset($p);

        return $produk;
    }
}
