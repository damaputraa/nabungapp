<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet_model extends CI_Model {

    protected $table = 'wallets';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('is_default', 'DESC');
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->table)->result();
    }

    public function get_row($where) {
        return $this->db->get_where($this->table, $where)->row();
    }

    public function get_total_balance($user_id) {
        $this->db->select_sum('balance');
        $this->db->where('user_id', $user_id);
        $res = $this->db->get($this->table)->row();
        return (float) ($res->balance ?? 0);
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

    public function adjust_balance($wallet_id, $amount, $action = 'add') {
        if (!$wallet_id || $amount <= 0) return false;
        
        if ($action === 'add') {
            $this->db->set('balance', 'balance + ' . (float)$amount, FALSE);
        } else {
            $this->db->set('balance', 'balance - ' . (float)$amount, FALSE);
        }
        $this->db->where('id', $wallet_id);
        return $this->db->update($this->table);
    }

    public function transfer($user_id, $from_wallet_id, $to_wallet_id, $amount, $notes = '') {
        $amount = (float) $amount;
        if ($amount <= 0 || $from_wallet_id == $to_wallet_id) {
            return ['status' => false, 'message' => 'Nominal transfer tidak valid atau dompet tujuan sama.'];
        }

        $from_wallet = $this->get_row(['id' => $from_wallet_id, 'user_id' => $user_id]);
        $to_wallet = $this->get_row(['id' => $to_wallet_id, 'user_id' => $user_id]);

        if (!$from_wallet || !$to_wallet) {
            return ['status' => false, 'message' => 'Dompet sumber atau tujuan tidak ditemukan.'];
        }

        if ($from_wallet->balance < $amount) {
            return ['status' => false, 'message' => 'Saldo dompet sumber tidak mencukupi untuk transfer.'];
        }

        $this->db->trans_start();
        $this->adjust_balance($from_wallet_id, $amount, 'subtract');
        $this->adjust_balance($to_wallet_id, $amount, 'add');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return ['status' => false, 'message' => 'Gagal memproses transfer dana.'];
        }

        return ['status' => true, 'message' => 'Transfer dana sebesar Rp ' . number_format($amount, 0, ',', '.') . ' dari ' . $from_wallet->name . ' ke ' . $to_wallet->name . ' berhasil!'];
    }
}