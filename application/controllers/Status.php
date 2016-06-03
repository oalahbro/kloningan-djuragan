<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Status
 *
 * Halaman untuk menampilkan status, digunakan pada halaman admin maupun juragan
 * 
 * @package 	Juragan
 * @version 	7.0
 * @author 	Toto Prayogo
 * @link 	http://totoprayogo.com
 */
class Status extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	if(is_login() !== TRUE) {
			redirect('login');
		}
    }


	public function index() {
		$this->data = array(
			'title' => 'Status Order per Juragan'
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/status', $this->data);
		$this->load->view('admin/footer', $this->data);
	}
}