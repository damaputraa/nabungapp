<div class="row mb-3">
    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-users-cog mr-2 text-primary"></i> Kelola Pengguna
            </h3>
            <p class="text-muted mb-0">Manajemen akun pengguna dan hak akses administrator pada sistem keuangan.</p>
        </div>
        <div class="mt-2 mt-md-0">
            <a href="<?= site_url('admin/add_user') ?>" class="btn btn-primary font-weight-bold shadow-sm">
                <i class="fas fa-user-plus mr-1"></i> Tambah Pengguna Baru
            </a>
        </div>
    </div>
</div>

<!-- Alert Notifikasi -->
<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show shadow-sm">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show shadow-sm">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-exclamation-circle mr-2"></i> <?= $this->session->flashdata('error') ?>
</div>
<?php endif; ?>

<!-- Ringkasan Singkat User -->
<?php
$total_users = count($users);
$total_admins = 0;
$total_regular = 0;
foreach ($users as $u) {
    if ($u->role == 'admin') $total_admins++;
    else $total_regular++;
}
?>
<div class="row mb-3">
    <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="mr-3 bg-primary text-white rounded p-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-users fa-lg"></i>
                </div>
                <div>
                    <span class="text-muted small text-uppercase font-weight-bold">Total Pengguna</span>
                    <h4 class="font-weight-bold mb-0 text-dark"><?= $total_users ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="mr-3 bg-success text-white rounded p-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-check fa-lg"></i>
                </div>
                <div>
                    <span class="text-muted small text-uppercase font-weight-bold">User Standar</span>
                    <h4 class="font-weight-bold mb-0 text-dark"><?= $total_regular ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="mr-3 bg-danger text-white rounded p-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-shield fa-lg"></i>
                </div>
                <div>
                    <span class="text-muted small text-uppercase font-weight-bold">Administrator</span>
                    <h4 class="font-weight-bold mb-0 text-dark"><?= $total_admins ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pengguna -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="font-weight-bold text-dark mb-0">
            <i class="fas fa-list mr-2 text-primary"></i> Daftar Akun Pengguna
        </h5>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="table-users" class="table table-hover table-bordered w-100">
                <thead>
                    <tr>
                        <th style="width: 40px;" class="text-center">ID</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role Akun</th>
                        <th style="width: 100px;" class="text-center">Status</th>
                        <th>Total Tabungan</th>
                        <th>Tgl Bergabung</th>
                        <th style="width: 190px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="text-center font-weight-bold text-muted"><?= $user->id ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <?php if (!empty($user->avatar) && file_exists(FCPATH . $user->avatar)): ?>
                                    <img src="<?= base_url($user->avatar) ?>" alt="Avatar" class="mr-2 rounded-circle border shadow-sm" style="width: 36px; height: 36px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="mr-2 font-weight-bold" style="width: 36px; height: 36px; border-radius: 50%; background: #e0f2fe; color: #0369a1; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                        <?= strtoupper(substr($user->username, 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <strong class="text-dark"><?= htmlspecialchars($user->username) ?></strong>
                                    <?php if ($user->id == $this->session->userdata('user_id')): ?>
                                    <span class="badge badge-light border text-primary ml-1 small">Anda</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($user->email) ?>" class="text-secondary">
                                <?= htmlspecialchars($user->email) ?>
                            </a>
                        </td>
                        <td>
                            <?php if ($user->role == 'admin'): ?>
                            <span class="badge badge-danger px-2 py-1 font-weight-bold">
                                <i class="fas fa-shield-alt mr-1"></i> Admin
                            </span>
                            <?php else: ?>
                            <span class="badge badge-info px-2 py-1 font-weight-bold">
                                <i class="fas fa-user mr-1"></i> User
                            </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if (isset($user->status) && $user->status === 'suspended'): ?>
                                <span class="badge badge-danger px-2 py-1 font-weight-bold">Ditangguhkan</span>
                            <?php else: ?>
                                <span class="badge badge-success px-2 py-1 font-weight-bold">Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="font-weight-bold text-success">
                            Rp <?= number_format($user->total_savings ?? 0, 0, ',', '.') ?>
                        </td>
                        <td>
                            <span class="text-muted small">
                                <i class="fas fa-calendar-alt mr-1"></i> <?= date('d M Y', strtotime($user->created_at)) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="<?= site_url('savings/view_user/' . $user->id) ?>" class="btn btn-sm btn-info" title="Lihat Profil & Tabungan">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if ($user->id != $this->session->userdata('user_id')): ?>
                            <a href="<?= site_url('admin/toggle_user_status/' . $user->id) ?>" 
                               class="btn btn-sm btn-<?= (isset($user->status) && $user->status === 'suspended') ? 'success' : 'secondary' ?>" 
                               title="<?= (isset($user->status) && $user->status === 'suspended') ? 'Aktifkan Akun' : 'Tangguhkan / Nonaktifkan Akun' ?>"
                               onclick="return confirm('Ubah status aktif akun <?= htmlspecialchars(addslashes($user->username)) ?>?')">
                                <i class="fas fa-<?= (isset($user->status) && $user->status === 'suspended') ? 'user-check' : 'user-slash' ?>"></i>
                            </a>
                            <a href="<?= site_url('admin/reset_user_password/' . $user->id) ?>" 
                               class="btn btn-sm btn-dark" 
                               title="Reset Password ke Default (password123)"
                               onclick="return confirm('Reset password akun <?= htmlspecialchars(addslashes($user->username)) ?> ke password123?')">
                                <i class="fas fa-key"></i>
                            </a>
                            <?php endif; ?>
                            <a href="<?= site_url('admin/edit_user/' . $user->id) ?>" class="btn btn-sm btn-warning text-dark font-weight-bold" title="Edit Akun" style="color: #1e293b !important;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if ($user->id != $this->session->userdata('user_id')): ?>
                            <a href="<?= site_url('admin/delete_user/' . $user->id) ?>" 
                               class="btn btn-sm btn-danger" 
                               title="Hapus Akun"
                               onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna <?= htmlspecialchars(addslashes($user->username)) ?>? Seluruh riwayat transaksi dan tabungannya juga akan dihapus!')">
                                <i class="fas fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
