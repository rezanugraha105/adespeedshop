<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<?php
$isEdit = $row !== null;
$action = $isEdit ? site_url('preorder/' . $row['id']) : site_url('preorder');
$val = static fn ($field, $default = '') => old($field, $isEdit ? ($row[$field] ?? $default) : $default);
?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark"><?= $isEdit ? 'Edit Preorder' : 'Tambah Preorder' ?></div>
    <div class="card-body">
        <form action="<?= $action ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="<?= esc($val('nama_barang')) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Qty PO</label>
                    <input type="number" name="qty" class="form-control" value="<?= esc($val('qty', 1)) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <?php foreach ($statusList as $s) : ?>
                            <option value="<?= esc($s) ?>" <?= $val('status', 'Diproses') === $s ? 'selected' : '' ?>><?= esc($s) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal PO</label>
                    <input type="date" name="tanggal_po" class="form-control" value="<?= esc($val('tanggal_po', date('Y-m-d'))) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Estimasi Tiba (opsional)</label>
                    <input type="date" name="estimasi_tiba" class="form-control" value="<?= esc($val('estimasi_tiba')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gambar Barang</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <div class="form-text">Format gambar (JPG/PNG/WEBP), maks 2MB.</div>
                    <?php if ($isEdit && ! empty($row['gambar'])) : ?>
                        <div class="mt-2">
                            <img src="<?= site_url('files/' . $row['gambar']) ?>" alt="Gambar" style="max-height:100px;border-radius:6px;">
                            <div class="form-text">Upload file baru untuk mengganti.</div>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-12">
                    <label class="form-label">Catatan (opsional)</label>
                    <textarea name="catatan" class="form-control" rows="2"><?= esc($val('catatan')) ?></textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('preorder') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= view('layout/footer') ?>
