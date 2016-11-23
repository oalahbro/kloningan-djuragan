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