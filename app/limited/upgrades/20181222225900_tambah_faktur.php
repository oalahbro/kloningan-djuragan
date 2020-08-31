<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_faktur extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_faktur' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'seri_faktur' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 13, // IN20181220001
                ),
                'tanggal_dibuat' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 11,
                ),
                'juragan_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'pengguna_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'hp1' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 15,
                ),
                'hp2' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 15,
                    'null' => TRUE
                ),
                'alamat' => array(
                    'type' => 'TEXT',
                )
            )
        );
        $this->dbforge->add_key('id_faktur', TRUE);
        $this->dbforge->create_table('faktur');
    }

    public function down() {
        // CAN'T BACK
    }
}