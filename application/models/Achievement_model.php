<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Achievement_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(['transaction_model', 'savings_model', 'savings_goal_model', 'budget_model']);
    }

    public function get_user_badges($user_id) {
        $current_month = date('m');
        $current_year = date('Y');

        // Statistik user
        $total_savings = (float) $this->savings_model->get_total_by_user($user_id);
        $savings_count = $this->db->where('user_id', $user_id)->count_all_results('savings');
        $savings_month_count = $this->db->where('user_id', $user_id)
            ->where('MONTH(deposit_date)', $current_month)
            ->where('YEAR(deposit_date)', $current_year)
            ->count_all_results('savings');

        $completed_goals = $this->db->where('user_id', $user_id)
            ->where('status', 'completed')
            ->count_all_results('savings_goals');

        $total_trx = $this->db->where('user_id', $user_id)->count_all_results('transactions');

        $overbudgets = $this->budget_model->check_overbudgets($user_id, $current_month, $current_year);
        $budgets_count = $this->db->where('user_id', $user_id)->count_all_results('category_budgets');

        $badges = [
            [
                'id' => 'first_step',
                'title' => 'Langkah Pertama',
                'description' => 'Melakukan setoran tabungan perdana di Yuk Nabung.',
                'icon' => 'fa-seedling',
                'color' => '#10b981',
                'unlocked' => ($savings_count >= 1),
                'progress' => min(100, ($savings_count / 1) * 100),
                'progress_text' => $savings_count >= 1 ? 'Tercapai!' : '0/1 Setoran'
            ],
            [
                'id' => 'goal_champion',
                'title' => 'Pahlawan Impian',
                'description' => 'Berhasil menyelesaikan minimal 1 Kantong Impian hingga 100%.',
                'icon' => 'fa-medal',
                'color' => '#3b82f6',
                'unlocked' => ($completed_goals >= 1),
                'progress' => min(100, ($completed_goals / 1) * 100),
                'progress_text' => $completed_goals >= 1 ? 'Tercapai!' : '0/1 Impian'
            ],
            [
                'id' => 'budget_master',
                'title' => 'Disiplin Anggaran',
                'description' => 'Membuat anggaran kategori dan tidak ada yang overbudget bulan ini.',
                'icon' => 'fa-shield-alt',
                'color' => '#8b5cf6',
                'unlocked' => ($budgets_count > 0 && count($overbudgets) === 0),
                'progress' => ($budgets_count > 0 && count($overbudgets) === 0) ? 100 : 0,
                'progress_text' => ($budgets_count > 0 && count($overbudgets) === 0) ? 'Tercapai!' : (count($overbudgets) > 0 ? count($overbudgets) . ' overbudget' : 'Belum buat anggaran')
            ],
            [
                'id' => 'savings_sultan',
                'title' => 'Sultan Nabung',
                'description' => 'Mengumpulkan total akumulasi tabungan sebesar Rp 5.000.000 atau lebih.',
                'icon' => 'fa-crown',
                'color' => '#f59e0b',
                'unlocked' => ($total_savings >= 5000000),
                'progress' => min(100, ($total_savings / 5000000) * 100),
                'progress_text' => 'Rp ' . number_format($total_savings, 0, ',', '.') . ' / 5 Jt'
            ],
            [
                'id' => 'savings_streak',
                'title' => 'Nabung Konsisten',
                'description' => 'Menabung minimal 3 kali dalam bulan berjalan.',
                'icon' => 'fa-fire',
                'color' => '#ef4444',
                'unlocked' => ($savings_month_count >= 3),
                'progress' => min(100, ($savings_month_count / 3) * 100),
                'progress_text' => $savings_month_count . ' / 3 Kali'
            ],
            [
                'id' => 'diligent_tracker',
                'title' => 'Pencatat Handal',
                'description' => 'Mencatat total 10 atau lebih transaksi pemasukan dan pengeluaran.',
                'icon' => 'fa-book-open',
                'color' => '#06b6d4',
                'unlocked' => ($total_trx >= 10),
                'progress' => min(100, ($total_trx / 10) * 100),
                'progress_text' => $total_trx . ' / 10 Transaksi'
            ]
        ];

        $unlocked_count = 0;
        foreach ($badges as $b) {
            if ($b['unlocked']) $unlocked_count++;
        }

        return [
            'badges' => $badges,
            'unlocked_count' => $unlocked_count,
            'total_count' => count($badges),
            'percentage' => round(($unlocked_count / count($badges)) * 100)
        ];
    }
}