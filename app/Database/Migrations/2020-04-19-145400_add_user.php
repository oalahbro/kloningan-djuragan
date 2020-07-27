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
				'constraint'     => '60',
			],
			'name' => [
				'type' 			 => 'VARCHAR',
				'constraint' 	 => '50',
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'level' => [
				'type'           => 'ENUM',
				'constraint'     => ['superadmin', 'admin', 'cs', 'viewer', 'reseller'],
				'default'        => 'viewer',
			],
			'status' => [
				'type'           => 'ENUM',
				'constraint'     => ['pending', 'inactive', 'active', 'blocked'],
				'default'        => 'pending',
			],
			'login_terakhir' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE,
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
			'created_at' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE
			],
			'updated_at' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE
			],
			'deleted_at' => [
				'type'           => 'INT',
				'constraint' 	 => 10,
				'unsigned' 		 => TRUE,
				'null' 			 => TRUE,
				'default' 		 => NULL
			],
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('user', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
