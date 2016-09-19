<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	/**
	 * index()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	public function index()
	{
		if( ! is_login())
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			
			if($this->form_validation->run() === FALSE)
			{
				$this->load->view('inc/header');
				$this->load->view('login_view');
				$this->load->view('inc/public/footer');
			}
			else
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$login = $this->login_model->login($username, $password);

				if($login)
				{
					$sesi = array(
						'pesan'  => 'Hey, '.data_session('nama').' selamat bekerja yak :)',
						'pesan_tampil' => TRUE
					);
					$this->session->set_userdata($sesi);
				}
				else
				{
					$sesi = array(
						'pesan'  => 'Maaf, kamu gagal login.',
						'pesan_tampil' => TRUE
					);
					$this->session->set_userdata($sesi);
				}
				redirect('beranda', 'refresh');
			}
		}
		else
		{
			redirect('beranda', 'refresh');
		}
	}


}

/* End of file login.php */
/* Location: ./application/controllers/login.php */