<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur extends user_controller
{
	public function __construct() {
		parent::__construct();
		$user_slug = $this->session->username;
		$s = $this->pengguna->_juragan_terakhir($user_slug);
		$this->juragan_terakhir = $this->juragan->_slug($s);
		$juragan = $this->uri->segment(2);
    }
    
    public function index() {
        redirect('myorder/' . $this->juragan_terakhir);
    }

	public function lihat($juragan = 's_juragan', $status = 'semua') {
		$j = $this->pengguna->juragan($_SESSION['username'], $juragan);
		if (!$j) {
			show_404();
		}
		else {
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
				'query' => $this->faktur->get_all($juragan_id, $by = FALSE, $limit, $per_page, $cari = NULL)
				);

			$this->load->view('user/header', $this->data);
			$this->load->view('user/pesanan/lihat', $this->data);
			$this->load->view('user/footer', $this->data);
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

			$this->load->view('user/header', $this->data);
			$this->load->view('user/pesanan/tulis', $this->data);
			$this->load->view('user/footer', $this->data);
		}
		else {
			//
			$id_juragan = $this->input->post('juragan_id');
			$pengguna_id = $this->input->post('pengguna_id');
			$nama = $this->input->post('nama');
			$hp1 = $this->input->post('hp1');
			$hp2 = $this->input->post('hp2');
			$alamat = $this->input->post('alamat');
			$produk = $this->input->post('produk'); // array
			$pembayaran = $this->input->post('pembayaran'); // array
			$diskon = $this->input->post('diskon');
			$ongkir = $this->input->post('ongkir');
			$unik = $this->input->post('unik');
			$marketplace_ = $this->input->post('marketplace_');
			$marketplace = $this->input->post('marketplace');
			$keterangan = $this->input->post('keterangan');
			$image = $this->input->post('image');

			//
			$dj = $this->juragan->_detail($id_juragan)->row();
			$count = $this->faktur->get_count_this_month($id_juragan);
			$faktur = strtolower($dj->short . str_pad(date('ymdHis'), 11, "0", STR_PAD_LEFT));

			// `faktur`
			$data = array();
			$data['faktur'] = array(
				'seri_faktur' => $faktur,
				'tanggal_dibuat' => now(),
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

			// `pembayaran`
			$pembayaran_data = array();
			if ($marketplace === NULL && $marketplace_ !== 'on') {
				$p = 0;
				foreach ($pembayaran as $bayar) {
					$pembayaran_data[$p]['faktur_id'] = $id_faktur;
					$pembayaran_data[$p]['tanggal_bayar'] = strtotime($bayar['tanggal']);
					$pembayaran_data[$p]['jumlah'] = $bayar['jumlah'];
					$pembayaran_data[$p]['rekening'] = $bayar['rekening'];

					$p++;
				}
				$data['pembayaran'] = $pembayaran_data;
				// simpan to `pesanan_produk`
				$this->faktur->sub_pay($data['pembayaran']);
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

			$keterangan_data[] = array(
				'faktur_id' => $id_faktur,
				'key' => 's_kirim',
				'val' => 'belum'
			);
			
			$keterangan_data[] = array(
				'faktur_id' => $id_faktur,
				'key' => 's_paket',
				'val' => 'belum'
			);

			$data['keterangan'] = $keterangan_data;
			if ( ! empty($data['keterangan'])) {
				$this->faktur->sub_ket($data['keterangan']);
			}
			
			//
			$this->faktur->calc_pembayaran($id_faktur);
			redirect('myorder');
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
			$pengguna_id = $this->input->post('pengguna_id');
			$nama = $this->input->post('nama');
			$hp1 = $this->input->post('hp1');
			$hp2 = $this->input->post('hp2');
			$alamat = $this->input->post('alamat');
			$produk = $this->input->post('produk'); // array
			$pembayaran = $this->input->post('pembayaran'); // array
			$diskon = $this->input->post('diskon');
			$ongkir = $this->input->post('ongkir');
			$unik = $this->input->post('unik');
			$marketplace_ = $this->input->post('marketplace_');
			$marketplace = $this->input->post('marketplace');
			$keterangan = $this->input->post('keterangan');
			$image = $this->input->post('image');

			//
			$dj = $this->juragan->_detail($id_juragan)->row();
			$count = $this->faktur->get_count_this_month($id_juragan);
			$faktur = strtolower($dj->short . str_pad(date('ymdHis'), 11, "0", STR_PAD_LEFT));

			// `faktur`
			$data = array();
			$data['faktur'] = array(
				'seri_faktur' => $faktur,
				//'tanggal_dibuat' => now(),
				'juragan_id' => $id_juragan,
				'pengguna_id' => $pengguna_id,
				'nama' => $nama,
				'hp1' => $hp1,
				'alamat' => $alamat,
			);

			// update to `faktur`
			$this->faktur->edit_invoice($id_faktur, $data['faktur']);

			// `pesanan_produk`
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
			// $data['produk'] = $produk_data;
			$produk_del = array_diff($produk_database,$produk_submit);
			foreach ($produk_del as $id) {
				$result[] = $id;
				$this->faktur->delete_order($id);
			}

			// `keterangan`
			$keterangan_data = array();
			if ($hp2 !== NULL && $hp2 !== '') {
				$this->faktur->update_ket($id_faktur, 'hp', $hp2);
			}
			else {
				$this->faktur->update_ket($id_faktur, 'hp', $hp2, FALSE);
			}

			if ($ongkir !== NULL && $ongkir > 0) {
				$this->faktur->update_ket($id_faktur, 'ongkir', $ongkir);
			}
			else {
				$this->faktur->update_ket($id_faktur, 'ongkir', $ongkir, FALSE);
			}

			if ($diskon !== NULL  && $diskon > 0) {
				$this->faktur->update_ket($id_faktur, 'diskon', $diskon);
			}
			else {
				$this->faktur->update_ket($id_faktur, 'diskon', $diskon, FALSE);
			}

			if ($unik !== NULL && $unik > 0) {
				$this->faktur->update_ket($id_faktur, 'unik', $unik);
			}
			else {
				$this->faktur->update_ket($id_faktur, 'unik', $unik, FALSE);
			}

			if ($marketplace !== NULL && $marketplace_ === 'on') {
				$this->faktur->update_ket($id_faktur, 'tipe', $marketplace);
			}
			else {
				$this->faktur->update_ket($id_faktur, 'tipe', $marketplace, FALSE);
			}

			if ($keterangan !== NULL && $keterangan !== '') {
				$this->faktur->update_ket($id_faktur, 'keterangan', $keterangan);
			}
			else {
				$this->faktur->update_ket($id_faktur, 'keterangan', $keterangan, FALSE);
			}

			if ($image !== NULL && $image !== '') {
				$this->faktur->update_ket($id_faktur, 'gambar', $image);
			}
			else {
				$this->faktur->update_ket($id_faktur, 'gambar', $image, FALSE);
			}

			$this->faktur->calc_pembayaran($id_faktur);
			redirect('pesanan');
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

	public function ambil_pengiriman() {
		$faktur_id = $this->input->get('faktur_id');
		$q = $this->faktur->get_carry($faktur_id);

		$data = array();
		foreach ($q->result() as $kirim) {
			$data[] = array(
				'id' => (int) $kirim->id_pengiriman,
				'kurir' => $kirim->kurir,
				'ongkir' => harga($kirim->ongkir),
				'tanggal_kirim' => mdate('%d-%m-%Y', $kirim->tanggal_kirim)
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($q->result(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
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
