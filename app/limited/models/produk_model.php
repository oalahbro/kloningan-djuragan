<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_model extends CI_Model
{
	function get_kategori()
	{
		$query = $this->db->get('produk_kategori');

		return $query;
	}

	function get_produk($kategori_id)
	{
		$this->db->select('p.*, k.nama as kategori');
		$this->db->from('produk_daftar p');
		$this->db->join('produk_kategori k', 'k.id = p.kategori_id');
		$this->db->order_by('p.kategori_id asc, p.kode asc, p.nama asc');
		if($kategori_id > 0)
		{
			$this->db->having('p.kategori_id', $kategori_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function add_kategori($nama_kategori)
	{
		$this->db->insert('produk_kategori', array('nama' => $nama_kategori));

		return TRUE;
	}
	function hapus_kategori($id)
	{
		$this->db->delete('produk_kategori', array('id' => $id));
		$this->db->delete('produk_daftar', array('kategori_id' => $id));

		return TRUE;
	}
	//
	function add_produk($data)
	{
		$this->db->insert('produk_daftar', $data);

		return TRUE;
	}

	function hapus_produk($produk_id)
	{
		$this->db->delete('produk_daftar', array('id' => $produk_id));
		return TRUE;
	}

	//
	function get_detail_produk($id)
	{
		$query = $this->db->get_where('produk_daftar', array('id' => $id));

		return $query;
	}

	// 
	function save_produk($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('produk_daftar', $data);

		return TRUE;
	}

	function dropdown_produk($name, $result_array)
	{
		$options = array();
		foreach ($result_array as $key => $value){
			$options[$value['kode']] = $value['nama'];
		}
		return form_multiselect($name, $options,'', 'class="form-control"');
	}

	/**
	 * get_size()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	function get_size()
	{	
		$this->db->order_by('id', 'asc');
		$size = $this->db->get('size');
		return $size;
	}

	/**
	 * add_size()
	 *
	 * by mylastof@gmail.com 
	 * --- checked 25/12/2014 ---
	 */
	function add_size($data)
	{
		$this->db->insert('size', $data);
		return TRUE;
	}

	function hapus_size($size)
	{
		$this->db->where('size', $size);
		$this->db->delete('size');
		return TRUE;
	}

	function get_dropdown_array($key, $value, $from)
	{
		$result = array();
		$array_keys_values = $this->db->query('select '.$key.', '.$value.' from '.$from.' order by '.$key.' asc');
		foreach ($array_keys_values->result() as $row)
		{
			$result[''] = '';
			$result[$row->$key] = $row->$key . ' (' .$row->$value . ')';
		}
		return $result;
    }


}