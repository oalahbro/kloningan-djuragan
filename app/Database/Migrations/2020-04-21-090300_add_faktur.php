<?php namespace App\Database\Migrations;

class AddFaktur extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_fktr'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'no' => [
				'type'           => 'VARCHAR',
				'constraint' 	 => 14, // LS3457648767 LS202204224900
			],
			'pelanggan_id' => [
				'type'           => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'juragan_id' => [
				'type'           => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'marketplace' => [
				'type'           => 'ENUM',
				'constraint'     => ['0', '1'],
				'default' 		 => '0'
			],
			'status_fktr' => [
				'type'           => 'ENUM',
				'constraint'     => ['pending', 'diproses', 'batal'],
				'default' 		 => 'pending'
			],
			'status_bayar' => [
				'type'           => 'ENUM',
				'constraint'     => ['tunggu', 'belum', 'kredit', 'lunas', 'lebih'],
				'default' 		 => 'belum'
			],
			'status_kirim' => [
				'type'           => 'ENUM',
				'constraint'     => ['belum', 'sebagian', 'terkirim'],
				'default' 		 => 'belum'
			],
			'keterangan' => [
				'type' 			 => 'TEXT',
				'null' 			 => TRUE
			],
			'fktr_dibuat' => [
				'type'           => 'INT',
				'constraint' 	 => 10, // digunakan juga sebagai nomor faktur 1587427021
				'unsigned' 		 => TRUE
			],
			'fktr_diubah' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE
			],
		]);
		$this->forge->addKey('id_fktr', TRUE);
		$this->forge->createTable('faktur');
	}

	public function down()
	{
		$this->forge->dropTable('faktur');
	}
}
