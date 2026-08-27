<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanOfflineModel extends Model
{
    protected $table         = 'penjualan_offline';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $returnType    = 'array';
    protected $allowedFields = [
        'tanggal',
        'no_nota',
        'nama_pembeli',
        'produk_id',
        'qty',
        'harga_jual_satuan',
        'diskon',
        'metode_bayar',
        'bukti_pembayaran',
    ];
    protected $validationRules = [
        'tanggal'           => 'required|valid_date',
        'no_nota'           => 'required|max_length[50]',
        'nama_pembeli'      => 'required|max_length[100]',
        'produk_id'         => 'required|integer',
        'qty'               => 'required|integer|greater_than[0]',
        'harga_jual_satuan' => 'required|numeric|greater_than[0]',
        'diskon'            => 'permit_empty|numeric|greater_than_equal_to[0]',
        'metode_bayar'      => 'required|max_length[30]',
    ];

    public function sumQtyPerProduk(): array
    {
        $rows = $this->select('produk_id, SUM(qty) as total_qty')
            ->groupBy('produk_id')
            ->findAll();

        return array_column($rows, 'total_qty', 'produk_id');
    }

    public function getWithProduk(?int $id = null)
    {
        $builder = $this->select('penjualan_offline.*, master_produk.kode_produk, master_produk.nama_produk, master_produk.harga_modal')
            ->join('master_produk', 'master_produk.id = penjualan_offline.produk_id')
            ->orderBy('penjualan_offline.tanggal', 'DESC')
            ->orderBy('penjualan_offline.id', 'DESC');

        if ($id !== null) {
            return $builder->where('penjualan_offline.id', $id)->first();
        }

        return $builder->findAll();
    }

    public function getListPaginated(array $filters, int $perPage = 15)
    {
        $builder = $this->select('penjualan_offline.*, master_produk.kode_produk, master_produk.nama_produk, master_produk.harga_modal')
            ->join('master_produk', 'master_produk.id = penjualan_offline.produk_id')
            ->orderBy('penjualan_offline.tanggal', 'DESC')
            ->orderBy('penjualan_offline.id', 'DESC');

        if (! empty($filters['q'])) {
            $builder = $builder->groupStart()
                ->like('penjualan_offline.no_nota', $filters['q'])
                ->orLike('penjualan_offline.nama_pembeli', $filters['q'])
                ->orLike('master_produk.nama_produk', $filters['q'])
                ->orLike('master_produk.kode_produk', $filters['q'])
                ->groupEnd();
        }
        if (! empty($filters['from'])) {
            $builder = $builder->where('penjualan_offline.tanggal >=', $filters['from']);
        }
        if (! empty($filters['to'])) {
            $builder = $builder->where('penjualan_offline.tanggal <=', $filters['to']);
        }

        return $builder->paginate($perPage);
    }
}
