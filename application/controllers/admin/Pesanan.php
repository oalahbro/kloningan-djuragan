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
		$this->load->view('admin/footer-pesanan', $this->data);
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

	public function create($juragan) {
		$nama_juragan = $this->juragan->ambil_nama_by_username($juragan);

		if($this->form_validation->run('submit') === FALSE) {
			$this->data = array(
				'title' => 'Edit Pesanan',
				'judul' => '<i class="glyphicon glyphicon-plus"></i> Tambah Data Pesanan <small>' . $nama_juragan . '</small>',
				'active' => 'pesanan',
				'juragan' => $juragan,
				'status' => ''
			);

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/pesanan/create', $this->data);
			$this->load->view('admin/footer-selain-pesanan', $this->data);
		}
		else {
			$user_id= input_post('id');
			$nama 	= input_post('nama');
			$alamat = nl2br(input_post('alamat'));

			// kode
			$kode 	= "";
			foreach(input_post('kode') as $key => $value){
			    $kode .= $value .", ";
			}
			$kode = reduce_multiples($kode, ", ", TRUE);
			// jumlah
			$jumlah = "";
			foreach(input_post('jumlah') as $key => $value){
			    $jumlah .= $value .", ";
			}
			$jumlah = reduce_multiples($jumlah, ", ", TRUE);
			// size
			$size 	= "";
			foreach(input_post('size') as $key => $value){
			    $size .= $value .", ";
			}
			$size = reduce_multiples($size, ", ", TRUE);

			$s_kode 	= explode(', ', $kode);
			$s_jmlh 	= explode(', ', $jumlah);
			$s_size 	= explode(', ', $size);

			$ukuran 	= array_map('trim', explode(",",$jumlah));
			$totale 	= array_sum($ukuran);

			$pesanan 	= "";
			$jumlah_array = count($ukuran);
			for ($i = 0; $i < $jumlah_array; ++$i) {
			    $pesanan .= $s_kode[$i].','
			    			.$s_size[$i].','
			    			.$s_jmlh[$i].'# ';
			}
			$pesanan = reduce_multiples($pesanan, "# ", TRUE);

			//echo $pesanan;
			$hp 	= input_post('hp');
			$harga 	= str_replace('.', '', input_post('harga'));
			$ongkir	= str_replace('.', '', input_post('ongkir'));
			$transfer =  str_replace('.', '', input_post('transfer'));
			$status = input_post('status');
			$bank 	= input_post('bank');
			$keterangan = nl2br(input_post('keterangan'));
			if(empty($keterangan)) {
				$keterangan = NULL;
			}
			$image 	= input_post('image');

			$data = array(
				'user_id' => $user_id,
				'nama' 	=> $nama,
				'alamat' => $alamat,
				'hp' 	=> $hp,
				'pesanan' => $pesanan,
				'harga' => $harga,
				'ongkir' => $ongkir,
				'jumlah' => $totale,
				'transfer' => $transfer,
				'status' => $status,
				'bank' => $bank,
				'keterangan' => $keterangan,
				'data' => 'baru'
			);

			$this->pesanan_model->add($user_id, $data);
			$this->session->set_userdata(array('info' => 'Data pesanan baru sudah disimpan.', 'info_tampil' => TRUE));

			redirect('administrator?pg=pending&juragan=' . $user_id);
		}
	}

	public function update($pesanan_unik) {
		$nama_juragan = $this->juragan->ambil_nama_by_pesanan_unik($pesanan_unik);

		$id = $pesanan_unik;
		$cek_pesanan = $this->pesanan->get_pesanan_by_unik($pesanan_unik);
		$row = $cek_pesanan->row(); 
		
		if($this->form_validation->run('submit') === FALSE) {
			$this->data = array(
				'title' => 'Edit Pesanan',
				'judul' => '<i class="glyphicon glyphicon-edit"></i> Sunting Data Pesanan <small>' . $nama_juragan . '</small>',
				'active' => 'pesanan',
				'juragan' => '',
				'pesanan' => $row
			);

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/pesanan/edit', $this->data);
			$this->load->view('admin/footer-selain-pesanan', $this->data);
		}
		else {
			$id 	= input_post('id');
			$nama 	= input_post('nama');
			$alamat = input_post('alamat');

			// kode
			$kode ="";
			foreach(input_post('kode') as $key => $value){
			    $kode .= $value .", ";
			}
			$kode = reduce_multiples($kode, ", ", TRUE);
			// jumlah
			$jumlah ="";
			foreach(input_post('jumlah') as $key => $value){
			    $jumlah .= $value .", ";
			}
			$jumlah = reduce_multiples($jumlah, ", ", TRUE);
			// size
			$size ="";
			foreach(input_post('size') as $key => $value){
			    $size .= $value .", ";
			}
			$size = reduce_multiples($size, ", ", TRUE);

			$s_kode 	= explode(', ', $kode);
			$s_jmlh 	= explode(', ', $jumlah);
			$s_size 	= explode(', ', $size);

			$ukuran 	= array_map('trim', explode(",",$jumlah));
			$totale 	= array_sum($ukuran);

			$pesanan ="";
			$jumlah_array = count($ukuran);
			for ($i = 0; $i < $jumlah_array; ++$i) {
			    $pesanan .= $s_kode[$i].','
			    			.$s_size[$i].','
			    			.$s_jmlh[$i].'# ';
			}
			$pesanan = reduce_multiples($pesanan, "# ", TRUE);

			$hp 	= input_post('hp');
			$harga 	= str_replace('.', '', input_post('harga'));
			$ongkir	= str_replace('.', '', input_post('ongkir'));
			$transfer =  str_replace('.', '', input_post('transfer'));
			$status = input_post('status');
			$bank 	= input_post('bank');
			$keterangan = nl2br(input_post('keterangan'));
			if(empty($keterangan))
			{
				$keterangan = NULL;
			}
			$image 	= input_post('image');

			$data = array(
				'nama' 	=> $nama,
				'alamat' => $alamat,
				'hp' 	=> $hp,
				'pesanan' => $pesanan,
				'harga' => $harga,
				'ongkir' => $ongkir,
				'jumlah' => $totale,
				'transfer' => $transfer,
				'status' => $status,
				'bank' => $bank,
				'keterangan' => $keterangan,
				'data' => 'baru'
			);

			$this->pesanan_model->update_pesanan($id, $data);
			$this->session->set_userdata(array('info' => 'Pesanan <u>ID-' . $id . '</u> berhasil diubah!', 'info_tampil' => TRUE));

			redirect('administrator?pg=' . $halaman . '$juragan=' . $juragan);
		}
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