<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $this->db->select('a.*, u.username as creator_name');
        $this->db->from('announcements a');
        $this->db->join('users u', 'u.id = a.created_by', 'left');
        $this->db->order_by('a.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_active() {
        $this->db->where('is_active', 1);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('announcements')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('announcements', ['id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert('announcements', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('announcements', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('announcements');
    }

    public function toggle_active($id) {
        $item = $this->get_by_id($id);
        if ($item) {
            $new_status = $item->is_active ? 0 : 1;
            return $this->update($id, ['is_active' => $new_status]);
        }
        return false;
    }
}