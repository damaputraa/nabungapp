<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->helper(['url', 'cookie']);
    }
    
    public function login() {
        // Jika parameter ?switch=1 atau ?logout=1 dipanggil, bersihkan sesi saat ini
        if ($this->input->get('switch') == '1' || $this->input->get('logout') == '1') {
            $this->session->sess_destroy();
            if (session_status() === PHP_SESSION_ACTIVE) {
                $_SESSION = [];
            }
            delete_cookie('ci_session');
            redirect('auth/login');
            return;
        }

        // Jika metode GET dan user sudah login, arahkan ke dashboard
        if ($this->input->method() !== 'post' && $this->session->userdata('logged_in')) {
            redirect('dashboard');
            return;
        }
        
        $this->form_validation->set_rules('username', 'Username atau Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $identifier = trim($this->input->post('username'));
            $password = $this->input->post('password');
            
            // Cari user berdasarkan username ATAU email
            $user = $this->user_model->get_by_username_or_email($identifier);
            
            if ($user && password_verify($password, $user->password)) {
                // Bersihkan sesi lama secara total agar tidak terjadi kebocoran peran (role)
                $this->session->sess_destroy();
                if (session_status() === PHP_SESSION_ACTIVE) {
                    $_SESSION = [];
                }
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    @session_start();
                }
                @session_regenerate_id(true);

                $role = strtolower(trim((string)$user->role));
                
                // JIKA ROLE ADALAH ADMIN, TOLAK DI PORTAL PENGGUNA STANDAR
                if ($role === 'admin') {
                    $this->session->set_flashdata('error', 'Akun Anda terdaftar sebagai <strong>Administrator</strong>. Silakan masuk melalui <a href="' . site_url('admin/login') . '" class="text-decoration-underline fw-bold text-danger">Portal Administrator</a>.');
                    redirect('auth/login');
                    return;
                }

                // JIKA STATUS AKUN ADALAH SUSPENDED, TOLAK AKSES
                if (isset($user->status) && $user->status === 'suspended') {
                    $this->session->set_flashdata('error', 'Akun Anda telah dinonaktifkan sementara oleh Administrator. Silakan hubungi administrator.');
                    redirect('auth/login');
                    return;
                }

                $session_data = [
                    'logged_in' => TRUE,
                    'user_id' => (int) $user->id,
                    'username' => trim($user->username),
                    'role' => 'user',
                    'email' => trim($user->email),
                    'avatar' => $user->avatar ?? null
                ];
                $this->session->set_userdata($session_data);

                // Catat Log Aktivitas Login
                $this->load->model('activity_log_model');
                $this->activity_log_model->log('LOGIN_USER', "Pengguna {$user->username} berhasil masuk ke portal pengguna.", $user->id);

                // Arahkan ke dashboard
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username/email atau password salah!');
                redirect('auth/login');
            }
        }
    }
    
    public function register() {
        if ($this->input->method() !== 'post' && $this->session->userdata('logged_in')) {
            redirect('dashboard');
            return;
        }
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[30]|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'username' => trim($this->input->post('username')),
                'email' => trim($this->input->post('email')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => 'user'
            ];
            
            $user_id = $this->user_model->insert($data);
            
            // Inisialisasi target tabungan bulan berjalan untuk user baru
            $this->load->model('savings_target_model');
            $this->savings_target_model->get_or_create($user_id, date('m'), date('Y'));

            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');
            redirect('auth/login');
        }
    }

    public function logout() {
        $was_admin = ($this->session->userdata('role') === 'admin');
        $this->session->sess_destroy();
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
        }
        delete_cookie('ci_session');
        if ($was_admin) {
            redirect('admin/login');
        } else {
            $this->session->set_flashdata('success', 'Anda telah berhasil logout.');
            redirect('auth/login');
        }
    }
}
