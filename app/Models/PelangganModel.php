<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nama_pelanggan', 'hp', 'cod', 'kecamatan', 'kabupaten', 'provinsi', 'alamat', 'kodepos'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $dateFormat = 'int';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function ambil($id_pelanggan)
    {
        $builder = $this->db->table('pelanggan');
        $builder->where('id_pelanggan', $id_pelanggan);
        $query   = $builder->get();

        return $query;
    }
}
