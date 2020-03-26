<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Hapus_tabel_pesanan extends CI_Migration {

    public function up() {
        $this->dbforge->drop_table('pesanan',TRUE);
    }

    public function down() {
        // CAN'T BACK
    }
}