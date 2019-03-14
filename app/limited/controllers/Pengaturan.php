<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
	private $template;

	public function __construct() {
        parent::__construct();
        if( ! $this->session->logged) {
            redirect('');
        }
        else {
            switch ($this->session->level) {
                case 'superadmin':
                case 'admin':
                $this->template = 'admin';
					break;
					
				case 'viewer':
				$this->template = 'viewer';
					break;

                case 'cs':
                $this->template = 'cs';
                    break;
                
                default:
                    $this->template = 'reseller';
                    break;
            }
        }
    }

	public function index() {
		if ($this->template === 'admin') {
			$data = array(
				'judul' => 'Pengaturan Web',
				'include' => $this->template
			);
	
			$this->load->view('pengaturan-web', $data);
		}
		else {
			show_404();
		}
	}

	public function juragan() {
		$this->form_validation->set_rules('nama', 'nama', 'required');
			
		if ($this->form_validation->run() === FALSE) {
			$per_page = $this->input->get('halaman');
			$limit = 20;

			// jika get $per_page tidak tersedia
			if( ! isset($per_page)) {
				$per_page = 0;
			}

			$query = $this->juragan->_semua($limit, $per_page);

			$config['base_url'] = site_url('admin/pengaturan/juragan/');
			$config['total_rows'] = $this->juragan->_semua(FALSE, FALSE)->num_rows();
			$config['per_page'] = $limit;
			$config['page_query_string'] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['query_string_segment'] = 'halaman';
			$config['reuse_query_string'] = TRUE;

			// inisialisasi pagination
			$this->pagination->initialize($config);

			$this->data = array(
				'judul' => 'Atur Juragan',
				'q' => $query
				);

			$this->load->view('administrator/header', $this->data);
			$this->load->view('administrator/pengaturan/juragan', $this->data);
			$this->load->view('administrator/footer', $this->data);
		}
		else {
			$nama = $this->input->post('nama');
			$short = $this->input->post('short');

			$jur_id = $this->faktur->_primary('juragan', 'id');
			$jur_ = array();
			if ((int) $jur_id !== 0) {
				$jur_ = array(
					'id' => $jur_id
				);
			}
			
			$data = array(
				'nama' => $nama,
				'short' => strtolower( $short ),
				'slug' => random_string('sha1', 40)
			);

			$this->juragan->_new(array_merge($jur_, $data));

			redirect('admin/pengaturan/juragan');
		}	
	}

	public function pengguna() {
		if ($this->template === 'admin') {
			$per_page = $this->input->get('halaman');
			$limit = 25;

			// jika get $per_page tidak tersedia
			if( ! isset($per_page)) {
				$per_page = 0;
			}

			$query = $this->pengguna->_semua(FALSE, FALSE, $limit, $per_page);

			$config['base_url'] = site_url('pengaturan/pengguna/');
			$config['total_rows'] = $this->pengguna->_semua(FALSE, FALSE, FALSE, FALSE)->num_rows();
			$config['per_page'] = $limit;
			$config['page_query_string'] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['query_string_segment'] = 'halaman';
			$config['reuse_query_string'] = TRUE;

			// inisialisasi pagination
			$this->pagination->initialize($config);

			$this->data = array(
				'judul' => 'Atur Pengguna',
				'q' => $query,
				'include' => $this->template
				);

			$this->load->view('pengaturan-pengguna', $this->data);
		}
		else {
			show_404();
		}
	}

	public function sunting_pengguna($id_username) {
		if ($this->template === 'admin') {
			$id_username = explode('____', $id_username);
			$id = $id_username[0];
			$username = $id_username[1];

			$ok = $this->pengguna->cek_by_username($username);
			if ($this->pengguna->_id($username) === $id && $ok) {
				$this->form_validation->set_rules('nama', 'nama', 'required');
				$this->form_validation->set_rules('sandi', 'password|atches[sandi2]');
				$this->form_validation->set_rules('sandi2', 'password');
				$this->form_validation->set_rules('email', 'email', 'required|valid_email');
				$this->form_validation->set_rules('level', 'role', 'required|in_list[admin,cs,reseller]');
				$this->form_validation->set_rules('valid', 'valid', 'required|in_list[ya,tidak]');
				$this->form_validation->set_rules('aktif', 'aktif', 'required|in_list[ya,tidak]');
				$this->form_validation->set_rules('blokir', 'blokir', 'required|in_list[ya,tidak]');
				$this->form_validation->set_rules('juragan', 'juragan');
				
				if ($this->form_validation->run() === FALSE) {
					$this->data = array(
						'judul' => 'Sunting pengguna "' . $username . '"',
						'pengguna' => $this->pengguna->_detail($id)->row(),
						'include' => $this->template
						);
		
					$this->load->view('pengaturan-sunting_pengguna', $this->data);
				}
				else {
					$nama = $this->input->post('nama');
					$ganti_sandi = $this->input->post('ganti_sandi');
					$sandi = $this->input->post('sandi');
					$email = $this->input->post('email');
					$level = $this->input->post('level');
					$juragan = $this->input->post('juragan');
					$valid = $this->input->post('valid');
					$aktif = $this->input->post('aktif');
					$blokir = $this->input->post('blokir');

					$data_sandi = array();
					if($ganti_sandi === 'ya') {
						$data_sandi = array(
							'sandi' => password_hash($sandi, PASSWORD_BCRYPT)
						);
					}

					$data = array(
						'nama' => $nama,
						'email' => $email,
						'level' => $level,
						'aktif' => $aktif,
						'blokir' => $blokir,
						'valid' => $valid
					);

					$this->pengguna->update($username, array_merge( $data_sandi, $data ) );

					# hapus semua juragan
					$this->pengguna->delete_juragan($id);

					switch ($level) {
						case 'admin':
							break;
						
						case 'cs':
							# insert juragan baru
							$data_juragan = array();
							$i = 0;
							foreach ($juragan as $jrgn) {
								$id_rel = $this->faktur->_primary('pengguna_relation', 'id_relation', count($juragan), $i);
								if ((int) $id_rel !== 0) {
									$data_juragan[$i]['id_relation'] = $id_rel;
								}
								
								$data_juragan[$i]['pengguna_id'] = $id;
								$data_juragan[$i]['juragan_id'] = $jrgn;
								$i++;
							}
							$this->pengguna->insert_juragan($data_juragan);
							break;
						
						case 'reseller':
							# code...
							break;
					}
					redirect('pengaturan/pengguna');
				}
			}
			else {
				redirect('pengaturan/pengguna');
			}
		}
		else {
			show_404();
		}
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
