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
					'shortcode' => $v->short,
					'membership' => $v->membership,
					'transfer_pending' => $v->transfer,
					'kirim_pending' => $v->kirim,
					'total_pesanan' => $v->total
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
	}
}
