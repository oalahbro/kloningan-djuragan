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

	// ------------------------------------------------------------------------

	public function ambil()
	{
		$builder = $this->db->table($this->table . ' j');
		$builder->select('j.*');

		$builder->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","&quot;id&quot;:",b.id_bank,",","&quot;nama&quot;:&quot;",b.nama_bank,"&quot;,","&quot;no&quot;:&quot;",b.rekening,"&quot;,","&quot;atas_nama&quot;:&quot;",b.atas_nama,"&quot;}")),"]") as bank');

		$builder->join('relasi r', 'r.juragan_id = j.id_juragan', 'left');
		$builder->join('bank b', 'b.id_bank = r.val_id', 'left');
		$builder->where('r.table', '2');

		$builder->groupBy("j.id_juragan");
		return $builder;
	}

	// ------------------------------------------------------------------------

	public function ambil_bank($juragan_id)
	{
		$bank = $this->db->table($this->table . ' j');

		$bank->join('relasi r', 'r.juragan_id = j.id_juragan', 'left');
		$bank->join('bank b', 'b.id_bank = r.val_id', 'left');

		$bank->where('j.id_juragan', $juragan_id);

		$bank->orderBy('b.id_bank', 'DESC');

		return $bank->get();
	}

	// ------------------------------------------------------------------------

	public function terakhir_update($ids_juragan)
	{
		if(is_array($ids_juragan)) {
			$juragan = $this->db->table($this->table . ' j');
			$juragan->select('i.juragan_id as id_juragan, j.*');
			$juragan->join('relasi r', 'r.juragan_id = j.id_juragan', 'left');
			$juragan->join('user u', 'u.id = r.val_id', 'left');
			$juragan->join('invoice i', 'i.juragan_id = j.id_juragan', 'left');

			$juragan->havingIn('i.juragan_id', $ids_juragan);
			$juragan->orderBy('i.update_at', 'ASC');

			return $juragan->get()->getLastRow();
		}
		else {
			return ['error' => '$ids_juragan harus array'];
		}
	}
}
