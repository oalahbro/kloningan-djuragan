<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
