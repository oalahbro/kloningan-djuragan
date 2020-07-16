<?php namespace App\Database\Migrations;

class AddUserJuragan extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_reluser'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'juragan_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
			],
			'user_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
			]
		]);
		
		$this->forge->addKey('id_reluser', TRUE);
		$this->forge->createTable('usrjrgn', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('usrjrgn');
	}
}
