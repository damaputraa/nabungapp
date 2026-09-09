<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Administrasi - Yuk Nabung</title>
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
            background: radial-gradient(circle at top, #1e293b 0%, #0f172a 60%, #020617 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #1e293b;
        }

        .admin-login-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 42px 36px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.55), 0 0 0 1px rgba(255, 255, 255, 0.1);
            max-width: 440px;
            width: 100%;
            position: relative;
        }

        .admin-brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 9999px;
            margin-bottom: 14px;
            border: 1px solid #bfdbfe;
        }

        .admin-icon-box {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 10px 25px rgba(30, 64, 175, 0.4);
            margin-bottom: 14px;
        }

        .admin-title {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .admin-subtitle {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        .form-label {
            font-weight: 700;
            font-size: 13px;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .input-group-text {
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #64748b;
        }

        .form-control {
            border-radius: 0 12px 12px 0;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            font-size: 14px;
            color: #0f172a;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .input-group:focus-within .input-group-text {
            border-color: #2563eb;
            color: #2563eb;
        }

        .btn-admin-submit {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            border: none;
            border-radius: 12px;
            padding: 14px;
            width: 100%;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.35);
            transition: all 0.25s ease;
            margin-top: 12px;
        }

        .btn-admin-submit:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.45);
            color: #ffffff;
        }

        .admin-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            font-size: 13px;
            color: #64748b;
        }

        .user-portal-link {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 4px;
        }

        .user-portal-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .security-badge-bottom {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="admin-login-card">
        <div class="admin-brand-header">
            <div>
                <span class="admin-badge">
                    <i class="fas fa-shield-alt"></i> Panel Kontrol Keamanan
                </span>
            </div>
            <div class="admin-icon-box">
                <i class="fas fa-user-shield"></i>
            </div>
            <h2 class="admin-title">Portal Administrator</h2>
            <p class="admin-subtitle">Sistem manajemen sentral, target tabungan, dan pemantauan pengguna platform Yuk Nabung.</p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show p-3" role="alert" style="border-radius: 12px; font-size: 13px; background-color: #fef2f2; border-color: #fee2e2; color: #991b1b;">
            <div class="d-flex align-items-start">
                <i class="fas fa-exclamation-triangle mt-1 me-2" style="font-size: 16px;"></i>
                <div class="flex-grow-1">
                    <strong>Peringatan Akses:</strong><br>
                    <?= $this->session->flashdata('error') ?>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show p-3" role="alert" style="border-radius: 12px; font-size: 13px; background-color: #f0fdf4; border-color: #dcfce7; color: #166534;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2" style="font-size: 16px;"></i>
                <div class="flex-grow-1">
                    <?= $this->session->flashdata('success') ?>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>

        <form action="<?= site_url('admin/login') ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username atau Email Administrator</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan ID Administrator" value="<?= set_value('username') ?>" required autofocus>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi administrator" required>
                </div>
            </div>
            <button type="submit" class="btn btn-admin-submit">
                <i class="fas fa-lock-open me-2"></i> Masuk ke Panel Administrator
            </button>
        </form>

        <div class="admin-footer">
            <p class="mb-1">Bukan administrator?</p>
            <div>
                <a href="<?= site_url('auth/login') ?>" class="user-portal-link">
                    <i class="fas fa-arrow-left"></i> Masuk ke Portal Pengguna Biasa
                </a>
            </div>
            <div class="security-badge-bottom">
                <i class="fas fa-shield-alt"></i> Sesi terenkripsi & diawasi secara berkala
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>