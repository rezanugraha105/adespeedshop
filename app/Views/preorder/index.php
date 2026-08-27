<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 d-none d-md-block">Daftar Preorder</h5>
    <a href="<?= site_url('preorder/new') ?>" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus"></i> Tambah Preorder
    </a>
</div>

<form method="get" class="row g-2 mb-3 align-items-end">
    <div class="col-6 col-md-4">
        <label class="form-label small mb-1">Cari nama barang</label>
        <input type="text" name="q" class="form-control form-control-sm" value="<?= esc($q) ?>">
    </div>
    <div class="col-6 col-md-3">
        <label class="form-label small mb-1">Status</label>
        <select name="status" class="form-select form-select-sm">
            <option value="">Semua</option>
            <?php foreach ($statusFilter as $s) : ?>
                <option value="<?= esc($s) ?>" <?= $status === $s ? 'selected' : '' ?>><?= esc($s) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="col-12 col-md-4 d-flex gap-2">
        <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i> Filter</button>
        <a href="<?= site_url('preorder') ?>" class="btn btn-sm btn-outline-secondary">Reset</a>
    </div>
</form>

<div class="row g-3">
    <?php if (empty($rows)) : ?>
        <div class="col-12">
            <div class="alert alert-secondary text-center mb-0">Belum ada data preorder.</div>
        </div>
    <?php endif ?>
    <?php
    $badgeStatus = [
        'Diproses'   => 'warning',
        'Diterima'   => 'success',
        'Dibatalkan' => 'danger',
    ];
    ?>
    <?php foreach ($rows as $r) : ?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <?php if (! empty($r['gambar'])) : ?>
                    <img src="<?= site_url('files/' . $r['gambar']) ?>" class="card-img-top" style="height:150px;object-fit:cover;" alt="<?= esc($r['nama_barang']) ?>">
                <?php else : ?>
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height:150px;">
                        <i class="fa-solid fa-image text-muted fs-1"></i>
                    </div>
                <?php endif ?>
                <div class="card-body">
                    <div class="fw-bold"><?= esc($r['nama_barang']) ?></div>
                    <div class="small text-muted">Qty PO: <?= number_format($r['qty'], 0, ',', '.') ?></div>
                    <div class="small text-muted">Tanggal PO: <?= esc($r['tanggal_po']) ?></div>
                    <?php if (! empty($r['estimasi_tiba'])) : ?>
                        <div class="small text-muted">Estimasi tiba: <?= esc($r['estimasi_tiba']) ?></div>
                    <?php endif ?>
                    <span class="badge text-bg-<?= $badgeStatus[$r['status']] ?? 'secondary' ?> mt-2"><?= esc($r['status']) ?></span>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between">
                    <a href="<?= site_url('preorder/' . $r['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-pen"></i> Edit
                    </a>
                    <form action="<?= site_url('preorder/' . $r['id'] . '/delete') ?>" method="post" onsubmit="return confirm('Hapus preorder ini?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-center mt-3">
    <?= $pager->links('default', 'app_bootstrap') ?>
</div>

<?= view('layout/footer') ?>
