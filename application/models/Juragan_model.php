<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Juragan_model extends CI_Model {

	public function ambil() {

		$this->db->from('user');
		$this->db->join('count_order', 'count_order.user_id = user.id');

		$this->db->where('level', 'user');
		$this->db->order_by('user.nama asc');
		$query = $this->db->get();

		return $query;
	}

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
}