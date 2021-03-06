<?php

namespace App\Models;

use CodeIgniter\Model;

class JuraganModel extends Model
{
    protected $table      = 'juragan';
    protected $primaryKey = 'id_juragan';

    protected $returnType     = 'object';
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

    public function byUserId($user_id)
    {
        $builder = $this->db->table($this->table . ' j');
        $builder->select('j.*, u.id as user_id, u.name as nama_user, u.username, u.email, r.table');

        $builder->join('relasi r', 'r.juragan_id = j.id_juragan');
        $builder->join('user u', 'u.id = r.val_id');

        $builder->where('r.table', 1); // juragan-user
        $builder->having('u.id', $user_id);
        $builder->groupBy('u.id');

        $builder->groupBy('j.id_juragan');

        return $builder->get();
    }

    // ------------------------------------------------------------------------

    public function byInvoiceId($invoice_id)
    {
        $builder = $this->db->table($this->table . ' j');
        $builder->select('j.*,i.id_invoice');

        $builder->join('invoice i', 'i.juragan_id = j.id_juragan');
        $builder->where('i.id_invoice', $invoice_id);

        return $builder->get();
    }

    // ------------------------------------------------------------------------

    public function getUsers($ids_juragan)
    {
        if (\is_array($ids_juragan)) {
            $builder = $this->db->table($this->table . ' j');
            $builder->select('j.*, u.*, r.table');

            $builder->join('relasi r', 'r.juragan_id = j.id_juragan', 'left');

            $builder->join('user u', 'u.id = r.val_id', 'both');
            $builder->havingIn('j.id_juragan', $ids_juragan);
            $builder->where('r.table', 1); // juragan-user
            $builder->groupBy('u.id');

            return $builder->get();
        } else {
            return false;
        }
    }

    // ------------------------------------------------------------------------

    public function getUsersByJuragan($id)
    {
        $builder = $this->db->table($this->table . ' j');
        $builder->select('j.*, u.*, r.table');

        $builder->join('relasi r', 'r.juragan_id = j.id_juragan', 'left');

        $builder->join('user u', 'u.id = r.val_id', 'both');
        $builder->where('j.id_juragan', $id);
        $builder->where('r.table', 1); // juragan-user
        $builder->groupBy('u.id');

        return $builder->get();
    }

    // ------------------------------------------------------------------------

    public function ambil_bank($juragan_id)
    {
        $bank = $this->db->table($this->table . ' j');

        $bank->select('j.*, b.*, r.table');

        $bank->join('relasi r', 'r.juragan_id = j.id_juragan', 'left');
        $bank->join('bank b', 'b.id_bank = r.val_id', 'left');

        $bank->where('r.table', 2); // juragan-bank
        $bank->having('j.id_juragan', $juragan_id);

        $bank->orderBy('b.id_bank', 'DESC');

        return $bank->get();
    }

    // ------------------------------------------------------------------------

    public function terakhir_update($ids_juragan)
    {
        if (\is_array($ids_juragan)) {
            $juragan = $this->db->table($this->table . ' j');
            $juragan->select('i.juragan_id as id_juragan, j.*');
            $juragan->join('relasi r', 'r.juragan_id = j.id_juragan', 'left');
            $juragan->join('user u', 'u.id = r.val_id', 'left');
            $juragan->join('invoice i', 'i.juragan_id = j.id_juragan', 'left');

            $juragan->havingIn('i.juragan_id', $ids_juragan);
            $juragan->orderBy('i.update_at', 'ASC');

            return $juragan->get()->getLastRow();
        } else {
            return ['error' => '$ids_juragan harus array'];
        }
    }
    public function ambilSemua()
    {
        $juragans = $this->orderBy('nama_juragan', 'asc')->findAll();
        $return   = [];

        foreach ($juragans as $a) {
            $list_bank = [];
            $banks     = $this->ambil_bank($a->id_juragan)->getResult();

            foreach ($banks as $b) {
                $list_bank[$b->id_bank] = [
                    'id'        => (int) $b->id_bank,
                    'nama'      => $b->nama_bank,
                    'tipe'      => $b->tipe_bank,
                    'rekening'  => $b->rekening,
                    'atas_nama' => $b->atas_nama,
                ];
            }

            $return[$a->id_juragan] = [
                'id'   => (int) $a->id_juragan,
                'nama' => $a->nama_juragan,
                'slug' => $a->juragan,
                'bank' => $list_bank,
            ];
        }

        return $return;
    }
    // ------------------------------------------------------------------------
}
