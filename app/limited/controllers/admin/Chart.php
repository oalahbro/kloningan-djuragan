<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends admin_controller
{

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->data = array(
			'judul' => 'Chart'
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('publik/chart', $this->data);
		$this->load->view('admin/footer', $this->data);
	}

}
