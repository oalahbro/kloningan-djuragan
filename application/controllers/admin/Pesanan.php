<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

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

	public function lihat($juragan = 'semua', $status = 'semua') {
		$data = array(
			'title' => 'Pesanan'
			);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/pesanan/show', $data);
		$this->load->view('admin/footer', $data);
	}
}
