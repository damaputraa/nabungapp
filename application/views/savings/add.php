<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus"></i> Tambah Setoran Tabungan
                </h3>
            </div>
            <div class="card-body">
                <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors() ?>
                </div>
                <?php endif; ?>

                <form action="<?= site_url('savings/add') ?>" method="POST">
                    <div class="form-group">
                        <label>Jumlah Setoran <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold">Rp</span>
                            </div>
                            <input type="text" inputmode="numeric" name="amount" class="form-control rupiah-input font-weight-bold" 
                                   placeholder="0" required autocomplete="off">
                        </div>
                        <small class="text-muted">Minimal Rp 1.000</small>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Setoran <span class="text-danger">*</span></label>
                        <input type="date" name="deposit_date" class="form-control" 
                               value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="description" class="form-control" 
                               placeholder="Misal: Setoran minggu ke-1">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Setoran
                    </button>
                    <a href="<?= site_url('savings') ?>" class="btn btn-default">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
