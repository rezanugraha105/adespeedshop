<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCatalogFieldsToMasterProduk extends Migration
{
    public function up()
    {
        $fields = [
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'deskripsi' => [
                'type'    => 'TEXT',
                'null'    => true,
                'default' => null,
            ],
            'diskon_percent' => [
                'type'       => 'DECIMAL',
                'constraint' => '4,1',
                'default'    => 0,
            ],
            'is_unggulan' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'is_tampil' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ];

        $this->forge->addColumn('master_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('master_produk', 'foto');
        $this->forge->dropColumn('master_produk', 'deskripsi');
        $this->forge->dropColumn('master_produk', 'diskon_percent');
        $this->forge->dropColumn('master_produk', 'is_unggulan');
        $this->forge->dropColumn('master_produk', 'is_tampil');
    }
}