<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends admin_controller
{

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = array(
			'judul' => 'Pengaturan Web'
		);

		$this->load->view('administrator/header', $data);
		$this->load->view('administrator/pengaturan/web', $data);
		$this->load->view('administrator/footer', $data);
	}

	public function save_kurir() {
		$this->form_validation->set_rules('kurir', 'kurir', 'required');

		if ($this->form_validation->run() === FALSE) {
			// error
		}
		else {
			$kurir = $this->input->post('kurir');

			$kurir_list = preg_split('/\n|\r\n/', $kurir);
			$kr = array_filter($kurir_list, function($var) { return ! empty($var); } );

			$this->pengaturan->save('list_kurir', json_encode($kr));
		}

		redirect('admin/pengaturan/index');
	}

	public function save_size() {
		$this->form_validation->set_rules('size', 'size', 'required');

		if ($this->form_validation->run() === FALSE) {
			// error
		}
		else {
			$size = $this->input->post('size');

			$size_list = preg_split('/\n|\r\n/', $size);
			$kr = array_filter($size_list, function($var) { return ! empty($var); } );

			$this->pengaturan->save('list_size', json_encode($kr));
		}

		redirect('admin/pengaturan/index');
	}
}
