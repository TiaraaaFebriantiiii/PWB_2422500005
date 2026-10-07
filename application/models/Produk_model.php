<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $_table = "produk";

    public function get_all()
    {
        $this->db->select('produk.*, kategori.nama as kt_nama');
        // PERHATIKAN: categori_id sesuai database Anda
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id'); 
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function ubah($data, $id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->update($this->_table, $data);
    }

    public function hapus($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->delete($this->_table);
    }
}