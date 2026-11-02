<?php
/**
 * @var array $p               Data produk (termasuk sisa_stok, qty_terjual)
 * @var array $company         company_name / company_address
 * @var Closure $waLinkFor     fn(string) => link WhatsApp
 * @var string $shopeeLink
 */
$diskon      = (float) ($p['diskon_percent'] ?? 0);
$harga       = (float) $p['harga_jual_offline'];
$hargaCoret  = $diskon > 0 ? $harga / (1 - $diskon / 100) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($p['kode_produk'] . ' — ' . $p['nama_produk']) ?> — <?= esc($company['name']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= esc($p['nama_produk']) ?> — <?= esc($company['name']) ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/favicon-32.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-dark: #0f1117;
            --brand-navy: #1b2130;
            --brand-red: #d81f2a;
            --brand-red-dark: #a3141d;
            --brand-red-light: #ff4757;
            --brand-shopee: #ee4d2d;
            --brand-wa: #25d366;
            --ease: cubic-bezier(.4, 0, .2, 1);
        }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', system-ui, sans-serif; color: #24262f; background: #f5f6f8; }
        h1, h2, h3 { font-family: 'Sora', 'Poppins', sans-serif; }

        .topbar {
            background: var(--brand-dark); color: #fff; padding: .8rem 0; position: sticky; top: 0; z-index: 50;
        }
        .topbar .brand { font-weight: 800; font-family: 'Sora', sans-serif; }
        .topbar a.nav-link { color: rgba(255,255,255,.75); font-size: .85rem; font-weight: 600; text-decoration: none; }
        .topbar a.nav-link:hover { color: #fff; }

        .btn-wa { background: var(--brand-wa); color: #fff; border: none; font-weight: 700; border-radius: 12px; transition: all .3s var(--ease); }
        .btn-wa:hover { background: #1eb256; color: #fff; transform: translateY(-3px); box-shadow: 0 12px 24px rgba(37,211,102,.35); }
        .btn-shopee { background: var(--brand-shopee); color: #fff; border: none; font-weight: 700; border-radius: 12px; transition: all .3s var(--ease); }
        .btn-shopee:hover { background: #d43f21; color: #fff; transform: translateY(-3px); box-shadow: 0 12px 24px rgba(238,77,45,.35); }

        .detail-wrap { padding: 2.5rem 0 3rem; }
        .detail-card {
            background: #fff; border: 1px solid #eef0f4; border-radius: 20px; overflow: hidden;
            box-shadow: 0 1rem 2.5rem rgba(20,22,31,.07);
        }
        .detail-img {
            background: #f5f6f8; position: relative; aspect-ratio: 1/1;
            display: flex; align-items: center; justify-content: center; overflow: hidden;
        }
        .detail-img img { width: 100%; height: 100%; object-fit: contain; }
        .detail-img i { font-size: 5rem; color: #c5c9d2; }
        .badge-diskon {
            position: absolute; top: 14px; right: 14px; z-index: 3;
            background: var(--brand-red); color: #fff; font-size: .8rem; font-weight: 700;
            padding: .4rem .9rem; border-radius: 999px;
        }
        .badge-unggulan {
            position: absolute; bottom: 14px; right: 14px; z-index: 3;
            background: rgba(255,255,255,.94); color: var(--brand-navy); font-size: .8rem; font-weight: 700;
            padding: .4rem .9rem; border-radius: 999px;
        }
        .badge-unggulan i { color: var(--brand-red); margin-right: 4px; }
        .detail-body { padding: 1.8rem; }
        .detail-kode { font-size: .78rem; font-weight: 700; letter-spacing: .12em; color: var(--brand-red); text-transform: uppercase; }
        .detail-nama { font-weight: 800; font-size: clamp(1.4rem, 3vw, 2rem); color: var(--brand-navy); margin: .4rem 0; }
        .detail-price-box { background: var(--brand-dark); color: #fff; border-radius: 16px; padding: 1.1rem 1.3rem; margin: 1.1rem 0; }
        .detail-price-box .harga { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.7rem; color: var(--brand-red-light); }
        .detail-price-box .harga s { font-size: 1rem; color: rgba(255,255,255,.45); font-weight: 500; margin-right: .6rem; }
        .detail-spec { background: #f9fafb; border-radius: 12px; padding: 1rem 1.2rem; margin: 1rem 0 1.2rem; }
        .detail-spec div { display: flex; justify-content: space-between; padding: .4rem 0; font-size: .9rem; border-bottom: 1px dashed #e3e5ea; }
        .detail-spec div:last-child { border-bottom: none; }
        .detail-spec span:first-child { color: #6b7280; }
        .detail-spec span:last-child { font-weight: 700; color: var(--brand-navy); }
        .detail-desc { color: #4b5058; font-size: .95rem; line-height: 1.7; }
        .footer { background: var(--brand-dark); color: rgba(255,255,255,.65); padding: 1.5rem 0; font-size: .85rem; }
        @media (max-width: 767px) { .detail-img { aspect-ratio: 4/3; } }
    </style>
</head>
<body>
<header class="topbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" style="text-decoration:none; display:flex; align-items:center; gap:.6rem;">
            <img src="<?= base_url('assets/img/logo-adespeedshop.png') ?>" alt="logo" style="height:36px;">
            <span class="brand">ADM Motor Parts</span>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="/" class="nav-link"><i class="fa-solid fa-store me-1"></i> Kembali ke Katalog</a>
        </div>
    </div>
</header>

<main class="container detail-wrap">
    <div class="detail-card">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="detail-img">
                    <?php if (! empty($p['foto'])) : ?>
                        <img src="<?= site_url('foto/' . rawurlencode($p['foto'])) ?>" alt="<?= esc($p['nama_produk']) ?>">
                    <?php else : ?>
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    <?php endif ?>
                    <?php if ($diskon > 0) : ?>
                        <span class="badge-diskon">Diskon <?= (int) $diskon ?>%</span>
                    <?php endif ?>
                    <?php if (! empty($p['is_unggulan'])) : ?>
                        <span class="badge-unggulan"><i class="fa-solid fa-crown"></i> Produk Unggulan</span>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-body">
                    <div class="detail-kode">Kode Produk: <?= esc($p['kode_produk']) ?></div>
                    <h1 class="detail-nama"><?= esc($p['nama_produk']) ?></h1>

                    <div class="detail-price-box">
                        <div><?= $diskon > 0 ? 'Harga Promo' : 'Harga' ?></div>
                        <div class="harga"><?php if ($hargaCoret > 0) : ?><s>Rp<?= number_format($hargaCoret, 0, ',', '.') ?></s> <?php endif ?>Rp<?= number_format($harga, 0, ',', '.') ?></div>
                    </div>

                    <div class="detail-spec">
                        <div><span>Satuan</span><span><?= esc($p['satuan'] ?? 'Pcs') ?></span></div>
                        <div><span>Sisa Stok</span><span class="<?= $p['sisa_stok'] <= 5 ? 'text-danger fw-bold' : '' ?>"><?= $p['sisa_stok'] > 0 ? number_format($p['sisa_stok']) . ' tersedia' : 'Stok habis' ?></span></div>
                        <div><span>Total Terjual</span><span><?= number_format($p['qty_terjual'] ?? 0) ?></span></div>
                    </div>

                    <?php if (! empty($p['deskripsi'])) : ?>
                        <div class="detail-desc mb-3"><?= nl2br(esc($p['deskripsi'])) ?></div>
                    <?php endif ?>

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="<?= esc($waLinkFor($p['nama_produk'])) ?>" target="_blank" class="btn btn-wa">
                            <i class="fa-brands fa-whatsapp me-1"></i> Pesan via WhatsApp
                        </a>
                        <a href="<?= esc($shopeeLink) ?>" target="_blank" class="btn btn-shopee">
                            <i class="fa-solid fa-bag-shopping me-1"></i> Beli di Shopee
                        </a>
                    </div>
                    <small class="text-muted"><i class="fa-solid fa-truck-fast me-1"></i> Pengiriman ke seluruh Indonesia · Garansi kualitas</small>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer text-center">
    <div class="container">
        &copy; <?= date('Y') ?> <?= esc($company['name']) ?>. All rights reserved.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>