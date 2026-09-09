<div class="row">
    <div class="col-lg-6 col-md-8">
        <div class="card card-primary shadow-sm">
            <div class="card-header bg-gradient-primary">
                <h3 class="card-title text-white">
                    <i class="fas fa-file-invoice-dollar mr-2"></i> Cetak Laporan Keuangan
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">
                    Pilih periode bulan dan tahun untuk mengunduh laporan rekapitulasi transaksi pemasukan, pengeluaran, dan progress tabungan dalam format PDF atau Excel.
                </p>

                <form action="<?= site_url('laporan/pdf') ?>" method="GET" target="_blank" id="reportForm">
                    <?php if ($this->session->userdata('role') == 'admin' && isset($users) && !empty($users)): ?>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-user mr-1 text-primary"></i> Pilih Pengguna (Khusus Admin)
                        </label>
                        <select name="user_id" id="report_user_id" class="form-control">
                            <option value="">-- Diri Sendiri (<?= $this->session->userdata('username') ?>) --</option>
                            <?php foreach ($users as $u): ?>
                            <option value="<?= $u->id ?>"><?= htmlspecialchars($u->username) ?> (<?= htmlspecialchars($u->email) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">
                                    <i class="fas fa-calendar-alt mr-1 text-primary"></i> Bulan
                                </label>
                                <select name="month" id="report_month" class="form-control">
                                    <?php 
                                    $months = [
                                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                                        '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                                        '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                                        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                    ];
                                    $current_m = date('m');
                                    foreach ($months as $num => $name): 
                                    ?>
                                    <option value="<?= $num ?>" <?= $current_m == $num ? 'selected' : '' ?>>
                                        <?= $name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">
                                    <i class="fas fa-calendar mr-1 text-primary"></i> Tahun
                                </label>
                                <select name="year" id="report_year" class="form-control">
                                    <?php for ($i = date('Y'); $i >= date('Y') - 5; $i--): ?>
                                    <option value="<?= $i ?>" <?= date('Y') == $i ? 'selected' : '' ?>>
                                        <?= $i ?>
                                    </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-danger mr-2 mb-2" onclick="document.getElementById('reportForm').action='<?= site_url('laporan/pdf') ?>'; document.getElementById('reportForm').target='_blank';">
                            <i class="fas fa-file-pdf mr-1"></i> Cetak Laporan PDF
                        </button>
                        <button type="button" class="btn btn-success mb-2" onclick="exportToExcel();">
                            <i class="fas fa-file-excel mr-1"></i> Export ke Excel / CSV
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-4">
        <div class="card card-outline card-info shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-info font-weight-bold">
                    <i class="fas fa-info-circle mr-1"></i> Format Laporan
                </h3>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                        <div>
                            <strong>Laporan PDF</strong>
                            <p class="text-muted small mb-0">Format siap cetak dengan tata letak rapi, ringkasan saldo, rincian transaksi lengkap, serta progress tabungan bulanan.</p>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                        <div>
                            <strong>Export Excel / CSV</strong>
                            <p class="text-muted small mb-0">Format spreadsheet (.csv kompatibel dengan Microsoft Excel dan Google Sheets) untuk analisis data keuangan lebih lanjut.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="fas fa-shield-alt text-primary mr-2 mt-1"></i>
                        <div>
                            <strong>Keamanan Data</strong>
                            <p class="text-muted small mb-0">Setiap pengguna hanya dapat mencetak dan mengunduh laporan keuangan miliknya sendiri. Administrator memiliki wewenang untuk memantau ringkasan seluruh akun.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function exportToExcel() {
    var form = document.getElementById('reportForm');
    var month = document.getElementById('report_month').value;
    var year = document.getElementById('report_year').value;
    var userSelect = document.getElementById('report_user_id');
    var userId = userSelect ? userSelect.value : '';
    
    var url = '<?= site_url('export/excel') ?>?month=' + month + '&year=' + year;
    if (userId) {
        url += '&user_id=' + userId;
    }
    window.location.href = url;
}
</script>
