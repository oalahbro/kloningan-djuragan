<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_status_faktur extends CI_Migration {

    public function up() {
        $fields = array(
            'tanggal_kirim' => array('type' => 'INT', 'constraint' => 10, 'unsigned' => TRUE, 'default' => '0', 'null' => FALSE, 'after' => 'tanggal_dibuat'),
            'tanggal_paket' => array('type' => 'INT', 'constraint' => 10, 'unsigned' => TRUE, 'default' => '0', 'null' => FALSE, 'after' => 'tanggal_dibuat'),
            'tanggal_transfer' => array('type' => 'INT', 'constraint' => 10, 'unsigned' => TRUE, 'default' => '0', 'null' => FALSE, 'after' => 'tanggal_dibuat'),

            'status_transfer' => array('type' => 'ENUM("0","1","2","3","4")', 'default' => '0', 'null' => FALSE, 'comments' => '0:belum, 1:menunggu, 2:sebagian, 3:lunas, 4:lebih'),
            'status_paket' => array('type' => 'ENUM("0","1","2")', 'default' => '0', 'null' => FALSE, 'comments' => '0:belum proses, 1:diproses, 2: dibatalkan'),
            'status_kirim' => array('type' => 'ENUM("0","1","2","3")', 'default' => '0', 'null' => FALSE, 'comments' => '0:belum kirim, 1: sebagian, 2: diambil, 3:dikirim')
        );

        $this->dbforge->add_column('faktur', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}