<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-header card-header-dark">Ringkasan per Produk</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th class="text-end">Stok Awal</th>
                        <th class="text-end">Qty Terjual Shopee</th>
                        <th class="text-end">Qty Terjual Offline</th>
                        <th class="text-end">Total Qty Terjual</th>
                        <th class="text-end">Sisa Stok</th>
                        <th class="text-end">Omzet Shopee</th>
                        <th class="text-end">Omzet Offline</th>
                        <th class="text-end">Total Omzet</th>
                        <th class="text-end">Total Profit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($summary)) : ?>
                        <tr><td colspan="11" class="text-center text-muted">Belum ada data produk.</td></tr>
                    <?php endif ?>
                    <?php foreach ($summary as $s) : ?>
                        <tr>
                            <td><?= esc($s['kode_produk']) ?></td>
                            <td><?= esc($s['nama_produk']) ?></td>
                            <td class="text-end"><?= number_format($s['stok_awal'], 0, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($s['qty_terjual_shopee'], 0, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($s['qty_terjual_offline'], 0, ',', '.') ?></td>
                            <td class="text-end fw-bold"><?= number_format($s['total_qty_terjual'], 0, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($s['sisa_stok'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($s['omzet_shopee'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp<?= number_format($s['omzet_offline'], 0, ',', '.') ?></td>
                            <td class="text-end fw-bold">Rp<?= number_format($s['total_omzet'], 0, ',', '.') ?></td>
                            <td class="text-end fw-bold text-success">Rp<?= number_format($s['profit'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark">Grafik Omzet &amp; Profit per Produk</div>
    <div class="card-body">
        <canvas id="chartRingkasan" height="100"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    new Chart(document.getElementById('chartRingkasan'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($summary, 'nama_produk')) ?>,
            datasets: [
                {
                    label: 'Total Omzet',
                    data: <?= json_encode(array_map(static fn ($s) => round($s['total_omzet'], 2), $summary)) ?>,
                    backgroundColor: '#1b2130'
                },
                {
                    label: 'Total Profit',
                    data: <?= json_encode(array_map(static fn ($s) => round($s['profit'], 2), $summary)) ?>,
                    backgroundColor: '#d81f2a'
                }
            ]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

<?= view('layout/footer') ?>
