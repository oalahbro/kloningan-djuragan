<?php namespace App\Database\Migrations;

class AddOngkir extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_ongkir'  => [
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
			'ongkir' => [
				'type' => 'INT',
				'constraint' => 7,
				'unsigned' => TRUE
			]
		]);

		$this->forge->addKey('id_ongkir', TRUE);
		$this->forge->createTable('ongkir', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('ongkir');
	}
}
