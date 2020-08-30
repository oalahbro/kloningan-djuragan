<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_group_user extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_grup' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'url' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                )
            )
        );
        $this->dbforge->add_key('id_grup', TRUE);
        $this->dbforge->create_table('grup');
    }

    public function down() {
        // CAN'T BACK
    }
}