<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoices extends Migration
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
            'no_invoice' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'nama_pembeli' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat_pembeli' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'telepon_pembeli' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
            'sumber' => [
                'type'       => 'ENUM',
                'constraint' => ['offline', 'shopee', 'manual'],
                'default'    => 'manual',
            ],
            'sumber_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
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
        $this->forge->addUniqueKey('no_invoice');
        $this->forge->createTable('invoices');
    }

    public function down()
    {
        $this->forge->dropTable('invoices');
    }
}
