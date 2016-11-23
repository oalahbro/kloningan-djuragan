<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {

	public function __construct() {
		parent::__construct();
    	if(is_login() === TRUE) {
			if((_is_user_level('admin') === TRUE) || (_is_user_level('superadmin') === TRUE)) {
				redirect('admin');
			}
			else {
				redirect('juragan');
			}
		}
	}

	// halaman utama, jika belum login
	public function index() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE) {
			$this->data = array(
				'title' => 'Login | ' // . $this->config->item('site_name')
				);
			$this->load->view('v_masuk');
		}
		else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$this->login->check($username, $password);
		}



		
	}
}
