<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'password', 'name', 'email', 'level', 'status', 'login_terakhir'];

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
        $builder = $this->db->table('user u');
        $builder->select('u.*');

        $builder->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","&quot;id&quot;:",j.id_juragan,",","&quot;nama&quot;:&quot;",j.nama_juragan,"&quot;,","&quot;link&quot;:&quot;",j.juragan,"&quot;}")),"]") as juragan');

        $builder->join('relasi r', 'r.val_id = u.id', 'left');
        $builder->join('juragan j', 'j.id_juragan = r.juragan_id', 'left');
        $builder->where('r.table', '1');

        $builder->groupBy('u.id');

        return $builder;
    }
    public function ambilSemua(?int $id = null)
    {
        $users  = $this->ambil($id)->get()->getResultObject();
        $return = [];

        foreach ($users as $user) {
            $juragan = json_decode(html_entity_decode($user->juragan, ENT_QUOTES, 'UTF-8'), true);

            $return[] = [
                'id'             => (int) $user->id,
                'username'       => $user->username,
                'nama'           => $user->name,
                'email'          => $user->email,
                'level'          => $user->level,
                'status'         => $user->status,
                'login_terakhir' => $user->login_terakhir,
                'juragan'        => $juragan,
            ];
        }

        return $return;
    }
}
