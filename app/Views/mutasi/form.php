<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<?php
$isEdit = $row !== null;
$action = $isEdit ? site_url('mutasi/' . $row['id']) : site_url('mutasi');
$val = static fn ($field, $default = '') => old($field, $isEdit ? ($row[$field] ?? $default) : $default);
?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark"><?= $isEdit ? 'Edit Mutasi Kas' : 'Tambah Mutasi Kas' ?></div>
    <div class="card-body">
        <form action="<?= $action ?>" method="post">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= esc($val('tanggal', date('Y-m-d'))) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <?php foreach ($jenisList as $j) : ?>
                            <option value="<?= esc($j) ?>" <?= $val('jenis') === $j ? 'selected' : '' ?>><?= esc($j) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Pihak Terkait (opsional)</label>
                    <input type="text" name="pihak" class="form-control" placeholder="Nama customer / supplier" value="<?= esc($val('pihak')) ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Pelunasan piutang penjualan offline NT-0002" value="<?= esc($val('keterangan')) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nominal (Rp)</label>
                    <input type="number" step="0.01" name="nominal" class="form-control" value="<?= esc($val('nominal', 0)) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Lunas" <?= $val('status', 'Lunas') === 'Lunas' ? 'selected' : '' ?>>Lunas / Selesai</option>
                        <option value="Belum Lunas" <?= $val('status') === 'Belum Lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jatuh Tempo (opsional)</label>
                    <input type="date" name="tanggal_jatuh_tempo" class="form-control" value="<?= esc($val('tanggal_jatuh_tempo')) ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Catatan (opsional)</label>
                    <textarea name="catatan" class="form-control" rows="2"><?= esc($val('catatan')) ?></textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('mutasi') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= view('layout/footer') ?>
