<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Hapus_kolom_juragan extends CI_Migration {

    public function up() {
        // 
        $this->dbforge->drop_column('pengguna', 'juragan');
    }

    public function down() {
        // CAN'T BACK
    }
}