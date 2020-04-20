<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_model extends CI_Model
{
	private $tabel;

	public function __construct() {
		parent::__construct();
		$this->tabel = 'pengaturan';
	}

	/**
	 * Ambil semua pengaturan dalam database
	 *
	 * @return      array
	 */
	public function ambil_semua() {
		return $this->db->get($this->tabel);
	}

	/**
	 * Update data pengaturan
	 *
	 * @param       array  $data    Input array
	 * @return      bool
	 */
	public function update_config($data) {
		$success = true;
		foreach($data as $kunci => $gembok) {
			if( ! $this->save($kunci, $gembok)) {
				$success = false;
				break;  
			}
		}
		return $success;
	}

	/**
	 * Simpan data pengaturan ke database
	 *
	 * @param       string  $key    Input string
	 * @param       string  $gembok    Input string
	 * @return      string
	 */
	public function save($kunci, $gembok) {
		$data = array(
			'kunci' => $kunci,
			'gembok' => $gembok
			);
		$this->db->where('kunci', $kunci);
		return $this->db->update($this->tabel, $data); 
	}
}