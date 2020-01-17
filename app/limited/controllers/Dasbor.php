<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		if($this->session->logged) {
			redirect('a/faktur/lihat');
		}
		else {
			redirect('auth/masuk');
		}
	}

	public function log() {
		$response = array(
			'log' => (isset($_SESSION['logged'])? TRUE:FALSE),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
}
