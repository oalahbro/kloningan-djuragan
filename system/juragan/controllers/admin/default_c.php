<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_c extends CI_Controller {
	/**
	 * pesanan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 15/12/2014 ---
	 */
	public function index()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$page 		= input_get('pg');
				$juragan 	= input_get('juragan');

				$this->data = array(
					'halaman' => get_halaman($page),
					'juragan' => get_juragan($juragan),
					'tambah_member' => ''
				);

				$this->load->view('inc/header');
				$this->load->view('admin/include/menu_view', $this->data);
				$this->load->view('admin/pesanan/pesanan_view', $this->data);
				$this->load->view('inc/admin/footer', $this->data);
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

	public function membership($juragan) {
		if(is_login()) {
			if(is_user('superadmin') || is_user('admin')) {
				$halaman = $this->uri->segment(4,0);
				$this->data = array(
					'halaman' => 'membership',
					'nama_juragan' => $this->juragan_model->nama_juragan($juragan),
					'juragan' => $juragan,
					'membership' => $this->juragan_model->membership($juragan, $halaman)
				);

				$this->load->view('inc/header');
				$this->load->view('admin/include/menu_view', $this->data);
				$this->load->view('admin/membership_view', $this->data);
				$this->load->view('inc/admin/footer', $this->data);
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
			if(is_user('superadmin') || is_user('admin')) {
				$user_id = $this->juragan_model->get_user_id_by_username($juragan);
				$this->data_view = array(
					'user' => $this->juragan_model->get_detail_juragan($user_id),
					'user_card' => $this->juragan_model->member_card($user_id)
					);

				$this->load->view('admin/membership_add_loader_view', $this->data_view);
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
			if(is_user('superadmin') || is_user('admin')) {
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

				$username = $this->juragan_model->get_username_by_user_id($user_id);

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
					redirect('administrator/membership/' . $username);
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
	 * by mylastof@gmail.com 
	 * --- checked 21/12/2014 ---
	 */
	public function lihat_data($halaman, $juragan = false)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$halaman = $this->uri->segment(3);
				$juragan = $this->uri->segment(4);
				$submit  = input_get('submit');
				$cari 	 = input_get('cari');
				$page 	 = input_get('per_page');
				$offset  = '20';

				$data_pesanan = $this->pesanan_model->get_all($halaman, $page, $offset, $cari, $juragan);

				$numrow = $this->pesanan_model->get_all($halaman, NULL, NULL, $cari, $juragan)->num_rows();
				
				$base = site_url('administrator/lihat_data/'.$halaman.'/'.$juragan.'?cari='.$cari);
				
				$config['page_query_string']= TRUE;
				$config['base_url'] 		= $base;
				$config['total_rows'] 		= $numrow;
				$config['per_page']			= $offset;
				$config['num_links'] 		= 5;
				
				$this->pagination->initialize($config);

				$this->data = array(
					'halaman' => get_halaman($halaman),
					'juragan' => get_juragan($juragan),
					'table' => $this->table->generate(),
					'pagination' => $this->pagination->create_links(),
					'pesanan' => $data_pesanan
				);

				if($submit === 'yes')
				{
					$this->load->view('admin/pesanan/pesanan_loader_view', $this->data);
				}
				else
				{
					show_404();
				}
				
			}
			elseif(is_user('user'))
			{
				show_404();
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
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	public function tambah($user_id = NULL) {
		if(is_login()) {
			if(is_user('superadmin') || is_user('admin')) {
				$juragan 	= $this->uri->segment(3);

				if( ! empty($juragan)) {
					if($this->form_validation->run('submit') === FALSE) {
						$this->data = array(
							'halaman' => get_halaman('tambah'),
							'juragan' => get_juragan($juragan),
							'tambah_member' => $this->juragan_model->memberships($user_id)
						);

						if( ! empty($juragan)) {
							$this->load->view('inc/header');
							$this->load->view('admin/include/menu_view', $this->data);
							$this->load->view('admin/pesanan/tambah_pesanan_view', $this->data);
							$this->load->view('inc/admin/footer', $this->data);
						}
						else {
							show_404();
						}
					}
					else {
						$user_id= input_post('id');
						$nama 	= input_post('nama');
						$alamat = nl2br(input_post('alamat'));

	    				// kode
						$kode 	= "";
						foreach(input_post('kode') as $key => $value){
						    $kode .= $value .", ";
						}
						$kode = reduce_multiples($kode, ", ", TRUE);
						// jumlah
						$jumlah = "";
						foreach(input_post('jumlah') as $key => $value){
						    $jumlah .= $value .", ";
						}
						$jumlah = reduce_multiples($jumlah, ", ", TRUE);
						// size
						$size 	= "";
						foreach(input_post('size') as $key => $value){
						    $size .= $value .", ";
						}
						$size = reduce_multiples($size, ", ", TRUE);

						$s_kode 	= explode(', ', $kode);
						$s_jmlh 	= explode(', ', $jumlah);
						$s_size 	= explode(', ', $size);

						$ukuran 	= array_map('trim', explode(",",$jumlah));
						$totale 	= array_sum($ukuran);

						$pesanan 	= "";
						$jumlah_array = count($ukuran);
						for ($i = 0; $i < $jumlah_array; ++$i) {
						    $pesanan .= $s_kode[$i].','
						    			.$s_size[$i].','
						    			.$s_jmlh[$i].'# ';
						}
						$pesanan = reduce_multiples($pesanan, "# ", TRUE);

						//echo $pesanan;
						$hp 	= input_post('hp');
						$harga 	= str_replace('.', '', input_post('harga'));
						$ongkir	= str_replace('.', '', input_post('ongkir'));
						$transfer =  str_replace('.', '', input_post('transfer'));
						$status = input_post('status');
						$bank 	= input_post('bank');
						$keterangan = nl2br(input_post('keterangan'));
						if(empty($keterangan)) {
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
							'jumlah' => $totale,
							'transfer' => $transfer,
							'status' => $status,
							'bank' => $bank,
							'keterangan' => $keterangan,
							'data' => 'baru',
							'customgambar' => $image,
							'unik' => $user_id . '_' .random_string('unique', 32)
						);

						$this->pesanan_model->add($user_id, $data);
						$this->session->set_userdata(array('info' => 'Data pesanan baru sudah disimpan.', 'info_tampil' => TRUE));

						redirect('administrator?pg=pending&juragan=' . $user_id);
					}
				}
				else {
					show_404();
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

	public function tambah_member($user_id = NULL) {
		if(is_login()) {
			if(is_user('superadmin') || is_user('admin')) {
				$juragan 	= $this->uri->segment(3);

				if( ! empty($juragan)) {
					if($this->form_validation->run('submit') === FALSE) {
						$this->data = array(
							'halaman' => get_halaman('tambah_member'),
							'juragan' => get_juragan($juragan),
							'tambah_member' => $this->juragan_model->memberships($user_id),
							'member' => $this->juragan_model->memberlist($user_id)
						);

						if( ! empty($juragan)) {
							$this->load->view('inc/header');
							$this->load->view('admin/include/menu_view', $this->data);
							$this->load->view('admin/pesanan/tambah_pesanan_member_view', $this->data);
							$this->load->view('inc/admin/footer', $this->data);
						}
						else {
							show_404();
						}
					}
					else {
						$user_id= input_post('id');
						$nama 	= input_post('nama');
						$alamat = nl2br(input_post('alamat'));

	    				// kode
						$kode 	= "";
						foreach(input_post('kode') as $key => $value){
						    $kode .= $value .", ";
						}
						$kode = reduce_multiples($kode, ", ", TRUE);
						// jumlah
						$jumlah = "";
						foreach(input_post('jumlah') as $key => $value){
						    $jumlah .= $value .", ";
						}
						$jumlah = reduce_multiples($jumlah, ", ", TRUE);
						// size
						$size 	= "";
						foreach(input_post('size') as $key => $value){
						    $size .= $value .", ";
						}
						$size = reduce_multiples($size, ", ", TRUE);

						$s_kode 	= explode(', ', $kode);
						$s_jmlh 	= explode(', ', $jumlah);
						$s_size 	= explode(', ', $size);

						$ukuran 	= array_map('trim', explode(",",$jumlah));
						$totale 	= array_sum($ukuran);

						$pesanan 	= "";
						$jumlah_array = count($ukuran);
						for ($i = 0; $i < $jumlah_array; ++$i) {
						    $pesanan .= $s_kode[$i].','
						    			.$s_size[$i].','
						    			.$s_jmlh[$i].'# ';
						}
						$pesanan = reduce_multiples($pesanan, "# ", TRUE);

						//echo $pesanan;
						$hp 	= input_post('hp');
						$harga 	= str_replace('.', '', input_post('harga'));
						$ongkir	= str_replace('.', '', input_post('ongkir'));
						$transfer =  str_replace('.', '', input_post('transfer'));
						$status = input_post('status');
						$bank 	= input_post('bank');
						$member 	= input_post('member_id');
						$keterangan = nl2br(input_post('keterangan'));
						if(empty($keterangan)) {
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
							'jumlah' => $totale,
							'transfer' => $transfer,
							'status' => $status,
							'bank' => $bank,
							'keterangan' => $keterangan,
							'data' => 'baru',
							'member_id' => $member,
							'customgambar' => $image,
'unik' => $user_id . '_' .random_string('unique', 32)
						);

						$this->pesanan_model->add($user_id, $data);
						$this->session->set_userdata(array('info' => 'Data pesanan baru sudah disimpan.', 'info_tampil' => TRUE));

						redirect('administrator?pg=pending&juragan=' . $user_id);
					}
				}
				else {
					show_404();
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
	 * edit_pesanan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 21/12/2014 ---
	 */
	public function edit_pesanan($id)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$juragan 	= $this->uri->segment('5');
				$halaman 	= $this->uri->segment('4');
				$id 		= $this->uri->segment('3');

				$cek_pesanan = $this->pesanan_model->get_pesanan_id($id);
				$row = $cek_pesanan->row(); 
				
				if($this->form_validation->run('submit') === FALSE)
				{
					$this->data = array(
						'halaman' => get_halaman('edit'),
						'juragan' => get_juragan($juragan),
						'pesanan' => $cek_pesanan
					);

					$this->load->view('inc/header');
					$this->load->view('admin/include/menu_view', $this->data);
					if($row->data === 'baru')
					{
						$this->load->view('admin/pesanan/edit_pesanan_view', $this->data);
					}
					else
					{
						$this->load->view('admin/pesanan/edit_pesanan_lama_view', $this->data);
					}
					$this->load->view('inc/admin/footer', $this->data);
				}
				else
				{
					$id 	= input_post('id');
					$nama 	= input_post('nama');
					$alamat = nl2br(input_post('alamat')); //input_post('alamat');

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
						'nama' 	=> $nama,
						'alamat' => $alamat,
						'hp' 	=> $hp,
						'pesanan' => $pesanan,
						'harga' => $harga,
						'ongkir' => $ongkir,
						'jumlah' => $totale,
						'transfer' => $transfer,
						'status' => $status,
						'bank' => $bank,
						'keterangan' => $keterangan,
						'data' => 'baru',
						'customgambar' => $image
					);

					$this->pesanan_model->update_pesanan($id, $data);
					$this->session->set_userdata(array('info' => 'Pesanan <u>ID-' . $id . '</u> berhasil diubah!', 'info_tampil' => TRUE));

					redirect('administrator?pg=' . $halaman . '$juragan=' . $juragan);
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

	/**
	 * update_pesanan_lama()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 21/12/2014 ---
	 */
	public function update_pesanan_lama()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('nama', 	'Nama', 	'trim|required|xss_clean');
				$this->form_validation->set_rules('alamat', 'Alamat', 	'trim|required|xss_clean');
				$this->form_validation->set_rules('hp', 	'HP', 		'trim|required|xss_clean|min_length[10]|max_length[14]|numeric');
				$this->form_validation->set_rules('kode', 'Kode', 		'trim|required|xss_clean');
				$this->form_validation->set_rules('jumlah', 'Jumlah', 	'trim|required|xss_clean|numeric|is_natural_no_zero');
				$this->form_validation->set_rules('harga', 	'Harga', 	'trim|required|xss_clean|numeric');
				$this->form_validation->set_rules('ongkir', 'Ongkir', 	'trim|required|xss_clean|numeric');
				$this->form_validation->set_rules('transfer', 'Transfer', 'trim|required|xss_clean|numeric');
				$this->form_validation->set_rules('status', 'Status', 	'trim|required|xss_clean');
				$this->form_validation->set_rules('bank', 	'Bank', 	'trim|required|xss_clean');
				$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|xss_clean');
				$this->form_validation->set_rules('image', 	'Gambar', 	'xss_clean');
				if($this->form_validation->run() === FALSE)
				{
					echo "data gagal disimpan";
				}
				else
				{
					$id 	= input_post('id');
					$nama 	= input_post('nama');
					$alamat = nl2br(input_post('alamat'));
					$kode 	= input_post('kode');
					$jumlah = input_post('jumlah');
					$hp 	= input_post('hp');
					$harga 	= input_post('harga');
					$ongkir	= input_post('ongkir');
					$transfer = input_post('transfer');
					$status = input_post('status');
					$bank 	= input_post('bank');
					$keterangan = nl2br(input_post('keterangan'));
					$image 	= input_post('image');

					if(empty($keterangan)){
						$keterangan = NULL;
					}
					if(empty($image)){
						$image = NULL;
					}

					$data = array(
						'nama' 	=> $nama,
						'alamat' => $alamat,
						'hp' 	=> $hp,
						'kode' => $kode,
						'jumlah' => $jumlah,
						'harga' => $harga,
						'ongkir' => $ongkir,
						'jumlah' => $jumlah,
						'transfer' => $transfer,
						'status' => $status,
						'bank' => $bank,
						'keterangan' => $keterangan,
						'customgambar' => $image
					);

					$this->pesanan_model->update_pesanan($id, $data);
					$this->session->set_userdata('info', 'Pesanan <u>ID-' . $id . '</u> berhasil diupdate!');

					redirect('administrator');
				}
			}
		}
	}

	/**
	 * set_up()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	public function set_up()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$submit = $this->input->post('submit');
				$data = $this->input->post('id');

				$pecah = explode("_", $data);
				$aksi = $pecah[0]; 
				$id = $pecah[1];

				$info_set = '';
				$user_id = $this->juragan_model->get_user_id_by_pesanan_id($id);

				$pg_array = array("transfer-ok", "transfer-remove", "kirim-remove");

				if( ! empty($aksi) && in_array($aksi, $pg_array))
				{
					if($aksi === 'transfer-ok') // set transfer masuk
					{
						$set = $this->pesanan_model->set_to_transfer($id, 'ok', $user_id);
						$info_set = 'sudah transfer';
					}
					elseif($aksi === 'transfer-remove') // set belum transfer
					{
						$set = $this->pesanan_model->set_to_transfer($id, 'remove', $user_id);
						$info_set = 'belum transfer';
					}
					elseif($aksi === 'kirim-remove') // set belum dikirim
					{
						$set = $this->pesanan_model->set_to_kirim($id, 'remove', $user_id);
						$info_set = 'belum kirim';
					}
				}
				// notifikasi by session
				if($set)
				{
					$this->session->set_userdata(array('info' => 'Pesanan <u>ID-' . $id . '</u> berhasil diubah menjadi "'.$info_set.'"!', 'info_tampil' => TRUE));
				}
				else
				{
					$this->session->set_userdata(array('info' => 'Pesanan <u>ID-' . $id . '</u> gagal diubah "'.$info_set.'"!', 'info_tampil' => TRUE));
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

	/**
	 * resi()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	public function resi($aksi)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$aksi = $this->uri->segment(3);
				$url = input_post('url');
				$submit = $this->input->post('submit');
				$data = $this->input->post('id');
				$kurir = $this->input->post('kurir');
				$lain = $this->input->post('lain');
				$ongkir = $this->input->post('ongkir');
				$resi = $this->input->post('resi');

				$pecah = explode("_", $data);
				$section = $pecah[0]; 
				$id = $pecah[1];

				$pesan_success = 'Resi untuk <u>ID-' . $id . '</u> berhasil disimpan!';
				$pesan_failed = 'Resi untuk <u>ID-' . $id . '</u> gagal disimpan!';

				$this->form_validation->set_rules('kurir', 	'', 	'trim|xss_clean');
				$this->form_validation->set_rules('resi', '', 	'trim|xss_clean');
				$this->form_validation->set_rules('lain', '', 	'trim|xss_clean');
				$this->form_validation->set_rules('ongkir', '', 	'trim|xss_clean|numeric');

				$user_id = $this->juragan_model->get_user_id_by_pesanan_id($id);

				if($kurir === 'lainnya')
				{
					$kurir_c = $lain;
				}
				else
				{
					$kurir_c = $kurir;
				}

				$array_resi = array('form', 'confirm');

				if(in_array($aksi, $array_resi) && $submit === 'yes')
				{
					if($aksi === 'form' && $section === 'kirim-ok')
					{
						$this->data = array(
							'pesanan' => $this->pesanan_model->get_pesanan_id($id)
						);

						$this->load->view('admin/pesanan/loader_resi_view', $this->data);
					}
					elseif($aksi === 'confirm' && $section === 'submit-resi')
					{
						if($this->form_validation->run() === FALSE)
						{
							$this->session->set_userdata(array('info' => $pesan_failed, 'info_tampil' => TRUE));
						}
						else
						{
							if(empty($ongkir) || $ongkir === '0')
							{
								$ongkir = NULL;
							}
							$this->data = array(
								'kurir' => $kurir_c,
								'resi'	=> $resi,
								'barang'=> 'Terkirim',
								'ongkir_fix' => $ongkir
							);
							$this->pesanan_model->submit_resi($id, $this->data, $user_id);

							if($submit)
							{
								$this->session->set_userdata(array('info' => $pesan_success, 'info_tampil' => TRUE));
							}
							else
							{
								$this->session->set_userdata(array('info' => $pesan_failed, 'info_tampil' => TRUE));
							}
						}
						
						redirect($url, 'refresh');
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

	/**
	 * hapus()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 21/12/2014 ---
	 */
	public function hapus($aksi)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
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
						//$data = array('id' => $id, 'halaman' => $hal, 'juragan' => $juragan);
						//$this->load->view('admin/pesanan/loader_hapus_view', $data);
					}
					elseif($aksi === 'confirm')
					{
						$hapus = $this->pesanan_model->hapus($id);
						if($hapus)
						{
							$this->session->set_userdata(array('info' => 'Data <u>ID ' . $id. '</u> berhasil dihapus!', 'info_tampil' => TRUE));
						}
						else
						{
							$this->session->set_userdata(array('info' => 'Data <u>ID ' . $id. '</u> gagal dihapus!', 'info_tampil' => TRUE));
						}
						if($juragan > 0)
						{
							$red = '&juragan=' . $juragan;
						}
						else
						{
							$red = '';
						}
						redirect('administrator?pg=' . $hal . $red, 'refresh');
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

	/**
	 * juragan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 21/12/2014 ---
	 */
	public function juragan()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$page = $this->uri->segment(2);

				$this->data = array(
					'halaman' => get_halaman($page),
					'juragan' => NULL
					//'judul' => ucwords('Daftar Semua juragan'),
					//'dropdown_header' => $this->juragan_model->dropdown_juragan()
				);

				$this->load->view('inc/header');
				$this->load->view('admin/include/menu_view', $this->data);
				$this->load->view('admin/pengaturan/juragan_view', $this->data);
				$this->load->view('inc/admin/footer', $this->data);
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
		
	/**
	 * tambah_juragan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function tambah_juragan()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('nama', 'Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[4]|is_unique[user.username]|alpha_dash');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[password_c]|min_length[4]');
				$this->form_validation->set_rules('password_c', 'Confirm Password', 'trim|required|xss_clean');
				$this->form_validation->set_rules('short', 'Shortcode', 'trim|required|xss_clean|max_length[2]');
				$this->form_validation->set_rules('membership', 'Membership', 'trim|xss_clean');
				
				if($this->form_validation->run() === FALSE) {
					$sesi = array(
						'pesan'  => 'Data Juragan gagal disimpan.',
						'pesan_tampil' => TRUE
					);
					$this->session->set_userdata($sesi);
				}
				else {
					$nama 		= input_post('nama');
					$username 	= input_post('username');
					$password 	= input_post('password');
					$short 		= input_post('short');

					$member		= input_post('membership');
					$membership = '0';
					if($member === 'aktif') {
						$membership = '1';
					}
					
					$login = $this->juragan_model->add($nama, $short, $username, $password, $membership);

					$sesi = array(
						'pesan'  => 'Sip, Juragan ' . $nama . ' sudah disimpan',
						'pesan_tampil' => TRUE
					);
					$this->session->set_userdata($sesi);
				}

				redirect('administrator/juragan', 'refresh');
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

	/**
	 * tambah_juragan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function tambah_admin()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('nama', 'Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[6]|is_unique[user.username]|alpha_dash');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[password_c]|min_length[8]');
				$this->form_validation->set_rules('password_c', 'Confirm Password', 'trim|required|xss_clean|min_length[8]');
				
				if($this->form_validation->run() === FALSE)
				{
					$sesi = array(
						'pesan'  => 'Data admin gagal disimpan.',
						'pesan_tampil' => TRUE
					);
					$this->session->set_userdata($sesi);
				}
				else
				{
					$nama 		= input_post('nama');
					$username 	= input_post('username');
					$password 	= input_post('password');
					
					$login = $this->juragan_model->add_admin($nama, $username, $password);

					$sesi = array(
						'pesan'  => 'Sip, admin ' . $nama . ' sudah disimpan',
						'pesan_tampil' => TRUE
					);
					$this->session->set_userdata($sesi);
				}

				redirect('administrator/juragan', 'refresh');
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

	/**
	 * edit_juragan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function edit_juragan()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$user_id = $this->uri->segment(3);
				$id = input_post('id');

				$this->data = array(
					'user' => $this->juragan_model->get_detail_juragan($user_id)
				);

				if( ! empty($id)) 
				{
					$this->load->view('admin/pengaturan/juragan_edit_loader_view', $this->data);
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

	/**
	 * simpan_juragan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function simpan_juragan() {
		if(is_login()) {
			if(is_user('superadmin') || is_user('admin')) {
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|matches[password_2]');
				$this->form_validation->set_rules('password_2', 'Ulangi password', 'trim|xss_clean');
				$this->form_validation->set_rules('membership', 'Membership', 'trim|xss_clean');
				$this->form_validation->set_rules('short', 'Shortcode', 'trim|xss_clean|required|max_length[2]');
				
				if($this->form_validation->run() === FALSE) {
					$this->session->set_userdata(array(
						'pesan'  => '<div class="alert alert-danger">Gagal, ada kesalahan.</div>'
					));
				}
				else {
					$id = input_post('id');
					$nama = input_post('nama');
					$password = input_post('password');
					$short = input_post('short');

					$member		= input_post('membership');
					$membership = '0';
					if($member === 'aktif') {
						$membership = '1';
					}

					$update = $this->juragan_model->update($id, $nama, $short, $password, $membership);

					$this->session->set_userdata(array(
						'pesan'  => '<div class="alert alert-danger">Berhasil diupdate!</div>'
					));
				}
				redirect('administrator/juragan');
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	/**
	 * hapus_juragan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function hapus_juragan($aksi, $id)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$aksi = $this->uri->segment(3);
				$id = $this->uri->segment(4);
				$array_hapus = array('alert', 'konfirm');

				if(in_array($aksi, $array_hapus))
				{
					if($aksi === 'alert')
					{
						$data = array(
							'id' => $id
						);

						$post_id = input_post('id');
						if( ! empty($post_id)) 
						{
							$this->load->view('admin/pengaturan/juragan_hapus_load_view', $data);
						}
						else
						{
							show_404();
						}
					}
					elseif($aksi === 'konfirm')
					{
						$this->juragan_model->delete($id);

						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-danger">Data berhasil dihapus!</div>'
						));
						redirect('administrator/juragan', 'refresh');

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

	/**
	 * produk()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function produk()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$kategori_id = input_get('kategori');
				if(empty($kategori))
				{
					$kategori = '0';
				}
				$this->data = array(
					'halaman' => get_halaman('produk'),
					'juragan' => NULL,
					'produk' => $this->produk_model->get_produk($kategori_id),
					'kategori' => $this->produk_model->get_kategori()->result()
				);

				$this->load->view('inc/header');
				$this->load->view('admin/include/menu_view', $this->data);
				$this->load->view('admin/pengaturan/produk_view', $this->data);
				$this->load->view('inc/admin/footer', $this->data);
			}
			elseif(is_user('user'))
			{
				echo 'user';
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
		// $this->load->view('welcome_message');
	}

	/**
	 * tambah_kategori()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function tambah_kategori()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$data 	= input_post('nama_kategori');
				$nama_kategori = ucwords($data);

				$this->form_validation->set_rules('nama_kategori', 	'Nama Kategori', 	'trim|required|xss_clean|is_unique[produk_kategori.nama]');

				if($this->form_validation->run() === FALSE)
				{
					echo "data gagal disimpan";
				}
				else
				{
					$this->produk_model->add_kategori($nama_kategori);
				}

				redirect('administrator/produk');
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

	/**
	 * hapus_kategori()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function hapus_kategori($aksi, $id)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$aksi = $this->uri->segment(3);
				$id = $this->uri->segment(4);
				$array_hapus = array('alert', 'konfirm');

				if(in_array($aksi, $array_hapus))
				{
					if($aksi === 'alert')
					{
						$data = array(
							'id' => $id
						);

						$post_id = input_post('id');
						if( ! empty($post_id)) 
						{
							$this->load->view('admin/pengaturan/kategori_hapus_load_view', $data);
						}
						else
						{
							show_404();
						}
					}
					elseif($aksi === 'konfirm')
					{
						$this->produk_model->hapus_kategori($id);

						redirect('administrator/produk', 'refresh');

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

	/**
	 * tambah_produk()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function tambah_produk()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('kategori_id', 'Kategoru', 'trim|required|xss_clean');
				$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required|xss_clean');
				$this->form_validation->set_rules('kode_produk', 'Kode Produk', 'trim|required|xss_clean|is_unique[produk_daftar.kode]');
				$this->form_validation->set_rules('harga_produk', 'Harga Produk', 'trim|required|xss_clean|numeric');
				
				if($this->form_validation->run() === FALSE)
				{
					//
					$this->session->set_userdata(array(
						'pesan'  => '<div class="alert alert-danger">Gagal, ada kesalahan.</div>'
					));
					redirect('produk', 'refresh');
				}
				else
				{
					$kategori_id	= $this->input->post('kategori_id');
					$nama_produk 	= ucwords($this->input->post('nama_produk'));
					$kode_produk 	= strtoupper($this->input->post('kode_produk'));
					$harga_produk 	= $this->input->post('harga_produk');

					$this->data = array(
						'kategori_id' => $kategori_id,
						'nama'	=> $nama_produk,
						'kode' 	=> $kode_produk,
						'harga' => $harga_produk
						);
					
					$submit_produk 	= $this->produk_model->add_produk($this->data);

					if($submit_produk)
					{
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-success">Data Produk baru berhasil disimpan.</div>'
						));
					}
					else
					{
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-danger">Data produk baru gagal disimpan.</div>'
						));
					}
					redirect('administrator/produk', 'refresh');
				}
			}
			elseif(is_user('user'))
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

	/**
	 * edit_produk()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function edit_produk($produk_id)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$produk_id = $this->uri->segment(4);
				$id = input_post('id');

				$this->data = array(
					'produk' => $this->produk_model->get_detail_produk($produk_id),
					'kategori' => $this->produk_model->get_kategori()->result()
				);

				if( ! empty($id)) 
				{
					$this->load->view('admin/pengaturan/produk_edit_loader_view', $this->data);
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

	/**
	 * simpan_produk()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function simpan_produk()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('kategori_id', 'Kategoru', 'trim|required|xss_clean');
				$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required|xss_clean');
				$this->form_validation->set_rules('harga_produk', 'Harga Produk', 'trim|required|xss_clean|numeric');
				
				if($this->form_validation->run() === FALSE)
				{
					$this->session->set_userdata(array(
						'pesan'  => '<div class="alert alert-danger">Gagal, ada kesalahan.</div>'
					));
				}
				else
				{
					$produk_id 		= input_post('id');
					$kategori_id	= input_post('kategori_id');
					$nama_produk 	= ucwords(input_post('nama_produk'));
					$harga_produk 	= input_post('harga_produk');

					$this->data = array(
						'kategori_id' => $kategori_id,
						'nama'	=> $nama_produk,
						'harga' => $harga_produk
						);
					
					$submit_produk 	= $this->produk_model->save_produk($this->data, $produk_id);

					if($submit_produk)
					{
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-success">Produk berhasil diubah.</div>'
						));
					}
					else
					{
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-danger">Produk gagal diubah.</div>'
						));
					}
				}
				redirect('administrator/produk?kategori=' . $kategori_id, 'refresh');
			}
			elseif(is_user('user'))
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

	/**
	 * hapus_produk()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 22/12/2014 ---
	 */
	public function hapus_produk($aksi, $id)
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$aksi = $this->uri->segment(3);
				$id = $this->uri->segment(4);
				$kategori = $this->uri->segment(5);
				$array_hapus = array('alert', 'konfirm');

				if(in_array($aksi, $array_hapus))
				{
					if($aksi === 'alert')
					{
						$data = array(
							'id' => $id,
							'kategori' => $kategori
						);

						$post_id = input_post('id');
						if( ! empty($post_id)) 
						{
							$this->load->view('admin/pengaturan/produk_hapus_load_view', $data);
						}
						else
						{
							show_404();
						}
					}
					elseif($aksi === 'konfirm')
					{
						$this->produk_model->hapus_produk($id);
						$this->session->set_userdata(array(
							'pesan'  => '<div class="alert alert-success">Produk berhasil dihapus.</div>'
						));
						redirect('administrator/produk?kategori=' . $kategori, 'refresh');
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

	/**
	 * status()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	public function status()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$juragan 	= input_get('juragan');
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
				$this->load->view('admin/include/menu_view', $this->data);
				$this->load->view('admin/status_view', $this->data);
				$this->load->view('inc/admin/footer', $this->data);
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

	/**
	 * stock()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	public function stock()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$juragan 	= input_get('juragan');

				$this->data = array(
					'halaman' => get_halaman('stock'),
					'juragan' => get_juragan($juragan)
				);

				$this->load->view('inc/header');
				$this->load->view('admin/include/menu_view', $this->data);
				$this->load->view('stock_view', $this->data);
				$this->load->view('inc/admin/footer', $this->data);
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

	/**
	 * pengaturan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	public function pengaturan()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->data = array(
					'halaman' => 'pengaturan',
					'juragan' => NULL,
					'kurir' => $this->kurir_model->show_all(),
					'size' => $this->produk_model->get_size()
				);

				$this->load->view('inc/header');
				$this->load->view('admin/include/menu_view', $this->data);
				$this->load->view('admin/pengaturan/pengaturan_view', $this->data);
				$this->load->view('inc/admin/footer', $this->data);
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

	/**
	 * pengaturan_update()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	public function pengaturan_update()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'trim|required|xss_clean');
				$this->form_validation->set_rules('tanggal_selesai', 'Tanggal Akhir', 'trim|required|xss_clean');
				$this->form_validation->set_rules('config_tanggal_range', 'Tanggal Akhir', 'trim|xss_clean');

				$range = input_post('config_tanggal_range');
				$tanggal_mulai = input_post('tanggal_mulai');
				$tanggal_selesai = input_post('tanggal_selesai');

				if(empty($range))
				{
					$range = '0';
				}

				if($range ==='1')
				{
					$update_data = array(
						'config_tanggal_mulai' => $tanggal_mulai,
						'config_tanggal_selesai' => $tanggal_selesai,
						'config_tanggal_range' => $range
					);
				}
				else
				{
					$update_data = array(
						'config_tanggal_range' => $range
					);
				}

				

				if ($this->form_validation->run() === FALSE)
				{
					$this->session->set_userdata(array('pesan' => 'Pengaturan gagal diupdate.', 'pesan_tampil' => TRUE));
				}
				else
				{
					$success = $this->siteconfig->update_config($update_data);
					$this->session->set_userdata(array('pesan' => 'Pengaturan berhasil diupdate.', 'pesan_tampil' => TRUE));
				}
				redirect('administrator/pengaturan', 'refresh');				
			}
			else
			{
				show_404();
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

	/**
	 * tambah_kurir()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	public function tambah_kurir()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('kurir', 'Kurir', 'trim|required|xss_clean|max_length[50]|min_length[3]');

				if($this->form_validation->run() === FALSE)
				{
					$this->session->set_userdata(array(
						'pesan'  => 'Gagal, ada kesalahan.',
						'pesan_tampil' => TRUE
					));
				}
				else
				{
					$kurir 	= ucwords($this->input->post('kurir'));

					$this->data = array(
						'nama' => $kurir
						);
					
					$submit_kurir 	= $this->kurir_model->add($this->data);

					if($submit_kurir)
					{
						$this->session->set_userdata(array(
							'pesan'  => 'Data kurir baru berhasil disimpan.',
							'pesan_tampil' => TRUE
						));
					}
					else
					{
						$this->session->set_userdata(array(
							'pesan'  => 'Data kurir baru gagal disimpan.',
							'pesan_tampil' => TRUE
						));
					}
				}
				redirect('administrator/pengaturan', 'refresh');
			}
		}
	}

	/**
	 * tambah_size()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	public function tambah_size()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$this->form_validation->set_rules('size', 'size', 'trim|required|xss_clean|max_length[10]|min_length[1]');

				if($this->form_validation->run() === FALSE)
				{
					$this->session->set_userdata(array(
						'pesan'  => 'Gagal, ada kesalahan.',
						'pesan_tampil' => TRUE
					));
				}
				else
				{
					$size 	= ucwords($this->input->post('size'));

					$this->data = array(
						'size' => $size
						);
					
					$submit_kurir 	= $this->produk_model->add_size($this->data);

					if($submit_kurir)
					{
						$this->session->set_userdata(array(
							'pesan'  => 'Data size baru berhasil disimpan.',
							'pesan_tampil' => TRUE
						));
					}
					else
					{
						$this->session->set_userdata(array(
							'pesan'  => 'Data size baru gagal disimpan.',
							'pesan_tampil' => TRUE
						));
					}
				}
				redirect('administrator/pengaturan', 'refresh');
			}
		}
	}

	/**
	 * hapus_pengaturan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	public function hapus_pengaturan()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$data = input_post('data');
				$id = input_post('id');

				$array_hapus = array('kurir','size');

				if(in_array($data, $array_hapus))
				{
					if($data === 'kurir')
					{
						$this->kurir_model->delete($id);
					}
					else
					{
						$this->produk_model->hapus_size($id);
					}

					$this->session->set_userdata(array(
						'pesan'  => 'Data berhasil dihapus.',
						'pesan_tampil' => TRUE
					));

					redirect('administrator/pengaturan');
				}
			}
		}
	}

	/**
	 * export()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 21/03/2015 ---
	 */
	public function export()
	{
		if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
				$juragan 	= input_get('juragan');
				$tanggal_mulai 		= input_get('tanggal_mulai');
				$tanggal_akhir 		= input_get('tanggal_akhir');

				if(empty($tanggal_mulai) || empty($tanggal_akhir))
				{
					$tanggal_mulai = date_range('mulai');
					$tanggal_akhir = date_range('akhir');
				}

				$this->data = array(
					'halaman' => 'export data',
					'juragan' => get_juragan($juragan),
					'tanggal_mulai' => $tanggal_mulai,
					'tanggal_akhir' => $tanggal_akhir,
					'total_pesanan' => $this->pesanan_model->total_pesanan($tanggal_mulai, $tanggal_akhir),
					'total_transfer' => $this->pesanan_model->total_transfer($tanggal_mulai, $tanggal_akhir),
					'total_terkirim' => $this->pesanan_model->total_terkirim($tanggal_mulai, $tanggal_akhir),
					'total_pending' => $this->pesanan_model->total_pending(),
					'dft_juragan' => $this->juragan_model->get_all()
				);

				$this->load->view('inc/header');
				$this->load->view('admin/include/menu_view', $this->data);
				$this->load->view('admin/export_view', $this->data);
				$this->load->view('inc/admin/footer', $this->data);
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


	function exports()
	{
		if(is_login())
		{
			$mulai = $this->input->post('tanggal_mulai');
			$akhir = $this->input->post('tanggal_akhir');
			$juragan = $this->input->post('juragan');

			if($juragan !== '0')
			{
				$nama_juragan = $this->juragan_model->get_nama_juragan_by_id($juragan);
			}
			else {
				$nama_juragan = 'SEMUA JURAGAN';
			}
			
			
			$nama = 'pesanan ' . $nama_juragan . '_' . str_replace('-',' ', $mulai . ' - ' . $akhir);
			$namanya = url_title($nama, '_', TRUE);
						
			$this->load->library('excel');
			$this->excel->getProperties()->setCreator("Toto Prayogo")
								 ->setLastModifiedBy("Toto Prayogo")
								 ->setTitle("".$nama."")
								 ->setSubject("".$nama."")
								 ->setDescription("Presensi Bulanan (".$mulai . " - " . $akhir.") Twelve inc")
								 ->setKeywords("presensi, office, twelve inc")
								 ->setCategory("excel");
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			
			$query = $this->pesanan_model->get_export( $mulai, $akhir, $juragan);

			

			$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR PESANAN ' . strtoupper($nama_juragan));
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$this->excel->getActiveSheet()->setCellValue('A2', 'Per Tanggal : '. $mulai . " sampai " . $akhir .'');
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
			$this->excel->getActiveSheet()->mergeCells('A1:N1');
			$this->excel->getActiveSheet()->mergeCells('A2:N2');
			
			$this->excel->getActiveSheet()->getStyle('A1:N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$this->excel->getActiveSheet()->setCellValue('A4', 'NO');
			$this->excel->getActiveSheet()->setCellValue('B4', 'TANGGAL ORDER');
			$this->excel->getActiveSheet()->setCellValue('C4', 'JURAGAN');
			$this->excel->getActiveSheet()->setCellValue('D4', 'NAMA BUYER');
			$this->excel->getActiveSheet()->setCellValue('E4', 'HP BUYER');
			$this->excel->getActiveSheet()->setCellValue('F4', 'ALAMAT BUYER');
			$this->excel->getActiveSheet()->setCellValue('G4', 'KODE / SIZE');
			$this->excel->getActiveSheet()->setCellValue('H4', 'HARGA');
			$this->excel->getActiveSheet()->setCellValue('I4', 'ONGKIR');
			$this->excel->getActiveSheet()->setCellValue('J4', 'TRANSFER');
			$this->excel->getActiveSheet()->setCellValue('K4', 'BANK');
			$this->excel->getActiveSheet()->setCellValue('L4', 'KETERANGAN');
			$this->excel->getActiveSheet()->setCellValue('M4', 'RESI');
			$this->excel->getActiveSheet()->setCellValue('N4', 'TANGGAL KIRIM');
			
			$this->excel->getActiveSheet()->getStyle('A4:O4')->getFont()->setBold(true);
			
			$rowCount = 5;
			$nomerUrut = 1;
			$rowawal = $rowCount;

			foreach ($query->result() as $row)
			{ 
				$string = $row->pesanan;
				if($string !== NULL) {
					$s = explode('#', $string);
					$ukuran = array_map('trim',explode("#",$string));
					$jumlah_array = count($ukuran);
					$koden = '';

					for ($i = 0; $i <  $jumlah_array; $i++) {
						$data = array_map('trim',explode(",",$s[$i]));
						$koden .= strtoupper($data[0]). "(" . strtoupper($data[1]). ")\n";
					}
				}
				
				$this->excel->getActiveSheet()->SetCellValue('A'.$rowCount, $row->id); 
				$this->excel->getActiveSheet()->SetCellValue('B'.$rowCount, tanggal($row->tanggal_order, 'd/m/Y')); 
				$this->excel->getActiveSheet()->SetCellValue('C'.$rowCount, strtoupper($row->juragan));
				$this->excel->getActiveSheet()->SetCellValue('D'.$rowCount, strtoupper($row->nama));
				$this->excel->getActiveSheet()->SetCellValue('E'.$rowCount, strtoupper($row->hp));
				$this->excel->getActiveSheet()->SetCellValue('F'.$rowCount, strtoupper(str_replace('<br />', '', $row->alamat))); 
				$this->excel->getActiveSheet()->SetCellValue('G'.$rowCount, $koden); //kode
				$this->excel->getActiveSheet()->SetCellValue('H'.$rowCount, $row->harga); 
				$this->excel->getActiveSheet()->SetCellValue('I'.$rowCount, $row->harga); 
				$this->excel->getActiveSheet()->SetCellValue('J'.$rowCount, $row->transfer); 
				$this->excel->getActiveSheet()->SetCellValue('K'.$rowCount, strtoupper($row->bank)); 
				$this->excel->getActiveSheet()->SetCellValue('L'.$rowCount, str_replace('<br />', '', $row->keterangan)); 
				$this->excel->getActiveSheet()->SetCellValue('M'.$rowCount, strtoupper($row->resi . ' - ' . $row->kurir)); 
				$this->excel->getActiveSheet()->SetCellValue('N'.$rowCount, tanggal($row->cek_kirim, 'd/m/Y')); 

				$rowCount++; 
				$nomerUrut++;
				$rowakhir = $rowCount-1;
			} 


			 
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$namanya.'.xlsx"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
		}
		else
		{
			redirect('login', 'refresh');
		}
	}


}

/* End of file default_c.php */
/* Location: ./application/controllers/admin/default_c.php */