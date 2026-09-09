<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savings extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['savings_model', 'savings_target_model', 'user_model']);
        $this->load->library(['session', 'form_validation', 'template']);
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    /**
     * Halaman utama tabungan user sendiri
     */
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $current_month = date('m');
        $current_year = date('Y');
        
        $target = $this->savings_target_model->get_or_create($user_id, $current_month, $current_year);
        $total_deposit = $this->savings_model->get_total_by_user_month($user_id, $current_month, $current_year);
        $savings = $this->savings_model->get_by_user($user_id);
        $total_all = $this->savings_model->get_total_by_user($user_id);
        
        $data = [
            'target' => $target,
            'total_deposit' => $total_deposit,
            'savings' => $savings,
            'total_all' => $total_all,
            'current_month' => date('F Y'),
            'percentage' => $target->target_amount > 0 ? min(($total_deposit / $target->target_amount) * 100, 100) : 0
        ];
        
        $this->template
            ->page_title('Tabungan')
            ->load('savings/index', $data);
    }
    
    /**
     * Form tambah setoran tabungan
     */
    public function add() {
        if ($this->input->post('amount') !== null) {
            $_POST['amount'] = preg_replace('/[^0-9]/', '', (string) $this->input->post('amount'));
        }
        $this->form_validation->set_rules('amount', 'Jumlah Setoran', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('deposit_date', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->template
                ->page_title('Tambah Setoran')
                ->load('savings/add');
        } else {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'amount' => $this->input->post('amount'),
                'deposit_date' => $this->input->post('deposit_date'),
                'description' => $this->input->post('description')
            ];
            
            $this->savings_model->insert($data);
            $this->session->set_flashdata('success', 'Setoran tabungan berhasil ditambahkan!');
            redirect('savings');
        }
    }
    
    /**
     * Hapus setoran tabungan
     */
    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->savings_model->delete(['id' => $id, 'user_id' => $user_id]);
        $this->session->set_flashdata('success', 'Setoran berhasil dihapus!');
        redirect('savings');
    }
    
    // ================================================================
    // LEADERBOARD - LIHAT PROGRESS TABUNGAN USER LAIN
    // ================================================================
    public function leaderboard() {
        $current_month = date('m');
        $current_year = date('Y');
        
        // Ambil semua user
        $all_users = $this->user_model->get_all();
        $leaderboard = [];
        
        foreach ($all_users as $user) {
            // Ambil target dan setoran user
            $target = $this->savings_target_model->get_or_create($user->id, $current_month, $current_year);
            $total_deposit = $this->savings_model->get_total_by_user_month($user->id, $current_month, $current_year);
            
            // Hitung progress
            $progress = $target->target_amount > 0 
                ? min(($total_deposit / $target->target_amount) * 100, 100) 
                : 0;
            
            $leaderboard[] = (object) [
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'target_amount' => (float) $target->target_amount,
                'total_deposit' => (float) $total_deposit,
                'progress' => round($progress, 1),
                'remaining' => max(0, $target->target_amount - $total_deposit),
                'status' => $progress >= 100 ? 'completed' : ($progress >= 50 ? 'half' : 'low')
            ];
        }
        
        // Urutkan berdasarkan progress (tertinggi ke terendah)
        usort($leaderboard, function($a, $b) {
            return $b->progress <=> $a->progress;
        });
        
        // Tambahkan ranking
        $rank = 1;
        foreach ($leaderboard as $item) {
            $item->rank = $rank++;
        }
        
        $data = [
            'leaderboard' => $leaderboard,
            'current_month' => date('F Y'),
            'total_users' => count($leaderboard)
        ];
        
        $this->template
            ->page_title('Leaderboard Tabungan')
            ->load('savings/leaderboard', $data);
    }
    
    /**
     * Lihat detail tabungan user lain (hanya untuk user)
     */
    public function view_user($user_id) {
        $current_user_id = $this->session->userdata('user_id');
        $current_month = date('m');
        $current_year = date('Y');
        
        // Cek apakah user yang dilihat ada
        $user = $this->user_model->get_row(['id' => $user_id]);
        if (!$user) {
            show_404();
        }
        
        // Ambil data tabungan user tersebut
        $target = $this->savings_target_model->get_or_create($user_id, $current_month, $current_year);
        $total_deposit = $this->savings_model->get_total_by_user_month($user_id, $current_month, $current_year);
        $savings = $this->savings_model->get_by_user($user_id);
        $total_all = $this->savings_model->get_total_by_user($user_id);
        
        $progress = $target->target_amount > 0 
            ? min(($total_deposit / $target->target_amount) * 100, 100) 
            : 0;
        
        $data = [
            'view_user' => $user,
            'target' => $target,
            'total_deposit' => $total_deposit,
            'savings' => $savings,
            'total_all' => $total_all,
            'progress' => round($progress, 1),
            'remaining' => max(0, $target->target_amount - $total_deposit),
            'current_month' => date('F Y'),
            'is_own' => ($user_id == $current_user_id)
        ];
        
        $this->template
            ->page_title('Detail Tabungan ' . $user->username)
            ->load('savings/view_user', $data);
    }
}
