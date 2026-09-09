<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge_model extends CI_Model {

    protected $table = 'savings_challenges';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $list = $this->db->get($this->table)->result();
        foreach ($list as $item) {
            $item->steps = json_decode($item->completed_steps ?: '[]', true);
            $item->completed_count = count($item->steps);
            $total_steps = ($item->challenge_type === '30_days') ? 30 : 52;
            $item->total_steps = $total_steps;
            $item->percentage = round(($item->completed_count / $total_steps) * 100);
        }
        return $list;
    }

    public function get_row($where) {
        $row = $this->db->get_where($this->table, $where)->row();
        if ($row) {
            $row->steps = json_decode($row->completed_steps ?: '[]', true);
            $row->completed_count = count($row->steps);
            $total_steps = ($row->challenge_type === '30_days') ? 30 : 52;
            $row->total_steps = $total_steps;
            $row->percentage = round(($row->completed_count / $total_steps) * 100);
        }
        return $row;
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

    public function toggle_step($challenge_id, $user_id, $step_number, $amount_per_step = 0) {
        $challenge = $this->get_row(['id' => $challenge_id, 'user_id' => $user_id]);
        if (!$challenge) return false;

        $steps = $challenge->steps ?: [];
        $step_number = (int) $step_number;

        if (in_array($step_number, $steps)) {
            // Uncheck
            $steps = array_values(array_diff($steps, [$step_number]));
            $new_amount = max(0, $challenge->current_amount - $amount_per_step);
        } else {
            // Check
            $steps[] = $step_number;
            sort($steps);
            $new_amount = $challenge->current_amount + $amount_per_step;
        }

        $total_steps = ($challenge->challenge_type === '30_days') ? 30 : 52;
        $status = (count($steps) >= $total_steps) ? 'completed' : 'active';

        $this->update(['id' => $challenge_id, 'user_id' => $user_id], [
            'completed_steps' => json_encode($steps),
            'current_amount' => $new_amount,
            'status' => $status
        ]);

        return [
            'status' => true,
            'completed_count' => count($steps),
            'total_steps' => $total_steps,
            'current_amount' => $new_amount,
            'is_completed' => ($status === 'completed')
        ];
    }
}