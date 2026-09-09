<div class="container-fluid px-3 py-4">
    <!-- HEADER & ACTION -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3 class="font-weight-bold text-dark mb-0" style="letter-spacing: -0.5px;">Tantangan Nabung & Lencana Prestasi</h3>
            </div>
            <p class="text-muted small mb-0 ml-md-4 pl-md-2">Bentuk kebiasaan finansial yang hebat dengan gamifikasi lencana dan tantangan menabung terstruktur.</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalAddChallenge" style="border-radius: 12px; background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none;">
                <i class="fas fa-plus-circle mr-1"></i> Mulai Tantangan Baru
            </button>
        </div>
    </div>

    <!-- FLASH MESSAGES -->
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 14px;">
        <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- SECTION 1: BADGES & ACHIEVEMENTS -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                <div>
                    <h5 class="font-weight-bold text-dark mb-0">
                        <i class="fas fa-award text-warning mr-2"></i> Lencana & Prestasi Anda
                    </h5>
                    <p class="text-muted small mb-0">Raih berbagai pencapaian finansial untuk meningkatkan disiplin keuangan.</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge badge-warning text-dark font-weight-bold px-3 py-2" style="border-radius: 10px; font-size: 0.85rem;">
                        <?= $unlocked_count ?> dari <?= $total_badges ?> Lencana Terbuka (<?= $badge_percentage ?>%)
                    </span>
                </div>
            </div>
            <div class="progress mt-3" style="height: 8px; border-radius: 10px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $badge_percentage ?>%;" aria-valuenow="<?= $badge_percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <?php foreach ($badges as $badge): 
                    $is_unlocked = !empty($badge['unlocked']);
                    $b_name = $badge['title'] ?? $badge['name'] ?? 'Lencana';
                    $b_desc = $badge['description'] ?? $badge['desc'] ?? '';
                    $b_color = $badge['color'] ?? '#3b82f6';
                    $b_icon = $badge['icon'] ?? 'fa-medal';
                    $b_progress = $badge['progress'] ?? 0;
                    $b_progress_text = $badge['progress_text'] ?? (isset($badge['current'], $badge['target']) ? ($badge['current'] . ' / ' . $badge['target']) : '');
                ?>
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="card border h-100 p-3 shadow-xs" style="border-radius: 16px; <?= $is_unlocked ? 'background: linear-gradient(135deg, #fffbeb, #ffffff); border-color: #fde68a !important;' : 'background: #f8fafc; opacity: 0.85;' ?>">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center mr-3 shadow-sm" style="width: 52px; height: 52px; border-radius: 16px; background-color: <?= $is_unlocked ? $b_color : '#94a3b8' ?>; color: #fff; font-size: 1.4rem; flex-shrink: 0;">
                                <i class="fas <?= $b_icon ?>"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="font-weight-bold mb-0 <?= $is_unlocked ? 'text-dark' : 'text-muted' ?>"><?= htmlspecialchars($b_name) ?></h6>
                                    <?php if ($is_unlocked): ?>
                                        <span class="badge badge-success px-2 py-1" style="border-radius: 6px; font-size: 0.65rem;">
                                            <i class="fas fa-check"></i> Terbuka
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-light border text-muted px-2 py-1" style="border-radius: 6px; font-size: 0.65rem;">
                                            <i class="fas fa-lock"></i> Terkunci
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <p class="small text-muted mb-2" style="font-size: 0.78rem; line-height: 1.3;"><?= htmlspecialchars($b_desc) ?></p>
                                
                                <?php if (!$is_unlocked): ?>
                                <div class="progress" style="height: 5px; border-radius: 6px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $b_progress ?>%;"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1" style="font-size: 0.7rem; color: #64748b;">
                                    <span>Progres</span>
                                    <span><?= htmlspecialchars($b_progress_text) ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- SECTION 2: SAVINGS CHALLENGES -->
    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-piggy-bank text-primary mr-2"></i> Tantangan Menabung Aktif
                </h5>
                <p class="text-muted small mb-0">Centang setiap hari atau minggu saat berhasil menyisihkan tabungan.</p>
            </div>
        </div>
        <div class="card-body p-4">
            <?php if (empty($challenges)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-calendar-check fa-3x text-muted mb-3"></i>
                    <h5 class="font-weight-bold text-dark">Belum Ada Tantangan Menabung Aktif</h5>
                    <p class="text-muted small">Pilih salah satu template tantangan populer berikut untuk langsung memulai:</p>
                    
                    <div class="d-flex justify-content-center gap-3 flex-wrap mt-3">
                        <form action="<?= site_url('challenges/create') ?>" method="POST" class="d-inline">
                            <input type="hidden" name="challenge_type" value="30_days">
                            <input type="hidden" name="title" value="Tantangan 30 Hari Menabung">
                            <input type="hidden" name="target_amount" value="1000000">
                            <button type="submit" class="btn btn-outline-primary px-4 py-2 font-weight-bold" style="border-radius: 12px;">
                                <i class="fas fa-calendar-day mr-1"></i> Tantangan 30 Hari (Target Rp 1 Juta)
                            </button>
                        </form>
                        <form action="<?= site_url('challenges/create') ?>" method="POST" class="d-inline">
                            <input type="hidden" name="challenge_type" value="52_weeks">
                            <input type="hidden" name="title" value="Tantangan 52 Minggu Nabung">
                            <input type="hidden" name="target_amount" value="5000000">
                            <button type="submit" class="btn btn-outline-success px-4 py-2 font-weight-bold" style="border-radius: 12px;">
                                <i class="fas fa-calendar-week mr-1"></i> Tantangan 52 Minggu (Target Rp 5 Juta)
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($challenges as $ch): 
                    $completed = json_decode($ch->completed_steps, true) ?: [];
                    $total_steps = ($ch->challenge_type === '30_days') ? 30 : 52;
                    $step_amount = round($ch->target_amount / $total_steps);
                    $step_label = ($ch->challenge_type === '30_days') ? 'Hari' : 'Minggu';
                    $percent = $ch->target_amount > 0 ? min(100, round(($ch->current_amount / $ch->target_amount) * 100, 1)) : 0;
                ?>
                <div class="card border shadow-xs mb-4" style="border-radius: 18px;" id="challenge_card_<?= $ch->id ?>">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="font-weight-bold text-dark mb-0"><?= htmlspecialchars($ch->title) ?></h5>
                                    <span class="badge badge-primary px-2 py-1" style="border-radius: 6px; font-size: 0.75rem;">
                                        <?= ($ch->challenge_type === '30_days') ? '30 Hari' : '52 Minggu' ?>
                                    </span>
                                </div>
                                <p class="text-muted small mb-0 mt-1">Setoran per <?= strtolower($step_label) ?>: <strong>Rp <?= number_format($step_amount, 0, ',', '.') ?></strong></p>
                            </div>
                            <div class="text-md-right">
                                <h4 class="font-weight-bold text-success mb-0" id="current_amount_<?= $ch->id ?>">
                                    Rp <?= number_format($ch->current_amount, 0, ',', '.') ?>
                                </h4>
                                <span class="text-muted small">dari target Rp <?= number_format($ch->target_amount, 0, ',', '.') ?> (<span id="percent_text_<?= $ch->id ?>"><?= $percent ?>%</span>)</span>
                            </div>
                        </div>

                        <!-- PROGRESS BAR -->
                        <div class="progress mb-4" style="height: 10px; border-radius: 10px;">
                            <div class="progress-bar bg-success" id="progress_bar_<?= $ch->id ?>" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- AUTO DEPOSIT OPTION -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="autoDeposit_<?= $ch->id ?>" checked>
                                <label class="custom-control-label small text-muted" for="autoDeposit_<?= $ch->id ?>">
                                    Otomatis catat setoran ke rekening tabungan saat kotak dicentang
                                </label>
                            </div>
                            <a href="<?= site_url('challenges/delete/' . $ch->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus tantangan menabung ini?')" style="border-radius: 8px;">
                                <i class="fas fa-trash mr-1"></i> Hapus Tantangan
                            </a>
                        </div>

                        <!-- STEPS GRID -->
                        <div class="d-flex flex-wrap gap-2 steps-grid">
                            <?php for ($s = 1; $s <= $total_steps; $s++): 
                                $is_done = in_array($s, $completed);
                            ?>
                            <button type="button" 
                                class="btn step-btn <?= $is_done ? 'btn-success' : 'btn-outline-secondary' ?>" 
                                data-challenge="<?= $ch->id ?>" 
                                data-step="<?= $s ?>" 
                                data-amount="<?= $step_amount ?>" 
                                style="width: 58px; height: 52px; border-radius: 12px; font-size: 0.75rem; padding: 4px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <strong><?= $step_label ?> <?= $s ?></strong>
                                <i class="fas <?= $is_done ? 'fa-check-circle' : 'fa-circle' ?>" style="font-size: 0.8rem; margin-top: 2px;"></i>
                            </button>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- MODAL ADD CHALLENGE -->
<div class="modal fade" id="modalAddChallenge" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div>
                    <h5 class="modal-title font-weight-bold text-dark">Mulai Tantangan Menabung Baru</h5>
                    <p class="text-muted small mb-0">Tantang diri Anda untuk konsisten menyisihkan uang setiap hari atau minggu.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('challenges/create') ?>" method="POST">
                <div class="modal-body px-4 py-3">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Tipe Tantangan</label>
                        <select name="challenge_type" id="sel_challenge_type" class="form-control" style="border-radius: 10px;">
                            <option value="30_days">Tantangan 30 Hari (Harian)</option>
                            <option value="52_weeks">Tantangan 52 Minggu (Mingguan)</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Nama Tantangan</label>
                        <input type="text" name="title" id="inp_challenge_title" class="form-control" placeholder="Tantangan 30 Hari Menabung" style="border-radius: 10px;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Target Total Tabungan (Rp)</label>
                        <input type="text" name="target_amount" id="inp_challenge_target" class="form-control rupiah-input font-weight-bold" value="1.000.000" style="border-radius: 10px; font-size: 1.1rem;">
                        <small class="text-muted d-block mt-1" id="step_estimation_text">Estimasi setoran per hari: Rp 33.333</small>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold" style="border-radius: 10px;">Mulai Tantangan!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    var selType = document.getElementById('sel_challenge_type');
    var inpTitle = document.getElementById('inp_challenge_title');
    var inpTarget = document.getElementById('inp_challenge_target');
    var txtEst = document.getElementById('step_estimation_text');

    if (selType) {
        selType.addEventListener('change', function() {
            if (this.value === '30_days') {
                inpTitle.value = 'Tantangan 30 Hari Menabung';
                inpTarget.value = '1.000.000';
                txtEst.textContent = 'Estimasi setoran per hari: Rp 33.333';
            } else {
                inpTitle.value = 'Tantangan 52 Minggu Nabung';
                inpTarget.value = '5.000.000';
                txtEst.textContent = 'Estimasi setoran per minggu: Rp 96.154';
            }
        });
    }

    document.querySelectorAll('.step-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var challengeId = this.dataset.challenge;
            var stepNum = this.dataset.step;
            var stepAmount = this.dataset.amount;
            var autoDep = document.getElementById('autoDeposit_' + challengeId);
            var autoDepVal = (autoDep && autoDep.checked) ? 1 : 0;
            var clickedBtn = this;

            clickedBtn.disabled = true;

            var formData = new FormData();
            formData.append('challenge_id', challengeId);
            formData.append('step_number', stepNum);
            formData.append('step_amount', stepAmount);
            formData.append('auto_deposit', autoDepVal);

            fetch('<?= site_url('challenges/toggle_step') ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                clickedBtn.disabled = false;
                if (data.status) {
                    var icon = clickedBtn.querySelector('i');
                    if (data.is_completed) {
                        clickedBtn.classList.remove('btn-outline-secondary');
                        clickedBtn.classList.add('btn-success');
                        icon.classList.remove('fa-circle');
                        icon.classList.add('fa-check-circle');
                    } else {
                        clickedBtn.classList.remove('btn-success');
                        clickedBtn.classList.add('btn-outline-secondary');
                        icon.classList.remove('fa-check-circle');
                        icon.classList.add('fa-circle');
                    }

                    var amtEl = document.getElementById('current_amount_' + challengeId);
                    var pctEl = document.getElementById('percent_text_' + challengeId);
                    var prgEl = document.getElementById('progress_bar_' + challengeId);
                    if (amtEl) amtEl.textContent = 'Rp ' + formatRupiah(data.current_amount);
                    if (pctEl) pctEl.textContent = data.percentage + '%';
                    if (prgEl) {
                        prgEl.style.width = data.percentage + '%';
                        prgEl.setAttribute('aria-valuenow', data.percentage);
                    }
                }
            })
            .catch(err => {
                clickedBtn.disabled = false;
                console.error('Error toggling step:', err);
            });
        });
    });
});
</script>

