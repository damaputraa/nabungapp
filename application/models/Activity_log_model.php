<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Log an activity
     */
    public function log($action, $description, $user_id = null) {
        if ($user_id === null) {
            $user_id = $this->session->userdata('user_id') ?: null;
        }

        $data = [
            'user_id' => $user_id,
            'action' => substr($action, 0, 100),
            'description' => $description,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => substr($this->input->user_agent(), 0, 255),
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->insert('activity_logs', $data);
    }

    /**
     * Get recent logs with user info
     */
    public function get_all($limit = 100, $offset = 0) {
        $this->db->select('al.*, u.username, u.email, u.role');
        $this->db->from('activity_logs al');
        $this->db->join('users u', 'u.id = al.user_id', 'left');
        $this->db->order_by('al.created_at', 'DESC');
        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result();
    }

    /**
     * Count logs
     */
    public function count_all() {
        return $this->db->count_all('activity_logs');
    }
}