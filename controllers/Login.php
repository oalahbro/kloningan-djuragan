<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * login.php
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		5.x.x
 */

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
        if(is_login()) {
			if(is_user('superadmin') || is_user('admin')) {
				// jika login sebagai admin / superadmin
				redirect('admin');
			}
			else {
				// jika login sebagai user
				redirect('user');
			}
		}
    }

	public function index() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE) {
			$this->load->view('public/header');
			$this->load->view('public/login_view');
			$this->load->view('public/footer');
		}
		else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$login = $this->login->login($username, $password);

			if($login) {
				/* $sesi = array(
					'pesan'  => 'Hey, '.data_session('nama').' selamat bekerja yak :)',
					'pesan_tampil' => TRUE
				);
				$this->session->set_userdata($sesi); */
				echo "login";
			}
			else {
				/* $sesi = array(
					'pesan'  => 'Maaf, kamu gagal login.',
					'pesan_tampil' => TRUE
				);
				$this->session->set_userdata($sesi); */
				echo 'gagal';
			}
			redirect('login');
		}
	}

}