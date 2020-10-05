<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $returnType = 'object';

    protected $allowedFields = ['invoice_id', 'sumber_dana', 'total_pembayaran', 'status', 'tanggal_pembayaran', 'tanggal_cek'];
    
    // ambil data pembayaran
    public function ambil($invoice_id)
    {
        $bayar = $this->db->table('pembayaran p');
        $bayar->select('p.id_pembayaran as id, p.sumber_dana as sumber, bn.nama_bank as nama, bn.atas_nama, p.total_pembayaran as nominal, p.status, p.tanggal_pembayaran, p.tanggal_cek');
        $bayar->join('bank bn', 'bn.id_bank = p.sumber_dana', 'left outer');

        $bayar->where('p.invoice_id', $invoice_id);

        return $bayar;
    }
}
