<?php namespace App\Database\Migrations;

class AddJuragan extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_juragan'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'juragan' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '60',
			],
			'nama_juragan' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '60',
			],
			'created_at' => [
				'type'           => 'INT',
				'constraint' 	 => '10',
				'unsigned' 		 => TRUE
			],
			'updated_at' => [
				'type'           => 'INT',
				'constraint' 	 => '10',
				'unsigned' 		 => TRUE
			],
		]);
		$this->forge->addKey('id_juragan', TRUE);
		$this->forge->createTable('juragan', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('juragan');
	}
}
