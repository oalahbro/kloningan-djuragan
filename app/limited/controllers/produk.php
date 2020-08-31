<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller 
{
	public function index()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$title = 'Daftar Produk';

				$this->data = array(
					'judul' => ucwords($title),
					'halaman' => '',
					'juragan' => '',
					'dropdown_header' => $this->pesanan_model->dropdown_juragan(),
					'produk' => $this->produk_model->get_produk(),
					'kategori' => $this->produk_model->get_kategori()->result()
				);

				$this->load->view('inc/header');
				$this->load->view('admin/menu_view', $this->data);
				$this->load->view('admin/produk_view', $this->data);
				$this->load->view('inc/footer', $this->data);
			}
			elseif(is_user('user'))
			{
				echo 'user';
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
		// $this->load->view('welcome_message');
	}

	/**
	 * tambah()
	 *
	 * 
	 */
	public function tambah()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('kategori_id', 'Kategoru', 'trim|required|xss_clean');
				$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required|xss_clean');
				$this->form_validation->set_rules('kode_produk', 'Kode Produk', 'trim|required|xss_clean|is_unique[produk_daftar.kode]');
				$this->form_validation->set_rules('harga_produk', 'Harga Produk', 'trim|required|xss_clean|numeric');
				
				if($this->form_validation->run() === FALSE)
				{
					//
					$this->session->set_userdata(array(
						'pesan'  => '<div class="alert alert-danger">Gagal, ada kesalahan.</div>'
					));
					redirect('produk', 'refresh');
				}
				else
				{
					$kategori_id	= $this->input->post('kategori_id');
					$nama_produk 	= ucwords($this->input->post('nama_produk'));
					$kode_produk 	= strtoupper($this->input->post('kode_produk'));
					$harga_produk 	= $this->input->post('harga_produk');

					$this->data = array(
						'kategori_id' => $kategori_id,
						'nama'	=> $nama_produk,
						'kode' 	=> $kode_produk,
						'harga' => $harga_produk
						);
					
					$submit_produk 	= $this->produk_model->add_produk($this->data);
					//$login = $this->login_model->login($username, $password);

					if($submit_produk)
					{
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-success">Berhasil.</div>'
						));
					}
					else
					{
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-danger">Gagal.</div>'
						));
					}
					redirect('produk', 'refresh');
				}
			}
			elseif(is_user('user'))
			{
				//echo 'user';
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
		// $this->load->view('welcome_message');
	}

	public function edit($produk_id)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$produk_id = $this->uri->segment(4);

				$this->data = array(
					'produk' => $this->produk_model->get_detail_produk($produk_id),
					'kategori' => $this->produk_model->get_kategori()->result()
				);

				$this->load->view('admin/produk_edit_loader_view', $this->data);

			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	//
	public function simpan()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('kategori_id', 'Kategoru', 'trim|required|xss_clean');
				$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required|xss_clean');
				//$this->form_validation->set_rules('kode_produk', 'Kode Produk', 'trim|required|xss_clean');
				$this->form_validation->set_rules('harga_produk', 'Harga Produk', 'trim|required|xss_clean|numeric');
				
				if($this->form_validation->run() === FALSE)
				{
					$this->session->set_userdata(array(
						'pesan'  => '<div class="alert alert-danger">Gagal, ada kesalahan.</div>'
					));
					redirect('produk', 'refresh');
				}
				else
				{
					$produk_id 		= input_post('id');
					$kategori_id	= $this->input->post('kategori_id');
					$nama_produk 	= ucwords($this->input->post('nama_produk'));
					//$kode_produk 	= strtoupper($this->input->post('kode_produk'));
					$harga_produk 	= $this->input->post('harga_produk');

					$this->data = array(
						'kategori_id' => $kategori_id,
						'nama'	=> $nama_produk,
						//'kode' 	=> $kode_produk,
						'harga' => $harga_produk
						);
					
					$submit_produk 	= $this->produk_model->save_produk($this->data, $produk_id);

					if($submit_produk)
					{
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-success">Berhasil.</div>'
						));
					}
					else
					{
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-danger">Gagal.</div>'
						));
					}
					redirect('produk', 'refresh');
				}
			}
			elseif(is_user('user'))
			{
				//echo 'user';
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
		// $this->load->view('welcome_message');
	}

	public function get($query = NULL)
	{
		$query = $this->uri->segment(3);
		$this->db->select('id,kode');
		$this->db->from('produk_daftar');
		$this->db->like('kode',$query);
		$res = $this->db->get();
		$arr = array();
		foreach($res->result() as $row)
		{
		  // key harus dinamakan "id dan nama"
		  $arr[] = array('id'=>$row->id,'nama'=>$row->kode);
		}
		echo json_encode($arr);
	}

}

/* End of file produk.php */
/* Location: ./application/controllers/produk.php */