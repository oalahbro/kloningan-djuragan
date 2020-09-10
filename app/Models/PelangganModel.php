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

    // ------------------------------------------------------------------------

    public function cari($juragan_id, $cari)
    {
        $builder = $this->db->table($this->table . ' p');
        $builder->select('x.juragan_id, i.juragan_id as alias_juragan, p.*');
        $builder->join('invoice i', 'i.pemesan_id=p.id_pelanggan', 'LEFT');
        $builder->join('invoice x', 'x.kirimKepada_id=p.id_pelanggan', 'LEFT');

        if ($cari !== null or $cari !== '') {
            $builder->like('p.nama_pelanggan', $cari, 'both');
            $builder->orLike('p.hp', $cari, 'both');
        }

        $builder->having('x.juragan_id', $juragan_id);
        $builder->orHaving('alias_juragan', $juragan_id);
        $builder->limit(10);
        $builder->groupBy('p.id_pelanggan');

        return $builder->get();
    }

    // ------------------------------------------------------------------------

}
