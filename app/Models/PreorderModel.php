<?php

namespace App\Models;

use CodeIgniter\Model;

class PreorderModel extends Model
{
    protected $table         = 'preorders';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $returnType    = 'array';
    protected $allowedFields = [
        'gambar',
        'nama_barang',
        'qty',
        'tanggal_po',
        'estimasi_tiba',
        'status',
        'catatan',
    ];
    protected $validationRules = [
        'nama_barang' => 'required|max_length[150]',
        'qty'         => 'required|integer|greater_than[0]',
        'tanggal_po'  => 'required|valid_date',
        'status'      => 'required|in_list[Diproses,Diterima,Dibatalkan]',
    ];

    public const STATUS_LIST = ['Diproses', 'Diterima', 'Dibatalkan'];
}
