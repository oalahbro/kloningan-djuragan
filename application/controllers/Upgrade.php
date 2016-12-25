<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upgrade extends CI_Controller {
	public function __construct() {
		parent::__construct();
    	$this->load->dbforge();
	}

	public function index() {
		echo anchor('upgrade/step1', 'Start');
	}

	public function step1() {

		$this->dbforge->drop_table('pengguna',TRUE);

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
				),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
				),
			'username' => array(
				'type' =>'VARCHAR',
				'constraint' => '100',
				'unique' => TRUE
				),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '69'
				),
			'level' => array(
				'type' => 'ENUM("superadmin","admin","user")',
				'default' => 'user',
				'null' => FALSE
				),
			'daftar' => array(
				'type' => 'DATETIME',
				'null' => FALSE
				),
			'login' => array(
				'type' => 'DATETIME',
				'null' => TRUE
				),
			);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('pengguna', FALSE, array('ENGINE' => 'InnoDB'))) {
			redirect('upgrade/step2');
		}

	}

	public function step2() {
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[pengguna.username]|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE) {
			echo 'done create table `pengguna`';
			echo '<hr/>Daftarkan data admin:';
			echo form_open();

				echo form_label('username', 'username');
				echo form_input('username');
				echo '<br/>';

				echo form_label('password', 'password');
				echo form_password('password');

				echo '<br/>';
				echo form_button(array('type' => 'submit', 'content' => 'daftar'));

			echo form_close();
		}
		else {
			// simpan data admin
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$sign = $this->user->daftar($username, $password, 'superadmin');

			if($sign) {
				redirect('upgrade/step3');
			}

		}
	}

	public function step3() {
		// move data from user to juragan
		$this->dbforge->drop_table('juragan',TRUE);

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
				),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
				),
			'nama_alias' => array(
				'type' =>'VARCHAR',
				'constraint' => '100',
				'unique' => TRUE
				),
			'shortcode' => array(
				'type' => 'VARCHAR',
				'constraint' => '5'
				),
			'membership' => array(
				'type' => 'ENUM("0","1")',
				'default' => '0',
				'null' => FALSE
				),
			'transfer_pending' => array(
				'type' => 'INT',
				'constraint' => 5,
				'null' => FALSE
				),
			'kirim_pending' => array(
				'type' => 'INT',
				'constraint' => 5,
				'null' => FALSE
				),
			'total_pesanan' => array(
				'type' => 'INT',
				'constraint' => 5,
				'null' => FALSE
				),
			'warna_default' => array(
				'type' => 'VARCHAR',
				'constraint' => 7
				)
			);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('juragan', FALSE, array('ENGINE' => 'InnoDB'))) {
			// import data 

			$this->db->from('user');
			$this->db->join('count_order', 'user.id=count_order.user_id');
			$q = $this->db->get();

			foreach ($q->result() as $v) {

				$this->db->insert('juragan', array(
					'id' => $v->user_id,
					'nama' => $v->nama,
					'nama_alias' => $v->username,
					'shortcode' => strtolower($v->short),
					'membership' => $v->membership,
					'transfer_pending' => $v->transfer,
					'kirim_pending' => $v->kirim,
					'total_pesanan' => $v->total,
					'warna_default' => warna($v->username)
					));
			}

			// hapus tabel user
			// $this->dbforge->drop_table('user',TRUE);

			// hapus tabel count_order
			// $this->dbforge->drop_table('count_order',TRUE);

			redirect('upgrade/step4');
		}
	}

	public function step4() {
		// move data from `order` to `pesanan`
		$this->dbforge->drop_table('pesanan',TRUE);
		//$this->dbforge->drop_table('pesanan_additional',TRUE);

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
				),
			'juragan_id' => array(
				'type' => 'INT',
				'constraint' => 11
				),
			'pengguna_id' => array(
				'type' => 'INT',
				'constraint' => 11
				), 	
			'member_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0
				),
			'status_pesanan' => array(
				'type' => 'ENUM("0","1","2")',
				'default' => '1',
				'null' => FALSE
				),
			'tanggal' => array(
				'type' => 'DATETIME'
				),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
				),
			'alamat' => array(
				'type' =>'TEXT'
				),
			'hp' => array(
				'type' => 'VARCHAR',
				'constraint' => '30'
				),
			'pesanan' => array(
				'type' => 'TEXT'
				),
			'total_biaya' => array(
				'type' => 'VARCHAR',
				'constraint' => 11,
				'default' => '0',
				'null' => FALSE
				),
			'total_ongkir' => array(
				'type' => 'VARCHAR',
				'constraint' => 22,
				'default' => '0',
				'null' => FALSE
				),
			'total_transfer' => array(
				'type' => 'VARCHAR',
				'constraint' => 11,
				'default' => '0',
				'null' => FALSE
				),
			'status_kirim' => array(
				'type' => 'ENUM("0","1")', 
				'default' => '0',
				'null' => FALSE
				),
			'status_transfer' => array(
				'type' => 'ENUM("0","1")', 
				'default' => '0',
				'null' => FALSE
				),
			'status_biaya_transfer' => array(
				'type' => 'ENUM("0","1")', 
				'default' => '0',
				'null' => FALSE
				),
			'bank' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				),
			'kurir_resi' => array(
				'type' => 'VARCHAR',
				'constraint' => 120,
				'default' => NULL,
				'null' => TRUE
				),
			'cek_kirim' => array(
				'type' => 'DATETIME',
				'default' => NULL,
				'null' => TRUE
				),
			'cek_transfer' => array(
				'type' => 'DATETIME',
				'default' => NULL,
				'null' => TRUE
				),
			'gambar' => array(
				'type' => 'TEXT',
				'default' => NULL,
				'null' => TRUE
				),
			'keterangan' => array(
				'type' => 'TEXT',
				'default' => NULL,
				'null' => TRUE
				),
			'uid' => array(
				'type' => 'VARCHAR',
				'constraint' => 16,
				'unique' => TRUE
				)
			);
		$this->dbforge->add_field($fields)
					  ->add_key('id', TRUE);

		if($this->dbforge->create_table('pesanan', FALSE, array('ENGINE' => 'InnoDB'))) {

			redirect('upgrade/step5');
		}
	}

	public function step5($page = 0) {
		$this->db->where('del', NULL);
		$c = $this->db->get('order');

		$jumlah = $c->num_rows();
		$pageUpdate = 0;

		$this->db->where('del', NULL);
		$this->db->limit(150);
		$this->db->offset($page);
		$this->db->order_by('id', 'asc');
		$q = $this->db->get('order');


		foreach ($q->result() as $v) {

			$cek_kirim = $v->cek_kirim;
			if(empty($v->cek_kirim)) {
				$cek_kirim = NULL;
			}
			$cek_transfer = $v->cek_transfer;
			if(empty($v->cek_transfer)) {
				$cek_transfer = NULL;
			}

			if($v->status_transfer === 'Masuk') {
				$status_transfer = '1';
			}
			else {
				$status_transfer = '0';
			}

			if($v->status === 'Lunas') {
				$status_biaya_transfer = 1;
			}
			else {
				$status_biaya_transfer = 0;
			}

			if($v->barang === 'Terkirim') {
				$status_kirim = '1';
			}
			else {
				$status_kirim = '0';
			}

			if($v->member_id === '0') {
				$member_id = '';

			}
			else {
				$member_id = $v->member_id;	
			}

			if( empty($v->keterangan) ) {
				$keterangan = NULL;
			}
			else {
				$keterangan =  $v->keterangan;
			}

			$kurir = NULL;
			if( ! empty($v->resi)) {
				$kurir = reduce_multiples($v->kurir . ',' . $v->resi, ",", TRUE);
			}

			$this->db->insert('pesanan', array(
				'juragan_id' => $v->user_id,
				'pengguna_id' => 1,
				'member_id' => $v->member_id,
				'tanggal' => $v->tanggal_order,
				'nama' => $v->nama,
				'alamat' => $v->alamat,
				'hp' => $v->hp,
				'pesanan' => $v->pesanan,
				'total_biaya' => $v->harga,
				'total_ongkir' => reduce_multiples($v->ongkir . ',' . $v->ongkir_fix, ",", TRUE),
				'total_transfer' => $v->transfer,
				'status_kirim' => $status_kirim,
				'status_transfer' => $status_transfer,
				'status_biaya_transfer' => $status_biaya_transfer,
				'bank' => $v->bank,
				'kurir_resi' => $kurir,
				'cek_kirim' => $cek_kirim,
				'cek_transfer' => $cek_transfer,
				'gambar' => $v->customgambar,
				'keterangan' => $keterangan,
				'uid' => url_title($v->user_id . $v->id . random_string('alnum', 16))
				));
		}

		$upup = $page + 150;
		if($upup > $jumlah) {
			// redirect('upgrade/step6');
			echo 'updated done 100%';
		}
		else {
			echo 'updated ' . $upup . ' / ' . $jumlah . ' ( ' . round(($upup/$jumlah)*100) . '% )';
			header( "refresh:1;url=" . site_url('upgrade/step5/'. $upup . '?' . random_string('alnum', 16) ) );
		}
		


	}
}
