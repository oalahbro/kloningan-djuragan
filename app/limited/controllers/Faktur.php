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
					
				case 'viewer':
				$this->template = 'viewer';
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
			case 'viewer':
                redirect('faktur/data/s_juragan');
                break;
            
            case 'cs':
                $user_slug = $this->session->username;
                $juragan = $this->pengguna->_juragan_terakhir($user_slug);
                $juragan = $this->juragan->_slug($juragan);
                redirect('faktur/data/' . $juragan);
                break;
            
            default:
                # code...
                break;
        }
	}

	public function data($juragan) {
		$juragan_id = $this->juragan->_id($juragan);
		if ($juragan !== 's_juragan') {
			$nama_juragan = $this->juragan->_nama($juragan_id);
		}
		else {
			$nama_juragan = 'Semua Juragan';

			if ($this->session->level === 'cs') {
				redirect('pesanan');
			}
		}

        $limit      = $this->input->get('limit'); // limit tampil pesanan 
        $per_page   = $this->input->get('halaman'); // halaman terkait
		$cari       = $this->input->get('cari'); // cari data

		$limit = 25;
		if( ! isset($per_page)) {
			$per_page = 0;
		}

		$config['base_url'] = site_url('faktur/data/' . $juragan);
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
			'include' => $this->template,
            'query' => $this->faktur->get_all($juragan_id, $by = FALSE, $limit, $per_page, $cari)
			);

		$this->load->view('pesanan-lihat', $this->data);
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

	public function sunting($faktur) {
		$this->form_validation->set_rules('juragan_id', 'Juragan', 'required|greater_than[0]');
		$this->form_validation->set_rules('pengguna_id', 'Pengguna', 'required|greater_than[0]');
		$this->form_validation->set_rules('nama', 'nama lengkap', 'required');
		$this->form_validation->set_rules('hp1', 'hp 1', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('marketplace', 'marketplace', '');
		$this->form_validation->set_rules('ongkir', 'ongkir', 'required');
		$this->form_validation->set_rules('diskon', 'diskon', 'required');
		$this->form_validation->set_rules('unik', 'angka unik', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->data = array(
				'judul' => 'Sunting Pesanan',
				'sub_judul' => strtoupper($faktur),
				'q' => $this->faktur->get_detail($faktur)
				);
			
			$this->load->view($this->template . '/pesanan-sunting', $this->data);
		}
		else {
			//
			$id_faktur = $this->input->post('id_faktur');
			$id_juragan = $this->input->post('juragan_id');
			$tanggal_dibuat = $this->input->post('tanggal_dibuat');
			$tanggal_paket = $this->input->post('tanggal_paket');
			$waktu_dibuat = $this->input->post('waktu_dibuat');
			$pengguna_id = $this->input->post('pengguna_id');
			$nama = $this->input->post('nama');
			$hp1 = $this->input->post('hp1');
			$hp2 = $this->input->post('hp2');
			$alamat = $this->input->post('alamat');
			$produk = $this->input->post('produk'); // array
			$diskon = $this->input->post('diskon');
			$ongkir = $this->input->post('ongkir');
			$unik = $this->input->post('unik');
			$status_paket = $this->input->post('status_paket');
			$pembayaran_ = $this->input->post('pembayaran_');
			$pembayaran = $this->input->post('pembayaran'); // array
			$pengiriman = $this->input->post('pengiriman'); // array
			$pengiriman_selesai = $this->input->post('pengiriman_selesai');	
			$pengiriman_ = $this->input->post('pengiriman_');
			$marketplace_ = $this->input->post('marketplace_');
			$marketplace = $this->input->post('marketplace');
			$keterangan = $this->input->post('keterangan');
			$image = $this->input->post('image');

			$data = array();
			// ----------------------------------------- PRODUK
			$produk_database = array();
			$produk_submit = array();
			$the_produk = $this->faktur->get_orders($id_faktur)->result();

			foreach ($the_produk as $prdb) {
				$produk_database[] = $prdb->id_pesanproduk; 
			}

			$i = 0;
			$produk_update = array();
			$produk_insert = array();
			$produk_delete = array();
			foreach ($produk as $key) {
				// update to `pesanan_produk`
				if(isset($key['id_pesanproduk'])) {
					$produk_submit[] = $key['id_pesanproduk'];

					$produk_update[$i]['id_pesanproduk'] = $key['id_pesanproduk'];
					$produk_update[$i]['kode'] = $key['kode'];
					$produk_update[$i]['ukuran'] = $key['ukuran'];
					$produk_update[$i]['jumlah'] = $key['jumlah'];
					$produk_update[$i]['harga'] = $key['harga'];

					$this->faktur->edit_order($key['id_pesanproduk'], $produk_update[$i]);
				}
				else {
					$pesprd_id = $this->faktur->_primary('pesanan_produk', 'id_pesanproduk', count($produk), $i);
					if ((int) $pesprd_id !== 0) {
						$produk_insert[$i]['id_pesanproduk'] = $pesprd_id;
					}
					$produk_insert[$i]['faktur_id'] = $id_faktur;
					$produk_insert[$i]['kode'] = $key['kode'];
					$produk_insert[$i]['ukuran'] = $key['ukuran'];
					$produk_insert[$i]['jumlah'] = $key['jumlah'];
					$produk_insert[$i]['harga'] = $key['harga'];
					
					$this->faktur->add_order($produk_insert[$i]);
				}
				$i++;
			}
			$data['produk']['diupdate'] = $produk_update;
			$data['produk']['ditambah'] = $produk_insert;

			$produk_del = array_diff($produk_database,$produk_submit);
			foreach ($produk_del as $id) {
				$result[] = $id;
				$this->faktur->delete_order($id);
			}
			$data['produk']['dihapus'] = $produk_del;

			// ----------------------------------------- PEMBAYARAN 
			if($pembayaran_ !== 'ya') {
				$pembayaran_database = array();
				$pembayaran_submit = array();
				$the_bayar = $this->faktur->get_pays($id_faktur)->result();

				foreach ($the_bayar as $prdb) {
					$pembayaran_database[] = $prdb->id_pembayaran; 
				}

				$i = 0;
				$pembayaran_update = array();
				$pembayaran_insert = array();
				$pembayaran_delete = array();
				foreach ($pembayaran as $key) {
					// update to `pembayaran`
					if(!empty($key['id_pembayaran'])) {
						$pembayaran_submit[] = $key['id_pembayaran'];

						$pembayaran_update[$i]['id_pembayaran'] = $key['id_pembayaran'];
						$pembayaran_update[$i]['tanggal_bayar'] = strtotime($key['tanggal']);
						$pembayaran_update[$i]['rekening'] = $key['rekening'];
						$pembayaran_update[$i]['jumlah'] = $key['jumlah'];
						$pembayaran_update[$i]['tanggal_cek'] = ( !empty($key['cek']) ? strtotime($key['cek']): NULL);

						$this->faktur->update_pay($key['id_pembayaran'], $pembayaran_update[$i]);
					}
					else {
						$byr_id = $this->faktur->_primary('pembayaran', 'id_pembayaran', count($pembayaran), $i);
						if ((int) $byr_id !== 0) {
							$pembayaran_insert[$i]['id_pembayaran'] = $byr_id;
						}
						$pembayaran_insert[$i]['faktur_id'] = $id_faktur;
						$pembayaran_insert[$i]['tanggal_bayar'] = strtotime($key['tanggal']);
						$pembayaran_insert[$i]['rekening'] = $key['rekening'];
						$pembayaran_insert[$i]['jumlah'] = $key['jumlah'];
						$pembayaran_insert[$i]['tanggal_cek'] = ( !empty($key['cek']) ? strtotime($key['cek']): NULL);
						
						$this->faktur->sub_pay_($pembayaran_insert[$i]);
					}
					$i++;
				}
				$data['pembayaran']['diupdate'] = $pembayaran_update;
				$data['pembayaran']['ditambah'] = $pembayaran_insert;

				if(count($pembayaran_insert) > 0) {
					$seri_faktur = $this->faktur->get_info($id_faktur, 'seri_faktur');
					$this->notifikasi->set($_SESSION['userid'], '2', $id_juragan, $seri_faktur, 'cs');
				}

				// $data['produk'] = $pembayaran_data;
				$pembayaran_del = array_diff($pembayaran_database, $pembayaran_submit);
				foreach ($pembayaran_del as $id) {
					$result[] = $id;
					$this->faktur->del_pay($id);
				}
				$data['pembayaran']['dihapus'] = $pembayaran_del;
			}
			else {
				// delete all pay
				$this->faktur->del_pays($id_faktur);
			}

			// ----------------------------------------- PENGIRIMAN 
			$kurir_terakhir = '';
			$tgl_kirim = 0;
			if($pengiriman_ === 'ya') {
				$pengiriman_database = array();
				$pengiriman_submit = array();
				$the_kirim = $this->faktur->get_carry($id_faktur)->result();

				foreach ($the_kirim as $prdb) {
					$pengiriman_database[] = $prdb->id_pengiriman; 
				}

				$i = 0;
				$pengiriman_update = array();
				$pengiriman_insert = array();
				$pengiriman_delete = array();
				
				foreach ($pengiriman as $key) {
					// update to `pembayaran`
					if(!empty($key['id_pengiriman'])) {
						$pengiriman_submit[] = $key['id_pengiriman'];

						$pengiriman_update[$i]['id_pengiriman'] = $key['id_pengiriman'];
						$pengiriman_update[$i]['kurir'] = $key['kurir'];
						$pengiriman_update[$i]['resi'] = $key['resi'];
						$pengiriman_update[$i]['ongkir'] = $key['ongkir'];
						$pengiriman_update[$i]['tanggal_kirim'] = ( !empty($key['tanggal_kirim']) ? strtotime($key['tanggal_kirim']): NULL);

						$this->faktur->update_carry($key['id_pengiriman'], $pengiriman_update[$i]);
						$tgl_kirim = ( !empty($key['tanggal_kirim']) ? strtotime($key['tanggal_kirim']): 0);
					}
					else {
						$kir_id = $this->faktur->_primary('pengiriman', 'id_pengiriman', count($pengiriman), $i);
						if ((int) $kir_id !== 0) {
							$pengiriman_insert[$i]['id_pengiriman'] = $kir_id;
						}
						$pengiriman_insert[$i]['faktur_id'] = $id_faktur;
						$pengiriman_insert[$i]['kurir'] = $key['kurir'];
						$pengiriman_insert[$i]['resi'] = $key['resi'];
						$pengiriman_insert[$i]['ongkir'] = $key['ongkir'];
						$pengiriman_insert[$i]['tanggal_kirim'] = ( !empty($key['tanggal_kirim']) ? strtotime($key['tanggal_kirim']): NULL);
						
						$this->faktur->sub_carry($pengiriman_insert[$i]);
						$tgl_kirim = ( !empty($key['tanggal_kirim']) ? strtotime($key['tanggal_kirim']): 0);
					}
					$kurir_terakhir = $key['kurir'];
					$i++;
				}
				$data['pengiriman']['diupdate'] = $pengiriman_update;
				$data['pengiriman']['ditambah'] = $pengiriman_insert;

				if(count($pengiriman_insert) > 0) {
					$seri_faktur = $this->faktur->get_info($id_faktur, 'seri_faktur');
					$this->notifikasi->set($_SESSION['userid'], '8', $id_juragan, $seri_faktur, 'cs');
				}

				// $data['produk'] = $pengiriman_data;
				$pengiriman_del = array_diff($pengiriman_database, $pengiriman_submit);
				foreach ($pengiriman_del as $id) {
					$result[] = $id;
					$this->faktur->del_carry_($id);
				}
				$data['pengiriman']['dihapus'] = $pengiriman_del;
			}

			$data['diskon'] = $diskon;
			$data['ongkir'] = $ongkir;
			$data['unik'] = $unik;

			$this->faktur->upset_biaya('diskon', $id_faktur, $diskon);
			$this->faktur->upset_biaya('ongkir', $id_faktur, $ongkir);
			$this->faktur->upset_biaya('unik', $id_faktur, $unik);

			switch ($status_paket) {
				case '1':
					# paket diproses
					if($pengiriman_ === 'ya') {
						$data_status = array(
							'status_paket' => '1',
							'status_kirim' => ($pengiriman_selesai === 'ya'? '2': '1'),
							'status_kiriman' => ( strtolower($kurir_terakhir) === 'cod'? '1': '2'),
							'tanggal_paket' => ($tanggal_paket === '0'? now() : $tanggal_paket ),
							'tanggal_kirim' => $tgl_kirim
						);
					}
					else {
						$data_status = array(
							'status_paket' => '1',
							'status_kirim' => '0',
							'status_kiriman' => NULL,
							'tanggal_paket' => ($tanggal_paket === '0'? now() : $tanggal_paket ),
							'tanggal_kirim' => '0'
						);
					}
					break;
				case '2':
					# paket dibatalkan
					$data_status = array(
						'status_paket' => '2',
						'tanggal_paket' => now()
					);
					break;
				default:
					# paket belum diproses
					$this->faktur->del_carry($id_faktur);

					$data_status = array(
						'status_paket' => '0',
						'status_kirim' => '0',
						'status_kiriman' => NULL,
						'tanggal_paket' => '0',
						'tanggal_kirim' => '0'
					);
					break;
			}

			// ----------------------------------------- FAKTUR 
			$data['faktur'] = array(
				// 'seri_faktur' => $faktur,
				'tanggal_dibuat' => strtotime($tanggal_dibuat . ' ' . $waktu_dibuat),
				'juragan_id' => $id_juragan,
				'pengguna_id' => $pengguna_id,
				'nama' => $nama,
				'hp1' => $hp1,
				'hp2' => (empty($hp2)? NULL: $hp2),
				'tipe' => (isset($marketplace)? strtolower( $marketplace ): NULL),
				'alamat' => $alamat,
				'gambar' => (empty($image)? NULL : $image),
				'keterangan' => (empty($keterangan)? NULL : $keterangan)
			);

			$this->faktur->edit_invoice($id_faktur, array_merge($data['faktur'], $data_status));
			$this->faktur->calc_pembayaran($id_faktur);
			redirect('pesanan/s_juragan?cari[q]=' . $hp1);
		}
	}

	public function pdf($seri_faktur) {
		echo 'download PDF ' . $seri_faktur;
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
				'q' => (int) $produk->jumlah,
				'h' => harga($produk->harga),
				't' => harga((int) $produk->harga * (int) $produk->jumlah)
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

	public function ambil_pengiriman() {
		$faktur_id = $this->input->get('id');

		$q = $this->faktur->get_carry($faktur_id);

		$data = array();
		foreach ($q->result() as $bayar) {
			$data[] = array(
				'id' => (int) $bayar->id_pengiriman,
				'kurir' => $bayar->kurir,
				'resi' => $bayar->resi,
				'tanggal_kirim' => mdate('%d-%m-%Y', $bayar->tanggal_kirim),
				'ongkir' => ( (int) $bayar->ongkir > 0 ?harga($bayar->ongkir): NULL)
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function tambah_pengiriman() {
		$this->form_validation->set_rules('faktur_id', 'Faktur ID', 'required');
		$this->form_validation->set_rules('resi', 'Resi', 'required');
		$this->form_validation->set_rules('tanggal_kirim', 'Tanggal Kirim', 'required|regex_match["[0-9]{4}-[0-9]{2}-[0-9]{2}"]');
		$this->form_validation->set_rules('ongkir', 'Ongkir', 'required|numeric');
		$this->form_validation->set_rules('kurir', 'Kurir', 'required');
		$this->form_validation->set_rules('lainnya', 'Kurir Lainnya', '');

		if ($this->form_validation->run() == FALSE) {
			$status = 500;
			$response = array(
				'status' => FALSE
			);
		}
		else {
			$faktur_id = $this->input->post('faktur_id');
			$kurir = $this->input->post('kurir');
			$lainnya = $this->input->post('lainnya');
			$resi = $this->input->post('resi');
			$tanggal_kirim = $this->input->post('tanggal_kirim');
			$ongkir = $this->input->post('ongkir');
			$cek = $this->input->post('cek');

			$data = array(
				'faktur_id' => $faktur_id,
				'kurir' => ($kurir === 'lainnya'? $lainnya: $kurir),
				'resi' => $resi,
				'tanggal_kirim' => strtotime($tanggal_kirim),
				'ongkir' => $ongkir
			);

			$kirim_cod = 'kirim';
			if (strtolower($kurir) === 'cod') {
				$kirim_cod = 'cod';
			}

			$this->faktur->sub_carry($data);
			$this->faktur->calc_carry($faktur_id, $kirim_cod, $cek);
			
			$seri_faktur = $this->faktur->get_info($faktur_id, 'seri_faktur');
			// $juragan_id = $this->faktur->get_info($faktur_id, 'juragan_id');
			// $this->notifikasi->set($_SESSION['userid'], '8', $juragan_id, $seri_faktur, 'cs');

			$status = 200;
			$response = array(
				'title' => 'Pengiriman',
				'faktur_id' => $faktur_id,
				'seri_faktur' => strtoupper( $seri_faktur ),
				'alert' => 'Pesanan ' . strtoupper( $seri_faktur ) . ' telah dikirim dengan resi ' . strtoupper($kurir . ' - ' . $resi ),
				'status' => true
			);
		}
		
		$this->output
			->set_status_header($status)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function detail_pengiriman() {
		$id_pengiriman = $this->input->get('id');
		$q = $this->faktur->get_carry_($id_pengiriman)->row();

		$response = array(
			'tanggal_kirim' => mdate('%Y-%m-%d', $q->tanggal_kirim),
			'faktur_id' => (int) $q->faktur_id,
			'ongkir' => (int) $q->ongkir,
			'kurir' => $q->kurir,
			'resi' => $q->resi,
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function simpan_pengiriman() {
		$this->form_validation->set_rules('faktur_id', 'Faktur ID', 'required');
		$this->form_validation->set_rules('id_pengiriman', 'Pengiriman ID', 'required');
		$this->form_validation->set_rules('resi', 'Resi', 'required');
		$this->form_validation->set_rules('tanggal_kirim', 'Tanggal Kirim', 'required|regex_match["[0-9]{4}-[0-9]{2}-[0-9]{2}"]');
		$this->form_validation->set_rules('ongkir', 'Ongkir', 'required|numeric');
		$this->form_validation->set_rules('kurir', 'Kurir', 'required');
		$this->form_validation->set_rules('lainnya', 'Kurir Lainnya', '');

		if ($this->form_validation->run() == FALSE) {
			$status = 500;
			$response = array();
		}
		else {
			$faktur_id = $this->input->post('faktur_id');
			$id_pengiriman = $this->input->post('id_pengiriman');
			$resi = $this->input->post('resi');
			$tanggal_kirim = $this->input->post('tanggal_kirim');
			$ongkir = $this->input->post('ongkir');
			$kurir = $this->input->post('kurir');
			$lainnya = $this->input->post('lainnya');

			if ($kurir === 'lainnya' && $lainnya !== '') {
				$courier = $lainnya;
			}
			else {
				$courier = $kurir;
			}

			$data = array();
			$dicek = array();
			
			$didata = array(
				'tanggal_kirim' => strtotime($tanggal_kirim),
				'kurir' => $courier,
				'resi' => $resi,
				'ongkir' => $ongkir
			);

			$data = $didata;

			$this->faktur->update_carry($id_pengiriman, $data);
			// $this->faktur->calc_pembayaran($faktur_id);

			$seri_faktur = $this->faktur->get_info($faktur_id, 'seri_faktur');
			// $juragan_id = $this->faktur->get_info($faktur_id, 'juragan_id');
			// $this->notifikasi->set($_SESSION['userid'], '2', $juragan_id, $seri_faktur, 'cs');

			$status = 200;
			$response = array(
				'status' => true,
				'title' => 'Pengiriman',
				'faktur_id' => $faktur_id,
				'seri_faktur' => strtoupper( $seri_faktur ),
				'alert' => 'Data pengiriman untuk ' . strtoupper( $seri_faktur ). ' telah disunting'
			);
		}

		$this->output
			->set_status_header($status)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function hapus_pengiriman() {
		$id_pengiriman = $this->input->post('idpengiriman');

		$id_faktur = $this->faktur->get_carry_($id_pengiriman)->row()->faktur_id;

		$this->faktur->del_carry_($id_pengiriman);
		$this->faktur->calc_carry($id_faktur);

		$seri_faktur = $this->faktur->get_info($id_faktur, 'seri_faktur');

		$response = array(
			'title' => 'Pengiriman',
			'faktur_id' => (int) $id_faktur,
			'seri_faktur' => strtoupper( $seri_faktur ),
			'alert' => 'Data pengiriman untuk ' . strtoupper( $seri_faktur ). ' telah dihapus'
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
}
