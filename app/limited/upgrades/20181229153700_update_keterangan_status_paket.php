<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_keterangan_status_paket extends CI_Migration {

    public function up() {
        $q = $this->db->get_where('keterangan', array('key' => 's_paket', 'val' => 'belum'));

		$r = array();
		$w = array();
		foreach ($q->result() as $key) {
            $this->db->where('id_keterangan', $key->id_keterangan);
			$this->db->update('keterangan', array('val' => 'belum_diproses'));
        }
    }

    public function down() {
        // CAN'T BACK
    }
}