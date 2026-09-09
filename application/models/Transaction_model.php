<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'transactions';
    }
    
    public function get_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('transaction_date', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_summary($user_id, $month, $year) {
        $this->db->select("
            SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as total_income,
            SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as total_expense,
            (SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) - 
             SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END)) as balance
        ");
        $this->db->where('user_id', $user_id);
        $this->db->where('MONTH(transaction_date)', $month);
        $this->db->where('YEAR(transaction_date)', $year);
        return $this->db->get($this->table)->row();
    }
    
    public function get_income_by_user($user_id) {
        $this->db->select_sum('amount');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', 'income');
        $result = $this->db->get($this->table)->row();
        return $result->amount ?? 0;
    }
    
    public function get_expense_by_user($user_id) {
        $this->db->select_sum('amount');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', 'expense');
        $result = $this->db->get($this->table)->row();
        return $result->amount ?? 0;
    }
	public function get_by_user_with_filter($user_id, $type = null, $category = null, $date_from = null, $date_to = null) {
        $this->db->where('user_id', $user_id);
        
        if ($type) {
            $this->db->where('type', $type);
        }
        if ($category) {
            $this->db->where('category', $category);
        }
        if ($date_from) {
            $this->db->where('transaction_date >=', $date_from);
        }
        if ($date_to) {
            $this->db->where('transaction_date <=', $date_to);
        }
        
        $this->db->order_by('transaction_date', 'DESC');
        return $this->db->get($this->table)->result();
	}

    public function get_by_user_month($user_id, $month, $year) {
        $this->db->where('user_id', $user_id);
        $this->db->where('MONTH(transaction_date)', (int)$month);
        $this->db->where('YEAR(transaction_date)', (int)$year);
        $this->db->order_by('transaction_date', 'ASC');
        return $this->db->get($this->table)->result();
    }

    public function get_all_with_filter($month = null, $year = null, $user_id = null) {
        $this->db->select('transactions.*, users.username');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = transactions.user_id', 'left');
        if ($user_id) {
            $this->db->where('transactions.user_id', $user_id);
        }
        if ($month) {
            $this->db->where('MONTH(transactions.transaction_date)', (int)$month);
        }
        if ($year) {
            $this->db->where('YEAR(transactions.transaction_date)', (int)$year);
        }
        $this->db->order_by('transactions.transaction_date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_platform_summary($month = null, $year = null) {
        $this->db->select("
            SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as total_income,
            SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as total_expense,
            (SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) - 
             SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END)) as balance
        ");
        if ($month) {
            $this->db->where('MONTH(transaction_date)', (int)$month);
        }
        if ($year) {
            $this->db->where('YEAR(transaction_date)', (int)$year);
        }
        return $this->db->get($this->table)->row();
    }

    /**
     * Komposisi pengeluaran per kategori untuk grafik donat pengguna
     */
    public function get_expense_by_category($user_id, $month = null, $year = null) {
        $this->db->select('category, SUM(amount) as total');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', 'expense');
        if ($month) {
            $this->db->where('MONTH(transaction_date)', (int)$month);
        }
        if ($year) {
            $this->db->where('YEAR(transaction_date)', (int)$year);
        }
        $this->db->group_by('category');
        $this->db->order_by('total', 'DESC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Kategori paling sering digunakan / terbesar di seluruh platform (Admin Intelligence)
     */
    public function get_platform_top_categories($type = 'expense', $limit = 6) {
        $this->db->select('category, SUM(amount) as total, COUNT(id) as count');
        $this->db->where('type', $type);
        $this->db->group_by('category');
        $this->db->order_by('total', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }
}


