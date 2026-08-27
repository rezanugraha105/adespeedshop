<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table         = 'invoices';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $returnType    = 'array';
    protected $allowedFields = [
        'no_invoice',
        'tanggal',
        'nama_pembeli',
        'alamat_pembeli',
        'telepon_pembeli',
        'sumber',
        'sumber_id',
        'catatan',
    ];
    protected $validationRules = [
        'tanggal'      => 'required|valid_date',
        'nama_pembeli' => 'required|max_length[100]',
    ];

    public function generateNoInvoice(): string
    {
        $prefix = 'INV-' . date('Ymd') . '-';
        $count  = $this->like('no_invoice', $prefix, 'after')->countAllResults();

        return $prefix . str_pad((string) ($count + 1), 3, '0', STR_PAD_LEFT);
    }
}
