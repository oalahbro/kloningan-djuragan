<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller 
{
	/**
	 * index()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	public function index()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		/*
		$sesi = array(
			'pesan'  => 'Terimakasih, sampai jumpa lagi.',
			'pesan_tampil' => TRUE
		);
		$this->session->set_userdata($sesi);
		*/

		redirect('login', 'refresh');
	}


}

/* End of file login.php */
/* Location: ./application/controllers/login.php */