<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
<<<<<<< HEAD
// ambil data auth dari juragan yang diijinkan
function _auth($value='') {
	$CI =& get_instance();
	return $CI->juragan->auth_list(data_session('id'));
}

// rubah warna ke RGB
function _HTMLToRGB($htmlCode) {
	if($htmlCode[0] == '#')
		$htmlCode = substr($htmlCode, 1);

	if (strlen($htmlCode) == 3) {
		$htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
	}

	$r = hexdec($htmlCode[0] . $htmlCode[1]);
	$g = hexdec($htmlCode[2] . $htmlCode[3]);
	$b = hexdec($htmlCode[4] . $htmlCode[5]);

	return $b + ($g << 0x8) + ($r << 0x10);
}

// rubah RGB ke HSL
function _RGBToHSL($RGB) {
	$r = 0xFF & ($RGB >> 0x10);
	$g = 0xFF & ($RGB >> 0x8);
	$b = 0xFF & $RGB;

	$r = ((float)$r) / 255.0;
	$g = ((float)$g) / 255.0;
	$b = ((float)$b) / 255.0;

	$maxC = max($r, $g, $b);
	$minC = min($r, $g, $b);

	$l = ($maxC + $minC) / 2.0;

	if($maxC == $minC) {
		$s = 0;
		$h = 0;
	}
	else {
		if($l < .5) {
			$s = ($maxC - $minC) / ($maxC + $minC);
		}
		else {
			$s = ($maxC - $minC) / (2.0 - $maxC - $minC);
		}
		if($r == $maxC)
			$h = ($g - $b) / ($maxC - $minC);
		if($g == $maxC)
			$h = 2.0 + ($b - $r) / ($maxC - $minC);
		if($b == $maxC)
			$h = 4.0 + ($r - $g) / ($maxC - $minC);

		$h = $h / 6.0; 
	}

	$h = (int)round(255.0 * $h);
	$s = (int)round(255.0 * $s);
	$l = (int)round(255.0 * $l);

	return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
}

// rubah string ke kode warna
function _warna($str = 'warna') {
	$code = dechex(crc32($str));
	$code = substr($code, 0, 6);

	return '#'.$code;
}

// ambil nama juragan berdasarkan id
function _nama_juragan($juragan_id) {
	$CI =& get_instance();
	return $CI->juragan->_ambil_nama_juragan_dari_id($juragan_id);
}

// ambil isi session login
function data_session($field) {
	$TO =& get_instance();
	$sesi = $TO->session->userdata('logged_in');
	$data = $sesi[$field];
	return $data;
}

// cek sudah login atau belum
function _is_login() {
	$login = data_session('login');
	if($login) {
		return TRUE;
	}
}

// default $level = 'superadmin'
function _is_user_level($level = 'superadmin') {
	if(data_session('level') === $level) {
=======
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
if( ! function_exists('save_url_encode')) {
	function save_url_encode($input) {
		$TO =& get_instance();
        // return strtr($TO->encryption->encrypt($input), '+/=', '-_,');
        return strtr($TO->encryption->encrypt($input), '+/=', '._-');
	}
}

if( ! function_exists('save_url_decode')) {
	function save_url_decode($input) {
		$TO =& get_instance();
        // return $TO->encryption->decrypt(strtr($input, '-_,', '+/='));
        return $TO->encryption->decrypt(strtr($input, '._-', '+/='));
	}
}

if( ! function_exists('alert_info')) {
	function alert_info($alert) {
		if($alert === 1) {
			$msg = '<strong>Error!</strong> Akun belum aktif, silakan hubungi admin.';
		}
		elseif ($alert === 2) {
			$msg = '<strong>Error!</strong> Kamu dilarang masuk.';
		}
		elseif ($alert === 3) {
			$msg = '<strong>Error!</strong> Sandi salah!';
		}
		elseif ($alert === 4) {
			$msg = '<strong>Error!</strong> Akun tidak terdaftar';
		}
		elseif ($alert === 5) {
			$msg = '<strong>Info!</strong> Harap validasi email.';
		}
		elseif ($alert === 6) {
			$msg = '<strong>Info!</strong> Email sudah divalidasi, tunggu admin mengaktifkan akun mu ya.';
		}
		elseif ($alert === 7) {
			$msg = '<strong>Info!</strong> Helooo, akun mu sudah pernah divalidasi.';
		}
		elseif ($alert === 8) {
			$msg = '<strong>Error!</strong> Link validasi tidak dikenal.';
		}
		return $msg;
	}
}

if( ! function_exists('harga')) {
	function harga($data_harga) {
		$data_harga = str_replace(' ', '', (int) $data_harga);
		$format = "Rp " . number_format((int) $data_harga , 0 , '', '.' ) . ",-";

		return $format;
	}
}

if( ! function_exists('dropdown_juragan')) {
	function dropdown_juragan() {
		$TO =& get_instance();
		return $TO->juragan->_semua()->result();
	}
}

if( ! function_exists('cs_juragan')) {
	function cs_juragan($username) {
		$TO =& get_instance();

		
		return $TO->juragan->_semua()->result();
	}
}

function tanggal_default($akhir_mulai) {
	$TO =& get_instance();
	$default_tanggal_mulai = 26;
	$default_tanggal_akhir = 25;
	$setting = '1';

	$hari_ini   = mdate("%Y-%m-%d", now());
	$bulan_ini  = mdate("%Y-%m", now());
		$datestring = $hari_ini . ' first day of last month';
		$dt = date_create($datestring);
		$datestring2 = $hari_ini . ' first day of next month';
		$dt2 = date_create($datestring2);
	$bulan_kemarin  = $dt->format('Y-m');
	$bulan_besok    = $dt2->format('Y-m');
	
	$sekarang   = strtotime($hari_ini);
	$mulai_bulan_ini = strtotime($bulan_ini. '-' .$default_tanggal_mulai);
	$mulai_bulan_kemarin = strtotime($bulan_kemarin. '-' .$default_tanggal_mulai);

	$akhir_bulan_ini = strtotime($bulan_ini. '-' .$default_tanggal_akhir);
	$akhir_bulan_besok = strtotime($bulan_besok. '-' .$default_tanggal_akhir);
	if($setting === '1') {
		if($sekarang >= $mulai_bulan_ini) {
			$tanggal_mulai = $bulan_ini . '-' . $default_tanggal_mulai;
		}
		elseif($sekarang <= $mulai_bulan_ini) {
			$tanggal_mulai = $bulan_kemarin . '-' . $default_tanggal_mulai;
		}

		if($sekarang <= $akhir_bulan_ini) {
			$tanggal_akhir = $bulan_ini . '-' . $default_tanggal_akhir;
		}
		elseif($sekarang >= $akhir_bulan_ini) {
			$tanggal_akhir = $bulan_besok . '-' . $default_tanggal_akhir;
		}
	}
	else {
		$tanggal_mulai = mdate("%Y-%m-01", now());
		$tanggal_akhir = mdate("%Y-%m-%t", now());
	}
	if($akhir_mulai === 'mulai') {
		return $tanggal_mulai;
	}
	elseif($akhir_mulai === 'akhir') {
		return $tanggal_akhir;
	}
}

function satu_bulan_sebelumnya($tanggal) {
	$bulan_kemarin = date('Y-m-d', strtotime('-1 month', strtotime($tanggal)));
	return $bulan_kemarin;
}

function satu_bulan_selanjutnya($tanggal) {
	$bulan_depan = date('Y-m-d', strtotime('+1 month', strtotime($tanggal)));
	return $bulan_depan;
}


/**
 * ambil judul situs
 *
 * @return      string
 */
function judul($data = 'name') {
	$TO =& get_instance();
	$name 		= $TO->config->item('site_name');
	$version 	= $TO->config->item('site_version');

	if($data === 'full') {
		$judul	= $name . ' v' . $version;
	}
	elseif($data === 'version') {
		$judul	= $version;
	}
	else {
		$judul	= $name;
	}

	return $judul;
}




function punya_member($user_id) {
	$TO =& get_instance();

	$punya_member = $TO->juragan_model->setting_member($user_id);
	if($punya_member) {
<<<<<<< HEAD
>>>>>>> b746267e0988f2a31635814dda93c719d8ac9053
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
		return TRUE;
	}
}

<<<<<<< HEAD
<<<<<<< HEAD
function list_juragan() {
	$TO =& get_instance();
	$q = $TO->juragan->ambil();
	return $q;
}

function harga($data_harga) {
	$data_harga = str_replace(' ', '', $data_harga);
	$format = "Rp " . number_format($data_harga , 0 , '', '.' ) . ",-";

	return $format;
}

function tanggal_range($akhir_mulai) {
=======
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5

/**
 * data_session()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
function data_session($field)
{
	$TO =& get_instance();
	$session_data = $TO->session->userdata('logged_in');
	$data = $session_data[$field];
	return $data;
}

/**
 * tanggal()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
function tanggal($data_tanggal, $format = "d-M-y")
{
	$data = date($format, strtotime($data_tanggal));

	return $data;
}

/**
 * get_halaman()
 *
 * by mylastof@gmail.com 
 * --- checked 21/12/2014 ---
 */
function get_halaman($page)
{
	$array_pg = array('semua', 'pending', 'terkirim', 'tambah', 'tambah_member', 'juragan', 'tambah', 'edit', 'produk', 'status', 'stock');
	if( ! empty($page) && in_array($page, $array_pg))
	{
		$halaman = $page;
	}
	else
	{
		$halaman	= 'semua';
	}

	return $halaman;
}

/**
 * date_range()
 *
 * by mylastof@gmail.com 
 * --- checked 28/12/2014 ---
 */
function date_ranger($akhir_mulai)
{
<<<<<<< HEAD
>>>>>>> b746267e0988f2a31635814dda93c719d8ac9053
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
	$TO =& get_instance();
	$default_tanggal_mulai = $TO->config->item('config_tanggal_mulai');
	$default_tanggal_akhir = $TO->config->item('config_tanggal_selesai');
	$setting = $TO->config->item('config_tanggal_range');

	$hari_ini 	= mdate("%Y-%m-%d", now());
	$bulan_ini 	= mdate("%Y-%m", now());
		$datestring = $hari_ini . ' first day of last month';
		$dt = date_create($datestring);
		$datestring2 = $hari_ini . ' first day of next month';
		$dt2 = date_create($datestring2);
	$bulan_kemarin	= $dt->format('Y-m');
	$bulan_besok 	= $dt2->format('Y-m');
	
	$sekarang 	= strtotime($hari_ini);
	$mulai_bulan_ini = strtotime($bulan_ini. '-' .$default_tanggal_mulai);
	$mulai_bulan_kemarin = strtotime($bulan_kemarin. '-' .$default_tanggal_mulai);

	$akhir_bulan_ini = strtotime($bulan_ini. '-' .$default_tanggal_akhir);
	$akhir_bulan_besok = strtotime($bulan_besok. '-' .$default_tanggal_akhir);
	if($setting === '1')
	{
		if($sekarang >= $mulai_bulan_ini)
		{
			$tanggal_mulai = $bulan_ini . '-' . $default_tanggal_mulai;
		}
		elseif($sekarang <= $mulai_bulan_ini) 
		{
			$tanggal_mulai = $bulan_kemarin . '-' . $default_tanggal_mulai;
		}


		if($sekarang <= $akhir_bulan_ini)
		{
			$tanggal_akhir = $bulan_ini . '-' . $default_tanggal_akhir;
		}
		elseif($sekarang >= $akhir_bulan_ini) 
		{
			$tanggal_akhir = $bulan_besok . '-' . $default_tanggal_akhir;
		}
	}
	else
	{
		$tanggal_mulai = mdate("%Y-%m-01", now());
		$tanggal_akhir = mdate("%Y-%m-%t", now());
	}
	if($akhir_mulai === 'mulai')
	{
		return $tanggal_mulai;
	}
	elseif($akhir_mulai === 'akhir')
	{
		return $tanggal_akhir;
	}
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
}


function kurir()
{
	$TO =& get_instance();
	$q = $TO->kurir_model->show_all();

	return $q;
}

function get_product()
{
	$TO =& get_instance();
	$data = $TO->pesanan_model->get_product();

	foreach ($data as $row)
	{
	    $results[] = $row['kode'];
	}
	return $results;
}

function class_active($get, $value)
{
	if( $get === $value)
	{
		$data = 'class="active"';
	}
	else 
	{
		$data = '';
	}

	return $data;
}

function get_count($juragan, $table, $status)
{
	$TO =& get_instance();

	if($table === 'kirim')
	{
		if( ! empty($juragan))
		{
			$total = $TO->pesanan_model->count_order_kirim($juragan, $status);
		}
		else
		{
			$total = $TO->pesanan_model->count_order_kirim(NULL, $status);
		}
	}
	elseif($table === 'transfer')
	{
		if( ! empty($juragan))
		{
			$total = $TO->pesanan_model->count_order_transfer($juragan, $status);
		}
		else
		{
			$total = $TO->pesanan_model->count_order_transfer(NULL, $status);
		}
	}

	return $total;
<<<<<<< HEAD
>>>>>>> b746267e0988f2a31635814dda93c719d8ac9053
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
}