<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanShopee extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'no_pesanan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'produk_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'qty' => [
                'type'     => 'INT',
                'constraint' => 11,
                'default'  => 0,
            ],
            'harga_jual_satuan' => [
                'type'     => 'DECIMAL',
                'constraint' => '15,2',
                'default'  => 0,
            ],
            'diskon_voucher' => [
                'type'     => 'DECIMAL',
                'constraint' => '15,2',
                'default'  => 0,
            ],
            'ongkir_ditanggung_penjual' => [
                'type'     => 'DECIMAL',
                'constraint' => '15,2',
                'default'  => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('produk_id', 'master_produk', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('penjualan_shopee');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan_shopee');
    }
}
