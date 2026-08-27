<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMutasiKas extends Migration
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
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['Kas Masuk', 'Kas Keluar', 'Piutang', 'Bayar Tempo', 'Dibayar Duluan'],
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'pihak' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'nominal' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Belum Lunas', 'Lunas'],
                'default'    => 'Lunas',
            ],
            'tanggal_jatuh_tempo' => [
                'type' => 'DATE',
                'null' => true,
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
        $this->forge->createTable('mutasi_kas');
    }

    public function down()
    {
        $this->forge->dropTable('mutasi_kas');
    }
}
