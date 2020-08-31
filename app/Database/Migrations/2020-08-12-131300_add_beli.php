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
			'invoice_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'stok_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'null'			 => TRUE,
				'default' 		 => NULL
			],
			'kode' => [
				'type'           => 'VARCHAR',
				'constraint' 	 => 8,
			],
			'ukuran' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 6,
				'null' 			 => true
			],
			'qty' => [
				'type' 			 => 'INT',
				'constraint' 	 => 3,
				'unsigned' 		 => TRUE
			],
			'harga' => [
				'type'           => 'INT',
				'constraint'     => 7,
				'unsigned' 		 => TRUE
			]
		]);
		
		$this->forge->addKey('id_beli', TRUE);
		$this->forge->createTable('dibeli', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('dibeli');
	}
}
