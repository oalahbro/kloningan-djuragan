<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
	private $tabel;

	public function __construct() {
		parent::__construct();
		$this->tabel = 'pengguna';
	}

	/**
	 * Ambil semua pengguna dalam database
	 *
	 * @return      array
	 */
	public function _semua($aktif = FALSE, $blokir = FALSE, $limit = FALSE, $offset = FALSE) {
		$this->db->select('p.*');
		$this->db->from('pengguna p');		
		if($aktif !== FALSE && in_array($aktif, array('ya', 'tidak'))) {
			$this->db->where('p.aktif',$aktif);
		}

		if($blokir !== FALSE && in_array($blokir, array('ya', 'tidak'))) {
			$this->db->where('p.blokir',$blokir);
		}

		// kecuali superadmin 
		$this->db->where_not_in('p.level', array('superadmin'));

		if ($limit !== FALSE && $offset !== FALSE) {
			$this->db->limit($limit);
			$this->db->offset($offset);
		}

		$this->db->order_by('blokir desc, valid desc, aktif asc, login_terakhir asc');

		$q = $this->db->get();
		return $q;
	}

	public function get_admin() {
		$this->db->where(array('aktif' => 'ya', 'blokir' => 'tidak', 'valid' => 'ya'));
		$this->db->where_in('level', array('admin', 'superadmin'));
		$q = $this->db->get('pengguna');

		return $q;
	}

	public function get_juragan($pengguna_id) {
		$q = $this->db->get_where('pengguna_relation', array('pengguna_id' => $pengguna_id));

		return $q;
	}

	public function insert_juragan($data_batch) {
		$this->db->insert_batch('pengguna_relation', $data_batch);
		return TRUE;
	}

	public function delete_juragan($pengguna_id) {
		$this->db->where('pengguna_id', $pengguna_id)
				 ->delete('pengguna_relation');
		return TRUE;
	}

	public function cek_baru() {
		$this->db->where(array('aktif' => 'tidak', 'blokir' => 'tidak', 'valid' => 'ya'));
		$q = $this->db->get($this->tabel);

		return $q->num_rows();
	}

	public function cek_by_username($username) {
		$q = $this->db->having('username', $username)->get($this->tabel);

		if($q->num_rows() > 0 ) {
			return TRUE;
		}
	}

	public function check_email($email) {
		$q = $this->db->having('email', $email)->get($this->tabel);

		if($q->num_rows() > 0 ) {
			return TRUE;
		}
	}

	public function _id($username) {
		$q = $this->db->where('username', $username)->get($this->tabel);

		$r = $q->row();
		if($q->num_rows() > 0) {
			return $r->id;
		}
	}

	public function _id_by_mail($email) {
		$q = $this->db->where('email', $email)->get($this->tabel);

		$r = $q->row();
		if($q->num_rows() > 0) {
			return $r->id;
		}
	}

	public function _detail($id_pengguna) {
		return $this->db->where('id', $id_pengguna)->get($this->tabel);
	}

	public function _nama_pengguna($id_pengguna) {
		$q =  $this->_detail($id_pengguna);

		$r = $q->row();
		if($q->num_rows() > 0) {
			return $r->nama;
		}
	}

	public function _juragan_terakhir($username) {
		$id_pengguna = $this->_id($username);

		$this->db->where('pengguna_id', $id_pengguna);
		$q = $this->db->get('pengguna_relation');

		foreach ($q->result() as $key) {
			$jur[] = $key->juragan_id;
		}

		$this->db->where('juragan_id', $jur[0]);

		for ($i=1; $i < count($jur) ; $i++) { 
			$this->db->or_where('juragan_id', $jur[$i]);
		}
		$this->db->order_by('id_faktur', 'desc');
		$this->db->limit(1);
		$gp = $this->db->get('faktur');

		$t = $gp->row();
		
		return ($gp->num_rows() > 0 ? $t->juragan_id : $jur[0]);
	}

	public function _cs_juragan($id_juragan) {
		
		$this->db->from('pengguna_relation r');
		$this->db->join('pengguna p', 'p.id=r.pengguna_id');
		$this->db->where(array('aktif' => 'ya', 'blokir' => 'tidak', 'valid' => 'ya'));
		$this->db->where_in('r.juragan_id', array($id_juragan));
		$q = $this->db->get();

		return $q;
	}

	public function _juragan_cs($username) {
		$id_pengguna = $this->_id($username);

		$this->db->where('pengguna_id', $id_pengguna);
		$q = $this->db->get('pengguna_relation');

		foreach ($q->result() as $key) {
			$jur[] = $key->juragan_id;
		}

		$t = $this->db->where_in('id', $jur)
					->order_by('nama', 'asc')
					->get('juragan');

		return $t;
	}

	public function juragan($username, $juragan) {
		$id_pengguna = $this->_id($username);
		$this->db->where('pengguna_id', $id_pengguna);
		$q = $this->db->get('pengguna_relation');

		foreach ($q->result() as $key) {
			$jur[] = $key->juragan_id;
		}

		$jid = $this->juragan->_id($juragan);

		if(in_array($jid, $jur)) {
			return TRUE;
		}
	}
	public function simpan($data) {
		$this->db->insert($this->tabel, $data); 

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
	}

	public function update($username, $data) {
		$this->db->where('username', $username);
		$this->db->update($this->tabel, $data); 

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
	}

	/**
	 * Masuk sistem, simpan ke session
	 *
	 * @param       string  $username    Input string
	 * @param       string  $sandi    Input string
	 * @return      array
	 */
	public function masuk($username, $sandi) {
		$q = $this->db->where('username', $username)->get($this->tabel);

		if($q->num_rows() > 0) {
			// jika pengguna ada
			$ru = $q->row();
			$valid = password_verify($sandi, $ru->sandi);

			if($valid) {
				// jika sandi benar
				$data['nama'] = $ru->nama;
				$data['username'] = $ru->username;
				$data['userid'] = $ru->id;
				$data['level'] = $ru->level;
				$data['email'] = $ru->email;

				if($ru->valid === 'ya') {
					if($ru->aktif === 'ya' && $ru->blokir === 'tidak') {
						// jika aktif dan tidak diblokir
						$data['logged'] = TRUE;
						$data['error'] = 0;
						$this->session->set_flashdata('notifikasi', '<div class="alert alert-success">Halo selamat datang kembali '.$ru->nama.'</div>');
					}
					elseif ($ru->aktif === 'tidak' && $ru->blokir === 'tidak') {
						$data['error'] = 1; //'Akun belum diaktifkan, silakan hubungi admin';
						$this->session->set_flashdata('notifikasi', '<div class="alert alert-warning">Silakan hubungi Admin</div>');
					}
					else {
						// jika aktif dan diblokir
						$data['logged'] = FALSE;
						$data['error'] = 2; //'Kamu tidak diijinkan masuk!';
						$this->session->set_flashdata('notifikasi', '<div class="alert alert-danger">Dilarang Masuk!</div>');
					}
				}
				else {
					// belum validasi email
					$data['logged'] = FALSE;
					$data['error'] = 5; // harap validasi email
					$this->session->set_flashdata('notifikasi', '<div class="alert alert-info">Harap cek email terlebih dahulu.</div>');
				}
			}
			else {
				// jika sandi salah
				$data['logged'] = FALSE;
				$data['error'] = 3; // 'Sandi salah.';
				$this->session->set_flashdata('notifikasi', '<div class="alert alert-warning">Sandi salah bos.</div>');
			}
		}
		else {
			$data['logged'] = FALSE;
			$data['error'] = 4; // 'Tidak terdaftar';
			$this->session->set_flashdata('notifikasi', '<div class="alert alert-info">Kamu siapa? daftar aja dulu.</div>');
		}

		return $data;
	}
}
