<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceItemModel extends Model
{
    protected $table         = 'invoice_items';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'invoice_id',
        'nama_produk',
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    public function getByInvoice(int $invoiceId): array
    {
        return $this->where('invoice_id', $invoiceId)->findAll();
    }
}
