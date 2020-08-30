<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
date_default_timezone_set('Asia/Jakarta');
=======
// date_default_timezone_set('Asia/Jakarta');
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

class Login_model extends CI_Model {

	public function check($username, $password) {
<<<<<<< HEAD
		$query = $this->db->get_where('juragan', array('username' => $username));
		if ($query->num_rows() === 1) {
			$row = $query->row();

			$sandi 	= explode('_', $row->password);

			$pass 	= hash('sha256', $password);
			$hash 	= hash('sha256', $sandi[0] . $pass);
=======
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
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3

			if($hash === $sandi[1]) {
				$sess_array = array(
					'id' => $row->id,
<<<<<<< HEAD
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
=======
					'nama' => $row->nama,
					'username' => $row->username,
					'level' => $row->level,
					'login' => TRUE
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
					);
				$this->session->set_userdata('logged_in', $sess_array);

				// update table
<<<<<<< HEAD
				$unik = random_string('alnum', 4);
				$katasandi = hash('sha256', $unik . hash('sha256', $password) );
				$last_login = mdate("%Y-%m-%d %H:%i:%s", now());

				$this->db->where('id', $row->id);
				$this->db->update('user', array('katasandi' => $katasandi, 'unik' => $unik, 'last_login' => $last_login ));

				return true;
			}
		}
=======
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
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}
}