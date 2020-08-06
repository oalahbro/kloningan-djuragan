<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juragan extends CI_Controller 
{
	/**
	 * juragan()
	 *
	 * 
	 */
	public function index()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$page 		= $this->uri->segment(2);

				if(empty($page))
				{
					$halaman = 'home';
				}
				else 
				{
					$halaman = $page;
				}

				$this->data = array(
					'halaman' => $halaman,
					'judul' => ucwords('Daftar Semua juragan'),
					'dropdown_header' => $this->pesanan_model->dropdown_juragan()
				);

				$this->load->view('inc/header');
				$this->load->view('admin/menu_view', $this->data);
				$this->load->view('admin/juragan_view', $this->data);
				$this->load->view('inc/footer', $this->data);
			}
			elseif(is_user('user'))
			{
				redirect('pesanan', 'refresh');
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	/**
	 * juragan()
	 *
	 * 
	 */
	public function tambah()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$page 		= $this->uri->segment(2);

				if(empty($page))
				{
					$halaman = 'home';
				}
				else 
				{
					$halaman = $page;
				}

				$this->data = array(
					'halaman' => $halaman,
					'judul' => ucwords('Daftar Semua juragan'),
					'dropdown_header' => $this->pesanan_model->dropdown_juragan()
				);

				$this->form_validation->set_rules('nama', 'Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[6]|is_unique[user.username]|alpha_dash');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[password_c]|min_length[8]');
				$this->form_validation->set_rules('password_c', 'Confirm Password', 'trim|required|xss_clean|min_length[8]');
				
				if($this->form_validation->run() === FALSE)
				{
					$this->load->view('inc/header');
					$this->load->view('admin/menu_view', $this->data);
					$this->load->view('admin/juragan_tambah_view', $this->data);
					$this->load->view('inc/footer', $this->data);
				}
				else
				{
					$nama 		= $this->input->post('nama');
					$username 	= $this->input->post('username');
					$password 	= $this->input->post('password');
					
					$login = $this->juragan_model->add($nama, $username, $password);

					if($login)
					{
						redirect('juragan', 'refresh');
					}
				}

				
			}
			elseif(is_user('user'))
			{
				redirect('pesanan', 'refresh');
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}



}

/* End of file juragan.php */
/* Location: ./application/controllers/juragan.php */