<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends admin_controller
{
	public function __construct() {
		parent::__construct();
	}

	public function lihat($status = 'aktif') {

		$per_page = $this->input->get('halaman');
		$limit = 20;

		// jika get $per_page tidak tersedia
		if( ! isset($per_page)) {
			$per_page = 0;
		}

		if(in_array($status, array('aktif', 'blokir', 'baru'))) {
			if($status === 'baru') {
				$aktif = 'tidak';
				$blokir = 'tidak';
			}
			elseif ($status === 'blokir') {
				$aktif = FALSE;
				$blokir = 'ya';
			}
			elseif ($status === 'aktif') {
				$aktif = 'ya';
				$blokir = 'tidak';
			}


			$query = $this->pengguna->_semua($aktif, $blokir);

			$config['base_url'] = site_url('admin/pesanan/lihat/' . $status);
			$config['total_rows'] = $this->pengguna->_semua($aktif, $blokir)->num_rows();
			$config['per_page'] = $limit;
			$config['page_query_string'] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['query_string_segment'] = 'halaman';
			$config['reuse_query_string'] = TRUE;

			// inisialisasi pagination
			$this->pagination->initialize($config);

			// data untuk disajikan
			$this->data = array(
				'q' => $query,
				'pagination' => $this->pagination->create_links(),
				'status' => $status
				);

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/pengguna/lihat', $this->data);
			$this->load->view('admin/footer', $this->data);
		}
		else {
			show_404();
		}		
	}

	public function tambah($juragan) {
		$this->data = array();

		$this->load->view('publik/header', $this->data);
		$this->load->view('publik/masuk', $this->data);
		$this->load->view('publik/footer', $this->data);
	}

	public function sunting() {
		$enc = $this->input->get('id');

		$username = save_url_decode($enc);
		$cek = $this->pengguna->cek_by_username($username);

		if( ! empty($enc) && $cek) {
			$user_id = $this->pengguna->_id($username);

			$this->data = array(
				'q' => $this->pengguna->_detail($user_id)->row(),
				'enc' => $enc
				);

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/pengguna/sunting', $this->data);
			$this->load->view('admin/footer', $this->data);
		}
		else {
			show_404();
		}
	}

	public function simpan() {
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('pass', 'password');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('level', 'role', 'required|in_list[admin,cs,reseller]');
		// $this->form_validation->set_rules('juragan', 'juragan', '');
		$this->form_validation->set_rules('aktif', 'aktif', 'required|in_list[ya,tidak]');
		$this->form_validation->set_rules('blokir', 'blokir', 'required|in_list[ya,tidak]');

		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$pass = $this->input->post('pass');
		$email = $this->input->post('email');
		$level = $this->input->post('level');
		$juragan = $this->input->post('juragan[]');
		$aktif = $this->input->post('aktif');
		$blokir = $this->input->post('blokir');

		if ($this->form_validation->run() === FALSE) {
			redirect('admin/pengguna/sunting?id=' . $id);
		}
		else {
			// juragan 
			$jur = NULL;

			// cek didatabase sudah ada atau belum, 
			// jika sudah ada maka skip 
			// jika belum maka ditambah
			// jika berkurang maka hapus
			$usr = save_url_decode($id);
			$usr_id = $this->pengguna->_id($usr);

			$jcs = $this->pengguna->get_juragan($usr_id);

			$simp = array();
			$sbm = array();

			foreach ($jcs->result() as $smpj) {
				$simp[] = $smpj->juragan_id;
			}

			$simpan = array_diff($juragan, $simp);
			$hapus = array_diff($simp, $juragan);

			$prnt = array('simpan' => $simpan, 'hapus' => $hapus);

			print('<pre>');
			print_r($prnt);
			print('</pre>');


			/*



			if($level === 'cs') {
				$jur = json_encode($juragan);
			}
			else if ($level === 'admin') {
				$jur = NULL;
			}
			else {
				$id_jur = $this->config->item('id_default_reseller');

				if((int) $id_jur > 0) {

					$jur = json_encode(array($id_jur));
				}
			}
			if($pass !== '') {
			    $pasw = array('sandi' => password_hash($pass, PASSWORD_BCRYPT));
			}
			else {
			    $pasw = array();
			}

			$data = array(
				'nama' => $nama,
				'email' => $email,
				'level' => $level,
				'aktif' => $aktif,
				'blokir' => $blokir,
				'juragan' => $jur
				);

			// print_r($data);
			$username = save_url_decode($id);
			$ok = $this->pengguna->update($username, array_merge($data, $pasw));

			if($ok) {
				$redirect = 1;
			}
			else {
				$redirect = 0;
			}

			// redirect('admin/pengguna/lihat?ok=' . save_url_encode( $redirect ) );
			*/
		}
	}

	public function blokir() {
	}

	public function hapus() {
	}

}
