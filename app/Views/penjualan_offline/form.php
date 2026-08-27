<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<?php
$isEdit = $row !== null;
$action = $isEdit ? site_url('penjualan-offline/' . $row['id']) : site_url('penjualan-offline');
$val = static fn ($field, $default = '') => old($field, $isEdit ? ($row[$field] ?? $default) : $default);
$metodeOptions = ['Cash', 'Transfer Bank', 'QRIS', 'Debit/Kredit'];
?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark"><?= $isEdit ? 'Edit Penjualan Offline' : 'Tambah Penjualan Offline' ?></div>
    <div class="card-body">
        <form action="<?= $action ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= esc($val('tanggal', date('Y-m-d'))) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">No. Nota</label>
                    <input type="text" name="no_nota" class="form-control" value="<?= esc($val('no_nota')) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" class="form-control" value="<?= esc($val('nama_pembeli')) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kode Produk</label>
                    <select name="produk_id" id="produk_id" class="form-select" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produkList as $p) : ?>
                            <option value="<?= $p['id'] ?>"
                                data-harga="<?= esc($p['harga_jual_offline'], 'attr') ?>"
                                <?= (string) $val('produk_id') === (string) $p['id'] ? 'selected' : '' ?>>
                                <?= esc($p['kode_produk']) ?> — <?= esc($p['nama_produk']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Qty</label>
                    <input type="number" name="qty" class="form-control" value="<?= esc($val('qty', 1)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Jual Satuan</label>
                    <input type="number" step="0.01" name="harga_jual_satuan" id="harga_jual_satuan" class="form-control" value="<?= esc($val('harga_jual_satuan', 0)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Diskon</label>
                    <input type="number" step="0.01" name="diskon" class="form-control" value="<?= esc($val('diskon', 0)) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Metode Bayar</label>
                    <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                        <?php foreach ($metodeOptions as $m) : ?>
                            <option value="<?= esc($m) ?>" <?= $val('metode_bayar', 'Cash') === $m ? 'selected' : '' ?>><?= esc($m) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Bukti Pembayaran
                        <span id="bukti_required_label" class="text-danger">(wajib untuk Cash)</span>
                    </label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" accept="image/*">
                    <div class="form-text">Format gambar (JPG/PNG/WEBP), maks 2MB.</div>
                    <?php if ($isEdit && ! empty($row['bukti_pembayaran'])) : ?>
                        <div class="mt-2">
                            <a href="<?= site_url('files/' . $row['bukti_pembayaran']) ?>" target="_blank">
                                <img src="<?= site_url('files/' . $row['bukti_pembayaran']) ?>" alt="Bukti Pembayaran" style="max-height:100px;border-radius:6px;">
                            </a>
                            <div class="form-text">Bukti saat ini. Upload file baru untuk mengganti.</div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('penjualan-offline') ?>" class="btn btn-secondary">Batal</a>
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

    var metodeBayar = document.getElementById('metode_bayar');
    var buktiInput = document.getElementById('bukti_pembayaran');
    var buktiLabel = document.getElementById('bukti_required_label');
    var buktiSudahAda = <?= ($isEdit && ! empty($row['bukti_pembayaran'])) ? 'true' : 'false' ?>;

    function toggleBuktiRequired() {
        if (metodeBayar.value === 'Cash') {
            buktiLabel.textContent = '(wajib untuk Cash)';
            buktiInput.required = ! buktiSudahAda;
        } else {
            buktiLabel.textContent = '(opsional)';
            buktiInput.required = false;
        }
    }
    metodeBayar.addEventListener('change', toggleBuktiRequired);
    toggleBuktiRequired();
</script>

<?= view('layout/footer') ?>
