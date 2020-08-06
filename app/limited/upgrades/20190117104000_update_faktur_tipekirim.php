<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_faktur_tipekirim extends CI_Migration {

    public function up() {
        $fields = array(
            'status_kiriman' => array(
                'type' => 'ENUM("1","2")',
                'default' => NULL,
                'null' => TRUE,
                'after' => 'status_kirim'
            )
        );
        $this->dbforge->add_column('faktur', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}