<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Dashboard') ?> - ADM Motor Parts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/favicon-32.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/favicon-180.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-dark: #14161f;
            --brand-navy: #1b2130;
            --brand-red: #d81f2a;
            --brand-red-dark: #a3141d;
            --brand-silver: #c9ced4;
            --sidebar-width: 264px;
        }
        * { box-sizing: border-box; }
        body {
            background: #f2f4f8;
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: .92rem;
            color: #24262f;
        }

        /* ---------- Sidebar (mobile-first: hidden off-canvas by default) ---------- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--brand-dark) 0%, var(--brand-navy) 100%);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            transform: translateX(-100%);
            transition: transform .25s ease;
            overflow-y: auto;
        }
        .sidebar.show { transform: translateX(0); }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: 1.1rem 1.1rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar .brand .logo-badge {
            width: 44px; height: 44px; border-radius: 10px;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; overflow: hidden; padding: 3px;
        }
        .sidebar .brand .logo-badge img { height: 100%; width: 100%; object-fit: contain; }
        .sidebar .brand .brand-fallback {
            width: 44px; height: 44px; border-radius: 10px;
            background: linear-gradient(135deg, var(--brand-red) 0%, var(--brand-red-dark) 100%);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .95rem; color: #fff; flex-shrink: 0;
        }
        .sidebar .brand-text { font-weight: 700; font-size: .95rem; line-height: 1.2; }
        .sidebar .brand-text small { display: block; font-weight: 400; opacity: .65; font-size: .68rem; letter-spacing: .03em; }

        .sidebar nav { padding: .5rem 0; }
        .sidebar a.nav-link {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .68rem 1.1rem;
            color: rgba(255,255,255,.72);
            text-decoration: none;
            font-size: .88rem;
            font-weight: 500;
            border-left: 3px solid transparent;
        }
        .sidebar a.nav-link i { font-size: 1.05rem; width: 1.2rem; text-align: center; }
        .sidebar a.nav-link:hover { background: rgba(255,255,255,.06); color: #fff; }
        .sidebar a.nav-link.active {
            background: rgba(216,31,42,.15);
            color: #fff;
            border-left-color: var(--brand-red);
        }
        .sidebar .nav-divider {
            padding: .8rem 1.1rem .3rem;
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: rgba(255,255,255,.35);
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 1035;
        }
        .sidebar-backdrop.show { display: block; }

        /* ---------- Topbar ---------- */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            background: #fff;
            border-bottom: 1px solid #e6e8ee;
            padding: .7rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .5rem;
        }
        .btn-hamburger {
            border: none;
            background: transparent;
            font-size: 1.4rem;
            color: var(--brand-navy);
            padding: .2rem .4rem;
            line-height: 1;
        }
        .topbar-title { font-weight: 600; font-size: 1.02rem; margin: 0; }
        .user-chip {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .85rem;
        }
        .user-chip .avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: var(--brand-navy); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: .8rem;
        }

        /* ---------- Content ---------- */
        .content-wrapper { min-height: 100vh; }
        .content-inner { padding: 1rem; }

        .card {
            border-radius: 12px;
            transition: box-shadow .2s ease, transform .2s ease;
        }
        .card.shadow-sm:hover {
            box-shadow: 0 .5rem 1.25rem rgba(20,22,31,.1) !important;
            transform: translateY(-1px);
        }
        .card-header-dark {
            background: linear-gradient(90deg, var(--brand-navy) 0%, var(--brand-dark) 100%);
            color: #fff;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
        }
        .btn { transition: all .15s ease; }
        .btn-primary {
            background: var(--brand-red);
            border-color: var(--brand-red);
        }
        .btn-primary:hover, .btn-primary:focus {
            background: var(--brand-red-dark);
            border-color: var(--brand-red-dark);
            transform: translateY(-1px);
        }
        .btn-outline-primary {
            color: var(--brand-red);
            border-color: var(--brand-red);
        }
        .btn-outline-primary:hover {
            background: var(--brand-red);
            border-color: var(--brand-red);
        }
        .btn-sm:active { transform: scale(.96); }
        .text-primary { color: var(--brand-red) !important; }
        a { color: var(--brand-red); }
        a:hover { color: var(--brand-red-dark); }
        table.table-sm td, table.table-sm th { vertical-align: middle; }
        .table-hover tbody tr:hover { background-color: rgba(216,31,42,.04); }
        .table thead th {
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .03em;
            color: #6b7280;
        }
        ::selection { background: rgba(216,31,42,.2); }
        .nav-link, .btn, .page-link { outline: none; }
        .form-control:focus, .form-select:focus {
            border-color: var(--brand-red);
            box-shadow: 0 0 0 .2rem rgba(216,31,42,.15);
        }
        .page-link { color: var(--brand-navy); }
        .page-item.active .page-link { background: var(--brand-red); border-color: var(--brand-red); }

        /* ---------- Desktop: fixed sidebar always visible ---------- */
        @media (min-width: 992px) {
            .sidebar { transform: translateX(0); }
            .sidebar-backdrop { display: none !important; }
            .content-wrapper { margin-left: var(--sidebar-width); }
            .btn-hamburger { display: none; }
            .content-inner { padding: 1.5rem 2rem; }
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <?php $logoFile = FCPATH . 'assets/img/logo-adespeedshop.png'; ?>
            <?php if (is_file($logoFile)) : ?>
                <div class="logo-badge">
                    <img src="<?= base_url('assets/img/logo-adespeedshop.png') ?>" alt="ADM Logo">
                </div>
            <?php else : ?>
                <div class="brand-fallback">ADM</div>
            <?php endif ?>
            <div class="brand-text">
                ADM Motor Parts
                <small>High Performance — Est. 2026</small>
            </div>
        </div>
        <nav>
            <a href="<?= site_url('dashboard') ?>" class="nav-link <?= ($active ?? '') === 'dashboard' ? 'active' : '' ?>">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <div class="nav-divider">Penjualan</div>
            <a href="<?= site_url('master-produk') ?>" class="nav-link <?= ($active ?? '') === 'master-produk' ? 'active' : '' ?>">
                <i class="fa-solid fa-box"></i> Master Produk
            </a>
            <a href="<?= site_url('penjualan-shopee') ?>" class="nav-link <?= ($active ?? '') === 'penjualan-shopee' ? 'active' : '' ?>">
                <i class="fa-solid fa-bag-shopping"></i> Penjualan Shopee
            </a>
            <a href="<?= site_url('penjualan-offline') ?>" class="nav-link <?= ($active ?? '') === 'penjualan-offline' ? 'active' : '' ?>">
                <i class="fa-solid fa-shop"></i> Penjualan Offline
            </a>
            <a href="<?= site_url('preorder') ?>" class="nav-link <?= ($active ?? '') === 'preorder' ? 'active' : '' ?>">
                <i class="fa-solid fa-hourglass-half"></i> Preorder
            </a>

            <div class="nav-divider">Laporan &amp; Keuangan</div>
            <a href="<?= site_url('ringkasan') ?>" class="nav-link <?= ($active ?? '') === 'ringkasan' ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-line"></i> Ringkasan Penjualan
            </a>
            <a href="<?= site_url('mutasi') ?>" class="nav-link <?= ($active ?? '') === 'mutasi' ? 'active' : '' ?>">
                <i class="fa-solid fa-money-bill-wave"></i> Mutasi Kas
            </a>
            <a href="<?= site_url('invoice') ?>" class="nav-link <?= ($active ?? '') === 'invoice' ? 'active' : '' ?>">
                <i class="fa-solid fa-receipt"></i> Invoice
            </a>

            <div class="nav-divider">Akun</div>
            <a href="<?= site_url('logout') ?>" class="nav-link">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </nav>
    </div>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="content-wrapper">
        <div class="topbar">
            <div class="d-flex align-items-center gap-2">
                <button class="btn-hamburger" id="btnToggleSidebar" type="button" aria-label="Menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h5 class="topbar-title"><?= esc($title ?? 'Dashboard') ?></h5>
            </div>
            <div class="user-chip">
                <div class="avatar"><?= esc(strtoupper(substr(session()->get('name') ?? 'A', 0, 1))) ?></div>
                <span class="d-none d-sm-inline"><?= esc(session()->get('name') ?? '') ?></span>
            </div>
        </div>

        <div class="content-inner">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif ?>
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
