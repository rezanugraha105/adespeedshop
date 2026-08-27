<?php

namespace App\Controllers;

use App\Libraries\PenjualanCalculator;
use App\Models\MasterProdukModel;
use App\Models\PenjualanOfflineModel;
use App\Models\PenjualanShopeeModel;
use App\Models\SettingModel;

class Ringkasan extends BaseController
{
    public function index()
    {
        $produkModel  = new MasterProdukModel();
        $shopeeModel  = new PenjualanShopeeModel();
        $offlineModel = new PenjualanOfflineModel();
        $settingModel = new SettingModel();

        $persenAdmin = (float) $settingModel->get('biaya_admin_shopee', 0);

        $produkList  = $produkModel->orderBy('kode_produk', 'ASC')->findAll();
        $shopeeRows  = $shopeeModel->getWithProduk();
        $offlineRows = $offlineModel->getWithProduk();

        $summary = [];
        foreach ($produkList as $p) {
            $summary[$p['id']] = [
                'kode_produk'        => $p['kode_produk'],
                'nama_produk'        => $p['nama_produk'],
                'stok_awal'          => (int) $p['stok_awal'],
                'qty_terjual_shopee' => 0,
                'qty_terjual_offline'=> 0,
                'omzet_shopee'       => 0,
                'omzet_offline'      => 0,
                'profit'             => 0,
            ];
        }

        foreach ($shopeeRows as $row) {
            if (! isset($summary[$row['produk_id']])) {
                continue;
            }
            $calc = PenjualanCalculator::shopee($row, $persenAdmin);
            $summary[$row['produk_id']]['qty_terjual_shopee'] += (int) $row['qty'];
            $summary[$row['produk_id']]['omzet_shopee']       += $calc['total_diterima_net'];
            $summary[$row['produk_id']]['profit']             += $calc['profit'];
        }

        foreach ($offlineRows as $row) {
            if (! isset($summary[$row['produk_id']])) {
                continue;
            }
            $calc = PenjualanCalculator::offline($row);
            $summary[$row['produk_id']]['qty_terjual_offline'] += (int) $row['qty'];
            $summary[$row['produk_id']]['omzet_offline']        += $calc['total_bayar'];
            $summary[$row['produk_id']]['profit']               += $calc['profit'];
        }

        foreach ($summary as &$s) {
            $s['total_qty_terjual'] = $s['qty_terjual_shopee'] + $s['qty_terjual_offline'];
            $s['sisa_stok']         = $s['stok_awal'] - $s['total_qty_terjual'];
            $s['total_omzet']       = $s['omzet_shopee'] + $s['omzet_offline'];
        }
        unset($s);

        return view('ringkasan/index', [
            'title'   => 'Ringkasan Penjualan',
            'active'  => 'ringkasan',
            'summary' => array_values($summary),
        ]);
    }
}
