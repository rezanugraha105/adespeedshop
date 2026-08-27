<?php

namespace App\Controllers;

use App\Libraries\PenjualanCalculator;
use App\Models\MasterProdukModel;
use App\Models\PenjualanOfflineModel;
use App\Models\PenjualanShopeeModel;
use App\Models\SettingModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $produkModel   = new MasterProdukModel();
        $shopeeModel   = new PenjualanShopeeModel();
        $offlineModel  = new PenjualanOfflineModel();
        $settingModel  = new SettingModel();

        $persenAdmin = (float) $settingModel->get('biaya_admin_shopee', 0);

        $produkList     = $produkModel->findAll();
        $shopeeRows     = $shopeeModel->getWithProduk();
        $offlineRows    = $offlineModel->getWithProduk();

        $totalOmzet   = 0;
        $totalProfit  = 0;
        $totalStokAwal = 0;
        $totalTerjual = 0;
        $omzetPerProduk = [];

        foreach ($produkList as $produk) {
            $omzetPerProduk[$produk['id']] = [
                'nama'  => $produk['nama_produk'],
                'omzet' => 0,
            ];
            $totalStokAwal += (int) $produk['stok_awal'];
        }

        foreach ($shopeeRows as $row) {
            $calc = PenjualanCalculator::shopee($row, $persenAdmin);
            $totalOmzet  += $calc['total_diterima_net'];
            $totalProfit += $calc['profit'];
            $totalTerjual += (int) $row['qty'];
            if (isset($omzetPerProduk[$row['produk_id']])) {
                $omzetPerProduk[$row['produk_id']]['omzet'] += $calc['total_diterima_net'];
            }
        }

        foreach ($offlineRows as $row) {
            $calc = PenjualanCalculator::offline($row);
            $totalOmzet  += $calc['total_bayar'];
            $totalProfit += $calc['profit'];
            $totalTerjual += (int) $row['qty'];
            if (isset($omzetPerProduk[$row['produk_id']])) {
                $omzetPerProduk[$row['produk_id']]['omzet'] += $calc['total_bayar'];
            }
        }

        $data = [
            'title'          => 'Dashboard',
            'active'         => 'dashboard',
            'totalProduk'    => count($produkList),
            'totalOmzet'     => $totalOmzet,
            'totalProfit'    => $totalProfit,
            'totalTerjual'   => $totalTerjual,
            'sisaStok'       => $totalStokAwal - $totalTerjual,
            'chartLabels'    => array_column($omzetPerProduk, 'nama'),
            'chartData'      => array_map(static fn ($x) => round($x['omzet'], 2), $omzetPerProduk),
            'transaksiShopee'  => count($shopeeRows),
            'transaksiOffline' => count($offlineRows),
        ];

        return view('dashboard/index', $data);
    }
}
