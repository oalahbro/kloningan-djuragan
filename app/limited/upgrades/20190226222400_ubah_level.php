<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Ubah_level extends CI_Migration {

    public function up() {
        // 
        $fields = array(
            'level' => array(
                'name' => 'level',
                'type' => 'ENUM("superadmin","admin","cs","reseller","viewer")',
                'default' => 'cs',
                'null' => false
            ),
        );
        $this->dbforge->modify_column('pengguna', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}