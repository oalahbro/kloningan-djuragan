<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends admin_controller
{

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->form_validation->set_rules('kurir', 'kurir', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data = array();

			$this->load->view('admin/header', $data);
			$this->load->view('admin/pengaturan/web', $data);
			$this->load->view('admin/footer', $data);
		}
		else {
			// simpan ke database
			$kurir = $this->input->post('kurir');
			$size = $this->input->post('size');

			$kurir_list = preg_split('/\n|\r\n/', $kurir);

			
			$kr = array_filter($kurir_list, function($var) { return ! empty($var); } );

			$size_list = preg_split('/\n|\r\n/', $size);
			$sz = array_filter($size_list, function($var) { return ! empty($var); } );

			$this->pengaturan->save('list_kurir', json_encode($kr));
			$this->pengaturan->save('list_size', json_encode($sz));

			redirect('admin/pengaturan');

			var_dump($kr);

		}
	}

}
