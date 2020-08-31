<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_pembayaran extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_pembayaran' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'tanggal_bayar' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 11,
                ),
                'faktur_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ),
                'jumlah' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ),
                'rekening' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'tanggal_cek' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 11,
                    'null' => TRUE
                ),
            )
        );
        $this->dbforge->add_key('id_pembayaran', TRUE);
        $this->dbforge->create_table('pembayaran');
    }

    public function down() {
        // CAN'T BACK
    }
}