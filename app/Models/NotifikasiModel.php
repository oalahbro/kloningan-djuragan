<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
	protected $table = 'notifikasi';
	protected $primaryKey = 'id_notifikasi';

	protected $returnType = 'object';
	// protected $useSoftDeletes = true;

	protected $allowedFields = ['juragan_id', 'from', 'for', 'invoice_id', 'type', 'read_at', 'created_at'];


	public function ambil($user_id)
	{
		$builder = $this->db->table($this->table . ' n');
		$builder->select('i.seri, n.*, p.name, j.juragan');
		$builder->join('invoice i', 'n.invoice_id = i.id_invoice', 'LEFT');
		$builder->join('user p', 'n.from = p.id', 'LEFT');
		$builder->join('juragan j', 'j.id_juragan = n.juragan_id', 'LEFT');
		$builder->where('n.for', $user_id);

		$builder->orderBy('n.created_at', 'DESC');
		$builder->limit(100);

		return $builder;
	}

}
