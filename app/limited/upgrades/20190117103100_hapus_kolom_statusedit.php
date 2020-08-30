<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Hapus_kolom_statusedit extends CI_Migration {

    public function up() {
        // 
        $this->dbforge->drop_column('faktur', 'status_edit');
        //
        $this->dbforge->drop_table('keterangan',TRUE);
    }

    public function down() {
        // CAN'T BACK
    }
}