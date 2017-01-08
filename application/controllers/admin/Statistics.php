<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends CI_Controller {

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
			'title' => 'Data Statistik | Pesanan Juragan',
			'title_navbar' => $title_navbar,
			'lead' => $lead,
			'active' => 'pesanan',
			'nama_juragan' => $nama_juragan,
			'juragan' => $juragan,
			'status' => $status,
			'warna' => $warna,
			'pesanan' => $this->pesanan->ambil($juragan, $status, $halaman, $cari="")
			);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/pesanan/show', $data);
		$this->load->view('admin/footer', $data);


	}

}