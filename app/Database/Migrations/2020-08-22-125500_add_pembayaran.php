<?php namespace App\Database\Migrations;

class AddPembayaran extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_pembayaran'  => [
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
			'sumber_dana' => [ // dana dari tabel bank
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'total_pembayaran' => [
				'type' 			 => 'INT',
				'constraint' 	 => 7,
				'unsigned' 		 => TRUE
			],
			'status' => [
				'type' 			 => 'ENUM',
				'constraint'     => ["1","2","3"], // 1: belum dicek, 2: dana tidak ada, 3: dana ada
				'default' 		 => '1'
			],
			'tanggal_pembayaran' => [
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
		
		$this->forge->addKey('id_pembayaran', TRUE);
		$this->forge->createTable('pembayaran', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('pembayaran');
	}
}
