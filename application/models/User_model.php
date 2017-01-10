<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// date_default_timezone_set('Asia/Jakarta');

class User_model extends CI_Model {
	public function daftar($nama, $username, $password, $email, $level = 'user') {
		$unik = random_string('alnum', 5);
		$pass = do_hash($unik . $password);
		$passwd = $unik . '_' . $pass;

		$data = array(
			'nama' => $nama,
			'username' => $username,
			'password' => $passwd,
			'email' => $email,
			'level' => $level,
			'daftar' => mdate('%Y-%m-%d %H:%i:%s', now())
			);

		$this->db->insert('pengguna', $data);

		return TRUE;
	}

}
