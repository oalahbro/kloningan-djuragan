<?php namespace App\Database\Migrations;

class AddDiskon extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_disc'  => [
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
			'diskon' => [
				'type' => 'INT',
				'constraint' => 7,
				'unsigned' => TRUE
			]
		]);
		$this->forge->addKey('id_disc', TRUE);
		$this->forge->createTable('diskon', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('diskon');
	}
}
