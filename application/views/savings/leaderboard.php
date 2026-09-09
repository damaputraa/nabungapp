<style>
/* ================================================================ */
/* LEADERBOARD - GOJEK STYLE */
/* ================================================================ */

.leaderboard-header {
    background: linear-gradient(135deg, #00a651, #00c853);
    color: #fff;
    padding: 25px 20px 30px 20px;
    border-radius: 0 0 25px 25px;
    margin: -20px -25px 20px -25px;
}

.leaderboard-header h2 {
    font-weight: 700;
    margin: 0;
    font-size: 22px;
}

.leaderboard-header p {
    opacity: 0.85;
    margin: 5px 0 0 0;
    font-size: 14px;
}

.leaderboard-item {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    background: #fff;
    border-radius: 12px;
    margin-bottom: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: #1a1a2e;
}

.leaderboard-item:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.leaderboard-item .rank {
    font-size: 18px;
    font-weight: 700;
    width: 40px;
    text-align: center;
    color: #999;
}

.leaderboard-item .rank.gold { color: #f39c12; }
.leaderboard-item .rank.silver { color: #bdc3c7; }
.leaderboard-item .rank.bronze { color: #e67e22; }

.leaderboard-item .avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #00a651, #00c853);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 16px;
    margin-right: 12px;
    flex-shrink: 0;
}

.leaderboard-item .info {
    flex: 1;
}

.leaderboard-item .info .name {
    font-weight: 600;
    font-size: 14px;
}

.leaderboard-item .info .detail {
    font-size: 12px;
    color: #999;
}

.leaderboard-item .progress-section {
    text-align: right;
    min-width: 80px;
}

.leaderboard-item .progress-section .percentage {
    font-weight: 700;
    font-size: 15px;
    color: #00a651;
}

.leaderboard-item .progress-section .amount {
    font-size: 11px;
    color: #999;
}

.leaderboard-item .progress-bar-mini {
    width: 60px;
    height: 6px;
    background: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 4px;
    display: inline-block;
}

.leaderboard-item .progress-bar-mini .fill {
    height: 100%;
    background: linear-gradient(90deg, #00a651, #00c853);
    border-radius: 10px;
    transition: width 0.8s ease;
}

/* Status badge */
.status-badge {
    font-size: 10px;
    padding: 2px 10px;
    border-radius: 20px;
    font-weight: 600;
}

.status-badge.completed {
    background: #e8f5e9;
    color: #00a651;
}

.status-badge.half {
    background: #fef9e7;
    color: #f39c12;
}

.status-badge.low {
    background: #fde8e8;
    color: #e74c3c;
}

/* ================================================================ */
/* EMPTY STATE */
/* ================================================================ */
.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-state .icon {
    font-size: 56px;
    color: #ccc;
    margin-bottom: 15px;
}

.empty-state .title {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a2e;
}

.empty-state .subtitle {
    font-size: 14px;
    color: #999;
}

/* ================================================================ */
/* RESPONSIVE */
/* ================================================================ */
@media (max-width: 768px) {
    .leaderboard-header {
        padding: 20px 16px 25px 16px;
        margin: -15px -20px 16px -20px;
    }
    
    .leaderboard-header h2 {
        font-size: 18px;
    }
    
    .leaderboard-item {
        padding: 10px 12px;
    }
    
    .leaderboard-item .rank {
        font-size: 15px;
        width: 30px;
    }
    
    .leaderboard-item .avatar {
        width: 34px;
        height: 34px;
        font-size: 13px;
    }
    
    .leaderboard-item .info .name {
        font-size: 13px;
    }
    
    .leaderboard-item .progress-section .percentage {
        font-size: 13px;
    }
    
    .leaderboard-item .progress-section .amount {
        font-size: 10px;
    }
}
</style>

<!-- ================================================================ -->
<!-- LEADERBOARD HEADER -->
<!-- ================================================================ -->
<div class="leaderboard-header">
    <h2>🏆 Leaderboard Tabungan</h2>
    <p><?= $current_month ?> · <?= $total_users ?> peserta aktif</p>
</div>

<!-- ================================================================ -->
<!-- LEADERBOARD LIST -->
<!-- ================================================================ -->
<div class="leaderboard-list">
    <?php if (empty($leaderboard)): ?>
    <div class="empty-state">
        <div class="icon">📭</div>
        <div class="title">Belum ada data tabungan</div>
        <div class="subtitle">Mulai menabung untuk masuk leaderboard!</div>
    </div>
    <?php else: ?>
    <?php foreach ($leaderboard as $item): ?>
    <a href="<?= site_url('savings/view_user/' . $item->user_id) ?>" class="leaderboard-item">
        <!-- Rank -->
        <div class="rank <?= $item->rank == 1 ? 'gold' : ($item->rank == 2 ? 'silver' : ($item->rank == 3 ? 'bronze' : '')) ?>">
            <?php if ($item->rank == 1): ?>🥇
            <?php elseif ($item->rank == 2): ?>🥈
            <?php elseif ($item->rank == 3): ?>🥉
            <?php else: ?>#<?= $item->rank ?>
            <?php endif; ?>
        </div>
        
        <!-- Avatar -->
        <div class="avatar">
            <?= strtoupper(substr($item->username, 0, 1)) ?>
        </div>
        
        <!-- Info -->
        <div class="info">
            <div class="name">
                <?= $item->username ?>
                <span class="status-badge <?= $item->status ?>">
                    <?= $item->status == 'completed' ? '✅ Tercapai' : ($item->status == 'half' ? '📈 50%+' : '📉 Mulai') ?>
                </span>
            </div>
            <div class="detail">
                Rp <?= number_format($item->total_deposit, 0, ',', '.') ?> dari Rp <?= number_format($item->target_amount, 0, ',', '.') ?>
            </div>
        </div>
        
        <!-- Progress -->
        <div class="progress-section">
            <div class="percentage"><?= $item->progress ?>%</div>
            <div class="progress-bar-mini">
                <div class="fill" style="width: <?= $item->progress ?>%;"></div>
            </div>
            <div class="amount">Sisa Rp <?= number_format($item->remaining, 0, ',', '.') ?></div>
        </div>
    </a>
    <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- ================================================================ -->
<!-- KETERANGAN -->
<!-- ================================================================ -->
<div style="margin-top: 16px; padding: 12px 16px; background: #f8f9fa; border-radius: 10px; font-size: 12px; color: #888; text-align: center;">
    💡 Klik salah satu user untuk melihat detail tabungannya
</div>
