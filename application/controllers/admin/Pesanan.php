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

	public function lihat($juragan = 'semua', $status = 'semua', $halaman = 0) {

		$nama_juragan = $this->juragan->ambil_nama($juragan);
		$warna = $this->juragan->ambil_warna($juragan);

		if($status === 'semua') {
			$title_navbar = 'Semua Pesanan';
			$lead = 'Semua pesanan yang terkirim, pending dan belum transfer dari ' . $nama_juragan . ', kecuali data Draft.';
		}
		elseif ($status === 'pending') {
			$title_navbar = 'Pesanan Pending';
			$lead = 'Pesanan yang belum diproses pengirimannya dari ' . $nama_juragan . '.';
		}
		elseif ($status === 'terkirim') {
			$title_navbar = 'Pesanan Terkirim';
			$lead = 'Semua data pesanan terkirim ' . $nama_juragan . '.';
		}
		elseif ($status === 'draft') {
			$title_navbar = 'Data Sementara';
			$lead = 'Ini adalah data sementara dari ' . $nama_juragan . ', baiknya jangan disentuh dahulu.';
		}


		$config['base_url'] = site_url('admin/pesanan/lihat/' . $juragan . '/' . $status ); //'http://example.com/index.php/test/page/';
		$config['total_rows'] = $this->pesanan->ambil($juragan, $status, NULL, $cari="")->num_rows();
		$config['per_page'] = 30;
		$config['attributes'] = array('class' => 'page-link', 'data-pjax' => '');

		$this->pagination->initialize($config);





		$data = array(
			'title' => $title_navbar . ' | ' . $nama_juragan,
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
