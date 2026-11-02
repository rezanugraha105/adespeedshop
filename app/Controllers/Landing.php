<?php

namespace App\Controllers;

use App\Models\MasterProdukModel;
use App\Models\PenjualanOfflineModel;
use App\Models\PenjualanShopeeModel;
use App\Models\SettingModel;

class Landing extends BaseController
{
    private const WHATSAPP_NUMBER = '6281280492796';
    private const SHOPEE_URL      = 'https://s.shopee.co.id/8fRswhhjY1?share_channel_code=1';

    public function index()
    {
        $settingModel = new SettingModel();
        $produk       = (new MasterProdukModel())->getCatalog();

        return view('landing/index', [
            'company' => [
                'name'    => $settingModel->get('company_name', 'ADM Motor Parts & Accessories'),
                'address' => $settingModel->get('company_address', ''),
                'phone'   => $settingModel->get('company_phone', ''),
            ],
            'produk'     => $produk,
            'waLink'     => $this->waLink('Halo ADM Motor Parts, saya ingin bertanya tentang produk baut titanium.'),
            'waLinkFor'  => fn (string $namaProduk) => $this->waLink("Halo, saya ingin pesan produk *{$namaProduk}*. Apakah masih tersedia?"),
            'shopeeLink' => self::SHOPEE_URL,
        ]);
    }

    /**
     * Halaman detail produk untuk katalog toko (publik).
     */
    public function detail(string $kode)
    {
        $settingModel = new SettingModel();
        $p            = (new MasterProdukModel())->where('kode_produk', $kode)->where('is_tampil', 1)->first();

        if (! $p) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $terjual   = (int) ((new PenjualanShopeeModel())->sumQtyPerProduk()[$p['id']] ?? 0);
        $terjual  += (int) ((new PenjualanOfflineModel())->sumQtyPerProduk()[$p['id']] ?? 0);
        $p['qty_terjual'] = $terjual;
        $p['sisa_stok']   = max(0, (int) $p['stok_awal'] - $terjual);

        return view('landing/detail', [
            'p'          => $p,
            'company'    => [
                'name'    => $settingModel->get('company_name', 'ADM Motor Parts & Accessories'),
                'address' => $settingModel->get('company_address', ''),
            ],
            'waLinkFor'  => fn (string $namaProduk) => $this->waLink("Halo, saya ingin pesan produk *{$namaProduk}*. Apakah masih tersedia?"),
            'shopeeLink' => self::SHOPEE_URL,
        ]);
    }

    private function waLink(string $message): string
    {
        return 'https://wa.me/' . self::WHATSAPP_NUMBER . '?text=' . rawurlencode($message);
    }
}
