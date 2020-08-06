<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function punya_member($user_id) {
	$TO =& get_instance();

	$punya_member = $TO->juragan_model->setting_member($user_id);
	if($punya_member) {
		return TRUE;
	}
}

/**
 * title()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
function title($data)
{
	$TO =& get_instance();
	$name 		= $TO->config->item('site_name');
	$version 	= $TO->config->item('site_version');

	if(empty($data))
	{
		$title		= $name;
	}

	if($data === 'namever')
	{
		$title		= $name . ' v' . $version;
	}
	elseif($data === 'name')
	{
		$title		= $name;
	}
	elseif($data === 'ver')
	{
		$title		= $version;
	}

	return $title;
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
 * is_login()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
function is_login()
{
	$TO =& get_instance();
	$session_data = $TO->session->userdata('logged_in');
	$login = $session_data['login'];
	if($login)
	{
		return TRUE;
	}
}

/**
 * is_user()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
function is_user($level)
{
	$TO =& get_instance();
	$log = $TO->session->userdata('logged_in');
	
	if($log['level'] === $level)
	{
		return TRUE;
	}
}

/**
 * input_get()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
function input_get($param)
{
	$TO =& get_instance();
	$data = $TO->input->get($param, TRUE);

	return $data;
}

/**
 * input_post()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
function input_post($param)
{
	$TO =& get_instance();
	$data = $TO->input->post($param, TRUE);

	return $data;
}

/**
 * harga()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
function harga($data_harga)
{
	$data_harga = str_replace(' ', '', $data_harga);
	$format = "Rp " . number_format($data_harga , 0 , '', '.' ) . ",-";

	return $format;
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
 * show_header()
 *
 * by mylastof@gmail.com 
 * --- checked 21/12/2014 ---
 */
function show_header($halaman, $juragan)
{
	$TO =& get_instance();
	if($halaman === 'semua') {
		$title = '<i class="glyphicon glyphicon-th-large"></i> ';
		$title .= ucwords('Semua Pesanan');
	}
	elseif($halaman === 'terkirim') {
		$title = '<i class="glyphicon glyphicon-ok"></i> ';
		$title .= ucwords('Pesanan terkirim');
	}
	elseif($halaman === 'pending') {
		$title = '<i class="glyphicon glyphicon-refresh"></i> ';
		$title .= ucwords('Pesanan pending');
	}
	elseif($halaman === 'tambah') {
		$title = '<i class="glyphicon glyphicon-pencil"></i> ';
		$title .= ucwords('tambah Pesanan');
	}
	elseif($halaman === 'tambah_member') {
		$title = '<i class="glyphicon glyphicon-pencil"></i> ';
		$title .= ucwords('tambah Pesanan member');
	}
	elseif($halaman === 'juragan') {
		$title = '<i class="glyphicon glyphicon-user"></i> ';
		$title .= ucwords('daftar juragan');
	}
	elseif($halaman === 'membership') {
		$title = '<i class="glyphicon glyphicon-briefcase"></i> ';
		$title .= ucwords('daftar membership');
	}
	elseif($halaman === 'produk') {
		$title = '<i class="glyphicon glyphicon-shopping-cart"></i> ';
		$title .= ucwords('daftar produk');
	}
	elseif($halaman === 'pengaturan') {
		$title = '<i class="glyphicon glyphicon-cog"></i> ';
		$title .= ucwords('Pengaturan');
	}
	elseif($halaman === 'edit') {
		$title = '<i class="glyphicon glyphicon-edit"></i> ';
		$title .= ucwords('edit Pesanan');
	}
	elseif($halaman === 'status') {
		$title = '<i class="glyphicon glyphicon-sort-by-order"></i> ';
		$title .= ucwords('status ');
	}
	elseif($halaman === 'stock') {
		$title = '<i class="glyphicon glyphicon-compressed"></i> ';
		$title .= ucwords('stock produk');
	}
	else {
		$title = '<i class="glyphicon glyphicon-warning-sign"></i> ';
		$title .= ucwords($halaman);
	}
	$nama_juragan = '';
	if($juragan > 0)
	{
		$nama_juragan = $TO->juragan_model->get_nama_juragan_by_id($juragan);
	}

	$header = $title . ' <small>' . $nama_juragan . '</small>';
	return $header;
}

/**
 * get_juragan()
 *
 * by mylastof@gmail.com 
 * --- checked 21/12/2014 ---
 */
function get_juragan($id)
{
	if( ! empty($id) && is_numeric($id))
	{
		$juragan_id = $id;
	}
	else
	{
		$juragan_id = 0;
	}

	return $juragan_id;
}

/**
 * date_range()
 *
 * by mylastof@gmail.com 
 * --- checked 28/12/2014 ---
 */
function date_range($akhir_mulai)
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


function dropdown_user()
{
	$TO =& get_instance();
	return $TO->juragan_model->dropdown_juragan();
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