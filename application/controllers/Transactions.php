<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('transaction_model');
        $this->load->library(['session', 'form_validation', 'template']);
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
public function index() {
    $user_id = $this->session->userdata('user_id');
    
    // Filter
    $type = $this->input->get('type');
    $category = $this->input->get('category');
    $date_from = $this->input->get('date_from');
    $date_to = $this->input->get('date_to');
    
    $transactions = $this->transaction_model->get_by_user_with_filter($user_id, $type, $category, $date_from, $date_to);
    
    $data = [
        'transactions' => $transactions,
        'type' => $type,
        'category' => $category,
        'date_from' => $date_from,
        'date_to' => $date_to
    ];
    
    $this->template
	->hide_header() //ini breadchumb diatas 
        ->page_title('Daftar Transaksi')
        ->plugins(['datatables'])
        ->page_js(['assets/js/transactions.js'])
        ->load('transactions/index', $data);
}
    
    public function add() {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('wallet_model');

        if ($this->input->post('amount') !== null) {
            $_POST['amount'] = preg_replace('/[^0-9]/', '', (string) $this->input->post('amount'));
        }
        $this->form_validation->set_rules('type', 'Jenis Transaksi', 'required');
        $this->form_validation->set_rules('category', 'Kategori', 'required');
        $this->form_validation->set_rules('amount', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('transaction_date', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['wallets'] = $this->wallet_model->get_by_user($user_id);
            $this->template
                ->page_title('Tambah Transaksi')
                ->load('transactions/add', $data);
        } else {
            $wallet_id = $this->input->post('wallet_id') ? (int)$this->input->post('wallet_id') : null;

            $data = [
                'user_id' => $user_id,
                'wallet_id' => $wallet_id,
                'type' => $this->input->post('type'),
                'category' => $this->input->post('category'),
                'amount' => $this->input->post('amount'),
                'description' => $this->input->post('description'),
                'transaction_date' => $this->input->post('transaction_date')
            ];

            // Upload receipt jika ada
            if (!empty($_FILES['receipt_file']['name'])) {
                $config['upload_path'] = './uploads/receipts/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 2048;
                $config['file_name'] = 'receipt_' . time() . '_' . $user_id;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('receipt_file')) {
                    $upload_data = $this->upload->data();
                    $data['receipt_image'] = $upload_data['file_name'];
                }
            }
            
            $this->transaction_model->insert($data);

            // Sesuaikan saldo dompet jika dipilih
            if ($wallet_id) {
                $this->wallet_model->adjust_balance($wallet_id, $data['amount'], $data['type'] == 'income' ? 'add' : 'subtract');
            }

            // Log activity
            $this->load->model('activity_log_model');
            $this->activity_log_model->log(
                'TRANSACTION_ADD',
                'Menambahkan transaksi ' . ($data['type'] == 'income' ? 'pemasukan' : 'pengeluaran') . ' sebesar Rp ' . number_format($data['amount'], 0, ',', '.')
            );

            $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan!');
            redirect('transactions');
        }
    }
    
    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('wallet_model');
        $transaction = $this->transaction_model->get_row(['id' => $id, 'user_id' => $user_id]);
        
        if (!$transaction) {
            show_404();
        }
        
        if ($this->input->post('amount') !== null) {
            $_POST['amount'] = preg_replace('/[^0-9]/', '', (string) $this->input->post('amount'));
        }
        $this->form_validation->set_rules('type', 'Jenis Transaksi', 'required');
        $this->form_validation->set_rules('category', 'Kategori', 'required');
        $this->form_validation->set_rules('amount', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('transaction_date', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['transaction'] = $transaction;
            $data['wallets'] = $this->wallet_model->get_by_user($user_id);
            $this->template
                ->page_title('Edit Transaksi')
                ->load('transactions/edit', $data);
        } else {
            $new_wallet_id = $this->input->post('wallet_id') ? (int)$this->input->post('wallet_id') : null;
            $new_amount = (float) $this->input->post('amount');
            $new_type = $this->input->post('type');

            $update_data = [
                'wallet_id' => $new_wallet_id,
                'type' => $new_type,
                'category' => $this->input->post('category'),
                'amount' => $new_amount,
                'description' => $this->input->post('description'),
                'transaction_date' => $this->input->post('transaction_date')
            ];

            // Revert saldo dompet lama jika ada
            if (!empty($transaction->wallet_id)) {
                $this->wallet_model->adjust_balance($transaction->wallet_id, $transaction->amount, $transaction->type == 'income' ? 'subtract' : 'add');
            }
            // Tambahkan ke saldo dompet baru jika ada
            if ($new_wallet_id) {
                $this->wallet_model->adjust_balance($new_wallet_id, $new_amount, $new_type == 'income' ? 'add' : 'subtract');
            }

            // Upload struk baru jika ada
            if (!empty($_FILES['receipt_file']['name'])) {
                $config['upload_path'] = './uploads/receipts/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 2048;
                $config['file_name'] = 'receipt_' . time() . '_' . $user_id;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('receipt_file')) {
                    if (!empty($transaction->receipt_image) && file_exists('./uploads/receipts/' . $transaction->receipt_image)) {
                        @unlink('./uploads/receipts/' . $transaction->receipt_image);
                    }
                    $upload_data = $this->upload->data();
                    $update_data['receipt_image'] = $upload_data['file_name'];
                }
            }
            
            $this->transaction_model->update(['id' => $id, 'user_id' => $user_id], $update_data);

            // Log activity
            $this->load->model('activity_log_model');
            $this->activity_log_model->log('TRANSACTION_EDIT', 'Mengupdate data transaksi ID #' . $id);

            $this->session->set_flashdata('success', 'Transaksi berhasil diupdate!');
            redirect('transactions');
        }
    }
    
    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('wallet_model');
        $transaction = $this->transaction_model->get_row(['id' => $id, 'user_id' => $user_id]);

        if ($transaction) {
            // Revert saldo dompet
            if (!empty($transaction->wallet_id)) {
                $this->wallet_model->adjust_balance($transaction->wallet_id, $transaction->amount, $transaction->type == 'income' ? 'subtract' : 'add');
            }

            if (!empty($transaction->receipt_image) && file_exists('./uploads/receipts/' . $transaction->receipt_image)) {
                @unlink('./uploads/receipts/' . $transaction->receipt_image);
            }
            $this->transaction_model->delete(['id' => $id, 'user_id' => $user_id]);

            // Log activity
            $this->load->model('activity_log_model');
            $this->activity_log_model->log('TRANSACTION_DELETE', 'Menghapus data transaksi ID #' . $id);

            $this->session->set_flashdata('success', 'Transaksi berhasil dihapus!');
        }
        
        redirect('transactions');
    }
}
