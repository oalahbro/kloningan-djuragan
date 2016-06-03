<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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