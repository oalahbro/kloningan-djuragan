<?php namespace App\Models;
use CodeIgniter\Model;
 
class JuraganModel extends Model
{
	protected $table = 'juragan';
	protected $primaryKey = 'id_jrgn';
	
	protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['juragan', 'nama_jrgn'];

    protected $useTimestamps = true;
    protected $createdField  = 'jrgn_dibuat';
    protected $updatedField  = 'jrgn_diubah';
    // protected $deletedField  = 'deleted_at';

    protected $dateFormat = 'int';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;	
}
