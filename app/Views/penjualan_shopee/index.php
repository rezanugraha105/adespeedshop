<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-header card-header-dark">% Biaya Admin Shopee</div>
    <div class="card-body">
        <form action="<?= site_url('penjualan-shopee/setting') ?>" method="post" class="d-flex align-items-center gap-2">
            <?= csrf_field() ?>
            <input type="number" step="0.01" name="biaya_admin_shopee" class="form-control" style="max-width:150px;" value="<?= esc($persenAdmin) ?>" required>
            <span>%</span>
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <span class="text-muted small ms-2">Gabungan biaya admin + layanan Shopee — sesuaikan dengan tarif aktual toko Anda.</span>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark d-flex flex-wrap justify-content-between align-items-center gap-2">
        Penjualan Shopee
        <a href="<?= site_url('penjualan-shopee/new') ?>" class="btn btn-sm btn-light">
            <i class="fa-solid fa-plus"></i> Tambah Penjualan
        </a>
    </div>
    <div class="card-body">
        <form method="get" class="row g-2 mb-3 align-items-end">
            <div class="col-6 col-md-4">
                <label class="form-label small mb-1">Cari (no. pesanan / produk)</label>
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
                <a href="<?= site_url('penjualan-shopee') ?>" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>No. Pesanan</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Harga Satuan</th>
                        <th class="text-end">Subtotal</th>
                        <th class="text-end">Diskon/Voucher</th>
                        <th class="text-end">Ongkir Penjual</th>
                        <th class="text-end">Biaya Admin</th>
                        <th class="text-end">Total Diterima (Net)</th>
                        <th class="text-end">HPP Total</th>
                        <th class="text-end">Profit</th>
                        <th>Invoice</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rows)) : ?>
                        <tr><td colspan="15" class="text-center text-muted">Belum ada data penjualan Shopee.</td></tr>
                    <?php endif ?>
                    <?php foreach ($rows as $r) : $c = $r['calc']; ?>
                        <tr>
                            <td><?= esc($r['tanggal']) ?></td>
                            <td><?= esc($r['no_pesanan']) ?></td>
                            <td><?= esc($r['kode_produk']) ?></td>
                            <td><?= esc($r['nama_produk']) ?></td>
                            <td class="text-end"><?= number_format($r['qty'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($r['harga_jual_satuan'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($c['subtotal'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($r['diskon_voucher'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($r['ongkir_ditanggung_penjual'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($c['biaya_admin'], 0, ',', '.') ?></td>
                            <td class="text-end fw-bold">Rp<?= number_format($c['total_diterima_net'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($c['hpp_total'], 0, ',', '.') ?></td>
                            <td class="text-end fw-bold text-success">Rp<?= number_format($c['profit'], 0, ',', '.') ?></td>
                            <td style="max-width:180px;">
                                <?php if (! empty($r['bukti_invoice'])) : ?>
                                    <span class="d-inline-block text-truncate" style="max-width:180px;" title="<?= esc($r['bukti_invoice']) ?>">
                                        <?= esc($r['bukti_invoice']) ?>
                                    </span>
                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif ?>
                            </td>
                            <td class="text-center text-nowrap">
                                <a href="<?= site_url('penjualan-shopee/' . $r['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="<?= site_url('penjualan-shopee/' . $r['id'] . '/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
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
