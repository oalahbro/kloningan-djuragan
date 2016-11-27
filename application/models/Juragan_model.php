<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// date_default_timezone_set('Asia/Jakarta');

class Juragan_model extends CI_Model {

	public function ambil_nama($nama_alias) {
		$this->db->where('nama_alias', $nama_alias);
		$q = $this->db->get('juragan');

		$row = $q->row();
		if ($q->num_rows() === 1) {
			$nama = $row->nama;			
		}
		else {
			$nama = 'Semua Juragan';
		}
		return $nama;
	}

}
