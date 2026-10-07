<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_gambar_model extends CI_Model
{
    private $_table = "produk_gambar";

    public function tambah($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function get_by_produk_id($id)
    {
        $this->db->where('produk_id', $id);
        return $this->db->get($this->_table)->result_array();
    }

    public function get_by_id($id)
    {
        $this->db->where('id_gambar', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function hapus($id)
    {
        $this->db->where('id_gambar', $id);
        return $this->db->delete($this->_table);
    }
}