<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceItems extends Migration
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
            'invoice_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'harga_satuan' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
            'subtotal' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('invoice_id', 'invoices', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('invoice_items');
    }

    public function down()
    {
        $this->forge->dropTable('invoice_items');
    }
}
