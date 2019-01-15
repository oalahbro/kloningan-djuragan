<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur extends admin_controller
{
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
				'judul' => 'Tulis Pesanan',
				);

			$this->load->view('administrator/header', $this->data);
			$this->load->view('administrator/pesanan/migrasi', $this->data);
			$this->load->view('administrator/footer', $this->data);
		}
		else {
			//
			$id_juragan = $this->input->post('juragan_id');
			$slug = $this->input->post('slug');
			$tanggal_dibuat = $this->input->post('tanggal_dibuat');
			$waktu_dibuat = $this->input->post('waktu_dibuat');
			$faktur = $this->input->post('faktur');
			$pengguna_id = $this->input->post('pengguna_id');
			$nama = $this->input->post('nama');
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

			// `faktur`
			$data = array();
			$data['faktur'] = array(
				'seri_faktur' => $faktur,
				'tanggal_dibuat' => strtotime($tanggal_dibuat . ' ' . $waktu_dibuat ),
				'juragan_id' => $id_juragan,
				'pengguna_id' => $pengguna_id,
				'nama' => $nama,
				'hp1' => $hp1,
				'alamat' => $alamat,
			);

			// simpan to `faktur`
			$this->faktur->add_invoice($data['faktur']);
			$id_faktur = $this->db->insert_id(); // get `id_faktur`

			// `pesanan_produk`
			$i = 0;
			$produk_data = array();			
			foreach ($produk as $key) {
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
			if(!empty($pengiriman_) && $status_paket === 'diproses') {
				$pengiriman_data = array();
				$kurir_terakhir = 'cod';
				$pengiriman_submit = array_filter($pengiriman);
				if (!empty($pengiriman_submit)) {
					$pk = 0;
					foreach ($pengiriman as $bayar) {
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

			// `keterangan`
			$keterangan_data = array();
			if ($hp2 !== NULL && $hp2 !== '') {
				$keterangan_data[] = array(
					'faktur_id' => $id_faktur,
					'key' => 'hp',
					'val' => $hp2
				);
			}

			if ($ongkir !== NULL && $ongkir > 0) {
				$keterangan_data[] = array(
					'faktur_id' => $id_faktur,
					'key' => 'ongkir',
					'val' => $ongkir
				);
			}

			if ($diskon !== NULL  && $diskon > 0) {
				$keterangan_data[] = array(
					'faktur_id' => $id_faktur,
					'key' => 'diskon',
					'val' => $diskon
				);
			}

			if ($unik !== NULL && $unik > 0) {
				$keterangan_data[] = array(
					'faktur_id' => $id_faktur,
					'key' => 'unik',
					'val' => $unik
				);
			}

			if ($marketplace !== NULL && $marketplace_ === 'on') {
				$keterangan_data[] = array(
					'faktur_id' => $id_faktur,
					'key' => 'tipe',
					'val' => $marketplace
				);
			}

			if ($keterangan !== NULL && $keterangan !== '') {
				$keterangan_data[] = array(
					'faktur_id' => $id_faktur,
					'key' => 'keterangan',
					'val' => $keterangan
				);
			}

			if ($image !== NULL && $image !== '') {
				$keterangan_data[] = array(
					'faktur_id' => $id_faktur,
					'key' => 'gambar',
					'val' => $image
				);
			}

			if ($status_paket === 'diproses' && $pengiriman_ === 'ya') {
				if ($pengiriman_selesai === 'ya') {
					$keterangan_data[] = array(
						'faktur_id' => $id_faktur,
						'key' => 's_kirim',
						'val' => ( strtolower($kurir_terakhir) === 'cod'? 'c_diambil': 'b_dikirim')
					);
				}
				else {
					$keterangan_data[] = array(
						'faktur_id' => $id_faktur,
						'key' => 's_kirim',
						'val' => 'd_sebagian'
					);
				}
			}
			else {
				$keterangan_data[] = array(
					'faktur_id' => $id_faktur,
					'key' => 's_kirim',
					'val' => 'belum_kirim'
				);
			}

			$keterangan_data[] = array(
				'faktur_id' => $id_faktur,
				'key' => 's_paket',
				'val' => $status_paket
			);

			$data['keterangan'] = $keterangan_data;
			if ( ! empty($data['keterangan'])) {
				$this->faktur->sub_ket($data['keterangan']);
			}
			
			//
			$this->faktur->calc_pembayaran($id_faktur);
			$this->pesanan->delete($slug);
			redirect('migrasi?cari[q]=' . $faktur);
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
				'tipe' => (isset($marketplace)? $marketplace: NULL),
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
						$val_kirim = ( strtolower($kurir_terakhir) === 'cod'? '2': '3');
					}
					else {
						$val_kirim = '1';
					}
				}
				else {
					$this->faktur->del_carry($id_faktur);
					$val_kirim = '0';
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

			$data_update = array(
				'status_paket' => $status_paket,
				'status_kirim' => $val_kirim,
				'tanggal_paket' => $tgl_paket,
				'tanggal_kirim' => $tgl_kirim,
			);

			$this->faktur->edit_invoice($id_faktur, $data_update);

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

				// $data['produk'] = $pengiriman_data;
				$pengiriman_del = array_diff($pengiriman_database, $pengiriman_submit);
				foreach ($pengiriman_del as $id) {
					$result[] = $id;
					$this->faktur->del_carry_($id);
				}
				$data['pengiriman']['dihapus'] = $pengiriman_del;
			}

			if($status_paket !== '2') {
				if($pengiriman_ === 'ya') {
					if ($pengiriman_selesai === 'ya') {
						$val_kirim = ( strtolower($kurir_terakhir) === 'cod'? '2': '3');
					}
					else {
						$val_kirim = '1';
					}
				}
				else {
					$this->faktur->del_carry($id_faktur);
					$val_kirim = '0';
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

			// ----------------------------------------- FAKTUR 
			$data['faktur'] = array(
				// 'seri_faktur' => $faktur,
				'tanggal_dibuat' => strtotime($tanggal_dibuat . ' ' . $waktu_dibuat),
				'juragan_id' => $id_juragan,
				'pengguna_id' => $pengguna_id,
				'nama' => $nama,
				'hp1' => $hp1,
				'hp2' => (empty($hp2)? NULL: $hp2),
				'tipe' => (isset($marketplace)? $marketplace: NULL),
				'status_paket' => $status_paket,
				'status_kirim' => $val_kirim,
				'tanggal_paket' => $tgl_paket,
				'tanggal_kirim' => $tgl_kirim,
				'alamat' => $alamat,
				'gambar' => (empty($image)? NULL : $image),
				'keterangan' => (empty($keterangan)? NULL : $keterangan),
			);

			$this->faktur->edit_invoice($id_faktur, $data['faktur']);
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
		$bayar = $this->input->post('pembayaran');
		$faktur = $this->input->post('faktur');

		$data = array();
		foreach ($bayar as $check => $o) {
			if($o === 'ya') {
				// simpan
				if($this->faktur->check_paid($check) !== TRUE) {
					// jika sudah dicek, maka tidak ditimpa
					$data = array('tanggal_cek' => now());
					$this->faktur->update_pay($check, $data);
				}
			}
			else {
				// hapus cek
				$data = array('tanggal_cek' => NULL);
				$this->faktur->update_pay($check, $data);
			}
		}

		$this->faktur->calc_pembayaran($faktur);
		redirect('pesanan');
	}

	public function tambah_pembayaran() {
		$faktur_id = $this->input->post('faktur');
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
		redirect('pesanan');
	}

	public function hapus_pembayaran() {
		$id_faktur = $this->input->post('idfaktur');
		$id_pembayaran = $this->input->post('idpembayaran');

		$this->faktur->del_pay($id_pembayaran);
		$this->faktur->calc_pembayaran($id_faktur);

		$data = array(
			'notif' => 'Pembayaran sudah dihapus'
		);
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function tambah_pengiriman() {
		
		$faktur_id = $this->input->post('faktur');
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
		redirect('pesanan');
		
		// var_dump($this->input->post());
	}

	public function ubah_paket() {
		$faktur_id = $this->input->post('faktur_id');
		$faktur = $this->input->post('faktur');
		$status = $this->input->post('status');

		$this->faktur->set_package($faktur_id, $status);
		$data = array(
			'notif' => 'Status Paket Pesanan ' . $faktur . ' kini telah menjadi "' . $status . '"' . ($status === 'diproses'? ' dan data pengiriman telah dihapus.': ', sekarang Kamu dapat set-kirim pesanan.')
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
}
