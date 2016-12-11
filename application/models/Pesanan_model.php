<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// date_default_timezone_set('Asia/Jakarta');

class Pesanan_model extends CI_Model {

	public function ambil() {

		$this->db->select('p.*, j.nama as nama_juragan, j.nama_alias as alias_juragan, j.warna_default, u.nama as cs, u.username' 

			);

		$this->db->from('pesanan p');
		$this->db->join('juragan j', 'j.id=p.juragan_id');
		$this->db->join('pengguna u', 'u.id=p.pengguna_id');


		$this->db->order_by('p.id', 'desc');
		$this->db->limit(30);
		return $this->db->get();
	}

	public function check($username, $password) {
		$query = $this->db->get_where('pengguna', array('username' => $username));
		if ($query->num_rows() === 1) {
			$row = $query->row();

			$sandi 	= explode('_', $row->password);
			$hash = do_hash($sandi[0] . $password);

			if($hash === $sandi[1]) {
				$sess_array = array(
					'id' => $row->id,
					'nama' => $row->nama,
					'username' => $row->username,
					'level' => $row->level,
					'login' => TRUE
					);
				$this->session->set_userdata('logged_in', $sess_array);

				// update table
				$unik = random_string('alnum', 5);
				$katasandi = do_hash($unik . $password);
				$last_login = mdate("%Y-%m-%d %H:%i:%s", now());

				$this->db->where('id', $row->id);
				$this->db->update('pengguna', array('password' => $unik . '_' . $katasandi, 'login' => $last_login ));

				return TRUE;
			}
		}
	}
}