<div class="container-fluid px-3 py-4">
    
    <!-- HEADER & ACTION -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3 class="font-weight-bold text-dark mb-0" style="letter-spacing: -0.5px;">Kantong Impian</h3>
            </div>
            <p class="text-muted small mb-0 ml-md-4 pl-md-2">Pisahkan target tabungan Anda ke dalam kantong-kantong khusus untuk mewujudkan tujuan finansial.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-info px-3 py-2 font-weight-bold shadow-sm" data-toggle="collapse" data-target="#calculatorGoalCard" style="border-radius: 12px;">
                <i class="fas fa-calculator mr-1"></i> Simulator Nabung
            </button>
            <button type="button" class="btn btn-success px-4 py-2 font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalAddGoal" style="border-radius: 12px; background: linear-gradient(135deg, #00a651, #00c853); border: none;">
                <i class="fas fa-plus-circle mr-1"></i> Buat Kantong Baru
            </button>
        </div>
    </div>

    <!-- ALERTS -->
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 14px;">
        <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 14px;">
        <i class="fas fa-exclamation-triangle mr-2"></i> <?= $this->session->flashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- STATS OVERVIEW CARDS -->
    <div class="row mb-4">
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px; background: linear-gradient(135deg, #f0fdf4, #dcfce7); border-left: 4px solid #10b981 !important;">
                <div class="card-body p-3">
                    <span class="text-muted small font-weight-bold">Dana Terkumpul</span>
                    <h4 class="font-weight-bold text-success mb-1 mt-1" style="font-size: 1.25rem;">Rp <?= number_format($summary->total_collected, 0, ',', '.') ?></h4>
                    <span class="small text-muted"><?= $summary->percentage ?>% dari total target</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-left: 4px solid #3b82f6 !important;">
                <div class="card-body p-3">
                    <span class="text-muted small font-weight-bold">Total Target Impian</span>
                    <h4 class="font-weight-bold text-primary mb-1 mt-1" style="font-size: 1.25rem;">Rp <?= number_format($summary->total_target, 0, ',', '.') ?></h4>
                    <span class="small text-muted"><?= $summary->total_goals ?> Kantong dibuat</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-left: 4px solid #f59e0b !important;">
                <div class="card-body p-3">
                    <span class="text-muted small font-weight-bold">Kantong Aktif</span>
                    <h4 class="font-weight-bold text-warning mb-1 mt-1" style="font-size: 1.25rem; color: #b45309 !important;"><?= $summary->total_goals - $summary->completed_goals ?></h4>
                    <span class="small text-muted">Sedang diperjuangkan</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px; background: linear-gradient(135deg, #f5f3ff, #ede9fe); border-left: 4px solid #8b5cf6 !important;">
                <div class="card-body p-3">
                    <span class="text-muted small font-weight-bold">Target Tercapai 🎉</span>
                    <h4 class="font-weight-bold text-purple mb-1 mt-1" style="font-size: 1.25rem; color: #6d28d9 !important;"><?= $summary->completed_goals ?></h4>
                    <span class="small text-muted">Impian terwujud</span>
                </div>
            </div>
        </div>
    </div>

    <!-- SIMULATOR & KALKULATOR NABUNG CARD (COLLAPSIBLE) -->
    <div class="collapse mb-4" id="calculatorGoalCard">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border: 1px solid #e2e8f0;">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pb-0 pt-3 px-4">
                <h5 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-calculator text-primary mr-2"></i> Simulator & Kalkulator Target Menabung
                </h5>
                <button class="btn btn-sm btn-light text-muted" type="button" data-toggle="collapse" data-target="#calculatorGoalCard" style="border-radius: 8px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-dark">Target Nominal Impian (Rp)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light font-weight-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                                </div>
                                <input type="text" id="sim_target_amount" class="form-control form-control-lg input-rupiah" placeholder="Contoh: 15.000.000" style="border-radius: 0 12px 12px 0; font-weight: 700;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-dark">Target Tanggal Ingin Tercapai</label>
                            <input type="date" id="sim_target_date" class="form-control" style="border-radius: 12px;" min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                        <div class="form-group mb-0">
                            <label class="small font-weight-bold text-dark">Tabungan Awal yang Dimiliki Saat Ini (Rp - Opsional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light" style="border-radius: 12px 0 0 12px;">Rp</span>
                                </div>
                                <input type="text" id="sim_initial_amount" class="form-control input-rupiah" placeholder="0" style="border-radius: 0 12px 12px 0;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-4 bg-white shadow-sm" style="border-radius: 16px; border: 1px solid #e2e8f0;">
                            <span class="text-muted small font-weight-bold text-uppercase d-block mb-3">
                                <i class="fas fa-magic text-warning mr-1"></i> Rekomendasi Alokasi Tabungan yang Perlu Anda Sisihkan:
                            </span>
                            <div class="row text-center mb-3">
                                <div class="col-4 border-right">
                                    <span class="text-muted small d-block">Per Hari</span>
                                    <h4 class="font-weight-bold text-success mb-0 mt-1" id="sim_result_day" style="font-size: 1.15rem;">Rp 0</h4>
                                </div>
                                <div class="col-4 border-right">
                                    <span class="text-muted small d-block">Per Minggu</span>
                                    <h4 class="font-weight-bold text-primary mb-0 mt-1" id="sim_result_week" style="font-size: 1.15rem;">Rp 0</h4>
                                </div>
                                <div class="col-4">
                                    <span class="text-muted small d-block">Per Bulan</span>
                                    <h4 class="font-weight-bold text-purple mb-0 mt-1" id="sim_result_month" style="font-size: 1.15rem; color: #7c3aed !important;">Rp 0</h4>
                                </div>
                            </div>
                            <div class="pt-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div class="small text-muted" id="sim_duration_text">
                                    <i class="fas fa-info-circle mr-1 text-info"></i> Masukkan nominal target dan tanggal impian untuk melihat simulasi.
                                </div>
                                <button type="button" class="btn btn-sm btn-success px-3 py-2 font-weight-bold shadow-sm" id="btnApplySimToGoal" style="border-radius: 10px; background: linear-gradient(135deg, #00a651, #00c853); border: none;">
                                    <i class="fas fa-plus mr-1"></i> Terapkan ke Kantong Baru
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER TABS -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="btn-group p-1 bg-white shadow-sm" style="border-radius: 12px; border: 1px solid #e2e8f0;">
            <a href="<?= site_url('goals') ?>" class="btn btn-sm <?= empty($status_filter) ? 'btn-success font-weight-bold' : 'btn-light text-muted' ?>" style="border-radius: 8px; font-size: 13px;">
                Semua (<?= $summary->total_goals ?>)
            </a>
            <a href="<?= site_url('goals?status=active') ?>" class="btn btn-sm <?= $status_filter === 'active' ? 'btn-success font-weight-bold' : 'btn-light text-muted' ?>" style="border-radius: 8px; font-size: 13px;">
                Aktif (<?= $summary->total_goals - $summary->completed_goals ?>)
            </a>
            <a href="<?= site_url('goals?status=completed') ?>" class="btn btn-sm <?= $status_filter === 'completed' ? 'btn-success font-weight-bold' : 'btn-light text-muted' ?>" style="border-radius: 8px; font-size: 13px;">
                Tercapai (<?= $summary->completed_goals ?>)
            </a>
        </div>
    </div>

    <!-- GOALS GRID -->
    <?php if (empty($goals)): ?>
    <div class="card border-0 shadow-sm py-5 text-center" style="border-radius: 20px;">
        <div class="card-body">
            <div class="mb-3">
                <i class="fas fa-piggy-bank fa-4x text-muted" style="opacity: 0.3;"></i>
            </div>
            <h5 class="font-weight-bold text-dark">Belum Ada Kantong Impian</h5>
            <p class="text-muted small max-w-sm mx-auto mb-4" style="max-width: 360px;">Mulai buat kantong impian pertamamu, seperti beli laptop, tabungan liburan, atau dana darurat!</p>
            <button type="button" class="btn btn-success px-4 py-2 font-weight-bold" data-toggle="modal" data-target="#modalAddGoal" style="border-radius: 12px;">
                <i class="fas fa-plus mr-1"></i> Buat Impian Sekarang
            </button>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <?php foreach ($goals as $goal): ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100 position-relative" style="border-radius: 20px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
                <!-- Top Color Bar -->
                <div style="height: 6px; background: <?= html_escape($goal->color ?: '#00a651') ?>;"></div>
                
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <!-- Header Card -->
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 46px; height: 46px; border-radius: 14px; background: <?= html_escape($goal->color ?: '#00a651') ?>15; color: <?= html_escape($goal->color ?: '#00a651') ?>; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                    <i class="fas <?= html_escape($goal->icon ?: 'fa-bullseye') ?>"></i>
                                </div>
                                <div>
                                    <h5 class="font-weight-bold text-dark mb-0 text-truncate" style="max-width: 170px;" title="<?= html_escape($goal->title) ?>">
                                        <?= html_escape($goal->title) ?>
                                    </h5>
                                    <span class="badge badge-light border text-muted" style="font-size: 11px;">
                                        <?= html_escape($goal->category ?: 'Umum') ?>
                                    </span>
                                </div>
                            </div>
                            
                            <?php if ($goal->status === 'completed'): ?>
                            <span class="badge badge-success px-2 py-1" style="font-size: 11px; border-radius: 8px;">
                                <i class="fas fa-check-circle mr-1"></i> Tercapai
                            </span>
                            <?php else: ?>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 8px;">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right shadow-sm border-0" style="border-radius: 12px;">
                                    <a class="dropdown-item text-danger small" href="<?= site_url('goals/delete/' . $goal->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kantong impian ini?');">
                                        <i class="fas fa-trash-alt mr-2"></i> Hapus Kantong
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Nominal & Progress -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-baseline mb-1">
                                <span class="text-muted small">Terkumpul</span>
                                <span class="font-weight-bold text-dark" style="font-size: 16px;">
                                    Rp <?= number_format($goal->current_amount, 0, ',', '.') ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline text-muted small mb-2">
                                <span>Target: Rp <?= number_format($goal->target_amount, 0, ',', '.') ?></span>
                                <span class="font-weight-bold" style="color: <?= html_escape($goal->color ?: '#00a651') ?>;"><?= $goal->percentage ?>%</span>
                            </div>
                            
                            <div class="progress" style="height: 10px; border-radius: 10px; background: #e2e8f0; overflow: hidden;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                                     style="width: <?= $goal->percentage ?>%; background-color: <?= html_escape($goal->color ?: '#00a651') ?>;" 
                                     aria-valuenow="<?= $goal->percentage ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <!-- Deadline & Notes Info -->
                        <div class="d-flex justify-content-between align-items-center text-muted small mb-3 pt-2 border-top">
                            <div>
                                <i class="far fa-calendar-alt mr-1"></i>
                                <?php if ($goal->deadline): ?>
                                    <?= date('d M Y', strtotime($goal->deadline)) ?>
                                    <?php if ($goal->status !== 'completed'): ?>
                                        <span class="badge <?= $goal->days_left < 0 ? 'badge-danger' : ($goal->days_left <= 7 ? 'badge-warning' : 'badge-light') ?> ml-1">
                                            <?= $goal->days_left < 0 ? 'Lewat deadline' : ($goal->days_left == 0 ? 'Hari ini' : $goal->days_left . ' hari lagi') ?>
                                        </span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span>Tanpa tenggat</span>
                                <?php endif; ?>
                            </div>
                            <div>
                                Sisa: <strong class="text-dark">Rp <?= number_format($goal->remaining_amount, 0, ',', '.') ?></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="mt-2">
                        <?php if ($goal->status !== 'completed'): ?>
                        <button type="button" class="btn btn-block font-weight-bold py-2 shadow-sm" 
                                data-toggle="modal" data-target="#modalDepositGoal" 
                                data-id="<?= $goal->id ?>" 
                                data-title="<?= html_escape($goal->title) ?>"
                                style="background: <?= html_escape($goal->color ?: '#00a651') ?>; color: #fff; border-radius: 12px; border: none;">
                            <i class="fas fa-coins mr-1"></i> Isi Kantong Ini
                        </button>
                        <?php else: ?>
                        <button type="button" class="btn btn-block btn-light text-success font-weight-bold py-2 disabled" style="border-radius: 12px;">
                            <i class="fas fa-check-circle mr-1"></i> Impian Tercapai Penuh
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<!-- ================================================================= -->
<!-- MODAL: BUAT KANTONG IMPIAN BARU -->
<!-- ================================================================= -->
<div class="modal fade" id="modalAddGoal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background: linear-gradient(135deg, #00a651, #00c853); border: none;">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-sparkles mr-2"></i> Buat Kantong Impian Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('goals/create') ?>" method="POST">
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold small text-dark">Nama Impian / Tujuan <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Contoh: Beli Laptop Baru, Liburan Bali" required style="border-radius: 12px; font-size: 15px;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold small text-dark">Target Dana yang Dibutuhkan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light font-weight-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                            </div>
                            <input type="text" name="target_amount" class="form-control form-control-lg input-rupiah" placeholder="0" required style="border-radius: 0 12px 12px 0; font-size: 16px; font-weight: 700;">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold small text-dark">Saldo Awal (Opsional)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light font-weight-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                            </div>
                            <input type="text" name="initial_amount" class="form-control form-control-lg input-rupiah" placeholder="0" style="border-radius: 0 12px 12px 0; font-size: 16px;">
                        </div>
                        <small class="form-text text-muted">Jika sudah ada dana awal yang disisihkan.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold small text-dark">Target Tenggat Selesai</label>
                            <input type="date" name="deadline" class="form-control" style="border-radius: 12px;">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold small text-dark">Kategori</label>
                            <select name="category" class="form-control" style="border-radius: 12px;">
                                <option value="Gadget & Elektronik">Gadget & Elektronik</option>
                                <option value="Kendaraan">Kendaraan</option>
                                <option value="Liburan & Traveling">Liburan & Traveling</option>
                                <option value="Dana Darurat">Dana Darurat</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Rumah & Properti">Rumah & Properti</option>
                                <option value="Investasi">Investasi</option>
                                <option value="Umum" selected>Lainnya / Umum</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold small text-dark">Pilih Ikon</label>
                            <select name="icon" class="form-control" style="border-radius: 12px;">
                                <option value="fa-laptop">&#xf109; Laptop / Gadget</option>
                                <option value="fa-motorcycle">&#xf21c; Motor</option>
                                <option value="fa-car">&#xf1b9; Mobil</option>
                                <option value="fa-home">&#xf015; Rumah / Tempat Tinggal</option>
                                <option value="fa-plane">&#xf072; Liburan / Tiket</option>
                                <option value="fa-shield-alt">&#xf3ed; Dana Darurat</option>
                                <option value="fa-graduation-cap">&#xf19d; Pendidikan</option>
                                <option value="fa-heart">&#xf004; Pernikahan / Keluarga</option>
                                <option value="fa-bullseye" selected>&#xf140; Target Umum</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold small text-dark">Warna Kartu</label>
                            <select name="color" class="form-control" style="border-radius: 12px;">
                                <option value="#00a651" selected>🟢 Emerald Green</option>
                                <option value="#2563eb">🔵 Royal Blue</option>
                                <option value="#7c3aed">🟣 Purple Violet</option>
                                <option value="#d97706">🟠 Amber Orange</option>
                                <option value="#e11d48">🔴 Crimson Rose</option>
                                <option value="#0d9488">🌊 Teal Modern</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-bold small text-dark">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Catatan motivasi atau rincian impian..." style="border-radius: 12px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-3 bg-light border-0">
                    <button type="button" class="btn btn-secondary px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4 py-2 font-weight-bold" style="border-radius: 10px; background: #00a651;">Simpan Kantong Impian</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================================================================= -->
<!-- MODAL: ISI TABUNGAN KE KANTONG -->
<!-- ================================================================= -->
<div class="modal fade" id="modalDepositGoal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background: linear-gradient(135deg, #00a651, #00c853); border: none;">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-coins mr-2"></i> Isi Tabungan ke Kantong</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('goals/deposit') ?>" method="POST">
                <input type="hidden" name="goal_id" id="depositGoalId">
                <div class="modal-body p-4">
                    <div class="p-3 mb-3 bg-light" style="border-radius: 14px; border: 1px solid #e2e8f0;">
                        <span class="text-muted small d-block">Menabung untuk:</span>
                        <strong class="text-dark font-weight-bold" id="depositGoalTitle" style="font-size: 16px;">-</strong>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold small text-dark">Nominal Setoran <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light font-weight-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                            </div>
                            <input type="text" name="amount" class="form-control form-control-lg input-rupiah" placeholder="0" required autofocus style="border-radius: 0 12px 12px 0; font-size: 18px; font-weight: 700;">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold small text-dark">Tanggal Setoran <span class="text-danger">*</span></label>
                        <input type="date" name="deposit_date" class="form-control" value="<?= date('Y-m-d') ?>" required style="border-radius: 12px;">
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-bold small text-dark">Keterangan (Opsional)</label>
                        <input type="text" name="description" class="form-control" placeholder="Contoh: Sisihan gaji bulan ini" style="border-radius: 12px;">
                    </div>
                </div>
                <div class="modal-footer px-4 py-3 bg-light border-0">
                    <button type="button" class="btn btn-secondary px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4 py-2 font-weight-bold" style="border-radius: 10px; background: #00a651;">Simpan Setoran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Deposit Modal binding
    $('#modalDepositGoal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var goalId = button.data('id');
        var goalTitle = button.data('title');
        
        var modal = $(this);
        modal.find('#depositGoalId').val(goalId);
        modal.find('#depositGoalTitle').text(goalTitle);
    });

    // Simulator Tabungan Logic
    var targetInput = document.getElementById('sim_target_amount');
    var dateInput = document.getElementById('sim_target_date');
    var initialInput = document.getElementById('sim_initial_amount');
    var resDay = document.getElementById('sim_result_day');
    var resWeek = document.getElementById('sim_result_week');
    var resMonth = document.getElementById('sim_result_month');
    var durationText = document.getElementById('sim_duration_text');
    var btnApply = document.getElementById('btnApplySimToGoal');

    function parseRupiah(str) {
        if (!str) return 0;
        var clean = str.toString().replace(/[^0-9]/g, '');
        return parseInt(clean, 10) || 0;
    }

    function formatRupiah(num) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.max(0, Math.round(num)));
    }

    function calculateSimulation() {
        var target = parseRupiah(targetInput.value);
        var initial = parseRupiah(initialInput.value);
        var targetDateVal = dateInput.value;

        if (target <= 0 || !targetDateVal) {
            resDay.innerText = 'Rp 0';
            resWeek.innerText = 'Rp 0';
            resMonth.innerText = 'Rp 0';
            durationText.innerHTML = '<i class="fas fa-info-circle mr-1 text-info"></i> Masukkan target nominal dan tanggal impian untuk melihat simulasi.';
            return;
        }

        var today = new Date();
        today.setHours(0, 0, 0, 0);
        var deadline = new Date(targetDateVal);
        deadline.setHours(0, 0, 0, 0);

        var diffTime = deadline.getTime() - today.getTime();
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays <= 0) {
            resDay.innerText = 'Rp 0';
            resWeek.innerText = 'Rp 0';
            resMonth.innerText = 'Rp 0';
            durationText.innerHTML = '<span class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Tanggal target harus lebih besar dari hari ini!</span>';
            return;
        }

        var needed = Math.max(0, target - initial);
        if (needed <= 0) {
            resDay.innerText = 'Tercapai!';
            resWeek.innerText = 'Tercapai!';
            resMonth.innerText = 'Tercapai!';
            durationText.innerHTML = '<span class="text-success"><i class="fas fa-check-circle mr-1"></i> Tabungan awal Anda sudah mencukupi target!</span>';
            return;
        }

        var perDay = needed / diffDays;
        var perWeek = needed / (diffDays / 7);
        var perMonth = needed / (diffDays / 30.416);

        resDay.innerText = formatRupiah(perDay);
        resWeek.innerText = formatRupiah(perWeek);
        resMonth.innerText = formatRupiah(perMonth);

        var months = Math.floor(diffDays / 30);
        var daysRemainder = diffDays % 30;
        var durationStr = diffDays + ' hari';
        if (months > 0) {
            durationStr += ' (~' + months + ' bulan ' + (daysRemainder > 0 ? daysRemainder + ' hari' : '') + ')';
        }
        durationText.innerHTML = '<i class="fas fa-calendar-check mr-1 text-success"></i> Sisa waktu: <strong>' + durationStr + '</strong> untuk mengumpulkan <strong>' + formatRupiah(needed) + '</strong>.';
    }

    if (targetInput) targetInput.addEventListener('input', calculateSimulation);
    if (dateInput) dateInput.addEventListener('change', calculateSimulation);
    if (initialInput) initialInput.addEventListener('input', calculateSimulation);

    if (btnApply) {
        btnApply.addEventListener('click', function() {
            var modal = $('#modalAddGoal');
            if (targetInput.value) {
                modal.find('input[name="target_amount"]').val(targetInput.value);
            }
            if (initialInput.value) {
                modal.find('input[name="initial_amount"]').val(initialInput.value);
            }
            if (dateInput.value) {
                modal.find('input[name="deadline"]').val(dateInput.value);
            }
            modal.modal('show');
        });
    }
});
</script>
