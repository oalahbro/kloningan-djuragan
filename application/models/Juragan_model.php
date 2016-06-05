<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Juragan_model extends CI_Model {

	function ambil() {

		$this->db->from('user');
		$this->db->join('count_order', 'count_order.user_id = user.id');

		$this->db->where('level', 'user');
		$this->db->order_by('user.nama asc');
		$query = $this->db->get();

		return $query;
	}
}