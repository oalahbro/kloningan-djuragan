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
    public function get_all($juragan_id, $by = FALSE, $limit = FALSE, $offset = FALSE, $cari = NULL) {
        $this->db->select("
        fak.*,
        jur.nama AS nama_juragan,
        pen.nama AS nama_cs,
        jur.slug,
        MAX(CASE WHEN (ket.key = 'hp') THEN ket.val ELSE NULL END) AS hp2,
        MAX(CASE WHEN (ket.key = 'ongkir') THEN ket.val ELSE 0 END) AS ongkir,
        MAX(CASE WHEN (ket.key = 'unik') THEN ket.val ELSE 0 END) AS unik,
        MAX(CASE WHEN (ket.key = 'diskon') THEN ket.val ELSE 0 END) AS diskon,
        MAX(CASE WHEN (ket.key = 'keterangan') THEN ket.val ELSE NULL END) AS keterangan,
        MAX(CASE WHEN (ket.key = 's_transfer') THEN ket.val ELSE 'belum_transfer' END) AS status_transfer,
        MAX(CASE WHEN (ket.key = 's_kirim') THEN ket.val ELSE 'belum_kirim' END) AS status_kirim,
        MAX(CASE WHEN (ket.key = 's_paket') THEN ket.val ELSE 'belum_diproses' END) AS status_paket,
        MAX(CASE WHEN (ket.key = 'tipe') THEN ket.val ELSE NULL END) AS tipe,
        MAX(CASE WHEN (ket.key = 'gambar') THEN ket.val ELSE NULL END) AS gambar,
        GROUP_CONCAT(DISTINCT CONCAT(kir.kurir,'|',kir.resi,'|',kir.tanggal_kirim,'|',kir.ongkir,'|',kir.id_pengiriman)) AS pengiriman,
        GROUP_CONCAT(DISTINCT CONCAT(bay.rekening,'|',bay.jumlah,'|',bay.tanggal_bayar,'|',IFNULL(bay.tanggal_cek, 'NULL'),'|',bay.id_pembayaran)) AS pembayaran,
        GROUP_CONCAT(DISTINCT CONCAT(pro.kode,'|',pro.ukuran,'|',pro.jumlah,'|',pro.harga,'|',pro.id_pesanproduk)) AS produk,
        ");

        $this->db->from($this->tabel . ' fak');
        $this->db->join('pengiriman kir', 'fak.id_faktur=kir.faktur_id', 'left');
        $this->db->join('keterangan ket', 'fak.id_faktur=ket.faktur_id', 'left');
        $this->db->join('pembayaran bay', 'fak.id_faktur=bay.faktur_id', 'left');
        $this->db->join('pesanan_produk pro', 'fak.id_faktur=pro.faktur_id', 'left');
        $this->db->join('juragan jur', 'fak.juragan_id=jur.id', 'left');
        $this->db->join('pengguna pen', 'pen.id=fak.pengguna_id', 'left');

        // pencarian
        if($cari !== NULL ) {
            // pembayaran ada
            
            $query = '';
            $dbyr = in_array($cari['pembayaran'], array('belum_transfer', 'b_menunggu', 'c_sebagian', 'd_lunas', 'e_lebih'));
            $dpkt = in_array($cari['paket'], array('belum_diproses', 'diproses'));
            $dkrm = in_array($cari['pengiriman'], array('belum_kirim', 'd_sebagian', 'dikirim'));
           
            if($dpkt && !empty($cari['paket'])) {
                $query_p = "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `keterangan` WHERE `key` = 's_paket' AND `val` = '".$cari['paket']."') ";
            }
            
            if($dbyr && !empty($cari['pembayaran'])) {
                $query_b = "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `keterangan` WHERE `key` = 's_transfer' AND `val` = '".$cari['pembayaran']."') ";
            }

            if($dkrm && !empty($cari['pengiriman'])) {
                if($cari['pengiriman'] === 'dikirim') {
                    $query_k = "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `keterangan` WHERE `key` = 's_kirim' AND `val` = 'b_dikirim' OR `val` = 'c_diambil') ";
                }
                else {
                    $query_k = "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `keterangan` WHERE `key` = 's_kirim' AND `val` = '".$cari['pengiriman']."')";
                }
            }

            // $cari
            if(!empty($cari['marketplace'])) {
                $query_m = "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `keterangan` WHERE `key` = 'tipe') ";
            }

            if(!empty($cari['q'])) {
                $query_q =  "fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `keterangan` WHERE `val` LIKE '%".$cari['q']."%') OR fak.id_faktur IN (SELECT DISTINCT faktur_id FROM `pesanan_produk` WHERE `kode` LIKE '%".$cari['q']."%') ";
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
                        $this->db->or_like('fak.alamat',  $term, 'both');
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

        $this->db->order_by('status_kirim ASC, status_paket ASC, status_transfer ASC, kir.tanggal_kirim DESC');

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
        MAX(CASE WHEN (ket.key = 'hp') THEN ket.val ELSE NULL END) AS hp2,
        MAX(CASE WHEN (ket.key = 'ongkir') THEN ket.val ELSE 0 END) AS ongkir,
        MAX(CASE WHEN (ket.key = 'unik') THEN ket.val ELSE 0 END) AS unik,
        MAX(CASE WHEN (ket.key = 'diskon') THEN ket.val ELSE 0 END) AS diskon,
        MAX(CASE WHEN (ket.key = 'keterangan') THEN ket.val ELSE NULL END) AS keterangan,
        MAX(CASE WHEN (ket.key = 's_transfer') THEN ket.val ELSE NULL END) AS status_transfer,
        MAX(CASE WHEN (ket.key = 's_kirim') THEN ket.val ELSE NULL END) AS status_kirim,
        MAX(CASE WHEN (ket.key = 's_paket') THEN ket.val ELSE NULL END) AS status_paket,
        MAX(CASE WHEN (ket.key = 'tipe') THEN ket.val ELSE NULL END) AS tipe,
        MAX(CASE WHEN (ket.key = 'gambar') THEN ket.val ELSE NULL END) AS gambar,
        GROUP_CONCAT(DISTINCT CONCAT(kir.kurir,'|',kir.resi,'|',kir.tanggal_kirim,'|',kir.ongkir,'|',kir.id_pengiriman)) AS pengiriman,
        GROUP_CONCAT(DISTINCT CONCAT(bay.rekening,'|',bay.jumlah,'|',bay.tanggal_bayar,'|',IFNULL(bay.tanggal_cek, 'NULL'),'|',bay.id_pembayaran)) AS pembayaran,
        GROUP_CONCAT(DISTINCT CONCAT(pro.kode,'|',pro.ukuran,'|',pro.jumlah,'|',pro.harga,'|',pro.id_pesanproduk)) AS produk,
        ");

        $this->db->from($this->tabel . ' fak');
        $this->db->join('pengiriman kir', 'fak.id_faktur=kir.faktur_id', 'left');
        $this->db->join('keterangan ket', 'fak.id_faktur=ket.faktur_id', 'left');
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

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $bayar) {
                if($bayar->tanggal_cek !== NULL) {
                    $terbayar += $bayar->jumlah;
                }
                else {
                    $belum_dibayar++;
                }
            }
        }

        // get price
        $prod = $this->get_orders($faktur_id);
        foreach ($prod->result() as $produk) {
            $total_harga_produk += ($produk->jumlah * $produk->harga);
        }

        // discount
        $diskon = $this->get_ket($faktur_id, 'diskon');

        // unik
        $unik = $this->get_ket($faktur_id, 'unik');

        // ongkir
        $ongkir = $this->get_ket($faktur_id, 'ongkir');

        // total wajib bayar
        $wajib_bayar = $total_harga_produk + $unik + $ongkir - $diskon;
    
        // set
        // jika yang dibayarkan masih belum melunasi dan ada yang belum dicek / masuk
        if(($terbayar > 0 || $terbayar === 0) && $belum_dibayar > 0) {
            $this->update_ket($faktur_id, 's_transfer', 'b_menunggu', TRUE);
        }
        // jika yang dibayarkan elum melunasi semua dan tidak ada yang belum dicek
        else if($terbayar > 0 && $belum_dibayar === 0 && $wajib_bayar > $terbayar) {
            $this->update_ket($faktur_id, 's_transfer', 'c_sebagian', TRUE);
        }
        // jika mempunyai kelebihan
        else if($wajib_bayar < $terbayar) {
            $this->update_ket($faktur_id, 's_transfer', 'e_lebih', TRUE);
        }
        // jika pas pembayarannya
        else if($wajib_bayar === $terbayar) {
            $this->update_ket($faktur_id, 's_transfer', 'd_lunas', TRUE);
        }
        else {
            $this->update_ket($faktur_id, 's_transfer', 'belum_transfer', TRUE);
        }
    }

    /**
	 * keterangan
	 *
	 */
    public function get_ket($faktur_id, $ket) {
        $this->db->select("MAX(CASE WHEN (ket.key = '".$ket."') THEN ket.val ELSE 0 END) AS " .$ket);
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
