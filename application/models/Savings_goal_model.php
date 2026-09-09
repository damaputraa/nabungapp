<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savings_goal_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table = 'savings_goals';
    }
    
    public function get_by_user($user_id, $status = null) {
        $this->db->where('user_id', $user_id);
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by('status', 'ASC');
        $this->db->order_by('deadline', 'ASC');
        $this->db->order_by('id', 'DESC');
        $goals = $this->db->get($this->table)->result();
        
        foreach ($goals as $goal) {
            $goal->percentage = $goal->target_amount > 0 ? min(round(($goal->current_amount / $goal->target_amount) * 100, 1), 100) : 0;
            $goal->remaining_amount = max(0, $goal->target_amount - $goal->current_amount);
            
            if ($goal->deadline) {
                $today = new DateTime();
                $deadline = new DateTime($goal->deadline);
                $diff = $today->diff($deadline);
                $goal->days_left = $deadline >= $today ? $diff->days : -$diff->days;
            } else {
                $goal->days_left = null;
            }
        }
        
        return $goals;
    }
    
    public function get_goal($id, $user_id) {
        $goal = $this->db->get_where($this->table, ['id' => $id, 'user_id' => $user_id])->row();
        if ($goal) {
            $goal->percentage = $goal->target_amount > 0 ? min(round(($goal->current_amount / $goal->target_amount) * 100, 1), 100) : 0;
            $goal->remaining_amount = max(0, $goal->target_amount - $goal->current_amount);
            if ($goal->deadline) {
                $today = new DateTime();
                $deadline = new DateTime($goal->deadline);
                $diff = $today->diff($deadline);
                $goal->days_left = $deadline >= $today ? $diff->days : -$diff->days;
            } else {
                $goal->days_left = null;
            }
        }
        return $goal;
    }
    
    public function add_deposit_to_goal($goal_id, $user_id, $amount, $date, $description = '') {
        $amount = (float) $amount;
        if ($amount <= 0) return false;
        
        $goal = $this->get_goal($goal_id, $user_id);
        if (!$goal) return false;
        
        // 1. Simpan ke tabel savings
        $savings_data = [
            'user_id' => $user_id,
            'goal_id' => $goal_id,
            'amount' => $amount,
            'deposit_date' => $date,
            'description' => $description ?: 'Setoran ke Kantong: ' . $goal->title
        ];
        $this->db->insert('savings', $savings_data);
        
        // 2. Update saldo kantong impian
        $new_current = $goal->current_amount + $amount;
        $status = ($new_current >= $goal->target_amount) ? 'completed' : 'active';
        
        $this->db->where('id', $goal_id);
        $this->db->where('user_id', $user_id);
        return $this->db->update($this->table, [
            'current_amount' => $new_current,
            'status' => $status
        ]);
    }
    
    public function get_deposits_by_goal($goal_id, $user_id) {
        $this->db->where('goal_id', $goal_id);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('deposit_date', 'DESC');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('savings')->result();
    }
    
    public function get_summary_user($user_id) {
        $this->db->select_sum('target_amount', 'total_target');
        $this->db->select_sum('current_amount', 'total_collected');
        $this->db->where('user_id', $user_id);
        $res = $this->db->get($this->table)->row();
        
        $total_target = (float) ($res->total_target ?? 0);
        $total_collected = (float) ($res->total_collected ?? 0);
        $total_goals = $this->db->where('user_id', $user_id)->count_all_results($this->table);
        $completed_goals = $this->db->where(['user_id' => $user_id, 'status' => 'completed'])->count_all_results($this->table);
        
        return (object) [
            'total_target' => $total_target,
            'total_collected' => $total_collected,
            'total_goals' => $total_goals,
            'completed_goals' => $completed_goals,
            'percentage' => $total_target > 0 ? min(round(($total_collected / $total_target) * 100, 1), 100) : 0
        ];
    }
}