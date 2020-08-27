<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
				'title' => 'Tambah Pesanan ' . $nama_juragan,
				'judul' => '<i class="glyphicon glyphicon-plus"></i> Tambah Data Pesanan <small>' . $nama_juragan . '</small>',
				'active' => 'pesanan',
				'juragan' => $juragan,
				'member' => $this->juragan->memberlist($juragan),
				'status' => ''
			);

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/pesanan/create', $this->data);
			$this->load->view('admin/footer-selain-pesanan', $this->data);
		}
		else {
			$user_id= $this->input->post('user_id');
			$member_id= $this->input->post('member_id');
			$nama 	= $this->input->post('nama');
			$alamat = nl2br($this->input->post('alamat'));

			if($member_id === NULL) {
				$member_id = '0';
			}

			// kode
			$kode 	= "";
			foreach($this->input->post('kode') as $key => $value){
			    $kode .= $value .", ";
			}
			$kode = reduce_multiples($kode, ", ", TRUE);
			// jumlah
			$jumlah = "";
			foreach($this->input->post('jumlah') as $key => $value){
			    $jumlah .= $value .", ";
			}
			$jumlah = reduce_multiples($jumlah, ", ", TRUE);
			// size
			$size 	= "";
			foreach($this->input->post('size') as $key => $value){
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
			$hp 	= $this->input->post('hp');
			$harga 	= str_replace('.', '', $this->input->post('harga'));
			$ongkir	= str_replace('.', '', $this->input->post('ongkir'));
			$transfer =  str_replace('.', '', $this->input->post('transfer'));
			$status = $this->input->post('status');
			$bank 	= $this->input->post('bank');
			$keterangan = nl2br($this->input->post('keterangan'));
			if(empty($keterangan)) {
				$keterangan = NULL;
			}
			$image 	= $this->input->post('image');
			if(empty($image) || $image === 'undefined') {
				$image = NULL;
			}

			$data = array(
				'user_id' => $user_id,
				'member_id' => $member_id,
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
				'customgambar' => $image,
				'unik' => $user_id . '_' .random_string('unique', 32)
			);

			$this->pesanan->add($user_id, $data);
			// $this->session->set_userdata(array('info' => 'Data pesanan baru sudah disimpan.', 'info_tampil' => TRUE));

			redirect('admin/pesanan/read/' . $juragan);
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
				'pesanan' => $row
			);

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/pesanan/edit', $this->data);
			$this->load->view('admin/footer-selain-pesanan', $this->data);
		}
		else {
			$id 	= $this->input->post('id');
			$member_id= $this->input->post('member_id');
			$nama 	= $this->input->post('nama');
			$alamat = $this->input->post('alamat');

			if($member_id === NULL) {
				$member_id = '0';
			}

			// kode
			$kode ="";
			foreach($this->input->post('kode') as $key => $value){
			    $kode .= $value .", ";
			}
			$kode = reduce_multiples($kode, ", ", TRUE);
			// jumlah
			$jumlah ="";
			foreach($this->input->post('jumlah') as $key => $value){
			    $jumlah .= $value .", ";
			}
			$jumlah = reduce_multiples($jumlah, ", ", TRUE);
			// size
			$size ="";
			foreach($this->input->post('size') as $key => $value){
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

			$hp 	= $this->input->post('hp');
			$harga 	= str_replace('.', '', $this->input->post('harga'));
			$ongkir	= str_replace('.', '', $this->input->post('ongkir'));
			$transfer =  str_replace('.', '', $this->input->post('transfer'));
			$status = $this->input->post('status');
			$bank 	= $this->input->post('bank');
			$keterangan = nl2br($this->input->post('keterangan'));
			if(empty($keterangan)) {
				$keterangan = NULL;
			}
			$image 	= $this->input->post('image');
			if(empty($image) || $image === 'undefined') {
				$image = NULL;
			}

			$data = array(
				'nama' 	=> $nama,
				'member_id' => $member_id,
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
				'customgambar' => $image
			);

			$this->pesanan->update($id, $data);
			//$this->session->set_userdata(array('info' => 'Pesanan <u>ID-' . $id . '</u> berhasil diubah!', 'info_tampil' => TRUE));
			redirect('administrator');
		}
	}

	public function delete() {
		$this->pesanan->hapus($this->input->post('unik'));
		redirect($this->agent->referrer());
	}

	public function set_transfer() {
		$id = $this->input->post('id');
		$stat = $this->input->post('status');

		$unik = $this->pesanan->get_unik_by_id($pesanan_id);
		$user_id = $this->pesanan->get_user_id_by_pesanan($unik);

		$this->pesanan->set_to_transfer($id, $stat, $user_id);
	}

	public function set_kirim() {
		$unik = $this->input->post('unik');
		$tanggal = $this->input->post('tanggal');
		$kurir = $this->input->post('kurir_list');
		$lain = $this->input->post('lain');
		$ongkir = $this->input->post('ongkir');
		$resi = $this->input->post('resi');

		if($ongkir === '') {
			$ongkir = NULL;
		}

		if($tanggal !== '') {
			$t = date("Y-m-d", strtotime($tanggal));
			$tanggal = $t . ' ' . mdate("%H:%i:%s", now());
			$stat = 'Terkirim';
			$resi = $resi;
			$kurir = $kurir;
		}
		else {
			$tanggal = NULL;
			$stat = 'Pending';
			$resi = NULL;
			$kurir = NULL;
		}

		$data = array(
			'cek_kirim' =>$tanggal,
			'barang' => $stat,
			'resi' => $resi,
			'kurir' => $kurir,
			'ongkir_fix' => $ongkir
		);

		$user_id = $this->pesanan->get_user_id_by_pesanan($unik);
		$this->pesanan->set_to_kirim($unik, $data, $user_id);
		redirect();
	}
}