<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotifikasi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_notifikasi'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'juragan_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'from' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'for' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'invoice_id' => [
				'type' 			 => 'INT',
				'constraint' 	 => 11,
				'unsigned' 		 => TRUE,
			],
			'type' => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
			],
			'read_at' => [
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned' 		 => TRUE,
				'null'  		 => TRUE,
				'default' 		 => NULL
			],
			'created_at' => [
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned' 		 => TRUE
			]
		]);

		$this->forge->addKey('id_notifikasi', TRUE);
		$this->forge->createTable('notifikasi', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('notifikasi');
	}
}
