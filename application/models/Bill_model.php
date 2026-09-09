<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill_model extends CI_Model {

    protected $table = 'bills';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('due_day', 'ASC');
        return $this->db->get($this->table)->result();
    }

    public function get_upcoming($user_id, $days_ahead = 7) {
        $current_day = (int) date('d');
        $max_day = $current_day + $days_ahead;

        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'unpaid');
        $this->db->order_by('due_day', 'ASC');
        $all = $this->db->get($this->table)->result();

        $upcoming = [];
        foreach ($all as $b) {
            // Evaluasi selisih hari
            $diff = $b->due_day - $current_day;
            $b->days_left = $diff;
            if ($diff <= $days_ahead) {
                $upcoming[] = $b;
            }
        }
        return $upcoming;
    }

    public function get_row($where) {
        return $this->db->get_where($this->table, $where)->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data) {
        $this->db->where($where);
        return $this->db->update($this->table, $data);
    }

    public function delete($where) {
        $this->db->where($where);
        return $this->db->delete($this->table);
    }

    public function mark_as_paid($id, $user_id, $wallet_id = null) {
        $bill = $this->get_row(['id' => $id, 'user_id' => $user_id]);
        if (!$bill) return false;

        $this->db->trans_start();

        // 1. Update status tagihan
        $this->update(['id' => $id, 'user_id' => $user_id], [
            'status' => 'paid',
            'paid_at' => date('Y-m-d')
        ]);

        // 2. Otomatis catat ke tabel transactions sebagai pengeluaran
        $this->load->model(['transaction_model', 'wallet_model']);
        $trx_data = [
            'user_id' => $user_id,
            'wallet_id' => $wallet_id,
            'type' => 'expense',
            'category' => $bill->category ?: 'Tagihan',
            'amount' => $bill->amount,
            'description' => 'Pembayaran tagihan rutin: ' . $bill->title,
            'transaction_date' => date('Y-m-d')
        ];
        $this->transaction_model->insert($trx_data);

        // 3. Potong saldo dompet jika wallet_id dipilih
        if ($wallet_id) {
            $this->wallet_model->adjust_balance($wallet_id, $bill->amount, 'subtract');
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function reset_monthly_status($user_id) {
        // Reset status to unpaid for a new month if paid_at was in a previous month
        $current_month = date('m');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'paid');
        $this->db->where('MONTH(paid_at) !=', $current_month);
        return $this->db->update($this->table, ['status' => 'unpaid']);
    }
}