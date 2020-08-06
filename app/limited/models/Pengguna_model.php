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
	public function _semua($aktif = FALSE, $blokir = FALSE) {
		if($aktif !== FALSE && in_array($aktif, array('ya', 'tidak'))) {
			$this->db->where('aktif',$aktif);
		}

		if($blokir !== FALSE && in_array($blokir, array('ya', 'tidak'))) {
			$this->db->where('blokir',$blokir);
		}

		// kecuali superadmin 
		$this->db->where_not_in('level', array('superadmin'));

		$q = $this->db->get($this->tabel);
		return $q;
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
		$q =  $this->_detail($id_pengguna);

		$r = $q->row();

		$jur = (array) json_decode($r->juragan);

		$this->db->where('juragan', $jur[0]);

		for ($i=1; $i < count($jur) ; $i++) { 
			$this->db->or_where('juragan', $jur[$i]);
		}
		$this->db->order_by('id_pesanan', 'desc');
		$this->db->limit(1);
		$gp = $this->db->get('pesanan');

		$t = $gp->row();

		return $t->juragan;
	}

	public function _juragan_cs($username) {
		$id_pengguna = $this->_id($username);
		$q =  $this->_detail($id_pengguna);

		$r = $q->row();
		$jur = (array) json_decode($r->juragan);


		$t = $this->db->where_in('id', $jur)
					->order_by('nama', 'asc')
					->get('juragan');

		return $t;
	}

	public function juragan($username, $juragan) {
		$id_pengguna = $this->_id($username);
		$q =  $this->_detail($id_pengguna);

		$r = $q->row();

		$jur = (array) json_decode($r->juragan);
		$jid = $this->juragan->_id($juragan);

		if(in_array($jid, $jur)) {
			return TRUE;
		}
	}

	/**
	 * Simpan data pengguna ke database
	 *
	 * @param       array  $data    Input array
	 * @return      bool
	 */
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

	public function _juragan($username)
	{
		# code...
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
				$data['level'] = $ru->level;
				$data['email'] = $ru->email;

				if($ru->valid === 'ya') {
					if($ru->aktif === 'ya' && $ru->blokir === 'tidak') {
						// jika aktif dan tidak diblokir
						$data['logged'] = TRUE;
						$data['error'] = 0;
					}
					elseif ($ru->aktif === 'tidak' && $ru->blokir === 'tidak') {
						$data['error'] = 1; //'Akun belum diaktifkan, silakan hubungi admin';
					}
					else {
						// jika aktif dan diblokir
						$data['logged'] = FALSE;
						$data['error'] = 2; //'Kamu tidak diijinkan masuk!';
					}
				}
				else {
					// belum validasi email
					$data['logged'] = FALSE;
					$data['error'] = 5; // harap validasi email
				}
			}
			else {
				// jika sandi salah
				$data['logged'] = FALSE;
				$data['error'] = 3; // 'Sandi salah.';
			}
		}
		else {
			$data['logged'] = FALSE;
			$data['error'] = 4; // 'Tidak terdaftar';
		}

		return $data;
	}
}
