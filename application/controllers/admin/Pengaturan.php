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

	public function juragan() {
		$nama_juragan = $this->juragan->ambil_nama($juragan);
		$warna = $this->juragan->ambil_warna($juragan);
		$title_navbar = 'Semua Pesanan';
		$lead = '';

		$data = array(
			'title' => 'Tulis data Pesanan | ' . $nama_juragan,
			'title_navbar' => $title_navbar,
			'lead' => $lead,
			'active' => 'tulis',
			'nama_juragan' => $nama_juragan,
			'juragan' => $juragan,
			'warna' => $warna
			);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/pengaturan/juragan', $data);
		$this->load->view('admin/footer', $data);
	}
}