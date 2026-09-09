<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'users';
    }
    
    public function get_by_username($username) {
        return $this->db->get_where($this->table, ['username' => trim($username)])->row();
    }
    
    public function get_by_email($email) {
        return $this->db->get_where($this->table, ['email' => trim($email)])->row();
    }

    public function get_by_username_or_email($login) {
        $login = trim($login);
        return $this->db->group_start()
            ->where('username', $login)
            ->or_where('email', $login)
            ->group_end()
            ->get($this->table)
            ->row();
    }
    
    // ========== TAMBAHKAN METHOD INI ==========
    public function get_user_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    
    public function get_all_users() {
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->table)->result();
    }

    public function update_avatar($user_id, $avatar_path) {
        return $this->update($user_id, ['avatar' => $avatar_path]);
    }

    public function update_status($user_id, $status) {
        return $this->update($user_id, ['status' => $status]);
    }

    public function reset_password($user_id, $new_password) {
        return $this->update($user_id, [
            'password' => password_hash($new_password, PASSWORD_DEFAULT)
        ]);
    }
}
