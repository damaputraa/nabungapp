<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function check_savings_progress($user_id, $total_deposit, $target) {
        $percentage = $target > 0 ? ($total_deposit / $target) * 100 : 0;
        
        if ($percentage >= 100) {
            return [
                'type' => 'success',
                'message' => '🎉 Selamat! Target tabungan bulan ini sudah tercapai!'
            ];
        } elseif ($percentage >= 75) {
            return [
                'type' => 'info',
                'message' => '💪 Semangat! Progress tabungan sudah ' . round($percentage) . '%. Tinggal sedikit lagi!'
            ];
        } elseif ($percentage >= 50) {
            return [
                'type' => 'warning',
                'message' => '📈 Progress tabungan sudah ' . round($percentage) . '%. Pertahankan!'
            ];
        } else {
            return [
                'type' => 'secondary',
                'message' => '📊 Progress tabungan: ' . round($percentage) . '%. Ayo mulai menabung!'
            ];
        }
    }
}
