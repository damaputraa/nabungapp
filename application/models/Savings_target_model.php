<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savings_target_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table = 'savings_targets';
    }
    
    public function get_by_user_month($user_id, $month, $year) {
        $month_year = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
        return $this->db->get_where($this->table, [
            'user_id' => $user_id,
            'month_year' => $month_year
        ])->row();
    }
    
    /**
     * Get all targets with user info for current month
     */
    public function get_all_with_users($month, $year) {
        $month_year = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
        
        $this->db->select('savings_targets.*, users.username, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = savings_targets.user_id');
        $this->db->where('savings_targets.month_year', $month_year);
        $this->db->order_by('users.username', 'ASC');
        return $this->db->get()->result();
    }
    
    /**
     * Get or create target for user
     */
    public function get_or_create($user_id, $month, $year) {
        $target = $this->get_by_user_month($user_id, $month, $year);
        
        if (!$target) {
            $month_year = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
            $data = [
                'user_id' => $user_id,
                'month_year' => $month_year,
                'target_amount' => 500000 // Default
            ];
            $this->insert($data);
            return $this->get_by_user_month($user_id, $month, $year);
        }
        
        return $target;
    }
}
