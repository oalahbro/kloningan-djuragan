<?php namespace App\Database\Migrations;

class MoveJuragan extends \CodeIgniter\Database\Migration {

	public function up()
	{
		helper('date');

		$db      = \Config\Database::connect('default');
		$dbl     = \Config\Database::connect('db_lama');

		$query = $dbl->table('juragan');
		$results = $query->get();

		foreach ($results->getResult() as $row)
		{
			$data = [
				'id_jrgn' => $row->id,
				'juragan'  => url_title($row->nama, '-', TRUE),
				'nama_jrgn'  => $row->nama,
				'jrgn_dibuat' => now('Asia/Jakarta'),
				'jrgn_diubah' => now('Asia/Jakarta')
			];

			$db->table('juragan')->insert($data);
		}
	}

	public function down()
	{
		// $this->forge->dropTable('juragan');
	}
}
