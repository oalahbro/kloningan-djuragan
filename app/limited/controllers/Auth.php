<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends public_controller
{
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		redirect('auth/masuk');
	}

	public function daftar() {
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[pengguna.username]|alpha_dash');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pengguna.email]');

		if ($this->form_validation->run() === FALSE) {
			$this->data = array();

			$this->load->view('publik/header', $this->data);
			$this->load->view('publik/daftar', $this->data);
			$this->load->view('publik/footer', $this->data);
		}
		else {
			// simpan ke database
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$username = $this->input->post('username');

			$data = array(
				'nama' => $nama,
				'email' => strtolower( $email ),
				'sandi' => password_hash($password, PASSWORD_BCRYPT),
				'username' => strtolower( $username )
				);

			$save = $this->pengguna->simpan($data);

			$id_pengguna = $this->db->insert_id();

			if($save) {
				// kirim email validasi
				$this->kirim_email_validasi($id_pengguna);

				redirect('?alert=' . save_url_encode(5));
			}
		}
	}

	public function masuk() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() === FALSE) {

			$this->data = array();

			$this->load->view('publik/header', $this->data);
			$this->load->view('publik/masuk', $this->data);
			$this->load->view('publik/footer', $this->data);
		}
		else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$masuk = $this->pengguna->masuk($username, $password);

			if($masuk['logged']) {
				$this->session->set_userdata($masuk);
				$data = array('login_terakhir' => time());
				$this->pengguna->update($username, $data);
			}
			redirect('auth/masuk');
		}
	}

	public function valid() {
		$encrypt_username = $this->input->get('id');
		$username = save_url_decode($encrypt_username);

		$cek = $this->pengguna->cek_by_username($username);

		if($username !== FALSE && $cek) {
			$id_pengguna = $this->pengguna->_id($username);
			$r = $this->pengguna->_detail($id_pengguna)->row();

			if($r->valid === 'tidak') {
				// belum validasi
				$data = array('valid' => 'ya');
				$this->pengguna->update($username, $data);

				$redirect = 6; // silakan login
			}
			else {
				$redirect = 7; // sudah divalidasi 
			}
			redirect('login?alert=' . save_url_encode($redirect));
		}
		else {
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_cek_email_terdaftar');

			if ($this->form_validation->run() === FALSE) {

				if( ! empty($encrypt_username)) {
					$err = 8;
				}
				else {
					$err = 0;
				}

				$this->data = array('err' => save_url_encode($err));

				$this->load->view('publik/header', $this->data);
				$this->load->view('publik/valid', $this->data);
				$this->load->view('publik/footer', $this->data);
			}
			else { 
				$email = $this->input->post('email');

				$id_pengguna = $this->pengguna->_id_by_mail($email);

				// kirim email validasi
				$this->kirim_email_validasi($id_pengguna);

				redirect('?alert=' . save_url_encode(5));
			}
		}
	}

	public function lupa() {
	}

	// cek email terdaftar (for callback validation)
	function cek_email_terdaftar($email) {
		$check_email = $this->pengguna->check_email($email);

		if ($check_email) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('cek_email_terdaftar', '{field} tidak terdaftar.');
			return FALSE;
        }
	}

	function kirim_email_validasi($id_pengguna) {
		$r = $this->pengguna->_detail($id_pengguna)->row();

		$link = site_url('valid') . '?id=' . save_url_encode($r->username);

		$html = '<div>Silakan Klik link berikut untuk validasi.<br/>'.anchor($link, 'Validasi Email').'</div>';

		$config['mailtype'] = 'html';
		// $config['mailpath'] = '/usr/sbin/sendmail';
		// $config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);

		$this->email->from('noreply@twelve.id', 'Seven Inc.', 'mylastof@gmail.com');
		$this->email->reply_to('mylastof@gmail.com');
		$this->email->to($r->email);

		$this->email->subject('['.$this->config->item('site_name').'] Validasi Email.');
		$this->email->message($html);

		$this->email->send();
	}

}
