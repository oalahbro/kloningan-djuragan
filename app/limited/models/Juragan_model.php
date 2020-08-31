<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
date_default_timezone_set('Asia/Jakarta');

class Juragan_model extends CI_Model {

	public function _ambil_nama_juragan_dari_id($juragan_id) {
		$query = $this->db->get_where('user', array('id' => $juragan_id));

		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->nama;
		}
		else {
			return 'Unknown';
		}
	}

	// ambil semua data user dengan level user
	public function ambil() {
		$this->db->from('user');
		$this->db->join('count_order', 'count_order.user_id = user.id');

		$this->db->where('level', 'user');
		$this->db->order_by('user.nama asc');
		$query = $this->db->get();

		return $query;
	}

	// ambik `nama` dari username
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

	// ambil `nnama` dari unik pesanan 
	public function ambil_nama_by_pesanan_unik($pesanan_unik) {
		$pesanan = $this->db->get_where('order', array('unik' => $pesanan_unik));
		$p = $pesanan->row();

		$query =$this->db->get_where('user', array('id' => $p->user_id));
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->nama;
		}
		else {
			return 'All Juragan';
		}
	}

	// ambil data `id` dari username
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

	// ambil data `username` dari id
	public function ambil_username_by_id($user_id) {
		$query =$this->db->get_where('user', array('id' => $user_id));
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->username;
		}
		else {
			return 'all';
		}
	}

	public function ambil_nama_by_id($user_id) {
		$query =$this->db->get_where('user', array('id' => $user_id));
		$row = $query->row();
		if ($query->num_rows() > 0) {
			return $row->nama;
		}
	}

	// menampilkan daftar member jika ada
	public function memberlist($username) {
		$user_id = $this->ambil_id_by_username($username);

		$query = $this->db->get_where('user', array('username' => $username));
		$row = $query->row();

		if($row->membership === '1') {
			$this->db->order_by('nama_member', 'asc');
			$return = $this->db->get_where('membership', array('user_id' => $user_id));
		}
		else {
			$return = NULL;
		}

		return $return;
	}



	/////////////////////////////////////////// NEW HERE ///

	// menambahkan user - CS
	public function tambah_user($nama, $username, $password, $level = 'user') {
		$unik 	= random_string('alnum', 4);
		$sandi 	= hash('sha256', $password);
		$pass 	= hash('sha256', $unik . $sandi);

		$input_array = array(
			'nama_cs' => $nama,
			'username' => $username,
			'password' => $unik . '_' . $pass,
			'level' => $level,
			'register' => mdate("%Y-%m-%d %H:%i:%s", now())
			);

		$this->db->insert('juragan', $input_array);

		return TRUE;
	}

	// authentic CS pada juragan
	public function juragan_auth($username, $juragan) {
		$query = $this->db->get_where('juragan', array('username' => $username));
		if ($query->num_rows() === 1) {
			$row = $query->row();

			$ja = $this->db->get_where('juragan_auth', array('juragan_id' => $row->id));

			if ($ja->num_rows() === 1) {
				// update
				$this->db->where('id', $row->id);
				$this->db->update('juragan_auth', array('allow_id' => $juragan));
			}
			else {
				// insert
				$input_array = array(
					'juragan_id' => $row->id,
					'allow_id' => $juragan
					);

				$this->db->insert('juragan_auth', $input_array);
			}		
		}
		return TRUE;		
	}

	//
	public function auth_list($user_id) {
		$query = $this->db->get_where('juragan_auth', array('juragan_id' => $user_id));
		return $query;
	}
}
=======
// date_default_timezone_set('Asia/Jakarta');

class Juragan_model extends CI_Model {

	public function anbil_data() {
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get('juragan');

		return $q;
	}

	public function ambil_juragan_id_by_username($nama_alias) {
		$this->db->where('nama_alias', $nama_alias);
		$q = $this->db->get('juragan');

		$row = $q->row();
		$nama = '';
		if ($q->num_rows() === 1) {
			$nama = $row->id;
		}
		
		return $nama;
	}

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

	public function ambil_warna($nama_alias) {
		$this->db->where('nama_alias', $nama_alias);
		$q = $this->db->get('juragan');

		$row = $q->row();
		if ($q->num_rows() === 1) {
			$nama = $row->warna_default;			
		}
		else {
			$nama = '#222';
		}
		return $nama;
	}

	function _group_by($array, $key1, $key2) {
		$return = array();
		foreach($array as $val) {

			$return[$val[$key1]][$val[$key2]][] = $val;
		}
		return $return;
	}

	public function get_chart_data() {

		$this->db->select('juragan.nama, order.user_id, MONTH(order.tanggal_order) as bln, YEAR(order.tanggal_order) as thn, count(order.id) as jml');

		$this->db->from('order');
		$this->db->join('juragan', 'juragan.id=order.user_id');

        $this->db->group_by('order.user_id, MONTH(order.tanggal_order), YEAR(order.tanggal_order)');
        $this->db->where('YEAR(order.tanggal_order)', date('Y'));
        $this->db->where('order.cek_transfer !=', NULL);

        $this->db->order_by('juragan.id', 'asc');
        $this->db->order_by('YEAR(order.tanggal_order)', 'asc');
		$this->db->order_by('MONTH(order.tanggal_order)', 'asc');


        $query = $this->db->get(); 
//        $results[date('Y')] = $query->result();


       //$results['juragan'] = $this->_group_by($query->result_array(), 'user_id', 'bln');

       //for ($bln=1; $bln < 13; $bln++) { 
       		$results['data'] = $this->_group_by($query->result_array(), 'bln', 'user_id');
       		$results['juragan'] = $this->_group_by($query->result_array(), 'nama', 'bln');
       		$results['juragan_id'] = $this->_group_by($query->result_array(), 'user_id', 'bln');

       		$results['bulan'] = $this->_group_by($query->result_array(), 'bln', 'user_id');

       //}

        
        /*

        


		$query = $this->db->get('performance');
		$results['chart_data'] = $query->result();
		$this->db->select_min('performance_year');
		$this->db->limit(1);

		$query = $this->db->get('performance');
		$results['min_year'] = $query->row()->performance_year;
		$this->db->select_max('performance_year');
		$this->db->limit(1);

		$query = $this->db->get('performance');
		$results['max_year'] = $query->row()->performance_year;

		*/

		
		return $results;


	}

}
>>>>>>> ec19eafa2dc32677f923592888a9f50dc35f55c3
=======
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
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
	public function _semua($limit = FALSE, $offset = FALSE) {
		
		if ($limit !== FALSE && $offset !== FALSE) {
			$this->db->limit($limit);
			$this->db->offset($offset);
		}
		
		$this->db->order_by('nama', 'asc');
		$q = $this->db->get($this->tabel);
		return $q;
	}

	public function _new($data) {
		$this->db->insert('juragan', $data);
		return TRUE;
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
<<<<<<< HEAD
>>>>>>> b746267e0988f2a31635814dda93c719d8ac9053
=======
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
