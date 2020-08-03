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
			'operasi' => [
				'type' 			 => 'ENUM',
				'constraint' 	 => ["1","2"] // 1: plus, 2: minus
			],
			'biaya_id' => [
				'type' 			 => 'ENUM',
				'constraint' 	 => ["1","2","3"] // 1: diskon order, 2: ongkir, 3: biaya lain
			],
			'nominal' => [
				'type' 			 => 'INT',
				'constraint' 	 => 7,
				'unsigned' 		 => TRUE
			],
			'label' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => 20, // angka unik
				'null' 			 => TRUE,
				'default' 		 => NULL,
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
