<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function _warna($str = 'warna') {
	$code = dechex(crc32($str));
	$code = substr($code, 0, 6);
	// echo '<span style="color:#'.$code.'">#'.$code.'</span>';
	return '#'.$code;
}

function data_session($field) {
	$TO =& get_instance();
	$sesi = $TO->session->userdata('logged_in');
	$data = $sesi[$field];
	return $data;
}

function is_login() {
	$login = data_session('login');
	if($login) {
		return TRUE;
	}
}

// default $level = 'superadmin'
function is_user_level($level = 'superadmin') {
	if(data_session('level') === $level) {
		return TRUE;
	}
}

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