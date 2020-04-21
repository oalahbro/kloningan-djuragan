<?php namespace App\Database\Migrations;

class AddPembayaran extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_byr'  => [
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
			'tipe_byr' => [
				'type' 			 => 'ENUM',
				'constraint'     => ['transfer', 'cash'],
			],
			'bank' => [
				'type'           => 'VARCHAR',
				'constraint'     => 5, // cod, bca, bri, bni, mandiri
			],
			'total_byr' => [
				'type' 			 => 'INT',
				'constraint' 	 => 7,
				'unsigned' 		 => TRUE
			],
			'status' => [
				'type' 			 => 'ENUM',
				'constraint'     => ['0', '1'], // tidak ada, ada
				'default' 		 => '0'
			],
			'tanggal_byr' => [
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned' 		 => TRUE
			],
			'tanggal_cek' => [
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned' 		 => TRUE,
				'null'  		 => TRUE,
				'default' 		 => NULL
			]

		]);
		$this->forge->addKey('id_byr', TRUE);
		$this->forge->createTable('pembayaran');
	}

	public function down()
	{
		$this->forge->dropTable('pembayaran');
	}
}
