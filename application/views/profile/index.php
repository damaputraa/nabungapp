<div class="row">
    <!-- Kolom Kiri: Foto Profil & Informasi Akun -->
    <div class="col-lg-5 col-md-6 mb-4">
        <!-- Card Avatar -->
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px;">
            <div class="card-body text-center p-4">
                <div class="mb-3 position-relative d-inline-block">
                    <?php if (!empty($user->avatar) && file_exists(FCPATH . $user->avatar)): ?>
                        <img src="<?= base_url($user->avatar) ?>" alt="Foto Profil" class="rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #10b981;">
                    <?php else: ?>
                        <div class="rounded-circle shadow d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px; background: linear-gradient(135deg, #059669, #10b981); color: #fff; font-size: 48px; font-weight: 700; border: 4px solid #ecfdf5;">
                            <?= strtoupper(substr($user->username, 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <h4 class="font-weight-bold text-dark mb-1"><?= htmlspecialchars($user->username) ?></h4>
                <p class="text-muted small mb-3"><?= htmlspecialchars($user->email) ?></p>
                <span class="badge badge-<?= $user->role == 'admin' ? 'danger' : 'success' ?> px-3 py-2 text-uppercase font-weight-bold" style="border-radius: 20px;">
                    <i class="fas fa-<?= $user->role == 'admin' ? 'shield-alt' : 'user' ?> mr-1"></i> <?= ucfirst($user->role) ?>
                </span>

                <!-- Form Upload Avatar -->
                <form action="<?= site_url('profile/upload_avatar') ?>" method="POST" enctype="multipart/form-data" class="mt-4 pt-3 border-top">
                    <div class="form-group text-left mb-3">
                        <label class="font-weight-bold text-dark small mb-1">Unggah Foto Profil Baru</label>
                        <input type="file" name="avatar_file" class="form-control-file border p-1 rounded" accept="image/png, image/jpeg, image/webp" required>
                        <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP. Maksimal: 2MB.</small>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-block font-weight-bold py-2" style="border-radius: 10px;">
                        <i class="fas fa-camera mr-1"></i> Simpan Foto Profil
                    </button>
                </form>
            </div>
        </div>

        <!-- Card Detail Akun -->
        <div class="card shadow-sm border-0" style="border-radius: 16px;">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-id-card text-primary mr-2"></i> Rincian Akun
                </h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <tr>
                        <th class="border-top-0 text-muted small pl-4" style="width: 40%;">ID Pengguna</th>
                        <td class="border-top-0 font-weight-bold text-dark pr-4">#<?= $user->id ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted small pl-4">Status Akun</th>
                        <td class="pr-4">
                            <?php if (isset($user->status) && $user->status === 'suspended'): ?>
                                <span class="badge badge-danger">Ditangguhkan</span>
                            <?php else: ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted small pl-4">Terdaftar Sejak</th>
                        <td class="text-dark pr-4"><?= date('d F Y', strtotime($user->created_at)) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Kolom Kanan: Ganti Password -->
    <div class="col-lg-7 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 16px;">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-lock text-warning mr-2"></i> Ganti Kata Sandi
                </h5>
            </div>
            <div class="card-body p-4">
                <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
                </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-exclamation-circle mr-2"></i> <?= $this->session->flashdata('error') ?>
                </div>
                <?php endif; ?>
                
                <?php if (validation_errors()): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= validation_errors() ?>
                </div>
                <?php endif; ?>
                
                <form action="<?= site_url('profile/update_password') ?>" method="POST">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Kata Sandi Lama</label>
                        <input type="password" name="old_password" class="form-control" placeholder="Masukkan kata sandi lama Anda" required style="border-radius: 10px; padding: 12px;">
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Kata Sandi Baru</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Minimal 6 karakter" required style="border-radius: 10px; padding: 12px;">
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Ketik ulang kata sandi baru" required style="border-radius: 10px; padding: 12px;">
                    </div>
                    <button type="submit" class="btn btn-warning font-weight-bold px-4 py-2 text-dark shadow-sm" style="border-radius: 10px;">
                        <i class="fas fa-key mr-1"></i> Perbarui Kata Sandi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>