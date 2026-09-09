<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['user_model', 'savings_target_model', 'transaction_model', 'savings_model', 'activity_log_model', 'announcement_model']);
        $this->load->library(['session', 'form_validation', 'template']);
        
        $method = $this->router->fetch_method();
        if ($method === 'login' || $method === 'logout') {
            return;
        }

        $role = strtolower(trim((string) $this->session->userdata('role')));
        if (!$this->session->userdata('logged_in') || $role !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak! Halaman ini hanya untuk Administrator.');
            redirect('admin/login');
        }
    }
    
    public function users() {
        $users = $this->user_model->get_all();
        
        // Lengkapi data ringkasan untuk tiap user
        foreach ($users as $user) {
            $user->total_savings = (float) $this->savings_model->get_total_by_user($user->id);
            $user->total_income = (float) $this->transaction_model->get_income_by_user($user->id);
            $user->total_expense = (float) $this->transaction_model->get_expense_by_user($user->id);
        }
        
        $data['users'] = $users;
        
        $this->template
            ->page_title('Kelola Pengguna')
            ->plugins(['datatables'])
            ->hide_header()
            ->load('admin/users', $data);
    }
    
    // ========== TAMBAH USER ==========
    public function add_user() {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[50]|is_unique[users.username]', [
            'is_unique' => 'Username ini sudah terdaftar. Silakan pilih username lain.'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
            'min_length' => 'Password minimal harus 6 karakter.'
        ]);
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,user]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->template
                ->page_title('Tambah Pengguna Baru')
                ->hide_header()
                ->load('admin/add_user');
        } else {
            $data = [
                'username' => trim($this->input->post('username')),
                'email' => trim($this->input->post('email')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            ];
            
            $user_id = $this->user_model->insert($data);
            
            // Inisialisasi target default untuk user baru
            $this->savings_target_model->get_or_create($user_id, date('m'), date('Y'));
            
            $this->session->set_flashdata('success', 'Pengguna ' . htmlspecialchars($data['username']) . ' berhasil ditambahkan!');
            redirect('admin/users');
        }
    }
    
    // ========== EDIT USER ==========
    public function edit_user($id) {
        $user = $this->user_model->get_row(['id' => $id]);
        
        if (!$user) {
            show_404();
        }
        
        $is_unique_username = ($this->input->post('username') != $user->username) ? '|is_unique[users.username]' : '';
        $is_unique_email = ($this->input->post('email') != $user->email) ? '|is_unique[users.email]' : '';
        
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[50]' . $is_unique_username);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email' . $is_unique_email);
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,user]');
        
        if (!empty($this->input->post('password'))) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        }
        
        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $user;
            $this->template
                ->page_title('Edit Pengguna: ' . $user->username)
                ->hide_header()
                ->load('admin/edit_user', $data);
        } else {
            $update_data = [
                'username' => trim($this->input->post('username')),
                'email' => trim($this->input->post('email')),
                'role' => $this->input->post('role')
            ];
            
            $password = $this->input->post('password');
            if (!empty($password)) {
                $update_data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            
            $this->user_model->update(['id' => $id], $update_data);
            $this->session->set_flashdata('success', 'Data pengguna ' . htmlspecialchars($update_data['username']) . ' berhasil diperbarui!');
            redirect('admin/users');
        }
    }
    
    // ========== HAPUS USER ==========
    public function delete_user($id) {
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
            redirect('admin/users');
        }
        
        $user = $this->user_model->get_row(['id' => $id]);
        if ($user) {
            // Hapus data berelasi agar database tetap bersih
            $this->savings_model->delete(['user_id' => $id]);
            $this->savings_target_model->delete(['user_id' => $id]);
            $this->transaction_model->delete(['user_id' => $id]);
            $this->user_model->delete(['id' => $id]);
            
            $this->session->set_flashdata('success', 'Pengguna ' . htmlspecialchars($user->username) . ' beserta seluruh riwayatnya berhasil dihapus.');
        }
        
        redirect('admin/users');
    }
    
    // ========== TARGET TABUNGAN ==========
    public function targets() {
        $month = $this->input->get('month') ? str_pad($this->input->get('month'), 2, '0', STR_PAD_LEFT) : date('m');
        $year = $this->input->get('year') ?? date('Y');
        
        $users = $this->user_model->get_all();
        
        foreach ($users as $user) {
            $user->target = $this->savings_target_model->get_or_create($user->id, $month, $year);
            // Realisasi tabungan bulan terpilih
            $user->total_deposit = (float) $this->savings_model->get_total_by_user_month($user->id, $month, $year);
            // Total tabungan keseluruhan
            $user->total_all = (float) $this->savings_model->get_total_by_user($user->id);
            // Saldo transaksi bulan terpilih
            $user->summary = $this->transaction_model->get_summary($user->id, $month, $year);
        }
        
        $data = [
            'users' => $users,
            'selected_month' => $month,
            'selected_year' => $year,
            'month_name' => date('F', mktime(0, 0, 0, (int)$month, 1))
        ];
        
        $this->template
            ->page_title('Target Tabungan Pengguna')
            ->plugins(['datatables'])
            ->hide_header()
            ->load('admin/targets', $data);
    }
    
    public function set_target() {
        if ($this->input->post('target_amount') !== null) {
            $_POST['target_amount'] = preg_replace('/[^0-9]/', '', (string) $this->input->post('target_amount'));
        }
        $this->form_validation->set_rules('user_id', 'Pengguna', 'required|numeric');
        $this->form_validation->set_rules('target_amount', 'Nominal Target', 'required|numeric|greater_than_equal_to[0]');
        
        $redirect_month = $this->input->post('month') ?? date('m');
        $redirect_year = $this->input->post('year') ?? date('Y');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal mengatur target. Pastikan nominal berupa angka valid.');
            redirect("admin/targets?month={$redirect_month}&year={$redirect_year}");
        } else {
            $user_id = $this->input->post('user_id');
            $month = str_pad($redirect_month, 2, '0', STR_PAD_LEFT);
            $year = $redirect_year;
            $month_year = $year . '-' . $month;
            
            $existing = $this->savings_target_model->get_by_user_month($user_id, $month, $year);
            
            $data = [
                'user_id' => $user_id,
                'month_year' => $month_year,
                'target_amount' => (float) $this->input->post('target_amount')
            ];
            
            if ($existing) {
                $this->savings_target_model->update(['id' => $existing->id], $data);
            } else {
                $this->savings_target_model->insert($data);
            }
            
            $this->session->set_flashdata('success', 'Target tabungan berhasil diperbarui!');
            redirect("admin/targets?month={$redirect_month}&year={$redirect_year}");
        }
    }

    public function login() {
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'admin') {
            redirect('dashboard');
            return;
        }

        $this->form_validation->set_rules('username', 'Username atau Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/login');
        } else {
            $identifier = trim($this->input->post('username'));
            $password = $this->input->post('password');

            $user = $this->user_model->get_by_username_or_email($identifier);

            if ($user && password_verify($password, $user->password)) {
                if (strtolower(trim($user->role)) !== 'admin') {
                    $this->session->set_flashdata('error', 'Akses Ditolak! Akun Anda terdaftar sebagai Pengguna Standar. Silakan masuk melalui Portal Pengguna.');
                    redirect('admin/login');
                    return;
                }

                if (isset($user->status) && $user->status === 'suspended') {
                    $this->session->set_flashdata('error', 'Akun Administrator ini dinonaktifkan.');
                    redirect('admin/login');
                    return;
                }

                // Bersihkan sesi lama secara total
                $this->session->sess_destroy();
                if (session_status() === PHP_SESSION_ACTIVE) {
                    $_SESSION = [];
                }
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    @session_start();
                }
                @session_regenerate_id(true);

                $session_data = [
                    'logged_in' => TRUE,
                    'user_id' => (int) $user->id,
                    'username' => trim($user->username),
                    'role' => 'admin',
                    'email' => trim($user->email),
                    'avatar' => $user->avatar ?? null
                ];
                $this->session->set_userdata($session_data);

                // Catat Log Login Admin
                $this->activity_log_model->log('LOGIN_ADMIN', "Administrator {$user->username} masuk ke sistem panel admin.", $user->id);

                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Kredensial administrator tidak cocok!');
                redirect('admin/login');
            }
        }
    }

    public function logout() {
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        if ($user_id) {
            $this->activity_log_model->log('LOGOUT_ADMIN', "Administrator {$username} keluar dari sistem.", $user_id);
        }

        $this->session->sess_destroy();
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
        }
        $this->load->helper('cookie');
        delete_cookie('ci_session');
        $this->session->set_flashdata('success', 'Anda telah keluar dari Portal Administrator.');
        redirect('admin/login');
    }

    // ========== TOGGLE STATUS USER (AKTIF / SUSPENDED) ==========
    public function toggle_user_status($id) {
        $id = (int) $id;
        $current_user_id = (int) $this->session->userdata('user_id');
        
        if ($id === $current_user_id) {
            $this->session->set_flashdata('error', 'Anda tidak dapat menonaktifkan akun administrator Anda sendiri!');
            redirect('admin/users');
            return;
        }

        $target_user = $this->user_model->get_user_by_id($id);
        if (!$target_user) {
            $this->session->set_flashdata('error', 'Pengguna tidak ditemukan!');
            redirect('admin/users');
            return;
        }

        $new_status = ($target_user->status === 'suspended') ? 'active' : 'suspended';
        $this->user_model->update_status($id, $new_status);

        $status_label = ($new_status === 'active') ? 'diaktifkan kembali' : 'dinonaktifkan (suspended)';
        $this->activity_log_model->log('USER_STATUS_CHANGE', "Status akun pengguna '{$target_user->username}' diubah menjadi {$new_status} oleh admin.");
        
        $this->session->set_flashdata('success', "Akun pengguna <strong>{$target_user->username}</strong> berhasil {$status_label}.");
        redirect('admin/users');
    }

    // ========== RESET PASSWORD USER (DEFAULT: 123456) ==========
    public function reset_user_password($id) {
        $id = (int) $id;
        $target_user = $this->user_model->get_user_by_id($id);
        if (!$target_user) {
            $this->session->set_flashdata('error', 'Pengguna tidak ditemukan!');
            redirect('admin/users');
            return;
        }

        $default_pwd = 'password123';
        $this->user_model->reset_password($id, $default_pwd);

        $this->activity_log_model->log('USER_PASSWORD_RESET', "Kata sandi pengguna '{$target_user->username}' direset oleh admin.");
        
        $this->session->set_flashdata('success', "Kata sandi akun <strong>{$target_user->username}</strong> berhasil direset ke: <code>{$default_pwd}</code>. Harap beri tahu pengguna untuk segera mengganti kata sandi setelah masuk.");
        redirect('admin/users');
    }

    // ========== LOG AKTIVITAS SISTEM (AUDIT TRAIL) ==========
    public function logs() {
        $data['logs'] = $this->activity_log_model->get_all(300);
        
        $this->template
            ->page_title('Log Aktivitas Sistem (Audit Trail)')
            ->plugins(['datatables'])
            ->hide_header()
            ->load('admin/logs', $data);
    }

    // ========== PUSAT PENGUMUMAN (BROADCAST) ==========
    public function announcements() {
        $data['announcements'] = $this->announcement_model->get_all();

        $this->template
            ->page_title('Pusat Pengumuman & Broadcast')
            ->plugins(['datatables'])
            ->hide_header()
            ->load('admin/announcements', $data);
    }

    public function add_announcement() {
        $this->form_validation->set_rules('title', 'Judul Pengumuman', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('message', 'Isi Pengumuman', 'trim|required');
        $this->form_validation->set_rules('type', 'Tipe Pengumuman', 'required|in_list[info,warning,success,danger]');

        if ($this->form_validation->run() === TRUE) {
            $data = [
                'title' => $this->input->post('title'),
                'message' => $this->input->post('message'),
                'type' => $this->input->post('type'),
                'is_active' => 1,
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->announcement_model->insert($data);
            $this->activity_log_model->log('ADD_ANNOUNCEMENT', "Pengumuman baru dibuat: '{$data['title']}'");
            
            $this->session->set_flashdata('success', 'Pengumuman broadcast baru berhasil diterbitkan!');
        } else {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
        }

        redirect('admin/announcements');
    }

    public function toggle_announcement($id) {
        $id = (int) $id;
        $this->announcement_model->toggle_active($id);
        $this->session->set_flashdata('success', 'Status pengumuman berhasil diperbarui.');
        redirect('admin/announcements');
    }

    public function delete_announcement($id) {
        $id = (int) $id;
        $this->announcement_model->delete($id);
        $this->session->set_flashdata('success', 'Pengumuman berhasil dihapus.');
        redirect('admin/announcements');
    }

    public function backup_db() {
        $this->load->dbutil();
        $this->load->helper('download');

        $prefs = [
            'format' => 'txt',
            'filename' => 'backup_keuangan_' . date('Y-m-d_H-i-s') . '.sql',
            'add_drop' => TRUE,
            'add_insert' => TRUE,
            'newline' => "\n"
        ];

        $backup = $this->dbutil->backup($prefs);
        $file_name = 'backup_keuangan_dams_' . date('Y-m-d_His') . '.sql';

        $this->activity_log_model->log('DATABASE_BACKUP', 'Mengunduh backup database (' . $file_name . ')');

        force_download($file_name, $backup);
    }
}

