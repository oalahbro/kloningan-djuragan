<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Juragan_model extends CI_Model {

	// ambil semua data user dengan level user
	public function ambil() {
		$this->db->from('user');
		$this->db->join('count_order', 'count_order.user_id = user.id');

		$this->db->where('level', 'user');
		$this->db->order_by('user.nama asc');
		$query = $this->db->get();

		return $query;
	}

	// ambik `nama` dari username
	public function ambil_nama_by_username($username) {
		$query =$this->db->get_where('user', array('username' => $username));
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->nama;
		}
		else {
			return 'All Juragan';
		}
	}

	// ambil `nnama` dari unik pesanan 
	public function ambil_nama_by_pesanan_unik($pesanan_unik) {
		$pesanan = $this->db->get_where('order', array('unik' => $pesanan_unik));
		$p = $pesanan->row();

		$query =$this->db->get_where('user', array('id' => $p->user_id));
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->nama;
		}
		else {
			return 'All Juragan';
		}
	}

	// ambil data `id` dari username
	public function ambil_id_by_username($username) {
		$query =$this->db->get_where('user', array('username' => $username));
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->id;
		}
		else {
			return '';
		}
	}

	// ambil data `username` dari id
	public function ambil_username_by_id($user_id) {
		$query =$this->db->get_where('user', array('id' => $user_id));
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->username;
		}
		else {
			return 'all';
		}
	}

	public function ambil_nama_by_id($user_id) {
		$query =$this->db->get_where('user', array('id' => $user_id));
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->nama;
		}
	}

	// menampilkan daftar member jika ada
	public function memberlist($username) {
		$user_id = $this->ambil_id_by_username($username);

		$query = $this->db->get_where('user', array('username' => $username));
		$row = $query->row();

		if($row->membership === '1') {
			$this->db->order_by('nama_member', 'asc');
			$return = $this->db->get_where('membership', array('user_id' => $user_id));
		}
		else {
			$return = NULL;
		}

		return $return;
	}



	/////////////////////////////////////////// NEW HERE ///

	// menambahkan user - CS
	public function tambah_user($nama, $username, $password, $level = 'user') {
		$unik 	= random_string('alnum', 4);
		$sandi 	= hash('sha256', $password);
		$pass 	= hash('sha256', $unik . $sandi);

		$input_array = array(
			'nama_cs' => $nama,
			'username' => $username,
			'password' => $unik . '_' . $pass,
			'level' => $level,
			'register' => mdate("%Y-%m-%d %H:%i:%s", now())
			);

		$this->db->insert('juragan', $input_array);

		return TRUE;
	}

	// authentic CS pada juragan
	public function juragan_auth($username, $juragan) {
		$query = $this->db->get_where('juragan', array('username' => $username));
		if ($query->num_rows() === 1) {
			$row = $query->row();

			$ja = $this->db->get_where('juragan_auth', array('juragan_id' => $row->id));

			if ($ja->num_rows() === 1) {
				// update
				$this->db->where('id', $row->id);
				$this->db->update('juragan_auth', array('allow_id' => $juragan));
			}
			else {
				// insert
				$input_array = array(
					'juragan_id' => $row->id,
					'allow_id' => $juragan
					);

				$this->db->insert('juragan_auth', $input_array);
			}		
		}
		return TRUE;		
	}

	//
	public function auth_list($user_id) {
		$query = $this->db->get_where('juragan_auth', array('juragan_id' => $user_id));
		return $query;
	}
}