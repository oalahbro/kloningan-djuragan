<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur extends CI_Controller {

    private $template;

	public function __construct() {
        parent::__construct();
        if( ! $this->session->logged) {
            redirect('');
        }
        else {
            switch ($this->session->level) {
                case 'superadmin':
                case 'admin':
                $this->template = 'admin';
                    break;
                
                case 'cs':
                $this->template = 'cs';
                    break;
                
                default:
                    $this->template = 'reseller';
                    break;
            }
        }
    }

    public function index() {
        switch ($this->session->level) {
            case 'superadmin':
            case 'admin':
                redirect('pesanan/s_juragan');
                break;
            
            case 'cs':
                $user_slug = $this->session->username;
                $juragan = $this->pengguna->_juragan_terakhir($user_slug);
                $juragan = $this->juragan->_slug($juragan);
                redirect('pesanan/' . $juragan);
                break;
            
            default:
                # code...
                break;
        }
	}

	// ambil data juragan
	public function get_juragan() {
		$jur = $this->juragan->_semua()->result();

		$data = array();
		foreach ($jur as $juragan) {
			$data[] = array(
				'nama' => $juragan->nama,
				'slug' => $juragan->slug
			);
		}

		$response = array(
			'data' => $data
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

    public function arsip($juragan) {
        $limit      = $this->input->get('limit'); // limit tampil pesanan 
        $per_page   = $this->input->get('halaman'); // halaman terkait
		$cari       = $this->input->get('cari'); // cari data

		$juragan_id = $this->juragan->_id($juragan);
		if ($juragan !== 's_juragan') {
			$nama_juragan = $this->juragan->_nama($juragan_id);
		}
		else {
			$nama_juragan = 'Semua Juragan';
		}

		$limit = 30;
		if( ! isset($per_page)) {
			$per_page = 0;
		}

		$config['base_url'] = site_url('faktur/arsip/' . $juragan);
		$config['total_rows'] = $this->faktur->get_all($juragan_id, $by = FALSE, FALSE, FALSE, $cari)->num_rows();
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['query_string_segment'] = 'halaman';
		$config['reuse_query_string'] = TRUE;

		// inisialisasi pagination
		$this->pagination->initialize($config);

		$this->data = array(
			'judul' => 'Pesanan ' . $nama_juragan,
			'juragan' => $juragan,
            'query' => $this->faktur->get_all($juragan_id, $by = FALSE, $limit, $per_page, $cari)
			);

		$this->load->view($this->template . '/pesanan', $this->data);
	}

	public function json_juragan($id_faktur) {
		$id_juragan = $this->faktur->get_info($id_faktur, 'juragan_id');
		$id_pengguna = $this->faktur->get_info($id_faktur, 'pengguna_id');

		$response['nama'] = $this->juragan->_nama($id_juragan);
		$response['slug'] = $this->juragan->_slug($id_juragan);
		$response['nama_cs'] = $this->pengguna->_nama_pengguna($id_pengguna);
		
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function json_pembayaran($id_faktur) {
		$pembayaran = $this->faktur->get_pays($id_faktur);
		$produk_db = $this->faktur->get_orders($id_faktur);
		$fktr = $this->faktur->get_custom_info($id_faktur, 'tipe, seri_faktur, status_transfer, status_paket,status_kirim,status_kiriman');

		$total = 0;
		if ($fktr->tipe !== NULL) {
			$response['tipe'] = $fktr->tipe;
		}
		
		foreach ($produk_db->result() as $produk) {
			$total += $produk->jumlah;
			$response['produk'][] = array(
				'c' => strtoupper($produk->kode),
				's' => strtoupper($produk->ukuran),
				'q' => (int) $produk->jumlah
			);
		}

		$response['total'] = $total;

		$terbayar = 0;
        $belum_dibayar = 0;
        $total_harga_produk = 0;
		$tanggal_cek = 0;

		$seri_faktur = $fktr->seri_faktur;
		$status_transfer = $fktr->status_transfer;
		$status_paket = $fktr->status_paket;
		$status_kirim = $fktr->status_kirim;
		$status_kiriman = $fktr->status_kiriman;

		$response['id_faktur'] = (int) $id_faktur;
		$response['seri_faktur'] = strtoupper($seri_faktur);
		$response['status_transfer'] = $status_transfer;
		$response['status_paket'] = $status_paket;
		$response['status_kirim'] = $status_kirim;
		$response['status_kiriman'] = $status_kiriman;

		if ($pembayaran->num_rows() > 0) {
            foreach ($pembayaran->result() as $bayar) {
                if($bayar->tanggal_cek !== NULL) {
                    $terbayar += $bayar->jumlah;
                }
                else {
                    $belum_dibayar++;
                }
                $tanggal_cek = $bayar->tanggal_cek;
            }
		}

		// get price
        $prod = $this->faktur->get_orders($id_faktur);
        foreach ($prod->result() as $produk) {
            $total_harga_produk += ($produk->jumlah * $produk->harga);
        }

        // discount
		$diskon = $this->faktur->get_biaya($id_faktur, 'diskon');
		if($diskon > 0) {
			$response['diskon'] = harga($diskon);
		}

        // unik
		$unik = $this->faktur->get_biaya($id_faktur, 'unik');
		if($unik > 0) {
			$response['unik'] = harga($unik);
		}

        // ongkir
		$ongkir = $this->faktur->get_biaya($id_faktur, 'ongkir');
		if($ongkir > 0) {
			$response['ongkir'] = harga($ongkir);
		}

        // total wajib bayar
		$wajib_bayar = $total_harga_produk + $unik + $ongkir - $diskon;
		$response['wajib_bayar'] = harga($wajib_bayar);

		if($wajib_bayar > $terbayar && $terbayar > 0) {
			$status_bayar = 1; // kredit
		}
		else if($wajib_bayar === $terbayar) {
			$status_bayar = 2; // lunas
		}
		else if($wajib_bayar < $terbayar) {
			$status_bayar = 3; // kelebihan
		}
		else {
			$status_bayar = 4; // lunas
		}
		$response['status'] = $status_bayar;

		//
		$response['harga_produk'] = harga($total_harga_produk);
		if($terbayar > 0) {
			$response['terbayar'] = harga($terbayar);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function json_keterangan($id_faktur) {
		$keterangan = $this->faktur->get_info($id_faktur, 'keterangan');
		$gambar = $this->faktur->get_info($id_faktur, 'gambar');
		$pengiriman = $this->faktur->get_carry($id_faktur);
		$html = '';

		$response['id'] = (int) $id_faktur;

		if ($keterangan !== NULL) {
			$response['ket'] = nl2br($keterangan);
		}

		if($pengiriman->num_rows() > 0) {
			foreach ($pengiriman->result() as $kirim) {
				$html .= '<li><span class="font-weight-bold">' . strtoupper($kirim->kurir) . '</span>';
				$html .= '<br/>' . $kirim->resi;
				$html .= '<br/><small class="text-muted">tanggal: ' . mdate('%d-%m-%Y', $kirim->tanggal_kirim) . '</small>';
				$html .= ($kirim->ongkir > 0? '<br/>ongkir: <span class="badge badge-secondary">' . harga($kirim->ongkir) . '</span>': '');
				$html .= '</li>';

				$response['pengiriman'][] = array(
					'c' => strtoupper($kirim->kurir),
					'r' => strtoupper($kirim->resi),
					'd' => mdate('%d-%m-%Y', $kirim->tanggal_kirim),
					'o' => ($kirim->ongkir > 0? harga($kirim->ongkir): NULL)
				);
			}
		}

		if($gambar !== NULL) {
			$i = 1;
			$gmb= json_decode($gambar);
			foreach ($gmb as $image) {
				$response['gambar'][] = $image;
			}
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
	
	public function ambil_pembayaran() {
		$id = $this->input->get('id');

		$q = $this->faktur->get_pays($id);

		$data = array();
		foreach ($q->result() as $bayar) {
			$data[] = array(
				'id' => (int) $bayar->id_pembayaran,
				'rekening' => $bayar->rekening,
				'jumlah' => harga($bayar->jumlah),
				'tanggal_bayar' => mdate('%d-%m-%Y', $bayar->tanggal_bayar),
				'tanggal_cek' => ( $bayar->tanggal_cek !== NULL ? mdate('%d-%m-%Y', $bayar->tanggal_cek) : NULL)
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

    public function tambah_pembayaran() {
		$this->form_validation->set_rules('faktur_id', 'Faktur ID', 'required');
		$this->form_validation->set_rules('rek', 'Rekening', 'required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'greater_than[0]|required');
		$this->form_validation->set_rules('tanggal_bayar', 'Tanggal Bayar', 'required|regex_match["[0-9]{4}-[0-9]{2}-[0-9]{2}"]');
		$this->form_validation->set_rules('ada_dana', 'Dana Ada Cek', 'in_list[tidak,ya]');
		$this->form_validation->set_rules('tanggal_cek', 'Dana Dicek', 'regex_match["[0-9]{4}-[0-9]{2}-[0-9]{2}"]');

		if ($this->form_validation->run() == FALSE) {
			$status = 500;
			$response = array();
		}
		else {
			$faktur_id = $this->input->post('faktur_id');
			$rekening = $this->input->post('rek');
			$jumlah = $this->input->post('nominal');
			$tanggal_bayar = $this->input->post('tanggal_bayar');
			$ada_dana = $this->input->post('ada_dana');
			$tanggal_cek = $this->input->post('tanggal_cek');

			$data = array();
			$dicek = array();
			
			$didata = array(
				'tanggal_bayar' => strtotime($tanggal_bayar),
				'faktur_id' => $faktur_id,
				'jumlah' => $jumlah,
				'rekening' => $rekening
			);
			
			$bayar_id = $this->faktur->_primary('pembayaran', 'id_pembayaran');
			if ((int) $bayar_id !== 0) {
				$didata['id_pembayaran'] = $bayar_id;
			}

			if ($ada_dana === 'ya' && $tanggal_cek !== '') {
				$didata['tanggal_cek'] = strtotime($tanggal_cek . ' ' . mdate('%H:%i:%s', now()));
			}

			$data[] = $didata;

			$this->faktur->sub_pay($data);
			$this->faktur->calc_pembayaran($faktur_id);

			$seri_faktur = $this->faktur->get_info($faktur_id, 'seri_faktur');
			$juragan_id = $this->faktur->get_info($faktur_id, 'juragan_id');
			$this->notifikasi->set($_SESSION['userid'], '2', $juragan_id, $seri_faktur, 'cs');

			$status = 200;
			$response = array(
				'status' => true,
				'title' => 'Pembayaran',
				'faktur_id' => $faktur_id,
				'seri_faktur' => strtoupper( $seri_faktur ),
				'alert' => 'Data pembayaran untuk ' . strtoupper( $seri_faktur ). ' telah ditambahkan'
			);
		}

		$this->output
			->set_status_header($status)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function simpan_pembayaran() {
		$this->form_validation->set_rules('faktur_id', 'Faktur ID', 'required');
		$this->form_validation->set_rules('id_pembayaran', 'Pembayaran ID', 'required');
		$this->form_validation->set_rules('rek', 'Rekening', 'required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'greater_than[0]|required');
		$this->form_validation->set_rules('tanggal_bayar', 'Tanggal Bayar', 'required|regex_match["[0-9]{4}-[0-9]{2}-[0-9]{2}"]');
		$this->form_validation->set_rules('ada_dana', 'Dana Ada Cek', 'in_list[tidak,ya]');
		$this->form_validation->set_rules('tanggal_cek', 'Dana Dicek', 'regex_match["[0-9]{4}-[0-9]{2}-[0-9]{2}"]');

		if ($this->form_validation->run() == FALSE) {
			$status = 500;
			$response = array();
		}
		else {
			$faktur_id = $this->input->post('faktur_id');
			$id_pembayaran = $this->input->post('id_pembayaran');
			$rekening = $this->input->post('rek');
			$jumlah = $this->input->post('nominal');
			$tanggal_bayar = $this->input->post('tanggal_bayar');
			$ada_dana = $this->input->post('ada_dana');
			$tanggal_cek = $this->input->post('tanggal_cek');

			$data = array();
			$dicek = array();
			
			$didata = array(
				'tanggal_bayar' => strtotime($tanggal_bayar),
				'jumlah' => $jumlah,
				'rekening' => $rekening,
				'tanggal_cek' => (!empty($tanggal_cek)? strtotime($tanggal_cek . ' ' . mdate('%H:%i:%s', now())): NULL )
			);

			$data = $didata;

			$this->faktur->update_pay($id_pembayaran, $data);
			$this->faktur->calc_pembayaran($faktur_id);

			$seri_faktur = $this->faktur->get_info($faktur_id, 'seri_faktur');
			// $juragan_id = $this->faktur->get_info($faktur_id, 'juragan_id');
			// $this->notifikasi->set($_SESSION['userid'], '2', $juragan_id, $seri_faktur, 'cs');

			$status = 200;
			$response = array(
				'status' => true,
				'title' => 'Pembayaran',
				'faktur_id' => $faktur_id,
				'seri_faktur' => strtoupper( $seri_faktur ),
				'alert' => 'Data pembayaran untuk ' . strtoupper( $seri_faktur ). ' telah disunting'
			);
		}

		$this->output
			->set_status_header($status)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function check_pembayaran() {
		$id_pembayaran = $this->input->post('id_pembayaran');
		$id_faktur = $this->input->post('id_faktur');
		$check = $this->input->post('check');

		$data = array('tanggal_cek' => ($check === 'ya'? now(): NULL));
		$this->faktur->update_pay($id_pembayaran, $data);

		$this->faktur->calc_pembayaran($id_faktur);

		$seri_faktur = $this->faktur->get_info($id_faktur, 'seri_faktur');

		$juragan_id = $this->faktur->get_info($id_faktur, 'juragan_id');
		$this->notifikasi->set($_SESSION['userid'], ($check === 'ya'? 3: 7), $juragan_id, $seri_faktur, 'cs');

		$response = array(
			'title' => 'Pembayaran',
			'faktur_id' => $id_faktur,
			'seri_faktur' => strtoupper( $seri_faktur ),
			'alert' => 'Data pembayaran untuk ' . strtoupper( $seri_faktur ). ' telah dicek "' . ($check === 'ya'? 'masuk': 'belum masuk') . '"'
		);
		
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function detail_pembayaran($id_pembayaran) {
		$q = $this->faktur->get_pay($id_pembayaran)->row();

		$response = array(
			'tanggal_bayar' => mdate('%Y-%m-%d', $q->tanggal_bayar),
			'faktur_id' => (int) $q->faktur_id,
			'jumlah' => (int) $q->jumlah,
			'rekening' => $q->rekening,
			'tanggal_cek' => ($q->tanggal_cek !== NULL? mdate('%Y-%m-%d', $q->tanggal_cek) : NULL)
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function hapus_pembayaran() {
		$id_pembayaran = $this->input->post('idpembayaran');

		$id_faktur = $this->faktur->get_pay($id_pembayaran)->row()->faktur_id;

		$this->faktur->del_pay($id_pembayaran);
		$this->faktur->calc_pembayaran($id_faktur);

		$seri_faktur = $this->faktur->get_info($id_faktur, 'seri_faktur');

		$response = array(
			'title' => 'Pembayaran',
			'faktur_id' => (int) $id_faktur,
			'seri_faktur' => strtoupper( $seri_faktur ),
			'alert' => 'Data pembayaran untuk ' . strtoupper( $seri_faktur ). ' telah dihapus'
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function ubah_paket() {
		$faktur_id = $this->input->post('faktur_id');
		$status = $this->input->post('status');
		
		switch ($status) {
			case '2':
				# code...
				$stt = 'dibatalkan';
				$notif_code = 4;
				break;
			
			case '1':
				# code...
				$stt = 'diproses';
				$notif_code = 5;
				break;

			default:
				# code...
				$stt = 'belum diproses';
				$notif_code = 6;
				break;
		}

		$seri_faktur = $this->faktur->get_info($faktur_id, 'seri_faktur');
		$juragan_id = $this->faktur->get_info($faktur_id, 'juragan_id');
		$this->notifikasi->set($_SESSION['userid'], $notif_code, $juragan_id, $seri_faktur, 'cs');

		$this->faktur->set_package($faktur_id, $status);
		$data = array(
			'title' => 'Update status paket',
			'alert' => 'Status Paket faktur ' . strtoupper( $seri_faktur ) . ' telah menjadi "' . $stt . '"'
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
}
