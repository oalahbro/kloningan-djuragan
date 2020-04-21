<?php namespace App\Database\Migrations;

class AddBeli extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_beli'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'faktur_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'stok_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'null'			 => TRUE
			],
			'kode_beli' => [
				'type'           => 'VARCHAR',
				'constraint' 	 => 8,
			],
			'size_beli' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 6,
				'null' 			 => true
			],
			'qty_beli' => [
				'type' 			 => 'INT',
				'constraint' 	 => 3,
				'unsigned' 		 => TRUE
			],
			'harga_beli' => [
				'type'           => 'INT',
				'constraint'     => 7,
				'unsigned' 		 => TRUE
			]
		]);
		$this->forge->addKey('id_beli', TRUE);
		$this->forge->createTable('dibeli');
	}

	public function down()
	{
		$this->forge->dropTable('dibeli');
	}
}
