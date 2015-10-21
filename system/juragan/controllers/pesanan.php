<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesanan extends CI_Controller 
{

	/**
	 * pesanan()
	 *
	 * 
	 */
	public function index()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$page 		= input_get('pg');
				$juragan 	= input_get('juragan');

				if(empty($page))
				{
					$halaman = 'semua';
				}
				else
				{
					$halaman = $page;
				}

				if($halaman === 'semua') {
					$title = '<i class="glyphicon glyphicon-th-large"></i> ';
					$title .= ucwords('Semua Pesanan');
				}
				elseif($halaman === 'terkirim') {
					$title = '<i class="glyphicon glyphicon-ok"></i> ';
					$title .= ucwords('Pesanan terkirim');
				}
				elseif($halaman === 'pending') {
					$title = '<i class="glyphicon glyphicon-refresh"></i> ';
					$title .= ucwords('Pesanan pending');
				}

				if( ! empty($juragan))
				{
					$nama_juragan = $this->juragan_model->get_nama_juragan_by_id($juragan);
				}
				else
				{
					$nama_juragan = 'Semua Juragan';
				}

				$this->data = array(
					'halaman' => $halaman,
					'judul' => $title,
					'juragan' => $juragan,
					'nama_juragan' => $nama_juragan,
					'dropdown_header' => $this->pesanan_model->dropdown_juragan()
				);

				$this->load->view('inc/header');
				$this->load->view('admin/menu_view', $this->data);
				$this->load->view('admin/pesanan_view', $this->data);
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
	 * lihat_data()
	 *
	 * 
	 */
	public function lihat_data($halaman, $juragan = false)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$halaman = $this->uri->segment(3);
				$juragan = $this->uri->segment(4);
				$cari 	 = input_get('cari');
				$page 	 = input_get('per_page');
				$offset 	= '20';

				$data_pesanan = $this->pesanan_model->get_all($halaman, $page, $offset, $cari, $juragan);

				$numrow = $this->pesanan_model->get_all($halaman, NULL, NULL, $cari, $juragan)->num_rows();
				
				$base = site_url('pesanan/lihat_data/'.$halaman.'/'.$juragan.'?cari='.$cari);
				
				$config['page_query_string']= TRUE;
				$config['base_url'] 		= $base;
				$config['total_rows'] 		= $numrow;
				$config['per_page']			= $offset;
				$config['num_links'] 		= 5;
				$config['cur_tag_open'] 	= '<li class="active"><span>';
				$config['cur_tag_close'] 	= '</span></li>';
				$config['num_tag_open'] 	= '<li>';
				$config['num_tag_close']	= '</li>';
				$config['next_link'] 		= '<i class="glyphicon glyphicon-forward"></i>';
				$config['next_tag_open'] 	= '<li>';
				$config['next_tag_close'] 	= '</li>';
				$config['prev_link'] 		= '<i class="glyphicon glyphicon-backward"></i>';
				$config['prev_tag_open'] 	= '<li>';
				$config['prev_tag_close'] 	= '</li>';
				$config['first_link'] 		= '<i class="glyphicon glyphicon-fast-backward"></i>';
				$config['first_tag_open'] 	= '<li>';
				$config['first_tag_close'] 	= '</li>';
				$config['last_link'] 		= '<i class="glyphicon glyphicon-fast-forward"></i>';
				$config['last_tag_open'] 	= '<li>';
				$config['last_tag_close'] 	= '</li>';
				$config['full_tag_open'] 	= '<div class="pg text-center"><ul class="pagination">';
				$config['full_tag_close'] 	= '</ul></div>';

				$this->pagination->initialize($config);

				$this->data = array(
					'halaman' => $halaman,
					'juragan' => $juragan,
					'table' => $this->table->generate(),
					'pagination' => $this->pagination->create_links(),
					'pesanan' => $data_pesanan
				);

				$this->load->view('admin/pesanan_loader_view', $this->data);
				
			}
			elseif(is_user('user'))
			{
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
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
				$page 		= input_get('pg');
				$juragan 	= input_get('juragan');


				if(empty($page))
				{
					$halaman	= 'tambah';
				}
				else
				{
					$halaman = $page;
				}

				$list_produk = $this->produk_model->get_produk();

				$this->data = array(
					'halaman' => $halaman,
					'juragan' => $juragan,
					'dropdown_header' => $this->pesanan_model->dropdown_juragan(),
					'dropdown_produk' => $this->produk_model->get_dropdown_array('kode', 'nama', 'produk_daftar')
				);

				$this->load->view('inc/header');
				$this->load->view('admin/menu_view', $this->data);
				$this->load->view('admin/pesanan_tambah_view', $this->data);
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
	 * set_up()
	 *
	 * 
	 */
	public function set_up()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				//echo 'hahahaha';
				$submit = $this->input->post('submit');
				$data = $this->input->post('id');

				$pecah = explode("_", $data);
				$aksi = $pecah[0]; 
				$id = $pecah[1];

				$user_id = $this->juragan_model->get_user_id_by_pesanan_id($id);

				$pg_array = array("transfer-ok", "transfer-remove", "kirim-remove");

				if( ! empty($aksi) && in_array($aksi, $pg_array))
				{
					if($aksi === 'transfer-ok')
					{
						$set = $this->pesanan_model->set_to_transfer($id, 'ok', $user_id);
					}
					elseif($aksi === 'transfer-remove')
					{
						$set = $this->pesanan_model->set_to_transfer($id, 'remove', $user_id);
					}
					elseif($aksi === 'kirim-remove')
					{
						$set = $this->pesanan_model->set_to_kirim($id, 'remove', $user_id);
					}
				}

				//
				if($set)
				{
					$this->session->set_userdata('info',  'Perubahan pada <u>ID-' . $id . '</u> telah berhasil diterapkan!');
				}
				else
				{
					$this->session->set_userdata('info', 'Perubahan pada <u>ID-' . $id . '</u> gagal diterapkan!');
				}

			}
			else
			{
				show_404();
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	public function resi($aksi)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$aksi = $this->uri->segment(3);
				$submit = $this->input->post('submit');
				$data = $this->input->post('id');

				$pecah = explode("_", $data);
				$section = $pecah[0]; 
				$id = $pecah[1];

				if($aksi === 'form' && $section === 'kirim-ok')
				{

					$this->data = array(
						'pesanan' => $this->pesanan_model->get_pesanan_id($id)
					);

					$this->load->view('admin/pesanan_resi_submit_view', $this->data);

				}				
			}
		}
	}



}

/* End of file pesanan.php */
/* Location: ./application/controllers/pesanan.php */