<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pesanan extends admin_controller
{

	public function __construct() {
		parent::__construct();
		
	}

	public function lihat($juragan = 'semua', $status = 'all') {
		$limit_en = $this->input->get('limit');
		$per_page = $this->input->get('halaman');
		$cari = $this->input->get('cari');

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
		$juragan_ada = $this->juragan->cek($juragan);

		// jika $status ('all', 'pending', 'terkirim') dan $juragan tersedia
		if(in_array($status, array('all', 'pending', 'terkirim')) && ($juragan_ada OR $juragan === 'semua') ) {

			$id_juragan = $this->juragan->_id($juragan);

			$query = $this->pesanan->ambil_semua($id_juragan, FALSE, $status, $limit, $per_page, $cari);

			$config['base_url'] = site_url('admin/pesanan/lihat/' . $juragan .'/' . $status);
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

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/pesanan/lihat', $this->data);
			$this->load->view('admin/footer', $this->data);
		}
		else {
			show_404();
		}		
	}

	public function set($page = '') {
		if( ! empty($page) && in_array($page, array('transfer', 'kirim'))) {
			if($page === 'transfer') {
				$this->form_validation->set_rules('slug', 'slug', 'required');
				$this->form_validation->set_rules('transfer', 'transfer', 'required');

				if ($this->form_validation->run() === FALSE) {
					$response['status'] = 'gagal';
				}
				else {
					$slug_enc = $this->input->post('slug');
					$transfer = $this->input->post('transfer');
					$current = $this->input->post('current');

					$slug = save_url_decode($slug_enc);
					$s = $this->pesanan->set_transfer($slug, $transfer);
					$response['status'] = ($s ? 'sukses' : 'gagal');

					$invoice = $this->pesanan->invoice_id($slug);

					$response['message'] = 'Pesanan dengan invoice #' . $invoice . ' dikonfirmasi bahwa ' . ($transfer === 'ada'? 'sudah': 'belum' ) . ' ada transferan masuk!';
				}
			}
			else {
				// page kirim
				$this->form_validation->set_rules('slug', 'slug', 'required');
				$this->form_validation->set_rules('kirim', 'kirim', 'required|in_list[pending,terkirim]');

				if ($this->form_validation->run() === FALSE) {
					$response['status'] = 'gagal';
					$response['message'] = 'Ada kesalahan!';
				}
				else {
					$slug_enc = $this->input->post('slug');
					$kirim = $this->input->post('kirim');
					$current = $this->input->post('current');
					$tanggal = $this->input->post('tanggal');
					$resi = $this->input->post('resi');
					$ongkir = $this->input->post('ongkir');
					$kurir = $this->input->post('kurir');

					$tanggal_unix = strtotime($tanggal);

					$slug = save_url_decode($slug_enc);
					
					if($kirim === 'pending') {
						$s = $this->pesanan->set_kirim($slug, $kirim);
						$response['status'] = ($s ? 'sukses' : 'gagal');
					}
					else {
						// set kiri dengan input resi
						$set_kirim = $this->pesanan->set_kirim($slug, 'terkirim', $tanggal_unix);

						if($set_kirim) {
							$response['status'] = ($set_kirim ? 'sukses' : 'gagal');
							$data = array(
								'k' => $kurir,
								'n' => $resi,
								'd' => $tanggal_unix
								);

							$this->pesanan->submit_resi($slug, $data);
							$this->pesanan->set_ongkir_fix($slug, $ongkir);
						}
					}

					$invoice = $this->pesanan->invoice_id($slug);
					$response['message'] = 'Pesanan dengan invoice #' . $invoice . ' dikonfirmasi bahwa ' . ($kirim === 'terkirim'? 'sudah': 'belum' ) . ' dikirim!';
				}
			}
		}
		else {
			$response = 'res';
		}

		$response['url'] = $current;

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function tambah($juragan = 'semua') {
		$this->form_validation->set_rules('juragan', 'juragan', 'required|greater_than[0]');
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

			$this->load->view('admin/header', $this->data);
			$this->load->view('admin/pesanan/tambah', $this->data);
			$this->load->view('admin/footer', $this->data);
		}
		else {
			$juragan = $this->input->post('juragan');
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

			// $keterangan['p'] = $dp;
			if( ! empty($keterangan)) {
				$ket_data['n'] = $keterangan;
			}

			$gmb = json_decode($image);

			if( ! empty($gmb)) {
				$ket_data['i'] = $gmb;
			}

			$data = array(
				'juragan' => $juragan,
				'tanggal_submit' => time(),
				'pemesan' => json_encode($pemesan),
				'biaya' =>  json_encode($biaya),
				'detail' => json_encode($ket_data),
				'count' => $count,
				'slug' => (mdate('%Y', time()) . uniqid())
				);

			$this->pesanan->simpan($data);

			redirect('admin/pesanan');
			
		}
	}

	public function sunting() {
		$en_id = $this->input->get('id');
		$slug = save_url_decode($en_id);

		// cek ketersediaan data di database
		$cek = $this->pesanan->cek($slug);

		if($cek) {
			$this->form_validation->set_rules('juragan', 'juragan', 'required|greater_than[0]');
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

				$this->load->view('admin/header', $this->data);
				$this->load->view('admin/pesanan/sunting', $this->data);
				$this->load->view('admin/footer', $this->data);
			}
			else {
				$juragan = $this->input->post('juragan');
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

				$gmb = json_decode($image);

				if( ! empty($gmb)) {
					$ket_data['i'] = $gmb;
				}

				$data = array(
					'juragan' => $juragan,
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

	public function hapus() {
		$en_id = $this->input->post('slug');
		$current = $this->input->post('current');

		if( isset($en_id) && isset($current) ) {

			$slug = save_url_decode($en_id);

			// cek ketersediaan data di database
			$cek = $this->pesanan->cek($slug);

			if($cek) {
				// delete on database
				$del = $this->pesanan->delete($slug);				

				$response['status'] = ($del ? 'sukses' : 'gagal');
				$response['message'] = ($del ? 'Pesanan Berhasil dihapus!' : 'Pesanan gagal dihapus!');
			}
			
			$response['url'] = $current;

		}
		else {
			$response['status'] = 'Error';
			$response['message'] = 'Unknown Access';
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

}
