<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}


	public function bank() {
		$q = $this->input->get('q');
		$juragan = $this->input->get('juragan');

		$juragan_id = $this->juragan->ambil_juragan_id_by_username($juragan);
		
		$this->db->select('bank, COUNT(UPPER(bank)) as count');
		$this->db->from('pesanan');

		if( ! empty($q)) {
			$this->db->like('bank', $q,'both');
		}
		if( ! empty($juragan)) {
			$this->db->where('juragan_id', $juragan_id);
		}

		$this->db->group_by('UPPER(bank)');
		$this->db->order_by('count', 'DESC');
		
		$q = $this->db->get();

		$a = array();
		$i = 0;
		foreach ($q->result() as $r) {
			$a[] = array( 'bank' => strtoupper($r->bank), 'count' => $r->count);
		}

		$this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json', 'utf-8')
	         ->set_output(json_encode($a, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	         ->_display();
	    exit;
	}

	public function produk() {
		$q = $this->input->get('q');

		if( ! empty($q)) {
			$this->db->like('kode', $q,'both');
		}

		$q = $this->db->get('produk_daftar');

		$a = array();
		$i = 0;
		if($q->num_rows() > 0) {
			foreach ($q->result() as $r) {
				$a[] = array('nama' => $r->nama,'kode' => strtoupper($r->kode), 'harga' => $r->harga);
			}
		}
		else {
			$a[] = array('nama' => 'Custom', 'kode' => 'Custom', 'harga' => '0');
		}

		$this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json', 'utf-8')
	         ->set_output(json_encode($a, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	         ->_display();
	    exit;
	}

	public function pesanan() {

		$draw = $this->input->get('draw');
		$length = $this->input->get('length');
		$start = $this->input->get('start');
		$cari = $this->input->get('search[value]');

		if( ! empty($draw)) {
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

			$q = $this->db->select('p.*, u.nama_alias as username, u.nama as juragan')
						  ->from('pesanan p')
						  ->join('juragan u', 'p.juragan_id=u.id')
						  ->limit($length)
						  ->offset($start)
						  ->order_by('p.id', 'desc')
						  ->get();


			$a = array();
			if($q->num_rows() > 0) {
				foreach ($q->result() as $r) {
					// pesanan
					$pesanan = explode('#', strtoupper($r->pesanan));
					$pesan = array();
					foreach ($pesanan as $key) {
						$p2 = explode(',', $key);

						$pesan[] = array(
							'kode' => $p2[0],
							'size' => $p2[1],
							'jumlah' => $p2[2]
							);
					}

					// hp 
					$hp = array();
					$ph = explode(',', $r->hp);
					foreach ($ph as $v) {
						$hp[] = $v;
					}

					// gambar
					$gambar = array();
					$gmb = explode(',', $r->gambar);
					foreach ($gmb as $img) {
						$gambar[] = $img;
					}

					// kurir & resi
					$kurir = NULL;
					$resi = NULL;
					$tanggal_kirim = NULL;

					if($r->kurir_resi !== NULL) {
						$kr = explode(',', $r->kurir_resi);
						
						if(isset($kr[0])) {
							$kurir = $kr[0];
						}
						if(isset($kr[1])) {
							$resi = $kr[1];
						}
						if(isset($kr[2])) {
							$tanggal_kirim = $kr[2];
						}
					}

					$a['data'][] = 
						array(
							'id' => $r->id,
							'tanggal' => array(
								'submit' => $r->tanggal,
								'cek_kirim' => $r->cek_kirim,
								'cek_transfer' => $r->cek_transfer
								),
							'member_id' => $r->member_id,
							'pemesan' => array(
								'nama' => strtoupper($r->nama),
								'alamat' => strtoupper($r->alamat),
								'hp' => $hp
								),
							'pesanan' => array(
								'produk' => $pesan,
								'gambar' =>$gambar,
								'keterangan' => $r->keterangan
								),
							'biaya' => array(
								'harga' => $r->total_biaya,
								'ongkir' => $r->total_ongkir,
								'ongkir_fix' => $r->total_ongkir,
								'transfer1' => $r->total_transfer,
								'transfer2' => $r->total_transfer,
								'bank' => strtoupper($r->bank)
								),
							'status' => array(
								'transfer' => $r->status_transfer,
								'biaya_transfer' => $r->status_biaya_transfer
								),
							'pengiriman' => array(
								'status' => $r->status_kirim,
								'kurir' => $kurir,
								'resi' => $resi,
								'tanggal' => $tanggal_kirim
								),
							'juragan' => array(
								'id' => $r->juragan_id,
								'nama' => $r->juragan,
								'username' => $r->username
								),
							'uid' => $r->uid
							);

						$a["draw"] = $draw;
						$a["recordsTotal"] = 57;
						$a["recordsFiltered"] = 57;
				}
			
			}
			else {
				$a["data"] = array();
			}

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

			$pq = $this->db->select('p.*, u.nama_alias as username, u.nama as juragan')
						  ->from('pesanan p')
						  ->join('juragan u', 'p.juragan_id=u.id')
						  ->order_by('p.id', 'desc')
						  ->get();


			$a["draw"] = $draw;
			$a["recordsTotal"] = $pq->num_rows();
			$a["recordsFiltered"] = $pq->num_rows();
		}
		else {
			$a["error"] = array();
		}

		$this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json', 'utf-8')
	         ->set_output(json_encode($a, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	         ->_display();
	    exit;

	}

}
