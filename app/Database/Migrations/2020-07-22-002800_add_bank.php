<?php namespace App\Database\Migrations;

class AddBank extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_bank'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'nama_bank' => [
				'type' 			 => 'ENUM',
				'constraint' 	 => ["bca","bri","bni","mandiri"]
			],
			'rekening' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 50
			],
			'atas_nama' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 50
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
			'deleted_at' => [
				'type'           => 'INT',
				'constraint' 	 => '10',
				'unsigned' 		 => TRUE,
				'null' 			 => TRUE,
				'default' 		 => NULL
			]
		]);
		
		$this->forge->addKey('id_bank', TRUE);
		$this->forge->createTable('bank', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('bank');
	}
}
