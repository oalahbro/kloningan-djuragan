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
}
