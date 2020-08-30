<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
date_default_timezone_set('Asia/Jakarta');

class Pesanan_model extends CI_Model {

	// fungsi untuk menambahkan pesanan
	function add($user_id, $data) {
		$tgl = mdate("%Y-%m-%d %H:%i:%s", now());

		$data2 = array(
			'tanggal_order' => $tgl
		);
		$data_submit = array_merge($data2, $data);

		$this->db->insert('order', $data_submit);
		$this->update_count($user_id);
		return TRUE;
	}

	// fungsi untuk update pesanan
	function update($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('order', $data);

		return TRUE;
	}

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
			$this->db->or_like('o.id', $cari);
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

		if($ubah)
			$this->update_count($user_id);
		return TRUE;
	}

	function set_to_kirim($unik, $data, $user_id) {
		$this->db->where('unik', $unik);
		$ubah = $this->db->update('order', $data);

		if($ubah)
			$this->update_count($user_id);
			return TRUE;
	}

	// ambil data pesanan dari data unik pesanan
	function get_pesanan_by_unik($pesanan_unik) {
		$query = $this->db->get_where('order', array('unik' => $pesanan_unik));
		return $query;
	}

	function get_unik_by_id($pesanan_id) {
		$this->db->where('id', $pesanan_id);
		$query = $this->db->get('order');

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->unik;
		}
	}

	// ambil data `user_id` dari data `unik` pesanan
	function get_user_id_by_pesanan($unik) {
		$this->db->select('user_id');
		$this->db->where('unik', $unik);
		$query = $this->db->get('order');

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->user_id;
		}
	}

	// hapus data pesanan
	function hapus($pesanan_unik) {
		$user_id = $this->get_user_id_by_pesanan($pesanan_unik);
						
		$this->db->where('unik', $pesanan_unik);
		$hapus = $this->db->delete('order');

		if($hapus) {
			$this->update_count($user_id);
			return TRUE;
		}
	}

	// update data count 
	function update_count($user_id) {
		$data_count = array(
			'transfer' => $this->count_order_transfer($user_id, 'Belum'),
			'kirim' => $this->count_order_kirim($user_id, 'Pending')
		);

		$this->db->where('user_id', $user_id);
		$this->db->update('count_order', $data_count);

		return TRUE;
	}

	// re-count data kirim barang
	function count_order_kirim($user_id = false, $barang) {
		$array = array('Pending', 'Terkirim');
		if(in_array($barang, $array)) {
			$this->db->where('barang', $barang);
			$this->db->where('del', NULL);
			if( ! empty($user_id)) {
				$this->db->where('user_id', $user_id);
			}	
			$this->db->from('order');
			$count = $this->db->count_all_results();

			return $count;
		}
	}

	// re-count data transfer
	function count_order_transfer($user_id = false, $transfer) {
		$array = array('Belum', 'Masuk');
		if(in_array($transfer, $array)) {
			$this->db->where('status_transfer', $transfer);
			$this->db->where('del', NULL);
			if( ! empty($user_id)) {
				$this->db->where('user_id', $user_id);
			}			
			$this->db->from('order');
			$count = $this->db->count_all_results();

			return $count;
		}
	}

	// fungsi untuk hitung jumlah pesanan
	function count_order($halaman = 'all', $username) {
		$juragan_id = $this->juragan->ambil_id_by_username($username);


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
		
		if($juragan_id > 0) {
			$this->db->having(array('o.user_id' => $juragan_id));
		}

		$query = $this->db->get();
		return $query->num_rows();
	}

	// newsticker
	function today_input($kecuali_user_id = null) {

		$hari_ini = mdate('%Y-%m-%d', time());

		$this->db->select('order.user_id, count(order.id) as jumlah_pesanan, sum(order.jumlah) as total_pesanan, user.nama');
		$this->db->from('order');
		$this->db->join('user', 'order.user_id = user.id');
		$this->db->group_by('order.user_id');

		$this->db->where('DATE(order.tanggal_order) >= ', $hari_ini);
		if($kecuali_user_id !== NULL) {
			$this->db->having('order.user_id !=', $kecuali_user_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function get_size() {	
		$this->db->order_by('id', 'asc');
		$size = $this->db->get('size');
		return $size;
=======
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

>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
	}
}