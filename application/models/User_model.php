<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// date_default_timezone_set('Asia/Jakarta');

class User_model extends CI_Model {

	public function daftar($username, $password, $level = 'user') {
		$unik = random_string('alnum', 5);
		$pass = do_hash($unik . $password);
		$passwd = $unik . '_' . $pass;

		$data = array(
			'nama' => $username,
			'username' => $username,
			'password' => $passwd,
			'level' => $level,
			'daftar' => mdate('%Y-%m-%d %H:%i:%s', now())
			);

		$this->db->insert('pengguna', $data);

		return TRUE;
	}

}
