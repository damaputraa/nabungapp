<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['budget_model', 'transaction_model']);
        $this->load->library(['session', 'form_validation', 'template']);
        $this->load->helper(['url']);
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $month = $this->input->get('month') ?: date('m');
        $year = $this->input->get('year') ?: date('Y');
        
        $budgets = $this->budget_model->get_user_budgets_with_spending($user_id, $month, $year);
        $overbudgets = $this->budget_model->check_overbudgets($user_id, $month, $year);
        
        $total_budget = 0;
        $total_spent = 0;
        foreach ($budgets as $b) {
            $total_budget += $b->monthly_limit;
            $total_spent += $b->spent;
        }
        
        // Kategori pengeluaran yang umum untuk kemudahan pilihan
        $default_categories = [
            'Makanan & Minuman',
            'Transportasi',
            'Belanja Kebutuhan',
            'Tagihan & Utilitas',
            'Hiburan & Rekreasi',
            'Pendidikan',
            'Kesehatan',
            'Keluarga',
            'Sedekah & Donasi',
            'Lain-lain'
        ];
        
        $data = [
            'budgets' => $budgets,
            'overbudgets' => $overbudgets,
            'total_budget' => $total_budget,
            'total_spent' => $total_spent,
            'selected_month' => $month,
            'selected_year' => $year,
            'default_categories' => $default_categories
        ];
        
        $this->template
            ->page_title('Anggaran & Batas Pengeluaran')
            ->hide_header()
            ->load('budget/index', $data);
    }
    
    public function save() {
        $user_id = $this->session->userdata('user_id');
        
        if ($this->input->post('monthly_limit') !== null) {
            $_POST['monthly_limit'] = preg_replace('/[^0-9]/', '', (string) $this->input->post('monthly_limit'));
        }
        
        $this->form_validation->set_rules('category', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('monthly_limit', 'Batas Anggaran Bulanan', 'required|numeric|greater_than[0]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal menyimpan anggaran. Pastikan nominal dan kategori terisi valid.');
        } else {
            $category = trim($this->input->post('category'));
            $monthly_limit = (float) $this->input->post('monthly_limit');
            
            $this->budget_model->set_budget($user_id, $category, $monthly_limit);
            $this->session->set_flashdata('success', "Anggaran untuk kategori '{$category}' berhasil disimpan!");
        }
        
        redirect('budget');
    }
    
    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->budget_model->delete(['id' => $id, 'user_id' => $user_id]);
        $this->session->set_flashdata('success', 'Anggaran kategori berhasil dihapus.');
        redirect('budget');
    }
}
