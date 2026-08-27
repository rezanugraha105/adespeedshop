<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePreorders extends Migration
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
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'tanggal_po' => [
                'type' => 'DATE',
            ],
            'estimasi_tiba' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Diproses', 'Diterima', 'Dibatalkan'],
                'default'    => 'Diproses',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('preorders');
    }

    public function down()
    {
        $this->forge->dropTable('preorders');
    }
}
