<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tambah_produk extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(
            array(
                'id_pesanproduk' => array(
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
                'kode' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 5,
                ), 
                'ukuran' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 5,
                ),               
                'jumlah' => array(
                    'type' => 'INT',
                    'constraint' => 3,
                    'unsigned' => TRUE,
                ),
                'harga' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                )
            )
        );
        $this->dbforge->add_key('id_pesanproduk', TRUE);
        $this->dbforge->create_table('pesanan_produk');
    }

    public function down() {
        // CAN'T BACK
    }
}