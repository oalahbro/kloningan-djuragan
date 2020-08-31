<?php namespace App\Database\Migrations;

class AddRelasi extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_relasi'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'table' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5, // 1: juragan-user, 2: juragan-bank
				'unsigned' 		 => TRUE,
			],
			'juragan_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
			],
			'val_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
			]
		]);
		
		$this->forge->addKey('id_relasi', TRUE);
		$this->forge->createTable('relasi', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('relasi');
	}
}
