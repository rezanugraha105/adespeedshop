<?php

namespace App\Controllers;

use App\Libraries\PenjualanCalculator;
use App\Models\InvoiceItemModel;
use App\Models\InvoiceModel;
use App\Models\PenjualanOfflineModel;
use App\Models\PenjualanShopeeModel;
use App\Models\SettingModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Invoice extends BaseController
{
    protected InvoiceModel $model;
    protected InvoiceItemModel $itemModel;

    public function __construct()
    {
        $this->model     = new InvoiceModel();
        $this->itemModel = new InvoiceItemModel();
    }

    public function index()
    {
        $q = trim((string) $this->request->getGet('q'));

        $builder = $this->model->orderBy('id', 'DESC');
        if ($q !== '') {
            $builder = $builder->groupStart()
                ->like('no_invoice', $q)
                ->orLike('nama_pembeli', $q)
                ->groupEnd();
        }
        $invoices = $builder->paginate(15);

        foreach ($invoices as &$inv) {
            $items = $this->itemModel->getByInvoice($inv['id']);
            $inv['total'] = array_sum(array_column($items, 'subtotal'));
        }
        unset($inv);

        return view('invoice/index', [
            'title'    => 'Invoice',
            'active'   => 'invoice',
            'invoices' => $invoices,
            'pager'    => $this->model->pager,
            'q'        => $q,
        ]);
    }

    public function new()
    {
        $offlineRows = (new PenjualanOfflineModel())->getWithProduk();
        $shopeeRows  = (new PenjualanShopeeModel())->getWithProduk();
        $persenAdmin = (float) (new SettingModel())->get('biaya_admin_shopee', 0);

        foreach ($offlineRows as &$r) {
            $r['calc'] = PenjualanCalculator::offline($r);
        }
        unset($r);

        foreach ($shopeeRows as &$r) {
            $r['calc'] = PenjualanCalculator::shopee($r, $persenAdmin);
        }
        unset($r);

        return view('invoice/form', [
            'title'       => 'Buat Invoice',
            'active'      => 'invoice',
            'offlineRows' => $offlineRows,
            'shopeeRows'  => $shopeeRows,
            'noInvoice'   => $this->model->generateNoInvoice(),
        ]);
    }

    public function create()
    {
        $rules = [
            'tanggal'      => 'required|valid_date',
            'nama_pembeli' => 'required|max_length[100]',
            'sumber'       => 'required|in_list[offline,shopee,manual]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/invoice/new')->withInput()->with('errors', $this->validator->getErrors());
        }

        $sumber   = $this->request->getPost('sumber');
        $sumberId = $this->request->getPost('sumber_id') ?: null;

        $items = $this->buildItems($sumber, $sumberId);

        if (empty($items)) {
            return redirect()->to('/invoice/new')->withInput()->with('error', 'Item invoice tidak boleh kosong. Pilih transaksi atau isi item manual.');
        }

        $invoiceId = $this->model->insert([
            'no_invoice'      => $this->model->generateNoInvoice(),
            'tanggal'         => $this->request->getPost('tanggal'),
            'nama_pembeli'    => $this->request->getPost('nama_pembeli'),
            'alamat_pembeli'  => $this->request->getPost('alamat_pembeli'),
            'telepon_pembeli' => $this->request->getPost('telepon_pembeli'),
            'sumber'          => $sumber,
            'sumber_id'       => $sumberId,
            'catatan'         => $this->request->getPost('catatan'),
        ]);

        foreach ($items as $item) {
            $item['invoice_id'] = $invoiceId;
            $this->itemModel->insert($item);
        }

        return redirect()->to('/invoice/' . $invoiceId)->with('success', 'Invoice berhasil dibuat.');
    }

    public function show($id)
    {
        $invoice = $this->model->find($id);
        if (! $invoice) {
            return redirect()->to('/invoice')->with('error', 'Invoice tidak ditemukan.');
        }

        $items = $this->itemModel->getByInvoice((int) $id);

        return view('invoice/show', [
            'title'    => 'Detail Invoice',
            'active'   => 'invoice',
            'invoice'  => $invoice,
            'items'    => $items,
            'total'    => array_sum(array_column($items, 'subtotal')),
            'settings' => $this->companySettings(),
        ]);
    }

    public function pdf($id)
    {
        $invoice = $this->model->find($id);
        if (! $invoice) {
            return redirect()->to('/invoice')->with('error', 'Invoice tidak ditemukan.');
        }

        $items = $this->itemModel->getByInvoice((int) $id);

        $html = view('invoice/pdf', [
            'invoice'  => $invoice,
            'items'    => $items,
            'total'    => array_sum(array_column($items, 'subtotal')),
            'settings' => $this->companySettings(),
        ]);

        $options = new Options();
        $options->set('isRemoteEnabled', false);
        $options->set('defaultFont', 'Helvetica');
        $options->set('chroot', FCPATH);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($dompdf->output())
            ->setHeader('Content-Disposition', 'attachment; filename="' . $invoice['no_invoice'] . '.pdf"');
    }

    public function delete($id)
    {
        $invoice = $this->model->find($id);
        if (! $invoice) {
            return redirect()->to('/invoice')->with('error', 'Invoice tidak ditemukan.');
        }

        $this->model->delete($id);

        return redirect()->to('/invoice')->with('success', 'Invoice berhasil dihapus.');
    }

    private function buildItems(string $sumber, ?string $sumberId): array
    {
        if ($sumber === 'offline' && $sumberId) {
            $row = (new PenjualanOfflineModel())->getWithProduk((int) $sumberId);
            if (! $row) {
                return [];
            }
            $calc = PenjualanCalculator::offline($row);

            return [[
                'nama_produk'  => $row['nama_produk'],
                'qty'          => $row['qty'],
                'harga_satuan' => $row['harga_jual_satuan'],
                'subtotal'     => $calc['total_bayar'],
            ]];
        }

        if ($sumber === 'shopee' && $sumberId) {
            $row = (new PenjualanShopeeModel())->getWithProduk((int) $sumberId);
            if (! $row) {
                return [];
            }
            $subtotalCustomer = ($row['qty'] * $row['harga_jual_satuan']) - $row['diskon_voucher'];

            return [[
                'nama_produk'  => $row['nama_produk'],
                'qty'          => $row['qty'],
                'harga_satuan' => $row['harga_jual_satuan'],
                'subtotal'     => $subtotalCustomer,
            ]];
        }

        $namaList  = $this->request->getPost('item_nama') ?? [];
        $qtyList   = $this->request->getPost('item_qty') ?? [];
        $hargaList = $this->request->getPost('item_harga') ?? [];

        $items = [];
        foreach ($namaList as $i => $nama) {
            $nama = trim((string) $nama);
            if ($nama === '') {
                continue;
            }
            $qty   = (int) ($qtyList[$i] ?? 0);
            $harga = (float) ($hargaList[$i] ?? 0);
            if ($qty <= 0 || $harga < 0) {
                continue;
            }
            $items[] = [
                'nama_produk'  => $nama,
                'qty'          => $qty,
                'harga_satuan' => $harga,
                'subtotal'     => $qty * $harga,
            ];
        }

        return $items;
    }

    private function companySettings(): array
    {
        $settingModel = new SettingModel();

        return [
            'name'    => $settingModel->get('company_name', 'ADM Motor Parts & Accessories'),
            'address' => $settingModel->get('company_address', ''),
            'phone'   => $settingModel->get('company_phone', ''),
        ];
    }
}
