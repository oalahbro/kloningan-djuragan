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
	public function read($juragan = 'all', $status = 'all') {
		$nama_juragan = $this->juragan->ambil_nama_by_username($juragan);
		if($status === 'pending') {
			$judul = '<i class="glyphicon glyphicon-repeat"></i> Pesanan Pending <small>'.$nama_juragan.'</small>';
		}
		elseif($status === 'terkirim') {
			$judul = '<i class="glyphicon glyphicon-thumbs-up"></i> Pesanan Terkirim <small>'.$nama_juragan.'</small>';
		}
		else {
			$judul = '<i class="glyphicon glyphicon-th-large"></i> Semua Pesanan <small>'.$nama_juragan.'</small>';
		}

		$this->data = array(
			'title' => 'Daftar Pesanan',
			'judul' => $judul,
			'active' => 'pesanan',
			'juragan' => $juragan,
			'status' => $status
			);

		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/pesanan/read', $this->data);
		$this->load->view('admin/footer', $this->data);
	}

	public function read_ajax($juragan = 'all', $status = 'all'){
		$clicked = $this->input->get('submit');
		$cari = $this->input->get('cari');
		$page = $this->input->get('halaman', '0');

		$limit = 25;
		$offset = $page;

		$juragan_id = $this->juragan->ambil_id_by_username($juragan);

		$config['base_url'] = site_url('admin/pesanan/read_ajax/'.$juragan.'/' . $status);
		$config['total_rows'] = $this->pesanan->semua($status, '', '', $cari, $juragan_id)->num_rows();
		$config['per_page'] = $limit;

		// $config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'halaman';
		$config['suffix'] = '&cari=' . $cari;

		$this->pagination->initialize($config);

		$this->data = array(
			'data' => $this->pesanan->semua($status, $offset, $limit, $cari, $juragan_id),
			'status' => $status,
			'pagination' => $this->pagination->create_links()
			);

		if($clicked === 'yes') {
			$this->load->view('admin/pesanan/ajax', $this->data);
		}
		else {
			show_404();
		}
	}

	public function update() {
	}

	public function delete() {
		$this->pesanan->hapus($this->input->post('unik'));
		redirect($this->agent->referrer());
	}

	public function set_transfer() {
	}

	public function set_kirim() {
	}
}