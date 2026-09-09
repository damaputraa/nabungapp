<?php
$is_admin = (strtolower(trim((string)$this->session->userdata('role'))) === 'admin');
?>
<!-- ================================================================ -->
<!-- NAVBAR -->
<!-- ================================================================ -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <?php if ($is_admin): ?>
        <!-- Tombol hamburger untuk admin -->
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <?php else: ?>
        <!-- Logo untuk user -->
        <li class="nav-item">
            <a href="<?= site_url('dashboard') ?>" class="nav-link font-weight-bold" style="color: #00a651; font-size: 17px; text-decoration: none;">
                <i class="fas fa-wallet"></i> Yuk Nabung
            </a>
        </li>
        <!-- Desktop Nav Links untuk Pengguna Biasa -->
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?= site_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'font-weight-bold text-success' : '' ?>" style="font-size: 14px;">
                <i class="fas fa-home mr-1"></i> Beranda
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?= site_url('transactions') ?>" class="nav-link <?= $this->uri->segment(1) == 'transactions' ? 'font-weight-bold text-success' : '' ?>" style="font-size: 14px;">
                <i class="fas fa-exchange-alt mr-1"></i> Transaksi
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?= site_url('savings') ?>" class="nav-link <?= ($this->uri->segment(1) == 'savings' && $this->uri->segment(2) != 'leaderboard') ? 'font-weight-bold text-success' : '' ?>" style="font-size: 14px;">
                <i class="fas fa-piggy-bank mr-1"></i> Tabungan
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?= site_url('goals') ?>" class="nav-link <?= $this->uri->segment(1) == 'goals' ? 'font-weight-bold text-success' : '' ?>" style="font-size: 14px;">
                <i class="fas fa-bullseye mr-1"></i> Kantong Impian
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?= site_url('budget') ?>" class="nav-link <?= $this->uri->segment(1) == 'budget' ? 'font-weight-bold text-success' : '' ?>" style="font-size: 14px;">
                <i class="fas fa-chart-pie mr-1"></i> Anggaran
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?= site_url('savings/leaderboard') ?>" class="nav-link <?= $this->uri->segment(2) == 'leaderboard' ? 'font-weight-bold text-success' : '' ?>" style="font-size: 14px;">
                <i class="fas fa-trophy mr-1"></i> Leaderboard
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?= site_url('laporan') ?>" class="nav-link <?= $this->uri->segment(1) == 'laporan' ? 'font-weight-bold text-success' : '' ?>" style="font-size: 14px;">
                <i class="fas fa-file-invoice-dollar mr-1"></i> Rekening Koran
            </a>
        </li>
        <?php endif; ?>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
        <!-- Dark Mode Toggle Button -->
        <li class="nav-item mr-1">
            <a class="nav-link" href="javascript:void(0)" id="themeToggleBtn" title="Ganti Mode Gelap / Terang" style="cursor: pointer; padding: 6px 12px; border-radius: 8px;">
                <i class="fas fa-moon text-warning" id="themeIcon"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                <?php if ($this->session->userdata('avatar') && file_exists(FCPATH . $this->session->userdata('avatar'))): ?>
                    <img src="<?= base_url($this->session->userdata('avatar')) ?>" alt="Avatar" class="rounded-circle mr-2 border" style="width: 28px; height: 28px; object-fit: cover;">
                <?php else: ?>
                    <i class="fas fa-user-circle mr-1" style="font-size: 20px;"></i>
                <?php endif; ?>
                <span><?= $this->session->userdata('username') ?? 'Guest' ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= site_url('profile') ?>" class="dropdown-item">
                    <i class="fas fa-user-cog"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= site_url($is_admin ? 'admin/logout' : 'auth/logout') ?>" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- ================================================================ -->
<!-- SIDEBAR - HANYA UNTUK ADMIN -->
<!-- ================================================================ -->
<?php if ($is_admin): ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('dashboard') ?>" class="brand-link">
        <span class="brand-text font-weight-light">
            <i class="fas fa-wallet" style="color: #60a5fa;"></i> Yuk Nabung
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-user-circle fa-2x" style="color: #60a5fa;"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->userdata('username') ?? 'User' ?></a>
                <span class="text-white-50 small"><?= ucfirst($this->session->userdata('role') ?? '') ?></span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- ==================== -->
                <!-- MENU UTAMA -->
                <!-- ==================== -->
                <li class="nav-item">
                    <a href="<?= site_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= site_url('transactions') ?>" class="nav-link <?= $this->uri->segment(1) == 'transactions' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= site_url('savings') ?>" class="nav-link <?= $this->uri->segment(1) == 'savings' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-piggy-bank"></i>
                        <p>Tabungan</p>
                    </a>
                </li>

                <!-- ==================== -->
                <!-- MENU PROFIL -->
                <!-- ==================== -->
                <li class="nav-item">
                    <a href="<?= site_url('profile') ?>" class="nav-link <?= $this->uri->segment(1) == 'profile' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profil & Password</p>
                    </a>
                </li>

                <!-- ==================== -->
                <!-- MENU ADMIN -->
                <!-- ==================== -->
                <li class="nav-header">ADMIN</li>
                
                <li class="nav-item">
                    <a href="<?= site_url('admin/users') ?>" class="nav-link <?= $this->uri->segment(2) == 'users' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Kelola User</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= site_url('admin/targets') ?>" class="nav-link <?= $this->uri->segment(2) == 'targets' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bullseye"></i>
                        <p>Target Tabungan</p>
                    </a>
                </li>

				<li class="nav-item">
					<a href="<?= site_url('savings/leaderboard') ?>" class="nav-link <?= $this->uri->segment(2) == 'leaderboard' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-trophy"></i>
						<p>Leaderboard</p>
					</a>
				</li>
                
                <li class="nav-item">
                    <a href="<?= site_url('laporan') ?>" class="nav-link <?= $this->uri->segment(1) == 'laporan' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Laporan & Cetak</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= site_url('export/excel') ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-excel"></i>
                        <p>Unduh Excel (.csv)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= site_url('admin/announcements') ?>" class="nav-link <?= $this->uri->segment(2) == 'announcements' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Pusat Pengumuman</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= site_url('admin/logs') ?>" class="nav-link <?= $this->uri->segment(2) == 'logs' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Log Aktivitas (Audit)</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<?php endif; ?>

<!-- ================================================================ -->
<!-- CONTENT WRAPPER -->
<!-- ================================================================ -->
<div class="content-wrapper <?= !$is_admin ? 'content-wrapper-full' : '' ?>">
