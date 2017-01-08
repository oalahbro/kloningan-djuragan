<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SESSION
 *
 */
function data_session($field) {
	$TO =& get_instance();
	$sesi = $TO->session->userdata('logged_in');
	$data = $sesi[$field];
	return $data;
}

/**
 * LOGIN
 *
 */
function is_login() {
	$login = data_session('login');
	if($login) {
		return TRUE;
	}
}

function _is_user_level($level = 'superadmin') {
	if(data_session('level') === $level) {
		return TRUE;
	}
}


/**
 * ADDITIONAL
 *
 */
function rupiah($angka) {
	$angka = str_replace(' ', '', $angka);
	$format = "Rp " . number_format($angka , 0 , '', '.' );

	return $format;
}

function tanggal($data_tanggal, $format = "d-M-y") {
	$data = date($format, strtotime($data_tanggal));

	return $data;
}

function warna($str = 'warna') {
	$code = dechex(crc32($str));
	$code = substr($code, 0, 6);

	return '#' . $code;
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