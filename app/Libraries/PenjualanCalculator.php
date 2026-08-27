<?php

namespace App\Libraries;

class PenjualanCalculator
{
    /**
     * Compute derived amounts for a Shopee sale row.
     * Expects: qty, harga_jual_satuan, diskon_voucher, ongkir_ditanggung_penjual, harga_modal
     */
    public static function shopee(array $row, float $persenAdmin): array
    {
        $qty              = (float) $row['qty'];
        $hargaJualSatuan  = (float) $row['harga_jual_satuan'];
        $diskonVoucher    = (float) ($row['diskon_voucher'] ?? 0);
        $ongkirPenjual    = (float) ($row['ongkir_ditanggung_penjual'] ?? 0);
        $hargaModal       = (float) ($row['harga_modal'] ?? 0);

        $subtotal        = $qty * $hargaJualSatuan;
        $dasarBiayaAdmin = $subtotal - $diskonVoucher;
        $biayaAdmin      = $dasarBiayaAdmin * ($persenAdmin / 100);
        $totalDiterima   = $subtotal - $diskonVoucher - $biayaAdmin - $ongkirPenjual;
        $hppTotal        = $qty * $hargaModal;
        $profit          = $totalDiterima - $hppTotal;

        return [
            'subtotal'           => $subtotal,
            'biaya_admin'        => $biayaAdmin,
            'total_diterima_net' => $totalDiterima,
            'hpp_satuan'         => $hargaModal,
            'hpp_total'          => $hppTotal,
            'profit'             => $profit,
        ];
    }

    /**
     * Compute derived amounts for an offline sale row.
     * Expects: qty, harga_jual_satuan, diskon, harga_modal
     */
    public static function offline(array $row): array
    {
        $qty             = (float) $row['qty'];
        $hargaJualSatuan = (float) $row['harga_jual_satuan'];
        $diskon          = (float) ($row['diskon'] ?? 0);
        $hargaModal      = (float) ($row['harga_modal'] ?? 0);

        $subtotal   = $qty * $hargaJualSatuan;
        $totalBayar = $subtotal - $diskon;
        $hppTotal   = $qty * $hargaModal;
        $profit     = $totalBayar - $hppTotal;

        return [
            'subtotal'    => $subtotal,
            'total_bayar' => $totalBayar,
            'hpp_satuan'  => $hargaModal,
            'hpp_total'   => $hppTotal,
            'profit'      => $profit,
        ];
    }
}
