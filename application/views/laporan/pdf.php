<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekening Koran - <?= htmlspecialchars($user->username) ?></title>
    <style>
        @page {
            margin: 25px 30px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 11px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #1a56db;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #1a56db;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .brand-subtitle {
            font-size: 10px;
            color: #64748b;
            margin: 2px 0 0 0;
        }
        .statement-title {
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }
        .statement-period {
            text-align: right;
            font-size: 11px;
            color: #3b82f6;
            font-weight: bold;
            margin-top: 3px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 10px;
        }
        .info-label {
            color: #64748b;
            font-size: 9px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .info-value {
            color: #0f172a;
            font-size: 11px;
            font-weight: bold;
        }
        .summary-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .summary-box {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            border-radius: 6px;
            text-align: center;
        }
        .summary-label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .summary-amount {
            font-size: 13px;
            font-weight: bold;
        }
        .text-income { color: #16a34a; }
        .text-expense { color: #dc2626; }
        .text-balance { color: #1a56db; }
        .text-savings { color: #0284c7; }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #0f172a;
            margin: 15px 0 8px 0;
            padding-bottom: 4px;
            border-bottom: 1px solid #e2e8f0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .data-table th {
            background-color: #1e3a8a;
            color: #ffffff;
            font-size: 9px;
            text-transform: uppercase;
            padding: 6px 8px;
            text-align: left;
            border: 1px solid #1e3a8a;
        }
        .data-table td {
            padding: 6px 8px;
            border: 1px solid #e2e8f0;
            font-size: 10px;
        }
        .data-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-income { background-color: #dcfce7; color: #166534; }
        .badge-expense { background-color: #fee2e2; color: #991b1b; }
        .badge-savings { background-color: #e0f2fe; color: #075985; }

        .footer-note {
            margin-top: 25px;
            padding-top: 10px;
            border-top: 1px dashed #cbd5e1;
            font-size: 8px;
            color: #94a3b8;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- KOP REKENING KORAN -->
    <table class="header-table" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width: 55%; vertical-align: middle;">
                <h1 class="brand-title">YUK NABUNG</h1>
                <p class="brand-subtitle">Platform Manajemen Keuangan & Tabungan Mandiri</p>
            </td>
            <td style="width: 45%; vertical-align: middle;">
                <div class="statement-title">Rekening Koran / Statement</div>
                <div class="statement-period">Periode: <?= $month_name ?> <?= $year ?></div>
            </td>
        </tr>
    </table>

    <!-- INFORMASI NASABAH / PENGGUNA -->
    <table class="info-table" cellpadding="4" cellspacing="0">
        <tr>
            <td style="width: 25%;">
                <div class="info-label">Nama Pemilik Akun</div>
                <div class="info-value"><?= htmlspecialchars($user->username) ?></div>
            </td>
            <td style="width: 35%;">
                <div class="info-label">Email Terdaftar</div>
                <div class="info-value"><?= htmlspecialchars($user->email) ?></div>
            </td>
            <td style="width: 20%;">
                <div class="info-label">ID Pengguna</div>
                <div class="info-value">#USR-<?= str_pad($user->id, 5, '0', STR_PAD_LEFT) ?></div>
            </td>
            <td style="width: 20%;">
                <div class="info-label">Tanggal Cetak</div>
                <div class="info-value"><?= date('d/m/Y H:i') ?> WIB</div>
            </td>
        </tr>
    </table>

    <!-- RINGKASAN SALDO & ARUS KAS -->
    <table class="summary-table" cellpadding="4" cellspacing="0">
        <tr>
            <td style="width: 25%;">
                <div class="summary-box">
                    <div class="summary-label">Total Pemasukan</div>
                    <div class="summary-amount text-income">Rp <?= number_format($summary->total_income ?? 0, 0, ',', '.') ?></div>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="summary-box">
                    <div class="summary-label">Total Pengeluaran</div>
                    <div class="summary-amount text-expense">Rp <?= number_format($summary->total_expense ?? 0, 0, ',', '.') ?></div>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="summary-box">
                    <div class="summary-label">Arus Kas Bersih (Net)</div>
                    <div class="summary-amount text-balance">Rp <?= number_format($summary->balance ?? 0, 0, ',', '.') ?></div>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="summary-box">
                    <div class="summary-label">Setoran Tabungan</div>
                    <div class="summary-amount text-savings">Rp <?= number_format($total_savings ?? 0, 0, ',', '.') ?></div>
                </div>
            </td>
        </tr>
    </table>

    <!-- TABEL TRANSAKSI KEUANGAN -->
    <div class="section-title">1. Mutasi Transaksi Keuangan (Arus Kas)</div>
    <table class="data-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th style="width: 13%;">Tanggal</th>
                <th style="width: 12%;">Jenis</th>
                <th style="width: 18%;">Kategori</th>
                <th style="width: 32%;">Keterangan</th>
                <th style="width: 20%;" class="text-right">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transactions)): ?>
            <tr>
                <td colspan="6" class="text-center" style="padding: 12px; color: #94a3b8;">
                    Tidak ada aktivitas mutasi transaksi pada periode ini.
                </td>
            </tr>
            <?php else: ?>
            <?php 
            $no = 1;
            foreach ($transactions as $trx): 
            ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= date('d-m-Y', strtotime($trx->transaction_date)) ?></td>
                <td>
                    <?php if ($trx->type == 'income'): ?>
                        <span class="badge badge-income">Pemasukan</span>
                    <?php else: ?>
                        <span class="badge badge-expense">Pengeluaran</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($trx->category) ?></td>
                <td><?= htmlspecialchars($trx->description ?? '-') ?></td>
                <td class="text-right <?= $trx->type == 'income' ? 'text-income font-weight-bold' : 'text-expense font-weight-bold' ?>">
                    <?= $trx->type == 'income' ? '+' : '-' ?> Rp <?= number_format($trx->amount, 0, ',', '.') ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- TABEL SETORAN TABUNGAN -->
    <div class="section-title">2. Rekapitulasi & Riwayat Setoran Tabungan</div>
    <table class="data-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th style="width: 20%;">Tanggal Setoran</th>
                <th style="width: 50%;">Keterangan</th>
                <th style="width: 25%;" class="text-right">Nominal Setoran (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($savings)): ?>
            <tr>
                <td colspan="4" class="text-center" style="padding: 12px; color: #94a3b8;">
                    Belum ada setoran tabungan yang tercatat pada periode ini.
                </td>
            </tr>
            <?php else: ?>
            <?php 
            $no_s = 1;
            foreach ($savings as $sav): 
            ?>
            <tr>
                <td class="text-center"><?= $no_s++ ?></td>
                <td><?= date('d-m-Y', strtotime($sav->deposit_date)) ?></td>
                <td><?= htmlspecialchars($sav->description ?? 'Setoran Tabungan Rutin') ?></td>
                <td class="text-right text-savings font-weight-bold">
                    + Rp <?= number_format($sav->amount, 0, ',', '.') ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            <tr style="background-color: #f1f5f9; font-weight: bold;">
                <td colspan="3" class="text-right">Total Tabungan Terkumpul (Target: Rp <?= number_format($target->target_amount ?? 0, 0, ',', '.') ?>):</td>
                <td class="text-right text-savings">Rp <?= number_format($total_savings ?? 0, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <!-- FOOTER / CATATAN VALIDASI -->
    <div class="footer-note">
        Dokumen ini diterbitkan secara elektronik oleh sistem resmi <strong>Yuk Nabung</strong> dan sah tanpa tanda tangan basah.<br>
        Dicetak pada <?= date('d F Y, H:i:s') ?> WIB &bull; Lindungi kerahasiaan informasi finansial pribadi Anda.
    </div>

</body>
</html>
