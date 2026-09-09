<?php
$month_num = $selected_month ?? date('m');
$year_num = $selected_year ?? date('Y');
$m_name = $month_name ?? date('F');

// Hitung agregat bulan ini
$total_target_platform = 0;
$total_deposit_platform = 0;
foreach ($users as $u) {
    $total_target_platform += ($u->target->target_amount ?? 0);
    $total_deposit_platform += ($u->total_deposit ?? 0);
}
$overall_pct = ($total_target_platform > 0) ? min(($total_deposit_platform / $total_target_platform) * 100, 100) : 0;
?>

<div class="row mb-3">
    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-bullseye mr-2 text-primary"></i> Target Tabungan Pengguna
            </h3>
            <p class="text-muted mb-0">Kelola dan pantau pencapaian target menabung bulanan setiap pengguna.</p>
        </div>
        
        <!-- Filter Periode Bulan & Tahun -->
        <div class="mt-2 mt-md-0">
            <form action="<?= site_url('admin/targets') ?>" method="GET" class="form-inline bg-white p-2 rounded shadow-sm border">
                <label class="mr-2 small font-weight-bold text-muted">Periode:</label>
                <select name="month" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                    <?php 
                    $months = [
                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                        '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                        '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                    ];
                    foreach ($months as $k => $v): 
                    ?>
                    <option value="<?= $k ?>" <?= $month_num == $k ? 'selected' : '' ?>><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="year" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                    <?php for ($y = date('Y'); $y >= date('Y') - 4; $y--): ?>
                    <option value="<?= $y ?>" <?= $year_num == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-filter"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Alert Notifikasi -->
<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show shadow-sm">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show shadow-sm">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-exclamation-circle mr-2"></i> <?= $this->session->flashdata('error') ?>
</div>
<?php endif; ?>

<!-- Metrik Pencapaian Periode Ini -->
<div class="row mb-3">
    <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-3">
                <span class="text-muted small text-uppercase font-weight-bold">Total Target Seluruh User</span>
                <h4 class="font-weight-bold text-primary mt-1 mb-0">Rp <?= number_format($total_target_platform, 0, ',', '.') ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-3">
                <span class="text-muted small text-uppercase font-weight-bold">Total Setoran Terkumpul</span>
                <h4 class="font-weight-bold text-success mt-1 mb-0">Rp <?= number_format($total_deposit_platform, 0, ',', '.') ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-3">
                <span class="text-muted small text-uppercase font-weight-bold">Progress Rata-rata</span>
                <h4 class="font-weight-bold text-dark mt-1 mb-0"><?= round($overall_pct, 1) ?>%</h4>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Target Pengguna -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="font-weight-bold text-dark mb-0">
            <i class="fas fa-tasks mr-2 text-primary"></i> Target Periode: <?= $m_name ?> <?= $year_num ?>
        </h5>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="table-targets" class="table table-hover table-bordered w-100">
                <thead>
                    <tr>
                        <th style="width: 40px;" class="text-center">No</th>
                        <th>Pengguna</th>
                        <th>Target (Rp)</th>
                        <th>Realisasi Setoran (Rp)</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th style="width: 130px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($users as $user): 
                        $target_val = (float) ($user->target->target_amount ?? 0);
                        $deposit_val = (float) ($user->total_deposit ?? 0);
                        $pct = ($target_val > 0) ? min(($deposit_val / $target_val) * 100, 100) : 0;
                        $is_reached = ($pct >= 100);
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold text-muted"><?= $no++ ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-2 font-weight-bold" style="width: 34px; height: 34px; border-radius: 50%; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-size: 13px;">
                                    <?= strtoupper(substr($user->username, 0, 1)) ?>
                                </div>
                                <div>
                                    <strong class="text-dark"><?= htmlspecialchars($user->username) ?></strong>
                                    <div class="small text-muted"><?= htmlspecialchars($user->email ?? '') ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="font-weight-bold">
                            Rp <?= number_format($target_val, 0, ',', '.') ?>
                        </td>
                        <td class="font-weight-bold text-success">
                            Rp <?= number_format($deposit_val, 0, ',', '.') ?>
                        </td>
                        <td style="min-width: 150px;">
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="font-weight-bold"><?= round($pct, 1) ?>%</span>
                                <span class="text-muted">Sisa: Rp <?= number_format(max(0, $target_val - $deposit_val), 0, ',', '.') ?></span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px;">
                                <div class="progress-bar <?= $is_reached ? 'bg-success' : ($pct >= 50 ? 'bg-info' : 'bg-primary') ?>" 
                                     style="width: <?= $pct ?>%;"></div>
                            </div>
                        </td>
                        <td>
                            <?php if ($is_reached): ?>
                            <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Tercapai</span>
                            <?php elseif ($pct >= 50): ?>
                            <span class="badge badge-info px-2 py-1"><i class="fas fa-chart-line mr-1"></i> Berjalan</span>
                            <?php else: ?>
                            <span class="badge badge-warning px-2 py-1"><i class="fas fa-hourglass-start mr-1"></i> Dimulai</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary font-weight-bold" data-toggle="modal" data-target="#modalTarget<?= $user->id ?>">
                                <i class="fas fa-edit mr-1"></i> Set Target
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Set Target untuk Tiap User -->
<?php foreach ($users as $user): ?>
<div class="modal fade" id="modalTarget<?= $user->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-bullseye mr-2"></i> Atur Target: <?= htmlspecialchars($user->username) ?>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('admin/set_target') ?>" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="user_id" value="<?= $user->id ?>">
                    <input type="hidden" name="month" value="<?= $month_num ?>">
                    <input type="hidden" name="year" value="<?= $year_num ?>">
                    
                    <div class="alert alert-light border mb-3">
                        <small class="text-muted d-block">Periode Tabungan:</small>
                        <strong><?= $m_name ?> <?= $year_num ?></strong>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">Nominal Target Tabungan (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold">Rp</span>
                            </div>
                            <input type="text" inputmode="numeric" name="target_amount" class="form-control form-control-lg font-weight-bold text-primary rupiah-input" 
                                   value="<?= (int) ($user->target->target_amount ?? 500000) ?>" 
                                   placeholder="0" required autocomplete="off">
                        </div>
                        <small class="form-text text-muted mt-1">
                            Setoran tabungan bulan ini saat ini: <strong>Rp <?= number_format($user->total_deposit ?? 0, 0, ',', '.') ?></strong>.
                        </small>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold shadow-sm">
                        <i class="fas fa-save mr-1"></i> Simpan Target
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
