<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<?php
$isEdit = $row !== null;
$action = $isEdit ? site_url('penjualan-shopee/' . $row['id']) : site_url('penjualan-shopee');
$val = static fn ($field, $default = '') => old($field, $isEdit ? ($row[$field] ?? $default) : $default);
?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark"><?= $isEdit ? 'Edit Penjualan Shopee' : 'Tambah Penjualan Shopee' ?></div>
    <div class="card-body">
        <form action="<?= $action ?>" method="post">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= esc($val('tanggal', date('Y-m-d'))) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">No. Pesanan</label>
                    <input type="text" name="no_pesanan" class="form-control" value="<?= esc($val('no_pesanan')) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kode Produk</label>
                    <select name="produk_id" id="produk_id" class="form-select" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produkList as $p) : ?>
                            <option value="<?= $p['id'] ?>"
                                data-harga="<?= esc($p['harga_jual_shopee'], 'attr') ?>"
                                <?= (string) $val('produk_id') === (string) $p['id'] ? 'selected' : '' ?>>
                                <?= esc($p['kode_produk']) ?> — <?= esc($p['nama_produk']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Qty</label>
                    <input type="number" name="qty" id="qty" class="form-control" value="<?= esc($val('qty', 1)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Jual Satuan</label>
                    <input type="number" step="0.01" name="harga_jual_satuan" id="harga_jual_satuan" class="form-control" value="<?= esc($val('harga_jual_satuan', 0)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Diskon/Voucher Toko</label>
                    <input type="number" step="0.01" name="diskon_voucher" class="form-control" value="<?= esc($val('diskon_voucher', 0)) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ongkir Ditanggung Penjual</label>
                    <input type="number" step="0.01" name="ongkir_ditanggung_penjual" class="form-control" value="<?= esc($val('ongkir_ditanggung_penjual', 0)) ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Bukti Invoice Shopee <span class="text-muted">(opsional)</span></label>
                    <textarea name="bukti_invoice" class="form-control" rows="4" placeholder="Copy-paste isi invoice dari Shopee di sini..."><?= esc($val('bukti_invoice')) ?></textarea>
                    <div class="form-text">Tempel (paste) teks invoice dari Shopee sebagai catatan bukti transaksi.</div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('penjualan-shopee') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('produk_id').addEventListener('change', function () {
        var opt = this.options[this.selectedIndex];
        var harga = opt.getAttribute('data-harga');
        if (harga) {
            document.getElementById('harga_jual_satuan').value = harga;
        }
    });
</script>

<?= view('layout/footer') ?>
