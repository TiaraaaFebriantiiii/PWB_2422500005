<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth_controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Administrator_model');
        $this->load->library('form_validation');
    }

    public function index() {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('admin_login')) {
            redirect('admin');
        }
        
        $data['title'] = 'Tiara Pet Shop - Login';
        
        $this->form_validation->set_rules('inputUsername', 'Username', 'required|trim');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan halaman login
            $this->load->view('administrator/login', $data);
        } else {
            // Proses login
            $this->__login();
        }
    }

    private function __login() {
        $username = $this->input->post('inputUsername', TRUE);
        $password = md5($this->input->post('inputPassword', TRUE));
        
        $check = $this->Administrator_model->check_login($username, $password);

        if ($check) {
            $session_data = array(
                'id' => $check['id_admin'],
                'username' => $check['username'],
                'full_name' => $check['full_name'],
                'admin_login' => TRUE
            );
            $this->session->set_userdata($session_data);
            
            // Redirect ke dashboard (sesuai routes: $route['admin'] = 'administrator/Admin_dashboard_controller')
            redirect('admin');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username dan password salah!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Anda Berhasil Logout!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        
        redirect('admin/login');
    }
}