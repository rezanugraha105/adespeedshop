<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeBuktiInvoiceToTextInPenjualanShopee extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('penjualan_shopee', [
            'bukti_invoice' => [
                'name' => 'bukti_invoice',
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('penjualan_shopee', [
            'bukti_invoice' => [
                'name'       => 'bukti_invoice',
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
    }
}
