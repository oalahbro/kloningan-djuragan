<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_faktur extends CI_Migration {

    public function up() {
        $fields = array(
            'hp2' => array(
                'type' => 'VARCHAR',
                'constraint' => 15,
                'default' => NULL,
                'null' => TRUE,
                'after' => 'hp1'
            ),
            'gambar' => array(
                'type' => 'TEXT',
                'default' => NULL,
                'null' => TRUE,
            ),
            'keterangan' => array(
                'type' => 'TEXT',
                'default' => NULL,
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column('faktur', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}