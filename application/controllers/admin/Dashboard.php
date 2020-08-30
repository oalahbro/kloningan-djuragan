<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			'title' => 'Dashboard | Pesanan Juragan',
			'breadcrumb' => array(
				'admin' => 'Admin',
				'admin/dashboard' => 'Dashboard'
				)
			);

		$this->load->view('admin/i_header', $data);
		$this->load->view('admin/v_dashboard', $data);
		$this->load->view('admin/i_footer', $data);
	}
}
