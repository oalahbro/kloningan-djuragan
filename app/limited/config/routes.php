<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'dasbor';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['download'] = 'download';
$route['upgrade'] = 'upgrade';
$route['upgrade/(:any)'] = 'upgrade/$1';

//$route['login'] = 'auth/masuk';
$route['logout'] = 'keluar';
$route['valid'] = 'auth/valid';
//$route['forgot'] = 'auth/lupa';
//$route['register'] = 'auth/daftar';
$route['excel'] = 'excel';

// bagian admin
$route['pesanan'] = 'admin/faktur/lihat';
$route['pesanan/(:any)'] = 'admin/faktur/lihat/$1';
$route['pesanan/sunting/(:any)'] = 'admin/faktur/sunting/$1';

$route['get/pembayaran'] = 'admin/faktur/ambil_pembayaran';
$route['post/pembayaran'] = 'admin/faktur/simpan_pembayaran';
$route['post/paket'] = 'admin/faktur/ubah_paket';

$route['del/pesanan'] = 'admin/faktur/hapus_pesanan';
$route['del/pembayaran'] = 'admin/faktur/hapus_pembayaran';

$route['add/pesanan'] = 'admin/faktur/tambah_pesanan';
$route['add/pembayaran'] = 'admin/faktur/tambah_pembayaran';
$route['add/pengiriman'] = 'admin/faktur/tambah_pengiriman';

$route['arsip'] = 'admin/pesanan';
$route['arsip/pesanan/(:any)/(:any)'] = 'admin/pesanan/lihat/$1/$2';

// bagian user
$route['myorder'] = 'cs/faktur';
$route['myorder/(:any)'] = 'cs/faktur/lihat/$1';

$route['myneworder'] = 'cs/faktur/tambah_pesanan';

$route['myget/pengiriman'] = 'cs/faktur/ambil_pengiriman';
$route['myget/pembayaran'] = 'cs/faktur/ambil_pembayaran';
$route['mypost/pembayaran'] = 'cs/faktur/simpan_pembayaran';

$route['kardusin/(:any)/(:any)'] = 'cs/pesanan/lihat/$1/$2';




$route['j_(:any)/tambah'] = 'cs/pesanan/tambah/$1';
$route['j_(:any)/sunting'] = 'cs/pesanan/sunting';
$route['j_(:any)/pesanan'] = 'cs/pesanan/lihat/$1';
$route['j_(:any)/pesanan/(:any)'] = 'cs/pesanan/lihat/$1/$2';
/*
$route['admin'] = 'admin/pesanan/lihat';
$route['admin/pesanan'] = 'admin/pesanan/lihat';
$route['admin/pesanan/sunting'] = 'admin/pesanan/sunting';
$route['admin/pesanan/tambah'] = 'admin/pesanan/tambah';
$route['admin/pesanan/hapus'] = 'admin/pesanan/hapus';
$route['admin/chart'] = 'admin/another/chart';
$route['admin/export'] = 'admin/another/export';

$route['pesanan'] = 'reseller/pesanan/lihat';
$route['pesanan/tambah'] = 'reseller/pesanan/tambah';
$route['pesanan/sunting'] = 'reseller/pesanan/sunting';
$route['pesanan/(:any)'] = 'reseller/pesanan/lihat/$1';

$route['(:any)/chart'] = 'cs/chart';
*/
