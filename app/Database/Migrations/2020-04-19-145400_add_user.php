<?php namespace App\Database\Migrations;

class AddUser extends \CodeIgniter\Database\Migration {

	public function up()
	{
		$this->forge->addField([
			'id'  => [
				'type' 			 => 'INT',
				'constraint' 	 => 5,
				'unsigned' 		 => TRUE,
				'auto_increment' => TRUE
			],
			'username' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '100',
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'     => '72',
			],
			'name' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '50',
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'created_at' => [
				'type'           => 'DATETIME',
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'			 => TRUE
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
