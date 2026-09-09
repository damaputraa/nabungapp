<style>
/* ================================================================ */
/* DETAIL TABUNGAN USER LAIN */
/* ================================================================ */

.user-detail-header {
    background: linear-gradient(135deg, #00a651, #00c853);
    color: #fff;
    padding: 25px 20px 30px 20px;
    border-radius: 0 0 25px 25px;
    margin: -20px -25px 20px -25px;
    text-align: center;
}

.user-detail-header .big-avatar {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 700;
    margin: 0 auto 10px auto;
    border: 3px solid rgba(255, 255, 255, 0.3);
}

.user-detail-header h2 {
    font-weight: 700;
    margin: 0;
    font-size: 22px;
}

.user-detail-header p {
    opacity: 0.85;
    margin: 4px 0 0 0;
    font-size: 14px;
}

.user-detail-header .badge-own {
    background: rgba(255, 255, 255, 0.2);
    padding: 3px 14px;
    border-radius: 20px;
    font-size: 12px;
    display: inline-block;
    margin-top: 8px;
}

.detail-card {
    background: #fff;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
}

.detail-card .label {
    font-size: 12px;
    color: #999;
    font-weight: 500;
}

.detail-card .value {
    font-size: 20px;
    font-weight: 700;
    color: #1a1a2e;
}

.detail-card .value.green { color: #00a651; }
.detail-card .value.red { color: #e74c3c; }
.detail-card .value.orange { color: #f39c12; }

.detail-card .progress-detail {
    margin-top: 10px;
}

.detail-card .progress-detail .bar {
    height: 10px;
    background: #e9ecef;
    border-radius: 20px;
    overflow: hidden;
}

.detail-card .progress-detail .bar .fill {
    height: 100%;
    background: linear-gradient(90deg, #00a651, #00c853);
    border-radius: 20px;
    transition: width 0.8s ease;
}

.transaction-item-mini {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f5f5f5;
    font-size: 13px;
}

.transaction-item-mini:last-child {
    border-bottom: none;
}

.transaction-item-mini .date {
    color: #999;
    font-size: 11px;
}

.transaction-item-mini .amount {
    font-weight: 600;
    color: #00a651;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f0f0f0;
    padding: 8px 18px;
    border-radius: 30px;
    text-decoration: none;
    color: #333;
    font-weight: 500;
    font-size: 13px;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #e0e0e0;
    color: #333;
}
</style>

<!-- ================================================================ -->
<!-- HEADER USER -->
<!-- ================================================================ -->
<div class="user-detail-header">
    <div class="big-avatar">
        <?= strtoupper(substr($view_user->username, 0, 1)) ?>
    </div>
    <h2><?= $view_user->username ?></h2>
    <p><?= $view_user->email ?></p>
    <?php if ($is_own): ?>
    <span class="badge-own">👤 Ini Anda</span>
    <?php endif; ?>
</div>

<!-- ================================================================ -->
<!-- STATISTIK -->
<!-- ================================================================ -->
<div class="row">
    <div class="col-4">
        <div class="detail-card" style="text-align: center;">
            <div class="label">Progress</div>
            <div class="value green"><?= $progress ?>%</div>
        </div>
    </div>
    <div class="col-4">
        <div class="detail-card" style="text-align: center;">
            <div class="label">Setoran</div>
            <div class="value">Rp <?= number_format($total_deposit, 0, ',', '.') ?></div>
        </div>
    </div>
    <div class="col-4">
        <div class="detail-card" style="text-align: center;">
            <div class="label">Target</div>
            <div class="value orange">Rp <?= number_format($target->target_amount ?? 0, 0, ',', '.') ?></div>
        </div>
    </div>
</div>

<!-- ================================================================ -->
<!-- PROGRESS BAR -->
<!-- ================================================================ -->
<div class="detail-card">
    <div class="label">Progress Tabungan</div>
    <div class="progress-detail">
        <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 4px;">
            <span>Rp <?= number_format($total_deposit, 0, ',', '.') ?></span>
            <span>Target: Rp <?= number_format($target->target_amount ?? 0, 0, ',', '.') ?></span>
        </div>
        <div class="bar">
            <div class="fill" style="width: <?= $progress ?>%;"></div>
        </div>
        <div style="text-align: right; font-size: 12px; color: #999; margin-top: 4px;">
            Sisa: Rp <?= number_format($remaining, 0, ',', '.') ?>
        </div>
    </div>
</div>

<!-- ================================================================ -->
<!-- RIWAYAT SETORAN -->
<!-- ================================================================ -->
<div class="detail-card">
    <div class="label">📋 Riwayat Setoran</div>
    <?php if (empty($savings)): ?>
    <p style="text-align: center; color: #999; font-size: 13px; padding: 10px 0;">
        Belum ada setoran tabungan
    </p>
    <?php else: ?>
    <?php foreach ($savings as $saving): ?>
    <div class="transaction-item-mini">
        <div>
            <div>Rp <?= number_format($saving->amount, 0, ',', '.') ?></div>
            <div class="date"><?= date('d M Y', strtotime($saving->deposit_date)) ?></div>
        </div>
        <div class="amount">
            <?= $saving->description ?: 'Setoran' ?>
        </div>
    </div>
    <?php endforeach; ?>
    <div style="text-align: right; font-size: 13px; font-weight: 600; padding-top: 10px; border-top: 1px solid #f5f5f5; margin-top: 8px;">
        Total: Rp <?= number_format($total_all, 0, ',', '.') ?>
    </div>
    <?php endif; ?>
</div>

<!-- ================================================================ -->
<!-- TOMBOL KEMBALI -->
<!-- ================================================================ -->
<div style="text-align: center; margin-top: 16px; padding-bottom: 10px;">
    <a href="<?= site_url('savings/leaderboard') ?>" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali ke Leaderboard
    </a>
</div>
