<?php namespace App\Models;
use CodeIgniter\Model;
 
class FakturModel extends Model
{
	protected $db;
	public function __construct() {
		$this->db      = \Config\Database::connect();
		// $builder = $db->table('users');
	}

	public function get($juragan = 'semua')
	{
		$builder = $this->db->table('faktur f');
		$builder->select('f.*,p.*, j.juragan, j.nama_jrgn');
		$builder->select('d.diskon, u.unik, o.ongkir');
		$builder->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","&quot;id&quot;:",b.id_beli,",","&quot;stok_id&quot;:","&quot;",IFNULL(b.stok_id, "null"),"&quot;,","&quot;kode&quot;:&quot;",b.kode_beli,"&quot;,","&quot;size&quot;:&quot;",b.size_beli,"&quot;,","&quot;harga&quot;:",b.harga_beli, ",","&quot;qty&quot;:",b.qty_beli,"}")),"]") as barang');
		
		$builder->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","&quot;id&quot;:",by.id_byr,",","&quot;tipe&quot;:&quot;",by.tipe_byr,"&quot;,","&quot;bank&quot;:&quot;",by.bank,"&quot;,","&quot;total&quot;:",by.total_byr, ",","&quot;status&quot;:",by.status,",","&quot;tanggal&quot;:",by.tanggal_byr,"}")),"]") as bayar');

		$builder->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","&quot;id&quot;:",k.id_krm,",","&quot;resi&quot;:&quot;",k.resi,"&quot;,","&quot;kurir&quot;:&quot;",k.kurir,"&quot;,","&quot;ongkos&quot;:",k.ongkir_krm,",","&quot;qty&quot;:",k.qty_krm, ",","&quot;tanggal&quot;:",k.tanggal_krm,"}")),"]") as kirim');

		$builder->join('pelanggan p', 'p.id_plgn = f.pelanggan_id');
		$builder->join('juragan j', 'j.id_jrgn = p.juragan_id');
		$builder->join('dibeli b', 'b.faktur_id = f.id_fktr', 'left');
		$builder->join('diskon d', 'd.faktur_id = f.id_fktr', 'left');
		$builder->join('unik u', 'u.faktur_id = f.id_fktr', 'left');
		$builder->join('ongkir o', 'o.faktur_id = f.id_fktr', 'left');
		$builder->join('pembayaran by', 'by.faktur_id = f.id_fktr', 'left');
		$builder->join('pengiriman k', 'k.faktur_id = f.id_fktr', 'left');

		if ($juragan !== 'semua') {
			$builder->where('j.juragan', $juragan);
		}

		$builder->groupBy("f.id_fktr");
		$query = $builder->get();

		return $query;
	}


	/*
	private $tabel;
	public function __construct() {
		parent::__construct();
		$this->tabel = 'faktur';
	}
	
	public function get_all($juragan_id = FALSE, $by = FALSE, $limit = FALSE, $offset = FALSE, $cari = NULL) {
		$this->db->select("
		fak.*
		");

		$this->db->from($this->tabel . ' fak');
		// pencarian di halaman juragan
		if ($cari !== NULL) {
			$query = '';

			// pencarian status paket
			if(!empty($cari['paket']) && in_array($cari['paket'], array('belum_diproses', 'diproses', 'batal_proses'))) {
				switch ($cari['paket']) {
					case "diproses":
						// paket diproses
						$spkt = 1;
						break;
					case "batal_proses":
						$spkt = 2;
						break;
					case "belum_diproses":
						$spkt = 0;
						break;
				}

				$query_p = "fak.status_paket IN ('".$spkt."') ";
			}
			
			// pencarian pembayaran
			if(!empty($cari['pembayaran']) && in_array($cari['pembayaran'], array('belum_transfer', 'b_menunggu', 'c_sebagian', 'd_lunas', 'e_lebih'))) {
				switch ($cari['pembayaran']) {
					case "e_lebih":
						$strf = 4;
						break;
					case "d_lunas":
						$strf = 3;
						break;
					case "c_sebagian":
						$strf = 2;
						break;
					case "b_menunggu":
						$strf = 1;
						break;
					default:
						$strf = 0;
				}

				$query_b = "fak.status_transfer IN ('".$strf."') ";
			}

			// pencarian pengiriman
			if(!empty($cari['pengiriman']) && in_array($cari['pengiriman'], array('belum_kirim', 'd_sebagian', 'dikirim'))) {

				switch ($cari['pengiriman']) {
					case "dikirim":
						$skrm = 2;
						break;
					case "d_sebagian":
						$skrm = 1;
						break;
					default:
						$skrm = 0;
				}

				$query_k = "fak.status_kirim IN ('".$skrm."') ";
			}

			//  pencarian marketplace
			if(!empty($cari['marketplace']) && $cari['marketplace'] === 'ya') {
				$query_m = "fak.tipe IS NOT NULL ";
			}
		   
			// pencarian `query` && `tanggal`
			if(!empty($cari['q'])) {
				$query_q = "fak.id_faktur IN (
					SELECT DISTINCT f.id_faktur
					FROM faktur f
					INNER JOIN pesanan_produk p ON f.id_faktur=p.faktur_id
					WHERE ";

				if(!empty($cari['tanggal'])) {
					$query_q .= "DATE(CONVERT_TZ(FROM_UNIXTIME(tanggal_dibuat, '%Y-%m-%d %H:%i:%s'), '+00:00', '+00:00'))='".$cari['tanggal']."' AND ";
				}

				if (preg_match('/"([^"]+)"/', trim($cari['q']), $m)) {
					$query_q .= "f.nama LIKE '%".str_replace('"', "", $m[1])."%' ";
					
				} else {
					//preg_match returns the number of matches found, 
					//so if here didn't match pattern
				

					$query_q .= "p.kode LIKE '%".$cari['q']."%' ";

					preg_match_all('/%22(?:\\\\.|(?!%22).)*%22|\S+/', $cari['q'], $matches);
					// preg_match_all('/"(?:\\\\.|[^\\\\"])*"|\S+/', $cari['q'], $matches);

					foreach ($matches[0] as $term) {
						$term = trim($term);
						if ( ! empty($term)) {
							$term = str_replace('"', "", $term);
							$query_q .= "OR f.id_faktur LIKE '%".$term."%' ";
							$query_q .= "OR f.seri_faktur LIKE '%".$term."%' ";
							$query_q .= "OR f.nama LIKE '%".$term."%' ";
							$query_q .= "OR f.hp1 LIKE '%".$term."%' ";
							$query_q .= "OR f.hp2 LIKE '%".$term."%' ";
							$query_q .= "OR f.alamat LIKE '%".$term."%' ";
							$query_q .= "OR f.keterangan LIKE '%".$term."%' ";
						}
					}
				}

				$query_q .= ") ";
			}
 

			if(!empty($cari['tanggal'])) {
				$query_t =  "fak.id_faktur IN (SELECT DISTINCT id_faktur FROM `faktur` WHERE DATE(CONVERT_TZ(FROM_UNIXTIME(tanggal_dibuat, '%Y-%m-%d %H:%i:%s'), '+00:00', '+00:00'))='".$cari['tanggal']."') ";
			}

			// pembayaran, paket, pengiriman
			if(!empty($cari['pembayaran']) && !empty($cari['paket']) && !empty($cari['pengiriman'])) {
				$query .= $query_b . " AND " . $query_p . " AND " . $query_k;
			}
			else if(!empty($cari['pembayaran']) && !empty($cari['paket']) && empty($cari['pengiriman'])) {
				$query .= $query_b . " AND " . $query_p;
			}
			else if(!empty($cari['pembayaran']) && empty($cari['paket']) && !empty($cari['pengiriman'])) {
				$query .= $query_b . " AND " . $query_k;
			}
			else if(empty($cari['pembayaran']) && !empty($cari['paket']) && !empty($cari['pengiriman'])) {
				$query .= $query_p . " AND " . $query_k;
			}
			else if(!empty($cari['pembayaran']) && empty($cari['paket']) && empty($cari['pengiriman'])) {
				$query .= $query_b;
			}
			else if(empty($cari['pembayaran']) && empty($cari['paket']) && !empty($cari['pengiriman'])) {
				$query .= $query_k;
			}
			else if(empty($cari['pembayaran']) && !empty($cari['paket']) && empty($cari['pengiriman'])) {
				$query .= $query_p;
			}

			// marketplace, tanggal, query
			if(!empty($cari['pembayaran']) OR !empty($cari['paket']) OR !empty($cari['pengiriman'])) {
				$qand = TRUE;
			}
			else {
				$qand = FALSE;
			}

			if(!empty($cari['marketplace']) || !empty($cari['tanggal']) || !empty($cari['q']) ) {
				$q2and = TRUE;
			}
			else {
				$q2and = FALSE;
			}

			if($qand && $q2and) {
				$query .= " AND ";
			}
			else {
				$query .= '';
			}

			if(!empty($cari['marketplace']) && !empty($cari['tanggal']) && !empty($cari['q']) ) {
				$query .= $query_m . " AND " . $query_t . " AND " . $query_q;
			}
			else if(!empty($cari['marketplace']) && empty($cari['tanggal']) && !empty($cari['q'])) {
				$query .= $query_m . " AND " . $query_q;
			}
			else if(empty($cari['marketplace']) && !empty($cari['tanggal']) && !empty($cari['q'])) {
				$query .= $query_q;
			}
			else if(!empty($cari['marketplace']) && !empty($cari['tanggal']) && empty($cari['q'])) {
				$query .= $query_m . " AND " . $query_t;
			}
			else if(empty($cari['marketplace']) && empty($cari['tanggal']) && !empty($cari['q'])) {
				$query .= $query_q;
			}
			else if(!empty($cari['marketplace']) && empty($cari['tanggal']) && empty($cari['q'])) {
				$query .= $query_m;
			}
			else if(empty($cari['marketplace']) && !empty($cari['tanggal']) && empty($cari['q'])) {
				$query .= $query_t;
			}
			
			///////////////////
			if(!empty($cari['pembayaran']) || !empty($cari['paket']) || !empty($cari['pengiriman']) || !empty($cari['marketplace']) || !empty($cari['tanggal']) || !empty($cari['q'])  ) {
				$this->db->where( $query, NULL);
			}
		}

		if ($juragan_id !== FALSE) {
			$this->db->where_in('juragan_id', $juragan_id);
		}

		if($limit !== FALSE && $offset !== FALSE) {
			$this->db->limit($limit);
			$this->db->offset($offset);
		}

		$this->db->order_by('status_paket ASC, status_kirim ASC, status_transfer ASC, tanggal_kirim DESC, tanggal_dibuat DESC');

		// $this->db->group_by('fak.id_faktur');
		$q = $this->db->get();
		return $q;
	}

	public function get_detail($seri_faktur) {
		$this->db->select("
		fak.*,
		jur.nama AS nama_juragan,
		pen.nama AS nama_cs,
		jur.slug,
		disk.nominal AS diskon,
		unk.nominal AS unik,
		ongk.nominal AS ongkir,
		GROUP_CONCAT(DISTINCT CONCAT(kir.kurir,'|',kir.resi,'|',kir.tanggal_kirim,'|',kir.ongkir,'|',kir.id_pengiriman)) AS pengiriman,
		GROUP_CONCAT(DISTINCT CONCAT(bay.rekening,'|',bay.jumlah,'|',bay.tanggal_bayar,'|',IFNULL(bay.tanggal_cek, 'NULL'),'|',bay.id_pembayaran)) AS pembayaran,
		GROUP_CONCAT(DISTINCT CONCAT(pro.kode,'|',pro.ukuran,'|',pro.jumlah,'|',pro.harga,'|',pro.id_pesanproduk)) AS produk,
		");

		$this->db->from($this->tabel . ' fak');
		$this->db->join('pengiriman kir', 'fak.id_faktur=kir.faktur_id', 'left');
		$this->db->join('biaya_diskon disk', 'fak.id_faktur=disk.faktur_id', 'left');
		$this->db->join('biaya_unik unk', 'fak.id_faktur=unk.faktur_id', 'left');
		$this->db->join('biaya_ongkir ongk', 'fak.id_faktur=ongk.faktur_id', 'left');
		$this->db->join('pembayaran bay', 'fak.id_faktur=bay.faktur_id', 'left');
		$this->db->join('pesanan_produk pro', 'fak.id_faktur=pro.faktur_id', 'left');
		$this->db->join('juragan jur', 'fak.juragan_id=jur.id', 'left');
		$this->db->join('pengguna pen', 'pen.id=fak.pengguna_id', 'left');

		$this->db->where('fak.seri_faktur', $seri_faktur);
		
		$this->db->group_by('fak.id_faktur');
		$q = $this->db->get();
		return $q;
	}

	public function get_info($id_faktur, $info) {
		$this->db->where('id_faktur', $id_faktur);
		$q = $this->db->get('faktur');

		if ($q->num_rows() > 0) {
			$r = $q->row();

			return $r->$info;
		}
	}

	public function get_custom_info($id_primary, $info, $primary = 'id_faktur') {
		$this->db->select($info);
		$this->db->where($primary, $id_primary);
		$q = $this->db->get('faktur');

		return $q->row();
	}

	public function check($seri_faktur) {
		$this->db->where('seri_faktur', $seri_faktur);
		$q = $this->db->get('faktur');

		return $q->num_rows();
	}

	public function add_invoice($data) {
		$this->db->insert('faktur', $data);
		return TRUE;
	}

	public function edit_invoice($id_faktur, $data) {
		$this->db->where('id_faktur', $id_faktur);
		$this->db->update('faktur', $data);
		return TRUE;
	}

	public function del_all($faktur_id) {
		// delete faktur
		$this->db->delete('faktur', array('id_faktur' => $faktur_id));

		// pengiriman, pembayaran, pesanan_produk, keterangan
		$tables = array('pengiriman', 'pembayaran', 'biaya_ongkir', 'biaya_diskon', 'biaya_unik', 'pesanan_produk');
		$this->db->where('faktur_id', $faktur_id);
		$this->db->delete($tables);

		return TRUE;
	}

	public function get_biaya($faktur_id, $tabel) {
		$table = 'biaya_' . $tabel;
		$q = $this->db->get_where($table, array('faktur_id' => $faktur_id));
		if($q->num_rows() > 0) {
			$r = $q->row();
			return (int) $r->nominal;
		}
		else {
			return 0;
		}
	}

	public function upset_biaya($tabel, $faktur_id, $nominal) {
		$table = 'biaya_' . $tabel;
		if($nominal > 0) {    
			$q = $this->db->get_where($table, array('faktur_id' => $faktur_id));
			if($q->num_rows() > 0) {
				// update
				$this->db->where('faktur_id', $faktur_id);
				$this->db->update($table, array('nominal' => $nominal));
			}
			else {
				// insert
				$id_biaya = array();
				$biaya_id = $this->_primary($table, 'id_' . $tabel);
				if ((int) $biaya_id !== 0) {

					$id_biaya = array( 'id_' . $tabel => $biaya_id);
				}

				$data_biaya = array(
					'faktur_id' => $faktur_id,
					'nominal' => $nominal
				);
				$this->db->insert($table, array_merge($id_biaya, $data_biaya));
			}
		}
		else {
			$this->db->where('faktur_id', $faktur_id)
					 ->delete($table);
		}
	}


	public function get_orders($faktur_id) {
		return $this->db->get_where('pesanan_produk', array('faktur_id' => $faktur_id));
	}

	public function add_orders($data) {
		$this->db->insert_batch('pesanan_produk', $data);
		return TRUE;
	}

	public function add_order($data) {
		$this->db->insert('pesanan_produk', $data);
		return TRUE;
	}

	public function edit_order($id_pesanproduk, $data) {
		$this->db->where('id_pesanproduk', $id_pesanproduk);
		$this->db->update('pesanan_produk', $data);

		return TRUE;
	}

	public function delete_order($id_pesanproduk) {
		$this->db->where('id_pesanproduk', $id_pesanproduk);
		$this->db->delete('pesanan_produk');

		return TRUE;
	}

	public function get_pays($faktur_id) {
		$this->db->order_by('tanggal_bayar ASC');
		return $this->db->get_where('pembayaran', array('faktur_id' => $faktur_id));
	}

	public function get_pay($id_pembayaran) {
		$q = $this->db->where(array('id_pembayaran' => $id_pembayaran))->get('pembayaran');
		return $q;
	}

	public function sub_pay($data) {
		return $this->db->insert_batch('pembayaran', $data);
	}

	public function sub_pay_($data) {
		$this->db->insert('pembayaran', $data);
		return TRUE;
	}

	public function del_pay($id_pembayaran) {
		$this->db->delete('pembayaran', array('id_pembayaran' => $id_pembayaran));
		return TRUE;
	}

	public function del_pays($id_faktur) {
		$this->db->delete('pembayaran', array('faktur_id' => $id_faktur));
		return TRUE;
	}

	public function update_pay($id_pembayaran, $data) {
		$this->db->where('id_pembayaran', $id_pembayaran);
		$this->db->update('pembayaran', $data);
		
		return TRUE;
	}

	public function check_paid($id_pembayaran) {
		$q = $this->db->where(array('id_pembayaran' => $id_pembayaran, 'tanggal_cek !=' => NULL))->get('pembayaran');

		if($q->num_rows() > 0) {
			return TRUE;
		}
	}

	public function calc_pembayaran($faktur_id) {
		$q = $this->db->where(array('faktur_id' => $faktur_id))->get('pembayaran');

		$terbayar = 0;
		$belum_dibayar = 0;
		$total_harga_produk = 0;
		$tanggal_cek = 0;

		if ($q->num_rows() > 0) {
			foreach ($q->result() as $bayar) {
				if($bayar->tanggal_cek !== NULL) {
					$terbayar += $bayar->jumlah;
				}
				else {
					$belum_dibayar++;
				}
				$tanggal_cek = $bayar->tanggal_cek;
			}
		}

		// get price
		$prod = $this->get_orders($faktur_id);
		foreach ($prod->result() as $produk) {
			$total_harga_produk += ($produk->jumlah * $produk->harga);
		}

		// discount
		$diskon = $this->get_biaya($faktur_id, 'diskon');

		// unik
		$unik = $this->get_biaya($faktur_id, 'unik');

		// ongkir
		$ongkir = $this->get_biaya($faktur_id, 'ongkir');

		// total wajib bayar
		$wajib_bayar = $total_harga_produk + $unik + $ongkir - $diskon;
	
		// set
		// jika yang dibayarkan masih belum melunasi dan ada yang belum dicek / masuk
		if(($terbayar > 0 || $terbayar === 0) && $belum_dibayar > 0) {
			// $this->update_ket($faktur_id, 's_transfer', 'b_menunggu', TRUE);
			$data_tr = array(
				'status_transfer' => '1',
				'tanggal_transfer' => $tanggal_cek
			);
		}
		// jika yang dibayarkan elum melunasi semua dan tidak ada yang belum dicek
		else if($terbayar > 0 && $belum_dibayar === 0 && $wajib_bayar > $terbayar) {
			// $this->update_ket($faktur_id, 's_transfer', 'c_sebagian', TRUE);
			$data_tr = array(
				'status_transfer' => '2',
				'tanggal_transfer' => $tanggal_cek
			);
		}
		// jika mempunyai kelebihan
		else if($wajib_bayar < $terbayar) {
			// $this->update_ket($faktur_id, 's_transfer', 'e_lebih', TRUE);
			$data_tr = array(
				'status_transfer' => '4',
				'tanggal_transfer' => $tanggal_cek
			);
		}
		// jika pas pembayarannya
		else if($wajib_bayar === $terbayar) {
			// $this->update_ket($faktur_id, 's_transfer', 'd_lunas', TRUE);
			$data_tr = array(
				'status_transfer' => '3',
				'tanggal_transfer' => $tanggal_cek
			);
		}
		else {
			// $this->update_ket($faktur_id, 's_transfer', 'belum_transfer', TRUE);
			$data_tr = array(
				'status_transfer' => '0',
				'tanggal_transfer' => '0'
			);
		}

		// update
		$this->edit_invoice($faktur_id, $data_tr);
	}

	public function get_carry($faktur_id) {
		return $this->db->order_by('tanggal_kirim asc')->get_where('pengiriman', array('faktur_id' => $faktur_id));
	}

	public function get_carry_($id_pengiriman) {
		$q = $this->db->where(array('id_pengiriman' => $id_pengiriman))->get('pengiriman');
		return $q;
	}

	public function del_carry($faktur_id) {
		$this->db->where('faktur_id', $faktur_id);
		$this->db->delete('pengiriman');

		return TRUE;
	}

	public function del_carry_($id_pengiriman) {
		$this->db->delete('pengiriman', array('id_pengiriman' => $id_pengiriman));
		return TRUE;
	}

	public function sub_carry($data) {
		return $this->db->insert('pengiriman', $data);
	}

	public function sub_carries($data) {
		return $this->db->insert_batch('pengiriman', $data);
	}

	public function update_carry($id_pengiriman, $data) {
		$this->db->where('id_pengiriman', $id_pengiriman);
		$this->db->update('pengiriman', $data);
		
		return TRUE;
	}

	public function calc_carry($faktur_id, $kirim_cod = 'kirim', $yes_no = 'ya') {
		$kirim = $this->get_carry($faktur_id);

		if($kirim->num_rows() > 0) {
			$r = $kirim->row();
			//
			if (strtolower($kirim_cod) === 'kirim' && $yes_no === 'ya') {
				$val = '2';
				$val_ = '2';
			}
			elseif (strtolower($kirim_cod) === 'cod' && $yes_no === 'ya') {
				$val = '2';
				$val_ = '1';
			}
			else {
				$val = '1';
				$val_ = NULL;
			}
			$data_update = array(
				'status_kirim' => $val,
				'status_kiriman' => $val_,
				'tanggal_kirim' => $r->tanggal_kirim
			);
			// $this->update_ket($faktur_id, 's_kirim', $val, TRUE);            
		}
		else {
			$data_update = array(
				'status_kirim' => '0',
				'status_kiriman' => NULL,
				'tanggal_kirim' => '0'
			);
			//$this->update_ket($faktur_id, 's_kirim', 'belum_kirim', TRUE);
		}

		$this->edit_invoice($faktur_id, $data_update);
	}

	public function set_package($faktur_id, $status) {
		switch ($status) {
			case '1':
				# diproses
				$data_update = array(
					'status_paket' => '1',
					'tanggal_paket' => now()
				);
				break;
			
			case '2':
				# dibatalkan
				$data_update = array(
					'status_paket' => '2',
					'tanggal_paket' => now()
				);
				break;
			
			default:
				# belumproses
				$data_update = array(
					'status_paket' => '0',
					'tanggal_paket' => '0',
					'status_kirim' => '0',
					'status_kiriman' => NULL,
					'tanggal_kirim' => '0'
				);

				$this->del_carry($faktur_id);
				$this->calc_carry($faktur_id);
				break;
		}

		$this->edit_invoice($faktur_id, $data_update);
		return TRUE;
	}

	public function _primary($table, $primary, $max = 1, $i = 0) {
		$gid = $this->db->select($primary)->from($table)->get();
		
		$missing = array();
		if($gid->num_rows() > 0) {
			$db_id = array();
			foreach ($gid->result() as $id) {
				$db_id[] = $id->$primary;
			}
			
			$arr2 = range(1, max($db_id));                                                    

			// use array_diff to get the missing elements 
			$missing = array_diff($arr2, $db_id);
		}

		if(empty($missing)) {
			return 0;
		}
		else {
			if($max <= count($missing)) {
				return array_values($missing)[$i];
			}
			else {
				return 0;
			}
		}
	}
	
	public function counter($juragan_id, $start_date, $end_date, $status = 'belum_proses') {
		$timestamp_m = strtotime($start_date);
		$timestamp_a = strtotime($end_date);

		switch ($status) {
			case 'belum_proses':
				$this->db->from('faktur f');
				$this->db->where("f.tanggal_dibuat >=",  $timestamp_m);
				$this->db->where('f.tanggal_dibuat <=', $timestamp_a);
				$this->db->where('f.status_paket', '0');
				break;
			
			case 'diproses':
				$this->db->from('faktur f');
				$this->db->where("f.tanggal_dibuat >=",  $timestamp_m);
				$this->db->where('f.tanggal_dibuat <=', $timestamp_a);
				$this->db->where('f.status_paket', '1');
				break;

			case 'terkirim':
				$this->db->from('faktur f');
				$this->db->select('COALESCE(SUM(p.jumlah),0) as pcs');

				$this->db->join('pesanan_produk p', 'f.id_faktur=p.faktur_id');

				$this->db->where("f.tanggal_kirim >=",  $timestamp_m);
				$this->db->where('f.tanggal_kirim <=', $timestamp_a);
				$this->db->where_in('f.status_kirim', '2');
				break;
		}
		
		$this->db->where_in('f.juragan_id', $juragan_id);
		$q = $this->db->get();
		return $q;
	}

	public function count_faktur($juragan_id, $start_date, $end_date, $status = 'transfer') {
		$timestamp_m = strtotime($start_date);
		$timestamp_a = strtotime($end_date);


		if ( ! in_array($status, array('transfer', 'semua', 'belum_lunas'))) {
			$this->db->select('SUM(p.jumlah) as pcs');
		}
		else {
			$this->db->select('f.id_faktur');
		}

		$this->db->from('faktur f');
		//$this->db->join('pesanan_produk p', 'f.id_faktur=p.faktur_id', 'left');
		
		
		if(in_array($status, array('transfer', 'kirim', 'pending', 'masuk', 'semua', 'belum_lunas')) && $timestamp_m !== false && $timestamp_a !== false) {
			switch ($status) {
				case 'semua':
					# code...
					$this->db->where("f.tanggal_dibuat >=",  $timestamp_m);
					$this->db->where('f.tanggal_dibuat <=', $timestamp_a);
					break;
				
				case 'belum_lunas':
					# code...
					$this->db->where("f.tanggal_dibuat >=",  $timestamp_m);
					$this->db->where('f.tanggal_dibuat <=', $timestamp_a);
					$this->db->where_not_in('f.status_transfer', array('3', '4'));
					break;

				case 'transfer':
					# code...
					$this->db->where('status_transfer', '3');
					$this->db->where("tanggal_dibuat >=",  $timestamp_m);
					$this->db->where('tanggal_dibuat <=', $timestamp_a);

					$this->db->where("tanggal_transfer >=",  $timestamp_m);
					$this->db->where('tanggal_transfer <=', $timestamp_a);
					break;
				
				case 'kirim':
					# code...
					$this->db->where('status_kirim', '2');

					$this->db->where("tanggal_kirim >=",  $timestamp_m);
					$this->db->where('tanggal_kirim <=', $timestamp_a);
					break;

				case 'masuk':
					# code...
					$this->db->where("f.tanggal_dibuat >=",  $timestamp_m);
					$this->db->where('f.tanggal_dibuat <=', $timestamp_a);
					$this->db->where('f.status_paket', '1');
					break;

				case 'pending':
					# code...
					$this->db->where('status_transfer', '3');
					$this->db->where_in('status_kirim', array('0'));
					break;
			}
		}


		$this->db->where('juragan_id', $juragan_id);
		$this->db->group_by('f.id_faktur');
		$q = $this->db->get();

		return $q;
	}
	*/
}
