<div class="row">
    <!-- Progress Tabungan -->
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-piggy-bank"></i> Progress Tabungan - <?= $current_month ?>
                </h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <h4>Progress Menabung</h4>
                    <div style="font-size: 48px; font-weight: bold; color: #1a56db;">
                        <?= round($percentage, 1) ?>%
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mb-1">
                    <span>Rp <?= number_format($total_deposit, 0, ',', '.') ?></span>
                    <span>Target: Rp <?= number_format($target->target_amount ?? 0, 0, ',', '.') ?></span>
                </div>
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" 
                         role="progressbar" 
                         style="width: <?= $percentage ?>%;" 
                         aria-valuenow="<?= $percentage ?>" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        <?= round($percentage, 1) ?>%
                    </div>
                </div>
                
                <div class="mt-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h5>Rp <?= number_format($total_all, 0, ',', '.') ?></h5>
                                    <p>Total Tabungan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h5>Rp <?= number_format($target->target_amount ?? 0, 0, ',', '.') ?></h5>
                                    <p>Target Bulan Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="<?= site_url('savings/add') ?>" class="btn btn-primary btn-block">
                        <i class="fas fa-plus"></i> Tambah Setoran
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Riwayat Setoran -->
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-history"></i> Riwayat Setoran
                </h3>
            </div>
            <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                <?php if (empty($savings)): ?>
                <p class="text-muted text-center">Belum ada setoran tabungan</p>
                <?php else: ?>
                <ul class="list-unstyled">
                    <?php foreach ($savings as $saving): ?>
                    <li class="border-bottom py-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>Rp <?= number_format($saving->amount, 0, ',', '.') ?></strong>
                                <small class="text-muted d-block">
                                    <?= date('d-m-Y', strtotime($saving->deposit_date)) ?>
                                    <?= $saving->description ? ' - ' . $saving->description : '' ?>
                                </small>
                            </div>
                            <div>
                                <a href="<?= site_url('savings/delete/' . $saving->id) ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Hapus setoran ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
