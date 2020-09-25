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


	public function ambil($user_id, $dibaca = FALSE, $limit = NULL, $offset = NULL)
	{
		$notif = $this->db->table($this->table . ' n');
		$notif->select('i.seri, n.*, p.name, j.juragan');

		$notif->join('invoice i', 'n.invoice_id = i.id_invoice', 'LEFT');
		$notif->join('user p', 'n.from = p.id', 'LEFT');
		$notif->join('juragan j', 'j.id_juragan = n.juragan_id', 'LEFT');
		$notif->where('n.for', $user_id);
		if ($dibaca) {
			$notif->where('n.read_at !=', NULL);
		} else {
			$notif->where('n.read_at', NULL);
		}

		if ($limit !== NULL && $offset !== NULL) {
			$notif->limit($limit, $offset);
		}

		$notif->orderBy('n.created_at', 'DESC');

		return $notif;
	}
}
