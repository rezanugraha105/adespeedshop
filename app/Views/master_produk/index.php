<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark d-flex flex-wrap justify-content-between align-items-center gap-2">
        Master Produk — Baut Titanium
        <a href="<?= site_url('master-produk/new') ?>" class="btn btn-sm btn-light">
            <i class="fa-solid fa-plus"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body">
        <form method="get" class="mb-3">
            <div class="input-group input-group-sm" style="max-width:320px;">
                <input type="text" name="q" class="form-control" placeholder="Cari kode/nama produk..." value="<?= esc($q) ?>">
                <button type="submit" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
                <?php if ($q !== '') : ?>
                    <a href="<?= site_url('master-produk') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-xmark"></i></a>
                <?php endif ?>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Satuan</th>
                        <th class="text-end">Harga Modal (HPP)</th>
                        <th class="text-end">Harga Jual Shopee</th>
                        <th class="text-end">Harga Jual Offline</th>
                        <th class="text-end">Stok Awal</th>
                        <th class="text-end">Terjual</th>
                        <th class="text-end">Sisa Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produk)) : ?>
                        <tr><td colspan="10" class="text-center text-muted">Belum ada data produk.</td></tr>
                    <?php endif ?>
                    <?php foreach ($produk as $p) : ?>
                        <tr>
                            <td><?= esc($p['kode_produk']) ?></td>
                            <td><?= esc($p['nama_produk']) ?></td>
                            <td><?= esc($p['satuan']) ?></td>
                            <td class="text-end">Rp<?= number_format($p['harga_modal'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($p['harga_jual_shopee'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($p['harga_jual_offline'], 0, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($p['stok_awal'], 0, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($p['qty_terjual'], 0, ',', '.') ?></td>
                            <td class="text-end fw-bold <?= $p['sisa_stok'] <= 5 ? 'text-danger' : '' ?>"><?= number_format($p['sisa_stok'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <a href="<?= site_url('master-produk/' . $p['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="<?= site_url('master-produk/' . $p['id'] . '/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus produk ini?');">
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
