<div class="container-fluid px-3 py-4">
    <!-- HEADER & ACTION -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3 class="font-weight-bold text-dark mb-0" style="letter-spacing: -0.5px;">Pengingat Tagihan & Rutin</h3>
            </div>
            <p class="text-muted small mb-0 ml-md-4 pl-md-2">Pantau dan kelola jadwal tagihan bulanan (listrik, internet, sewa, langganan) agar tidak terlewat.</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalAddBill" style="border-radius: 12px; background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none;">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Tagihan Baru
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

    <!-- STATS OVERVIEW CARDS -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px; background: linear-gradient(135deg, #fef2f2, #fee2e2); border-left: 4px solid #ef4444 !important;">
                <div class="card-body p-3">
                    <span class="text-muted small font-weight-bold">Belum Dibayar Bulan Ini</span>
                    <h4 class="font-weight-bold text-danger mb-1 mt-1" style="font-size: 1.3rem;">Rp <?= number_format($total_unpaid, 0, ',', '.') ?></h4>
                    <span class="small text-muted">Kewajiban berjalan</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px; background: linear-gradient(135deg, #f0fdf4, #dcfce7); border-left: 4px solid #10b981 !important;">
                <div class="card-body p-3">
                    <span class="text-muted small font-weight-bold">Sudah Lunas Bulan Ini</span>
                    <h4 class="font-weight-bold text-success mb-1 mt-1" style="font-size: 1.3rem;">Rp <?= number_format($total_paid, 0, ',', '.') ?></h4>
                    <span class="small text-muted">Tagihan terselesaikan</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px; background: linear-gradient(135deg, #fffbeb, #fef3c7); border-left: 4px solid #f59e0b !important;">
                <div class="card-body p-3">
                    <span class="text-muted small font-weight-bold">Jatuh Tempo Mendekat (≤ 7 Hari)</span>
                    <h4 class="font-weight-bold text-warning mb-1 mt-1" style="font-size: 1.3rem; color: #b45309 !important;"><?= count($upcoming) ?> Tagihan</h4>
                    <span class="small text-muted">Perlu segera disiapkan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- UPCOMING DUE ALERT IF ANY -->
    <?php if (!empty($upcoming)): ?>
    <div class="alert alert-warning border-0 shadow-sm mb-4" style="border-radius: 16px; background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);">
        <div class="d-flex align-items-center">
            <div class="mr-3 text-warning" style="font-size: 1.8rem; color: #d97706 !important;">
                <i class="fas fa-bell"></i>
            </div>
            <div>
                <h6 class="font-weight-bold mb-1" style="color: #92400e;">Perhatian! Tagihan Segera Jatuh Tempo:</h6>
                <div class="d-flex flex-wrap gap-2 mt-1">
                    <?php foreach ($upcoming as $ub): ?>
                        <span class="badge badge-light border px-2 py-1 text-dark shadow-xs" style="border-radius: 8px;">
                            <strong><?= htmlspecialchars($ub->title) ?></strong> (Tgl <?= $ub->due_day ?>) - Rp <?= number_format($ub->amount, 0, ',', '.') ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- BILLS LIST CARD -->
    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark mb-0">Daftar Tagihan Terjadwal</h5>
            <span class="badge badge-light border text-muted px-3 py-2" style="border-radius: 10px;">
                Total: <?= count($bills) ?> Tagihan
            </span>
        </div>
        <div class="card-body px-4 pb-4 pt-2">
            <?php if (empty($bills)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-file-invoice-dollar fa-3x text-muted mb-3"></i>
                    <h5 class="font-weight-bold text-dark">Belum Ada Tagihan Terjadwal</h5>
                    <p class="text-muted small">Tambahkan tagihan bulanan seperti Listrik PLN, WiFi Indihome, BPJS, Kos, atau Spotify.</p>
                    <button class="btn btn-primary px-4 py-2 font-weight-bold" data-toggle="modal" data-target="#modalAddBill" style="border-radius: 12px;">
                        <i class="fas fa-plus mr-1"></i> Buat Pengingat Pertama
                    </button>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0" style="border-radius: 10px 0 0 10px;">Tagihan</th>
                                <th class="border-0">Kategori</th>
                                <th class="border-0">Jatuh Tempo</th>
                                <th class="border-0">Nominal</th>
                                <th class="border-0">Status Bulan Ini</th>
                                <th class="border-0 text-right" style="border-radius: 0 10px 10px 0;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bills as $b): 
                                $is_paid = ($b->status === 'paid');
                                $today_day = (int) date('j');
                                $due_diff = $b->due_day - $today_day;
                            ?>
                            <tr>
                                <td class="font-weight-bold text-dark py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center text-white mr-3 shadow-xs" style="width: 38px; height: 38px; border-radius: 10px; background: <?= $is_paid ? '#10b981' : '#f59e0b' ?>;">
                                            <i class="fas <?= $is_paid ? 'fa-check' : 'fa-receipt' ?>"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold"><?= htmlspecialchars($b->title) ?></div>
                                            <?php if (!empty($b->notes)): ?>
                                                <small class="text-muted"><?= htmlspecialchars($b->notes) ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge badge-light border text-muted px-2 py-1" style="border-radius: 8px;">
                                        <?= htmlspecialchars($b->category) ?>
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div class="font-weight-bold text-dark">Tanggal <?= $b->due_day ?></div>
                                    <?php if (!$is_paid): ?>
                                        <?php if ($due_diff < 0): ?>
                                            <small class="text-danger font-weight-bold">Lewat <?= abs($due_diff) ?> hari</small>
                                        <?php elseif ($due_diff === 0): ?>
                                            <small class="text-danger font-weight-bold">Hari ini jatuh tempo!</small>
                                        <?php elseif ($due_diff <= 3): ?>
                                            <small class="text-warning font-weight-bold"><?= $due_diff ?> hari lagi</small>
                                        <?php else: ?>
                                            <small class="text-muted"><?= $due_diff ?> hari lagi</small>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <small class="text-success">Lunas <?= date('d M Y', strtotime($b->paid_at)) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td class="font-weight-bold text-dark py-3" style="font-size: 1.05rem;">
                                    Rp <?= number_format($b->amount, 0, ',', '.') ?>
                                </td>
                                <td class="py-3">
                                    <?php if ($is_paid): ?>
                                        <span class="badge badge-success px-3 py-2" style="border-radius: 10px;">
                                            <i class="fas fa-check-circle mr-1"></i> Lunas
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-warning text-dark px-3 py-2" style="border-radius: 10px; background-color: #fef08a;">
                                            <i class="fas fa-clock mr-1"></i> Belum Dibayar
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-right">
                                    <div class="d-inline-flex gap-2">
                                        <?php if (!$is_paid): ?>
                                            <button type="button" class="btn btn-sm btn-success px-3 font-weight-bold btn-pay-bill" 
                                                data-id="<?= $b->id ?>" 
                                                data-title="<?= htmlspecialchars($b->title) ?>" 
                                                data-amount="<?= number_format($b->amount, 0, ',', '.') ?>"
                                                style="border-radius: 8px;">
                                                <i class="fas fa-check mr-1"></i> Bayar
                                            </button>
                                        <?php endif; ?>
                                        <a href="<?= site_url('bills/delete/' . $b->id) ?>" class="btn btn-sm btn-outline-danger px-2" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal tagihan ini?')" style="border-radius: 8px;" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- MODAL ADD BILL -->
<div class="modal fade" id="modalAddBill" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div>
                    <h5 class="modal-title font-weight-bold text-dark">Tambah Jadwal Tagihan</h5>
                    <p class="text-muted small mb-0">Pasang alarm & pelacak tagihan rutin bulanan Anda.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('bills/add') ?>" method="POST">
                <div class="modal-body px-4 py-3">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Nama Tagihan <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Tagihan Listrik PLN, WiFi, Kost" required style="border-radius: 10px;">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">Nominal Tagihan (Rp) <span class="text-danger">*</span></label>
                            <input type="text" name="amount" class="form-control rupiah-input font-weight-bold" placeholder="0" required style="border-radius: 10px;">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="small font-weight-bold text-dark">Jatuh Tempo (Tiap Tgl) <span class="text-danger">*</span></label>
                            <select name="due_day" class="form-control" required style="border-radius: 10px;">
                                <?php for ($d = 1; $d <= 31; $d++): ?>
                                    <option value="<?= $d ?>">Tanggal <?= $d ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Kategori</label>
                        <select name="category" class="form-control" style="border-radius: 10px;">
                            <option value="Utilitas / Tagihan" selected>Utilitas & Tagihan (Listrik, Air, Gas)</option>
                            <option value="Internet & Pulsa">Internet, WiFi & Pulsa</option>
                            <option value="Sewa & Cicilan">Sewa Tempat / Kost / Cicilan</option>
                            <option value="Langganan Digital">Langganan Digital (Netflix, Spotify, Cloud)</option>
                            <option value="Asuransi & Kesehatan">Asuransi / BPJS</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Nomor ID pelanggan atau instruksi pembayaran..." style="border-radius: 10px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold" style="border-radius: 10px;">Simpan Tagihan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL PAY BILL -->
<div class="modal fade" id="modalPayBill" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div>
                    <h5 class="modal-title font-weight-bold text-dark">Bayar & Catat Tagihan</h5>
                    <p class="text-muted small mb-0">Tandai lunas dan potong saldo dompet yang digunakan.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPayBill" method="POST">
                <div class="modal-body px-4 py-3">
                    <div class="p-3 bg-light rounded-lg mb-3" style="border-radius: 14px;">
                        <span class="text-muted small d-block mb-1">Tagihan</span>
                        <h5 class="font-weight-bold text-dark mb-1" id="pay_bill_title">-</h5>
                        <h4 class="font-weight-bold text-danger mb-0" id="pay_bill_amount">Rp 0</h4>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Pilih Sumber Dana (Dompet / Rekening)</label>
                        <select name="wallet_id" class="form-control" style="border-radius: 10px;">
                            <?php foreach ($wallets as $w): ?>
                                <option value="<?= $w->id ?>"><?= htmlspecialchars($w->name) ?> (Saldo: Rp <?= number_format($w->balance, 0, ',', '.') ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Transaksi pengeluaran akan otomatis dicatat dan saldo dompet akan dikurangi.</small>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4 font-weight-bold" style="border-radius: 10px;">Konfirmasi Pembayaran</button>
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

    document.querySelectorAll('.rupiah-input').forEach(function(input) {
        input.addEventListener('keyup', function(e) {
            let val = this.value.replace(/[^0-9]/g, '');
            this.value = val ? formatRupiah(val) : '';
        });
    });

    document.querySelectorAll('.btn-pay-bill').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.dataset.id;
            var title = this.dataset.title;
            var amount = this.dataset.amount;

            document.getElementById('formPayBill').action = '<?= site_url('bills/pay/') ?>' + id;
            document.getElementById('pay_bill_title').textContent = title;
            document.getElementById('pay_bill_amount').textContent = 'Rp ' + amount;

            $('#modalPayBill').modal('show');
        });
    });
});
</script>

