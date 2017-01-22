<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// date_default_timezone_set('Asia/Jakarta');

class User_model extends CI_Model {
	public function daftar($nama, $username, $password, $email, $level = NULL) {
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

	public function baru() {
		$this->db->where('level', NULL);
		$q = $this->db->get('pengguna');

		return $q->num_rows();
	}

	public function get($status, $limit=NULL, $offset=NULL, $cari = '') {

		if( ! empty($cari)) {
			$array_cari = explode(" ", reduce_multiples($cari, " ", TRUE));

			$this->db->like('id', $cari, 'both');
			foreach($array_cari as $item){
				$this->db->or_like('nama', $item, 'both');
				$this->db->or_like('email', $item, 'both');
			}
		}

		if($status === 'baru') {
			$this->db->where('level', NULL);
		}
		elseif($status === 'aktif') {
			$this->db->where('level !=', NULL);
			$this->db->having('level', 'user');
		}

		//

		if($limit !== NULL && $offset !== NULL) {
			$this->db->limit($limit);
			$this->db->offset($offset);
		}
		$q = $this->db->get('pengguna');

		return $q;
	}

}
