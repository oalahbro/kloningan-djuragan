<?php namespace App\Database\Migrations;

class AddInvoiceStatus extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_status'  => [
				'type' 			=> 'INT',
				'constraint' 	=> 11,
				'unsigned' 		=> TRUE,
				'auto_increment'=> TRUE
			],
			'invoice_id'  => [
				'type' 			=> 'INT',
				'constraint' 	=> 11,
				'unsigned' 		=> TRUE
			],
			/*
			 * 1: data pesanan lengkap atau tidak
			 * 2: bahan produk ada atau tidak
			 * 3: masuk sablon atau belum
			 * 4: masuk bordir atau belum
			 * 5: masuk penjahit atau belum
			 * 6: masuk QC atau belum
			 * 7: dipacking atau belum
			 * 
			 */
            'status' => [
                'type'          => 'ENUM',
				'constraint'    => ["1","2","3","4","5","6","7"],
				'null' 			=> true,
				'default' 		=> NULL
			],
			'tanggal_masuk' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE,
				'null' 			=> TRUE,
				'default' 		=> NULL
			],
			'tanggal_selesai' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE,
				'null' 			=> TRUE,
				'default' 		=> NULL
			],
			'keterangan_masuk' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	 => 100,
				'null' 			=> TRUE,
				'default' 		=> NULL
			],
			'keterangan_selesai' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	 => 100,
				'null' 			=> TRUE,
				'default' 		=> NULL
			]
		]);
		
		$this->forge->addKey('id_status', TRUE);
		$this->forge->createTable('invoice_status', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('invoice_status');
	}
}
