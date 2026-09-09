<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anda Sedang Offline | Yuk Nabung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #1e293b;
            text-align: center;
            padding: 20px;
        }
        .offline-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .icon { font-size: 54px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="offline-card">
        <div class="icon">📶</div>
        <h4 class="font-weight-bold mb-2">Koneksi Terputus</h4>
        <p class="text-muted small mb-4">Anda sedang tidak terhubung ke jaringan internet. Silakan periksa koneksi Anda lalu muat ulang halaman.</p>
        <button class="btn btn-primary btn-block py-2 font-weight-bold" onclick="window.location.reload()" style="border-radius: 12px; background: #00a651; border: none;">
            Coba Lagi
        </button>
    </div>
</body>
</html>

