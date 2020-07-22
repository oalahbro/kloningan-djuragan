<?php namespace App\Database\Migrations;

class AddPengiriman extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_pengiriman'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'invoice_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE
			],
			'kurir_id' => [
				'type' 			 => 'INT',
				'constraint'     => 5,
				'unsigned' 		 => TRUE
			],
			'ongkir_kirim' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE
			],
			'resi' => [
				'type' 			 => 'VARCHAR',
				'constraint'     => 20,
			],
			'qty_kirim' => [
				'type' 			 => 'INT',
				'constraint' 	 => 3,
				'unsigned' 		 => TRUE
			],
			'tanggal_kirim' => [
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned' 		 => TRUE
			]
		]);
		
		$this->forge->addKey('id_pengiriman', TRUE);
		$this->forge->createTable('pengiriman', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('pengiriman');
	}
}
