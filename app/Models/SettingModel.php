<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table         = 'settings';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['setting_key', 'setting_value'];
    protected $returnType    = 'array';

    public function get(string $key, $default = null)
    {
        $row = $this->where('setting_key', $key)->first();

        return $row['setting_value'] ?? $default;
    }

    public function setValue(string $key, string $value): void
    {
        $row = $this->where('setting_key', $key)->first();

        if ($row) {
            $this->update($row['id'], ['setting_value' => $value]);
        } else {
            $this->insert(['setting_key' => $key, 'setting_value' => $value]);
        }
    }
}
