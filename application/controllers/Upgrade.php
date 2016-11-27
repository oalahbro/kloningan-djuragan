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

		// $this->load->view('welcome_message');
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
				'defaulr' => 'user',
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

		if($this->dbforge->create_table('juragan', FALSE, array('ENGINE' => 'InnoDB'))) {
			redirect('upgrade/step2');
		}

	}

	public function step2() {
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[juragan.username]|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE) {
			echo 'done create table `juragan`';
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
		# code...
	}
}
