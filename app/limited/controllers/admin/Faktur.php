<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur extends admin_controller {
	public function __construct() {
		parent::__construct();
    }
    
    public function index() {
        redirect('pesanan');
	}

	public function lihat($juragan = 's_juragan', $status = 'semua') {
        $limit = $this->input->get('limit'); // limit tampil pesanan 
        $per_page = $this->input->get('halaman'); // halaman terkait
		$cari = $this->input->get('cari'); // cari data

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

		$config['base_url'] = site_url('pesanan/' . $juragan);
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
			'status' => $status,
            'query' => $this->faktur->get_all($juragan_id, $by = FALSE, $limit, $per_page, $cari)
			);

		$this->load->view('administrator/header', $this->data);
		$this->load->view('administrator/pesanan/lihat', $this->data);
		$this->load->view('administrator/footer', $this->data);
	}

	public function migrasi() {
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
				'judul' => 'Migrasi Data Pesanan',
				);

			$this->load->view('administrator/header', $this->data);
			$this->load->view('administrator/pesanan/migrasi', $this->data);
			$this->load->view('administrator/footer', $this->data);
		}
		else {
			//
			$id_juragan = $this->input->post('juragan_id');
			$slug = $this->input->post('slug');
			$tanggal_paket = $this->input->post('tanggal_paket');
			$waktu_dibuat = $this->input->post('waktu_dibuat');
			$faktur = $this->input->post('faktur');
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
			$data_id = array();
			$oldis = $this->faktur->_primary('faktur', 'id_faktur');
			if((int) $oldis !== 0) {
				$data_id = array(
					'id_faktur' => $oldis
				);
				$id_faktur = $oldis;
			}

			$data_otr = array(
				// 'id_faktur' => 
				'seri_faktur' => $faktur,
				'tanggal_dibuat' => strtotime($tanggal_dibuat . ' ' . $waktu_dibuat ),
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

			$data['faktur'] = array_merge($data_id, $data_otr);

			// simpan to `faktur`
			$this->faktur->add_invoice($data['faktur']);
			if((int) $oldis === 0) {
				$id_faktur = $this->db->insert_id(); // get `id_faktur`
			}

			// `pesanan_produk`
			$i = 0;
			$produk_data = array();			
			foreach ($produk as $key) {
				$pesprd_id = $this->faktur->_primary('pesanan_produk', 'id_pesanproduk', count($produk), $i);
				if ((int) $pesprd_id !== 0) {
					$produk_data[$i] = array(
						'id_pesanproduk' => $pesprd_id
					);
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
							$pembayaran_data[$p] = array(
								'id_pembayaran' => $byr_id
							);
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
			$kurir_terakhir = 'cod';
			$tgl_kirim = 0;
			if(!empty($pengiriman_) && $status_paket === '1') {
				$pengiriman_data = array();
				$pengiriman_submit = array_filter($pengiriman);
				if (!empty($pengiriman_submit)) {
					$pk = 0;
					foreach ($pengiriman as $bayar) {
						$krm_id = $this->faktur->_primary('pengiriman', 'id_pengiriman', count($pengiriman), $pk);
						if ((int) $krm_id !== 0) {
							$pengiriman_data[$pk] = array(
								'id_pengiriman' => $krm_id
							);
						}

						$pengiriman_data[$pk]['faktur_id'] = $id_faktur;
						$pengiriman_data[$pk]['tanggal_kirim'] = strtotime($bayar['tanggal_kirim']);
						$pengiriman_data[$pk]['kurir'] = $bayar['kurir'];
						$pengiriman_data[$pk]['resi'] = $bayar['resi'];
						$pengiriman_data[$pk]['ongkir'] = $bayar['ongkir'];

						$kurir_terakhir = $bayar['kurir'];
						$tgl_kirim = strtotime($bayar['tanggal_kirim']);

						$pk++;
					}
					$data['pengiriman'] = $pengiriman_data;
					// simpan to `pesanan_produk`
					$this->faktur->sub_carries($data['pengiriman']);
				}
			}

			if($status_paket !== '2') {
				if($pengiriman_ === 'ya') {
					if ($pengiriman_selesai === 'ya') {
						$val_kirim = '2';
						$val_kiriman = ( strtolower($kurir_terakhir) === 'cod'? '1': '2');
					}
					else {
						$val_kirim = '1';
						$val_kiriman = NULL;
					}
				}
				else {
					$this->faktur->del_carry($id_faktur);
					$val_kirim = '0';
					$val_kiriman = NULL;
					$tgl_kirim = '0';
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
					$tgl_paket = ($tanggal_paket === '0'? now() : $tanggal_paket );
					break;
				case '2':
					# paket dibatalkan
					$tgl_paket = now();
					break;
				default:
					# paket belum diproses
					$tgl_paket = 0;
					break;
			}

			if($status_paket !== '2') {
				$data_update = array(
					'status_paket' => $status_paket,
					'status_kirim' => $val_kirim,
					'status_kiriman' => $val_kiriman,
					'tanggal_paket' => $tgl_paket,
					'tanggal_kirim' => $tgl_kirim,
				);

				$this->faktur->edit_invoice($id_faktur, $data_update);
			}

			//
			$this->faktur->calc_pembayaran($id_faktur);
			$this->pesanan->delete($slug);
			redirect('pesanan?cari[q]=' . $faktur);
		}
	}

	public function tambah_pesanan() {
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
				);

			$this->load->view('administrator/header', $this->data);
			$this->load->view('administrator/pesanan/tulis', $this->data);
			$this->load->view('administrator/footer', $this->data);
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
			$kurir_terakhir = 'cod';
			if(!empty($pengiriman_) && $status_paket === '1') {
				$pengiriman_data = array();
				$pengiriman_submit = array_filter($pengiriman);
				if (!empty($pengiriman_submit)) {
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

			$tgl_kirim = 0;
			if($status_paket !== '2') {
				if($pengiriman_ === 'ya') {
					if ($pengiriman_selesai === 'ya') {
						$val_kirim = '2';
						$val_kiriman = ( strtolower($kurir_terakhir) === 'cod'? '1': '2');
					}
					else {
						$val_kirim = '1';
						$val_kiriman = NULL;
					}
				}
				else {
					$this->faktur->del_carry($id_faktur);
					$val_kirim = '0';
					$val_kiriman = NULL;
					$tgl_kirim = 0;
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
					$tgl_paket = ($tanggal_paket === '0'? now() : $tanggal_paket );
					break;
				case '2':
					# paket dibatalkan
					$tgl_paket = now();
					break;
				default:
					# paket belum diproses
					$tgl_paket = 0;
					break;
			}

			if($status_paket !== '2') {
				$data_update = array(
					'status_paket' => $status_paket,
					'status_kirim' => $val_kirim,
					'status_kiriman' => $val_kiriman,
					'tanggal_paket' => $tgl_paket,
					'tanggal_kirim' => $tgl_kirim,
				);

				$this->faktur->edit_invoice($id_faktur, $data_update);
			}

			//
			$this->faktur->calc_pembayaran($id_faktur);
			redirect('pesanan?cari[q]=' . $faktur);
		}
	}

	public function sunting($faktur) {
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
				'judul' => 'Sunting Pesanan',
				'sub_judul' => strtoupper($faktur),
				'q' => $this->faktur->get_detail($faktur)
				);
				
			$this->load->view('administrator/header', $this->data);
			$this->load->view('administrator/pesanan/sunting', $this->data);
			$this->load->view('administrator/footer', $this->data);
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
			redirect('pesanan?cari[q]=' . $hp1);
		}
	}

	public function hapus_pesanan() {
		$faktur_id = $this->input->post('faktur_id');
		$faktur = $this->input->post('faktur');

		$this->faktur->del_all($faktur_id);
		$data = array(
			'notif' => 'Pesanan ' . $faktur . ' telah dihapus'
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
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

	public function simpan_pembayaran() {
		$id_pembayaran = $this->input->post('id_pembayaran');
		$id_faktur = $this->input->post('id_faktur');
		$check = $this->input->post('check');

		$data = array('tanggal_cek' => ($check === 'ya'? now(): NULL));
		$this->faktur->update_pay($id_pembayaran, $data);

		$this->faktur->calc_pembayaran($id_faktur);
		// redirect('pesanan');
		$seri_faktur = $this->faktur->get_info($id_faktur, 'seri_faktur');

		$juragan_id = $this->faktur->get_info($id_faktur, 'juragan_id');
		$this->notifikasi->set($_SESSION['userid'], ($check === 'ya'? 3: 7), $juragan_id, $seri_faktur, 'cs');

		$response = array(
			'title' => 'Pembayaran',
			'faktur_id' => $id_faktur,
			'seri_faktur' => $seri_faktur,
			'alert' => 'Data pembayaran untuk ' . strtoupper( $seri_faktur ). ' telah dicek ' . ($check === 'ya'? 'masuk': 'belum masuk')
		);
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function tambah_pembayaran() {
		$faktur_id = $this->input->post('faktur_id');
		$rekening = $this->input->post('rekening');
		$jumlah = $this->input->post('jumlah');
		$tanggal_bayar = $this->input->post('tanggal_bayar');

		$data = array();
		$data[] = array(
			'tanggal_bayar' => strtotime($tanggal_bayar),
			'faktur_id' => $faktur_id,
			'jumlah' => $jumlah,
			'rekening' => $rekening
		);

		$this->faktur->sub_pay($data);
		$this->faktur->calc_pembayaran($faktur_id);

		$seri_faktur = $this->faktur->get_info($faktur_id, 'seri_faktur');
		$juragan_id = $this->faktur->get_info($faktur_id, 'juragan_id');
		$this->notifikasi->set($_SESSION['userid'], '2', $juragan_id, $seri_faktur, 'cs');

		$response = array(
			'title' => 'Pembayaran',
			'faktur_id' => $faktur_id,
			'seri_faktur' => $seri_faktur,
			'alert' => 'Data pembayaran untuk ' . strtoupper( $seri_faktur ). ' telah ditambahkan'
		);
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function hapus_pembayaran() {
		$id_faktur = $this->input->post('idfaktur');
		$id_pembayaran = $this->input->post('idpembayaran');

		$this->faktur->del_pay($id_pembayaran);
		$this->faktur->calc_pembayaran($id_faktur);

		$seri_faktur = $this->faktur->get_info($id_faktur, 'seri_faktur');

		$response = array(
			'title' => 'Pembayaran',
			'faktur_id' => $id_faktur,
			'seri_faktur' => $seri_faktur,
			'alert' => 'Data pembayaran untuk ' . strtoupper( $seri_faktur ). ' telah dihapus'
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function tambah_pengiriman() {
		
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
		$juragan_id = $this->faktur->get_info($faktur_id, 'juragan_id');
		$this->notifikasi->set($_SESSION['userid'], '8', $juragan_id, $seri_faktur, 'cs');

		$response = array(
			'title' => 'Pembayaran',
			'faktur_id' => $faktur_id,
			'seri_faktur' => $seri_faktur,
			'alert' => 'Pesanan ' . strtoupper( $seri_faktur ). ' telah dikirim'
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

	public function get_juragan() {
		$jur = $this->juragan->_semua()->result();

		///
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
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
	
}
