<?php namespace App\Database\Migrations;

class AddPelanggan extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_plgn'  => [
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
			'nama_plgn' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '60',
			],
			'COD' => [
				'type' 			 => 'ENUM',
				'constraint'     => ['0', '1'], // tidak ada, ada
				'default' 		 => '0'
			],
			'alamat' => [
				'type'           => 'TEXT',
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'hp' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '50',
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
			'kabupaten_kota' => [
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
			'kodepos' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'null' 			 => true,
				'unsigned' 		 => TRUE
			],
			'plgn_dibuat' => [
				'type'           => 'INT',
				'constraint' 	 => '10',
				'unsigned' 		 => TRUE
			],
			'plgn_diubah' => [
				'type'           => 'INT',
				'constraint' 	 => '10',
				'unsigned' 		 => TRUE
			],
		]);
		$this->forge->addKey('id_plgn', TRUE);
		$this->forge->createTable('pelanggan');
	}

	public function down()
	{
		$this->forge->dropTable('pelanggan');
	}
}
