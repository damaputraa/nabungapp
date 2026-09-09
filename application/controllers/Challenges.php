<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challenges extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'template']);
        $this->load->model(['challenge_model', 'achievement_model', 'savings_model', 'activity_log_model']);

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $challenges = $this->challenge_model->get_by_user($user_id);
        $badges_data = $this->achievement_model->get_user_badges($user_id);

        $data = [
            'challenges' => $challenges,
            'badges' => $badges_data['badges'],
            'unlocked_count' => $badges_data['unlocked_count'],
            'total_badges' => $badges_data['total_count'],
            'badge_percentage' => $badges_data['percentage']
        ];

        $this->template
            ->page_title('Tantangan Menabung & Lencana Prestasi')
            ->hide_header()
            ->load('challenges/index', $data);
    }

    public function create() {
        $user_id = $this->session->userdata('user_id');
        $type = $this->input->post('challenge_type') ?: '30_days';
        $title = trim($this->input->post('title'));
        
        $raw_target = $this->input->post('target_amount');
        $target = (float) preg_replace('/[^0-9]/', '', (string)$raw_target);

        if (empty($title)) {
            $title = ($type === '30_days') ? 'Tantangan 30 Hari Menabung' : 'Tantangan 52 Minggu Nabung';
        }

        if ($target <= 0) {
            $target = ($type === '30_days') ? 1000000 : 5000000;
        }

        $data = [
            'user_id' => $user_id,
            'challenge_type' => $type,
            'title' => $title,
            'target_amount' => $target,
            'current_amount' => 0,
            'completed_steps' => json_encode([]),
            'status' => 'active'
        ];

        $this->challenge_model->insert($data);
        $this->activity_log_model->log('CHALLENGE_CREATE', 'Memulai tantangan menabung baru: ' . $title);
        $this->session->set_flashdata('success', 'Tantangan menabung berhasil dimulai! Semangat menabung!');
        redirect('challenges');
    }

    public function toggle_step() {
        $user_id = $this->session->userdata('user_id');
        $challenge_id = (int) $this->input->post('challenge_id');
        $step_number = (int) $this->input->post('step_number');
        $raw_amount = $this->input->post('step_amount');
        $step_amount = (float) $raw_amount;

        $res = $this->challenge_model->toggle_step($challenge_id, $user_id, $step_number, $step_amount);

        // Jika dicentang (tambah tabungan), otomatis catat ke setoran tabungan jika user mau
        if ($this->input->post('auto_deposit') == '1' && $step_amount > 0) {
            $this->savings_model->insert([
                'user_id' => $user_id,
                'amount' => $step_amount,
                'deposit_date' => date('Y-m-d'),
                'description' => 'Setoran dari Tantangan Menabung (Langkah #' . $step_number . ')'
            ]);
        }

        header('Content-Type: application/json');
        echo json_encode($res);
        exit;
    }

    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->challenge_model->delete(['id' => $id, 'user_id' => $user_id]);
        $this->session->set_flashdata('success', 'Tantangan menabung berhasil dihapus.');
        redirect('challenges');
    }
}