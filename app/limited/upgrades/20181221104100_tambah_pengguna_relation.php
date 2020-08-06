<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_pengguna_relation extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_relation' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'pengguna_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ),
                'juragan_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
            )
        );
        $this->dbforge->add_key('id_relation', TRUE);
        $this->dbforge->create_table('pengguna_relation');
    }

    public function down() {
        // CAN'T BACK
    }
}