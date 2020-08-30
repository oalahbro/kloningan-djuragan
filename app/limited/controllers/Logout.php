<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Logout
 *
 * Menghapus semua sesi aktif
 * 
 * @package 	Juragan
 * @version 	7.0
 * @author 	Toto Prayogo
 * @link 	http://totoprayogo.com
 */
class Logout extends CI_Controller {
	public function index() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();

		redirect('login');
	}
}