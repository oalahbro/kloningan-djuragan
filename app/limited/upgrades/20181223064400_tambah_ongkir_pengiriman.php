<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_ongkir_pengiriman extends CI_Migration {

    public function up() {
        $fields = array(
            'ongkir' => array('type' => 'INT', 'constraint' => 9, 'default' => "0", 'null' => false)
        );
        $this->dbforge->add_column('pengiriman', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}