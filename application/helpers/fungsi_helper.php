<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function _auth($value='') {
	$CI =& get_instance();
	return $CI->juragan->auth_list(data_session('id'));
}

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

function _warna($str = 'warna') {
	$code = dechex(crc32($str));
	$code = substr($code, 0, 6);
	// echo '<span style="color:#'.$code.'">#'.$code.'</span>';
	return '#'.$code;
}

function _nama_juragan($juragan_id) {
	$CI =& get_instance();
	return $CI->juragan->_ambil_nama_juragan_dari_id($juragan_id);
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