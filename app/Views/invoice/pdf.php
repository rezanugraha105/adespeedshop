<?php $logoPath = FCPATH . 'assets/img/logo-adespeedshop.png'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice <?= esc($invoice['no_invoice']) ?></title>
    <style>
        @page { margin: 24px 28px; }
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #222; margin: 0; }
        .header { width: 100%; margin-bottom: 20px; }
        .header td { vertical-align: top; }
        .company-name { font-size: 18px; font-weight: bold; color: #1b2130; }
        .muted { color: #666; }
        .invoice-title { font-size: 20px; font-weight: bold; color: #d81f2a; text-align: right; }
        table.items { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table.items th, table.items td { border: 1px solid #ccc; padding: 6px 8px; }
        table.items th { background: #1b2130; color: #fff; text-align: left; }
        .text-end { text-align: right; }
        .total-row td { font-weight: bold; background: #f4f6f9; }
        .section { margin-top: 15px; }
        hr { border: none; border-top: 1px solid #ccc; margin: 15px 0; }
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td style="width:60%;">
                <?php if (is_file($logoPath)) : ?>
                    <img src="<?= $logoPath ?>" style="height:50px;margin-bottom:6px;"><br>
                <?php endif ?>
                <div class="company-name"><?= esc($settings['name']) ?></div>
                <div class="muted"><?= esc($settings['address']) ?></div>
                <div class="muted">Telp: <?= esc($settings['phone']) ?></div>
            </td>
            <td style="width:40%;">
                <div class="invoice-title">INVOICE</div>
                <div style="text-align:right;"><?= esc($invoice['no_invoice']) ?></div>
                <div class="muted" style="text-align:right;"><?= esc($invoice['tanggal']) ?></div>
            </td>
        </tr>
    </table>

    <hr>

    <div class="section">
        <div class="muted">Ditagihkan kepada:</div>
        <div style="font-weight:bold;"><?= esc($invoice['nama_pembeli']) ?></div>
        <?php if (! empty($invoice['alamat_pembeli'])) : ?><div><?= esc($invoice['alamat_pembeli']) ?></div><?php endif ?>
        <?php if (! empty($invoice['telepon_pembeli'])) : ?><div><?= esc($invoice['telepon_pembeli']) ?></div><?php endif ?>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th class="text-end">Qty</th>
                <th class="text-end">Harga Satuan</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?= esc($item['nama_produk']) ?></td>
                    <td class="text-end"><?= number_format($item['qty'], 0, ',', '.') ?></td>
                    <td class="text-end">Rp<?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                    <td class="text-end">Rp<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach ?>
            <tr class="total-row">
                <td colspan="3" class="text-end">TOTAL</td>
                <td class="text-end">Rp<?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <?php if (! empty($invoice['catatan'])) : ?>
        <div class="section">
            <div class="muted">Catatan:</div>
            <div><?= nl2br(esc($invoice['catatan'])) ?></div>
        </div>
    <?php endif ?>

    <div class="section muted" style="margin-top:40px;">
        Invoice ini dibuat otomatis oleh sistem <?= esc($settings['name']) ?>.
    </div>
</body>
</html>
