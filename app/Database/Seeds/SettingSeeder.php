<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $defaults = [
            'biaya_admin_shopee' => '6.5',
            'company_name'       => 'ADM Motor Parts & Accessories',
            'company_address'    => 'Jl. Kavling baru No.09, Grogol, Kec. Limo, Kota Depok, Jawa Barat 16514',
            'company_phone'      => '0812-8049-2796',
        ];

        foreach ($defaults as $key => $value) {
            $existing = $this->db->table('settings')->where('setting_key', $key)->get()->getRow();
            if (! $existing) {
                $this->db->table('settings')->insert([
                    'setting_key'   => $key,
                    'setting_value' => $value,
                ]);
            }
        }
    }
}
