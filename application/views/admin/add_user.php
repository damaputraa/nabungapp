<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h5 class="card-title font-weight-bold mb-0">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Pengguna Baru
                </h5>
            </div>
            <div class="card-body p-4">
                <?php if (validation_errors()): ?>
                <div class="alert alert-danger shadow-sm mb-4">
                    <div class="font-weight-bold mb-1"><i class="fas fa-exclamation-triangle mr-1"></i> Mohon periksa kesalahan berikut:</div>
                    <?= validation_errors('<div class="small">• ', '</div>') ?>
                </div>
                <?php endif; ?>

                <form action="<?= site_url('admin/add_user') ?>" method="POST">
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-user text-primary mr-1"></i> Username <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="username" class="form-control" 
                               value="<?= set_value('username') ?>" 
                               placeholder="Masukkan username unik (contoh: budi99)" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-envelope text-primary mr-1"></i> Alamat Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" class="form-control" 
                               value="<?= set_value('email') ?>" 
                               placeholder="contoh: user@gmail.com" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-lock text-primary mr-1"></i> Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password" class="form-control" 
                               placeholder="Minimal 6 karakter" required minlength="6">
                        <small class="form-text text-muted">Gunakan kombinasi huruf dan angka yang aman.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-shield-alt text-primary mr-1"></i> Hak Akses / Role <span class="text-danger">*</span>
                        </label>
                        <select name="role" class="form-control" required>
                            <option value="user" <?= set_select('role', 'user', TRUE) ?>>User (Pengguna Standar)</option>
                            <option value="admin" <?= set_select('role', 'admin') ?>>Admin (Akses Penuh)</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="<?= site_url('admin/users') ?>" class="btn btn-secondary font-weight-bold">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary font-weight-bold shadow-sm">
                            <i class="fas fa-save mr-1"></i> Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
