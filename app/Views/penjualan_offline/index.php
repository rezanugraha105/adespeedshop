<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark d-flex flex-wrap justify-content-between align-items-center gap-2">
        Penjualan Offline
        <a href="<?= site_url('penjualan-offline/new') ?>" class="btn btn-sm btn-light">
            <i class="fa-solid fa-plus"></i> Tambah Penjualan
        </a>
    </div>
    <div class="card-body">
        <form method="get" class="row g-2 mb-3 align-items-end">
            <div class="col-6 col-md-4">
                <label class="form-label small mb-1">Cari (no. nota / pembeli / produk)</label>
                <input type="text" name="q" class="form-control form-control-sm" value="<?= esc($filters['q']) ?>">
            </div>
            <div class="col-3 col-md-2">
                <label class="form-label small mb-1">Dari Tanggal</label>
                <input type="date" name="from" class="form-control form-control-sm" value="<?= esc($filters['from']) ?>">
            </div>
            <div class="col-3 col-md-2">
                <label class="form-label small mb-1">Sampai Tanggal</label>
                <input type="date" name="to" class="form-control form-control-sm" value="<?= esc($filters['to']) ?>">
            </div>
            <div class="col-12 col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i> Filter</button>
                <a href="<?= site_url('penjualan-offline') ?>" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>No. Nota</th>
                        <th>Nama Pembeli</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Harga Satuan</th>
                        <th class="text-end">Subtotal</th>
                        <th class="text-end">Diskon</th>
                        <th>Metode Bayar</th>
                        <th>Bukti</th>
                        <th class="text-end">Total Bayar</th>
                        <th class="text-end">HPP Total</th>
                        <th class="text-end">Profit</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rows)) : ?>
                        <tr><td colspan="15" class="text-center text-muted">Belum ada data penjualan offline.</td></tr>
                    <?php endif ?>
                    <?php foreach ($rows as $r) : $c = $r['calc']; ?>
                        <tr>
                            <td><?= esc($r['tanggal']) ?></td>
                            <td><?= esc($r['no_nota']) ?></td>
                            <td><?= esc($r['nama_pembeli']) ?></td>
                            <td><?= esc($r['kode_produk']) ?></td>
                            <td><?= esc($r['nama_produk']) ?></td>
                            <td class="text-end"><?= number_format($r['qty'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($r['harga_jual_satuan'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($c['subtotal'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($r['diskon'], 0, ',', '.') ?></td>
                            <td><?= esc($r['metode_bayar']) ?></td>
                            <td class="text-center">
                                <?php if (! empty($r['bukti_pembayaran'])) : ?>
                                    <a href="<?= site_url('files/' . $r['bukti_pembayaran']) ?>" target="_blank" title="Lihat bukti pembayaran">
                                        <img src="<?= site_url('files/' . $r['bukti_pembayaran']) ?>" alt="Bukti" style="height:36px;border-radius:4px;">
                                    </a>
                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif ?>
                            </td>
                            <td class="text-end fw-bold">Rp<?= number_format($c['total_bayar'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($c['hpp_total'], 0, ',', '.') ?></td>
                            <td class="text-end fw-bold text-success">Rp<?= number_format($c['profit'], 0, ',', '.') ?></td>
                            <td class="text-center text-nowrap">
                                <a href="<?= site_url('penjualan-offline/' . $r['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="<?= site_url('penjualan-offline/' . $r['id'] . '/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
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
