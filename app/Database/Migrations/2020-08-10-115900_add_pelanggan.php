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
			'nama_pelanggan' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 60,
			],
			'hp' => [
				'type' 			 => 'VARCHAR', // ["0812345789","0812345789"]
				'constraint' 	 => 50,
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'cod' => [
				'type' 			 => 'ENUM',
				'constraint' 	 => ["0","1"],
				'default' 		 => "0"
			],
			'kecamatan' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned' 		 => TRUE,
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'kabupaten' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned' 		 => TRUE,
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'provinsi' => [
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
			'deleted_at' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE,
				'null' 			 => TRUE,
				'default' 		 => NULL
			]
		]);
		
		$this->forge->addKey('id_pelanggan', TRUE);
		$this->forge->createTable('pelanggan', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('pelanggan');
	}
}
