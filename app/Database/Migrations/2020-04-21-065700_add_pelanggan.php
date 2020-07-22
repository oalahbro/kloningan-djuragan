<?php namespace App\Database\Migrations;

class AddPelanggan extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_pelanggan'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'juragan_id' => [
				'type'           => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'nama_pelanggan' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 60,
			],
			'hp' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 50,
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'kecamatan' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned' 		 => TRUE,
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'alamat' => [
				'type'           => 'TEXT',
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'kodepos' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'null' 			 => true,
				'unsigned' 		 => TRUE
			],
			'created_at' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE
			],
			'updated_at' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE
			],
		]);
		
		$this->forge->addKey('id_pelanggan', TRUE);
		$this->forge->createTable('pelanggan', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('pelanggan');
	}
}
