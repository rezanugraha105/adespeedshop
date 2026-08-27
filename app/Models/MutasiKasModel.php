<?php

namespace App\Models;

use CodeIgniter\Model;

class MutasiKasModel extends Model
{
    protected $table         = 'mutasi_kas';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $returnType    = 'array';
    protected $allowedFields = [
        'tanggal',
        'jenis',
        'keterangan',
        'pihak',
        'nominal',
        'status',
        'tanggal_jatuh_tempo',
        'catatan',
    ];
    protected $validationRules = [
        'tanggal'    => 'required|valid_date',
        'jenis'      => 'required|in_list[Kas Masuk,Kas Keluar,Piutang,Bayar Tempo,Dibayar Duluan]',
        'keterangan' => 'required|max_length[255]',
        'nominal'    => 'required|numeric|greater_than[0]',
        'status'     => 'required|in_list[Belum Lunas,Lunas]',
    ];

    public const JENIS_LIST = ['Kas Masuk', 'Kas Keluar', 'Piutang', 'Bayar Tempo', 'Dibayar Duluan'];

    public function summary(): array
    {
        $rows = $this->findAll();

        $summary = [
            'kas_masuk'          => 0,
            'kas_keluar'         => 0,
            'piutang_outstanding'=> 0,
            'tempo_outstanding'  => 0,
            'dibayar_duluan'     => 0,
        ];

        foreach ($rows as $row) {
            $nominal = (float) $row['nominal'];

            switch ($row['jenis']) {
                case 'Kas Masuk':
                    $summary['kas_masuk'] += $nominal;
                    break;
                case 'Kas Keluar':
                    $summary['kas_keluar'] += $nominal;
                    break;
                case 'Piutang':
                    if ($row['status'] === 'Belum Lunas') {
                        $summary['piutang_outstanding'] += $nominal;
                    }
                    break;
                case 'Bayar Tempo':
                    if ($row['status'] === 'Belum Lunas') {
                        $summary['tempo_outstanding'] += $nominal;
                    }
                    break;
                case 'Dibayar Duluan':
                    if ($row['status'] === 'Belum Lunas') {
                        $summary['dibayar_duluan'] += $nominal;
                    }
                    break;
            }
        }

        $summary['saldo_kas'] = $summary['kas_masuk'] - $summary['kas_keluar'];

        return $summary;
    }
}
