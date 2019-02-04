<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends user_controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$id_ = $this->pengguna->_id($_SESSION['username']);
		$limit = $this->input->get('limit'); // limit tampil pesanan 
		$per_page = $this->input->get('halaman'); // halaman terkait
		
		$limit = 50;
		if( ! isset($per_page)) {
			$per_page = 0;
		}

		$config['base_url'] = site_url('cs/notifikasi');
		$config['total_rows'] = $this->faktur->notif($id_, FALSE, 'ya', FALSE)->num_rows();
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['query_string_segment'] = 'halaman';
		$config['reuse_query_string'] = TRUE;

		// inisialisasi pagination
		$this->pagination->initialize($config);

		$this->data = array(
			'judul' => 'Notifikasi',
			'notif' => $this->faktur->notif($id_, $limit, 'ya', $per_page)
			);

		$this->load->view('user/header', $this->data);
		$this->load->view('user/notifikasi', $this->data);
		$this->load->view('user/footer', $this->data);
	}

	public function read($id_tanggal) {
		$e = explode('_', $id_tanggal);
		$id = $e[0];
		$tanggal = $e[1];

		$detail_notif = $this->faktur->get_notif_detail($id, $tanggal);
		if ($detail_notif->num_rows() > 0) {
			$r = $detail_notif->row();

			$data = array(
				'dibaca' => '1'
			);
	
			$toggle = $this->faktur->edit_notif($r->id_notifikasi, $data);
			$slug = $this->juragan->_slug($r->juragan);

			redirect('myorder/'.$slug.'?cari[q]='. $r->url);
		}
		else {
			redirect('cs/notifikasi');
		}
	}

	public function toggle() {
		$id_notifikasi = $this->input->post('id_notifikasi'); //
		$baca = $this->input->post('baca'); //

		$data = array(
			'dibaca' => ($baca === '0'? '1': '0')
		);

		$toggle = $this->faktur->edit_notif($id_notifikasi, $data);

		$response = array(
			'toggle' => ($toggle? TRUE:FALSE),
			'text' => ($baca === '0'? 'Tandai belum dilihat': 'Tandai Sudah dilihat'),
			'baca' => ($baca === '0'? '1': '0')
		);
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function hapus() {
		$id_notifikasi = $this->input->post('id_notifikasi'); //
		$hapus = $this->faktur->del_notif($id_notifikasi);

		$response = array(
			'del' => ($hapus? TRUE:FALSE)
		);
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function count() {
		$id_ = $this->pengguna->_id($_SESSION['username']);
		$response = $this->faktur->notif($id_, FALSE, 'tidak', FALSE)->num_rows();

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function get() {
		$count = $this->input->get('count'); //
		$all = $this->input->get('all'); //

		$id_ = $this->pengguna->_id($_SESSION['username']);
		$q = $this->faktur->notif($id_, 5, 'tidak', FALSE);

		///
		$data = array();
		foreach ($q->result() as $notifikasi) {
			$url = site_url('cs/notifikasi/read/' . $notifikasi->id_notifikasi . '_' .  $notifikasi->tanggal);
			
			$nama = $this->pengguna->_nama_pengguna($notifikasi->dari);

			switch ($notifikasi->type) {
				case '2':
					$isi = 'Penambahan biaya pembayaran <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span>';
					$ico = '<i class="fas fa-wallet"></i>';
					break;
				
				case '3':
					$isi = 'Pembayaran pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> dicek masuk/ada';
					$ico = '<i class="fas fa-wallet"></i>';
					break;

				case '7':
					$isi = 'Pembayaran pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> dicek belum masuk/ada';
					$ico = '<i class="fas fa-wallet"></i>';
					break;
				
				case '4':
					$isi = 'Status paket pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> dibatalkan';
					$ico = '<i class="fas fa-box"></i>';
					break;

				case '5':
					$isi = 'Status paket pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> diproses';
					$ico = '<i class="fas fa-box"></i>';
					break;
				
				case '6':
					$isi = 'Status paket pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> belum diproses';
					$ico = '<i class="fas fa-box"></i>';
					break;

				case '8':
					$isi = 'Pesanan <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span> dikirim/diambil';
					$ico = '<i class="fas fa-plane-departure"></i>';
					break;
				
				default:
					$isi = 'Dibuat pesanan baru <span class="text-primary">'. strtoupper( $notifikasi->url ) .'</span>';
					$ico = '<i class="fas fa-file-signature"></i>';
					break;
			}

			$data[] = array(
				'data' => '<a href="'. $url .'" class="small list-group-item list-group-item-action '.($notifikasi->dibaca === '0'? 'font-weight-bold':'').'"><div class="d-flex w-100 justify-content-between"><p class="mb-0">'.$ico.' ' .$isi.'</p></div><small class="text-muted">'. mdate('%d-%m-%Y %H:%i:%s', $notifikasi->tanggal) .'</small></a>'
			);
		}

		$response = array(
			'total' => $this->faktur->notif($id_, FALSE, 'ya', FALSE)->num_rows(),
			'data' => $data
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

}
