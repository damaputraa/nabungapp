<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h5 class="card-title font-weight-bold mb-0">
                    <i class="fas fa-user-edit mr-2"></i> Edit Akun Pengguna: <?= htmlspecialchars($user->username) ?>
                </h5>
            </div>
            <div class="card-body p-4">
                <?php if (validation_errors()): ?>
                <div class="alert alert-danger shadow-sm mb-4">
                    <div class="font-weight-bold mb-1"><i class="fas fa-exclamation-triangle mr-1"></i> Mohon periksa kesalahan berikut:</div>
                    <?= validation_errors('<div class="small">• ', '</div>') ?>
                </div>
                <?php endif; ?>

                <form action="<?= site_url('admin/edit_user/' . $user->id) ?>" method="POST">
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-user text-primary mr-1"></i> Username <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="username" class="form-control" 
                               value="<?= set_value('username', $user->username) ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-envelope text-primary mr-1"></i> Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" class="form-control" 
                               value="<?= set_value('email', $user->email) ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-key text-primary mr-1"></i> Ganti Password
                        </label>
                        <input type="password" name="password" class="form-control" 
                               placeholder="Kosongkan bila tidak ingin mengubah password" minlength="6">
                        <small class="form-text text-muted">Minimal 6 karakter jika ingin mengganti password akun ini.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">
                            <i class="fas fa-shield-alt text-primary mr-1"></i> Hak Akses / Role <span class="text-danger">*</span>
                        </label>
                        <select name="role" class="form-control" required>
                            <option value="user" <?= set_select('role', 'user', ($user->role == 'user')) ?>>User (Pengguna Standar)</option>
                            <option value="admin" <?= set_select('role', 'admin', ($user->role == 'admin')) ?>>Admin (Akses Penuh)</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="<?= site_url('admin/users') ?>" class="btn btn-secondary font-weight-bold">
                            <i class="fas fa-arrow-left mr-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary font-weight-bold shadow-sm">
                            <i class="fas fa-save mr-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
