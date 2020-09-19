<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
	protected $table = 'invoice';
	protected $primaryKey = 'id_invoice';

	protected $returnType = 'object';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['seri', 'tanggal_pesan', 'pemesan_id', 'kirimKepada_id', 'juragan_id', 'user_id', 'status_pesanan', 'status_pembayaran', 'status_pengiriman', 'keterangan'];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'update_at';
	protected $deletedField  = 'deleted_at';

	protected $dateFormat = 'int';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = false;

	// ------------------------------------------------------------------------
	// ambil data
	public function ambil_data($juragan_id = NULL)
	{
		$inv = $this->db->table($this->table . ' i');
		$inv->select('i.*,l.label as label_asal, l.source_id');

		$inv->select('CONCAT("{","\"id\":",i.juragan_id,",","\"nama\":\"",j.nama_juragan,"\"",",","\"slug\":\"",j.juragan,"\"",,"}") as juragan');

		$inv->select('CONCAT("{","\"id\":",i.user_id,",","\"nama\":\"",u.name,"\"",",","\"username\":\"",u.username,"\"",,"}") as pengguna');

		$inv->select('CONCAT("{","\"id\":",i.pemesan_id,",","\"nama\":\"",p.nama_pelanggan,"\"",",","\"hp\":",p.hp,",","\"cod\":",p.cod,",","\"alamat\":\"",IFNULL(p.alamat, "null"),"\"",",","\"kecamatan\":",IFNULL(p.kecamatan,"null"),",","\"kabupaten\":",IFNULL(p.kabupaten,"null"),",","\"provinsi\":",IFNULL(p.provinsi,"null"),",","\"kodepos\":\"",IFNULL(p.kodepos,"null"),"\"","}") as pelanggan');

		$inv->select('CONCAT("{","\"id\":",i.kirimKepada_id,",","\"nama\":\"",k.nama_pelanggan,"\"",",","\"hp\":",k.hp,",","\"cod\":",k.cod,",","\"alamat\":\"",IFNULL(k.alamat, "null"),"\"",",","\"kecamatan\":",IFNULL(k.kecamatan,"null"),",","\"kabupaten\":",IFNULL(k.kabupaten,"null"),",","\"provinsi\":",IFNULL(k.provinsi,"null"),",","\"kodepos\":\"",IFNULL(k.kodepos,"null"),"\"","}") as kirimKe');

		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",b.id_beli,",","\"stok_id\":","\"",IFNULL(b.stok_id, "null"),"\",","\"kode\":\"",b.kode,"\",","\"ukuran\":\"",b.ukuran,"\",","\"harga\":",b.harga, ",","\"qty\":",b.qty,"}")),"]") as barang');

		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",c.id_biaya,",","\"biaya_id\":",c.biaya_id,",","\"nominal\":\"",c.nominal,"\",","\"label\":","\"",IFNULL(c.label, "null"),"\"}")),"]") as biaya');

		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",s.id_status,",","\"status\":",s.status,",","\"tanggal_selesai\":",IFNULL(s.tanggal_selesai, "null"),",","\"tanggal_masuk\":",IFNULL(s.tanggal_masuk, "null"),",","\"keterangan_selesai\":","\"",IFNULL(s.keterangan_selesai, "null"),"\"",",","\"keterangan_masuk\":","\"",IFNULL(s.keterangan_masuk, "null"),"\"}")),"]") as status');

		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",x.id_pembayaran,",","\"sumber\":",x.sumber_dana,",","\"nama\":","\"",bn.nama_bank,"\"",",","\"atas_nama\":","\"",bn.atas_nama,"\"",",","\"nominal\":",x.total_pembayaran,",","\"status\":",x.status,",","\"tanggal_bayar\":",x.tanggal_pembayaran,",","\"tanggal_cek\":",IFNULL(x.tanggal_cek, "null"),"}")),"]") as pembayaran');

		$inv->select('CONCAT("[" ,GROUP_CONCAT(DISTINCT CONCAT("{","\"id\":",sx.id_pengiriman,",","\"ongkir\":",sx.ongkir,",","\"kurir\":","\"",sx.kurir,"\"",",","\"resi\":","\"",sx.resi,"\"",",","\"qty\":",sx.qty_kirim,",","\"tanggal_kirim\":",sx.tanggal_kirim,"}")),"]") as pengiriman');

		$inv->join('juragan j', 'j.id_juragan = i.juragan_id');
		$inv->join('user u', 'u.id = i.user_id');
		$inv->join('label_invoice l', 'l.invoice_id = i.id_invoice');
		$inv->join('pelanggan p', 'p.id_pelanggan = i.pemesan_id');
		$inv->join('pelanggan k', 'k.id_pelanggan = i.kirimKepada_id');
		$inv->join('pembayaran x', 'x.invoice_id = i.id_invoice', 'left');
		$inv->join('pengiriman sx', 'sx.invoice_id = i.id_invoice', 'left');
		$inv->join('dibeli b', 'b.invoice_id = i.id_invoice', 'left');
		$inv->join('invoice_status s', 's.invoice_id = i.id_invoice', 'left');
		$inv->join('bank bn', 'bn.id_bank = x.sumber_dana', 'left outer');
		$inv->join('biaya c', 'c.invoice_id = i.id_invoice', 'left');

		if ($juragan_id !== NULL) {
			$inv->having('i.juragan_id', $juragan_id);
		}
		$inv->where('i.deleted_at', NULL);

		$inv->orderBy('i.created_at', 'DESC');
		$inv->groupBy("i.id_invoice");

		return $inv->get();
	}

	// ------------------------------------------------------------------------

	public function total_biaya($invoice_id)
	{
		$biaya = $this->db->table('dibeli d');
		$biaya->select('SUM(DISTINCT d.harga*d.qty) as barang');
		$biaya->select('SUM(DISTINCT c.nominal) as lain');
		$biaya->select("SUM(DISTINCT case when x.status='3' then x.total_pembayaran else 0 end) as terbayar");
		$biaya->select("SUM(DISTINCT case when x.status='1' then x.total_pembayaran else 0 end) as belumcek");

		$biaya->join('biaya c', 'c.invoice_id = d.invoice_id', 'left');
		$biaya->join('pembayaran x', 'x.invoice_id = d.invoice_id', 'left');

		$biaya->where('d.invoice_id', $invoice_id);

		// $biaya->groupBy("d.invoice_id");
		return $biaya->get();
	}

	// ------------------------------------------------------------------------

	public function status($invoice_id)
	{
		$status = $this->db->table('invoice_status s');
		$status->where('s.invoice_id', $invoice_id);
		$status->orderBy('s.id_status', 'ASC');

		return $status->get();
	}

	// ------------------------------------------------------------------------

	public function jumlah_produk($invoice_id)
	{
		$db = \Config\Database::connect();
		$builder = $this->db->table('pengiriman p');

		$builder->select('(SELECT SUM(p.qty_kirim) FROM '.$db->prefixTable('pengiriman').' p WHERE p.invoice_id='.$invoice_id.') AS sudah_kirim', FALSE);

		$builder->select('(SELECT SUM(d.qty) FROM '.$db->prefixTable('dibeli').' d WHERE d.invoice_id='.$invoice_id.') AS wajib_kirim', FALSE);

		return $builder->get();
	}

	// ------------------------------------------------------------------------

}
