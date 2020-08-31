<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * admin/Setting
 *
 * Merupakan halaman pesanan, yang akan diproses dihalaman ini adalah menampilkan data pesanan,  membuat data pesanan, mengubah data pesanan, dan menghapus data pesanan serta melakukan fungsi yang lain.
 * 
 * @package 	Juragan
 * @version 	7.0
 * @author 	Toto Prayogo
 * @link 	http://totoprayogo.com
 */
class Setting extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	if(is_login() !== TRUE) {
    		redirect('login'); // belum masuk ? dialihkan ke halaman `login`
    	}
    	else {
			if(is_user_level('user') === TRUE) {
				redirect('juragan'); // dialihkan ke halaman `juragan` jika bukan login sebagai `admin`
			}
		}
    }
    public function index() {
    	# code...
    }

    public function product() {
    	# code...
    }

    public function juragan() {
    	$this->data = array(
			'title' => 'Daftar Juragan',
			'judul' => '<i class="glyphicon glyphicon-plus"></i> Daftar Data Juragan <small>All Juragan</small>',
			'active' => 'pesanan'
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/setting/juragan', $this->data);
		$this->load->view('admin/footer-selain-pesanan', $this->data);
    }

    public function admin() {
    	$this->data = array(
			'title' => 'Daftar Admin',
			'judul' => '<i class="glyphicon glyphicon-plus"></i> Daftar Data Admin <small>All Admin</small>',
			'active' => 'pesanan'
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/setting/juragan', $this->data);
		$this->load->view('admin/footer-selain-pesanan', $this->data);
    }

    public function user($view = 'lihat') {
		if($view === 'tambah') {
			$this->data = array(
				'title' => 'Daftar User',
				'judul' => '<i class="glyphicon glyphicon-plus"></i> Daftar Data User <small>Tambah Data</small>',
				'active' => 'pesanan'
				);


			$this->form_validation->set_rules('nama', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|is_unique[juragan.username]|alpha_dash');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[password_r]|min_length[4]');
			$this->form_validation->set_rules('password_r', 'Confirm Password', 'required');
			$this->form_validation->set_rules('juragan[]', 'Juragan', 'required');

			if($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $this->data);
				$this->load->view('admin/setting/tambah_user', $this->data);
				$this->load->view('admin/footer-selain-pesanan', $this->data);
			}
			else {
				// simpan data 
				$nama 		= $this->input->post('nama');
				$username 	= $this->input->post('username');
				$password 	= $this->input->post('password');
				$jur 		= $this->input->post('juragan');
				
				$input1 = $this->juragan->tambah_user($nama, $username, $password, 'user');
				if($input1) {
					$values = '';
					foreach($jur AS $key => $value) {
						$values .= $value . ",";
					}
					$this->juragan->juragan_auth($username, reduce_multiples($values, ",", TRUE));
				}

				/*
				$sesi = array(
					'pesan'  => 'Sip, Juragan ' . $nama . ' sudah disimpan',
					'pesan_tampil' => TRUE
				);
				$this->session->set_userdata($sesi);
				*/

				redirect('admin/setting/user');
			}
		}
		else {
			$this->data = array(
				'title' => 'Daftar User',
				'judul' => '<i class="glyphicon glyphicon-plus"></i> Daftar Data User <small>Lihat Data</small>',
				'active' => 'pesanan'
				);

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/setting/juragan', $this->data);
			$this->load->view('admin/footer-selain-pesanan', $this->data);
		}
    }



}