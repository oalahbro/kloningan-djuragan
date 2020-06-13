<?php

if( ! function_exists('save_url_encode')) {
	function save_url_encode($input) {
        $encrypter = \Config\Services::encrypter();

		return strtr(base64_encode( $encrypter->encrypt($input) ), '+/=', '._-');
	}
}

if( ! function_exists('save_url_decode')) {
	function save_url_decode($input) {
		$encrypter = \Config\Services::encrypter();

		return $encrypter->decrypt(base64_decode( strtr($input, '._-', '+/=') ));
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
		return TRUE;
	}
}


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
}