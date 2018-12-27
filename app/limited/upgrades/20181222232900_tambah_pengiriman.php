<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_pengiriman extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_pengiriman' => array(
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
                'kurir' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 15,
                ), 
                'resi' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 25
                ),
                'tanggal_kirim' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 11
                )
            )
        );
        $this->dbforge->add_key('id_pengiriman', TRUE);
        $this->dbforge->create_table('pengiriman');
    }

    public function down() {
        // CAN'T BACK
    }
}