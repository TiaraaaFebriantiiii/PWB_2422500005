<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/

$route['default_controller'] = 'administrator/Admin_auth_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Route Login & Logout
$route['admin/login'] = 'administrator/Admin_auth_controller';
$route['admin/logout'] = 'administrator/Admin_auth_controller/logout';

// Route Dashboard
$route['admin'] = 'administrator/Admin_dashboard_controller';

// Route Kategori
$route['administrator/kategori'] = 'administrator/kategori_controller/index';
$route['administrator/kategori/tambah'] = 'administrator/kategori_controller/tambah_kategori';
$route['administrator/kategori/hapus/(:num)'] = 'administrator/kategori_controller/hapus_kategori/$1';
$route['administrator/kategori/ubah/(:num)'] = 'administrator/kategori_controller/ubah_kategori/$1';

// Route Produk
$route['administrator/produk'] = 'administrator/Produk_controller/index';
$route['administrator/produk/tambah'] = 'administrator/Produk_controller/tambah_produk';
$route['administrator/produk/ubah/(:num)'] = 'administrator/Produk_controller/ubah_produk/$1';
$route['administrator/produk/hapus/(:num)'] = 'administrator/Produk_controller/hapus_produk/$1';
$route['administrator/produk/hapus_gambar/(:num)/(:num)'] = 'administrator/Produk_controller/hapus_gambar/$1/$2';
$route['administrator/produk/edit_gambar'] = 'administrator/Produk_controller/edit_gambar';