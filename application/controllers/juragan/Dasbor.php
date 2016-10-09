<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dasbor extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(is_login() !== TRUE) {
			redirect('login'); // belum masuk ? dialihkan ke halaman `login`
		}
		else {
			if(is_user_level('user') !== TRUE) {
				redirect('admin'); // dialihkan ke halaman `juragan` jika bukan login sebagai `admin`
			}
		}
	}

	public function index() {
		// redirect ke pilihan pertama `allowed_id`
		$data = $this->session->userdata('juragan')['id_juragan'];
		if(isset($data)) {
			redirect('juragan/pesanan');
		}
		else {
			redirect('juragan/dasbor/select');
		}
	}

	public function select($user_id = '') {
		if($user_id === '') {
			$this->data = array(
				'title' => 'Pilih Juragan',
				'auth_list' => $this->juragan->auth_list(data_session('id'))
				);

			$this->load->view('juragan/header', $this->data);
			$this->load->view('juragan/select', $this->data);
			$this->load->view('juragan/footer', $this->data);
		}
		else {
			$query = $this->juragan->auth_list(data_session('id'));
			$row = $query->row();

			$array_auth = explode(',', $row->allow_id);

			if(in_array($user_id, $array_auth)) {
				$sess_array = array(
					'id_juragan' => $user_id
					);
				$this->session->set_userdata('juragan', $sess_array);
				redirect('juragan');
			}
			else {
				// show_404();
				redirect('');
			}
		}
	}
}