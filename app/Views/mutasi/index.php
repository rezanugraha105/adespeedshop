<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="alert alert-info small">
    <strong>Panduan singkat:</strong>
    <b>Kas Masuk</b> = uang yang benar-benar masuk ke kas (mis. hasil jualan tunai).
    <b>Kas Keluar</b> = uang yang keluar dari kas (mis. beli barang, operasional).
    <b>Piutang</b> = pelanggan belum bayar ke kita.
    <b>Bayar Tempo</b> = kita belum bayar ke supplier/pihak lain.
    <b>Dibayar Duluan</b> = pelanggan sudah transfer duluan sebelum barang selesai/dikirim.
</div>

<div class="row g-3 mb-3">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Saldo Kas</div>
                <div class="fs-5 fw-bold <?= $summary['saldo_kas'] >= 0 ? 'text-primary' : 'text-danger' ?>">Rp<?= number_format($summary['saldo_kas'], 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Piutang Belum Lunas</div>
                <div class="fs-5 fw-bold text-warning">Rp<?= number_format($summary['piutang_outstanding'], 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Bayar Tempo Belum Lunas</div>
                <div class="fs-5 fw-bold text-danger">Rp<?= number_format($summary['tempo_outstanding'], 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Dibayar Duluan (belum selesai)</div>
                <div class="fs-5 fw-bold text-info">Rp<?= number_format($summary['dibayar_duluan'], 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark d-flex flex-wrap justify-content-between align-items-center gap-2">
        <span>Mutasi Kas</span>
        <a href="<?= site_url('mutasi/new') ?>" class="btn btn-sm btn-light">
            <i class="fa-solid fa-plus"></i> Tambah Mutasi
        </a>
    </div>
    <div class="card-body">
        <div class="mb-3 d-flex flex-wrap gap-2">
            <a href="<?= site_url('mutasi') ?>" class="btn btn-sm <?= ! $filter ? 'btn-primary' : 'btn-outline-primary' ?>">Semua</a>
            <?php foreach ($jenisList as $j) : ?>
                <a href="<?= site_url('mutasi') . '?jenis=' . urlencode($j) ?>" class="btn btn-sm <?= $filter === $j ? 'btn-primary' : 'btn-outline-primary' ?>"><?= esc($j) ?></a>
            <?php endforeach ?>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                        <th>Pihak</th>
                        <th class="text-end">Nominal</th>
                        <th>Status</th>
                        <th>Jatuh Tempo</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rows)) : ?>
                        <tr><td colspan="8" class="text-center text-muted">Belum ada data mutasi kas.</td></tr>
                    <?php endif ?>
                    <?php foreach ($rows as $r) :
                        $badgeJenis = [
                            'Kas Masuk'      => 'success',
                            'Kas Keluar'     => 'danger',
                            'Piutang'        => 'warning',
                            'Bayar Tempo'    => 'danger',
                            'Dibayar Duluan' => 'info',
                        ][$r['jenis']] ?? 'secondary';
                    ?>
                        <tr>
                            <td><?= esc($r['tanggal']) ?></td>
                            <td><span class="badge text-bg-<?= $badgeJenis ?>"><?= esc($r['jenis']) ?></span></td>
                            <td><?= esc($r['keterangan']) ?></td>
                            <td><?= esc($r['pihak'] ?? '-') ?></td>
                            <td class="text-end">Rp<?= number_format($r['nominal'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge text-bg-<?= $r['status'] === 'Lunas' ? 'success' : 'secondary' ?>"><?= esc($r['status']) ?></span>
                            </td>
                            <td><?= esc($r['tanggal_jatuh_tempo'] ?? '-') ?></td>
                            <td class="text-center text-nowrap">
                                <?php if ($r['status'] === 'Belum Lunas') : ?>
                                    <form action="<?= site_url('mutasi/' . $r['id'] . '/lunas') ?>" method="post" class="d-inline" onsubmit="return confirm('Tandai sudah lunas?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                <?php endif ?>
                                <a href="<?= site_url('mutasi/' . $r['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="<?= site_url('mutasi/' . $r['id'] . '/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <?= $pager->links('default', 'app_bootstrap') ?>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
