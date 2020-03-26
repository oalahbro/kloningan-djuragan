<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_notifikasi extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_notifikasi' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'tanggal' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 11,
                ),
                'dari' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'kepada' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'type' => array(
                    'type' => 'ENUM("1","2","3","4","5")', // 1: tambah pesanan, 2: tambah biaya, 3: paket, 4: kirim, 5: transfer cek
                    'NULL' => FALSE,
                    'default' => '1'
                ),
                'juragan' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'null' => TRUE,
                    'default' => NULL,
                ),
                'url' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 20,
                ),
                'dibaca' => array(
                    'type' => 'ENUM("0","1")',
                    'NULL' => FALSE,
                    'default' => '0'
                ),
            )
        );
        $this->dbforge->add_key('id_notifikasi', TRUE);
        $this->dbforge->create_table('notifikasi');
    }

    public function down() {
        // CAN'T BACK
    }
}