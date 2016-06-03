<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * admin/Pesanan
 *
 * Merupakan halaman pesanan, yang akan diproses dihalaman ini adalah menampilkan data pesanan,  membuat data pesanan, mengubah data pesanan, dan menghapus data pesanan serta melakukan fungsi yang lain.
 * 
 * @package 	Juragan
 * @version 	7.0
 * @author 	Toto Prayogo
 * @link 	http://totoprayogo.com
 */
class Pesanan extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	if(is_login() !== TRUE) {
    		redirect('login'); // belum masuk ? dialihkan ke halaman `login`
    	}
    	else {
			if(is_user_level('user') === TRUE) {
				redirect('juragan'); // dialihkan ke halaman `juragan` jika bukan login sebagai `admin`
			}
		}
    }

    // menampilkan daftar pesanan; ALL, PENDING, TERKIRIM
	public function read() {
		$this->data = array(
			'title' => 'Daftar Pesanan'
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/pesanan/read', $this->data);
		$this->load->view('admin/footer', $this->data);
	}

	public function json(){
		$per_page = 100;
		$current_page = 1;
		$this->db->limit($per_page, $current_page);
		$query = $this->db->get("order");
		$data['data'] = $query->result();
		$data['total'] = $this->db->count_all("order");
		$data['per_page'] = $per_page;
		$data['current_page'] = $current_page;

		echo json_encode($data);
	}

	public function create() {
	}

	public function update() {
	}

	public function delete() {
	}

	public function set_transfer() {
	}

	public function set_kirim() {
	}
}