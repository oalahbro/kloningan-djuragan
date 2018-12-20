<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends user_controller
{

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->data = array(
			'judul' => 'Chart'
			);

		$this->load->view('cs/header', $this->data);
		$this->load->view('publik/chart', $this->data);
		$this->load->view('cs/footer', $this->data);
	}

}
