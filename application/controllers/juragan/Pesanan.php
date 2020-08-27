<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pesanan extends CI_Controller {

	var $s_id;

	public function __construct() {
    	parent::__construct();

    	$this->s_id = $this->session->userdata('juragan')['id_juragan'];

    	if(_is_login() !== TRUE) {
    		redirect('login'); // belum masuk ? dialihkan ke halaman `login`
    	}
    	else {
			if(_is_user_level('user') !== TRUE) {
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
			if( ! isset($this->s_id)) { // set session juragan dari pertama login, diambil dari daftar pertama
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
    	$juragan = _nama_juragan($this->s_id);

    	$this->data = array(
			'title' => 'Tulis Pesanan - ' . $juragan . ' | ' . $this->config->item('site_name'),
			'active' => 'pesanan',
			'juragan' => $juragan
			);

		$this->load->view('juragan/header', $this->data);
		$this->load->view('juragan/menu', $this->data);
		$this->load->view('juragan/pesanan/tulis', $this->data);
		$this->load->view('juragan/footer', $this->data);
    }

    // fungsi menampilkan daftar pesanan 
    public function daftar($status = 'all') {
    	$juragan = _nama_juragan($this->s_id);

    	if($status === 'terkirim') {
    		$judul = 'Pesanan Terkirim';
    	}
    	elseif($status === 'pending') {
    		$judul = 'Pesanan Pending';
    	}
    	else {
    		$judul = 'Semua Pesanan';
    	}

    	$this->data = array(
			'title' => $judul . ' - ' . $juragan . ' | ' . $this->config->item('site_name'),
			'sub_title' => $judul,
			'active' => 'pesanan',
			'juragan' => $juragan
			);

		$this->load->view('juragan/header', $this->data);
		$this->load->view('juragan/menu', $this->data);
		$this->load->view('juragan/pesanan/daftar', $this->data);
		$this->load->view('juragan/footer', $this->data);
    }
}