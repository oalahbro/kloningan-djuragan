<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_constraint_faktur extends CI_Migration {

    public function up() {
        $fields = array(
            'seri_faktur' => array(
                    'name' => 'seri_faktur',
                    'type' => 'VARCHAR',
                    'constraint' => 15,
                    'null' => false
                ),
        );
        $this->dbforge->modify_column('faktur', $fields);
    }

    public function down() {
        // CAN'T BACK
    }
}