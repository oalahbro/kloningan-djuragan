<?php namespace App\Database\Migrations;

class AddPengiriman extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_krm'  => [
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
			'kurir' => [
				'type' 			 => 'VARCHAR',
				'constraint'     => 10,
			],
			'ongkir_krm' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE
			],
			'resi' => [
				'type' 			 => 'VARCHAR',
				'constraint'     => 15,
			],
			'qty_krm' => [
				'type' 			 => 'INT',
				'constraint' 	 => 3,
				'unsigned' 		 => TRUE
			],
			'tanggal_krm' => [
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned' 		 => TRUE
			]
		]);
		
		$this->forge->addKey('id_krm', TRUE);
		$this->forge->createTable('pengiriman', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('pengiriman');
	}
}
