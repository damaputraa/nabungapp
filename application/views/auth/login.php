<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Yuk Nabung</title>
    <!-- Google Font & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px 34px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
            max-width: 420px;
            width: 100%;
            position: relative;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.35);
            margin-bottom: 12px;
        }

        .brand-title {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .brand-title span {
            color: #059669;
        }

        .brand-subtitle {
            font-size: 14px;
            color: #64748b;
        }

        .form-label {
            font-weight: 700;
            font-size: 13px;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            font-size: 14px;
            transition: all 0.25s ease;
        }

        .form-control:focus {
            border-color: #059669;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.12);
        }

        .btn-submit {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            border: none;
            border-radius: 9999px;
            padding: 13px;
            width: 100%;
            box-shadow: 0 6px 20px rgba(5, 150, 105, 0.35);
            transition: all 0.25s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(5, 150, 105, 0.45);
            color: #ffffff;
        }

        .auth-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            font-size: 14px;
            color: #64748b;
        }

        .auth-link {
            color: #059669;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            margin-top: 14px;
        }

        .back-link:hover {
            color: #0f172a;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand-header">
            <div class="brand-icon-box">
                <i class="fas fa-wallet"></i>
            </div>
            <h2 class="brand-title">Yuk<span>Nabung</span></h2>
            <div class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 font-weight-bold" style="font-size: 11px; border-radius: 20px;">
                <i class="fas fa-user mr-1"></i> PORTAL PENGGUNA
            </div>
            <p class="brand-subtitle">Masuk untuk mengelola tabungan & keuangan pribadimu</p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show p-3" role="alert" style="border-radius: 12px; font-size: 14px;">
            <i class="fas fa-exclamation-circle me-1"></i> <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show p-3" role="alert" style="border-radius: 12px; font-size: 14px;">
            <i class="fas fa-check-circle me-1"></i> <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if ($this->session->userdata('logged_in')): ?>
        <div class="alert alert-info d-flex align-items-center justify-content-between p-3 mb-3" style="border-radius: 12px; font-size: 13px;">
            <div>
                <i class="fas fa-info-circle me-1"></i> Sedang login: <strong><?= html_escape($this->session->userdata('username')) ?></strong> (<?= ucfirst($this->session->userdata('role')) ?>)
            </div>
            <div>
                <a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-primary py-1 px-2 me-1" style="font-size: 12px;">Dashboard</a>
                <a href="<?= site_url('auth/login?switch=1') ?>" class="btn btn-sm btn-outline-danger py-1 px-2" style="font-size: 12px;">Keluar / Ganti</a>
            </div>
        </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/login') ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username atau Email</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username atau email Anda" value="<?= set_value('username') ?>" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password Anda" required>
            </div>
            <button type="submit" class="btn btn-submit">
                <i class="fas fa-sign-in-alt me-1"></i> Masuk ke Akun
            </button>
        </form>

        <div class="auth-footer">
            <p class="mb-2">Belum memiliki akun? <a href="<?= site_url('auth/register') ?>" class="auth-link">Daftar sekarang</a></p>
            <div class="p-2 mb-2 rounded bg-light border" style="font-size: 12px;">
                <span class="text-muted">Administrator sistem?</span> 
                <a href="<?= site_url('admin/login') ?>" class="text-primary font-weight-bold" style="text-decoration: none;">
                    <i class="fas fa-shield-alt"></i> Masuk ke Portal Admin &rarr;
                </a>
            </div>
            <div>
                <a href="<?= site_url('landing') ?>" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
