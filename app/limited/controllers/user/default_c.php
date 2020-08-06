<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_c extends CI_Controller {
	/**
	 * pesanan()
	 *
	 * 
	 */
	public function index() {
		if(is_login()) {
			if(is_user('user')) {
				$page 		= input_get('pg');
				//$juragan 	= input_get('juragan');
				$juragan 	= data_session('id');

				if(empty($page)) {
					$halaman = 'semua';
				}
				else {
					$halaman = $page;
				}

				if( ! empty($juragan)) {
					$nama_juragan = $this->juragan_model->get_nama_juragan_by_id($juragan);
				}
				else {
					$nama_juragan = 'Semua Juragan';
				}

				$this->data = array(
					'halaman' => $halaman,
					'juragan' => $juragan,
					'nama_juragan' => $nama_juragan,
					//'dropdown_header' => $this->pesanan_model->dropdown_juragan()
					);

				$this->load->view('inc/header');
				$this->load->view('user/inc/menu_view', $this->data);
				$this->load->view('user/pesanan/pesanan_view', $this->data);
				$this->load->view('inc/user/footer', $this->data);
			}
			else {
				show_404();
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	public function membership() {
		if(is_login()) {
			if(is_user('user')) {
				$page 		= input_get('pg');
				//$juragan 	= input_get('juragan');
				$juragan 	= data_session('id');

				if(empty($page)) {
					$halaman = 'membership';
				}
				else {
					$halaman = $page;
				}

				if( ! empty($juragan)) {
					$nama_juragan = $this->juragan_model->get_nama_juragan_by_id($juragan);
				}
				else {
					$nama_juragan = 'Semua Juragan';
				}
				$user_id = $this->juragan_model->get_username_by_user_id($juragan);
				$this->data = array(
					'halaman' => $halaman,
					'juragan' => $juragan,
					'nama_juragan' => $nama_juragan,
					'membership' => $this->juragan_model->membership($user_id, '')
					);

				$this->load->view('inc/header');
				$this->load->view('user/inc/menu_view', $this->data);
				$this->load->view('user/membership_view', $this->data);
				$this->load->view('inc/user/footer', $this->data);
			}
			else {
				show_404();
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	public function tambah_membership($juragan) {
		if(is_login()) {
			if(is_user('user')) {
				//$user_id = $this->juragan_model->get_user_id_by_username($juragan);
				$this->data_view = array(
					'user' => $this->juragan_model->get_detail_juragan($juragan),
					'user_card' => $this->juragan_model->member_card($juragan)
					);

				$this->load->view('user/membership_add_loader_view', $this->data_view);
			}
			else {
				show_404();
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	public function simpan_member() {
		if(is_login()) {
			if(is_user('user')) {
				$this->form_validation->set_rules('id', 	'User ID', 	'xss_clean|required|numeric');
				$this->form_validation->set_rules('user_card', 	'Kode Unik', 	'xss_clean|required');
				$this->form_validation->set_rules('nama', 	'Nama Lengkap', 	'xss_clean|numeric');
				$this->form_validation->set_rules('hp', 	'hp', 	'xss_clean|numeric|numeric');
				$this->form_validation->set_rules('alamat', 	'Alamat', 	'xss_clean|numeric');

				$user_id = $this->input->post('id');
				$user_card = $this->input->post('user_card');
				$nama = $this->input->post('nama');
				$hp = $this->input->post('hp');
				$alamat = $this->input->post('alamat');

				//$username = $this->juragan_model->get_username_by_user_id($user_id);

				if($this->form_validation->run() === FALSE) {
					$this->data_save = array(
						'user_id' => $user_id,
						'user_card' => $user_card,
						'nama_member' => $nama,
						'hp' => $hp,
						'alamat' => $alamat,
						'tanggal_daftar' => mdate('%Y-%m-%d %H:%i:%s',  time())
						);

					$save_member = $this->juragan_model->simpan_member($this->data_save);
					redirect('user/membership/');
				}
			}
			else {
				show_404();
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	/**
	 * lihat_data()
	 *
	 * 
	 */
	public function lihat_data($halaman, $juragan = false)
	{
		if(is_login())
		{
			if(is_user('user'))
			{
				$halaman = $this->uri->segment(3);
				$juragan = $this->uri->segment(4);
				$submit  = input_get('submit');
				$cari 	 = input_get('cari');
				$page 	 = input_get('per_page');
				$offset 	= '20';

				$data_pesanan = $this->pesanan_model->get_all($halaman, $page, $offset, $cari, $juragan);

				$numrow = $this->pesanan_model->get_all($halaman, NULL, NULL, $cari, $juragan)->num_rows();
				
				$base = site_url('user/lihat_data/'.$halaman.'/'.$juragan.'?cari='.$cari);
				
				$config['page_query_string']= TRUE;
				$config['base_url'] 		= $base;
				$config['total_rows'] 		= $numrow;
				$config['per_page']			= $offset;
				$config['num_links'] 		= 5;

				$this->pagination->initialize($config);

				$this->data = array(
					'halaman' => $halaman,
					'juragan' => $juragan,
					'table' => $this->table->generate(),
					'pagination' => $this->pagination->create_links(),
					'pesanan' => $data_pesanan
					);

				if($submit === 'yes')
				{
					$this->load->view('user/pesanan/pesanan_loader_view', $this->data);
				}
				else
				{
					show_404();
				}
				
			}
			else
			{
				show_404('404');
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	/**
	 * tambah()
	 *
	 * 
	 */
	public function tambah() {
		if(is_login()) {
			if(is_user('user')) {
				$page 		= input_get('pg');
				$juragan 	= data_session('id');

				if(empty($page)) {
					$halaman = 'tambah';
				}
				
				if($this->form_validation->run('submit') === FALSE) {
					$this->data = array(
						'halaman' => $halaman,
						'juragan' => $juragan,
						);

					$this->load->view('inc/header');
					$this->load->view('user/inc/menu_view', $this->data);
					$this->load->view('user/pesanan/tambah_pesanan_view', $this->data);
					$this->load->view('inc/user/footer', $this->data);
				}
				else {
					$user_id= input_post('id');
					$nama 	= input_post('nama');
					$alamat = nl2br(input_post('alamat'));

    				// kode
					$kode ="";
					foreach(input_post('kode') as $key => $value){
						$kode .= $value .", ";
					}
					$kode = reduce_multiples($kode, ", ", TRUE);
					// jumlah
					$jumlah ="";
					foreach(input_post('jumlah') as $key => $value){
						$jumlah .= $value .", ";
					}
					$jumlah = reduce_multiples($jumlah, ", ", TRUE);
					// size
					$size ="";
					foreach(input_post('size') as $key => $value){
						$size .= $value .", ";
					}
					$size = reduce_multiples($size, ", ", TRUE);

					$s_kode 	= explode(', ', $kode);
					$s_jmlh 	= explode(', ', $jumlah);
					$s_size 	= explode(', ', $size);

					$ukuran 	= array_map('trim', explode(",",$jumlah));
					$totale 	= array_sum($ukuran);

					$pesanan ="";
					$jumlah_array = count($ukuran);
					for ($i = 0; $i < $jumlah_array; ++$i) {
						$pesanan .= $s_kode[$i].','
						.$s_size[$i].','
						.$s_jmlh[$i].'# ';
					}
					$pesanan = reduce_multiples($pesanan, "# ", TRUE);			

					$hp 	= input_post('hp');
					$harga 	= str_replace('.', '', input_post('harga'));
					$ongkir	= str_replace('.', '', input_post('ongkir'));
					$transfer =  str_replace('.', '', input_post('transfer'));
					$status = input_post('status');
					$bank 	= input_post('bank');
					$keterangan = nl2br(input_post('keterangan'));
					if(empty($keterangan))
					{
						$keterangan = NULL;
					}
					$image 	= input_post('image');
					if(empty($image)){
						$image = NULL;
					}

					$data = array(
						'user_id' => $user_id,
						'nama' 	=> $nama,
						'alamat' => $alamat,
						'hp' 	=> $hp,
						'pesanan' => $pesanan,
						'harga' => $harga,
						'ongkir' => $ongkir,
						'transfer' => $transfer,
						'jumlah' => $totale,
						'status' => $status,
						'bank' => $bank,
						'keterangan' => $keterangan,
						'customgambar' => $image,
						'data' => 'baru',
						'unik' => $user_id . '_' .random_string('unique', 32)
						);

					$submit = $this->pesanan_model->add($user_id, $data);
					$this->session->set_userdata(array('info' => 'Pesanan baru berhasil ditambah!', 'info_tampil' => TRUE));
					redirect('user', 'refresh');
				}
			}
			else {
				show_404();
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	public function tambah_member() {
		if(is_login()) {
			if(is_user('user')) {
				$page 		= input_get('pg');
				$juragan 	= data_session('id');

				if(empty($page)) {
					$halaman = 'tambah_member';
				}
				
				if($this->form_validation->run('submit') === FALSE) {
					$this->data = array(
						'halaman' => $halaman,
						'juragan' => $juragan,
						'member' => $this->juragan_model->memberlist($juragan)
						);

					$this->load->view('inc/header');
					$this->load->view('user/inc/menu_view', $this->data);
					$this->load->view('user/pesanan/tambah_pesanan_member_view', $this->data);
					$this->load->view('inc/user/footer', $this->data);
				}
				else {
					$user_id= input_post('id');
					$nama 	= input_post('nama');
					$member_id 	= input_post('member_id');
					$alamat = nl2br(input_post('alamat'));

    				// kode
					$kode ="";
					foreach(input_post('kode') as $key => $value){
						$kode .= $value .", ";
					}
					$kode = reduce_multiples($kode, ", ", TRUE);
					// jumlah
					$jumlah ="";
					foreach(input_post('jumlah') as $key => $value){
						$jumlah .= $value .", ";
					}
					$jumlah = reduce_multiples($jumlah, ", ", TRUE);
					// size
					$size ="";
					foreach(input_post('size') as $key => $value){
						$size .= $value .", ";
					}
					$size = reduce_multiples($size, ", ", TRUE);

					$s_kode 	= explode(', ', $kode);
					$s_jmlh 	= explode(', ', $jumlah);
					$s_size 	= explode(', ', $size);

					$ukuran 	= array_map('trim', explode(",",$jumlah));
					$totale 	= array_sum($ukuran);

					$pesanan ="";
					$jumlah_array = count($ukuran);
					for ($i = 0; $i < $jumlah_array; ++$i) {
						$pesanan .= $s_kode[$i].','
						.$s_size[$i].','
						.$s_jmlh[$i].'# ';
					}
					$pesanan = reduce_multiples($pesanan, "# ", TRUE);			

					$hp 	= input_post('hp');
					$harga 	= str_replace('.', '', input_post('harga'));
					$ongkir	= str_replace('.', '', input_post('ongkir'));
					$transfer =  str_replace('.', '', input_post('transfer'));
					$status = input_post('status');
					$bank 	= input_post('bank');
					$keterangan = nl2br(input_post('keterangan'));
					if(empty($keterangan))
					{
						$keterangan = NULL;
					}
					$image 	= input_post('image');
					if(empty($image)){
							$image = NULL;
						}

					$data = array(
						'user_id' => $user_id,
						'member_id' => $member_id,
						'nama' 	=> $nama,
						'alamat' => $alamat,
						'hp' 	=> $hp,
						'pesanan' => $pesanan,
						'harga' => $harga,
						'ongkir' => $ongkir,
						'transfer' => $transfer,
						'jumlah' => $totale,
						'status' => $status,
						'bank' => $bank,
						'keterangan' => $keterangan,
						'customgambar' => $image,
						'data' => 'baru'
						);

					$submit = $this->pesanan_model->add($user_id, $data);
					$this->session->set_userdata(array('info' => 'Pesanan baru berhasil ditambah!', 'info_tampil' => TRUE));
					redirect('user', 'refresh');
				}
			}
			else {
				show_404();
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	public function hapus($aksi)
	{
		if(is_login())
		{
			if(is_user('user'))
			{
				$aksi = $this->uri->segment(3);
				$submit = input_post('submit');
				$juragan = input_post('jur');
				$hal = input_post('hal');
				$id = input_post('id');

				$array_hapus = array('alert', 'confirm');
				if(in_array($aksi, $array_hapus) && $submit === 'yes')
				{
					if($aksi === 'alert')
					{
						$data = array('id' => $id, 'halaman' => $hal, 'juragan' => $juragan);
						$this->load->view('user/pesanan/loader_hapus_view', $data);
					}
					elseif($aksi === 'confirm')
					{
						$hapus = $this->pesanan_model->hapus($id);
						if($hapus)
						{
							$this->session->set_userdata(array(
								'info'  => 'Data ID ' . $id. ' berhasil dihapus!',
								'info_tampil' => TRUE
								));
						}
						else
						{
							$this->session->set_userdata(array(
								'info'  => 'Data ID ' . $id. ' gagal dihapus!',
								'info_tampil' => TRUE
								));
						}

						redirect('user?pg=' . $hal, 'refresh');
					}
				}
				else
				{
					show_404();
				}
			}
			else
			{
				show_404();
			}
		}
		else
		{
			show_404();
		}
	}

	public function status()
	{
		if(is_login())
		{
			if(is_user('user'))
			{
				//$juragan 	= input_get('juragan');
				$juragan 	= data_session('id');
				$tanggal_mulai 		= input_get('tanggal_mulai');
				$tanggal_akhir 		= input_get('tanggal_akhir');

				if(empty($tanggal_mulai) || empty($tanggal_akhir))
				{
					$tanggal_mulai = date_range('mulai');
					$tanggal_akhir = date_range('akhir');
				}
			
				$this->data = array(
					'halaman' => get_halaman('status'),
					'juragan' => get_juragan($juragan),
					'tanggal_mulai' => $tanggal_mulai,
					'tanggal_akhir' => $tanggal_akhir,
					'total_pesanan' => $this->pesanan_model->total_pesanan($tanggal_mulai, $tanggal_akhir),
					'total_transfer' => $this->pesanan_model->total_transfer($tanggal_mulai, $tanggal_akhir),
					'total_terkirim' => $this->pesanan_model->total_terkirim($tanggal_mulai, $tanggal_akhir),
					'total_pending' => $this->pesanan_model->total_pending()
				);

				$this->load->view('inc/header');
				$this->load->view('user/inc/menu_view', $this->data);
				$this->load->view('user/status_view', $this->data);
				$this->load->view('inc/user/footer', $this->data);
			}
			else
			{
				show_404();
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
		// $this->load->view('welcome_message');
	}

	public function edit($id)
	{
		if(is_login())
		{
			if(is_user('user'))
			{
				$id = $this->uri->segment('3');
				$halaman = input_get('halaman');
				$user_id = data_session('id');

				$cek_data = $this->pesanan_model->boleh_edit($id, $user_id, TRUE);
				if($cek_data) {
					if($this->form_validation->run('submit') === FALSE) {
						$this->data = array(
						'halaman' => 'edit',
						'juragan' => $user_id,
						'pesanan' => $this->pesanan_model->get_pesanan_id($id)
						);

						$this->load->view('inc/header');
						$this->load->view('user/inc/menu_view', $this->data);
						$this->load->view('user/pesanan/edit_pesanan_view', $this->data);
						$this->load->view('inc/user/footer', $this->data);
					}
					else {
						$id 	= input_post('id');
						$nama 	= input_post('nama');
						$alamat = nl2br(input_post('alamat'));

	    				// kode
						$kode ="";
						foreach(input_post('kode') as $key => $value){
							$kode .= $value .", ";
						}
						$kode = reduce_multiples($kode, ", ", TRUE);
						// jumlah
						$jumlah ="";
						foreach(input_post('jumlah') as $key => $value){
							$jumlah .= $value .", ";
						}
						$jumlah = reduce_multiples($jumlah, ", ", TRUE);
						// size
						$size ="";
						foreach(input_post('size') as $key => $value){
							$size .= $value .", ";
						}
						$size = reduce_multiples($size, ", ", TRUE);

						$s_kode 	= explode(', ', $kode);
						$s_jmlh 	= explode(', ', $jumlah);
						$s_size 	= explode(', ', $size);

						$ukuran 	= array_map('trim', explode(",",$jumlah));
						$totale 	= array_sum($ukuran);

						$pesanan ="";
						$jumlah_array = count($ukuran);
						for ($i = 0; $i < $jumlah_array; ++$i) {
							$pesanan .= $s_kode[$i].','
							.$s_size[$i].','
							.$s_jmlh[$i].'# ';
						}
						$pesanan = reduce_multiples($pesanan, "# ", TRUE);			

						$hp 	= input_post('hp');
						$harga 	= str_replace('.', '', input_post('harga'));
						$ongkir	= str_replace('.', '', input_post('ongkir'));
						$transfer =  str_replace('.', '', input_post('transfer'));
						$status = input_post('status');
						$bank 	= input_post('bank');
						$keterangan = nl2br(input_post('keterangan'));
						if(empty($keterangan))
						{
							$keterangan = NULL;
						}
						$image 	= input_post('image');
						if(empty($image)){
							$image = NULL;
						}

						$data = array(
							//'user_id' => $user_id,
							'nama' 	=> $nama,
							'alamat' => $alamat,
							'hp' 	=> $hp,
							'pesanan' => $pesanan,
							'harga' => $harga,
							'ongkir' => $ongkir,
							'transfer' => $transfer,
							'jumlah' => $totale,
							'status' => $status,
							'bank' => $bank,
							'keterangan' => $keterangan,
							'customgambar' => $image
							);

						$this->session->set_userdata(array('info' => 'Pesanan <u>ID-' . $id . '</u> berhasil diubah!', 'info_tampil' => TRUE));
						$this->pesanan_model->update_pesanan($id, $data);
						redirect('user', 'refresh');
					}
				}
				else
				{
					show_404();
				}
			}
			else
			{
				show_404();
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	public function stock()
	{
		if(is_login())
		{
			if(is_user('user'))
			{
				$juragan 	= input_get('juragan');

				$this->data = array(
					'halaman' => get_halaman('stock'),
					'juragan' => get_juragan($juragan)
				);

				$this->load->view('inc/header');
				$this->load->view('user/inc/menu_view', $this->data);
				$this->load->view('stock_view', $this->data);
				$this->load->view('inc/user/footer', $this->data);
			}
			else
			{
				show_404();
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

}

/* End of file default_c.php */
/* Location: ./application/controllers/user/default_c.php */