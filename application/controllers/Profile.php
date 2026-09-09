<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library(['session', 'form_validation', 'template']);
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user_model->get_row(['id' => $user_id]);
        
        $this->template
            ->page_title('Profil & Password')
			->hide_header() //ini breadchumb diatas 
            ->load('profile/index', $data);
    }
    
    public function update_password() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_row(['id' => $user_id]);
        
        $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');
        
        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $user;
            $this->template
                ->page_title('Profil & Password')
                ->load('profile/index', $data);
        } else {
            $old_password = $this->input->post('old_password');
            
            if (!password_verify($old_password, $user->password)) {
                $this->session->set_flashdata('error', 'Password lama salah!');
                redirect('profile');
            }
            
            $new_password = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
            $this->user_model->update($user_id, ['password' => $new_password]);
            
            $this->load->model('activity_log_model');
            $this->activity_log_model->log('PASSWORD_CHANGE', "Pengguna {$user->username} memperbarui kata sandi akunnya.", $user_id);

            $this->session->set_flashdata('success', 'Password berhasil diubah!');
            redirect('profile');
        }
    }

    public function upload_avatar() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_model->get_row(['id' => $user_id]);

        $config['upload_path']   = './uploads/avatars/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'avatar_' . $user_id . '_' . time();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('avatar_file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
        } else {
            $upload_data = $this->upload->data();
            $file_path = 'uploads/avatars/' . $upload_data['file_name'];

            // Hapus file lama jika ada
            if (!empty($user->avatar) && file_exists(FCPATH . $user->avatar)) {
                @unlink(FCPATH . $user->avatar);
            }

            $this->user_model->update_avatar($user_id, $file_path);
            $this->session->set_userdata('avatar', $file_path);

            $this->load->model('activity_log_model');
            $this->activity_log_model->log('AVATAR_UPDATE', "Pengguna {$user->username} memperbarui foto profil.", $user_id);

            $this->session->set_flashdata('success', 'Foto profil berhasil diperbarui!');
        }

        redirect('profile');
    }
}
