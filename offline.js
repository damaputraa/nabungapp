<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline - Yuk Nabung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #00a651, #00c853);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .offline-card {
            background: #fff;
            border-radius: 24px;
            padding: 40px 30px;
            max-width: 420px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.6s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .offline-card .icon {
            font-size: 64px;
            color: #00a651;
            margin-bottom: 15px;
        }
        .offline-card h2 {
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 10px;
        }
        .offline-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        .offline-card .btn {
            background: linear-gradient(135deg, #00a651, #00c853);
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .offline-card .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 166, 81, 0.3);
        }
        .offline-card .btn i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="offline-card">
        <div class="icon">
            <i class="fas fa-wifi-slash"></i>
        </div>
        <h2>😅 Offline!</h2>
        <p>
            Sepertinya kamu sedang tidak terhubung ke internet.<br>
            Beberapa fitur mungkin tidak tersedia.
        </p>
        <button class="btn" onclick="location.reload()">
            <i class="fas fa-sync"></i> Coba Lagi
        </button>
        <div style="margin-top: 15px;">
            <a href="<?= site_url('dashboard') ?>" style="color: #888; font-size: 13px; text-decoration: none;">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
        <div style="margin-top: 20px; font-size: 12px; color: #ccc;">
            Yuk Nabung v1.0
        </div>
    </div>
</body>
</html>
