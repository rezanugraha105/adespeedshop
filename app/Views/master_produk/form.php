<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<?php
$isEdit = $produk !== null;
$action = $isEdit ? site_url('master-produk/' . $produk['id']) : site_url('master-produk');
$val = static fn ($field, $default = '') => old($field, $isEdit ? ($produk[$field] ?? $default) : $default);
?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark"><?= $isEdit ? 'Edit Produk' : 'Tambah Produk' ?></div>
    <div class="card-body">
        <form action="<?= $action ?>" method="post">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" value="<?= esc($val('kode_produk')) ?>" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" value="<?= esc($val('nama_produk')) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="satuan" class="form-control" value="<?= esc($val('satuan', 'Pcs')) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Modal (HPP)</label>
                    <input type="number" step="0.01" name="harga_modal" class="form-control" value="<?= esc($val('harga_modal', 0)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Jual Shopee</label>
                    <input type="number" step="0.01" name="harga_jual_shopee" class="form-control" value="<?= esc($val('harga_jual_shopee', 0)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Jual Offline</label>
                    <input type="number" step="0.01" name="harga_jual_offline" class="form-control" value="<?= esc($val('harga_jual_offline', 0)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Stok Awal</label>
                    <input type="number" name="stok_awal" class="form-control" value="<?= esc($val('stok_awal', 0)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Diskon (%)</label>
                    <input type="number" step="0.01" min="0" max="99" name="diskon_percent" class="form-control" value="<?= esc($val('diskon_percent', 0)) ?>">
                    <small class="text-muted">0 = tanpa diskon. Ditampilkan sebagai badge di katalog.</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="foto_file" accept="image/jpeg,image/png,image/webp" class="form-control">
                    <small class="text-muted">JPG/PNG/WebP. Kosongkan jika tidak ingin mengganti.</small>
                    <?php if ($isEdit && ! empty($produk['foto'])) : ?>
                        <img src="<?= site_url('foto/' . rawurlencode($produk['foto'])) ?>" alt="foto" style="max-height:90px; margin-top:.4rem; border-radius:8px; object-fit:cover;">
                    <?php endif ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="2" placeholder="Deskripsi singkat untuk katalog (opsional)"><?= esc($val('deskripsi')) ?></textarea>
                </div>
                <div class="col-md-4 d-flex align-items-end gap-4">
                    <div class="form-check">
                        <input type="checkbox" name="is_unggulan" value="1" class="form-check-input" <?= old('is_unggulan', $isEdit ? ($produk['is_unggulan'] ?? 0) : 0) ? 'checked' : '' ?>>
                        <label class="form-check-label">Produk Unggulan</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_tampil" value="1" class="form-check-input" <?= old('is_tampil', $isEdit ? ($produk['is_tampil'] ?? 1) : 1) ? 'checked' : '' ?>>
                        <label class="form-check-label">Tampil di Katalog</label>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('master-produk') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= view('layout/footer') ?>
