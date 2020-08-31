<<<<<<< HEAD
<?php namespace App\Models;
use CodeIgniter\Model;
 
class RelasiModel extends Model
{
	protected $table = 'relasi';
	protected $primaryKey = 'id_bank';
	
	protected $returnType = 'object';
=======
<?php

namespace App\Models;

use CodeIgniter\Model;

class RelasiModel extends Model
{
    protected $table = 'relasi';
    protected $primaryKey = 'id_bank';

    protected $returnType = 'object';
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
    protected $useSoftDeletes = false;

    protected $allowedFields = ['table', 'juragan_id', 'val_id'];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $dateFormat = 'int';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
<<<<<<< HEAD

=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
}
