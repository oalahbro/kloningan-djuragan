<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Ubah_type_notif extends CI_Migration {

    public function up() {
        // 
        $fields = array(
            'type' => array(
                'name' => 'type',
                'type' => 'INT', // 1: tambah pesanan, 2: tambah biaya, 3: paket, 4: kirim, 5: transfer cek
                'constraint' => 3,
                'unsigned' => TRUE,
                'NULL' => FALSE,
                'default' => '1'
            )
        );
        $this->dbforge->modify_column('notifikasi', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}