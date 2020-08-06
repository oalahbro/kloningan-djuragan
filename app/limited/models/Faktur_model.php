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
        
        if ($juragan_id !== FALSE) {
            $this->db->having('juragan_id', $juragan_id);
        }

        if($limit !== FALSE && $offset !== FALSE) {
            $this->db->limit($limit);
            $this->db->offset($offset);
        }

        $this->db->order_by('fak.tanggal_dibuat DESC, status_paket DESC, status_kirim ASC, status_transfer ASC');

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

    public function get_count_this_month($juragan_id) {
        $this->db->where('juragan_id', $juragan_id);
        $this->db->like("DATE(CONVERT_TZ(FROM_UNIXTIME(tanggal_dibuat, '%Y-%m-%d %H:%i:%s'), '+00:00', '+00:00'))",  date('Y-m', now()), 'both');
        $this->db->order_by('id_faktur DESC');
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
            $this->update_ket($faktur_id, 's_transfer', '', FALSE);
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

    public function sub_carry($data) {
        return $this->db->insert('pengiriman', $data);
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
            $this->update_ket($faktur_id, 's_kirim', '', FALSE);
        }
    }

    /**
	 * Atur status paket
	 *
	 */
    public function set_package($faktur_id, $status) {
        if($status === 'diproses') {
            $cek_status_paket = $this->db->where(array('faktur_id' => $faktur_id, 'key' => 's_paket'))->get('keterangan');

            if($cek_status_paket->num_rows() > 0) {
                $this->db->where(array('faktur_id' => $faktur_id, 'key' => 's_paket'));
                $this->db->update('keterangan', array('val' => 'diproses'));
            }
            else {
                $this->db->insert('keterangan', array('faktur_id' => $faktur_id, 'key' => 's_paket', 'val' => 'diproses' ));
            }
        }
        else {
            $this->db->where(array('faktur_id' => $faktur_id, 'key' => 's_paket'))->delete('keterangan');
            $this->db->where(array('faktur_id' => $faktur_id, 'key' => 's_kirim'))->delete('keterangan');
            $this->del_carry($faktur_id);
            $this->calc_carry($faktur_id);
        }
        return TRUE;
    }

    

    
	
}
