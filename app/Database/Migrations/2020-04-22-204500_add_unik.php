<?php namespace App\Database\Migrations;

class AddUnik extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_unik'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'faktur_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'unik' => [
				'type' 			 => 'INT',
				'constraint' 	 => 3,
				'unsigned' 		 => TRUE
			]
		]);
		$this->forge->addKey('id_unik', TRUE);
		$this->forge->createTable('unik');
	}

	public function down()
	{
		$this->forge->dropTable('unik');
	}
}
