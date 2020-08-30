<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_faktur_tipe extends CI_Migration {

    public function up() {
        $fields = array(
            'tipe' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => NULL,
                'null' => TRUE,
                'after' => 'tanggal_kirim'
            )
        );
        $this->dbforge->add_column('faktur', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}