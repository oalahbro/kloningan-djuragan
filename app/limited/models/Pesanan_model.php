<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pesanan_model extends CI_Model
{
	private $tabel;

	public function __construct() {
		parent::__construct();
		$this->tabel = 'pesanan';
	}

	public function delete($slug) {
		$this->db->where('slug', $slug);
		$this->db->delete($this->tabel);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
	}

	public function ambil_satu() {
		// $this->db->having(array('status_kirim' => 'pending'));

		$this->db->not_like('biaya', 'ZALORA');
		$this->db->not_like('biaya', 'BUKALAPAK');
		$this->db->not_like('biaya', 'lazada');
		$this->db->not_like('biaya', 'blibli');
		$this->db->not_like('biaya', 'matahari');
		$this->db->not_like('biaya', 'zilingo');
		$this->db->not_like('biaya', 'qoo');
		$this->db->not_like('biaya', 'jd.id');
		$this->db->not_like('biaya', 'tokopedia');
		$this->db->not_like('biaya', 'shopee');
	

		$this->db->limit(1);
		$this->db->order_by('status_transfer desc, status_kirim desc, tanggal_submit desc');
		// $this->db->order_by('tanggal_submit', 'RANDOM');
		return $this->db->get($this->tabel);
	}

	/**
	 * Ambil semua pesanan dalam database
	 *
	 * @return      array
	 */
	public function ambil_semua($juragan = FALSE, $oleh = FALSE, $status = 'all', $limit = FALSE, $offset = FALSE, $cari = FALSE, $by = FALSE, $mulai = FALSE, $akhir = FALSE) {
		if($juragan !== FALSE) {
			$this->db->having('juragan', $juragan);
		}
		if($by !== FALSE) {
			$this->db->having('oleh', $by);
		}

		if($limit !== FALSE && $offset !== FALSE) {
			$this->db->limit($limit);
			$this->db->offset($offset);
		}

		if($mulai !== FALSE && $akhir !== FALSE) {
			$this->db->where( 'tanggal_cek_kirim >=', strtotime($mulai) );
			$this->db->where( 'tanggal_cek_kirim <=', strtotime($akhir) );
		}

		// pencarian data
		if($cari !== FALSE) {
			$searchTerms = explode(' ', $cari);
			$searchTermBits = array();
			foreach ($searchTerms as $term) {
				$term = trim($term);
				if ( ! empty($term)) {
					$this->db->like('id_pesanan',  $term, 'both');
					if (($timestamp = strtotime($term)) !== false) {
						// set timezone cause mysql server in -04:00
						$this->db->or_like("DATE(CONVERT_TZ(FROM_UNIXTIME(tanggal_submit, '%Y-%m-%d %H:%i:%s'), '+00:00', '+00:00'))",  date('Y-m-d', $timestamp), 'after');
						// $this->db->or_like("DATE(CONVERT_TZ(FROM_UNIXTIME(tanggal_submit, '%Y-%m-%d %H:%i:%s'), '-4:00', '+07:00'))",  date('Y-m-d', $timestamp), 'after');
					}
					else {
						$this->db->or_like('pemesan',  $term, 'both');
						$this->db->or_like('detail',  $term, 'both');
						$this->db->or_like('slug',  $term, 'both');
					}
				}
			}
		}

		if($status === 'pending') {
			$this->db->having(array('status_kirim' => 'pending'));
			$this->db->order_by('status_transfer desc, status_kirim desc, tanggal_submit desc');
		
		}
		else if($status === 'terkirim') {
			$this->db->having(array('status_kirim' => 'terkirim'));
			if($mulai !== FALSE && $akhir !== FALSE) {
				$this->db->order_by('status_kirim asc, tanggal_cek_kirim asc, tanggal_submit asc');
			}
			else {
				$this->db->order_by('status_kirim asc, tanggal_cek_kirim desc, tanggal_submit desc');
			}
		}
		else {
			$this->db->order_by('status_transfer desc, status_kirim desc, tanggal_submit desc');
		}

		return $this->db->get($this->tabel);
	}

	/**
	 * Simpan data pengguna ke database
	 *
	 * @param       array  $data    Input array
	 * @return      bool
	 */
	public function simpan($data) {
		$this->db->insert($this->tabel, $data); 

		return TRUE;
	}

	public function update($slug, $data) {
		$this->db->where('slug', $slug);
		$this->db->update($this->tabel, $data); 

		return TRUE;
	}

	public function set_transfer($slug, $status) {
		$this->db->where('slug', $slug)->update($this->tabel, array('status_transfer' => $status, 'tanggal_cek_transfer' => ($status === 'tidak' ? NULL :  time()) ));

		if ($this->db->affected_rows() > -1) {
			return TRUE;
		}
	}

	public function set_kirim($slug, $status, $tanggal ='') {
		$this->db->where('slug', $slug)->update($this->tabel, array('status_kirim' => $status, 'tanggal_cek_kirim' => ($status === 'pending' ? NULL : $tanggal )));

		if ($this->db->affected_rows() > -1) {
			$this->unset_resi($slug);
			return TRUE;
		}
	}

	public function unset_resi($slug) {
		if($this->cek($slug)) {
			$q = $this->_detail($slug);

			$r = $q->row();

			// ambil detail
			$detail = (array) json_decode($r->detail);
			unset($detail['s']);

			
			$ow = json_encode($detail);
			$this->db->where('slug', $slug)->update($this->tabel, array('detail' =>  $ow ));
			if ($this->db->affected_rows() > -1) {
				return TRUE;
			}
		}
	}

	public function set_ongkir_fix($slug, $ongkir) {
		if($this->cek($slug)) {
			$q = $this->_detail($slug);

			$r = $q->row();

			// ambil detail
			$detail = (array) json_decode($r->biaya);
			$money_temp = (array) $detail['m'];

			unset($money_temp['of']);

			$data = array();
			if((int) $ongkir > 0) {
				$data  = array(
					'of' => (int) $ongkir
					);
			}

			$new_money = array();
			$new_money['m'] = array_merge($money_temp, $data);

			$narray = array_merge($detail, $new_money);

			$ow = json_encode($narray);
			$this->db->where('slug', $slug)->update($this->tabel, array('biaya' =>  $ow ));
			if ($this->db->affected_rows() > -1) {
				return TRUE;
			}
		}
	}

	public function ambil_id_juragan($slug) {
		if($this->cek($slug)) {
			$q = $this->_detail($slug);

			$r = $q->row();

			return $r->juragan;
		}
	}

	public function submit_resi($slug, $data) {
		if($this->cek($slug)) {
			$q = $this->_detail($slug);

			$r = $q->row();

			// ambil detail
			$detail = (array) json_decode($r->detail);
			unset($detail['s']);

			$plus = array();
			$plus['s'] = $data;
			$narray = array_merge($detail, $plus);
			$ow = json_encode($narray);
			$this->db->where('slug', $slug)->update($this->tabel, array('detail' =>  $ow ));
			if ($this->db->affected_rows() > -1) {
				return TRUE;
			}
		}
	}

	public function invoice_id($slug) {
		if($this->cek($slug)) {
			$q = $this->_detail($slug);

			$r = $q->row();

			return $r->id_pesanan;
		}
	}

	public function cek($slug) {
		$q = $this->db->where('slug', $slug)->get($this->tabel);

		if($q->num_rows() > 0 ) {
			return TRUE;
		}
	}

	public function _slug($id_pesanan) {
		$q = $this->db->where('id_pesanan', $id_pesanan)->get($this->tabel);
		if($q->num_rows() > 0 ) {
			$r = $q->row();

			return $r->slug;
		}
		else {
			return FALSE;
		}
	}

	public function _detail($slug) {
		$q = $this->db->where('slug', $slug)->get($this->tabel);

		return $q;
	}

	public function _count($juragan_id, $start_date, $end_date, $status = 'transfer') {
		$timestamp_m = strtotime($start_date);
		$timestamp_a = strtotime($end_date);

		if(in_array($status, array('transfer', 'kirim', 'pending','masuk')) && $timestamp_m !== false && $timestamp_a !== false) {
			if($status === 'transfer') {
				$this->db->where('status_transfer', 'ada');
				$this->db->where("tanggal_submit >=",  $timestamp_m);
				$this->db->where('tanggal_submit <=', $timestamp_a);

				$this->db->where("tanggal_cek_transfer >=",  $timestamp_m);
				$this->db->where('tanggal_cek_transfer <=', $timestamp_a);
			}
			else if($status === 'kirim') {
				$this->db->select('SUM(count) as pcs');
				$this->db->where('status_kirim', 'terkirim');

				$this->db->where("tanggal_cek_kirim >=",  $timestamp_m);
				$this->db->where('tanggal_cek_kirim <=', $timestamp_a);
			}
			else if($status === 'pending') {
				$this->db->select('SUM(count) as pcs');
				$this->db->where('status_transfer', 'ada');
				$this->db->where('status_kirim', 'pending');
			}
			else if($status === 'masuk') {
				$this->db->select('SUM(count) as pcs');
				$this->db->where("tanggal_submit >=",  $timestamp_m);
				$this->db->where('tanggal_submit <=', $timestamp_a);
			}
		}

		$this->db->where('juragan', $juragan_id);

		$q = $this->db->get($this->tabel);

		$r = $q->row();

		if(in_array($status, array('transfer', 'kirim', 'pending','masuk'))) {
			if($status === 'transfer')  {
				return $q->num_rows();
			}
			else {
				return (int) $r->pcs;
			}
		}
		else {
			return 0;
		}
	}

	public function _count_year($tahun, $juragan_id) {
		$this->db->select("FROM_UNIXTIME(tanggal_submit, '%c') as bln, COUNT(*) as count");
		$this->db->where("FROM_UNIXTIME(tanggal_submit , \"%Y\") =", $tahun);
		$this->db->where('juragan', $juragan_id);
		$this->db->where('status_kirim', 'terkirim');

		$this->db->order_by('bln', 'asc');
		$this->db->group_by('bln');
		$q = $this->db->get($this->tabel);

		return $q;
	}

	public function count($stat, $transfer_kirim = FALSE, $id_juragan) {
		if($stat === 'transfer') {
			if(in_array($transfer_kirim, array('ada', 'tidak'))) {
				$this->db->where('status_transfer', $transfer_kirim);
				// $this->db->where('del', NULL);
				if( ! empty($id_juragan)) {
					$this->db->where('juragan', $id_juragan);
				}			
				$this->db->from($this->tabel);
				$count = $this->db->count_all_results();

				return $count;
			}
			else {
				return 0;
			}
		}
		elseif($stat === 'kirim') {
			if(in_array($transfer_kirim, array('pending', 'terkriim'))) {
				$this->db->where('status_kirim', $transfer_kirim);
				// $this->db->where('del', NULL);
				if( ! empty($id_juragan)) {
					$this->db->where('juragan', $id_juragan);
				}			
				$this->db->from($this->tabel);
				$count = $this->db->count_all_results();

				return $count;
			}
			else {
				return 0;
			}
		}
		elseif ($stat === 'semua') {
			$this->db->select('SUM(count) as jumlah');
			$this->db->where('juragan', $id_juragan);
			$this->db->where('status_transfer', 'ada');

			$q = $this->db->get($this->tabel);

			$r = $q->row();

			return (int) $r->jumlah;

		}
	}
}