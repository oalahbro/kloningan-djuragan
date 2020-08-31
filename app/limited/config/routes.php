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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
$route['default_controller'] = 'login';

$route['admin'] = 'admin/pesanan/read';
$route['administrator'] = 'admin/pesanan/read';

$route['juragan'] = 'juragan/pesanan/pilih_juragan';
$route['juragan/pesanan'] = 'juragan/pesanan/daftar';
$route['user'] = 'juragan/pesanan';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
=======
$route['default_controller'] = 'authentic/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['masuk'] = 'authentic/login';
$route['lupa'] = 'authentic/forgot';
$route['set/(:any)'] = 'authentic/reset-password/$1';
$route['daftar'] = 'authentic/register';
$route['keluar'] = 'authentic/logout';

$route['admin'] = 'admin/pesanan/lihat';
$route['admin/pesanan'] = 'admin/pesanan/lihat';
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
=======
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
$route['default_controller'] = 'dasbor';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['download'] = 'download';
$route['unduh_pdf/(:any)'] = 'download/pdf';

$route['upgrade'] = 'upgrade';
$route['upgrade/(:any)'] = 'upgrade/$1';

//$route['login'] = 'auth/masuk';
$route['logout'] = 'keluar';
$route['valid'] = 'auth/valid';
//$route['forgot'] = 'auth/lupa';
//$route['register'] = 'auth/daftar';
$route['excel'] = 'excel';

$route['session'] = 'dasbor/log';
<<<<<<< HEAD
>>>>>>> b746267e0988f2a31635814dda93c719d8ac9053
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
