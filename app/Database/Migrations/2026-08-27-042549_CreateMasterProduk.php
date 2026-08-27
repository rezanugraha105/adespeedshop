<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterProduk extends Migration
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
            'kode_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'Pcs',
            ],
            'harga_modal' => [
                'type'     => 'DECIMAL',
                'constraint' => '15,2',
                'default'  => 0,
            ],
            'harga_jual_shopee' => [
                'type'     => 'DECIMAL',
                'constraint' => '15,2',
                'default'  => 0,
            ],
            'harga_jual_offline' => [
                'type'     => 'DECIMAL',
                'constraint' => '15,2',
                'default'  => 0,
            ],
            'stok_awal' => [
                'type'     => 'INT',
                'constraint' => 11,
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
        $this->forge->addUniqueKey('kode_produk');
        $this->forge->createTable('master_produk');
    }

    public function down()
    {
        $this->forge->dropTable('master_produk');
    }
}
