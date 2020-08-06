<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Hapus_tabel_session extends CI_Migration {

    public function up() {
        $this->dbforge->drop_table('ci_sessions',TRUE);
        $this->dbforge->drop_table('juragan_limited',TRUE);
    }

    public function down() {
        // CAN'T BACK
    }
}