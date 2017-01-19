<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentic extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	// halaman masuk system
	public function login() {
		if(is_login() === TRUE) {
			if((_is_user_level('admin') === TRUE) || (_is_user_level('superadmin') === TRUE)) {
				redirect('admin');
			}
			else {
				redirect('juragan');
			}
		}
		else {

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if($this->form_validation->run() === FALSE) {
				$data = array(
					'title' => 'Login'
					);
				$this->load->view('publik/i_header', $data);
				$this->load->view('publik/v_masuk', $data);
				$this->load->view('publik/i_footer', $data);
			}
			else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$this->login->check($username, $password);
				redirect('');
			}
		}
	}

	// halaman daftar user
	public function register() {
		if(is_login() === TRUE) {
			if((_is_user_level('admin') === TRUE) || (_is_user_level('superadmin') === TRUE)) {
				redirect('admin');
			}
			else {
				redirect('juragan');
			}
		}
		else {
			$this->form_validation->set_rules('nama', 'nama', 'required');
			$this->form_validation->set_rules('username', 'username', 'required|is_unique[pengguna.username]');
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[pengguna.email]|valid_email');
			$this->form_validation->set_rules('sandi1', 'sandi', 'required|matches[sandi2]');
			$this->form_validation->set_rules('sandi2', 'konfirmasi sandi', 'required');
			
			if($this->form_validation->run() === FALSE) {
				$data = array(
					'title' => 'Daftar'
					);
				$this->load->view('publik/i_header', $data);
				$this->load->view('publik/v_daftar', $data);
				$this->load->view('publik/i_footer', $data);
			}
			else {
				$username = $this->input->post('username');
				$password = $this->input->post('sandi1');
				$email = $this->input->post('email');
				$nama = $this->input->post('nama');
				
				$this->user->daftar($nama, $username, $password, $email);
				redirect('');
			}
		}
	}

	// halaman lupa sandi
	public function forgot() {
		if(is_login() === TRUE) {
			if((_is_user_level('admin') === TRUE) || (_is_user_level('superadmin') === TRUE)) {
				redirect('admin');
			}
			else {
				redirect('juragan');
			}
		}
		else {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if($this->form_validation->run() === FALSE) {
				$data = array(
					'title' => 'Login'
					);
				$this->load->view('publik/i_header', $data);
				$this->load->view('publik/v_lupa', $data);
				$this->load->view('publik/i_footer', $data);
			}
			else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$this->login->check($username, $password);
				redirect('');
			}
		}
	}

	// halaman set ulang sandi
	public function reset_password($uid) {
		if(is_login() === TRUE) {
			if((_is_user_level('admin') === TRUE) || (_is_user_level('superadmin') === TRUE)) {
				redirect('admin');
			}
			else {
				redirect('juragan');
			}
		}
		else {
		}
	}

	// halaman keluar system
	public function logout() {
		session_destroy();
		redirect('masuk','refresh');
	}
}
