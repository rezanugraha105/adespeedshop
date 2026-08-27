<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterProdukSeeder extends Seeder
{
    public function run()
    {
        $produk = [
            [
                'kode_produk'        => 'BLT001',
                'nama_produk'        => 'Baut Titanium M5x20 Hex Head',
                'satuan'             => 'Pcs',
                'harga_modal'        => 15000,
                'harga_jual_shopee'  => 35000,
                'harga_jual_offline' => 30000,
                'stok_awal'          => 100,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'kode_produk'        => 'BLT002',
                'nama_produk'        => 'Baut Titanium M6x25 Button Head',
                'satuan'             => 'Pcs',
                'harga_modal'        => 20000,
                'harga_jual_shopee'  => 45000,
                'harga_jual_offline' => 40000,
                'stok_awal'          => 80,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'kode_produk'        => 'BLT003',
                'nama_produk'        => 'Baut Titanium M8x30 Flange Head',
                'satuan'             => 'Pcs',
                'harga_modal'        => 28000,
                'harga_jual_shopee'  => 60000,
                'harga_jual_offline' => 55000,
                'stok_awal'          => 50,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'kode_produk'        => 'BLT004',
                'nama_produk'        => 'Baut Titanium M6x16 Sock Cap',
                'satuan'             => 'Pcs',
                'harga_modal'        => 18000,
                'harga_jual_shopee'  => 40000,
                'harga_jual_offline' => 35000,
                'stok_awal'          => 120,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($produk as $row) {
            $existing = $this->db->table('master_produk')->where('kode_produk', $row['kode_produk'])->get()->getRow();
            if (! $existing) {
                $this->db->table('master_produk')->insert($row);
            }
        }
    }
}
