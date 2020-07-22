<?php namespace App\Database\Migrations;

class AddInvoice extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_invoice'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'seri' => [
				'type'           => 'VARCHAR',
				'constraint' 	 => 14, // LS3457648767 LS202204224900
			],
			'pelanggan_id' => [
				'type'           => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'user_id' => [
				'type'           => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'status_pesanan' => [ 
				'type'           => 'ENUM',
				'constraint'     => ["1","2","3"], // 1: pending, 2: diproses, 3: dibatalkan
				'default'        => '1',
			],
			'status_pembayaran' => [
				'type'           => 'ENUM',
				'constraint' 	 => ["1","2","3","4","5"], // 1: belum bayar, 2: tunggu konfirmasi, 3: kredit, 4: kelebihan, 5: lunas
				'default' 		 => "1"
			],
			'status_pengiriman' => [
				'type'           => 'ENUM',
				'constraint' 	 => ["1","2","3"], // 1: belum dikirim, 2: dikirim sebagian, 3: teririm semua
				'default' 		 => "1"
			],
			'keterangan' => [
				'type' 			 => 'TEXT',
				'null' 			 => TRUE
			],
			'created_at' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE
			],
			'update_at' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE
			],
		]);
		
		$this->forge->addKey('id_invoice', TRUE);
		$this->forge->createTable('invoice', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('invoice');
	}
}
