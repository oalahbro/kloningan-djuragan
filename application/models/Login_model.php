<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Login_model extends CI_Model {

	public function check($username, $password) {
		$query = $this->db->get_where('juragan', array('username' => $username));
		if ($query->num_rows() === 1) {
			$row = $query->row();

			$sandi 	= explode('_', $row->password);

			$pass 	= hash('sha256', $password);
			$hash 	= hash('sha256', $sandi[0] . $pass);

			if($hash === $sandi[1]) {
				$sess_array = array(
					'id' => $row->id,
					'nama' => $row->nama_cs,
					'level' => $row->level,
					'login' => TRUE
					//'last_login' => $row->last_login
					);
				$this->session->set_userdata('logged_in', $sess_array);

				return TRUE;
			}

		}

	}






	function check_old($username, $password) {
		$query = $this->db->get_where('user', array('username' => $username));

		if ($query->num_rows() === 1) {
			$row = $query->row();

			$hash = hash('sha256', $row->unik . hash('sha256', $password) );

			if($row->katasandi === $hash) {
				$sess_array = array(
					'id' => $row->id,
					'nama' => $row->nama,
					'level' => $row->level,
					'login' => TRUE
					//'last_login' => $row->last_login
					);
				$this->session->set_userdata('logged_in', $sess_array);

				// update table
				$unik = random_string('alnum', 4);
				$katasandi = hash('sha256', $unik . hash('sha256', $password) );
				$last_login = mdate("%Y-%m-%d %H:%i:%s", now());

				$this->db->where('id', $row->id);
				$this->db->update('user', array('katasandi' => $katasandi, 'unik' => $unik, 'last_login' => $last_login ));

				return true;
			}
		}
	}
}