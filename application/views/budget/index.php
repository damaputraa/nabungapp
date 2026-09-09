<div class="container-fluid px-3 py-4">
    
    <!-- HEADER & ACTION -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3 class="font-weight-bold text-dark mb-0" style="letter-spacing: -0.5px;">Anggaran Pengeluaran</h3>
            </div>
            <p class="text-muted small mb-0 ml-md-4 pl-md-2">Tetapkan batas pengeluaran bulanan per kategori dan pantau agar tidak overbudget.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalSetBudget" style="border-radius: 12px; background: linear-gradient(135deg, #2563eb, #3b82f6); border: none;">
                <i class="fas fa-plus-circle mr-1"></i> Atur Anggaran Baru
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

    <!-- OVERBUDGET CRITICAL BANNER -->
    <?php if (!empty($overbudgets)): ?>
    <div class="alert alert-danger border-0 shadow-sm p-3 mb-4 d-flex align-items-center" style="border-radius: 16px; background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b;">
        <div style="font-size: 30px; margin-right: 15px;">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div>
            <h6 class="font-weight-bold mb-1" style="color: #7f1d1d;">Peringatan! Pengeluaran Melebihi Anggaran</h6>
            <div class="small">
                Terdapat <strong><?= count($overbudgets) ?> kategori</strong> yang melampaui batas anggaran bulan ini:
                <?php foreach ($overbudgets as $ob): ?>
                    <span class="badge badge-danger ml-1 p-1" style="font-size: 11px;">
                        <?= html_escape($ob->category) ?> (+Rp <?= number_format(abs($ob->remaining), 0, ',', '.') ?>)
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- FILTER PERIODE & STATS SUMMARY -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 18px; background: #ffffff;">
        <div class="card-body p-3 p-md-4">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 mb-3 mb-lg-0">
                    <form action="<?= site_url('budget') ?>" method="GET" id="budgetFilterForm">
                        <label class="font-weight-bold small text-muted text-uppercase mb-2 d-flex align-items-center" style="letter-spacing: 0.5px;">
                            <i class="fas fa-calendar-alt text-primary mr-2"></i> Periode Anggaran
                        </label>
                        <div class="d-flex align-items-center" style="gap: 10px;">
                            <div class="flex-grow-1">
                                <select name="month" class="form-control" onchange="document.getElementById('budgetFilterForm').submit()">
                                    <?php 
                                    $months = [
                                        '01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April',
                                        '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus',
                                        '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'
                                    ];
                                    foreach ($months as $k => $v): 
                                    ?>
                                    <option value="<?= $k ?>" <?= $selected_month == $k ? 'selected' : '' ?>><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div style="width: 120px; flex-shrink: 0;">
                                <select name="year" class="form-control" onchange="document.getElementById('budgetFilterForm').submit()">
                                    <?php for ($y = date('Y') - 2; $y <= date('Y') + 1; $y++): ?>
                                    <option value="<?= $y ?>" <?= $selected_year == $y ? 'selected' : '' ?>><?= $y ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="p-3 bg-light border-0 shadow-none h-100" style="border-radius: 14px;">
                                <span class="text-muted small d-block font-weight-bold text-uppercase" style="font-size: 11px;">Total Anggaran</span>
                                <h4 class="font-weight-bold text-dark mb-0 mt-1" style="font-size: 1.25rem;">Rp <?= number_format($total_budget, 0, ',', '.') ?></h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light border-0 shadow-none h-100" style="border-radius: 14px;">
                                <span class="text-muted small d-block font-weight-bold text-uppercase" style="font-size: 11px;">Realisasi Pengeluaran</span>
                                <h4 class="font-weight-bold <?= $total_spent > $total_budget && $total_budget > 0 ? 'text-danger' : 'text-primary' ?> mb-0 mt-1" style="font-size: 1.25rem;">
                                    Rp <?= number_format($total_spent, 0, ',', '.') ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BUDGET LIST -->
    <?php if (empty($budgets)): ?>
    <div class="card border-0 shadow-sm py-5 text-center" style="border-radius: 20px;">
        <div class="card-body">
            <div class="mb-3">
                <i class="fas fa-wallet fa-4x text-muted" style="opacity: 0.3;"></i>
            </div>
            <h5 class="font-weight-bold text-dark">Belum Ada Anggaran yang Ditetapkan</h5>
            <p class="text-muted small max-w-sm mx-auto mb-4" style="max-width: 360px;">Mulai atur batas maksimal belanja Anda per bulan untuk makanan, belanja, transportasi, atau hiburan!</p>
            <button type="button" class="btn btn-primary px-4 py-2 font-weight-bold" data-toggle="modal" data-target="#modalSetBudget" style="border-radius: 12px;">
                <i class="fas fa-plus mr-1"></i> Buat Anggaran Pertama
            </button>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <?php foreach ($budgets as $b): 
            $bar_color = '#10b981'; // green
            $badge_class = 'badge-success';
            $badge_text = 'Aman';
            if ($b->status === 'danger') {
                $bar_color = '#ef4444'; // red
                $badge_class = 'badge-danger';
                $badge_text = 'Overbudget!';
            } elseif ($b->status === 'warning') {
                $bar_color = '#f59e0b'; // amber
                $badge_class = 'badge-warning';
                $badge_text = 'Mendekati Batas';
            }
        ?>
        <div class="col-12 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px; border-left: 5px solid <?= $bar_color ?> !important;">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="font-weight-bold text-dark mb-0" style="font-size: 16px;">
                                <?= html_escape($b->category) ?>
                            </h6>
                            <span class="text-muted small">Batas: Rp <?= number_format($b->monthly_limit, 0, ',', '.') ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge <?= $badge_class ?> px-2 py-1" style="border-radius: 8px; font-size: 11px;">
                                <?= $badge_text ?> (<?= $b->percentage ?>%)
                            </span>
                            <a href="<?= site_url('budget/delete/' . $b->id) ?>" class="text-muted ml-2" onclick="return confirm('Hapus anggaran kategori ini?');" title="Hapus Anggaran">
                                <i class="fas fa-trash-alt small"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="progress mb-2" style="height: 10px; border-radius: 10px; background: #f1f5f9;">
                        <div class="progress-bar" role="progressbar" 
                             style="width: <?= min($b->percentage, 100) ?>%; background-color: <?= $bar_color ?>;" 
                             aria-valuenow="<?= $b->percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="d-flex justify-content-between text-muted small mt-2">
                        <span>Terpakai: <strong class="text-dark">Rp <?= number_format($b->spent, 0, ',', '.') ?></strong></span>
                        <span>
                            <?php if ($b->is_overbudget): ?>
                                <strong class="text-danger">Lebih: Rp <?= number_format(abs($b->remaining), 0, ',', '.') ?></strong>
                            <?php else: ?>
                                Sisa: <strong class="text-success">Rp <?= number_format($b->remaining, 0, ',', '.') ?></strong>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<!-- ================================================================= -->
<!-- MODAL: ATUR ANGGARAN KATEGORI -->
<!-- ================================================================= -->
<div class="modal fade" id="modalSetBudget" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background: linear-gradient(135deg, #2563eb, #3b82f6); border: none;">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-chart-pie mr-2"></i> Atur Anggaran Kategori</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('budget/save') ?>" method="POST">
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold small text-dark">Kategori Pengeluaran <span class="text-danger">*</span></label>
                        <input type="text" name="category" list="categoryList" class="form-control form-control-lg" placeholder="Pilih atau ketik kategori..." required style="border-radius: 12px; font-size: 15px;">
                        <datalist id="categoryList">
                            <?php foreach ($default_categories as $cat): ?>
                            <option value="<?= html_escape($cat) ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                        <small class="form-text text-muted">Contoh: Makanan & Minuman, Belanja, Hiburan, Transportasi.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold small text-dark">Batas Maksimal Bulanan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light font-weight-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                            </div>
                            <input type="text" name="monthly_limit" class="form-control form-control-lg input-rupiah" placeholder="0" required style="border-radius: 0 12px 12px 0; font-size: 18px; font-weight: 700;">
                        </div>
                        <small class="form-text text-muted">Sistem akan memberi peringatan jika pengeluaran kategori ini melampaui batas.</small>
                    </div>
                </div>
                <div class="modal-footer px-4 py-3 bg-light border-0">
                    <button type="button" class="btn btn-secondary px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold" style="border-radius: 10px; background: #2563eb;">Simpan Anggaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
