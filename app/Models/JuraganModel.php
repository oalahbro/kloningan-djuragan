<?php

namespace App\Models;

use CodeIgniter\Model;

class JuraganModel extends Model
{
	protected $table = 'juragan';
	protected $primaryKey = 'id_juragan';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['juragan', 'nama_juragan'];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	protected $dateFormat = 'int';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = false;

	public function ambil()
	{
		$builder = $this->db->table('juragan j');
		$builder->select('j.*');

		$builder->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","&quot;id&quot;:",b.id_bank,",","&quot;nama&quot;:&quot;",b.nama_bank,"&quot;,","&quot;no&quot;:&quot;",b.rekening,"&quot;,","&quot;atas_nama&quot;:&quot;",b.atas_nama,"&quot;}")),"]") as bank');

		$builder->join('relasi r', 'r.juragan_id = j.id_juragan', 'left');
		$builder->join('bank b', 'b.id_bank = r.val_id', 'left');
		$builder->where('r.table', '2');

		$builder->groupBy("j.id_juragan");
		return $builder;
	}
}
