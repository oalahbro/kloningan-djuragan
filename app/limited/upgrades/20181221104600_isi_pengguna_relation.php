<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Isi_pengguna_relation extends CI_Migration {

    public function up() {
        $q = $this->db->get('pengguna');

		$r = array();
		$w = array();
		foreach ($q->result() as $key) {
			if($key->juragan !== NULL) {
                $w = json_decode($key->juragan);
                
                foreach ($w as $j) {
                    $r  = array(
                        'pengguna_id' => $key->id,
                        'juragan_id' => $j,
                    );
                    $this->db->insert('pengguna_relation', $r);
                }
			}
        }
    }

    public function down() {
        // CAN'T BACK
    }
}