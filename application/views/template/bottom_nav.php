<?php if (strtolower(trim((string) $this->session->userdata('role'))) !== 'admin'): ?>
<style>
/* ================================================================ */
/* BOTTOM NAVIGATION ALA GOJEK */
/* ================================================================ */
.bottom-nav-user {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #ffffff;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 6px 0 10px 0;
    box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.06);
    z-index: 1050;
    border-radius: 20px 20px 0 0;
    border-top: 1px solid rgba(0, 0, 0, 0.03);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.bottom-nav-user .nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: #999;
    font-size: 10px;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 4px 16px;
    border: none;
    background: none;
    cursor: pointer;
    position: relative;
    min-width: 56px;
}

.bottom-nav-user .nav-item .nav-icon {
    font-size: 22px;
    margin-bottom: 2px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.bottom-nav-user .nav-item .nav-label {
    font-size: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.bottom-nav-user .nav-item.active {
    color: #00a651;
}

.bottom-nav-user .nav-item.active .nav-icon {
    transform: translateY(-2px);
}

.bottom-nav-user .nav-item .badge-nav {
    position: absolute;
    top: -2px;
    right: 4px;
    background: #e74c3c;
    color: #fff;
    font-size: 9px;
    border-radius: 50%;
    padding: 1px 6px;
    min-width: 18px;
    text-align: center;
}

/* Tambahan padding bottom agar konten tidak tertutup bottom nav di mobile */
@media (max-width: 767.98px) {
    body.user-mode .content-wrapper {
        padding-bottom: 75px !important;
    }
    body.user-mode .app-main {
        padding-bottom: 75px !important;
    }
}

@media (min-width: 768px) {
    .bottom-nav-user {
        display: none !important;
    }
}

@media (max-width: 480px) {
    .bottom-nav-user .nav-item {
        padding: 4px 10px;
        min-width: 44px;
    }
    .bottom-nav-user .nav-item .nav-icon {
        font-size: 20px;
    }
    .bottom-nav-user .nav-item .nav-label {
        font-size: 9px;
    }
}
</style>

<!-- Bottom Navigation -->
<div class="bottom-nav-user" id="bottomNavUser">
    <a href="<?= site_url('dashboard') ?>" 
       class="nav-item <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
        <span class="nav-icon"><i class="fas fa-home"></i></span>
        <span class="nav-label">Beranda</span>
    </a>
    
    <a href="<?= site_url('transactions') ?>" 
       class="nav-item <?= $this->uri->segment(1) == 'transactions' ? 'active' : '' ?>">
        <span class="nav-icon"><i class="fas fa-exchange-alt"></i></span>
        <span class="nav-label">Transaksi</span>
    </a>
    
    <a href="<?= site_url('wallets') ?>" 
       class="nav-item <?= $this->uri->segment(1) == 'wallets' ? 'active' : '' ?>">
        <span class="nav-icon"><i class="fas fa-wallet"></i></span>
        <span class="nav-label">Dompet</span>
    </a>

    <a href="<?= site_url('savings') ?>" 
       class="nav-item <?= ($this->uri->segment(1) == 'savings' && $this->uri->segment(2) != 'leaderboard') ? 'active' : '' ?>">
        <span class="nav-icon"><i class="fas fa-piggy-bank"></i></span>
        <span class="nav-label">Tabungan</span>
    </a>
    
    <a href="<?= site_url('profile') ?>" 
       class="nav-item <?= $this->uri->segment(1) == 'profile' ? 'active' : '' ?>">
        <span class="nav-icon"><i class="fas fa-user"></i></span>
        <span class="nav-label">Profil</span>
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var currentPath = window.location.pathname;
    document.querySelectorAll('.bottom-nav-user .nav-item').forEach(function(item) {
        var href = item.getAttribute('href');
        if (href && currentPath.includes(href.replace(/^.*\/\//, ''))) {
            item.classList.add('active');
        }
    });
});
</script>
<?php endif; ?>
