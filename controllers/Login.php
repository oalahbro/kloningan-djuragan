<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	if(is_login() === TRUE) {
			if((is_user_level('admin') === TRUE) || (is_user_level('superadmin') === TRUE)) {
				redirect('admin');
			}
			else {
				redirect('juragan');
			}
		}
    }


	public function index() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE) {
			$this->data = array(
				'title' => 'Login'
				);
			$this->load->view('public/login', $this->data);
		}
		else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$login = $this->login->login($username, $password);

			if($login) {
				$sesi = array(
					'pesan'  => 'Hey, '.data_session('nama').' selamat bekerja yak :)',
					'pesan_tampil' => TRUE
				);
				$this->session->set_userdata($sesi);
			}
			else {
				$sesi = array(
					'pesan'  => 'Maaf, kamu gagal login.',
					'pesan_tampil' => TRUE
				);
				$this->session->set_userdata($sesi);
			}
			redirect('');
		}
	}
}