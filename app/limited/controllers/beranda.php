<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends CI_Controller 
{
	/**
	 * index()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 21/12/2014 ---
	 */
	public function index()
	{
		if( ! is_login())
		{
			redirect('login', 'refresh');	
		}
		else
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				// jika login sebagai admin / superadmin
				redirect('administrator', 'refresh');
			}
			else
			{
				// jika login sebagai user
				redirect('user', 'refresh');
			}
		}
	}
}

/* End of file beranda.php */
/* Location: ./application/controllers/beranda.php */