<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBuktiPembayaranToPenjualanOffline extends Migration
{
    public function up()
    {
        $this->forge->addColumn('penjualan_offline', [
            'bukti_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'metode_bayar',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('penjualan_offline', 'bukti_pembayaran');
    }
}
