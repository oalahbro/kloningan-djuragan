<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_kurir_length extends CI_Migration {

    public function up() {
        $fields = array(
            'kurir' => array(
                    'name' => 'kurir',
                    'type' => 'VARCHAR',
                    'constraint' => 25,
                    'null' => false
                ),
        );
        $this->dbforge->modify_column('pengiriman', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}