<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_keterangan extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_keterangan' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'faktur_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ),
                'key' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 10,
                ), 
                'val' => array(
                    'type' => 'TEXT',
                ),
            )
        );
        $this->dbforge->add_key('id_keterangan', TRUE);
        $this->dbforge->create_table('keterangan');
    }

    public function down() {
        // CAN'T BACK
    }
}