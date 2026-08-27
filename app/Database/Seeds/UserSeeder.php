<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'   => 'admin',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'name'       => 'Administrator',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $existing = $this->db->table('users')->where('username', 'admin')->get()->getRow();

        if (! $existing) {
            $this->db->table('users')->insert($data);
        }
    }
}
