<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="d-flex justify-content-end gap-2 mb-3">
    <a href="<?= site_url('invoice/' . $invoice['id'] . '/pdf') ?>" class="btn btn-success">
        <i class="fa-solid fa-file-pdf"></i> Export PDF
    </a>
    <a href="<?= site_url('invoice') ?>" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between flex-wrap mb-4">
            <div>
                <h4 class="fw-bold mb-0"><?= esc($settings['name']) ?></h4>
                <div class="text-muted small"><?= esc($settings['address']) ?></div>
                <div class="text-muted small">Telp: <?= esc($settings['phone']) ?></div>
            </div>
            <div class="text-md-end">
                <h5 class="fw-bold text-primary mb-0">INVOICE</h5>
                <div><?= esc($invoice['no_invoice']) ?></div>
                <div class="text-muted small"><?= esc($invoice['tanggal']) ?></div>
            </div>
        </div>

        <hr>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="text-muted small">Ditagihkan kepada</div>
                <div class="fw-bold"><?= esc($invoice['nama_pembeli']) ?></div>
                <?php if (! empty($invoice['alamat_pembeli'])) : ?><div><?= esc($invoice['alamat_pembeli']) ?></div><?php endif ?>
                <?php if (! empty($invoice['telepon_pembeli'])) : ?><div><?= esc($invoice['telepon_pembeli']) ?></div><?php endif ?>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Barang</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Harga Satuan</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= esc($item['nama_produk']) ?></td>
                            <td class="text-end"><?= number_format($item['qty'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">TOTAL</th>
                        <th class="text-end">Rp<?= number_format($total, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <?php if (! empty($invoice['catatan'])) : ?>
            <div class="mt-3">
                <div class="text-muted small">Catatan</div>
                <div><?= nl2br(esc($invoice['catatan'])) ?></div>
            </div>
        <?php endif ?>
    </div>
</div>

<?= view('layout/footer') ?>
