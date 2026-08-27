<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="row g-3 mb-3">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Total Omzet</div>
                <div class="fs-5 fs-md-4 fw-bold text-primary text-truncate">Rp<?= number_format($totalOmzet, 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Total Profit</div>
                <div class="fs-5 fs-md-4 fw-bold text-success text-truncate">Rp<?= number_format($totalProfit, 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Qty Terjual</div>
                <div class="fs-5 fs-md-4 fw-bold"><?= number_format($totalTerjual, 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Sisa Stok</div>
                <div class="fs-5 fs-md-4 fw-bold"><?= number_format($sisaStok, 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-dark">Omzet per Produk</div>
            <div class="card-body">
                <canvas id="chartOmzet" height="110"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-dark">Ringkasan Transaksi</div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr><td>Total Produk</td><td class="text-end fw-bold"><?= $totalProduk ?></td></tr>
                    <tr><td>Transaksi Shopee</td><td class="text-end fw-bold"><?= $transaksiShopee ?></td></tr>
                    <tr><td>Transaksi Offline</td><td class="text-end fw-bold"><?= $transaksiOffline ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    new Chart(document.getElementById('chartOmzet'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartLabels) ?>,
            datasets: [{
                label: 'Omzet (Rp)',
                data: <?= json_encode($chartData) ?>,
                backgroundColor: '#d81f2a'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

<?= view('layout/footer') ?>
