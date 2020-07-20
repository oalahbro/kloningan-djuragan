<?php namespace App\Models;
use CodeIgniter\Model;
 
class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'id';
	
	protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'email', 'password', 'username', 'login_terakhir'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $dateFormat = 'int';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
