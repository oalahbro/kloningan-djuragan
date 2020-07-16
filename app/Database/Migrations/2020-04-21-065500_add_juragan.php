<?php namespace App\Database\Migrations;

class AddJuragan extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_jrgn'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'juragan' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '60',
			],
			'nama_jrgn' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '60',
			],
			'jrgn_dibuat' => [
				'type'           => 'INT',
				'constraint' 	 => '10',
				'unsigned' 		 => TRUE
			],
			'jrgn_diubah' => [
				'type'           => 'INT',
				'constraint' 	 => '10',
				'unsigned' 		 => TRUE
			],
		]);
		$this->forge->addKey('id_jrgn', TRUE);
		$this->forge->createTable('juragan', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('juragan');
	}
}
