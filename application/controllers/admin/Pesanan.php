<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pesanan
 *
 * @package     application
 * @subpackage  controllers/admin
 * @since    	1.0.0
 * @version 	4.0.0
 * @author      Toto Prayogo
 * @link        http://totoprayogo.com
 */
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


		// setting pagination
		$config['base_url'] = site_url('admin/pesanan/lihat/' . $juragan . '/' . $status );
		$config['total_rows'] = $this->pesanan->ambil($juragan, $status, NULL, $cari="")->num_rows();
		$config['per_page'] = 30;
		$config['attributes'] = array('class' => 'page-link', 'data-pjax' => '');
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);


		$data = array(
			'title' => $title_navbar . ' | ' . $nama_juragan,
			'breadcrumb' => array(
				'admin' => 'Admin',
				'admin/pesanan' => 'Pesanan',
				'admin/pesanan/lihat/' . $juragan => $nama_juragan,
				'admin/pesanan/lihat/' . $juragan . '/' . $status => ucfirst($status)
				),
			'juragan' => $juragan,
			'status' => $status
			);

		$this->load->view('admin/i_header', $data);
		$this->load->view('admin/pesanan/show', $data);
		$this->load->view('admin/i_footer', $data);
	}

	public function tulis($juragan = NULL) {

		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('hp[]', 'hp', 'required|regex_match[/^\d{10,12}$/]');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('kode[]', 'kode', 'required');
		$this->form_validation->set_rules('size[]', 'size', 'required');
		$this->form_validation->set_rules('jumlah[]', 'jumlah', 'required');
		$this->form_validation->set_rules('bank', 'bank', 'required');
		$this->form_validation->set_rules('harga', 'harga', 'required');
		$this->form_validation->set_rules('ongkir', 'ongkir', 'required');
		$this->form_validation->set_rules('transfer', 'transfer', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', '');
		
		if($this->form_validation->run() === FALSE) {
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
		else {
			$nama = $this->input->post('nama');
			$hp = $this->input->post('hp[]');
			$alamat = $this->input->post('alamat');
			$kode = $this->input->post('kode[]');
			$size = $this->input->post('size[]');
			$jumlah = $this->input->post('jumlah[]');
			$bank = $this->input->post('bank');
			$harga = $this->input->post('harga');
			$ongkir = $this->input->post('ongkir');
			$transfer = $this->input->post('transfer');
			$keterangan = $this->input->post('keterangan');

			$pesanan['kode'] = $kode;
			$pesanan['jumlah'] = $jumlah;
			$pesanan['size'] = $size;

			print('<pre>');
			print_r(
				array(
					'nama' => $nama,
					'hp' => $hp,
					'alamat' => $alamat,
					'pesanan' => $pesanan,
					'bank' => $bank,
					'harga' => $harga,
					'ongkir' => $ongkir,
					'transfer' => $transfer,
					'keterangan' => $keterangan

				)
			);
			print('</pre>');
		}

		
	
	}
}
