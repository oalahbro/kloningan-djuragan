<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pesanan_model extends CI_Model {

	function total_pesanan($mulai, $akhir) {
		$this->db->select('order.user_id, SUM(order.jumlah) as total, user.nama as juragan');
		//$this->db->where('MONTH(order.tanggal_order)', "MONTH('".$bulan."')", FALSE);
		$this->db->where('DATE(order.tanggal_order) >=', $mulai);
		$this->db->where('DATE(order.tanggal_order) <=', $akhir);

		$this->db->where('order.status_transfer', 'Masuk');
		$this->db->from('order');
		$this->db->join('user', 'order.user_id=user.id');
		$this->db->group_by('order.user_id'); 
		$this->db->order_by('total', 'desc'); 
		
		$query = $this->db->get();

		return $query;
	}

	function total_transfer($mulai, $akhir) {
		$this->db->select('order.user_id, COUNT(order.id) as total, user.nama as juragan');
		//$this->db->where('MONTH(order.tanggal_order)', "MONTH('".$bulan."')", FALSE);
		//$this->db->where('MONTH(order.cek_transfer)', "MONTH('".$bulan."')", FALSE);

		$this->db->where('DATE(order.tanggal_order) >=', $mulai);
		$this->db->where('DATE(order.tanggal_order) <=', $akhir);

		$this->db->where('DATE(order.cek_transfer) >=', $mulai);
		$this->db->where('DATE(order.cek_transfer) <=', $akhir);

		$this->db->from('order');
		$this->db->join('user', 'order.user_id=user.id');
		$this->db->group_by('order.user_id'); 
		$this->db->order_by('total', 'desc'); 
		
		$query = $this->db->get();

		return $query;
	}

	function total_terkirim($mulai, $akhir) {
		$this->db->select('order.user_id, SUM(order.jumlah) as total, user.nama as juragan');
		//$this->db->where('MONTH(order.cek_kirim)', "MONTH('".$bulan."')", FALSE);
		$this->db->where('DATE(order.cek_kirim) >=', $mulai);
		$this->db->where('DATE(order.cek_kirim) <=', $akhir);

		$this->db->from('order');
		$this->db->join('user', 'order.user_id=user.id');
		$this->db->group_by('order.user_id'); 
		$this->db->order_by('total', 'desc');
		
		$query = $this->db->get();

		return $query;
	}

	function total_pending() {
		$this->db->select('order.user_id, SUM(order.jumlah) as total, user.nama as juragan');
		$this->db->where('order.status_transfer', 'Masuk');
		$this->db->where('order.barang', 'Pending');
		$this->db->from('order');
		$this->db->join('user', 'order.user_id=user.id');
		$this->db->group_by('order.user_id'); 
		$this->db->order_by('total', 'asc');
		
		$query = $this->db->get();

		return $query;
	}
}