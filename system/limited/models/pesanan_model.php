<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pesanan_model extends CI_Model
{
	/**
	 * get_all()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function get_all($halaman, $offset = false, $limit = false, $cari = false, $juragan = false)
	{
		$this->db->select('o.*, u.nama as juragan, m.nama_member, m.hp as hp_member');
		$this->db->from('order o');
		$this->db->join('user u', 'u.id = o.user_id');
		$this->db->join('membership m', 'm.id = o.member_id', 'left');

		if($halaman === 'terkirim')
		{
			$this->db->order_by('o.status_transfer desc, o.barang desc, o.cek_kirim desc, o.cek_transfer desc, o.tanggal_order desc');
			$this->db->having(array('o.barang' => 'terkirim'));
		}
		elseif($halaman === 'pending')
		{
			$this->db->having(array('o.barang' => 'pending'));
		}
		
		if( ! empty($juragan))
		{
			$this->db->having(array('o.user_id' => $juragan));
		}

		if( ! empty($cari))
		{
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

		$this->db->where(array('o.del' => NULL));

		if( ! empty($offset))
		{
			$this->db->offset($offset);
		}
		if( ! empty($limit))
		{
			$this->db->limit($limit);
		}

		if($halaman !== 'terkirim')
		{
			$this->db->order_by('o.status_transfer desc, o.barang desc, o.tanggal_order desc');
		}

		$query = $this->db->get();

		return $query;
	}

	/**
	 * get_all()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function get_export( $mulai = NULL, $akhir = NULL, $user = '0')
	{
		$this->db->select('o.*, u.nama as juragan');
		$this->db->from('order o');
		$this->db->join('user u', 'u.id = o.user_id');

		if($user !== '0')
		{
			$this->db->where('o.user_id', $user);
		}
	
		$this->db->having(array('o.barang' => 'terkirim'));

		if($mulai !== NULL && $akhir !== NULL )
		{
			$this->db->where('DATE(o.tanggal_order) >=', $mulai);
			$this->db->where('DATE(o.tanggal_order) <=', $akhir);
		}

		$this->db->where(array('o.del' => NULL));

		$this->db->order_by('juragan asc, o.cek_kirim asc');

		$query = $this->db->get();

		return $query;
	}

	/**
	 * boleh_edit()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function boleh_edit($id, $user_id, $baru = FALSE)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('order');

		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
			if($baru)
			{
				if(($row->data === 'baru') && ($row->cek_transfer === NULL) && ($row->user_id === $user_id))
				{
					return TRUE;
				}
			}
		}
	}

	/**
	 * count_order_kirim()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function count_order_kirim($id = false, $barang)
	{
		$array = array('Pending', 'Terkirim');
		if(in_array($barang, $array))
		{
			$this->db->where('barang', $barang);
			$this->db->where('del', NULL);
			if( ! empty($id))
			{
				$this->db->where('user_id', $id);
			}	
			$this->db->from('order');
			$count = $this->db->count_all_results();

			return $count;
		}
	}

	/**
	 * count_order_transfer()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function count_order_transfer($id = false, $transfer)
	{
		$array = array('Belum', 'Masuk');
		if(in_array($transfer, $array))
		{
			$this->db->where('status_transfer', $transfer);
			$this->db->where('del', NULL);
			if( ! empty($id))
			{
				$this->db->where('user_id', $id);
			}			
			$this->db->from('order');
			$count = $this->db->count_all_results();

			return $count;
		}
	}

	/**
	 * update_count()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function update_count($user_id)
	{
		$data_count = array(
			'transfer' => $this->count_order_transfer($user_id, 'Belum'),
			'kirim' => $this->count_order_kirim($user_id, 'Pending')
		);

		$this->db->where('user_id', $user_id);
		$this->db->update('count_order', $data_count);

		return TRUE;
	}

	/**
	 * set_to_transfer()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function set_to_transfer($id, $okremove, $user_id)
	{
		$tgl = mdate("%Y-%m-%d %H:%i:%s", now());

		if($okremove === 'ok')
		{
			$stat = 'Masuk';
			$tanggal = $tgl;
		}
		elseif($okremove === 'remove')
		{
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

	/**
	 * set_to_kirim()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function set_to_kirim($id, $okremove, $user_id)
	{
		if($okremove === 'remove')
		{
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

	/**
	 * submit_resi()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function submit_resi($id, $data, $user_id)
	{
		$tgl = mdate("%Y-%m-%d %H:%i:%s", now());

		$array_t = array('cek_kirim' => $tgl);
		$array_n = array_merge($data, $array_t);

		$this->db->where('id', $id);
		$ubah = $this->db->update('order', $array_n);

		if($ubah)
			$this->update_count($user_id);
			return TRUE;
	}

	/**
	 * add()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function add($user_id, $data)
	{
		$tgl = mdate("%Y-%m-%d %H:%i:%s", now());

		$data2 = array(
			'tanggal_order' => $tgl
		);
		$data_submit = array_merge($data2, $data);

		$this->db->insert('order', $data_submit);
		$this->update_count($user_id);
		return TRUE;
	}

	/**
	 * update_pesanan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function update_pesanan($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('order', $data);

		return TRUE;
	}

	/**
	 * hapus()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function hapus($id)
	{
		$user_id = $this->get_user_id_by_pesanan($id);
						
		$this->db->where('id', $id);
		$hapus = $this->db->delete('order');

		if($hapus)
		{
			$this->update_count($user_id);
			return TRUE;
		}
	}

	/**
	 * total_pesanan()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function total_pesanan($mulai, $akhir)
	{
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

	/**
	 * total_transfer()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function total_transfer($mulai, $akhir)
	{
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

	/**
	 * total_terkirim()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function total_terkirim($mulai, $akhir)
	{
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

	/**
	 * total_pending()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 23/12/2014 ---
	 */
	function total_pending()
	{
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

	function get_product()
	{
		$this->db->select('kode');
		$query = $this->db->get('produk_daftar');

		return $query->result_array();
	}

	function get_pesanan_id($id)
	{
		$query = $this->db->get_where('order', array('id' => $id));
		return $query;
	}

	function get_user_id_by_pesanan($id)
	{
		$this->db->select('user_id');
		$this->db->where('id', $id);
		$query = $this->db->get('order');

		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 

			return $row->user_id;
		}
	}

	
	

}