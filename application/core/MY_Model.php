<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
    protected $table;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all($limit = null, $offset = null) {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table)->result();
    }
    
    public function get_where($where) {
        return $this->db->get_where($this->table, $where)->result();
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
    
    public function count_all() {
        return $this->db->count_all($this->table);
    }
}
