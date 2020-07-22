<?php namespace App\Database\Migrations;

class AddBiaya extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id_biaya'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'invoice_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'label_id' => [
				'type' 			 => 'ENUM',
				'constraint' 	 => ["1","2","3", "4"] // 1: ongkir, 2: diskon, 3: unik, 4: lain-lain
			],
			'nominal' => [
				'type' 			 => 'INT',
				'constraint' 	 => 7,
				'unsigned' 		 => TRUE
			]
		]);
		$this->forge->addKey('id_biaya', TRUE);
		$this->forge->createTable('biaya', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('biaya');
	}
}
