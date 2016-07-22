<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Status
 *
 * Halaman untuk menampilkan status, digunakan pada halaman admin maupun juragan
 * 
 * @package 	Juragan
 * @version 	7.0
 * @author 	Toto Prayogo
 * @link 	http://totoprayogo.com
 */
class Status extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	if(is_login() !== TRUE) {
			redirect('login');
		}
    }


	public function index() {
		$tanggal_mulai 		= $this->input->get('tanggal_mulai');
		$tanggal_akhir 		= $this->input->get('tanggal_akhir');

		if(empty($tanggal_mulai) || empty($tanggal_akhir)) {
			$tanggal_mulai = tanggal_range('mulai');
			$tanggal_akhir = tanggal_range('akhir');
		}


		$this->data = array(
			'title' => 'Status Order per Juragan',
			'tanggal_mulai' => $tanggal_mulai,
			'tanggal_akhir' => $tanggal_akhir,
			'total_pesanan' => $this->pesanan->total_pesanan($tanggal_mulai, $tanggal_akhir),
			'total_transfer' => $this->pesanan->total_transfer($tanggal_mulai, $tanggal_akhir),
			'total_terkirim' => $this->pesanan->total_terkirim($tanggal_mulai, $tanggal_akhir),
			'total_pending' => $this->pesanan->total_pending()
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/status', $this->data);
		$this->load->view('admin/footer-selain-pesanan', $this->data);
	}
}