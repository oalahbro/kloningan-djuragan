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

		if($status === 'semua') {
			$title_navbar = 'Semua Pesanan';
		}
		elseif ($status === 'pending') {
			$title_navbar = 'Pesanan Pending';
		}
		elseif ($status === 'terkirim') {
			$title_navbar = 'Pesanan Terkirim';
		}
		elseif ($status === 'draft') {
			$title_navbar = 'Data Sementara';
		}

		$data = array(
			'title' => 'Pesanan',
			'title_navbar' => $title_navbar,
			'nama_juragan' => $this->juragan->ambil_nama($juragan),
			'juragan' => $juragan
			);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/pesanan/show', $data);
		$this->load->view('admin/footer', $data);
	}

	public function tulis($juragan = NULL) {

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
		$this->load->view('admin/pesanan/write', $data);
		$this->load->view('admin/footer', $data);
	
	}
}
