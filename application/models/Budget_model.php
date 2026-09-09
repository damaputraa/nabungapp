<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table = 'category_budgets';
    }
    
    /**
     * Mengambil daftar anggaran per kategori user untuk bulan berjalan
     * serta menghitung total pengeluaran riil kategori tersebut
     */
    public function get_user_budgets_with_spending($user_id, $month = null, $year = null) {
        $month = $month ?: date('m');
        $year = $year ?: date('Y');
        
        $this->db->where('user_id', $user_id);
        $this->db->order_by('monthly_limit', 'DESC');
        $budgets = $this->db->get($this->table)->result();
        
        $result = [];
        foreach ($budgets as $b) {
            // Hitung pengeluaran aktual kategori ini di bulan yang bersangkutan
            $this->db->select_sum('amount', 'spent');
            $this->db->where('user_id', $user_id);
            $this->db->where('type', 'expense');
            $this->db->where('category', $b->category);
            $this->db->where('MONTH(transaction_date)', (int)$month);
            $this->db->where('YEAR(transaction_date)', (int)$year);
            $row = $this->db->get('transactions')->row();
            
            $spent = (float) ($row->spent ?? 0);
            $limit = (float) $b->monthly_limit;
            $percentage = $limit > 0 ? round(($spent / $limit) * 100, 1) : 0;
            $remaining = $limit - $spent;
            
            // Status status: 'safe' (<70%), 'warning' (70-99.9%), 'danger' (>=100%)
            $status = 'safe';
            if ($percentage >= 100) {
                $status = 'danger'; // Overbudget!
            } elseif ($percentage >= 70) {
                $status = 'warning'; // Waspada mendekati batas
            }
            
            $result[] = (object) [
                'id' => $b->id,
                'category' => $b->category,
                'monthly_limit' => $limit,
                'spent' => $spent,
                'remaining' => $remaining,
                'percentage' => $percentage,
                'status' => $status,
                'is_overbudget' => ($spent > $limit)
            ];
        }
        
        return $result;
    }
    
    /**
     * Memeriksa apakah ada kategori yang overbudget untuk notifikasi alert
     */
    public function check_overbudgets($user_id, $month = null, $year = null) {
        $budgets = $this->get_user_budgets_with_spending($user_id, $month, $year);
        $overbudgets = [];
        foreach ($budgets as $b) {
            if ($b->is_overbudget) {
                $overbudgets[] = $b;
            }
        }
        return $overbudgets;
    }
    
    /**
     * Simpan atau update anggaran kategori
     */
    public function set_budget($user_id, $category, $monthly_limit) {
        $category = trim($category);
        $monthly_limit = (float) $monthly_limit;
        
        $existing = $this->db->get_where($this->table, [
            'user_id' => $user_id,
            'category' => $category
        ])->row();
        
        if ($existing) {
            $this->db->where('id', $existing->id);
            return $this->db->update($this->table, [
                'monthly_limit' => $monthly_limit
            ]);
        } else {
            return $this->db->insert($this->table, [
                'user_id' => $user_id,
                'category' => $category,
                'monthly_limit' => $monthly_limit
            ]);
        }
    }
}