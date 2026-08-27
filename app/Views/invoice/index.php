<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark d-flex flex-wrap justify-content-between align-items-center gap-2">
        Daftar Invoice
        <a href="<?= site_url('invoice/new') ?>" class="btn btn-sm btn-light">
            <i class="fa-solid fa-plus"></i> Buat Invoice
        </a>
    </div>
    <div class="card-body">
        <form method="get" class="mb-3">
            <div class="input-group input-group-sm" style="max-width:320px;">
                <input type="text" name="q" class="form-control" placeholder="Cari no. invoice/pembeli..." value="<?= esc($q) ?>">
                <button type="submit" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
                <?php if ($q !== '') : ?>
                    <a href="<?= site_url('invoice') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-xmark"></i></a>
                <?php endif ?>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No. Invoice</th>
                        <th>Tanggal</th>
                        <th>Nama Pembeli</th>
                        <th>Sumber</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($invoices)) : ?>
                        <tr><td colspan="6" class="text-center text-muted">Belum ada invoice.</td></tr>
                    <?php endif ?>
                    <?php foreach ($invoices as $inv) : ?>
                        <tr>
                            <td><?= esc($inv['no_invoice']) ?></td>
                            <td><?= esc($inv['tanggal']) ?></td>
                            <td><?= esc($inv['nama_pembeli']) ?></td>
                            <td><span class="badge text-bg-secondary text-capitalize"><?= esc($inv['sumber']) ?></span></td>
                            <td class="text-end fw-bold">Rp<?= number_format($inv['total'], 0, ',', '.') ?></td>
                            <td class="text-center text-nowrap">
                                <a href="<?= site_url('invoice/' . $inv['id']) ?>" class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="<?= site_url('invoice/' . $inv['id'] . '/pdf') ?>" class="btn btn-sm btn-outline-success" title="Export PDF">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <form action="<?= site_url('invoice/' . $inv['id'] . '/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus invoice ini?');">
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
