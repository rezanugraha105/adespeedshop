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
            'company_address'    => 'Depok, Jawa Barat, Indonesia',
            'company_phone'      => '0812-3456-7890',
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
