<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juragan_model extends CI_Model
{
	function add($nama, $username, $password)
	{
		$unik = random_string('alnum', 4);
		$password_n = hash('sha256', $unik . hash('sha256', $password) );


		$data = array(
		   'nama' => $nama ,
		   'username' => $username ,
		   'unik' => $unik,
		   'katasandi' => $password_n,
		   'level' => 'user'
		);

		$submit_user = $this->db->insert('user', $data);

		if($submit_user) 
		{
			$get_id = $this->db->get_where('user', array('username' => $username));

			$row = $get_id->row();

			$data2 = array(
				'user_id' => $row->id,
				'transfer' => '0',
				'kirim' => '0',
				'total' => '0'
			);
			$this->db->insert('count_order', $data2);

			return TRUE;
		}
	}

	function get_all(){
		$q = $this->db->order_by('username', 'asc')->get_where('user', array('level' => 'user'));


		return $q->result_array();
	}

	function add_admin($nama, $username, $password)
	{
		$unik = random_string('alnum', 4);
		$password_n = hash('sha256', $unik . hash('sha256', $password) );

		$data = array(
		   'nama' => $nama ,
		   'username' => $username ,
		   'unik' => $unik,
		   'katasandi' => $password_n,
		   'level' => 'admin'
		);

		$submit_user = $this->db->insert('user', $data);
		return TRUE;
	}

	public function update($id, $nama, $password)
	{
		

		if( ! empty($password))
		{
			$unik = random_string('alnum', 4);
			$katasandi = hash('sha256', $unik . hash('sha256', $password) );

			$data = array('nama' => $nama, 'katasandi' => $katasandi, 'unik' => $unik);
		}
		else
		{
			$data = array('nama' => $nama);
		}

		$this->db->where('id', $id);
		$this->db->update('user', $data);
		return TRUE;
	}

	public function delete($id)
	{
		$this->db->where('id', $id)->delete('user');
		$tables = array('order', 'count_order');
		$this->db->where('user_id', $id);
		$this->db->delete($tables);

		return TRUE;
	}

	//
	public function get_nama_juragan_by_id($juragan)
	{
		$this->db->select('nama');
		$query = $this->db->get_where('user', array('id' => $juragan));

		$row = $query->row();

		return $row->nama;
	}

	//
	function get_user_id_by_pesanan_id($id)
	{
		$this->db->select('user_id');
		$query =$this->db->get_where('order', array('id' => $id));

		$row = $query->row();

		return $row->user_id;
	}

	public function get_detail_juragan($id)
	{
		$query = $this->db->get_where('user', array('id' => $id));
		return $query;
	}

	function dropdown_juragan()
	{
		$this->db->select('c.*, u.nama as juragan, u.username, u.last_login');
		$this->db->from('count_order c');
		$this->db->join('user u', 'u.id = c.user_id');
		$this->db->order_by('u.nama', 'asc');

		$query = $this->db->get();

		return $query;
	}

	function get_admin()
	{
		$q = $this->db->get_where('user', array('level' => 'admin'));
		return $q;
	}


}