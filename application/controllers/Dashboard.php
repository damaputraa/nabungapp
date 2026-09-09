<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'template']);
        $this->load->model(['transaction_model', 'savings_target_model', 'savings_model', 'user_model']);
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $current_month = date('m');
        $current_year = date('Y');
        $role = strtolower(trim((string) $this->session->userdata('role')));
        if ($role !== 'admin') {
            $role = 'user';
        }
        
        // ========== DATA TRANSAKSI USER ==========
        $summary = $this->transaction_model->get_summary($user_id, $current_month, $current_year);
        $total_income = (float) $this->transaction_model->get_income_by_user($user_id);
        $total_expense = (float) $this->transaction_model->get_expense_by_user($user_id);
        
        // ========== DATA TABUNGAN USER ==========
        $savings_target = $this->savings_target_model->get_or_create($user_id, $current_month, $current_year);
        $savings_total_deposit = (float) $this->savings_model->get_total_by_user_month($user_id, $current_month, $current_year);
        
        // ========== DATA TRANSAKSI TERAKHIR (untuk user) ==========
        $transactions = $this->transaction_model->get_by_user($user_id);
        
        // ========== DATA ADMIN (PLATFORM WIDE) ==========
        $all_users_savings = [];
        $platform_stats = [];
        $recent_platform_transactions = [];
        
        if ($role == 'admin') {
            $all_users = $this->user_model->get_all();
            foreach ($all_users as $user) {
                $target = $this->savings_target_model->get_or_create($user->id, $current_month, $current_year);
                $total_deposit = (float) $this->savings_model->get_total_by_user_month($user->id, $current_month, $current_year);
                $total_user_all = (float) $this->savings_model->get_total_by_user($user->id);
                
                $all_users_savings[] = (object) [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'target_amount' => (float) ($target->target_amount ?? 0),
                    'total_deposit' => $total_deposit,
                    'total_all_time' => $total_user_all
                ];
            }
            
            $platform_summary = $this->transaction_model->get_platform_summary($current_month, $current_year);
            $platform_all_summary = $this->transaction_model->get_platform_summary();
            
            $platform_stats = [
                'total_users' => count($all_users),
                'platform_total_savings' => (float) $this->savings_model->get_total_platform(),
                'platform_month_savings' => (float) $this->savings_model->get_total_platform_month($current_month, $current_year),
                'platform_month_income' => (float) ($platform_summary->total_income ?? 0),
                'platform_month_expense' => (float) ($platform_summary->total_expense ?? 0),
                'platform_month_balance' => (float) ($platform_summary->balance ?? 0),
                'platform_all_income' => (float) ($platform_all_summary->total_income ?? 0),
                'platform_all_expense' => (float) ($platform_all_summary->total_expense ?? 0)
            ];
            
            $all_trx = $this->transaction_model->get_all_with_filter(null, null, null);
            $recent_platform_transactions = array_slice($all_trx, 0, 8);
        }
        
        // ========== NOTIFIKASI, PENGUMUMAN & FITUR BARU ==========
        $this->load->model([
            'notification_model', 'savings_goal_model', 'budget_model', 
            'announcement_model', 'wallet_model', 'bill_model', 'achievement_model'
        ]);
        $notification = $this->notification_model->check_savings_progress(
            $user_id, 
            $savings_total_deposit, 
            $savings_target->target_amount ?? 1
        );
        
        $announcements = $this->announcement_model->get_active();
        $platform_savings_trend = ($role === 'admin') ? $this->savings_model->get_platform_trend_months(6) : [];
        $platform_top_categories = ($role === 'admin') ? $this->transaction_model->get_platform_top_categories(5) : [];

        // Data Kantong Impian & Anggaran Kategori
        $user_goals = $this->savings_goal_model->get_by_user($user_id, 'active');
        $goals_summary = $this->savings_goal_model->get_summary_user($user_id);
        $overbudgets = $this->budget_model->check_overbudgets($user_id, $current_month, $current_year);

        // Data Dompet & Tagihan & Gamifikasi (User)
        $user_wallets = $this->wallet_model->get_by_user($user_id);
        $wallets_total_balance = $this->wallet_model->get_total_balance($user_id);
        $upcoming_bills = $this->bill_model->get_upcoming($user_id, 7);
        $expense_by_category = $this->transaction_model->get_expense_by_category($user_id, $current_month, $current_year);
        $badge_summary = $this->achievement_model->get_user_badges($user_id);
        
        // ========== SIAPKAN DATA UNTUK VIEW ==========
        $data = [
            'title' => 'Dashboard',
            'summary' => $summary,
            'total_income' => $total_income,
            'total_expense' => $total_expense,
            'balance' => $total_income - $total_expense,
            'current_month' => date('F Y'),
            // Data tabungan user
            'savings_target' => $savings_target,
            'savings_total_deposit' => $savings_total_deposit,
            // Data admin
            'all_users_savings' => $all_users_savings,
            'platform_stats' => $platform_stats,
            'platform_savings_trend' => $platform_savings_trend,
            'platform_top_categories' => $platform_top_categories,
            'recent_platform_transactions' => $recent_platform_transactions,
            // Notifikasi & Pengumuman
            'notification' => $notification,
            'announcements' => $announcements,
            // Transaksi terakhir (untuk user)
            'transactions' => $transactions,
            // Kantong Impian & Anggaran
            'user_goals' => $user_goals,
            'goals_summary' => $goals_summary,
            'overbudgets' => $overbudgets,
            // Fitur Baru Phase 3
            'wallets' => $user_wallets,
            'wallets_total_balance' => $wallets_total_balance,
            'upcoming_bills' => $upcoming_bills,
            'expense_by_category' => $expense_by_category,
            'badge_summary' => $badge_summary
        ];
        
        // ========== PILIH TAMPILAN BERDASARKAN ROLE ==========
        if ($role === 'admin') {
            $this->template
                ->page_title('Dashboard Eksekutif Admin')
                ->hide_header()
                ->plugins(['chartjs'])
                ->page_js(['assets/js/dashboard.js'])
                ->load('dashboard/index', $data);
        } else {
            // Default untuk seluruh pengguna biasa (user)
            $this->template
                ->page_title('Dashboard')
                ->hide_header()
                ->plugins(['chartjs'])
                ->page_js(['assets/js/dashboard.js'])
                ->load('dashboard/user_dashboard', $data);
        }
    }
}
