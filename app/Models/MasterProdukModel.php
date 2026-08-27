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
    ];
    protected $validationRules = [
        'kode_produk'        => 'required|max_length[30]',
        'nama_produk'        => 'required|max_length[150]',
        'satuan'             => 'required|max_length[20]',
        'harga_modal'        => 'required|numeric|greater_than_equal_to[0]',
        'harga_jual_shopee'  => 'required|numeric|greater_than_equal_to[0]',
        'harga_jual_offline' => 'required|numeric|greater_than_equal_to[0]',
        'stok_awal'          => 'required|integer|greater_than_equal_to[0]',
    ];
}
