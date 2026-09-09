<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bills extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'form_validation', 'template']);
        $this->load->model(['bill_model', 'wallet_model', 'activity_log_model']);

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        // Reset status to unpaid if paid_at is past month
        $this->bill_model->reset_monthly_status($user_id);

        $bills = $this->bill_model->get_by_user($user_id);
        $wallets = $this->wallet_model->get_by_user($user_id);
        $upcoming = $this->bill_model->get_upcoming($user_id, 7);

        $total_unpaid = 0;
        $total_paid = 0;
        foreach ($bills as $b) {
            if ($b->status === 'paid') {
                $total_paid += $b->amount;
            } else {
                $total_unpaid += $b->amount;
            }
        }

        $data = [
            'bills' => $bills,
            'wallets' => $wallets,
            'upcoming' => $upcoming,
            'total_unpaid' => $total_unpaid,
            'total_paid' => $total_paid
        ];

        $this->template
            ->page_title('Pengingat Tagihan & Rutin')
            ->hide_header()
            ->load('bills/index', $data);
    }

    public function add() {
        $user_id = $this->session->userdata('user_id');
        $raw_amount = $this->input->post('amount');
        $amount = (float) preg_replace('/[^0-9]/', '', (string)$raw_amount);

        $data = [
            'user_id' => $user_id,
            'title' => trim($this->input->post('title')),
            'amount' => $amount,
            'category' => $this->input->post('category') ?: 'Tagihan',
            'due_day' => max(1, min(31, (int)$this->input->post('due_day'))),
            'status' => 'unpaid',
            'notes' => trim($this->input->post('notes'))
        ];

        if (!empty($data['title']) && $data['amount'] > 0) {
            $this->bill_model->insert($data);
            $this->activity_log_model->log('BILL_ADD', 'Menambahkan pengingat tagihan: ' . $data['title']);
            $this->session->set_flashdata('success', 'Tagihan ' . htmlspecialchars($data['title']) . ' berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Nama tagihan dan nominal wajib diisi.');
        }

        redirect('bills');
    }

    public function pay($id) {
        $user_id = $this->session->userdata('user_id');
        $wallet_id = $this->input->post('wallet_id') ? (int)$this->input->post('wallet_id') : null;

        $res = $this->bill_model->mark_as_paid($id, $user_id, $wallet_id);
        if ($res) {
            $this->activity_log_model->log('BILL_PAY', 'Membayar tagihan ID #' . $id);
            $this->session->set_flashdata('success', 'Tagihan berhasil ditandai lunas dan dicatat ke pengeluaran!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses pembayaran tagihan.');
        }

        redirect('bills');
    }

    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $bill = $this->bill_model->get_row(['id' => $id, 'user_id' => $user_id]);

        if ($bill) {
            $this->bill_model->delete(['id' => $id, 'user_id' => $user_id]);
            $this->activity_log_model->log('BILL_DELETE', 'Menghapus tagihan: ' . $bill->title);
            $this->session->set_flashdata('success', 'Tagihan berhasil dihapus.');
        }

        redirect('bills');
    }
}