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


	public function create() {
	}

	public function read() {
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