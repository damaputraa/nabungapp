<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuk Nabung - Aplikasi Keuangan & Tabungan Multi-Pengguna Modern</title>
    
    <!-- Meta SEO & PWA -->
    <meta name="description" content="Kelola pencatatan pemasukan, pengeluaran, target tabungan bulanan, dan pantau leaderboard tabungan bersama pengguna lain secara real-time.">
    <meta name="theme-color" content="#059669">
    <link rel="manifest" href="<?= base_url('manifest.json') ?>">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- Google Font: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ================================================================ */
        /* RESET & ACCESSIBLE COLOR SYSTEM                                 */
        /* ================================================================ */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Primary Brand Colors (High Contrast WCAG AA/AAA) */
            --primary: #059669;
            --primary-dark: #047857;
            --primary-light: #ecfdf5;
            --primary-gradient: linear-gradient(135deg, #059669 0%, #10b981 100%);
            
            /* Saturated Vibrant Accent Colors */
            --accent-blue: #2563eb;
            --accent-blue-light: #eff6ff;
            --accent-purple: #7c3aed;
            --accent-purple-light: #f5f3ff;
            --accent-amber: #d97706;
            --accent-amber-light: #fffbeb;
            --accent-rose: #e11d48;
            --accent-rose-light: #fff1f2;
            
            /* High Contrast Typography */
            --text-heading: #0f172a; /* Slate 900 */
            --text-body: #334155;    /* Slate 700 */
            --text-muted: #64748b;   /* Slate 500 */
            
            /* Surface & Background */
            --bg-page: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            
            /* Elevation Shadows */
            --shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.05);
            --shadow-md: 0 10px 30px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 20px 50px rgba(15, 23, 42, 0.12);
            --radius-pill: 9999px;
            --radius-lg: 24px;
            --radius-md: 16px;
            --radius-sm: 10px;
            
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-page);
            color: var(--text-body);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .container {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ================================================================ */
        /* NAVBAR                                                           */
        /* ================================================================ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 18px 0;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.7);
            transition: var(--transition);
        }

        .navbar.scrolled {
            padding: 12px 0;
            box-shadow: 0 4px 25px rgba(15, 23, 42, 0.06);
            background: rgba(255, 255, 255, 0.96);
        }

        .navbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 22px;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: -0.5px;
        }

        .brand-logo-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.35);
        }

        .brand-logo span {
            color: var(--primary);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 32px;
        }

        .nav-link {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-body);
            transition: var(--transition);
            position: relative;
        }

        .nav-link:hover, .nav-link:focus {
            color: var(--primary);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: var(--transition);
            border-radius: 2px;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-nav-login {
            padding: 9px 20px;
            font-weight: 700;
            font-size: 14px;
            color: var(--text-heading);
            border-radius: var(--radius-pill);
            transition: var(--transition);
        }

        .btn-nav-login:hover {
            color: var(--primary);
            background: var(--primary-light);
        }

        .btn-nav-cta {
            padding: 10px 24px;
            font-weight: 700;
            font-size: 14px;
            color: #ffffff;
            background: var(--primary-gradient);
            border-radius: var(--radius-pill);
            box-shadow: 0 4px 18px rgba(5, 150, 105, 0.35);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.45);
            color: #ffffff;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-heading);
            cursor: pointer;
            padding: 8px;
        }

        /* ================================================================ */
        /* HERO SECTION                                                     */
        /* ================================================================ */
        .hero {
            padding: 150px 0 90px;
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at 85% 15%, rgba(16, 185, 129, 0.12) 0%, transparent 45%),
                        radial-gradient(circle at 10% 85%, rgba(37, 99, 235, 0.08) 0%, transparent 40%),
                        var(--bg-page);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 50px;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: var(--primary-light);
            border: 1px solid rgba(5, 150, 105, 0.25);
            border-radius: var(--radius-pill);
            font-size: 13px;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 20px;
        }

        .hero-badge i {
            color: var(--primary);
        }

        .hero-title {
            font-size: 52px;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1.15;
            letter-spacing: -1.5px;
            margin-bottom: 22px;
        }

        .hero-title .gradient-text {
            background: linear-gradient(135deg, #059669 0%, #2563eb 50%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 19px;
            color: var(--text-body);
            line-height: 1.7;
            margin-bottom: 34px;
            max-width: 580px;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .btn-hero-primary {
            padding: 16px 36px;
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            background: var(--primary-gradient);
            border-radius: var(--radius-pill);
            box-shadow: 0 6px 25px rgba(5, 150, 105, 0.35);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(5, 150, 105, 0.45);
            color: #ffffff;
        }

        .btn-hero-secondary {
            padding: 15px 32px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-heading);
            background: #ffffff;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-pill);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero-secondary:hover {
            border-color: var(--accent-blue);
            color: var(--accent-blue);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .hero-trust {
            display: flex;
            align-items: center;
            gap: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-heading);
        }

        .trust-item i {
            color: var(--primary);
            font-size: 18px;
        }

        /* Hero App Card Mockup */
        .hero-mockup-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .phone-frame {
            width: 360px;
            background: #0f172a;
            border-radius: 44px;
            padding: 14px;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.25);
            border: 4px solid #334155;
            position: relative;
            z-index: 2;
        }

        .phone-notch {
            width: 130px;
            height: 22px;
            background: #0f172a;
            position: absolute;
            top: 14px;
            left: 50%;
            transform: translateX(-50%);
            border-bottom-left-radius: 14px;
            border-bottom-right-radius: 14px;
            z-index: 10;
        }

        .phone-screen {
            background: #f8fafc;
            border-radius: 34px;
            overflow: hidden;
            padding: 24px 18px 20px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .mock-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 18px;
        }

        .mock-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mock-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .mock-greeting {
            font-size: 12px;
            color: var(--text-muted);
        }

        .mock-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-heading);
        }

        .mock-balance-card {
            background: var(--primary-gradient);
            border-radius: 20px;
            padding: 18px 20px;
            color: #ffffff;
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.35);
            margin-bottom: 18px;
        }

        .mock-balance-card .lbl {
            font-size: 12px;
            opacity: 0.9;
        }

        .mock-balance-card .val {
            font-size: 26px;
            font-weight: 800;
            margin: 4px 0 12px;
        }

        .mock-card-stats {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 10px;
            font-size: 12px;
        }

        .mock-card-stats span strong {
            display: block;
            font-size: 13px;
        }

        .mock-target-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 14px 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 16px;
        }

        .mock-target-box .t-header {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .mock-target-box .t-header strong {
            color: var(--text-heading);
        }

        .mock-target-box .progress-bg {
            height: 8px;
            background: #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .mock-target-box .progress-fill {
            height: 100%;
            width: 78%;
            background: linear-gradient(90deg, #059669, #2563eb);
            border-radius: 8px;
        }

        .mock-transactions {
            background: #ffffff;
            border-radius: 16px;
            padding: 14px 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .mock-trx-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 12px;
        }

        .mock-trx-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .mock-trx-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        /* Floating Badges */
        .floating-badge {
            position: absolute;
            background: #ffffff;
            border-radius: 16px;
            padding: 12px 18px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 3;
            animation: softFloat 4s ease-in-out infinite;
        }

        @keyframes softFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .fb-1 {
            top: 10%;
            left: -30px;
        }

        .fb-2 {
            bottom: 12%;
            right: -25px;
            animation-delay: 2s;
        }

        .fb-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .fb-title {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .fb-value {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-heading);
        }

        /* ================================================================ */
        /* STATS COUNTER BAR                                                */
        /* ================================================================ */
        .stats-bar {
            padding: 40px 0;
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            text-align: center;
        }

        .stat-card {
            padding: 10px;
        }

        .stat-card .num {
            font-size: 40px;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: -1px;
            margin-bottom: 4px;
        }

        .stat-card .label {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-muted);
        }

        /* ================================================================ */
        /* SECTION: INTERACTIVE SAVINGS SIMULATOR                          */
        /* ================================================================ */
        .simulator-section {
            padding: 100px 0;
            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
            position: relative;
        }

        .section-tag {
            display: inline-block;
            padding: 6px 16px;
            background: var(--accent-blue-light);
            border: 1px solid rgba(37, 99, 235, 0.2);
            color: var(--accent-blue);
            font-size: 13px;
            font-weight: 700;
            border-radius: var(--radius-pill);
            margin-bottom: 14px;
        }

        .section-tag.green {
            background: var(--primary-light);
            border-color: rgba(5, 150, 105, 0.25);
            color: var(--primary-dark);
        }

        .section-header {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 50px;
        }

        .section-title {
            font-size: 38px;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 17px;
            color: var(--text-body);
            line-height: 1.6;
        }

        .calc-wrapper {
            background: #ffffff;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            padding: 44px;
            max-width: 960px;
            margin: 0 auto;
        }

        .calc-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 40px;
            align-items: center;
        }

        .calc-input-group {
            margin-bottom: 28px;
        }

        .calc-input-group label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 10px;
        }

        .calc-input-group .value-display {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary);
        }

        .range-slider {
            width: 100%;
            height: 8px;
            border-radius: 8px;
            background: #e2e8f0;
            outline: none;
            -webkit-appearance: none;
            cursor: pointer;
        }

        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--primary);
            box-shadow: 0 2px 10px rgba(5, 150, 105, 0.4);
            cursor: pointer;
            transition: var(--transition);
        }

        .range-slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
        }

        .calc-presets {
            display: flex;
            gap: 8px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .btn-preset {
            padding: 5px 14px;
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-pill);
            font-size: 12px;
            font-weight: 600;
            color: var(--text-body);
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-preset:hover, .btn-preset.active {
            background: var(--primary-light);
            border-color: var(--primary);
            color: var(--primary-dark);
        }

        .calc-result-box {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-radius: var(--radius-md);
            padding: 34px 28px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .calc-result-box::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, transparent 70%);
        }

        .res-item {
            margin-bottom: 22px;
        }

        .res-label {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .res-amount {
            font-size: 32px;
            font-weight: 800;
            color: #34d399;
            letter-spacing: -0.5px;
        }

        .res-secondary {
            display: flex;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid #334155;
            font-size: 14px;
        }

        .res-secondary span strong {
            color: #ffffff;
            display: block;
            font-size: 16px;
            margin-top: 2px;
        }

        .btn-calc-cta {
            width: 100%;
            margin-top: 24px;
            padding: 14px;
            background: var(--primary-gradient);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: var(--radius-pill);
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            display: block;
            box-shadow: 0 4px 20px rgba(5, 150, 105, 0.4);
        }

        .btn-calc-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(5, 150, 105, 0.5);
            color: #ffffff;
        }

        /* ================================================================ */
        /* SECTION: FITUR UNGGULAN MULTI-USER                              */
        /* ================================================================ */
        .features-section {
            padding: 100px 0;
            background: #ffffff;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            background: var(--bg-page);
            border-radius: var(--radius-md);
            padding: 34px 28px;
            border: 1px solid var(--border-color);
            transition: var(--transition);
            position: relative;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
            border-color: rgba(5, 150, 105, 0.3);
            background: #ffffff;
        }

        .feat-icon-box {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 22px;
        }

        .feat-icon-box.green {
            background: var(--primary-light);
            color: var(--primary);
        }

        .feat-icon-box.blue {
            background: var(--accent-blue-light);
            color: var(--accent-blue);
        }

        .feat-icon-box.purple {
            background: var(--accent-purple-light);
            color: var(--accent-purple);
        }

        .feat-icon-box.amber {
            background: var(--accent-amber-light);
            color: var(--accent-amber);
        }

        .feat-icon-box.rose {
            background: var(--accent-rose-light);
            color: var(--accent-rose);
        }

        .feature-card h4 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-heading);
            margin-bottom: 12px;
        }

        .feature-card p {
            font-size: 15px;
            color: var(--text-body);
            line-height: 1.6;
        }

        /* ================================================================ */
        /* SECTION: INTERACTIVE TAB SHOWCASE                               */
        /* ================================================================ */
        .showcase-section {
            padding: 100px 0;
            background: #f8fafc;
        }

        .tab-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .tab-btn {
            padding: 12px 26px;
            border-radius: var(--radius-pill);
            border: 2px solid var(--border-color);
            background: #ffffff;
            color: var(--text-heading);
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn:hover, .tab-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 18px rgba(5, 150, 105, 0.3);
        }

        .tab-content {
            background: #ffffff;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            padding: 44px;
            max-width: 1040px;
            margin: 0 auto;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 40px;
            align-items: center;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tab-pane-content h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-heading);
            margin-bottom: 16px;
        }

        .tab-pane-content p {
            font-size: 16px;
            color: var(--text-body);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .tab-check-list {
            list-style: none;
            margin-bottom: 28px;
        }

        .tab-check-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-heading);
            margin-bottom: 12px;
        }

        .tab-check-list li i {
            color: var(--primary);
            font-size: 18px;
        }

        .tab-pane-preview {
            background: #f1f5f9;
            border-radius: var(--radius-md);
            padding: 24px;
            border: 1px solid var(--border-color);
        }

        /* ================================================================ */
        /* SECTION: FAQ ACCORDION                                           */
        /* ================================================================ */
        .faq-section {
            padding: 100px 0;
            background: #ffffff;
        }

        .faq-accordion {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            margin-bottom: 14px;
            overflow: hidden;
            transition: var(--transition);
        }

        .faq-item.active {
            border-color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        .faq-question {
            padding: 20px 24px;
            font-size: 17px;
            font-weight: 700;
            color: var(--text-heading);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
        }

        .faq-question i {
            color: var(--primary);
            transition: var(--transition);
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 24px 20px;
            font-size: 15px;
            color: var(--text-body);
            line-height: 1.7;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        /* ================================================================ */
        /* SECTION: CTA BANNER                                              */
        /* ================================================================ */
        .cta-section {
            padding: 90px 0;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            color: #ffffff;
            text-align: center;
            position: relative;
        }

        .cta-box {
            max-width: 720px;
            margin: 0 auto;
        }

        .cta-box h2 {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 18px;
            color: #ffffff;
        }

        .cta-box p {
            font-size: 18px;
            color: #cbd5e1;
            margin-bottom: 34px;
            line-height: 1.6;
        }

        .btn-cta-white {
            padding: 16px 40px;
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            background: #ffffff;
            border-radius: var(--radius-pill);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.3);
            background: #f8fafc;
            color: var(--primary);
        }

        /* ================================================================ */
        /* FOOTER                                                           */
        /* ================================================================ */
        .landing-footer {
            background: #090d16;
            color: #94a3b8;
            padding: 70px 0 30px;
            border-top: 1px solid #1e293b;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-brand h4 {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 12px;
        }

        .footer-brand p {
            font-size: 14px;
            line-height: 1.7;
            max-width: 320px;
        }

        .footer-col h5 {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            font-size: 14px;
            color: #94a3b8;
            transition: var(--transition);
        }

        .footer-col ul li a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 30px;
            border-top: 1px solid #1e293b;
            font-size: 13px;
        }

        /* ================================================================ */
        /* RESPONSIVE DESIGN (MOBILE & TABLET)                              */
        /* ================================================================ */
        @media (max-width: 991px) {
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 40px;
            }

            .hero-desc {
                margin: 0 auto 34px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-trust {
                justify-content: center;
                flex-wrap: wrap;
                gap: 20px;
            }

            .calc-grid {
                grid-template-columns: 1fr;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .tab-pane.active {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 75px;
                left: 0;
                right: 0;
                background: #ffffff;
                flex-direction: column;
                padding: 24px;
                gap: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                border-bottom: 1px solid var(--border-color);
                display: none;
            }

            .nav-menu.open {
                display: flex;
            }

            .mobile-toggle {
                display: block;
            }

            .hero {
                padding: 120px 0 60px;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-desc {
                font-size: 16px;
            }

            .phone-frame {
                width: 310px;
            }

            .fb-1, .fb-2 {
                display: none; /* Hide floating badges on small phone to prevent overflow */
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .stat-card .num {
                font-size: 30px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .calc-wrapper {
                padding: 24px;
            }

            .tab-content {
                padding: 24px;
            }

            .cta-box h2 {
                font-size: 30px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- ============================================================ -->
    <!-- NAVBAR                                                       -->
    <!-- ============================================================ -->
    <header class="navbar" id="navbar">
        <div class="container navbar-inner">
            <a href="<?= site_url() ?>" class="brand-logo">
                <div class="brand-logo-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <span>Yuk</span>Nabung
            </a>

            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#fitur" class="nav-link">Fitur Utama</a></li>
                    <li><a href="#simulasi" class="nav-link">Simulasi Menabung</a></li>
                    <li><a href="#showcase" class="nav-link">Keunggulan</a></li>
                    <li><a href="#faq" class="nav-link">Tanya Jawab</a></li>
                </ul>
            </nav>

            <div class="nav-actions">
                <a href="<?= site_url('auth/login') ?>" class="btn-nav-login">Masuk</a>
                <a href="<?= site_url('auth/register') ?>" class="btn-nav-cta">
                    <i class="fas fa-user-plus"></i> Daftar Gratis
                </a>
                <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigasi mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- ============================================================ -->
    <!-- HERO SECTION                                                 -->
    <!-- ============================================================ -->
    <section class="hero" id="beranda">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fas fa-sparkles"></i> Platform Tabungan & Tracking Keuangan #1
                </div>
                <h1 class="hero-title">
                    Wujudkan Impian Finansial Bersama <span class="gradient-text">Yuk Nabung</span>
                </h1>
                <p class="hero-desc">
                    Catat arus kas harian, atur target tabungan bulanan, dan berkompetisi secara sehat di leaderboard bersama ribuan pengguna aktif lainnya. Mudah, aman, dan siap pakai.
                </p>
                <div class="hero-buttons">
                    <a href="<?= site_url('auth/register') ?>" class="btn-hero-primary">
                        <i class="fas fa-rocket"></i> Mulai Menabung Sekarang
                    </a>
                    <a href="#simulasi" class="btn-hero-secondary">
                        <i class="fas fa-calculator"></i> Coba Simulasi Tabungan
                    </a>
                </div>
                <div class="hero-trust">
                    <div class="trust-item">
                        <i class="fas fa-shield-alt"></i> 100% Data Privat
                    </div>
                    <div class="trust-item">
                        <i class="fas fa-users"></i> Multi-User Ready
                    </div>
                    <div class="trust-item">
                        <i class="fas fa-mobile-alt"></i> Tampilan Mobile Friendly
                    </div>
                </div>
            </div>

            <!-- Interactive Mockup Preview -->
            <div class="hero-mockup-wrapper">
                <!-- Floating Badge 1 -->
                <div class="floating-badge fb-1">
                    <div class="fb-icon" style="background: #ecfdf5; color: #059669;">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div>
                        <div class="fb-title">Peringkat 1 Leaderboard</div>
                        <div class="fb-value">Target 100% Tercapai 🎉</div>
                    </div>
                </div>

                <!-- Floating Badge 2 -->
                <div class="floating-badge fb-2">
                    <div class="fb-icon" style="background: #eff6ff; color: #2563eb;">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <div class="fb-title">Setoran Bulan Ini</div>
                        <div class="fb-value">+Rp 1.500.000</div>
                    </div>
                </div>

                <!-- Mobile Phone Frame -->
                <div class="phone-frame">
                    <div class="phone-notch"></div>
                    <div class="phone-screen">
                        <div class="mock-header">
                            <div class="mock-user">
                                <div class="mock-avatar">D</div>
                                <div>
                                    <div class="mock-greeting">Halo, Selamat Pagi</div>
                                    <div class="mock-name">Dama Rahmad ✨</div>
                                </div>
                            </div>
                            <i class="fas fa-bell" style="color: #64748b;"></i>
                        </div>

                        <!-- Card Saldo -->
                        <div class="mock-balance-card">
                            <div class="lbl">Total Saldo Keuangan</div>
                            <div class="val">Rp 8.450.000</div>
                            <div class="mock-card-stats">
                                <span>Pemasukan: <strong>Rp 12.000.000</strong></span>
                                <span>Pengeluaran: <strong>Rp 3.550.000</strong></span>
                            </div>
                        </div>

                        <!-- Progress Target Tabungan -->
                        <div class="mock-target-box">
                            <div class="t-header">
                                <strong>🎯 Target Tabungan Bulan Ini</strong>
                                <span style="color: #059669; font-weight: 700;">78%</span>
                            </div>
                            <div class="progress-bg">
                                <div class="progress-fill"></div>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 11px; margin-top: 6px; color: #64748b;">
                                <span>Terkumpul: Rp 1.560.000</span>
                                <span>Target: Rp 2.000.000</span>
                            </div>
                        </div>

                        <!-- Mock Transaksi -->
                        <div class="mock-transactions">
                            <div style="font-size: 12px; font-weight: 700; margin-bottom: 8px; color: #0f172a;">Aktivitas Terakhir</div>
                            <div class="mock-trx-item">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div class="mock-trx-icon" style="background: #ecfdf5; color: #059669;">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                    <div>
                                        <strong>Gaji Pokok</strong>
                                        <div style="font-size: 10px; color: #94a3b8;">Hari ini, 09:30</div>
                                    </div>
                                </div>
                                <span style="font-weight: 700; color: #059669;">+Rp 8.500.000</span>
                            </div>
                            <div class="mock-trx-item">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div class="mock-trx-icon" style="background: #fff1f2; color: #e11d48;">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div>
                                        <strong>Belanja Bulanan</strong>
                                        <div style="font-size: 10px; color: #94a3b8;">Kemarin, 14:15</div>
                                    </div>
                                </div>
                                <span style="font-weight: 700; color: #e11d48;">-Rp 650.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- STATS COUNTER BAR                                            -->
    <!-- ============================================================ -->
    <section class="stats-bar">
        <div class="container stats-grid">
            <div class="stat-card">
                <div class="num counter" data-target="25000">0</div>
                <div class="label">Transaksi Tercatat</div>
            </div>
            <div class="stat-card">
                <div class="num counter" data-target="1500">0</div>
                <div class="label">Pengguna Aktif</div>
            </div>
            <div class="stat-card">
                <div class="num">Rp <span class="counter" data-target="4">0</span>.8 M+</div>
                <div class="label">Total Tabungan Terkumpul</div>
            </div>
            <div class="stat-card">
                <div class="num counter" data-target="99">0</div>
                <div class="label">% Kepuasan Pengguna</div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- SECTION: SAVINGS SIMULATOR (LIVE INTERACTIVE CALCULATOR)     -->
    <!-- ============================================================ -->
    <section class="simulator-section" id="simulasi">
        <div class="container">
            <div class="section-header">
                <span class="section-tag green">
                    <i class="fas fa-coins mr-1"></i> Kalkulator Finansial Interaktif
                </span>
                <h2 class="section-title">Rencanakan Tabungan Impianmu Sekarang</h2>
                <p class="section-desc">
                    Geser slider di bawah ini untuk melihat berapa nominal yang perlu kamu sisihkan setiap hari dan bulan untuk mencapai tujuan finansialmu.
                </p>
            </div>

            <div class="calc-wrapper">
                <div class="calc-grid">
                    <!-- Controls -->
                    <div class="calc-controls">
                        <!-- Target Slider -->
                        <div class="calc-input-group">
                            <label>
                                <span>Target Dana yang Ingin Dicapai:</span>
                                <span class="value-display" id="dispTargetAmount">Rp 5.000.000</span>
                            </label>
                            <input type="range" class="range-slider" id="inputTarget" min="500000" max="50000000" step="500000" value="5000000">
                            <div class="calc-presets">
                                <button type="button" class="btn-preset" onclick="setTargetPreset(2000000)">Rp 2 Juta</button>
                                <button type="button" class="btn-preset active" onclick="setTargetPreset(5000000)">Rp 5 Juta</button>
                                <button type="button" class="btn-preset" onclick="setTargetPreset(10000000)">Rp 10 Juta</button>
                                <button type="button" class="btn-preset" onclick="setTargetPreset(25000000)">Rp 25 Juta</button>
                            </div>
                        </div>

                        <!-- Months Slider -->
                        <div class="calc-input-group">
                            <label>
                                <span>Jangka Waktu Menabung:</span>
                                <span class="value-display" id="dispTargetMonths">6 Bulan</span>
                            </label>
                            <input type="range" class="range-slider" id="inputMonths" min="1" max="36" step="1" value="6">
                            <div class="calc-presets">
                                <button type="button" class="btn-preset" onclick="setMonthPreset(3)">3 Bulan</button>
                                <button type="button" class="btn-preset active" onclick="setMonthPreset(6)">6 Bulan</button>
                                <button type="button" class="btn-preset" onclick="setMonthPreset(12)">1 Tahun</button>
                                <button type="button" class="btn-preset" onclick="setMonthPreset(24)">2 Tahun</button>
                            </div>
                        </div>
                    </div>

                    <!-- Output Card -->
                    <div class="calc-result-box">
                        <div class="res-item">
                            <div class="res-label">Sisihkan Setiap Bulan</div>
                            <div class="res-amount" id="dispMonthlyNeeded">Rp 833.333</div>
                        </div>
                        <div class="res-item">
                            <div class="res-label">Atau Cukup Sisihkan Setiap Hari</div>
                            <div style="font-size: 22px; font-weight: 700; color: #ffffff;" id="dispDailyNeeded">Rp 27.778 / hari</div>
                        </div>
                        <div class="res-secondary">
                            <span>Estimasi Selesai:<strong id="dispEndDate">Maret 2027</strong></span>
                            <span>Total Terkumpul:<strong id="dispTotalGoal">Rp 5.000.000</strong></span>
                        </div>
                        <a href="<?= site_url('auth/register') ?>" class="btn-calc-cta">
                            <i class="fas fa-check-circle mr-1"></i> Mulai Nabung dengan Target Ini
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- SECTION: FITUR UNGGULAN                                      -->
    <!-- ============================================================ -->
    <section class="features-section" id="fitur">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">
                    <i class="fas fa-bolt mr-1"></i> Fitur Lengkap & Handal
                </span>
                <h2 class="section-title">Semua yang Kamu Butuhkan Ada di Sini</h2>
                <p class="section-desc">
                    Dirancang dengan arsitektur multi-user yang tangguh, antarmuka super cepat, dan fitur tracking cerdas untuk kenyamanan finansialmu.
                </p>
            </div>

            <div class="features-grid">
                <!-- 01 -->
                <div class="feature-card">
                    <div class="feat-icon-box green">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h4>Pencatatan Cepat & Multi-Kategori</h4>
                    <p>Catat pemasukan dan pengeluaran harian lengkap dengan kategori, tanggal, dan deskripsi transparan dalam hitungan detik.</p>
                </div>

                <!-- 02 -->
                <div class="feature-card">
                    <div class="feat-icon-box blue">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h4>Target Tabungan Otomatis</h4>
                    <p>Tentukan target tabungan bulanan. Sistem secara otomatis menghitung persentase progres dan memberi tahu saat target tercapai.</p>
                </div>

                <!-- 03 -->
                <div class="feature-card">
                    <div class="feat-icon-box purple">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h4>Leaderboard Menabung Interaktif</h4>
                    <p>Bangun kebiasaan menabung yang konsisten lewat papan peringkat ramah untuk memacu semangat antar sesama pengguna.</p>
                </div>

                <!-- 04 -->
                <div class="feature-card">
                    <div class="feat-icon-box amber">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h4>Laporan Cetak PDF & Excel</h4>
                    <p>Unduh rekapitulasi keuangan bulanan dalam format PDF siap cetak atau spreadsheet Excel (.csv) kapan pun dibutuhkan.</p>
                </div>

                <!-- 05 -->
                <div class="feature-card">
                    <div class="feat-icon-box rose">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h4>Keamanan Data Per-Pengguna</h4>
                    <p>Data keuangan Anda terisolasi aman dengan enkripsi password standar industri dan otentikasi sesi yang teruji.</p>
                </div>

                <!-- 06 -->
                <div class="feature-card">
                    <div class="feat-icon-box green">
                        <i class="fas fa-mobile-screen"></i>
                    </div>
                    <h4>Mobile Web App (PWA)</h4>
                    <p>Dapat diakses lancar lewat browser ponsel maupun diinstal sebagai aplikasi di layar utama tanpa memakan memori besar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- SECTION: INTERACTIVE TAB SHOWCASE                           -->
    <!-- ============================================================ -->
    <section class="showcase-section" id="showcase">
        <div class="container">
            <div class="section-header">
                <span class="section-tag green">
                    <i class="fas fa-desktop mr-1"></i> Eksplorasi Aplikasi
                </span>
                <h2 class="section-title">Lihat Bagaimana Yuk Nabung Bekerja</h2>
                <p class="section-desc">Pilih modul di bawah untuk melihat pengalaman penggunaan yang mudah dan menyenangkan.</p>
            </div>

            <!-- Tab Buttons -->
            <div class="tab-buttons">
                <button type="button" class="tab-btn active" onclick="switchTab('tab-transaksi', this)">
                    <i class="fas fa-receipt"></i> Transaksi
                </button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-tabungan', this)">
                    <i class="fas fa-piggy-bank"></i> Tabungan
                </button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-leaderboard', this)">
                    <i class="fas fa-medal"></i> Leaderboard
                </button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-laporan', this)">
                    <i class="fas fa-file-pdf"></i> Ekspor & Laporan
                </button>
            </div>

            <!-- Tab Contents -->
            <div class="tab-content">
                <!-- Tab 1 -->
                <div class="tab-pane active" id="tab-transaksi">
                    <div class="tab-pane-content">
                        <h3>Pencatatan Arus Kas Tanpa Ribet</h3>
                        <p>Ketahui ke mana setiap rupiah uangmu pergi dengan pengelompokan kategori yang jelas dan grafik perbandingan instan.</p>
                        <ul class="tab-check-list">
                            <li><i class="fas fa-check-circle"></i> Filter berdasarkan kategori, rentang tanggal, & jenis transaksi</li>
                            <li><i class="fas fa-check-circle"></i> Hitung saldo net cashflow secara otomatis dan akurat</li>
                            <li><i class="fas fa-check-circle"></i> Edit atau hapus catatan transaksi kapan saja dengan aman</li>
                        </ul>
                        <a href="<?= site_url('auth/register') ?>" class="btn-hero-primary" style="padding: 12px 28px; font-size: 14px;">
                            Coba Fitur Transaksi Sekarang
                        </a>
                    </div>
                    <div class="tab-pane-preview">
                        <div class="card p-3 shadow-sm border-0 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <strong>Daftar Transaksi Terbaru</strong>
                                <span class="badge badge-success px-2 py-1" style="background: #ecfdf5; color: #059669;">Filter Aktif</span>
                            </div>
                            <div style="font-size: 13px;">
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span>Gaji Pekerjaan</span>
                                    <strong class="text-success">+Rp 6.000.000</strong>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span>Kebutuhan Pokok</span>
                                    <strong class="text-danger">-Rp 1.250.000</strong>
                                </div>
                                <div class="d-flex justify-content-between py-2">
                                    <span>Tagihan Listrik & WiFi</span>
                                    <strong class="text-danger">-Rp 450.000</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2 -->
                <div class="tab-pane" id="tab-tabungan">
                    <div class="tab-pane-content">
                        <h3>Kunci Konsistensi Menabung Bulanan</h3>
                        <p>Tetapkan tujuan realistis di awal bulan dan rekam setiap setoran tabunganmu hingga 100% tercapai.</p>
                        <ul class="tab-check-list">
                            <li><i class="fas fa-check-circle"></i> Notifikasi progres cerdas saat mencapai 50%, 75%, dan 100%</li>
                            <li><i class="fas fa-check-circle"></i> Lacak total akumulasi tabungan dari seluruh periode</li>
                            <li><i class="fas fa-check-circle"></i> Fleksibel menambah setoran berkala setiap minggu atau hari</li>
                        </ul>
                        <a href="<?= site_url('auth/register') ?>" class="btn-hero-primary" style="padding: 12px 28px; font-size: 14px;">
                            Mulai Pasang Target Tabungan
                        </a>
                    </div>
                    <div class="tab-pane-preview">
                        <div class="card p-3 shadow-sm border-0 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>Target Bulan Ini: Rp 2.000.000</strong>
                                <span class="badge badge-primary px-2 py-1" style="background: #eff6ff; color: #2563eb;">85%</span>
                            </div>
                            <div style="height: 12px; background: #e2e8f0; border-radius: 12px; overflow: hidden; margin-bottom: 12px;">
                                <div style="height: 100%; width: 85%; background: #059669;"></div>
                            </div>
                            <small class="text-muted d-block mb-3">Terkumpul Rp 1.700.000 dari target Rp 2.000.000 (Sisa Rp 300.000)</small>
                            <div class="p-2 rounded bg-light border text-center font-weight-bold" style="font-size: 13px;">
                                🎉 Tinggal sedikit lagi untuk mencapai target!
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3 -->
                <div class="tab-pane" id="tab-leaderboard">
                    <div class="tab-pane-content">
                        <h3>Kompetisi Menabung yang Menyenangkan</h3>
                        <p>Lihat posisimu di peringkat pengguna teratas. Menabung jadi tidak membosankan dan memotivasi untuk terus berdisiplin.</p>
                        <ul class="tab-check-list">
                            <li><i class="fas fa-check-circle"></i> Peringkat dinamis dihitung berdasarkan persentase target</li>
                            <li><i class="fas fa-check-circle"></i> Medali emas, perak, dan perunggu untuk top saver bulanan</li>
                            <li><i class="fas fa-check-circle"></i> Menjaga privasi: nominal detail tetap aman dan rahasia</li>
                        </ul>
                        <a href="<?= site_url('auth/register') ?>" class="btn-hero-primary" style="padding: 12px 28px; font-size: 14px;">
                            Gabung ke Leaderboard
                        </a>
                    </div>
                    <div class="tab-pane-preview">
                        <div class="card p-3 shadow-sm border-0 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-2 font-weight-bold">
                                <span>Top Saver Bulan Ini</span>
                                <i class="fas fa-trophy text-warning"></i>
                            </div>
                            <div style="font-size: 13px;">
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <span>🥇 <strong>dama.rahmad</strong></span>
                                    <span class="badge badge-success px-2 py-1" style="background: #ecfdf5; color: #059669;">100% Tercapai</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <span>🥈 <strong>intan.permata</strong></span>
                                    <span class="badge badge-info px-2 py-1" style="background: #eff6ff; color: #2563eb;">92% Tercapai</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-2">
                                    <span>🥉 <strong>budi_santoso</strong></span>
                                    <span class="badge badge-warning px-2 py-1" style="background: #fffbeb; color: #d97706;">75% Tercapai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 4 -->
                <div class="tab-pane" id="tab-laporan">
                    <div class="tab-pane-content">
                        <h3>Cetak Dokumen Finansial Kapan Saja</h3>
                        <p>Butuh data keuangan untuk evaluasi anggaran atau pengajuan dokumen? Cetak PDF rapi atau download file Excel dengan satu klik.</p>
                        <ul class="tab-check-list">
                            <li><i class="fas fa-check-circle"></i> Ekspor PDF dengan header resmi dan ringkasan lengkap</li>
                            <li><i class="fas fa-check-circle"></i> File CSV/Excel kompatibel dengan Microsoft Excel & Google Sheets</li>
                            <li><i class="fas fa-check-circle"></i> Filter per periode bulan dan tahun bebas biaya</li>
                        </ul>
                        <a href="<?= site_url('auth/register') ?>" class="btn-hero-primary" style="padding: 12px 28px; font-size: 14px;">
                            Mulai Buat Laporan Gratis
                        </a>
                    </div>
                    <div class="tab-pane-preview">
                        <div class="card p-4 shadow-sm border-0 bg-white text-center">
                            <i class="fas fa-file-pdf text-danger mb-2" style="font-size: 48px;"></i>
                            <h6 class="font-weight-bold mb-1">Laporan_Keuangan_2026.pdf</h6>
                            <p class="small text-muted mb-3">Ukuran: 124 KB • Siap dicetak</p>
                            <div class="d-flex justify-content-center gap-2">
                                <span class="badge badge-light border px-2 py-1 mr-2"><i class="fas fa-file-pdf text-danger mr-1"></i> PDF</span>
                                <span class="badge badge-light border px-2 py-1"><i class="fas fa-file-excel text-success mr-1"></i> Excel (.csv)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- SECTION: TANYA JAWAB (FAQ)                                   -->
    <!-- ============================================================ -->
    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-header">
                <span class="section-tag green">
                    <i class="fas fa-question-circle mr-1"></i> Bantuan & Edukasi
                </span>
                <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                <p class="section-desc">Jawaban lengkap seputar penggunaan aplikasi Yuk Nabung untuk kebutuhan finansial harianmu.</p>
            </div>

            <div class="faq-accordion">
                <!-- FAQ 1 -->
                <div class="faq-item active">
                    <div class="faq-question">
                        <span>Apakah aplikasi Yuk Nabung benar-benar gratis?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Ya, 100% gratis! Anda dapat mendaftar, mencatat transaksi tanpa batas, mengatur target tabungan bulanan, melihat leaderboard, dan mengekspor laporan PDF maupun Excel tanpa dipungut biaya apa pun.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah orang lain dapat melihat nominal transaksi pribadi saya?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Tidak. Catatan pemasukan, pengeluaran, dan saldo privat Anda hanya dapat diakses oleh Anda sendiri. Pada fitur Leaderboard publik, sistem hanya menampilkan persentase pencapaian target bulanan untuk menjaga privasi nominal keuangan Anda.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bagaimana cara kerja Target Tabungan Bulanan?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Setiap awal bulan, Anda dapat menentukan nominal target yang ingin dicapai. Setiap kali Anda menyetor tabungan, sistem menghitung sisa dana yang dibutuhkan dan persentase progres secara real-time disertai notifikasi saat target berhasil dipenuhi.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bisa diakses lewat smartphone atau HP?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Sangat bisa! Yuk Nabung dirancang khusus dengan Progressive Web Apps (PWA) dan tampilan mobile-first ala Gojek yang responsif, cepat, dan hemat kuota data di semua jenis ponsel Android dan iPhone.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- SECTION: CTA BANNER                                          -->
    <!-- ============================================================ -->
    <section class="cta-section">
        <div class="container cta-box">
            <h2>Mulai Perjalanan Finansial yang Lebih Sehat Hari Ini</h2>
            <p>
                Bergabunglah bersama ribuan pengguna cerdas lainnya. Catat keuangan, tabung uang secara teratur, dan capai tujuan hidupmu lebih cepat.
            </p>
            <a href="<?= site_url('auth/register') ?>" class="btn-cta-white">
                <i class="fas fa-user-plus"></i> Buat Akun Gratis Sekarang
            </a>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- FOOTER                                                       -->
    <!-- ============================================================ -->
    <footer class="landing-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h4><i class="fas fa-wallet" style="color: #10b981;"></i> YukNabung</h4>
                    <p>
                        Aplikasi pencatatan keuangan dan target tabungan multi-user modern, interaktif, dan aman untuk membantu masyarakat mencapai kemandirian finansial.
                    </p>
                </div>
                <div class="footer-col">
                    <h5>Navigasi</h5>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#fitur">Fitur Utama</a></li>
                        <li><a href="#simulasi">Simulasi Tabungan</a></li>
                        <li><a href="#faq">Tanya Jawab</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Akun</h5>
                    <ul>
                        <li><a href="<?= site_url('auth/login') ?>">Masuk (Pengguna)</a></li>
                        <li><a href="<?= site_url('admin/login') ?>" style="color: #60a5fa; font-weight: 600;"><i class="fas fa-shield-alt mr-1"></i> Portal Admin</a></li>
                        <li><a href="<?= site_url('auth/register') ?>">Daftar Akun Baru</a></li>
                        <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Keamanan</h5>
                    <p style="font-size: 13px;">Dilindungi enkripsi data standar dan sistem privasi multi-user independen.</p>
                    <div style="margin-top: 14px; color: #10b981; font-weight: 700; font-size: 13px;">
                        <i class="fas fa-check-circle mr-1"></i> Sistem Aktif & Terverifikasi
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div>&copy; <?= date('Y') ?> YukNabung App. All rights reserved.</div>
                <div>Dirancang dengan dedikasi untuk pengelolaan finansial yang lebih baik.</div>
            </div>
        </div>
    </footer>

    <!-- ============================================================ -->
    <!-- JAVASCRIPT: LOGIKA KALKULATOR, COUNTER & INTERAKTIVITAS      -->
    <!-- ============================================================ -->
    <script>
        // ============================================================
        // 1. NAVBAR SCROLL EFFECT
        // ============================================================
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // ============================================================
        // 2. MOBILE MENU TOGGLE
        // ============================================================
        const mobileToggle = document.getElementById('mobileToggle');
        const navMenu = document.getElementById('navMenu');
        mobileToggle.addEventListener('click', () => {
            navMenu.classList.toggle('open');
            const icon = mobileToggle.querySelector('i');
            if (navMenu.classList.contains('open')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Tutup menu saat nav link diklik
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('open');
                mobileToggle.querySelector('i').className = 'fas fa-bars';
            });
        });

        // ============================================================
        // 3. INTERACTIVE SAVINGS SIMULATOR
        // ============================================================
        const inputTarget = document.getElementById('inputTarget');
        const inputMonths = document.getElementById('inputMonths');
        const dispTargetAmount = document.getElementById('dispTargetAmount');
        const dispTargetMonths = document.getElementById('dispTargetMonths');
        const dispMonthlyNeeded = document.getElementById('dispMonthlyNeeded');
        const dispDailyNeeded = document.getElementById('dispDailyNeeded');
        const dispTotalGoal = document.getElementById('dispTotalGoal');
        const dispEndDate = document.getElementById('dispEndDate');

        function formatRupiah(number) {
            return 'Rp ' + Math.round(number).toLocaleString('id-ID');
        }

        function calculateSavings() {
            const target = parseFloat(inputTarget.value) || 0;
            const months = parseInt(inputMonths.value) || 1;

            dispTargetAmount.textContent = formatRupiah(target);
            dispTargetMonths.textContent = months + ' Bulan';
            dispTotalGoal.textContent = formatRupiah(target);

            const perMonth = Math.ceil(target / months);
            const perDay = Math.ceil(target / (months * 30));

            dispMonthlyNeeded.textContent = formatRupiah(perMonth);
            dispDailyNeeded.textContent = formatRupiah(perDay) + ' / hari';

            // Estimasi tanggal selesai
            const now = new Date();
            now.setMonth(now.getMonth() + months);
            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            dispEndDate.textContent = monthNames[now.getMonth()] + ' ' + now.getFullYear();
        }

        inputTarget.addEventListener('input', calculateSavings);
        inputMonths.addEventListener('input', calculateSavings);

        function setTargetPreset(amount) {
            inputTarget.value = amount;
            calculateSavings();
            document.querySelectorAll('#inputTarget ~ .calc-presets .btn-preset').forEach(btn => {
                btn.classList.remove('active');
                if (btn.textContent.includes((amount/1000000) + ' Juta')) {
                    btn.classList.add('active');
                }
            });
        }

        function setMonthPreset(months) {
            inputMonths.value = months;
            calculateSavings();
            document.querySelectorAll('#inputMonths ~ .calc-presets .btn-preset').forEach(btn => {
                btn.classList.remove('active');
                if (btn.textContent.includes(months + ' Bulan') || (months === 12 && btn.textContent.includes('1 Tahun')) || (months === 24 && btn.textContent.includes('2 Tahun'))) {
                    btn.classList.add('active');
                }
            });
        }

        calculateSavings();

        // ============================================================
        // 4. STATS COUNTER ANIMATION
        // ============================================================
        let countersAnimated = false;
        const counterElements = document.querySelectorAll('.counter');

        function startCounters() {
            counterElements.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                let count = 0;
                const speed = target / 60;

                const updateCount = () => {
                    count += speed;
                    if (count < target) {
                        counter.innerText = Math.ceil(count).toLocaleString('id-ID');
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = target.toLocaleString('id-ID');
                    }
                };
                updateCount();
            });
        }

        window.addEventListener('scroll', () => {
            const statsBar = document.querySelector('.stats-bar');
            if (statsBar && !countersAnimated) {
                const rect = statsBar.getBoundingClientRect();
                if (rect.top <= window.innerHeight - 100) {
                    countersAnimated = true;
                    startCounters();
                }
            }
        });

        // ============================================================
        // 5. TAB SHOWCASE SWITCHER
        // ============================================================
        function switchTab(tabId, btn) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

            btn.classList.add('active');
            const targetPane = document.getElementById(tabId);
            if (targetPane) {
                targetPane.classList.add('active');
            }
        }

        // ============================================================
        // 6. FAQ ACCORDION TOGGLE
        // ============================================================
        document.querySelectorAll('.faq-question').forEach(q => {
            q.addEventListener('click', function() {
                const item = this.parentElement;
                const isActive = item.classList.contains('active');

                document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));

                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
