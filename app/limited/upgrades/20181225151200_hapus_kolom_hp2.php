<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Hapus_kolom_hp2 extends CI_Migration {

    public function up() {
        $this->dbforge->drop_column('faktur', 'hp2');
    }

    public function down() {
        // CAN'T BACK
    }
}