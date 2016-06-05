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

	function semua($halaman, $offset = '', $limit = '', $cari = '', $juragan = '') {
		$this->db->select('o.*, u.nama as juragan, u.username, m.nama_member, m.hp as hp_member');
		$this->db->from('order o');
		$this->db->join('user u', 'u.id = o.user_id');
		$this->db->join('membership m', 'm.id = o.member_id', 'left');

		if($halaman === 'terkirim') {
			$this->db->order_by('o.status_transfer desc, o.barang desc, o.cek_kirim desc, o.cek_transfer desc, o.tanggal_order desc');
			$this->db->having(array('o.barang' => 'terkirim'));
		}
		elseif($halaman === 'pending') {
			$this->db->having(array('o.barang' => 'pending'));
		}
		
		if( ! empty($juragan)) {
			$this->db->having(array('o.user_id' => $juragan));
		}

		if( ! empty($cari)) {
			$this->db->like('o.nama', $cari);
			$this->db->or_like('o.kode', $cari);
			$this->db->or_like('o.resi', $cari);
			$this->db->or_like('o.alamat', $cari);
			$this->db->or_like('o.keterangan', $cari);
			$this->db->or_like('o.pesanan', $cari);
			$this->db->or_like('o.hp', $cari);
			$this->db->or_like('o.kurir', $cari);
			$this->db->or_like('o.status', $cari);
			$this->db->or_like('o.bank', $cari);
			$this->db->or_like('u.nama', $cari);
			$this->db->or_like('o.tanggal_order', $cari);
			//$this->db->or_like('o.cek_kirim', $cari);
			$this->db->or_like('o.barang', $cari);
			$this->db->or_like('o.status_transfer', $cari);
			//$this->db->or_like('o.cek_transfer', $cari);
		}

		if($limit !== '' && $offset !== '') {
			$this->db->limit($limit,$offset);
		}

		if($halaman !== 'terkirim') {
			$this->db->order_by('o.status_transfer desc, o.barang desc, o.tanggal_order desc');
		}

		$query = $this->db->get();

		return $query;
	}

	function set_to_transfer($id, $okremove, $user_id) {
		$tgl = mdate("%Y-%m-%d %H:%i:%s", now());

		if($okremove === 'ok') {
			$stat = 'Masuk';
			$tanggal = $tgl;
		}
		elseif($okremove === 'remove') {
			$stat = 'Belum';
			$tanggal = NULL;
		}

		$data = array(
			'cek_transfer' =>$tanggal,
			'status_transfer' => $stat
		);
		$this->db->where('id', $id);
		$ubah = $this->db->update('order', $data);

		//if($ubah)
			//$this->update_count($user_id);
		return TRUE;
	}

	function set_to_kirim($id, $okremove, $user_id) {
		if($okremove === 'remove') {
			$stat = 'Pending';
			$tanggal = NULL;
		}

		$data = array(
			'cek_kirim' =>$tanggal,
			'barang' => $stat,
			'resi' => NULL,
			'kurir' => NULL,
			'ongkir_fix' => NULL
		);
		$this->db->where('id', $id);
		$ubah = $this->db->update('order', $data);

		if($ubah)
			$this->update_count($user_id);
			return TRUE;
	}
}