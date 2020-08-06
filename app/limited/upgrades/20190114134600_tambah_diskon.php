<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_diskon extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_diskon' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'faktur_id' => array(
                    'type' => 'INT',
                    'constraint' => 11, // IN20181220001
                ),
                'nominal' => array(
                    'type' => 'INT',
                    'constraint' => 9,
                ),
            )
        );
        $this->dbforge->add_key('id_diskon', TRUE);
        $this->dbforge->create_table('biaya_diskon');
    }

    public function down() {
        // CAN'T BACK
    }
}