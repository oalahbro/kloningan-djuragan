<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kurir_model extends CI_Model
{

	function show_all()
	{
		$this->db->from('kurir');
		$this->db->order_by('nama', 'asc');
		$query = $this->db->get();

		return $query;
	}

	function add($data)
	{
		$this->db->insert('kurir', $data);
		return TRUE;
	}

	function delete($nama)
	{
		$this->db->where('nama', $nama);
		$this->db->delete('kurir');
		return TRUE;
	}




}