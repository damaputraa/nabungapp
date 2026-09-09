<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['transaction_model', 'savings_model', 'savings_target_model', 'user_model']);
        $this->load->library(['session', 'template']);
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    public function index() {
        $data = [];
        if ($this->session->userdata('role') == 'admin') {
            $data['users'] = $this->user_model->get_all();
        }

        $this->template
            ->page_title('Laporan Keuangan')
            ->hide_header()
            ->load('laporan/index', $data);
    }
    
    public function pdf() {
        $current_user_id = $this->session->userdata('user_id');
        $is_admin = ($this->session->userdata('role') == 'admin');
        
        // Admin bisa memilih user lain, user biasa hanya bisa miliknya sendiri
        $selected_user_id = $this->input->get('user_id');
        if ($is_admin && !empty($selected_user_id)) {
            $user_id = (int) $selected_user_id;
        } else {
            $user_id = $current_user_id;
        }

        $month = $this->input->get('month') ? str_pad($this->input->get('month'), 2, '0', STR_PAD_LEFT) : date('m');
        $year = $this->input->get('year') ?? date('Y');
        
        // Data transaksi
        $transactions = $this->transaction_model->get_by_user_month($user_id, $month, $year);
        $summary = $this->transaction_model->get_summary($user_id, $month, $year);
        
        // Data tabungan
        $savings = $this->savings_model->get_by_user_month($user_id, $month, $year);
        $total_savings = $this->savings_model->get_total_by_user_month($user_id, $month, $year);
        $target = $this->savings_target_model->get_or_create($user_id, $month, $year);
        
        $user = $this->user_model->get_row(['id' => $user_id]);
        if (!$user) {
            show_404();
        }

        $data = [
            'transactions' => $transactions,
            'summary' => $summary,
            'savings' => $savings,
            'total_savings' => $total_savings,
            'target' => $target,
            'month' => $month,
            'year' => $year,
            'user' => $user,
            'month_name' => date('F', mktime(0, 0, 0, (int)$month, 1))
        ];

        // Activity log
        $this->load->model('activity_log_model');
        $this->activity_log_model->log('REPORT_PDF', 'Mengunduh Rekening Koran PDF periode ' . $data['month_name'] . ' ' . $year . ' untuk akun: ' . $user->username);
        
        // Load library Dompdf via Composer
        if (file_exists(FCPATH . 'vendor/autoload.php')) {
            require_once FCPATH . 'vendor/autoload.php';
        } elseif (file_exists(APPPATH . 'libraries/dompdf/autoload.inc.php')) {
            require_once APPPATH . 'libraries/dompdf/autoload.inc.php';
        }

        $options = new Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf\Dompdf($options);
        
        $html = $this->load->view('laporan/pdf', $data, TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Rekening_Koran_" . preg_replace('/[^a-zA-Z0-9_-]/', '_', $user->username) . "_{$year}_{$month}.pdf", array("Attachment" => 0));
    }
}
