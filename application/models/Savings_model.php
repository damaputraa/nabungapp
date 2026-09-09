<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savings_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table = 'savings';
    }
    
    /**
     * Get all savings by user
     */
    public function get_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('deposit_date', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Get total savings by user for current month
     */
    public function get_total_by_user_month($user_id, $month, $year) {
        $this->db->select_sum('amount');
        $this->db->where('user_id', $user_id);
        $this->db->where('MONTH(deposit_date)', $month);
        $this->db->where('YEAR(deposit_date)', $year);
        $result = $this->db->get($this->table)->row();
        return $result->amount ?? 0;
    }
    
    /**
     * Get total savings by user (all time)
     */
    public function get_total_by_user($user_id) {
        $this->db->select_sum('amount');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get($this->table)->row();
        return $result->amount ?? 0;
    }
    
    /**
     * Get savings by user for specific month
     */
    public function get_by_user_month($user_id, $month, $year) {
        $this->db->where('user_id', $user_id);
        $this->db->where('MONTH(deposit_date)', $month);
        $this->db->where('YEAR(deposit_date)', $year);
        $this->db->order_by('deposit_date', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function get_total_platform() {
        $this->db->select_sum('amount');
        $result = $this->db->get($this->table)->row();
        return (float) ($result->amount ?? 0);
    }

    public function get_total_platform_month($month, $year) {
        $this->db->select_sum('amount');
        $this->db->where('MONTH(deposit_date)', (int)$month);
        $this->db->where('YEAR(deposit_date)', (int)$year);
        $result = $this->db->get($this->table)->row();
        return (float) ($result->amount ?? 0);
    }

    public function get_platform_trend_months($limit = 6) {
        $trend = [];
        $indonesian_months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        for ($i = $limit - 1; $i >= 0; $i--) {
            $date = new DateTime("first day of -$i month");
            $m = (int) $date->format('m');
            $y = (int) $date->format('Y');
            $label = ($indonesian_months[$m] ?? $date->format('M')) . ' ' . $y;
            $amount = $this->get_total_platform_month($m, $y);
            $trend[] = [
                'month' => $m,
                'year' => $y,
                'label' => $label,
                'total' => (float) $amount
            ];
        }
        return $trend;
    }
}

