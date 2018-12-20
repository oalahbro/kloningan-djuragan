<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Another extends admin_controller
{

	public function __construct() {
		parent::__construct();
	}

	public function chart() {
		$this->data = array(
			'judul' => 'Chart'
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('publik/chart', $this->data);
		$this->load->view('admin/footer', $this->data);
	}

	public function export() {
		$this->data = array(
			'judul' => 'Export Data'
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('publik/export', $this->data);
		$this->load->view('admin/footer', $this->data);
	}

}
