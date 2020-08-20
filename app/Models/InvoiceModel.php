<?php namespace App\Models;
use CodeIgniter\Model;
 
class InvoiceModel extends Model
{
	protected $table = 'invoice';
	protected $primaryKey = 'id_invoice';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['seri', 'tanggal_pesan', 'pelanggan_id', 'juragan_id', 'user_id', 'status_pesanan', 'status_pembayaran', 'status_pengiriman', 'keterangan'];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'update_at';
	protected $deletedField  = 'deleted_at';

	protected $dateFormat = 'int';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = false;

	// ambil data
	public function ambil_data($juragan = NULL)
	{
		$inv = $this->db->table('invoice i');
		$inv->select('i.*,l.label as label_asal, l.source_id');

		$inv->select('CONCAT("{","\"id\":",i.juragan_id,",","\"nama\":\"",j.nama_juragan,"\"",",","\"slug\":\"",j.juragan,"\"",,"}") as juragan');

		$inv->select('CONCAT("{","\"id\":",i.user_id,",","\"nama\":\"",u.name,"\"",",","\"username\":\"",u.username,"\"",,"}") as pengguna');

		$inv->select('CONCAT("{","\"id\":",i.pelanggan_id,",","\"nama\":\"",p.nama_pelanggan,"\"",",","\"hp\":",p.hp,",","\"cod\":",p.cod,",","\"alamat\":\"",IFNULL(p.alamat, "null"),"\"",",","\"kecamatan\":",IFNULL(p.kecamatan,"null"),",","\"kabupaten\":",IFNULL(p.kabupaten,"null"),",","\"provinsi\":",IFNULL(p.provinsi,"null"),",","\"kodepos\":\"",IFNULL(p.kodepos,"null"),"\"","}") as pelanggan');
		
		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",b.id_beli,",","\"stok_id\":","\"",IFNULL(b.stok_id, "null"),"\",","\"kode\":\"",b.kode,"\",","\"ukuran\":\"",b.ukuran,"\",","\"harga\":",b.harga, ",","\"qty\":",b.qty,"}")),"]") as barang');

		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",c.id_biaya,",","\"biaya_id\":",c.biaya_id,",","\"nominal\":\"",c.nominal,"\",","\"label\":","\"",IFNULL(c.label, "null"),"\"}")),"]") as biaya');

		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",s.id_status,",","\"status\":",s.status,",","\"tanggal_selesai\":",IFNULL(s.tanggal_selesai, "null"),",","\"tanggal_masuk\":",IFNULL(s.tanggal_masuk, "null"),",","\"keterangan_selesai\":","\"",IFNULL(s.keterangan_selesai, "null"),"\"",",","\"keterangan_masuk\":","\"",IFNULL(s.keterangan_masuk, "null"),"\"}")),"]") as status');

		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",x.id_pembayaran,",","\"tipe\":",x.tipe_pembayaran,",","\"sumber\":",x.sumber_dana,",","\"nama\":","\"",bn.nama_bank,"\"",",","\"nominal\":",x.total_pembayaran,",","\"status\":",x.status,",","\"tanggal_bayar\":",x.tanggal_pembayaran,",","\"tanggal_cek\":",IFNULL(x.tanggal_cek, "null"),"}")),"]") as pembayaran');

		$inv->join('juragan j', 'j.id_juragan = i.juragan_id');
		$inv->join('user u', 'u.id = i.user_id');
		$inv->join('pelanggan p', 'p.id_pelanggan = i.pelanggan_id');
		$inv->join('label_invoice l', 'l.invoice_id = i.id_invoice');
		$inv->join('pembayaran x', 'x.invoice_id = i.id_invoice', 'left');
		$inv->join('dibeli b', 'b.invoice_id = i.id_invoice', 'left');
		$inv->join('invoice_status s', 's.invoice_id = i.id_invoice', 'left');
		$inv->join('bank bn', 'bn.id_bank = x.sumber_dana', 'left outer');
		$inv->join('biaya c', 'c.invoice_id = i.id_invoice', 'left');

		$inv->where('i.deleted_at', NULL);

		$inv->orderBy('i.created_at', 'DESC');
		$inv->groupBy("i.id_invoice");
		$query = $inv->get();
		return $query;
	}
}
