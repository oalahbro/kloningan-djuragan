<?php namespace App\Database\Migrations;

class MoveUserRelation extends \CodeIgniter\Database\Migration {

	public function up()
	{
		helper('date');

		$db      = \Config\Database::connect('default');
		$dbl     = \Config\Database::connect('db_lama');

		$results = $dbl->table('pengguna_relation')->get();

		foreach ($results->getResult() as $row)
		{
			$data = [
				'juragan_id' => $row->juragan_id,
				'user_id' => $row->pengguna_id
			];

			$db->table('usrjrgn')->insert($data);
		}
	}

	public function down()
	{
		// $this->forge->dropTable('juragan');
	}
}
