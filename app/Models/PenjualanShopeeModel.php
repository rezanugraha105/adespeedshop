<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanShopeeModel extends Model
{
    protected $table         = 'penjualan_shopee';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $returnType    = 'array';
    protected $allowedFields = [
        'tanggal',
        'no_pesanan',
        'produk_id',
        'qty',
        'harga_jual_satuan',
        'diskon_voucher',
        'ongkir_ditanggung_penjual',
        'bukti_invoice',
    ];
    protected $validationRules = [
        'tanggal'           => 'required|valid_date',
        'no_pesanan'        => 'required|max_length[50]',
        'produk_id'         => 'required|integer',
        'qty'               => 'required|integer|greater_than[0]',
        'harga_jual_satuan' => 'required|numeric|greater_than[0]',
        'diskon_voucher'            => 'permit_empty|numeric|greater_than_equal_to[0]',
        'ongkir_ditanggung_penjual' => 'permit_empty|numeric|greater_than_equal_to[0]',
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
        $builder = $this->select('penjualan_shopee.*, master_produk.kode_produk, master_produk.nama_produk, master_produk.harga_modal')
            ->join('master_produk', 'master_produk.id = penjualan_shopee.produk_id')
            ->orderBy('penjualan_shopee.tanggal', 'DESC')
            ->orderBy('penjualan_shopee.id', 'DESC');

        if ($id !== null) {
            return $builder->where('penjualan_shopee.id', $id)->first();
        }

        return $builder->findAll();
    }

    public function getListPaginated(array $filters, int $perPage = 15)
    {
        $builder = $this->select('penjualan_shopee.*, master_produk.kode_produk, master_produk.nama_produk, master_produk.harga_modal')
            ->join('master_produk', 'master_produk.id = penjualan_shopee.produk_id')
            ->orderBy('penjualan_shopee.tanggal', 'DESC')
            ->orderBy('penjualan_shopee.id', 'DESC');

        if (! empty($filters['q'])) {
            $builder = $builder->groupStart()
                ->like('penjualan_shopee.no_pesanan', $filters['q'])
                ->orLike('master_produk.nama_produk', $filters['q'])
                ->orLike('master_produk.kode_produk', $filters['q'])
                ->groupEnd();
        }
        if (! empty($filters['from'])) {
            $builder = $builder->where('penjualan_shopee.tanggal >=', $filters['from']);
        }
        if (! empty($filters['to'])) {
            $builder = $builder->where('penjualan_shopee.tanggal <=', $filters['to']);
        }

        return $builder->paginate($perPage);
    }
}
