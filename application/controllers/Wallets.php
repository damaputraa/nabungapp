<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'form_validation', 'template']);
        $this->load->model(['wallet_model', 'activity_log_model']);

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $wallets = $this->wallet_model->get_by_user($user_id);
        $total_balance = $this->wallet_model->get_total_balance($user_id);

        $data = [
            'wallets' => $wallets,
            'total_balance' => $total_balance
        ];

        $this->template
            ->page_title('Kelola Dompet & Rekening Bank')
            ->hide_header()
            ->load('wallets/index', $data);
    }

    public function add() {
        $user_id = $this->session->userdata('user_id');
        
        $initial_balance = $this->input->post('balance');
        if ($initial_balance !== null) {
            $initial_balance = (float) preg_replace('/[^0-9]/', '', (string)$initial_balance);
        }

        $data = [
            'user_id' => $user_id,
            'name' => trim($this->input->post('name')),
            'type' => $this->input->post('type') ?: 'bank',
            'account_number' => trim($this->input->post('account_number')) ?: '-',
            'balance' => $initial_balance ?: 0,
            'color' => $this->input->post('color') ?: '#2563eb',
            'icon' => $this->input->post('icon') ?: 'fa-wallet',
            'is_default' => 0
        ];

        if (!empty($data['name'])) {
            $this->wallet_model->insert($data);
            $this->activity_log_model->log('WALLET_ADD', 'Menambahkan dompet baru: ' . $data['name']);
            $this->session->set_flashdata('success', 'Dompet ' . htmlspecialchars($data['name']) . ' berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Nama dompet / rekening wajib diisi.');
        }

        redirect('wallets');
    }

    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $wallet = $this->wallet_model->get_row(['id' => $id, 'user_id' => $user_id]);

        if (!$wallet) {
            show_404();
        }

        $balance = $this->input->post('balance');
        if ($balance !== null) {
            $balance = (float) preg_replace('/[^0-9]/', '', (string)$balance);
        }

        $update_data = [
            'name' => trim($this->input->post('name')),
            'type' => $this->input->post('type') ?: $wallet->type,
            'account_number' => trim($this->input->post('account_number')) ?: '-',
            'color' => $this->input->post('color') ?: $wallet->color,
            'icon' => $this->input->post('icon') ?: $wallet->icon
        ];

        if ($balance !== null) {
            $update_data['balance'] = $balance;
        }

        $this->wallet_model->update(['id' => $id, 'user_id' => $user_id], $update_data);
        $this->activity_log_model->log('WALLET_EDIT', 'Mengupdate data dompet: ' . $wallet->name);
        $this->session->set_flashdata('success', 'Data dompet berhasil diperbarui!');
        redirect('wallets');
    }

    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $wallet = $this->wallet_model->get_row(['id' => $id, 'user_id' => $user_id]);

        if ($wallet) {
            if ($wallet->is_default) {
                $this->session->set_flashdata('error', 'Dompet utama tidak dapat dihapus.');
            } else {
                $this->wallet_model->delete(['id' => $id, 'user_id' => $user_id]);
                $this->activity_log_model->log('WALLET_DELETE', 'Menghapus dompet: ' . $wallet->name);
                $this->session->set_flashdata('success', 'Dompet berhasil dihapus.');
            }
        }

        redirect('wallets');
    }

    public function transfer() {
        $user_id = $this->session->userdata('user_id');
        $from_id = (int) $this->input->post('from_wallet_id');
        $to_id = (int) $this->input->post('to_wallet_id');
        $raw_amount = $this->input->post('amount');
        $amount = (float) preg_replace('/[^0-9]/', '', (string)$raw_amount);

        $result = $this->wallet_model->transfer($user_id, $from_id, $to_id, $amount);

        if ($result['status']) {
            $this->activity_log_model->log('WALLET_TRANSFER', $result['message']);
            $this->session->set_flashdata('success', $result['message']);
        } else {
            $this->session->set_flashdata('error', $result['message']);
        }

        redirect('wallets');
    }
}