<?php
$user_name = $this->session->userdata('username') ?? 'User';
$role = $this->session->userdata('role') ?? 'user';
$is_admin = ($role == 'admin');

$target_amount = isset($savings_target) && $savings_target ? (float) $savings_target->target_amount : 1;
$current_saving = (float) ($savings_total_deposit ?? 0);
$percentage = $target_amount > 0 ? min(($current_saving / $target_amount) * 100, 100) : 0;
$remaining = max(0, $target_amount - $current_saving);
$recent_transactions = array_slice($transactions ?? [], 0, 5);
?>

<style>
/* ================================================================ */
/* USER DASHBOARD - RESPONSIVE & HIGH CONTRAST (WCAG AA)            */
/* ================================================================ */
:root {
    --primary: #00a651;
    --primary-dark: #008a45;
    --primary-light: #e8f5e9;
    --primary-gradient: linear-gradient(135deg, #00a651 0%, #00c853 100%);
    --card-bg: #ffffff;
    --text-main: #0f172a;       /* Slate 900 */
    --text-body: #334155;       /* Slate 700 */
    --text-muted: #475569;      /* Slate 600 (High contrast WCAG AA) */
    --text-light: #64748b;      /* Slate 500 */
    --border-soft: #e2e8f0;
    --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 6px 20px rgba(0, 166, 81, 0.12);
    --radius-card: 20px;
    --radius-sm: 12px;
    --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.user-dashboard {
    background: #f8fafc;
    min-height: 100vh;
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--text-body);
    width: 100% !important;
    max-width: 100% !important;
}

/* Header Greeting */
.dashboard-header {
    background: var(--primary-gradient);
    padding: 30px 24px 48px 24px;
    border-radius: 0 0 24px 24px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 166, 81, 0.2);
    width: 100% !important;
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -40px;
    width: 240px;
    height: 240px;
    background: rgba(255, 255, 255, 0.12);
    border-radius: 50%;
}

.dashboard-header .greeting {
    font-size: 14px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2px;
}

.dashboard-header .username {
    font-size: 26px;
    font-weight: 800;
    color: #ffffff;
    letter-spacing: -0.5px;
    margin-bottom: 4px;
}

.dashboard-header .date {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.85);
}

/* Container Wrapper */
.dashboard-body-container {
    margin-top: -26px;
    position: relative;
    z-index: 10;
    padding: 0 16px 30px 16px;
    width: 100% !important;
    max-width: 100% !important;
}

@media (min-width: 768px) {
    .dashboard-header {
        border-radius: 0 0 28px 28px;
        padding: 36px 36px 54px 36px;
        width: 100% !important;
    }
    .dashboard-body-container {
        width: 100% !important;
        max-width: 100% !important;
        margin-top: -30px;
        padding: 0 32px 40px 32px;
    }
}

/* Saldo Card */
.saldo-card {
    background: var(--card-bg);
    border-radius: var(--radius-card);
    padding: 24px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-soft);
    margin-bottom: 20px;
}

.saldo-card .saldo-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-light);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.saldo-card .saldo-amount {
    font-size: 32px;
    font-weight: 800;
    color: var(--text-main);
    margin: 6px 0 14px 0;
    letter-spacing: -0.5px;
}

.saldo-card .saldo-detail {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
}

.saldo-card .saldo-detail .item .label {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 2px;
}

.saldo-card .saldo-detail .item .value {
    font-size: 16px;
    font-weight: 700;
}

.saldo-card .saldo-detail .item .value.income {
    color: #047857;
}

.saldo-card .saldo-detail .item .value.expense {
    color: #b91c1c;
}

/* Quick Actions Grid */
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}

@media (min-width: 576px) {
    .quick-actions-grid {
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
    }
}

.action-card-btn {
    background: var(--card-bg);
    border: 1px solid var(--border-soft);
    border-radius: var(--radius-sm);
    padding: 14px 8px;
    text-align: center;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    text-decoration: none;
    color: var(--text-body);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.action-card-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    border-color: #cbd5e1;
    color: var(--primary);
    text-decoration: none;
}

.action-card-btn .action-icon {
    font-size: 24px;
    margin-bottom: 6px;
}

.action-card-btn .action-label {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-body);
}

/* Content Cards */
.dash-card {
    background: var(--card-bg);
    border-radius: var(--radius-card);
    padding: 22px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-soft);
    margin-bottom: 20px;
}

.dash-card .card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.dash-card .card-head .head-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-main);
    display: flex;
    align-items: center;
    gap: 8px;
}

.dash-card .card-head .head-link {
    font-size: 12px;
    font-weight: 700;
    color: var(--primary-dark);
    text-decoration: none;
}

.dash-card .card-head .head-link:hover {
    text-decoration: underline;
}

/* Progress Bars */
.progress-track {
    height: 12px;
    background: #e2e8f0;
    border-radius: 9999px;
    overflow: hidden;
    margin: 10px 0;
}

.progress-track .progress-fill {
    height: 100%;
    background: var(--primary-gradient);
    border-radius: 9999px;
    transition: width 0.8s ease;
}

/* Transaction List */
.trx-list-item {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.trx-list-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.trx-icon-box {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    margin-right: 14px;
    flex-shrink: 0;
}

.trx-icon-box.income {
    background: #dcfce7;
    color: #15803d;
}

.trx-icon-box.expense {
    background: #fee2e2;
    color: #b91c1c;
}

.trx-info {
    flex: 1;
    min-width: 0;
}

.trx-info .trx-name {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-main);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.trx-info .trx-meta {
    font-size: 12px;
    color: var(--text-muted);
}

.trx-amount {
    font-size: 14px;
    font-weight: 800;
    text-align: right;
    white-space: nowrap;
}

.trx-amount.income {
    color: #047857;
}

.trx-amount.expense {
    color: #b91c1c;
}

/* Goals item */
.goal-item-box {
    background: #f8fafc;
    border: 1px solid var(--border-soft);
    border-radius: 14px;
    padding: 12px 14px;
    margin-bottom: 10px;
    transition: var(--transition);
}

.goal-item-box:hover {
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* Help Card */
.support-banner {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border-radius: var(--radius-card);
    padding: 20px 24px;
    color: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: var(--shadow-sm);
}

.support-banner h5 {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 3px;
    color: #ffffff;
}

.support-banner p {
    font-size: 12px;
    color: #94a3b8;
    margin-bottom: 0;
}

.btn-support {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.2);
    font-size: 12px;
    font-weight: 700;
    border-radius: 9999px;
    padding: 8px 18px;
    transition: var(--transition);
}

.btn-support:hover {
    background: #ffffff;
    color: #0f172a;
}
</style>

<div class="user-dashboard">

    <!-- ========== HEADER GREETING ========== -->
    <div class="dashboard-header">
        <div class="greeting">Hai, selamat datang kembali! 👋</div>
        <div class="username"><?= htmlspecialchars($user_name) ?></div>
        <div class="date"><i class="far fa-calendar-alt mr-1"></i> <?= date('l, d F Y') ?></div>
    </div>

    <!-- ========== DASHBOARD BODY CONTAINER ========== -->
    <div class="dashboard-body-container">

        <!-- BROADCAST ANNOUNCEMENTS -->
        <?php if (!empty($announcements)): ?>
            <?php foreach ($announcements as $ann): ?>
            <div class="alert alert-<?= $ann->type ?> alert-dismissible fade show shadow-sm mb-3" style="border-radius: 16px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="d-flex align-items-center">
                    <i class="fas fa-bullhorn mr-2" style="font-size: 18px;"></i>
                    <div>
                        <strong><?= htmlspecialchars($ann->title) ?>:</strong>
                        <span><?= htmlspecialchars($ann->message) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- OVERBUDGET CRITICAL ALERT -->
        <?php if (!empty($overbudgets)): ?>
        <div class="alert alert-danger border-0 shadow-sm p-3 d-flex align-items-center mb-3" style="border-radius: 16px; background-color: #fef2f2; border: 1px solid #fee2e2; color: #991b1b;">
            <div style="font-size: 22px; margin-right: 14px;">
                <i class="fas fa-exclamation-circle text-danger"></i>
            </div>
            <div class="flex-grow-1">
                <div class="font-weight-bold" style="font-size: 13px;">Peringatan: Pengeluaran Melampaui Batas Anggaran!</div>
                <div style="font-size: 12px; color: #7f1d1d;">
                    Kategori melebihi batas: 
                    <?php foreach ($overbudgets as $ob): ?>
                        <span class="badge badge-danger px-2 py-1 mr-1"><?= html_escape($ob->category) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="<?= site_url('budget') ?>" class="btn btn-sm btn-danger px-3 py-1 font-weight-bold ml-2" style="border-radius: 8px; font-size: 11px;">
                Cek Detail &rarr;
            </a>
        </div>
        <?php endif; ?>

        <!-- RESPONSIVE 2-COLUMN GRID -->
        <div class="row">
            
            <!-- LEFT COLUMN (60%): Saldo, Quick Actions & Recent Transactions -->
            <div class="col-lg-7 col-md-12">
                
                <!-- 1. SALDO UTAMA CARD -->
                <div class="saldo-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="saldo-label">
                            <i class="fas fa-wallet mr-1 text-success"></i> Saldo Bersih Saat Ini
                        </div>
                        <a href="<?= site_url('transactions/add') ?>" class="btn btn-sm btn-outline-success font-weight-bold px-3 py-1" style="border-radius: 20px; font-size: 11px;">
                            + Catat Kas
                        </a>
                    </div>
                    <div class="saldo-amount">
                        Rp <?= number_format($balance ?? 0, 0, ',', '.') ?>
                    </div>
                    <div class="saldo-detail">
                        <div class="item">
                            <div class="label"><i class="fas fa-arrow-down mr-1 text-success"></i> Total Pemasukan</div>
                            <div class="value income">+ Rp <?= number_format($total_income ?? 0, 0, ',', '.') ?></div>
                        </div>
                        <div class="item">
                            <div class="label"><i class="fas fa-arrow-up mr-1 text-danger"></i> Total Pengeluaran</div>
                            <div class="value expense">- Rp <?= number_format($total_expense ?? 0, 0, ',', '.') ?></div>
                        </div>
                    </div>
                </div>

                <!-- 2. QUICK ACTIONS (6 Grid Buttons) -->
                <div class="quick-actions-grid">
                    <a href="<?= site_url('transactions/add') ?>" class="action-card-btn">
                        <span class="action-icon text-success">💰</span>
                        <span class="action-label">Kas Masuk</span>
                    </a>
                    <a href="<?= site_url('transactions/add') ?>" class="action-card-btn">
                        <span class="action-icon text-danger">💸</span>
                        <span class="action-label">Kas Keluar</span>
                    </a>
                    <a href="<?= site_url('savings') ?>" class="action-card-btn">
                        <span class="action-icon text-warning">🏦</span>
                        <span class="action-label">Setor Nabung</span>
                    </a>
                    <a href="<?= site_url('goals') ?>" class="action-card-btn">
                        <span class="action-icon text-primary">🎯</span>
                        <span class="action-label">Kantong Impian</span>
                    </a>
                    <a href="<?= site_url('budget') ?>" class="action-card-btn">
                        <span class="action-icon text-info">📊</span>
                        <span class="action-label">Anggaran</span>
                    </a>
                    <a href="<?= site_url('savings/leaderboard') ?>" class="action-card-btn">
                        <span class="action-icon text-warning">🏆</span>
                        <span class="action-label">Leaderboard</span>
                    </a>
                </div>

                <!-- 3. TRANSAKSI TERAKHIR -->
                <div class="dash-card">
                    <div class="card-head">
                        <span class="head-title">
                            <i class="fas fa-history text-primary"></i> Transaksi Terakhir
                        </span>
                        <a href="<?= site_url('transactions') ?>" class="head-link">Lihat Semua &rarr;</a>
                    </div>
                    
                    <?php if (empty($recent_transactions)): ?>
                        <div class="text-center py-4">
                            <div style="font-size: 36px; margin-bottom: 8px;">📭</div>
                            <div class="font-weight-bold text-dark">Belum ada transaksi</div>
                            <div class="small text-muted mb-3">Mulai catat pemasukan atau pengeluaran pertamamu.</div>
                            <a href="<?= site_url('transactions/add') ?>" class="btn btn-sm btn-success font-weight-bold px-3 py-1" style="border-radius: 12px;">
                                + Tambah Transaksi
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="trx-list">
                            <?php foreach ($recent_transactions as $trx): ?>
                            <div class="trx-list-item">
                                <div class="trx-icon-box <?= $trx->type ?>">
                                    <i class="fas fa-<?= $trx->type == 'income' ? 'arrow-down' : 'arrow-up' ?>"></i>
                                </div>
                                <div class="trx-info">
                                    <div class="trx-name"><?= htmlspecialchars($trx->category ?? 'Transaksi') ?></div>
                                    <div class="trx-meta">
                                        <?= date('d M Y', strtotime($trx->transaction_date ?? date('Y-m-d'))) ?>
                                        <?php if (!empty($trx->description)): ?>
                                            &bull; <?= htmlspecialchars($trx->description) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="trx-amount <?= $trx->type ?>">
                                    <?= $trx->type == 'income' ? '+' : '-' ?> Rp <?= number_format($trx->amount ?? 0, 0, ',', '.') ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- RIGHT COLUMN (40%): Target Bulanan, Kantong Impian & Bantuan -->
            <div class="col-lg-5 col-md-12">
                
                <!-- 4. TARGET TABUNGAN BULAN INI -->
                <div class="dash-card">
                    <div class="card-head">
                        <span class="head-title">
                            <i class="fas fa-piggy-bank text-success"></i> Target Tabungan Bulanan
                        </span>
                        <a href="<?= site_url('savings') ?>" class="head-link">Setoran &rarr;</a>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="small font-weight-bold text-muted">Target Bulan Ini</span>
                        <span class="font-weight-bold text-success" style="font-size: 15px;">
                            Rp <?= number_format($target_amount, 0, ',', '.') ?>
                        </span>
                    </div>

                    <div class="progress-track">
                        <div class="progress-fill" style="width: <?= $percentage ?>%;"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center small mt-2">
                        <div>
                            <span class="text-muted">Terkumpul:</span>
                            <strong class="text-dark">Rp <?= number_format($current_saving, 0, ',', '.') ?></strong>
                        </div>
                        <div class="text-right">
                            <span class="text-muted">Sisa:</span>
                            <strong class="<?= $remaining == 0 ? 'text-success' : 'text-danger' ?>">
                                Rp <?= number_format($remaining, 0, ',', '.') ?>
                            </strong>
                        </div>
                    </div>

                    <div class="p-2 mt-3 text-center rounded bg-light border font-weight-bold text-success" style="font-size: 12px;">
                        🎯 <?= round($percentage, 1) ?>% Target Tercapai
                        <?php if ($percentage >= 100): ?>
                            &mdash; Hebat, target terpenuhi! 🎉
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 5. KANTONG IMPIAN (SAVINGS GOALS) -->
                <div class="dash-card">
                    <div class="card-head">
                        <span class="head-title">
                            <i class="fas fa-bullseye text-primary"></i> Kantong Impian
                        </span>
                        <a href="<?= site_url('goals') ?>" class="head-link">Kelola &rarr;</a>
                    </div>
                    
                    <?php if (empty($user_goals)): ?>
                        <div class="text-center py-3">
                            <p class="text-muted small mb-2">Belum ada kantong impian khusus.</p>
                            <a href="<?= site_url('goals') ?>" class="btn btn-sm btn-outline-primary font-weight-bold px-3" style="border-radius: 12px; font-size: 12px;">
                                + Buat Kantong Impian
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="goals-list">
                            <?php foreach (array_slice($user_goals, 0, 3) as $g): ?>
                            <div class="goal-item-box" style="border-left: 4px solid <?= html_escape($g->color ?: '#00a651') ?>;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-bold text-dark small">
                                        <i class="fas <?= html_escape($g->icon ?: 'fa-bullseye') ?> mr-1" style="color: <?= html_escape($g->color ?: '#00a651') ?>;"></i>
                                        <?= html_escape($g->title) ?>
                                    </span>
                                    <span class="small font-weight-bold" style="color: <?= html_escape($g->color ?: '#00a651') ?>;">
                                        <?= $g->percentage ?>%
                                    </span>
                                </div>
                                <div class="progress mb-1" style="height: 6px; border-radius: 6px; background: #e2e8f0;">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $g->percentage ?>%; background-color: <?= html_escape($g->color ?: '#00a651') ?>;"></div>
                                </div>
                                <div class="d-flex justify-content-between text-muted" style="font-size: 11px;">
                                    <span>Rp <?= number_format($g->current_amount, 0, ',', '.') ?></span>
                                    <span>Target: Rp <?= number_format($g->target_amount, 0, ',', '.') ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- 6. BUTUH BANTUAN -->
                <div class="support-banner">
                    <div>
                        <h5><i class="fas fa-headset mr-1"></i> Bantuan Sistem</h5>
                        <p>Ada kendala transaksi atau tabungan?</p>
                    </div>
                    <button type="button" class="btn btn-support" onclick="alert('Layanan Dukungan Yuk Nabung: admin@keuangandams.com')">
                        Hubungi Kami
                    </button>
                </div>

            </div>

        </div> <!-- /.row -->

    </div> <!-- /.dashboard-body-container -->

</div>
