<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['transaction_model', 'savings_model', 'savings_target_model', 'user_model']);
        $this->load->library('session');
        $this->load->helper('url');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    public function index() {
        redirect('laporan');
    }
    
    /**
     * Export data keuangan ke format CSV/Excel
     */
    public function excel() {
        $current_user_id = $this->session->userdata('user_id');
        $is_admin = ($this->session->userdata('role') == 'admin');
        
        $selected_user_id = $this->input->get('user_id');
        if ($is_admin && !empty($selected_user_id)) {
            $user_id = (int) $selected_user_id;
        } else {
            $user_id = $current_user_id;
        }

        $month = $this->input->get('month') ? str_pad($this->input->get('month'), 2, '0', STR_PAD_LEFT) : date('m');
        $year = $this->input->get('year') ?? date('Y');
        
        $user = $this->user_model->get_row(['id' => $user_id]);
        if (!$user) {
            show_404();
        }
        
        $transactions = $this->transaction_model->get_by_user_month($user_id, $month, $year);
        $summary = $this->transaction_model->get_summary($user_id, $month, $year);
        $savings = $this->savings_model->get_by_user_month($user_id, $month, $year);
        $total_savings = $this->savings_model->get_total_by_user_month($user_id, $month, $year);
        $target = $this->savings_target_model->get_or_create($user_id, $month, $year);
        
        $filename = "Laporan_Keuangan_" . preg_replace('/[^a-zA-Z0-9_-]/', '_', $user->username) . "_{$year}_{$month}.csv";
        
        // Header output file download
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');
        
        $output = fopen('php://output', 'w');
        
        // Tulis UTF-8 BOM untuk Microsoft Excel
        fputs($output, "\xEF\xBB\xBF");
        
        // Judul Laporan
        fputcsv($output, ['LAPORAN KEUANGAN & TABUNGAN']);
        fputcsv($output, ['Nama Pengguna', $user->username]);
        fputcsv($output, ['Email', $user->email]);
        fputcsv($output, ['Periode', "Bulan {$month} Tahun {$year}"]);
        fputcsv($output, ['Tanggal Unduh', date('d-m-Y H:i:s')]);
        fputcsv($output, []); // Baris kosong
        
        // Ringkasan Keuangan
        fputcsv($output, ['--- RINGKASAN KEUANGAN ---']);
        fputcsv($output, ['Metrik', 'Nominal (Rp)']);
        fputcsv($output, ['Total Pemasukan', number_format($summary->total_income ?? 0, 0, ',', '.')]);
        fputcsv($output, ['Total Pengeluaran', number_format($summary->total_expense ?? 0, 0, ',', '.')]);
        fputcsv($output, ['Saldo Bersih (Net)', number_format($summary->balance ?? 0, 0, ',', '.')]);
        fputcsv($output, ['Total Tabungan Terkumpul', number_format($total_savings ?? 0, 0, ',', '.')]);
        fputcsv($output, ['Target Tabungan Bulan Ini', number_format($target->target_amount ?? 0, 0, ',', '.')]);
        $progress = ($target->target_amount ?? 0) > 0 ? min(($total_savings / $target->target_amount) * 100, 100) : 0;
        fputcsv($output, ['Persentase Target Tercapai', round($progress, 1) . '%']);
        fputcsv($output, []); // Baris kosong
        
        // Rincian Transaksi
        fputcsv($output, ['--- RINCIAN TRANSAKSI ---']);
        fputcsv($output, ['No', 'Tanggal', 'Tipe', 'Kategori', 'Nominal (Rp)', 'Keterangan']);
        
        if (!empty($transactions)) {
            $no = 1;
            foreach ($transactions as $trx) {
                fputcsv($output, [
                    $no++,
                    date('d-m-Y', strtotime($trx->transaction_date)),
                    $trx->type == 'income' ? 'Pemasukan' : 'Pengeluaran',
                    $trx->category,
                    number_format($trx->amount, 0, ',', '.'),
                    $trx->description ?? '-'
                ]);
            }
        } else {
            fputcsv($output, ['-', '-', 'Tidak ada transaksi pada periode ini', '-', '-', '-']);
        }
        fputcsv($output, []); // Baris kosong
        
        // Rincian Setoran Tabungan
        fputcsv($output, ['--- RINCIAN SETORAN TABUNGAN ---']);
        fputcsv($output, ['No', 'Tanggal Setor', 'Nominal Setoran (Rp)', 'Keterangan']);
        
        if (!empty($savings)) {
            $no = 1;
            foreach ($savings as $sav) {
                fputcsv($output, [
                    $no++,
                    date('d-m-Y', strtotime($sav->deposit_date)),
                    number_format($sav->amount, 0, ',', '.'),
                    $sav->description ?? '-'
                ]);
            }
            fputcsv($output, ['Total', '', number_format($total_savings, 0, ',', '.'), '']);
        } else {
            fputcsv($output, ['-', '-', 'Tidak ada setoran tabungan pada periode ini', '-']);
        }
        
        fclose($output);
        exit;
    }
}

