<?php
$role = strtolower(trim((string) $this->session->userdata('role')));
$is_admin = ($role === 'admin');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
    <title><?= $page_title ?? 'Dashboard' ?> | Yuk Nabung</title>
    
    <!-- ============================================================ -->
    <!-- PWA META TAGS - Yuk Nabung -->
    <!-- ============================================================ -->
    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="#00a651">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="<?= base_url('assets/img/icon-192x192.png') ?>">
    
    <!-- ============================================================ -->
    <!-- SERVICE WORKER REGISTRATION -->
    <!-- ============================================================ -->
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('<?= base_url('sw.js') ?>')
                .then(function(registration) {
                    console.log('✅ Service Worker registered successfully');
                })
                .catch(function(error) {
                    console.log('❌ Service Worker registration failed:', error);
                });
        });
    }
    </script>
    
    <!-- ============================================================ -->
    <!-- GOOGLE FONT -->
    <!-- ============================================================ -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <!-- ============================================================ -->
    <!-- FONT AWESOME -->
    <!-- ============================================================ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- ============================================================ -->
    <!-- BOOTSTRAP 4 CSS -->
    <!-- ============================================================ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- ============================================================ -->
    <!-- ADMINLTE 3 CSS -->
    <!-- ============================================================ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    
    <!-- ============================================================ -->
    <!-- SWEETALERT2 CSS -->
    <!-- ============================================================ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- ============================================================ -->
    <!-- CUSTOM CSS -->
    <!-- ============================================================ -->
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    
    <!-- User Mode CSS (khusus role user biasa) -->
    <?php if (!$is_admin): ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/user-mode.css') ?>">
    <?php endif; ?>
    
    <!-- ============================================================ -->
    <!-- PAGE CSS (dari controller) -->
    <!-- ============================================================ -->
    <?php foreach ($page_css ?? [] as $css): ?>
    <link rel="stylesheet" href="<?= base_url($css) ?>">
    <?php endforeach; ?>
</head>
<body class="hold-transition <?= $is_admin ? 'sidebar-mini' : 'user-mode' ?>">
<div class="wrapper">
