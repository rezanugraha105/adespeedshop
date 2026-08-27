<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ADM Motor Parts &amp; Accessories — Baut Titanium Performa Tinggi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ADM Motor Parts & Accessories — baut titanium high performance untuk motor Anda. Pesan lewat WhatsApp atau Shopee.">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/favicon-32.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/favicon-180.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --brand-dark: #0f1117;
            --brand-navy: #1b2130;
            --brand-navy-light: #2a3346;
            --brand-red: #d81f2a;
            --brand-red-dark: #a3141d;
            --brand-red-light: #ff4757;
            --brand-shopee: #ee4d2d;
            --brand-wa: #25d366;
            --ease: cubic-bezier(.4, 0, .2, 1);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Poppins', system-ui, sans-serif;
            color: #24262f;
            overflow-x: hidden;
            background: #fff;
        }
        h1, h2, h3, .display-font { font-family: 'Sora', 'Poppins', sans-serif; }
        ::selection { background: rgba(216,31,42,.2); }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f4; }
        ::-webkit-scrollbar-thumb { background: var(--brand-red); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--brand-red-dark); }

        .btn { font-weight: 600; transition: all .3s var(--ease); position: relative; overflow: hidden; }
        .btn-wa { background: var(--brand-wa); color: #fff; border: none; }
        .btn-wa:hover { background: #1eb256; color: #fff; transform: translateY(-3px); box-shadow: 0 12px 24px rgba(37,211,102,.35); }
        .btn-shopee { background: var(--brand-shopee); color: #fff; border: none; }
        .btn-shopee:hover { background: #d43f21; color: #fff; transform: translateY(-3px); box-shadow: 0 12px 24px rgba(238,77,45,.35); }
        .btn-outline-light-red { border: 2px solid rgba(255,255,255,.5); color: #fff; background: transparent; }
        .btn-outline-light-red:hover { border-color: #fff; background: rgba(255,255,255,.12); color: #fff; }
        .btn-lg { border-radius: 12px; }

        .section-label {
            display: inline-flex; align-items: center; gap: .4rem;
            font-size: .74rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
            color: var(--brand-red); background: rgba(216,31,42,.08);
            padding: .4rem .9rem; border-radius: 999px; margin-bottom: 1rem;
        }
        .section-label i { font-size: .65rem; }
        .section-title { font-weight: 800; font-size: clamp(1.7rem, 3.2vw, 2.5rem); letter-spacing: -.01em; }
        .section-sub { color: #6b7280; max-width: 560px; margin-left: auto; margin-right: auto; }

        /* ================= Navbar ================= */
        .navbar-adm {
            background: transparent;
            padding: 1.1rem 0;
            transition: background .35s var(--ease), padding .35s var(--ease), box-shadow .35s var(--ease);
        }
        .navbar-adm.scrolled {
            background: rgba(15,17,23,.92);
            backdrop-filter: blur(10px);
            padding: .6rem 0;
            box-shadow: 0 6px 24px rgba(0,0,0,.25);
        }
        .navbar-adm .navbar-brand { display: flex; align-items: center; gap: .6rem; color: #fff; font-weight: 700; font-family: 'Sora', sans-serif; }
        .navbar-adm .logo-badge {
            width: 42px; height: 42px; border-radius: 10px; background: #fff;
            display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 4px;
            transition: transform .3s var(--ease);
        }
        .navbar-brand:hover .logo-badge { transform: rotate(-8deg) scale(1.05); }
        .navbar-adm .logo-badge img { width: 100%; height: 100%; object-fit: contain; }
        .navbar-adm .nav-link {
            color: rgba(255,255,255,.78) !important; font-weight: 500; font-size: .92rem;
            position: relative; margin: 0 .2rem; transition: color .25s var(--ease);
        }
        .navbar-adm .nav-link::after {
            content: ''; position: absolute; left: 50%; bottom: -2px; width: 0; height: 2px;
            background: var(--brand-red); transition: all .3s var(--ease); transform: translateX(-50%);
        }
        .navbar-adm .nav-link:hover, .navbar-adm .nav-link.active { color: #fff !important; }
        .navbar-adm .nav-link:hover::after, .navbar-adm .nav-link.active::after { width: 60%; }
        .navbar-adm .navbar-toggler { border-color: rgba(255,255,255,.3); }
        .navbar-adm .navbar-toggler:focus { box-shadow: none; }

        /* ================= Hero ================= */
        .hero {
            background: radial-gradient(circle at 15% 15%, #262c3d 0%, var(--brand-dark) 55%);
            color: #fff; padding: 8.5rem 0 6rem; position: relative; overflow: hidden; min-height: 92vh;
            display: flex; align-items: center;
        }
        .hero-blob {
            position: absolute; border-radius: 50%; filter: blur(60px); opacity: .35;
            animation: float 9s ease-in-out infinite;
        }
        .hero-blob.b1 { width: 420px; height: 420px; background: radial-gradient(circle, var(--brand-red) 0%, transparent 70%); top: -140px; right: -100px; }
        .hero-blob.b2 { width: 320px; height: 320px; background: radial-gradient(circle, #3b4befb0 0%, transparent 70%); bottom: -100px; left: -80px; animation-delay: -3s; }
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(20px, -30px) scale(1.08); }
        }
        .hero-gear {
            position: absolute; right: -60px; bottom: -60px; font-size: 22rem; color: rgba(255,255,255,.03);
            animation: spin 60s linear infinite;
        }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        .hero-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15);
            padding: .5rem 1.1rem; border-radius: 999px; font-size: .8rem; margin-bottom: 1.4rem;
            backdrop-filter: blur(6px);
        }
        .hero-badge .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--brand-wa); animation: pulse-dot 1.6s infinite; }
        @keyframes pulse-dot {
            0% { box-shadow: 0 0 0 0 rgba(37,211,102,.6); }
            70% { box-shadow: 0 0 0 8px rgba(37,211,102,0); }
            100% { box-shadow: 0 0 0 0 rgba(37,211,102,0); }
        }
        .hero h1 { font-weight: 800; font-size: clamp(2.1rem, 4.5vw, 3.2rem); line-height: 1.15; letter-spacing: -.02em; }
        .hero h1 .highlight { color: var(--brand-red-light); position: relative; white-space: nowrap; }
        .hero .lead { color: rgba(255,255,255,.72); font-size: 1.08rem; max-width: 540px; }

        .hero-logo-wrap {
            width: 100%; max-width: 320px; margin: 0 auto; position: relative;
            background: linear-gradient(160deg, #fff 0%, #f4f5f8 100%); border-radius: 24px; padding: 2.2rem;
            box-shadow: 0 30px 70px rgba(0,0,0,.45);
            animation: floaty 5s ease-in-out infinite;
        }
        @keyframes floaty {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-14px); }
        }
        .hero-logo-wrap img { width: 100%; height: auto; display: block; }
        .floating-chip {
            position: absolute; background: #fff; border-radius: 14px; padding: .6rem .9rem;
            box-shadow: 0 12px 30px rgba(0,0,0,.25); display: flex; align-items: center; gap: .5rem;
            font-size: .78rem; font-weight: 700; color: var(--brand-navy);
            animation: floaty 4.5s ease-in-out infinite;
        }
        .floating-chip.chip-1 { top: 6%; left: -8%; animation-delay: -1s; }
        .floating-chip.chip-2 { bottom: 8%; right: -10%; animation-delay: -2.4s; }
        .floating-chip i { color: var(--brand-red); font-size: 1rem; }

        .scroll-cue {
            position: absolute; bottom: 26px; left: 50%; transform: translateX(-50%);
            color: rgba(255,255,255,.55); font-size: .75rem; text-align: center; letter-spacing: .05em;
        }
        .scroll-cue .chevron { animation: bounce-y 1.8s infinite; margin-top: .3rem; }
        @keyframes bounce-y {
            0%, 100% { transform: translateY(0); opacity: .5; }
            50% { transform: translateY(8px); opacity: 1; }
        }

        .wave-divider {
            position: absolute; left: 0; right: 0; bottom: -1px;
            display: block; width: 100%; line-height: 0; z-index: 1; pointer-events: none;
        }
        .wave-divider svg { width: 100%; height: 70px; display: block; }
        @media (max-width: 767.98px) {
            .wave-divider svg { height: 34px; }
        }

        /* ================= Stats ================= */
        .stat-strip { background: #fff; padding-top: 1rem; }
        .stat-card {
            background: #fff; border-radius: 16px; box-shadow: 0 .6rem 1.8rem rgba(20,22,31,.07);
            padding: 1.5rem 1rem; text-align: center; height: 100%; border: 1px solid #f0f1f4;
            transition: transform .35s var(--ease), box-shadow .35s var(--ease), border-color .35s var(--ease);
        }
        .stat-card:hover { transform: translateY(-8px); box-shadow: 0 1.2rem 2.6rem rgba(20,22,31,.13); border-color: rgba(216,31,42,.15); }
        .stat-card .stat-icon-wrap {
            width: 56px; height: 56px; border-radius: 16px; margin: 0 auto .8rem;
            background: linear-gradient(135deg, rgba(216,31,42,.12), rgba(216,31,42,.04));
            display: flex; align-items: center; justify-content: center;
            transition: transform .35s var(--ease);
        }
        .stat-card:hover .stat-icon-wrap { transform: rotate(-8deg) scale(1.08); }
        .stat-card i { font-size: 1.5rem; color: var(--brand-red); }
        .stat-number { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 1.6rem; color: var(--brand-navy); }
        .stat-title { font-weight: 600; font-size: .85rem; margin-top: .1rem; }
        .stat-sub { font-size: .76rem; color: #6b7280; }

        /* ================= Products ================= */
        .produk-card {
            border-radius: 18px; overflow: hidden; height: 100%; background: #fff;
            box-shadow: 0 .5rem 1.4rem rgba(20,22,31,.06); border: 1px solid #eef0f4;
            transition: transform .4s var(--ease), box-shadow .4s var(--ease);
            will-change: transform;
        }
        .produk-card:hover { box-shadow: 0 1.6rem 3rem rgba(20,22,31,.16); }
        .produk-card .produk-thumb {
            height: 160px; position: relative; overflow: hidden;
            background: linear-gradient(135deg, var(--brand-navy) 0%, var(--brand-dark) 100%);
            display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,.55);
            font-size: 2.6rem;
        }
        .produk-card .produk-thumb::before {
            content: ''; position: absolute; inset: 0;
            background: repeating-linear-gradient(45deg, rgba(255,255,255,.04) 0 2px, transparent 2px 14px);
        }
        .produk-card .produk-thumb i { transition: transform .5s var(--ease); position: relative; z-index: 1; }
        .produk-card:hover .produk-thumb i { transform: scale(1.15) rotate(8deg); }
        .produk-card .produk-badge {
            position: absolute; top: 10px; left: 10px; z-index: 2;
            background: var(--brand-red); color: #fff; font-size: .65rem; font-weight: 700;
            padding: .25rem .6rem; border-radius: 999px; letter-spacing: .03em;
        }
        .produk-card .produk-body { padding: 1.1rem; }
        .produk-card .produk-kode { font-size: .7rem; color: #9aa0ab; text-transform: uppercase; letter-spacing: .05em; font-weight: 600; }
        .produk-card .produk-nama { font-weight: 700; font-size: .96rem; min-height: 2.6em; margin: .25rem 0 .5rem; }
        .produk-card .produk-harga { font-weight: 800; color: var(--brand-red); font-size: 1.15rem; font-family: 'Sora', sans-serif; }
        .produk-card .btn-sm { border-radius: 9px; }

        /* ================= Feature cards ================= */
        .feature-card {
            padding: 1.75rem 1.5rem; height: 100%; border-radius: 18px;
            transition: transform .35s var(--ease), box-shadow .35s var(--ease);
        }
        .feature-card:hover { transform: translateY(-6px); box-shadow: 0 1.4rem 2.8rem rgba(20,22,31,.1); }
        .feature-icon {
            width: 60px; height: 60px; border-radius: 16px;
            background: linear-gradient(135deg, var(--brand-red) 0%, var(--brand-red-dark) 100%);
            display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.5rem;
            margin-bottom: 1.1rem; transition: transform .4s var(--ease);
            box-shadow: 0 10px 20px rgba(216,31,42,.25);
        }
        .feature-card:hover .feature-icon { transform: rotate(-10deg) scale(1.1); }
        .feature-card h5 { font-weight: 700; }
        .feature-card p { color: #6b7280; font-size: .9rem; margin-bottom: 0; }

        /* ================= Steps / timeline ================= */
        .steps-wrap { position: relative; }
        .steps-line {
            position: absolute; top: 24px; left: 12%; right: 12%; height: 2px;
            background: repeating-linear-gradient(90deg, #dcdfe6 0 8px, transparent 8px 16px);
            display: none;
        }
        @media (min-width: 768px) { .steps-line { display: block; } }
        .step-item { text-align: center; padding: 1rem; position: relative; }
        .step-number {
            width: 50px; height: 50px; border-radius: 50%; position: relative; z-index: 1;
            background: var(--brand-navy); color: #fff; font-weight: 700; font-family: 'Sora', sans-serif;
            display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;
            transition: transform .35s var(--ease), background .35s var(--ease);
            box-shadow: 0 8px 20px rgba(27,33,48,.25);
        }
        .step-item:hover .step-number { background: var(--brand-red); transform: scale(1.12); }

        /* ================= FAQ ================= */
        .faq-accordion .accordion-item { border: none; margin-bottom: .8rem; border-radius: 14px !important; overflow: hidden; box-shadow: 0 .3rem 1rem rgba(20,22,31,.05); }
        .faq-accordion .accordion-button { font-weight: 600; font-size: .95rem; padding: 1.1rem 1.3rem; }
        .faq-accordion .accordion-button:not(.collapsed) { background: rgba(216,31,42,.06); color: var(--brand-red); box-shadow: none; }
        .faq-accordion .accordion-button:focus { box-shadow: none; border-color: transparent; }
        .faq-accordion .accordion-body { color: #6b7280; font-size: .9rem; padding: 0 1.3rem 1.2rem; }

        /* ================= CTA banner ================= */
        .cta-banner {
            background: linear-gradient(120deg, var(--brand-navy) 0%, var(--brand-dark) 50%, var(--brand-navy-light) 100%);
            background-size: 200% 200%;
            animation: gradient-shift 8s ease infinite;
            color: #fff; border-radius: 24px; padding: 3.5rem 2rem; text-align: center; position: relative; overflow: hidden;
        }
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .cta-banner .cta-glow {
            position: absolute; width: 300px; height: 300px; border-radius: 50%;
            background: radial-gradient(circle, rgba(216,31,42,.35) 0%, transparent 70%);
            top: -80px; left: -60px; animation: float 7s ease-in-out infinite;
        }

        /* ================= Footer ================= */
        .footer-adm { background: var(--brand-dark); color: rgba(255,255,255,.68); padding: 4rem 0 1.5rem; }
        .footer-adm h6 { color: #fff; font-weight: 700; margin-bottom: 1.1rem; font-family: 'Sora', sans-serif; }
        .footer-adm a { color: rgba(255,255,255,.65); text-decoration: none; transition: color .25s var(--ease), padding-left .25s var(--ease); }
        .footer-adm a:hover { color: #fff; padding-left: 4px; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.1); margin-top: 2.5rem; padding-top: 1.5rem; font-size: .82rem; }
        .footer-social a {
            width: 38px; height: 38px; border-radius: 50%; background: rgba(255,255,255,.08);
            display: inline-flex; align-items: center; justify-content: center; margin-right: .5rem;
            transition: all .3s var(--ease);
        }
        .footer-social a:hover { background: var(--brand-red); transform: translateY(-4px); padding-left: 0; }

        /* ================= Floating buttons ================= */
        .fab-stack { position: fixed; right: 20px; bottom: 20px; z-index: 1050; display: flex; flex-direction: column; align-items: flex-end; gap: .7rem; }
        .fab-btn {
            width: 54px; height: 54px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #fff; box-shadow: 0 .6rem 1.4rem rgba(0,0,0,.25);
            transition: transform .3s var(--ease), opacity .3s var(--ease), box-shadow .3s var(--ease);
        }
        .fab-btn:hover { transform: translateY(-4px) scale(1.06); color: #fff; }
        .fab-wa { background: var(--brand-wa); animation: fab-pulse 2.4s infinite; }
        @keyframes fab-pulse {
            0% { box-shadow: 0 0 0 0 rgba(37,211,102,.5); }
            70% { box-shadow: 0 0 0 16px rgba(37,211,102,0); }
            100% { box-shadow: 0 0 0 0 rgba(37,211,102,0); }
        }
        .fab-top { background: var(--brand-navy); opacity: 0; visibility: hidden; transform: translateY(10px); font-size: 1.1rem; }
        .fab-top.show { opacity: 1; visibility: visible; transform: translateY(0); }

        [data-aos] { transition-timing-function: var(--ease) !important; }

        @media (max-width: 767.98px) {
            .hero { padding: 7rem 0 4rem; text-align: center; min-height: auto; }
            .hero .lead { margin-left: auto; margin-right: auto; }
            .hero-logo-wrap { margin-top: 3rem; max-width: 220px; }
            .floating-chip { display: none; }
            .hero-gear { font-size: 14rem; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-adm fixed-top" id="mainNav" data-bs-spy="scroll" data-bs-target="#mainNav">
    <div class="container">
        <a class="navbar-brand" href="#home">
            <?php $logoFile = FCPATH . 'assets/img/logo-adespeedshop.png'; ?>
            <?php if (is_file($logoFile)) : ?>
                <span class="logo-badge"><img src="<?= base_url('assets/img/logo-adespeedshop.png') ?>" alt="Logo"></span>
            <?php endif ?>
            ADM Motor Parts
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto mb-3 mb-lg-0 align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="#kenapa">Kenapa Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                <li class="nav-item mt-2 mt-lg-0">
                    <a href="<?= site_url('login') ?>" class="btn btn-outline-light-red btn-sm px-3">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero" id="home">
    <div class="hero-blob b1"></div>
    <div class="hero-blob b2"></div>
    <i class="fa-solid fa-gear hero-gear"></i>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right" data-aos-duration="800">
                <span class="hero-badge"><span class="dot"></span> Siap Melayani — High Performance Est. 2026</span>
                <h1>Baut Titanium <span class="highlight">Presisi Tinggi</span> untuk Motor Kesayangan Anda</h1>
                <p class="lead mt-3 mb-4">Ringan, kuat, dan tahan karat. ADM Motor Parts &amp; Accessories menyediakan baut titanium grade tinggi yang dirancang khusus untuk performa maksimal motor Anda.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?= esc($waLink) ?>" target="_blank" class="btn btn-wa btn-lg px-4">
                        <i class="fa-brands fa-whatsapp me-2"></i> Chat WhatsApp
                    </a>
                    <a href="<?= esc($shopeeLink) ?>" target="_blank" class="btn btn-shopee btn-lg px-4">
                        <i class="fa-solid fa-bag-shopping me-2"></i> Beli di Shopee
                    </a>
                </div>
            </div>
            <div class="col-lg-5 position-relative" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">
                <?php if (is_file($logoFile)) : ?>
                    <div class="hero-logo-wrap">
                        <img src="<?= base_url('assets/img/logo-adespeedshop.png') ?>" alt="ADM Motor Parts Logo">
                        <div class="floating-chip chip-1"><i class="fa-solid fa-shield-halved"></i> Garansi Kualitas</div>
                        <div class="floating-chip chip-2"><i class="fa-solid fa-bolt"></i> Titanium Grade 5</div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <a href="#produk" class="scroll-cue d-none d-md-block text-decoration-none">
        SCROLL
        <div class="chevron"><i class="fa-solid fa-chevron-down"></i></div>
    </a>
    <div class="wave-divider">
        <svg viewBox="0 0 1440 70" preserveAspectRatio="none"><path fill="#ffffff" d="M0,32L60,37.3C120,43,240,53,360,50.7C480,48,600,32,720,26.7C840,21,960,27,1080,32C1200,37,1320,43,1380,45.3L1440,48L1440,70L1380,70C1320,70,1200,70,1080,70C960,70,840,70,720,70C600,70,480,70,360,70C240,70,120,70,60,70L0,70Z"></path></svg>
    </div>
</section>

<section class="stat-strip pb-2">
    <div class="container">
        <div class="row g-3" style="margin-top:-3.5rem;">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-card">
                    <div class="stat-icon-wrap"><i class="fa-solid fa-certificate"></i></div>
                    <div class="stat-number" data-count="100">0</div>
                    <div class="stat-title">% Original</div>
                    <div class="stat-sub">Material titanium asli</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-icon-wrap"><i class="fa-solid fa-shield-halved"></i></div>
                    <div class="stat-number">Terjamin</div>
                    <div class="stat-title">Garansi Kualitas</div>
                    <div class="stat-sub">Teruji sebelum kirim</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-icon-wrap"><i class="fa-solid fa-bullseye"></i></div>
                    <div class="stat-number">CNC</div>
                    <div class="stat-title">Presisi Tinggi</div>
                    <div class="stat-sub">Toleransi minim</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-icon-wrap"><i class="fa-solid fa-truck-fast"></i></div>
                    <div class="stat-number" data-count="34">0</div>
                    <div class="stat-title">Provinsi Terjangkau</div>
                    <div class="stat-sub">Pengiriman ke seluruh RI</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 mt-4" id="produk">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-label"><i class="fa-solid fa-star"></i> Produk Unggulan</span>
            <h2 class="section-title">Pilihan Baut Titanium Terbaik</h2>
            <p class="section-sub mt-2">Beberapa produk andalan kami — hubungi kami untuk katalog lengkap dan ukuran custom.</p>
        </div>
        <?php if (empty($produk)) : ?>
            <p class="text-center text-muted">Produk akan segera ditambahkan.</p>
        <?php else : ?>
            <div class="row g-4">
                <?php foreach ($produk as $i => $p) : ?>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= ($i % 4) * 100 ?>">
                        <div class="produk-card" data-tilt>
                            <div class="produk-thumb">
                                <span class="produk-badge">Tersedia</span>
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                            </div>
                            <div class="produk-body">
                                <div class="produk-kode"><?= esc($p['kode_produk']) ?></div>
                                <div class="produk-nama"><?= esc($p['nama_produk']) ?></div>
                                <div class="produk-harga mb-2">Rp<?= number_format($p['harga_jual_offline'], 0, ',', '.') ?></div>
                                <div class="d-grid gap-2">
                                    <a href="<?= esc($waLinkFor($p['nama_produk'])) ?>" target="_blank" class="btn btn-wa btn-sm">
                                        <i class="fa-brands fa-whatsapp me-1"></i> Pesan
                                    </a>
                                    <a href="<?= esc($shopeeLink) ?>" target="_blank" class="btn btn-outline-secondary btn-sm">
                                        <i class="fa-solid fa-bag-shopping me-1"></i> Shopee
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</section>

<section class="py-5 bg-light" id="kenapa">
    <div class="container py-3">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-label"><i class="fa-solid fa-thumbs-up"></i> Kenapa Pilih Kami</span>
            <h2 class="section-title">Keunggulan ADM Motor Parts</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-card bg-white shadow-sm">
                    <div class="feature-icon"><i class="fa-solid fa-atom"></i></div>
                    <h5>Titanium Grade Tinggi</h5>
                    <p>Material titanium pilihan yang ringan namun tetap kuat menahan beban tinggi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card bg-white shadow-sm">
                    <div class="feature-icon"><i class="fa-solid fa-bullseye"></i></div>
                    <h5>Presisi CNC</h5>
                    <p>Diproduksi dengan mesin CNC presisi untuk hasil yang konsisten dan akurat.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card bg-white shadow-sm">
                    <div class="feature-icon"><i class="fa-solid fa-motorcycle"></i></div>
                    <h5>Cocok Segala Jenis Motor</h5>
                    <p>Tersedia berbagai ukuran yang sesuai untuk motor matic, sport, hingga trail.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card bg-white shadow-sm">
                    <div class="feature-icon"><i class="fa-solid fa-tags"></i></div>
                    <h5>Harga Bersaing</h5>
                    <p>Kualitas performa tinggi dengan harga yang tetap ramah di kantong.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" id="cara">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-label"><i class="fa-solid fa-route"></i> Cara Pemesanan</span>
            <h2 class="section-title">Belanja Mudah dalam 3 Langkah</h2>
        </div>
        <div class="steps-wrap">
            <div class="steps-line"></div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="0">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <h6 class="fw-bold">Pilih Produk</h6>
                        <p class="text-muted small mb-0">Lihat katalog produk kami dan pilih yang sesuai kebutuhan motor Anda.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <h6 class="fw-bold">Chat WA / Checkout Shopee</h6>
                        <p class="text-muted small mb-0">Hubungi kami via WhatsApp atau langsung checkout melalui toko Shopee kami.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <h6 class="fw-bold">Terima Barang</h6>
                        <p class="text-muted small mb-0">Pesanan dikemas rapi dan dikirim ke alamat Anda secepat mungkin.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="faq">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-label"><i class="fa-solid fa-circle-question"></i> FAQ</span>
            <h2 class="section-title">Pertanyaan yang Sering Ditanyakan</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="accordion faq-accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apakah produk yang dijual 100% original?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Ya, seluruh produk baut titanium yang kami jual adalah material asli dan melalui pengecekan kualitas sebelum dikirim ke pelanggan.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Bagaimana cara memesan produk?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Anda bisa memesan langsung melalui chat WhatsApp kami untuk konsultasi ukuran, atau checkout langsung melalui toko resmi kami di Shopee.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apakah bisa custom ukuran baut?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Bisa. Hubungi kami via WhatsApp dan sebutkan ukuran/spesifikasi motor Anda, tim kami akan bantu rekomendasikan ukuran yang sesuai.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah pengiriman melayani seluruh Indonesia?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Ya, kami melayani pengiriman ke seluruh Indonesia melalui ekspedisi rekanan Shopee maupun pengiriman yang diatur langsung via WhatsApp.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="cta-banner" data-aos="zoom-in">
            <div class="cta-glow"></div>
            <div class="position-relative">
                <h2 class="fw-bold mb-2">Siap Upgrade Performa Motor Anda?</h2>
                <p class="mb-4" style="color:rgba(255,255,255,.75);">Konsultasi gratis produk yang cocok untuk motor Anda — chat kami sekarang.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="<?= esc($waLink) ?>" target="_blank" class="btn btn-wa btn-lg px-4">
                        <i class="fa-brands fa-whatsapp me-2"></i> Chat WhatsApp
                    </a>
                    <a href="<?= esc($shopeeLink) ?>" target="_blank" class="btn btn-shopee btn-lg px-4">
                        <i class="fa-solid fa-bag-shopping me-2"></i> Beli di Shopee
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer-adm" id="kontak">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <?php if (is_file($logoFile)) : ?>
                        <span style="width:40px;height:40px;background:#fff;border-radius:9px;display:flex;align-items:center;justify-content:center;overflow:hidden;padding:3px;">
                            <img src="<?= base_url('assets/img/logo-adespeedshop.png') ?>" alt="Logo" style="width:100%;height:100%;object-fit:contain;">
                        </span>
                    <?php endif ?>
                    <span class="text-white fw-bold"><?= esc($company['name']) ?></span>
                </div>
                <p class="small">Baut titanium high performance untuk motor Anda. Ringan, kuat, presisi tinggi.</p>
                <div class="footer-social mt-3">
                    <a href="<?= esc($waLink) ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="<?= esc($shopeeLink) ?>" target="_blank"><i class="fa-solid fa-bag-shopping"></i></a>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <h6>Tautan</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#home">Beranda</a></li>
                    <li class="mb-2"><a href="#produk">Produk</a></li>
                    <li class="mb-2"><a href="#kenapa">Kenapa Kami</a></li>
                    <li class="mb-2"><a href="#faq">FAQ</a></li>
                    <li class="mb-2"><a href="<?= site_url('login') ?>">Login Admin</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4">
                <h6>Kontak</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="<?= esc($waLink) ?>" target="_blank"><i class="fa-brands fa-whatsapp me-2"></i>+62 812-8049-2796</a></li>
                    <li class="mb-2"><a href="<?= esc($shopeeLink) ?>" target="_blank"><i class="fa-solid fa-bag-shopping me-2"></i>Toko Shopee Kami</a></li>
                    <?php if (! empty($company['address'])) : ?>
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2"></i><?= esc($company['address']) ?></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
        <div class="footer-bottom text-center">
            &copy; <?= date('Y') ?> <?= esc($company['name']) ?>. All rights reserved.
        </div>
    </div>
</footer>

<div class="fab-stack">
    <a href="#home" class="fab-btn fab-top" id="btnBackTop" title="Kembali ke atas">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
    <a href="<?= esc($waLink) ?>" target="_blank" class="fab-btn fab-wa" title="Chat WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 700, once: true, offset: 60, easing: 'ease-out-cubic' });

    var navbar = document.getElementById('mainNav');
    var backTop = document.getElementById('btnBackTop');
    window.addEventListener('scroll', function () {
        var scrolled = window.scrollY > 40;
        navbar.classList.toggle('scrolled', scrolled);
        backTop.classList.toggle('show', window.scrollY > 500);
    });

    document.querySelectorAll('.stat-number[data-count]').forEach(function (el) {
        var target = parseInt(el.getAttribute('data-count'), 10);
        var started = false;
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !started) {
                    started = true;
                    var start = 0;
                    var duration = 1200;
                    var startTime = null;
                    function step(timestamp) {
                        if (!startTime) startTime = timestamp;
                        var progress = Math.min((timestamp - startTime) / duration, 1);
                        el.textContent = Math.floor(progress * (target - start) + start);
                        if (progress < 1) requestAnimationFrame(step);
                        else el.textContent = target;
                    }
                    requestAnimationFrame(step);
                }
            });
        }, { threshold: 0.4 });
        observer.observe(el);
    });

    if (window.matchMedia('(hover: hover)').matches) {
        document.querySelectorAll('[data-tilt]').forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var rect = card.getBoundingClientRect();
                var x = (e.clientX - rect.left) / rect.width - 0.5;
                var y = (e.clientY - rect.top) / rect.height - 0.5;
                card.style.transform = 'perspective(700px) rotateY(' + (x * 8) + 'deg) rotateX(' + (y * -8) + 'deg) translateY(-6px)';
            });
            card.addEventListener('mouseleave', function () {
                card.style.transform = 'perspective(700px) rotateY(0) rotateX(0) translateY(0)';
            });
        });
    }
</script>
</body>
</html>
