<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model'); // Sesuai nama file modul (huruf kecil)
    }

    public function index() {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_produk() {
        $data['title'] = 'Tambah Produk';
        $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
        $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');
        
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_produk();
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    private function __simpan_produk() {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'), // SESUAI MODUL (Ubah ke 'categori_id' jika DB Anda typo)
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        $id_produk = $this->produk_model->tambah($data);
        
        $count = count($_FILES['gambar_produk']['name']);
        if ($count > 0) {
            $this->__produk_gambar_upload($count, $id_produk);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">Berhasil menambahkan produk!!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        redirect('administrator/produk');
    }

    private function __produk_gambar_upload($count, $id_produk) {
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['gambar_produk']['name'][$i];
                $_FILES['file']['type'] = $_FILES['gambar_produk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['gambar_produk']['error'][$i];
                $_FILES['file']['size'] = $_FILES['gambar_produk']['size'][$i];

                $config['upload_path'] = './uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 5000;
                $config['file_name'] = 'produk_' . $id_produk . '_' . time() . '_' . $i;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $data = [
                        'nama_gambar' => $uploadData['file_name'],
                        'produk_id' => $id_produk
                    ];
                    $this->produk_gambar_model->tambah($data);
                }
            }
        }
    }

    public function ubah_produk($id) {
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
            $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');
            
            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_produk($id);
            } else {
                $data['title'] = 'Ubah produk';
                $data['produk'] = $produk;
                $data['list_kategori'] = $this->produk_kategori_model->get_all();
                $data['gambar_model'] = $this->produk_gambar_model; // Sesuai modul
                
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Produk tidak ditemukan!!</div>');
            redirect('administrator/produk');
        }
    }

    private function __ubah_produk($id) {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'), // SESUAI MODUL
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        $ubah = $this->produk_model->ubah($data, $id);

        $upload_berhasil = false;
        if (!empty($_FILES['gambar_produk']['name'][0])) {
            $count = count($_FILES['gambar_produk']['name']);
            if ($count > 0) {
                $this->__produk_gambar_upload($count, $id);
                $upload_berhasil = true;
            }
        }

        if ($ubah || $upload_berhasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">Berhasil mengubah produk!!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show">Tidak Ada Perubahan Data atau Gambar!</div>');
        }
        redirect('administrator/produk');
    }

    public function hapus_produk($id) {
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            $list_gambar = $this->produk_gambar_model->get_by_produk_id($id);
            foreach ($list_gambar as $gambar) {
                $path = './uploads/produk/' . $gambar['nama_gambar'];
                if (file_exists($path)) unlink($path);
                $this->produk_gambar_model->hapus($gambar['id_gambar']);
            }
            $this->produk_model->hapus($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil menghapus produk!!</div>');
            redirect('administrator/produk');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Produk tidak ditemukan!!</div>');
            redirect('administrator/produk');
        }
    }

    public function hapus_gambar($id_gambar) {
        $gambar = $this->produk_gambar_model->get_by_id($id_gambar);
        if ($gambar) {
            $produk_id = $gambar['produk_id'];
            $path = './uploads/produk/' . $gambar['nama_gambar'];
            if (file_exists($path)) unlink($path);
            
            $this->produk_gambar_model->hapus($id_gambar);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil menghapus gambar!!</div>');
            redirect('administrator/produk/ubah/' . $produk_id);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gambar tidak ditemukan!!</div>');
            redirect('administrator/produk');
        }
    }

    // ==========================================================
    // SOLUSI TUGAS MODUL: Menambahkan sintak agar gambar dapat 
    // diganti ketika diklik button ubah
    // ==========================================================
    public function edit_gambar() {
        header('Content-Type: application/json');
        
        $id_gambar = $this->input->post('id_gambar');
        $id_produk = $this->input->post('id_produk');
        
        if (empty($_FILES['edit_gambar']['name'])) {
            echo json_encode(['success' => false, 'message' => 'Tidak ada file yang dipilih']);
            exit;
        }
        
        $config['upload_path'] = './uploads/produk/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 5000;
        $config['file_name'] = 'produk_' . $id_produk . '_' . $id_gambar . '_' . time();
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('edit_gambar')) {
            $upload_data = $this->upload->data();
            $new_filename = $upload_data['file_name'];
            
            $gambar_lama = $this->produk_gambar_model->get_by_id($id_gambar);
            if ($gambar_lama) {
                $path_lama = './uploads/produk/' . $gambar_lama['nama_gambar'];
                if (file_exists($path_lama)) @unlink($path_lama);
                
                // Update database dengan nama file baru (Bagian inti tugas)
                $this->produk_gambar_model->update($id_gambar, ['nama_gambar' => $new_filename]);
                echo json_encode(['success' => true, 'message' => 'Gambar berhasil diubah']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Data gambar tidak ditemukan']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => $this->upload->display_errors('', '')]);
        }
        exit;
    }
}