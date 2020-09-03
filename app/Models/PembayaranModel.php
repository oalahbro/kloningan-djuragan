<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $returnType = 'object';

    protected $allowedFields = ['id_invoice', 'sumber_dana', 'total_pembayaran', 'status', 'tanggal_pembayaran', 'tanggal_cek'];
}
