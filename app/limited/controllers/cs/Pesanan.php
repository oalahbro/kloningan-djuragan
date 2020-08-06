<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pesanan extends user_controller
{

	public function __construct() {
		parent::__construct();
	}

	public function lihat($juragan = 'semua', $status = 'all') {
		$limit_en = $this->input->get('limit');
		$per_page = $this->input->get('halaman');
		$cari = $this->input->get('cari');
		$user_slug = $this->session->username;

		if(empty($cari)) {
			$cari = FALSE;
		}

		$cok = get_cookie('limit_pesanan');

		if ($cok !== '' && ! isset($limit_en)) {
			$limit_de = save_url_decode(get_cookie('limit_pesanan'));
		}
		else if ($cok !== '' && isset($limit_en) ) {
			
			$cookie = array(
				'name'   => 'limit_pesanan',
				'value'  => $limit_en,
				'expire' => ((60*60*12)*30)*24,
				'path'   => '/',
				);
			set_cookie($cookie);

			$limit_de = save_url_decode($limit_en);
		}
		else {
			$limit_de = '';
		}

		if ($limit_de !== '' && $limit_de > 0) {
			$limit = $limit_de;
		}
		else {
			$limit = 30;
		}

		// jika get $per_page tidak tersedia
		if( ! isset($per_page)) {
			$per_page = 0;
		}

		// cek $juragan ...
		$cek = $this->juragan->cek($juragan);
		$juragan_ada = $this->pengguna->juragan($user_slug, $juragan);

		if(in_array($status, array('all', 'pending', 'terkirim')) && $juragan_ada && $cek ) {

			$id_juragan = $this->juragan->_id($juragan);

			$query = $this->pesanan->ambil_semua($id_juragan, FALSE, $status, $limit, $per_page, $cari);

			$config['base_url'] = site_url($juragan .'/pesanan/' . $status);
			$config['total_rows'] = $this->pesanan->ambil_semua($id_juragan, FALSE, $status, FALSE, FALSE, $cari)->num_rows();
			$config['per_page'] = $limit;
			$config['page_query_string'] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['query_string_segment'] = 'halaman';
			$config['reuse_query_string'] = TRUE;

			// inisialisasi pagination
			$this->pagination->initialize($config);

			// data untuk disajikan
			$this->data = array(
				'q' => $query,
				'pagination' => $this->pagination->create_links(),
				'limit' => $limit,
				'juragan' => $juragan,
				'status' => $status,
				'cari' => $cari
				);

			$this->load->view('cs/header', $this->data);
			$this->load->view('cs/pesanan/lihat', $this->data);
			$this->load->view('cs/footer', $this->data);
		}
		else {
			show_404();
		}		
	}

	public function tambah($juragan = 'semua') {
		// $this->form_validation->set_rules('juragan', 'juragan', 'required|greater_than[0]');
		$this->form_validation->set_rules('nama', 'nama lengkap', 'required');
		$this->form_validation->set_rules('hp[]', 'hp', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('kode[]', 'kode', 'required');
		$this->form_validation->set_rules('size[]', 'size', 'required');
		$this->form_validation->set_rules('harga_a[]', 'harga_a', 'required');
		$this->form_validation->set_rules('jumlah[]', 'jumlah', 'required');
		$this->form_validation->set_rules('status_transfer', 'status_transfer', 'required');
		$this->form_validation->set_rules('bank', 'bank', 'required');
		$this->form_validation->set_rules('harga', 'total harga', 'required');
		$this->form_validation->set_rules('ongkir', 'ongkir', 'required');
		$this->form_validation->set_rules('transfer', 'transfer', 'required');
		$this->form_validation->set_rules('diskon', 'diskon', 'required');
		$this->form_validation->set_rules('unik', 'angka unik', 'required');
		// $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
		// $this->form_validation->set_rules('image', 'image', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->data = array(
				'judul' => 'Tambah Pesanan',
				'juragan' => $juragan,
				'id_juragan' => $this->juragan->_id($juragan)
				);

			$this->load->view('cs/header', $this->data);
			$this->load->view('cs/pesanan/tambah', $this->data);
			$this->load->view('cs/footer', $this->data);
		}
		else {
			// $juragan = $this->input->post('juragan');
			$nama = $this->input->post('nama');
			$hp = $this->input->post('hp');
			$alamat = $this->input->post('alamat');
			$kode = $this->input->post('kode');
			$size = $this->input->post('size');
			$harga_a = $this->input->post('harga_a');
			$jumlah = $this->input->post('jumlah');
			$status_transfer = $this->input->post('status_transfer');
			$bank = $this->input->post('bank');
			$harga = $this->input->post('harga');
			$ongkir = $this->input->post('ongkir');
			$transfer = $this->input->post('transfer');
			$diskon = $this->input->post('diskon');
			$unik = $this->input->post('unik');
			$keterangan = $this->input->post('keterangan');
			$image = $this->input->post('image');

			$data = array();

			$pemesan = array(
				'n' => $nama,
				'p' => $hp,
				'a' => $alamat
				);

			// terkait uang
			$biaya['m']['h'] = (int) $harga;
			$biaya['m']['t'] = (int) $transfer;
			if((int) $ongkir > 0) {
				$biaya['m']['o'] = (int) $ongkir;
			}
			if((int) $diskon > 0) {
				$biaya['m']['d'] = (int) $diskon;
			}
			if((int) $unik > 0) {
				$biaya['m']['u'] = (int) $unik;
			}
			// bank
			$biaya['b'] = $bank;
			$biaya['s'] = $status_transfer;

			$ket_data = array();
			$count = 0;
			for ($i = 0; $i < count($kode) ; $i++) { 
				$ket_data['p'][$i]['c'] = $kode[$i];
				$ket_data['p'][$i]['s'] = $size[$i];
				$ket_data['p'][$i]['q'] = (int) $jumlah[$i];
				$ket_data['p'][$i]['h'] = (int) $harga_a[$i];
				$count = $count + (int) $jumlah[$i];
			}

			if( ! empty($keterangan)) {
				$ket_data['n'] = $keterangan;
			}

			if( ! empty($image) OR $image !== '[]') {
				$ket_data['i'] = json_decode($image);
			}

			$username = $this->session->username;
			$juragan_id = $this->juragan->_id($juragan);

			$data = array(
				'oleh' => $this->pengguna->_id($username),
				'juragan' => $juragan_id,
				'tanggal_submit' => time(),
				'pemesan' => json_encode($pemesan),
				'biaya' =>  json_encode($biaya),
				'detail' => json_encode($ket_data),
				'count' => $count,
				'slug' => (mdate('%Y', time()) . uniqid())
				);

			$this->pesanan->simpan($data);

			redirect($juragan);
			
		}
	}

	public function sunting() {
		$en_id = $this->input->get('id');
		$id = save_url_decode($en_id);

		$slug = $this->pesanan->_slug($id);

		// cek ketersediaan data di database
		$cek = $this->pesanan->cek($slug);

		if($cek) {
			//$this->form_validation->set_rules('juragan', 'juragan', 'required|greater_than[0]');
			$this->form_validation->set_rules('nama', 'nama lengkap', 'required');
			$this->form_validation->set_rules('hp[]', 'hp', 'required');
			$this->form_validation->set_rules('alamat', 'alamat', 'required');
			$this->form_validation->set_rules('kode[]', 'kode', 'required');
			$this->form_validation->set_rules('size[]', 'size', 'required');
			$this->form_validation->set_rules('harga_a[]', 'harga_a', 'required');
			$this->form_validation->set_rules('jumlah[]', 'jumlah', 'required');
			$this->form_validation->set_rules('status_transfer', 'status_transfer', 'required');
			$this->form_validation->set_rules('bank', 'bank', 'required');
			$this->form_validation->set_rules('harga', 'total harga', 'required');
			$this->form_validation->set_rules('ongkir', 'ongkir', 'required');
			$this->form_validation->set_rules('transfer', 'transfer', 'required');
			$this->form_validation->set_rules('diskon', 'diskon', 'required');
			$this->form_validation->set_rules('unik', 'angka unik', 'required');
			// $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
			// $this->form_validation->set_rules('image', 'image', 'required');

			// ambil slug juragan 
			$id_juragan = $this->pesanan->ambil_id_juragan($slug);
			$juragan = $this->juragan->_slug($id_juragan);
			$nama_juragan = $this->juragan->_nama($id_juragan);

			if ($this->form_validation->run() === FALSE) {
				$this->data = array(
					'judul' => 'Sunting Pesanan <small>' . $nama_juragan . '</small>',
					'juragan' => $juragan,
					'pesanan' => $this->pesanan->_detail($slug)->row()
					// 'select' => ($juragan === 'semua' ? TRUE : FALSE)
					);

				$this->load->view('cs/header', $this->data);
				$this->load->view('cs/pesanan/sunting', $this->data);
				$this->load->view('cs/footer', $this->data);
			}
			else {
				//$juragan = $this->input->post('juragan');
				$nama = $this->input->post('nama');
				$hp = $this->input->post('hp');
				$alamat = $this->input->post('alamat');
				$kode = $this->input->post('kode');
				$size = $this->input->post('size');
				$harga_a = $this->input->post('harga_a');
				$jumlah = $this->input->post('jumlah');
				$status_transfer = $this->input->post('status_transfer');
				$bank = $this->input->post('bank');
				$harga = $this->input->post('harga');
				$ongkir = $this->input->post('ongkir');
				$transfer = $this->input->post('transfer');
				$diskon = $this->input->post('diskon');
				$unik = $this->input->post('unik');
				$keterangan = $this->input->post('keterangan');
				$image = $this->input->post('image');

				$ambil = $this->pesanan->_detail($slug)->row();
				$money = json_decode($ambil->biaya);
				$detail = json_decode($ambil->detail);

				$data = array();

				$pemesan = array(
					'n' => $nama,
					'p' => $hp,
					'a' => $alamat
					);

				// terkait uang
				$biaya['m']['h'] = (int) $harga;
				$biaya['m']['t'] = (int) $transfer;
				if((int) $ongkir > 0) {
					$biaya['m']['o'] = (int) $ongkir;
				}
				if((int) $diskon > 0) {
					$biaya['m']['d'] = (int) $diskon;
				}
				if((int) $unik > 0) {
					$biaya['m']['u'] = (int) $unik;
				}
				if(isset($money->m->of)) {
					$biaya['m']['of'] = $money->m->of;
				}

				// bank
				$biaya['b'] = $bank;
				$biaya['s'] = $status_transfer;


				$ket_data = array();
				if(isset($detail->s)) {
					$ket_data['s'] = (array) $detail->s;
				}

				if(isset($detail->m)) {
					$ket_data['m'] = $detail->m;
				}

				$count = 0;
				for ($i = 0; $i < count($kode) ; $i++) { 
					$ket_data['p'][$i]['c'] = $kode[$i];
					$ket_data['p'][$i]['s'] = $size[$i];
					$ket_data['p'][$i]['q'] = (int) $jumlah[$i];
					$ket_data['p'][$i]['h'] = (int) $harga_a[$i];
					$count = $count + (int) $jumlah[$i];
				}

				if( ! empty($keterangan)) {
					$ket_data['n'] = $keterangan;
				}

				if( ! empty($image) && $image !== '[]') {
					$ket_data['i'] = json_decode($image);
				}

				$data = array(
					'pemesan' => json_encode($pemesan),
					'biaya' =>  json_encode($biaya),
					'detail' => json_encode($ket_data),
					'count' => $count

					);

				$this->pesanan->update($slug, $data);
				redirect('admin/pesanan');
			}
		}
		else {
			show_404();
		}
	}


}
