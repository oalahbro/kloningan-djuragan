<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// date_default_timezone_set('Asia/Jakarta');

class Login_model extends CI_Model {

	public function check($username, $password) {
		$query = $this->db->get_where('pengguna', array('username' => $username));
		
		$sesi_ = array(
			'type' 	=> 'danger',
			'text' 	=> '<strong>' . $username . '</strong> tidak terdaftar'
			);
		$return = FALSE;

		if ($query->num_rows() === 1) {
			$sesi_ = array(
				'type' 	=> 'danger',
				'text' 	=> 'password salah'
				);
			$return = FALSE;

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

				$sesi_ = array(
					'type' 	=> 'success',
					'text' 	=> 'Kamu sudah login'
					);
				$return = TRUE;
			}
		}

		$this->session->set_userdata($sesi_);

		return $return;
	}
}