<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

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

		

		$data = array(
			'title' => 'Lihat Stock',
			'title_navbar' => 'Stock Product',
			'lead' => '',
			'active' => 'stok',
			'nama_juragan' => 'Stock Product',
			'juragan' => '',
			'warna' => '#222'
			);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/stock', $data);
		$this->load->view('admin/footer', $data);
	
	}
}
