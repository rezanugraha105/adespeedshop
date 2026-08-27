<?php

namespace App\Controllers;

use App\Models\MasterProdukModel;
use App\Models\SettingModel;

class Landing extends BaseController
{
    private const WHATSAPP_NUMBER = '6281280492796';
    private const SHOPEE_URL      = 'https://s.shopee.co.id/8fRswhhjY1?share_channel_code=1';

    public function index()
    {
        $settingModel = new SettingModel();
        $produk       = (new MasterProdukModel())->orderBy('id', 'ASC')->findAll(8);

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

    private function waLink(string $message): string
    {
        return 'https://wa.me/' . self::WHATSAPP_NUMBER . '?text=' . rawurlencode($message);
    }
}
