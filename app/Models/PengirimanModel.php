<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanModel extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'id_pengiriman';

    protected $returnType = 'object';

    protected $allowedFields = ['invoice_id', 'kurir', 'ongkir', 'resi', 'qty_kirim', 'tanggal_kirim'];
}
