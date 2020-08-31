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

	// create  
	public function tambah() {
		$this->form_validation->set_rules('juragan_id', 'Juragan', 'required|greater_than[0]');
		$this->form_validation->set_rules('pengguna_id', 'Pengguna', 'required|greater_than[0]');
		$this->form_validation->set_rules('nama', 'nama lengkap', 'required');
		$this->form_validation->set_rules('hp1', 'hp 1', 'required');
		// $this->form_validation->set_rules('hp2', 'hp 2', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		//$this->form_validation->set_rules('kode[]', 'kode', 'required');
		//$this->form_validation->set_rules('size[]', 'size', 'required');
		//$this->form_validation->set_rules('harga_a[]', 'harga_a', 'required');
		//$this->form_validation->set_rules('jumlah[]', 'jumlah', 'required');
		$this->form_validation->set_rules('marketplace', 'marketplace', '');
		//$this->form_validation->set_rules('rekening', 'rekening', 'required');
		// $this->form_validation->set_rules('harga', 'total harga', 'required');
		$this->form_validation->set_rules('ongkir', 'ongkir', 'required');
		// $this->form_validation->set_rules('transfer', 'transfer', 'required');
		$this->form_validation->set_rules('diskon', 'diskon', 'required');
		$this->form_validation->set_rules('unik', 'angka unik', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->data = array(
				'judul' => 'Tulis Pesanan',
				'include' => $this->template,
				);

			$this->load->view('pesanan-tambah', $this->data);
		}
		else {
			//
			$id_juragan = $this->input->post('juragan_id');
			$pengguna_id = $this->input->post('pengguna_id');
			$nama = $this->input->post('nama');
			$tanggal_dibuat = $this->input->post('tanggal_dibuat');
			$hp1 = $this->input->post('hp1');
			$hp2 = $this->input->post('hp2');
			$alamat = $this->input->post('alamat');
			$produk = $this->input->post('produk'); // array
			$pembayaran = $this->input->post('pembayaran'); // array
			$pengiriman = $this->input->post('pengiriman'); // array
			$diskon = $this->input->post('diskon');
			$ongkir = $this->input->post('ongkir');
			$unik = $this->input->post('unik');
			$pembayaran_ = $this->input->post('pembayaran_');
			$pengiriman_ = $this->input->post('pengiriman_');
			$marketplace_ = $this->input->post('marketplace_');
			$marketplace = $this->input->post('marketplace');
			$keterangan = $this->input->post('keterangan');
			$image = $this->input->post('image');
			$status_paket = $this->input->post('status_paket');
			$pengiriman_selesai = $this->input->post('pengiriman_selesai');

			//
			$dj = $this->juragan->_detail($id_juragan)->row();
			$faktur = strtolower($dj->short . str_pad(date('ymdHis'), 11, "0", STR_PAD_LEFT));

			// `faktur`
			$data = array();
			$data['faktur'] = array(
				// 'id_faktur' => 
				'seri_faktur' => $faktur,
				'tanggal_dibuat' => strtotime($tanggal_dibuat . ' ' . mdate('%H:%i:%s', now())),
				'juragan_id' => $id_juragan,
				'pengguna_id' => $pengguna_id,
				'nama' => $nama,
				'hp1' => $hp1,
				'hp2' => (empty($hp2)? NULL: $hp2),
				'tipe' => (isset($marketplace)? strtolower( $marketplace ): NULL),
				'alamat' => $alamat,
				'gambar' => (empty($image)? NULL : $image),
				'keterangan' => (empty($keterangan)? NULL : $keterangan),
			);

			// simpan to `faktur`
			$this->faktur->add_invoice($data['faktur']);
			$id_faktur = $this->db->insert_id(); // get `id_faktur`

			// `pesanan_produk`
			$i = 0;
			$produk_data = array();			
			foreach ($produk as $key) {
				$pesprd_id = $this->faktur->_primary('pesanan_produk', 'id_pesanproduk', count($produk), $i);
				if ((int) $pesprd_id !== 0) {
					$produk_data[$i]['id_pesanproduk'] = $pesprd_id;
				}

				$produk_data[$i]['faktur_id'] = $id_faktur;
				$produk_data[$i]['kode'] = $key['kode'];
				$produk_data[$i]['ukuran'] = $key['ukuran'];
				$produk_data[$i]['jumlah'] = $key['jumlah'];
				$produk_data[$i]['harga'] = $key['harga'];

				$i++;
			}
			$data['produk'] = $produk_data;
			// simpan to `pesanan_produk`
			$this->faktur->add_orders($data['produk']);			

			$data['opsi_bayar'] = $pembayaran_;
			// `pembayaran`
			if($pembayaran_ !== 'ya') {
				$pembayaran_data = array();
				$pembayaran_submit = array_filter($pembayaran);
				if (!empty($pembayaran_submit)) {
					$p = 0;
					foreach ($pembayaran as $bayar) {
						$byr_id = $this->faktur->_primary('pembayaran', 'id_pembayaran', count($pembayaran), $p);
						if ((int) $byr_id !== 0) {
							$pembayaran_data[$p]['id_pembayaran'] = $byr_id;
						}

						$pembayaran_data[$p]['faktur_id'] = $id_faktur;
						$pembayaran_data[$p]['tanggal_bayar'] = strtotime($bayar['tanggal']);
						$pembayaran_data[$p]['jumlah'] = $bayar['jumlah'];
						$pembayaran_data[$p]['rekening'] = $bayar['rekening'];
						$pembayaran_data[$p]['tanggal_cek'] = (empty($bayar['cek']) ? NULL: strtotime($bayar['cek']));

						$p++;
					}
					$data['pembayaran'] = $pembayaran_data;
					// simpan to `pesanan_produk`
					$this->faktur->sub_pay($data['pembayaran']);
				}
			}

			// `pengiriman`
			$kurir_terakhir = '';
			if($pengiriman_ === 'ya') {
				$pengiriman_data = array();
				//$pengiriman_submit = array_filter($pengiriman);
				if (!empty($pengiriman)) {
					$pk = 0;
					foreach ($pengiriman as $bayar) {
						$kir_id = $this->faktur->_primary('pengiriman', 'id_pengiriman', count($pengiriman), $p);
						if ((int) $kir_id !== 0) {
							$pengiriman_data[$pk]['id_pembayaran'] = $kir_id;
						}

						$pengiriman_data[$pk]['faktur_id'] = $id_faktur;
						$pengiriman_data[$pk]['tanggal_kirim'] = strtotime($bayar['tanggal_kirim']);
						$pengiriman_data[$pk]['kurir'] = $bayar['kurir'];
						$pengiriman_data[$pk]['resi'] = $bayar['resi'];
						$pengiriman_data[$pk]['ongkir'] = $bayar['ongkir'];

						$kurir_terakhir = $bayar['kurir'];

						$pk++;
					}
					$data['pengiriman'] = $pengiriman_data;
					// simpan to `pesanan_produk`
					$this->faktur->sub_carries($data['pengiriman']);
				}
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

			$this->faktur->edit_invoice($id_faktur, $data_status);
			
			//
			$this->faktur->calc_pembayaran($id_faktur);
			$slug = $this->juragan->_slug($id_juragan);
			$this->notifikasi->set('1', $faktur);
			redirect('a/faktur/lihat/'.$slug.'?cari[q]=' . $hp1);
		}
	}

	// read  
	public function lihat($juragan = 's_juragan') {
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

		$limit 		= $this->input->get('limit'); // limit tampil pesanan 
		$per_page 	= $this->input->get('halaman'); // halaman terkait
		$cari 		= $this->input->get('cari'); // cari data

		$limit = 25;
		if( ! isset($per_page)) {
			$per_page = 0;
		}

		$config['base_url'] = site_url('a/faktur/lihat/' . $juragan);
		$config['total_rows'] = $this->faktur->get_all($juragan_id, $by = FALSE, FALSE, FALSE, $cari)->num_rows();
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['query_string_segment'] = 'halaman';
		$config['reuse_query_string'] = TRUE;

		// init pagination
		$this->pagination->initialize($config);

		$this->data = array(
			'judul' 	=> 'Pesanan ' . $nama_juragan,
			'juragan' 	=> $juragan,
			'include' 	=> $this->template,
			'query' 	=> $this->faktur->get_all($juragan_id, $by = FALSE, $limit, $per_page, $cari)
			);

		$this->load->view('pesanan-lihat', $this->data);
	}

	// update 
	public function sunting($seri_faktur) {
		$diijinkan = FAlSE;
		$fktr = $this->faktur->get_detail($seri_faktur);
		$f = $fktr->row();
		// $juragan = $this->juragan->_slug($f->juragan_id);

		if($fktr->num_rows() > 0) {
			switch ($this->session->level) {
				case 'admin':
				case 'superadmin':
						$diijinkan = TRUE;
					break;
				
				case 'cs':
					$juragan = $this->juragan->_slug($f->juragan_id);
					$cek_juragannya = $this->pengguna->juragan($_SESSION['username'], $juragan);

					if ($f->status_paket === '0' && !in_array($f->status_transfer, array('3', '4')) && $cek_juragannya) {
						$diijinkan = TRUE;
					}
					
					break;
				default:
					$diijinkan = FALSE;
					break;
			}
		}

		if ($diijinkan) {

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
					'sub_judul' => strtoupper($seri_faktur),
					'q' => $fktr,
					'include' => $this->template
					);
				
				$this->load->view('pesanan-sunting', $this->data);
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
						$this->notifikasi->set('2', $seri_faktur);
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
						$this->notifikasi->set('8', $seri_faktur);
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

				$slug = $this->juragan->_slug($id_juragan);
				redirect('a/faktur/lihat/'.$slug.'?cari[q]=' . $hp1);
			}
		}
		else {
			show_404();
		}
	}

	// delete
	public function delete() {
		$id_faktur = $this->input->post('id_faktur');
		$this->faktur->del_all($id_faktur);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode(array('status' => TRUE, 'id' => $id_faktur), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
}
