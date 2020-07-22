<?php namespace App\Database\Migrations;

class AddUserRelasi extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_relasi'  => [
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
		
		$this->forge->addKey('id_relasi', TRUE);
		$this->forge->createTable('user_relasi', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('user_relasi');
	}
}
