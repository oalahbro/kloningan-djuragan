<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_status_edit_faktur extends CI_Migration {

    public function up() {
        /*
        $q = $this->db->get_where('keterangan', array('val' => 'diproses'));

		$r = array();
		$w = array();
		foreach ($q->result() as $key) {
            $this->db->where('id_faktur', $key->faktur_id);
            $this->db->update('faktur', array('status_paket' => '1'));
            
            $this->db->delete('keterangan', array('faktur_id' => $key->faktur_id));
        }
        */

        $fields = array(
            'status_edit' => array('type' => 'VARCHAR', 'constraint' => 10, 'default' => 'no', 'null' => FALSE),
        );

        $this->dbforge->add_column('faktur', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}