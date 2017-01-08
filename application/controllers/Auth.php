<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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

	// halaman masuk system
	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE) {
			$data = array(
				'title' => 'Login'
				);
			$this->load->view('v_masuk', $data);
		}
		else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$this->login->check($username, $password);
			redirect('');
		}
	}

	// halaman daftar user
	public function register() {
	}

	// halaman lupa sandi
	public function forgot() {
	}

	// halaman keluar system
	public function logout() {
	}
}
