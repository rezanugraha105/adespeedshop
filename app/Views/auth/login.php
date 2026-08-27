<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - ADM Motor Parts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-dark: #14161f;
            --brand-navy: #1b2130;
            --brand-red: #d81f2a;
            --brand-red-dark: #a3141d;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Poppins', system-ui, sans-serif;
            background: radial-gradient(circle at top left, #262c3d 0%, var(--brand-dark) 60%);
            padding: 1rem;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            margin: auto;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(0,0,0,.35);
        }
        .login-header {
            background: linear-gradient(135deg, var(--brand-navy) 0%, var(--brand-dark) 100%);
            color: #fff;
            padding: 2rem 1.5rem 1.6rem;
            text-align: center;
        }
        .login-header .logo-fallback {
            width: 64px; height: 64px; margin: 0 auto .75rem;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--brand-red) 0%, var(--brand-red-dark) 100%);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1.3rem;
        }
        .login-header .logo-badge {
            width: 84px; height: 84px; margin: 0 auto .6rem;
            border-radius: 16px; background: #fff;
            display: flex; align-items: center; justify-content: center;
            padding: 6px; overflow: hidden;
        }
        .login-header .logo-badge img { height: 100%; width: 100%; object-fit: contain; }
        .login-header a { text-decoration: none; display: block; transition: transform .2s ease; }
        .login-header a:hover { transform: translateY(-2px); }
        .login-header h4 { font-weight: 700; margin-bottom: .1rem; }
        .login-header small { opacity: .7; letter-spacing: .04em; }
        .login-body { padding: 2rem 1.75rem; background: #fff; }
        .form-label { font-weight: 500; font-size: .85rem; }
        .btn-primary {
            background: var(--brand-red);
            border-color: var(--brand-red);
            font-weight: 600;
            padding: .6rem;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: var(--brand-red-dark);
            border-color: var(--brand-red-dark);
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <div class="login-header">
            <?php $logoFile = FCPATH . 'assets/img/logo-adespeedshop.png'; ?>
            <a href="<?= site_url('/') ?>" title="Kembali ke halaman utama">
                <?php if (is_file($logoFile)) : ?>
                    <div class="logo-badge">
                        <img src="<?= base_url('assets/img/logo-adespeedshop.png') ?>" alt="ADM Logo">
                    </div>
                <?php else : ?>
                    <div class="logo-fallback">ADM</div>
                <?php endif ?>
            </a>
            <h4>ADM Motor Parts</h4>
            <small>DASHBOARD PENJUALAN &amp; STOK</small>
        </div>
        <div class="login-body">
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger py-2 small"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif ?>
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-success py-2 small"><?= esc(session()->getFlashdata('message')) ?></div>
            <?php endif ?>
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger py-2 small">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form action="<?= site_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>
