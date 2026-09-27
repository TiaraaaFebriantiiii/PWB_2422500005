<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator_model extends CI_Model {
    var $table = 'administrator';
    
    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get($this->table)->row_array();
    }
}