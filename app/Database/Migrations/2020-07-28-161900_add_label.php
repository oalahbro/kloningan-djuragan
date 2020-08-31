<?php namespace App\Database\Migrations;

class AddLabel extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_label'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'invoice_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'source_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
			],
			'label' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 50,
				'null' 			 => TRUE,
				'default' 		 => NULL,
			]
		]);
		
		$this->forge->addKey('id_label', TRUE);
		$this->forge->createTable('label_invoice', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('label_invoice');
	}
}
