<div class="container-fluid px-3 py-4">
    <!-- HEADER & ACTION -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3 class="font-weight-bold text-dark mb-0" style="letter-spacing: -0.5px;">Dompet & Rekening</h3>
            </div>
            <p class="text-muted small mb-0 ml-md-4 pl-md-2">Kelola berbagai sumber dana, rekening bank, e-wallet, dan lakukan transfer saldo dengan mudah.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn btn-outline-primary px-3 py-2 font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalTransferWallet" style="border-radius: 12px;">
                <i class="fas fa-exchange-alt mr-1"></i> Transfer Saldo
            </button>
            <button type="button" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalAddWallet" style="border-radius: 12px; background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none;">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Dompet
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

    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 14px;">
        <i class="fas fa-exclamation-triangle mr-2"></i> <?= $this->session->flashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- TOTAL BALANCE BANNER -->
    <div class="card border-0 shadow-sm mb-4 text-white position-relative overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);">
        <div class="card-body p-4 position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-md-7 mb-3 mb-md-0">
                    <span class="badge badge-light text-primary px-3 py-1 font-weight-bold mb-2" style="border-radius: 20px; font-size: 0.75rem;">
                        <i class="fas fa-wallet mr-1"></i> Total Likuiditas Finansial
                    </span>
                    <h5 class="text-white-50 mb-1" style="font-size: 0.95rem;">Total Saldo Gabungan</h5>
                    <h2 class="font-weight-bold text-white mb-0" style="letter-spacing: -0.5px;">
                        Rp <?= number_format($total_balance, 0, ',', '.') ?>
                    </h2>
                    <p class="text-white-50 small mt-2 mb-0">
                        Tersebar di <span class="text-white font-weight-bold"><?= count($wallets) ?></span> dompet & rekening aktif.
                    </p>
                </div>
                <div class="col-md-5 text-md-right">
                    <div class="d-inline-flex gap-2 p-2 bg-white bg-opacity-10 rounded-lg" style="backdrop-filter: blur(8px); background: rgba(255,255,255,0.08); border-radius: 16px;">
                        <div class="text-center px-3 py-1">
                            <div class="small text-white-50">Dompet Tunai</div>
                            <div class="font-weight-bold text-white">
                                <?php 
                                    $cash_cnt = 0;
                                    foreach ($wallets as $w) { if ($w->type === 'cash') $cash_cnt++; }
                                    echo $cash_cnt;
                                ?>
                            </div>
                        </div>
                        <div style="width: 1px; background: rgba(255,255,255,0.2);"></div>
                        <div class="text-center px-3 py-1">
                            <div class="small text-white-50">Bank / Rekening</div>
                            <div class="font-weight-bold text-white">
                                <?php 
                                    $bank_cnt = 0;
                                    foreach ($wallets as $w) { if ($w->type === 'bank') $bank_cnt++; }
                                    echo $bank_cnt;
                                ?>
                            </div>
                        </div>
                        <div style="width: 1px; background: rgba(255,255,255,0.2);"></div>
                        <div class="text-center px-3 py-1">
                            <div class="small text-white-50">E-Wallet</div>
                            <div class="font-weight-bold text-white">
                                <?php 
                                    $ew_cnt = 0;
                                    foreach ($wallets as $w) { if ($w->type === 'ewallet') $ew_cnt++; }
                                    echo $ew_cnt;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-absolute" style="right: -40px; bottom: -40px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(59,130,246,0.25) 0%, rgba(0,0,0,0) 70%); pointer-events: none;"></div>
    </div>

    <!-- WALLETS GRID -->
    <div class="row">
        <?php if (empty($wallets)): ?>
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded-lg shadow-sm border mx-auto" style="max-width: 450px; border-radius: 20px;">
                    <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                    <h5 class="font-weight-bold text-dark">Belum Ada Dompet</h5>
                    <p class="text-muted small">Tambahkan dompet pertama Anda seperti Dompet Tunai, BCA, Gopay, atau Mandiri.</p>
                    <button class="btn btn-primary px-4 py-2 font-weight-bold" data-toggle="modal" data-target="#modalAddWallet" style="border-radius: 12px;">
                        <i class="fas fa-plus mr-1"></i> Tambah Dompet
                    </button>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($wallets as $w): 
                $card_color = !empty($w->color) ? $w->color : '#2563eb';
                $card_icon = !empty($w->icon) ? $w->icon : 'fa-wallet';
                $type_labels = [
                    'cash' => 'Tunai / Cash',
                    'bank' => 'Rekening Bank',
                    'ewallet' => 'E-Wallet',
                    'other' => 'Lainnya'
                ];
                $type_name = isset($type_labels[$w->type]) ? $type_labels[$w->type] : 'Dompet';
            ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden wallet-card" style="border-radius: 20px; transition: transform 0.2s, box-shadow 0.2s;">
                    <div style="height: 6px; background-color: <?= htmlspecialchars($card_color) ?>;"></div>
                    
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 46px; height: 46px; border-radius: 14px; background-color: <?= htmlspecialchars($card_color) ?>; font-size: 1.25rem;">
                                        <i class="fas <?= htmlspecialchars($card_icon) ?>"></i>
                                    </div>
                                    <div class="ml-2">
                                        <h5 class="font-weight-bold text-dark mb-0" style="letter-spacing: -0.3px;"><?= htmlspecialchars($w->name) ?></h5>
                                        <span class="badge badge-light border text-muted px-2 py-0" style="font-size: 0.7rem; border-radius: 8px;">
                                            <?= $type_name ?>
                                        </span>
                                    </div>
                                </div>
                                <?php if ($w->is_default): ?>
                                    <span class="badge badge-success px-2 py-1" style="border-radius: 8px; font-size: 0.7rem;">
                                        <i class="fas fa-check mr-1"></i> Utama
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">Nomor Rekening / Akun</div>
                                <div class="font-weight-bold text-dark" style="font-family: monospace; font-size: 0.95rem; letter-spacing: 0.5px;">
                                    <?= htmlspecialchars($w->account_number) ?>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="p-3 bg-light rounded-lg mb-3" style="border-radius: 14px;">
                                <span class="text-muted small d-block mb-1">Saldo Tersedia</span>
                                <h3 class="font-weight-bold text-dark mb-0" style="letter-spacing: -0.5px; color: <?= htmlspecialchars($card_color) ?> !important;">
                                    Rp <?= number_format($w->balance, 0, ',', '.') ?>
                                </h3>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <button type="button" class="btn btn-sm btn-outline-secondary px-3 btn-edit-wallet" 
                                    data-id="<?= $w->id ?>" 
                                    data-name="<?= htmlspecialchars($w->name) ?>" 
                                    data-type="<?= $w->type ?>" 
                                    data-account="<?= htmlspecialchars($w->account_number) ?>" 
                                    data-balance="<?= (int)$w->balance ?>" 
                                    data-color="<?= htmlspecialchars($card_color) ?>" 
                                    data-icon="<?= htmlspecialchars($card_icon) ?>"
                                    style="border-radius: 8px;">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                                <?php if (!$w->is_default): ?>
                                    <a href="<?= site_url('wallets/delete/' . $w->id) ?>" class="btn btn-sm btn-outline-danger px-3 btn-delete-wallet" onclick="return confirm('Apakah Anda yakin ingin menghapus dompet ini?')" style="border-radius: 8px;">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- MODAL ADD WALLET -->
<div class="modal fade" id="modalAddWallet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div>
                    <h5 class="modal-title font-weight-bold text-dark">Tambah Dompet / Rekening</h5>
                    <p class="text-muted small mb-0">Catat sumber dana baru untuk mempermudah alokasi saldo.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('wallets/add') ?>" method="POST">
                <div class="modal-body px-4 py-3">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Nama Dompet / Rekening <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: BCA Tabungan, Gopay, Dompet Tunai" required style="border-radius: 10px;">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">Tipe Sumber Dana</label>
                            <select name="type" class="form-control" style="border-radius: 10px;">
                                <option value="cash">Tunai / Cash</option>
                                <option value="bank" selected>Rekening Bank</option>
                                <option value="ewallet">E-Wallet (Gopay/OVO/Dana)</option>
                                <option value="other">Lainnya / Investasi</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">No. Rekening / No. HP</label>
                            <input type="text" name="account_number" class="form-control" placeholder="Opsional (misal: 1234567890)" style="border-radius: 10px;">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Saldo Awal (Rp)</label>
                        <input type="text" name="balance" class="form-control rupiah-input" placeholder="0" value="0" style="border-radius: 10px;">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">Warna Kartu</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#2563eb" checked class="d-none">
                                    <span class="color-box" style="background-color: #2563eb;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#10b981" class="d-none">
                                    <span class="color-box" style="background-color: #10b981;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#f59e0b" class="d-none">
                                    <span class="color-box" style="background-color: #f59e0b;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#ef4444" class="d-none">
                                    <span class="color-box" style="background-color: #ef4444;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#8b5cf6" class="d-none">
                                    <span class="color-box" style="background-color: #8b5cf6;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#06b6d4" class="d-none">
                                    <span class="color-box" style="background-color: #06b6d4;"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">Ikon</label>
                            <select name="icon" class="form-control" style="border-radius: 10px;">
                                <option value="fa-wallet">Dompet (fa-wallet)</option>
                                <option value="fa-university">Bank (fa-university)</option>
                                <option value="fa-credit-card">Kartu (fa-credit-card)</option>
                                <option value="fa-mobile-alt">E-Wallet (fa-mobile-alt)</option>
                                <option value="fa-piggy-bank">Tabungan (fa-piggy-bank)</option>
                                <option value="fa-coins">Koin (fa-coins)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold" style="border-radius: 10px;">Simpan Dompet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT WALLET -->
<div class="modal fade" id="modalEditWallet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div>
                    <h5 class="modal-title font-weight-bold text-dark">Edit Dompet / Rekening</h5>
                    <p class="text-muted small mb-0">Ubah rincian informasi dan saldo dompet.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditWallet" method="POST">
                <div class="modal-body px-4 py-3">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Nama Dompet / Rekening <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_name" class="form-control" required style="border-radius: 10px;">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">Tipe Sumber Dana</label>
                            <select name="type" id="edit_type" class="form-control" style="border-radius: 10px;">
                                <option value="cash">Tunai / Cash</option>
                                <option value="bank">Rekening Bank</option>
                                <option value="ewallet">E-Wallet</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">No. Rekening / No. HP</label>
                            <input type="text" name="account_number" id="edit_account" class="form-control" style="border-radius: 10px;">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Saldo (Rp)</label>
                        <input type="text" name="balance" id="edit_balance" class="form-control rupiah-input" style="border-radius: 10px;">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">Warna Kartu</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#2563eb" class="d-none">
                                    <span class="color-box" style="background-color: #2563eb;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#10b981" class="d-none">
                                    <span class="color-box" style="background-color: #10b981;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#f59e0b" class="d-none">
                                    <span class="color-box" style="background-color: #f59e0b;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#ef4444" class="d-none">
                                    <span class="color-box" style="background-color: #ef4444;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#8b5cf6" class="d-none">
                                    <span class="color-box" style="background-color: #8b5cf6;"></span>
                                </label>
                                <label class="color-choice-label m-0">
                                    <input type="radio" name="color" value="#06b6d4" class="d-none">
                                    <span class="color-box" style="background-color: #06b6d4;"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">Ikon</label>
                            <select name="icon" id="edit_icon" class="form-control" style="border-radius: 10px;">
                                <option value="fa-wallet">Dompet (fa-wallet)</option>
                                <option value="fa-university">Bank (fa-university)</option>
                                <option value="fa-credit-card">Kartu (fa-credit-card)</option>
                                <option value="fa-mobile-alt">E-Wallet (fa-mobile-alt)</option>
                                <option value="fa-piggy-bank">Tabungan (fa-piggy-bank)</option>
                                <option value="fa-coins">Koin (fa-coins)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold" style="border-radius: 10px;">Perbarui Dompet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL TRANSFER WALLET -->
<div class="modal fade" id="modalTransferWallet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div>
                    <h5 class="modal-title font-weight-bold text-dark">Transfer Antar Dompet</h5>
                    <p class="text-muted small mb-0">Pindahkan saldo antar rekening atau dompet secara instan.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('wallets/transfer') ?>" method="POST">
                <div class="modal-body px-4 py-3">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Dari Dompet (Sumber)</label>
                        <select name="from_wallet_id" class="form-control" required style="border-radius: 10px;">
                            <?php foreach ($wallets as $w): ?>
                                <option value="<?= $w->id ?>"><?= htmlspecialchars($w->name) ?> (Saldo: Rp <?= number_format($w->balance, 0, ',', '.') ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="text-center my-2">
                        <span class="badge badge-light border rounded-circle p-2 shadow-xs">
                            <i class="fas fa-arrow-down text-primary"></i>
                        </span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Ke Dompet (Tujuan)</label>
                        <select name="to_wallet_id" class="form-control" required style="border-radius: 10px;">
                            <?php foreach ($wallets as $idx => $w): ?>
                                <option value="<?= $w->id ?>" <?= $idx === 1 ? 'selected' : '' ?>><?= htmlspecialchars($w->name) ?> (Saldo: Rp <?= number_format($w->balance, 0, ',', '.') ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Nominal Transfer (Rp) <span class="text-danger">*</span></label>
                        <input type="text" name="amount" class="form-control rupiah-input font-weight-bold" placeholder="0" required style="border-radius: 10px; font-size: 1.1rem;">
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold" style="border-radius: 10px;">Proses Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.wallet-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.08) !important;
}
.color-choice-label {
    cursor: pointer;
}
.color-box {
    display: inline-block;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 1px #cbd5e1;
    transition: all 0.2s;
}
.color-choice-label input:checked + .color-box {
    box-shadow: 0 0 0 3px #2563eb;
    transform: scale(1.15);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }


    document.querySelectorAll('.btn-edit-wallet').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.dataset.id;
            var name = this.dataset.name;
            var type = this.dataset.type;
            var account = this.dataset.account;
            var balance = this.dataset.balance;
            var color = this.dataset.color;
            var icon = this.dataset.icon;

            document.getElementById('formEditWallet').action = '<?= site_url('wallets/edit/') ?>' + id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_account').value = account;
            document.getElementById('edit_balance').value = formatRupiah(balance);
            document.getElementById('edit_icon').value = icon;

            var radio = document.querySelector('#formEditWallet input[name="color"][value="' + color + '"]');
            if (radio) {
                radio.checked = true;
            }

            $('#modalEditWallet').modal('show');
        });
    });
});
</script>

