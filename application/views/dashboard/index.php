<?php
$username = $this->session->userdata('username') ?? 'Admin';
$p_stats = $platform_stats ?? [];
?>

<!-- Header Sambutan Admin -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #1e3a8a 0%, #1a56db 100%); color: #ffffff; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <span class="badge badge-light text-primary font-weight-bold px-3 py-2 mb-2" style="font-size: 12px; border-radius: 20px;">
                        <i class="fas fa-shield-alt mr-1"></i> PANEL ADMINISTRATOR
                    </span>
                    <h2 class="font-weight-bold mb-1" style="color: #ffffff;">Halo, <?= htmlspecialchars($username) ?>! 👋</h2>
                    <p class="mb-0 text-white-50" style="font-size: 15px;">
                        Pantau kesehatan finansial seluruh pengguna, tabungan terkumpul, dan pergerakan transaksi bulan <strong><?= $current_month ?></strong>.
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= site_url('admin/users') ?>" class="btn btn-light font-weight-bold mr-2 mb-2 shadow-sm text-primary">
                        <i class="fas fa-user-plus mr-1"></i> Kelola User
                    </a>
                    <a href="<?= site_url('admin/targets') ?>" class="btn btn-outline-light font-weight-bold mr-2 mb-2 shadow-sm">
                        <i class="fas fa-bullseye mr-1"></i> Set Target
                    </a>
                    <a href="<?= site_url('laporan') ?>" class="btn btn-warning font-weight-bold mb-2 shadow-sm text-dark" style="color: #1e293b !important;">
                        <i class="fas fa-file-invoice mr-1"></i> Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notifikasi Alert jika ada -->
<?php if (isset($notification) && !empty($notification)): ?>
<div class="row">
    <div class="col-12">
        <div class="alert alert-<?= $notification['type'] ?? 'info' ?> alert-dismissible fade show shadow-sm">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-bell mr-2"></i> <?= $notification['message'] ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- 4 KARTU STATISTIK PLATFORM -->
<div class="row">
    <!-- Total Tabungan Keseluruhan -->
    <div class="col-lg-3 col-sm-6">
        <div class="small-box bg-primary shadow-sm">
            <div class="inner">
                <p class="text-white-50 text-uppercase font-weight-bold" style="font-size: 12px; letter-spacing: 0.5px;">Tabungan Platform (Total)</p>
                <h3 class="font-weight-bold">Rp <?= number_format($p_stats['platform_total_savings'] ?? 0, 0, ',', '.') ?></h3>
            </div>
            <div class="icon">
                <i class="fas fa-vault"></i>
            </div>
            <a href="<?= site_url('admin/targets') ?>" class="small-box-footer">
                Rincian Target <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>
    
    <!-- Tabungan Bulan Ini -->
    <div class="col-lg-3 col-sm-6">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <p class="text-white-50 text-uppercase font-weight-bold" style="font-size: 12px; letter-spacing: 0.5px;">Tabungan Bulan Ini</p>
                <h3 class="font-weight-bold">Rp <?= number_format($p_stats['platform_month_savings'] ?? 0, 0, ',', '.') ?></h3>
            </div>
            <div class="icon">
                <i class="fas fa-piggy-bank"></i>
            </div>
            <a href="<?= site_url('savings/leaderboard') ?>" class="small-box-footer">
                Lihat Leaderboard <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>
    
    <!-- Arus Kas Bersih Bulan Ini -->
    <div class="col-lg-3 col-sm-6">
        <div class="small-box bg-info shadow-sm">
            <div class="inner">
                <p class="text-white-50 text-uppercase font-weight-bold" style="font-size: 12px; letter-spacing: 0.5px;">Net Cashflow Bulan Ini</p>
                <h3 class="font-weight-bold">Rp <?= number_format($p_stats['platform_month_balance'] ?? 0, 0, ',', '.') ?></h3>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="<?= site_url('transactions') ?>" class="small-box-footer">
                Lihat Transaksi <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>
    
    <!-- Total Pengguna Terdaftar -->
    <div class="col-lg-3 col-sm-6">
        <div class="small-box bg-warning shadow-sm" style="background-color: #fef08a !important; border: 1px solid #fde047;">
            <div class="inner">
                <p class="text-uppercase font-weight-bold mb-1" style="font-size: 12px; letter-spacing: 0.5px; color: #854d0e !important;">Total Pengguna</p>
                <h3 class="font-weight-bold mb-0" style="color: #422006 !important;">
                    <?= number_format($p_stats['total_users'] ?? 0, 0, ',', '.') ?> 
                    <span style="font-size: 16px; font-weight: normal; color: #854d0e;">Akun</span>
                </h3>
            </div>
            <div class="icon">
                <i class="fas fa-users" style="color: rgba(133, 77, 14, 0.25) !important;"></i>
            </div>
            <a href="<?= site_url('admin/users') ?>" class="small-box-footer" style="color: #422006 !important; font-weight: 700; background-color: rgba(133, 77, 14, 0.1) !important;">
                Kelola Pengguna <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

<!-- GRAFIK CHART.JS -->
<div class="row">
    <div class="col-lg-6">
        <div class="card card-primary shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title text-white font-weight-bold">
                    <i class="fas fa-chart-pie mr-2"></i> Pemasukan vs Pengeluaran Bulan Ini
                </h3>
            </div>
            <div class="card-body" style="min-height: 290px;">
                <canvas id="chartIncomeExpense" 
                        style="height: 250px; width: 100%;"
                        data-income="<?= (int) ($p_stats['platform_month_income'] ?? $total_income ?? 0) ?>"
                        data-expense="<?= (int) ($p_stats['platform_month_expense'] ?? $total_expense ?? 0) ?>">
                </canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card card-success shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title text-white font-weight-bold">
                    <i class="fas fa-chart-bar mr-2"></i> Realisasi vs Target Tabungan Pribadi Admin
                </h3>
            </div>
            <div class="card-body" style="min-height: 290px;">
                <canvas id="chartSavings"
                        style="height: 250px; width: 100%;"
                        data-target="<?= (int) ($savings_target->target_amount ?? 0) ?>"
                        data-deposit="<?= (int) ($savings_total_deposit ?? 0) ?>">
                </canvas>
            </div>
        </div>
    </div>
</div>

<!-- GRAFIK TREN PERTUMBUHAN TABUNGAN PLATFORM (6 BULAN) -->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold" style="color: #1e293b;">
                    <i class="fas fa-chart-line mr-2 text-primary"></i> Tren Pertumbuhan Tabungan Platform (6 Bulan Terakhir)
                </h3>
                <span class="badge badge-primary px-3 py-1 font-weight-normal" style="font-size: 12px; border-radius: 20px;">
                    Platform-wide Growth
                </span>
            </div>
            <div class="card-body" style="min-height: 290px;">
                <canvas id="chartPlatformTrend"
                        style="height: 260px; width: 100%;"
                        data-trend='<?= htmlspecialchars(json_encode($platform_savings_trend ?? []), ENT_QUOTES, 'UTF-8') ?>'>
                </canvas>
            </div>
        </div>
    </div>
</div>

<!-- RINGKASAN TABUNGAN SELURUH USER -->
<div class="row">
    <div class="col-12">
        <div class="card card-info shadow-sm">
            <div class="card-header bg-gradient-info d-flex justify-content-between align-items-center">
                <h3 class="card-title text-white font-weight-bold">
                    <i class="fas fa-users mr-2"></i> Ringkasan Tabungan Pengguna (Bulan <?= $current_month ?>)
                </h3>
                <div class="card-tools">
                    <a href="<?= site_url('admin/targets') ?>" class="btn btn-sm btn-light font-weight-bold text-info">
                        <i class="fas fa-cog mr-1"></i> Kelola Target
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Pengguna</th>
                                <th>Target Bulan Ini</th>
                                <th>Setoran Bulan Ini</th>
                                <th>Total Akumulasi</th>
                                <th>Progress Target</th>
                                <th class="text-center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($all_users_savings)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data tabungan pengguna.</td>
                            </tr>
                            <?php else: ?>
                            <?php 
                            $no = 1;
                            foreach ($all_users_savings as $u): 
                                $pct = ($u->target_amount > 0) ? min(($u->total_deposit / $u->target_amount) * 100, 100) : 0;
                                $status_color = ($pct >= 100) ? 'success' : (($pct >= 50) ? 'info' : 'warning');
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle mr-2" style="width: 32px; height: 32px; border-radius: 50%; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px;">
                                            <?= strtoupper(substr($u->username, 0, 1)) ?>
                                        </div>
                                        <div>
                                            <strong><?= htmlspecialchars($u->username) ?></strong>
                                            <div class="small text-muted"><?= htmlspecialchars($u->email ?? '') ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="font-weight-bold">Rp <?= number_format($u->target_amount, 0, ',', '.') ?></td>
                                <td class="text-success font-weight-bold">Rp <?= number_format($u->total_deposit, 0, ',', '.') ?></td>
                                <td class="font-weight-bold">Rp <?= number_format($u->total_all_time ?? 0, 0, ',', '.') ?></td>
                                <td style="min-width: 170px;">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span><?= round($pct, 1) ?>%</span>
                                        <?php if ($pct >= 100): ?>
                                        <span class="text-success font-weight-bold">Tercapai 🎉</span>
                                        <?php else: ?>
                                        <span class="text-muted">Sisa: Rp <?= number_format(max(0, $u->target_amount - $u->total_deposit), 0, ',', '.') ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="progress" style="height: 10px; border-radius: 10px;">
                                        <div class="progress-bar bg-<?= $status_color ?>" role="progressbar" style="width: <?= $pct ?>%;" aria-valuenow="<?= $pct ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('savings/view_user/' . $u->id) ?>" class="btn btn-xs btn-primary font-weight-bold px-2 py-1">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TRANSAKSI TERBARU PLATFORM -->
<?php if (isset($recent_platform_transactions) && !empty($recent_platform_transactions)): ?>
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-secondary shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-history mr-2 text-primary"></i> Transaksi Terbaru Seluruh Pengguna
                </h3>
                <div class="card-tools">
                    <a href="<?= site_url('transactions') ?>" class="btn btn-sm btn-outline-primary font-weight-bold">
                        Lihat Semua Transaksi
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pengguna</th>
                                <th>Tipe</th>
                                <th>Kategori</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_platform_transactions as $rt): ?>
                            <tr>
                                <td><?= date('d M Y', strtotime($rt->transaction_date)) ?></td>
                                <td><span class="badge badge-light border px-2 py-1"><?= htmlspecialchars($rt->username ?? 'User #' . $rt->user_id) ?></span></td>
                                <td>
                                    <?php if ($rt->type == 'income'): ?>
                                    <span class="badge badge-success px-2 py-1"><i class="fas fa-arrow-down mr-1"></i> Pemasukan</span>
                                    <?php else: ?>
                                    <span class="badge badge-danger px-2 py-1"><i class="fas fa-arrow-up mr-1"></i> Pengeluaran</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($rt->category) ?></td>
                                <td class="font-weight-bold <?= $rt->type == 'income' ? 'text-success' : 'text-danger' ?>">
                                    <?= $rt->type == 'income' ? '+' : '-' ?> Rp <?= number_format($rt->amount, 0, ',', '.') ?>
                                </td>
                                <td class="text-muted"><?= htmlspecialchars($rt->description ?? '-') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
