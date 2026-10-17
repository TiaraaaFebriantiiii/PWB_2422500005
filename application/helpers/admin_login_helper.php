<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function is_admin_logged_in() {
    $CI =& get_instance();
    
    if (!$CI->session->userdata('admin_login')) {
        redirect('admin/login');
    }
}