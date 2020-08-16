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
			'tipe_pembayaran' => [
				'type' 			 => 'ENUM',
				'constraint' 	 => ["1","2"], //  1: cash, 2: transfer
				'default' 		 => '1'
			],
			'sumber_dana' => [
				'type'           => 'ENUM',
				'constraint'     => ["1","2","3","4","5"], // 1: cod, 2: bca, 3: bri, 4: bni, 5:mandiri
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
