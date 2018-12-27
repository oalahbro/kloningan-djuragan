<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juragan_model extends CI_Model
{
	private $tabel;

	public function __construct() {
		parent::__construct();
		$this->tabel = 'juragan';
	}

	/**
	 * ambil semua data juragan
	 *
	 */
	public function _semua() {
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get($this->tabel);
		return $q;
	}

	
	public function cek($slug) {
		$q = $this->db->where('slug', $slug)->get($this->tabel);

		if($q->num_rows() > 0) {
			return TRUE;
		}
	}

	public function _id($slug) {
		$q = $this->db->where('slug', $slug)->get($this->tabel);
		$r = $q->row();

		if($q->num_rows() > 0) {
			return $r->id;
		}
		else {
			return FALSE;
		}
	}

	public function _detail($id) {
		return $this->db->where('id', $id)->get($this->tabel);
	}

	public function _nama($id) {
		$q = $this->_detail($id);

		$r = $q->row();

		if($q->num_rows() > 0) {
			return $r->nama;
		}
		else {
			return 'Semua Juragan';
		}
	}

	public function _slug($id) {
		$q = $this->_detail($id);

		$r = $q->row();

		if($q->num_rows() > 0) {
			return $r->slug;
		}
	}
	
}
