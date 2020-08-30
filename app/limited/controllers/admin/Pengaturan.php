<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	public function __construct() {
		parent::__construct();
    	if(is_login() === TRUE) {
			if((_is_user_level('user') === TRUE)) {
				redirect('juragan');
			}
		}
		else {
			redirect('masuk');
		}
	}

	public function index() {
		show_404();
	}

	public function juragan($status = 'semua') {

		$data = array(
			'title' => 'Pengaturan User | Pesanan Juragan',
			'breadcrumb' => array(
				'admin' => 'Admin',
				'admin/pengaturan/juragan' => 'Pengaturan User',
				'admin/pengaturan/juragan/' . $status => ucfirst($status)
				)
			);

		$this->load->view('admin/i_header', $data);
		$this->load->view('admin/pengaturan/v_juragan', $data);
		$this->load->view('admin/i_footer', $data);
	}
}