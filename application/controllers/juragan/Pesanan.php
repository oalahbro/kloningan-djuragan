<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pesanan extends CI_Controller {

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

    public function pilih_juragan($juragan_id = 0, $string_to_warna = 'string') {
		$query = $this->juragan->auth_list(data_session('id')); // ambil data sesson login
		$row = $query->row();

		$array_auth = explode(',', $row->allow_id);
		$nama = $this->juragan->ambil_nama_by_id($array_auth[0]);
		$url_nama = url_title($nama, '-', TRUE);

		$s_id = $this->session->userdata('juragan')['id_juragan']; // ambil data session id_juragan

		if($juragan_id !== 0) {
			if(in_array($juragan_id, $array_auth)) { // set session juragan dari pilihan daftar allow_id
				$sess_array = array(
					'id_juragan' => $juragan_id,
					'warna_juragan' => _warna($string_to_warna)
					);
				$this->session->set_userdata('juragan', $sess_array);
			}
		}
		else {
			if( ! isset($s_id)) { // set session juragan dari pertama login, diambil dari daftar pertama
				$sess_array = array(
					'id_juragan' => $array_auth[0],
					'warna_juragan' => _warna($url_nama)
					);
				$this->session->set_userdata('juragan', $sess_array);
			}
		}
		redirect('juragan/pesanan');
    }

    // fungsi tulis data pesanan baru
    public function tulis_baru() {
    }

    // fungsi menampilkan daftar pesanan 
    public function daftar($u = '') {
    	$data = $this->session->userdata('juragan')['id_juragan'];
    	$juragan = _nama_juragan($data);

    	$this->data = array(
			'title' => 'Pesanan - ' . $juragan . ' | ' . $this->config->item('site_name'),
			'active' => 'pesanan',
			'juragan' => $juragan
			);

		$this->load->view('juragan/header', $this->data);
		$this->load->view('juragan/menu', $this->data);
		$this->load->view('juragan/pesanan/dasbor', $this->data);
		$this->load->view('juragan/footer', $this->data);
    }
}