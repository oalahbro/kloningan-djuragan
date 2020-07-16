<?php namespace App\Database\Migrations;

class MoveUser extends \CodeIgniter\Database\Migration {

	public function up()
	{
		helper('date');

		$db      = \Config\Database::connect('default');
		$dbl     = \Config\Database::connect('db_lama');

		$results = $dbl->table('pengguna')->get();

		foreach ($results->getResult() as $row)
		{
			if ($row->valid === 'ya' && $row->blokir === 'tidak' && $row->aktif === 'ya') {
				$status = 'active';
			}
			elseif ($row->valid === 'ya' && $row->blokir === 'tidak' && $row->aktif === 'tidak') {
				$status = 'inactive';
			}
			
			if ($row->blokir === 'ya') {
				$status = 'blocked';
			}

			if ($row->valid === 'tidak') {
				$status = 'pending';
			}

			$data = [
				'id' => $row->id,
				'username'  => strtolower( $row->username ),
				'password' => $row->sandi,
				'name'  => $row->nama,
				'email' => $row->email,
				'level' => strtolower( $row->level ),
				'status' => $status,
				'login_terakhir' => $row->login_terakhir,
				'created_at' => now('Asia/Jakarta'),
				'updated_at' => now('Asia/Jakarta')

			];

			$db->table('user')->insert($data);
		}
	}

	public function down()
	{
		// $this->forge->dropTable('juragan');
	}
}
