<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// date_default_timezone_set('Asia/Jakarta');

class Pesanan_model extends CI_Model {

	public function ambil($juragan, $status, $limit=NULL, $offset=NULL, $cari = '') {

		if( ! empty($cari)) {
			$array_cari = explode(" ", reduce_multiples($cari, " ", TRUE));

			$this->db->like('p.id', $cari, 'both');
			foreach($array_cari as $item){
				$this->db->or_like('p.nama', $item, 'both');
				$this->db->or_like('p.alamat', $item, 'both');
				$this->db->or_like('p.keterangan', $item, 'both');
				$this->db->or_like('p.pesanan', $item, 'both');
				$this->db->or_like('p.hp', $item, 'both');
			}
		}

		if($juragan !== 'semua') {
			$this->db->having('u.nama_alias', $juragan);
		}

		if($status === 'terkirim') {
		// $this->db->order_by('o.status_transfer desc, o.status_kirim desc, o.cek_kirim desc, o.cek_transfer desc, o.tanggal_order desc');
			$this->db->having(array('p.status_kirim' => '1'));
		}
		elseif($status === 'pending') {
			$this->db->having(array('p.status_kirim' => '0'));
		}


		if($status !== 'terkirim') {
			$this->db->order_by('p.status_transfer asc, p.status_kirim asc, p.tanggal desc');
		}
		else {
			$this->db->order_by('p.status_kirim asc, p.cek_kirim desc, p.tanggal desc');
		}

		if($limit !== NULL && $offset !== NULL) {
			$this->db->limit($limit);
			$this->db->offset($offset);
		}

		$q = $this->db->select('p.*, u.nama_alias as username, u.nama as juragan')
					  ->from('pesanan p')
					  ->join('juragan u', 'p.juragan_id=u.id')
					  ->get();
		return $q;
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

	public function count($juragan = 'semua', $status = 'semua') {
		if($juragan !== 'semua') {
			$this->db->having('u.nama_alias', $juragan);
		}

		if($status === 'terkirim') {
			$this->db->having(array('p.status_kirim' => '1'));
		}
		elseif($status === 'pending') {
			$this->db->having(array('p.status_kirim' => '0'));
		}

		$q = $this->db->select('p.*, u.nama_alias as username, u.nama as juragan')
					  ->from('pesanan p')
					  ->join('juragan u', 'p.juragan_id=u.id')
					  ->get();
		return $q;

	}
}