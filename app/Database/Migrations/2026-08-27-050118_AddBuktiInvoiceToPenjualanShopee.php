<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBuktiInvoiceToPenjualanShopee extends Migration
{
    public function up()
    {
        $this->forge->addColumn('penjualan_shopee', [
            'bukti_invoice' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'ongkir_ditanggung_penjual',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('penjualan_shopee', 'bukti_invoice');
    }
}
