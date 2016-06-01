<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->data = array(
			'title' => 'Login'
			);
		$this->load->view('public/login', $this->data);
	}
}