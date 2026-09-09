<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goals extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['savings_goal_model', 'savings_model']);
        $this->load->library(['session', 'form_validation', 'template']);
        $this->load->helper(['url']);
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $status_filter = $this->input->get('status'); // 'active', 'completed', or null
        
        $goals = $this->savings_goal_model->get_by_user($user_id, $status_filter);
        $summary = $this->savings_goal_model->get_summary_user($user_id);
        
        $data = [
            'goals' => $goals,
            'summary' => $summary,
            'status_filter' => $status_filter
        ];
        
        $this->template
            ->page_title('Kantong Impian & Target Tabungan')
            ->hide_header()
            ->load('goals/index', $data);
    }
    
    public function create() {
        $user_id = $this->session->userdata('user_id');
        
        if ($this->input->post('target_amount') !== null) {
            $_POST['target_amount'] = preg_replace('/[^0-9]/', '', (string) $this->input->post('target_amount'));
        }
        if ($this->input->post('initial_amount') !== null) {
            $_POST['initial_amount'] = preg_replace('/[^0-9]/', '', (string) $this->input->post('initial_amount'));
        }
        
        $this->form_validation->set_rules('title', 'Nama Impian', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('target_amount', 'Target Dana', 'required|numeric|greater_than[0]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>') ?: 'Gagal menambahkan kantong impian.');
            redirect('goals');
        } else {
            $title = trim($this->input->post('title'));
            $target_amount = (float) $this->input->post('target_amount');
            $initial_amount = (float) ($this->input->post('initial_amount') ?: 0);
            $deadline = $this->input->post('deadline') ?: null;
            $category = $this->input->post('category') ?: 'Umum';
            $icon = $this->input->post('icon') ?: 'fa-bullseye';
            $color = $this->input->post('color') ?: '#00a651';
            $notes = $this->input->post('notes') ?: '';
            
            $status = ($initial_amount >= $target_amount && $target_amount > 0) ? 'completed' : 'active';
            
            $data = [
                'user_id' => $user_id,
                'title' => $title,
                'target_amount' => $target_amount,
                'current_amount' => $initial_amount,
                'deadline' => $deadline,
                'category' => $category,
                'icon' => $icon,
                'color' => $color,
                'notes' => $notes,
                'status' => $status
            ];
            
            $goal_id = $this->savings_goal_model->insert($data);
            
            // Jika ada saldo awal, catat juga ke riwayat savings
            if ($initial_amount > 0) {
                $this->savings_model->insert([
                    'user_id' => $user_id,
                    'goal_id' => $goal_id,
                    'amount' => $initial_amount,
                    'deposit_date' => date('Y-m-d'),
                    'description' => 'Saldo awal Kantong Impian: ' . $title
                ]);
            }
            
            $this->session->set_flashdata('success', "Kantong Impian '{$title}' berhasil dibuat!");
            redirect('goals');
        }
    }
    
    public function deposit() {
        $user_id = $this->session->userdata('user_id');
        
        if ($this->input->post('amount') !== null) {
            $_POST['amount'] = preg_replace('/[^0-9]/', '', (string) $this->input->post('amount'));
        }
        
        $this->form_validation->set_rules('goal_id', 'Kantong Impian', 'required|numeric');
        $this->form_validation->set_rules('amount', 'Nominal Setoran', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('deposit_date', 'Tanggal Setoran', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal menabung ke kantong impian. Pastikan nominal dan tanggal valid.');
            redirect('goals');
        } else {
            $goal_id = $this->input->post('goal_id');
            $amount = (float) $this->input->post('amount');
            $date = $this->input->post('deposit_date');
            $description = $this->input->post('description') ?: '';
            
            $res = $this->savings_goal_model->add_deposit_to_goal($goal_id, $user_id, $amount, $date, $description);
            if ($res) {
                $this->session->set_flashdata('success', 'Berhasil menambahkan tabungan ke kantong impian!');
            } else {
                $this->session->set_flashdata('error', 'Kantong impian tidak ditemukan atau sudah ditutup.');
            }
            redirect('goals');
        }
    }
    
    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $goal = $this->savings_goal_model->get_goal($id, $user_id);
        if ($goal) {
            $this->savings_goal_model->delete(['id' => $id, 'user_id' => $user_id]);
            $this->session->set_flashdata('success', "Kantong Impian '{$goal->title}' berhasil dihapus.");
        }
        redirect('goals');
    }
}
