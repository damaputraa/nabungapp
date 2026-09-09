<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
    
    private $_CI;
    private $_page_title = 'Dashboard';
    private $_page_css = array();
    private $_page_js = array();
    private $_plugins = array();
    private $_show_header = true; // Untuk kontrol tampilan header
    
    public function __construct() {
        $this->_CI =& get_instance();
        $this->_CI->load->helper('url');
    }
    
    /**
     * Set page title
     */
    public function page_title($title) {
        $this->_page_title = $title;
        return $this;
    }
    
    /**
     * Add CSS file
     */
    public function page_css($css) {
        if (is_array($css)) {
            $this->_page_css = array_merge($this->_page_css, $css);
        } else {
            $this->_page_css[] = $css;
        }
        return $this;
    }
    
    /**
     * Add JS file
     */
    public function page_js($js) {
        if (is_array($js)) {
            $this->_page_js = array_merge($this->_page_js, $js);
        } else {
            $this->_page_js[] = $js;
        }
        return $this;
    }
    
    /**
     * Add plugin (chartjs, datatables, select2, sweetalert)
     */
    public function plugins($plugin) {
        if (is_array($plugin)) {
            $this->_plugins = array_merge($this->_plugins, $plugin);
        } else {
            $this->_plugins[] = $plugin;
        }
        return $this;
    }
    
    /**
     * Hide page header (content-header)
     */
    public function hide_header() {
        $this->_show_header = false;
        return $this;
    }
    
    /**
     * Show page header (content-header)
     */
    public function show_header() {
        $this->_show_header = true;
        return $this;
    }
    
    /**
     * Load template with content
     */
    public function load($view, $data = array()) {
        // Siapkan data untuk view
        $data['page_title'] = $this->_page_title;
        $data['page_css'] = $this->_page_css;
        $data['page_js'] = $this->_page_js;
        $data['plugins'] = $this->_plugins;
        
        // Load header
        $this->_CI->load->view('template/header', $data);
        
        // Load sidebar
        $this->_CI->load->view('template/sidebar', $data);
        
        // ========== CONTENT ==========
        // Tampilkan content-header jika diizinkan
        if ($this->_show_header) {
            echo '<section class="content-header">';
            echo '<div class="container-fluid">';
            echo '<div class="row mb-2">';
            echo '<div class="col-sm-6">';
            echo '<h1>' . $this->_page_title . '</h1>';
            echo '</div>';
            echo '<div class="col-sm-6">';
            echo '<ol class="breadcrumb float-sm-right">';
            echo '<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '">Home</a></li>';
            echo '<li class="breadcrumb-item active">' . $this->_page_title . '</li>';
            echo '</ol>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</section>';
        }
        
        // Konten utama
        echo '<section class="content">';
        echo '<div class="container-fluid">';
        $this->_CI->load->view($view, $data);
        echo '</div>'; // tutup container-fluid
        echo '</section>'; // tutup content
        
        // Load footer
        $this->_CI->load->view('template/footer', $data);
    }
}
