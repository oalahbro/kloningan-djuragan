<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends user_controller
{

	public function __construct() {
		parent::__construct();
		$user_slug = $this->session->username;
		$s = $this->pengguna->_juragan_terakhir($user_slug);
		$this->juragan_terakhir = $this->juragan->_slug($s);
	}

	public function index() {
		$jur = $this->input->get('juragan');

		if(!empty($jur)) {}

		$this->data = array(
			'judul' => 'Chart',
			'juragan_terakhir' => (!empty($jur) ? $jur: $this->juragan_terakhir)
			);

		$this->load->view('user/header', $this->data);
		$this->load->view('publik/chart', $this->data);
		$this->load->view('user/footer', $this->data);
	}

}
