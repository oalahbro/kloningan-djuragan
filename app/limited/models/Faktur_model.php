<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur_model extends CI_Model
{
	private $tabel;
	public function __construct() {
		parent::__construct();
		$this->tabel = 'faktur';
    }
    
    /**
	 * Ambil semua faktur
	 *
	 */
    public function get_all($juragan_id = FALSE, $by = FALSE, $limit = FALSE, $offset = FALSE, $cari = NULL) {
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

        // pencarian
        if($cari !== NULL ) {
            // pembayaran ada            
            $query = '';

            if(!empty($cari['paket']) && in_array($cari['paket'], array('belum_diproses', 'diproses'))) {
                switch ($cari['paket']) {
                    case "diproses":
                        // paket diproses
                        $spkt = 1;
                        break;
                    case "batal_proses":
                        $spkt = 2;
                        break;
                    default:
                        $spkt = 0;
                }

                $query_p = "fak.status_paket IN ('".$spkt."') ";
            }
            
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

            if(!empty($cari['pengiriman']) && in_array($cari['pengiriman'], array('belum_kirim', 'd_sebagian', 'dikirim'))) {

                if($cari['pengiriman'] === 'dikirim') {
                    $query_k = "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `keterangan` WHERE `key` = 's_kirim' AND `val` = 'b_dikirim' OR `val` = 'c_diambil') ";
                }
                else {
                    $query_k = "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `keterangan` WHERE `key` = 's_kirim' AND `val` = '".$cari['pengiriman']."') ";
                }

                switch ($cari['pengiriman']) {
                    case "dikirim":
                        $query_k = "fak.status_kirim IN ('2','3') ";
                        break;
                    case "d_sebagian":
                        $query_k = "fak.status_kirim IN ('1') ";
                        break;
                    default:
                        $query_k = "fak.status_kirim IN ('0') ";
                }
            }

            // $cari
            if(!empty($cari['marketplace']) && $cari['marketplace'] === 'ya') {
                $query_m = "fak.tipe IS NOT NULL ";
            }

            if(!empty($cari['q'])) {
                $query_q =  "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `pesanan_produk` WHERE `kode` LIKE '%".$cari['q']."%') ";
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
                $query .= $query_t . " AND " . $query_q;
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
        
            if(!empty($cari['q'])) {
                $searchTerms = explode(' ', $cari['q']);
                $searchTermBits = array();
                foreach ($searchTerms as $term) {
                    $term = trim($term);
                    if ( ! empty($term)) {
                        $this->db->or_like('fak.id_faktur',  $term, 'both');
                        $this->db->or_like('fak.seri_faktur',  $term, 'both');
                        $this->db->or_like('fak.nama',  $term, 'both');
                        $this->db->or_like('fak.hp1',  $term, 'both');
                        $this->db->or_like('fak.hp2',  $term, 'both');
                        $this->db->or_like('fak.alamat',  $term, 'both');
                        $this->db->or_like('fak.keterangan',  $term, 'both');
                    }
                }
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

        $this->db->group_by('fak.id_faktur');
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
        $tables = array('pengiriman', 'pembayaran', 'keterangan', 'pesanan_produk');
        $this->db->where('faktur_id', $faktur_id);
        $this->db->delete($tables);

        return TRUE;
    }

    /**
	 * biaya_diskon
	 *
	 */
    public function get_diskon($faktur_id) {
        $q = $this->db->get_where('biaya_diskon', array('faktur_id' => $faktur_id));
        if($q->num_rows> 0) {
            $r = $q->row();
            return $r->nominal;
        }
        else {
            return 0;
        }
    }

    /**
	 * biaya_ongkir
	 *
	 */
    public function get_ongkir($faktur_id) {
        $q = $this->db->get_where('biaya_ongkir', array('faktur_id' => $faktur_id));
        if($q->num_rows> 0) {
            $r = $q->row();
            return $r->nominal;
        }
        else {
            return 0;
        }
    }

    /**
	 * biaya_unik
	 *
	 */
    public function get_unik($faktur_id) {
        $q = $this->db->get_where('biaya_unik', array('faktur_id' => $faktur_id));
        if($q->num_rows> 0) {
            $r = $q->row();
            return $r->nominal;
        }
        else {
            return 0;
        }
    }

    /**
	 * update, insert, delete : biaya_
	 *
	 */
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
                $this->db->insert($table, array('faktur_id' => $faktur_id, 'nominal' => $nominal));
            }
        }
        else {
            $this->db->where('faktur_id', $faktur_id)
                     ->delete($table);
        }
    }


    /**
	 * produk dipesan
	 *
	 */
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

    /**
	 * pembayaran
	 *
	 */
    public function get_pays($faktur_id) {
        $this->db->order_by('tanggal_bayar ASC');
        return $this->db->get_where('pembayaran', array('faktur_id' => $faktur_id));
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
        $diskon = $this->get_diskon($faktur_id);

        // unik
        $unik = $this->get_unik($faktur_id);

        // ongkir
        $ongkir = $this->get_ongkir($faktur_id);

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

    /**
	 * keterangan
	 *
	 */
    public function get_ket($faktur_id, $ket) {
        $this->db->select("MAX(CASE WHEN (ket.key = '".$ket."') THEN ket.val ELSE NULL END) AS " .$ket);
        $this->db->from('keterangan ket');
        $this->db->where(array('faktur_id' => $faktur_id));
        $q = $this->db->get();

        $r = $q->row();

        return $r->$ket;
    }

    public function sub_ket($data) {
        return $this->db->insert_batch('keterangan', $data);
    }

    public function update_ket($faktur_id, $key, $val, $upset = TRUE) {
        $this->db->where(array('faktur_id' => $faktur_id, 'key' => $key));
        $q = $this->db->get('keterangan');

        if($upset) {
            if($q->num_rows() > 0) {
                // update
                $this->db->where(array('faktur_id' => $faktur_id, 'key' => $key))->update('keterangan', array('val' => $val));
            }
            else {
                $this->db->insert('keterangan', array('faktur_id' => $faktur_id, 'key' => $key, 'val' => $val));
            }
        }
        else {
            $this->db->delete('keterangan', array('faktur_id' => $faktur_id, 'key' => $key));
        }
        return TRUE;
    }


    /**
	 * pengiriman
	 *
	 */
    public function get_carry($faktur_id) {
        return $this->db->get_where('pengiriman', array('faktur_id' => $faktur_id));
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
            //
            if (strtolower($kirim_cod) === 'kirim' && $yes_no === 'ya') {
                $val = 'b_dikirim';
            }
            elseif (strtolower($kirim_cod) === 'cod' && $yes_no === 'ya') {
                $val = 'c_diambil';
            }
            else {
                $val = 'd_sebagian';
            }
            $this->update_ket($faktur_id, 's_kirim', $val, TRUE);            
        }
        else {
            $this->update_ket($faktur_id, 's_kirim', 'belum_kirim', TRUE);
        }
    }

    /**
	 * Atur status paket
	 *
	 */
    public function set_package($faktur_id, $status) {
        if($status === 'diproses') {
            $this->update_ket($faktur_id, 's_paket', 'diproses', TRUE);
        }
        else {
            $this->update_ket($faktur_id, 's_paket', 'belum_diproses', TRUE);
            $this->update_ket($faktur_id, 's_kirim', 'belum_kirim', TRUE);

            $this->del_carry($faktur_id);
            $this->calc_carry($faktur_id);
        }
        return TRUE;
    }

    

    
	
}
