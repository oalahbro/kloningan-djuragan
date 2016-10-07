<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pesanan extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	if(is_login() !== TRUE) {
    		redirect('login'); // belum masuk ? dialihkan ke halaman `login`
    	}
    	else {
			if(is_user_level('user') !== TRUE) {
				redirect('admin'); // dialihkan ke halaman `juragan` jika bukan login sebagai `admin`
			}
		}
    }

    public function index() {
    	$this->data = array(
			'title' => 'Pilih Juragan',
			'active' => 'pesanan'
			);

		$this->load->view('juragan/header', $this->data);
		$this->load->view('juragan/dasbor', $this->data);
		$this->load->view('juragan/footer', $this->data);
    }
}