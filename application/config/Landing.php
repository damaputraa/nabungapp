<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function index() {
        $data['title'] = 'Yuk Nabung - Kelola Keuangan & Tabungan';
        $this->load->view('landing/index', $data);
    }
}
