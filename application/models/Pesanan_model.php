<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// date_default_timezone_set('Asia/Jakarta');

class Pesanan_model extends CI_Model {

	public function ambil($juragan, $status, $hal = NULL, $cari = '') {

		$this->db->select('p.*, j.nama as nama_juragan, j.nama_alias as alias_juragan, j.warna_default, u.nama as cs, u.username' 

			);

		$this->db->from('pesanan p');
		$this->db->join('juragan j', 'j.id=p.juragan_id');
		$this->db->join('pengguna u', 'u.id=p.pengguna_id');


		if($juragan !== 'semua') {
			$this->db->where('j.nama_alias', $juragan);
		}

		if($status === 'terkirim') {
			// $this->db->order_by('o.status_transfer desc, o.status_kirim desc, o.cek_kirim desc, o.cek_transfer desc, o.tanggal_order desc');
			$this->db->having(array('p.status_kirim' => '1'));
		}
		elseif($status === 'pending') {
			$this->db->having(array('p.status_kirim' => '0'));
		}


		
		if($status !== 'terkirim') {
			$this->db->order_by('p.status_biaya_transfer asc, p.status_kirim asc, p.tanggal desc');
		}
		elseif($status === 'terkirim') {
			$this->db->order_by('p.status_kirim asc, p.tanggal desc');
		}

		if($hal !== NULL) {
			$this->db->limit(30);
			$this->db->offset($hal);
		}
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