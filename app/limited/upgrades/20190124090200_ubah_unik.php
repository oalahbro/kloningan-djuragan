<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Ubah_unik extends CI_Migration {

    public function up() {
        // 
        $fields = array(
            'short' => array(
                'name' => 'short',
                'type' => 'VARCHAR',
                'constraint' => '2',
                'unique' => FALSE,
                'null' => FALSE
            ),
        );
        $this->dbforge->modify_column('juragan', $fields);
        $this->db->query('ALTER TABLE juragan
        DROP INDEX short');
    }

    public function down() {
        // CAN'T BACK
    }
}