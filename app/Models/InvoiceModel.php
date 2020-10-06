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
	public function ambil_data($juragan_id = NULL, $hal = 'semua', $limit = NULL, $offset = NULL, $cari = NULL)
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

		if ($cari !== NULL) {

			if (!empty($cari['pembayaran'])) {
				$status_pembayaran = "i.status_pembayaran='" . $cari['pembayaran'] . "'";
				if ($cari['pembayaran'] === '2A') {
					$status_pembayaran = "(i.status_pembayaran='2' OR i.status_pembayaran='3')";
				}
				$inv->where($status_pembayaran);
			}

			if (!empty($cari['pengiriman'])) {
				$status_pengiriman = "i.status_pengiriman='" . $cari['pengiriman'] . "'";
				if ($cari['pengiriman'] === '2A') {
					$status_pengiriman = "(i.status_pengiriman='2' OR i.status_pengiriman='3')";
				}
				$inv->where($status_pengiriman);
			}

			if (!empty($cari['orderan'])) {
				$inv->where('i.status_pesanan', $cari['orderan']);
			}

			if (!empty($cari['kolom'])) {
				switch ($cari['kolom']) {
					case 'id':
						$inv->where('i.id_invoice', $cari['q']);
						break;
					case 'faktur':
						$inv->where('i.seri', $cari['q']);
						break;
					case 'nama':
						$inv->where("(p.nama_pelanggan LIKE '%" . $cari['q'] . "%' OR k.nama_pelanggan LIKE '%" . $cari['q'] . "%')");
						break;
					case 'hp':
						$inv->where("(p.hp LIKE '%" . $cari['q'] . "%' OR k.hp LIKE '%" . $cari['q'] . "%')");
						break;
					case 'kode':
						$inv->where("(b.kode LIKE '%" . $cari['q'] . "%')");
						break;
					case 'tanggal_pesan':
						// DATE(CONVERT_TZ(FROM_UNIXTIME(tanggal_dibuat, '%Y-%m-%d %H:%i:%s'), '+00:00', '+00:00'))='".$cari['tanggal']."'
						$inv->where('i.tanggal_pesan', $cari['q']);
						break;
				}
			} else {
				$query = "(";
				$query .= "b.kode LIKE '%" . $cari['q'] . "%' ";
				preg_match_all('/%22(?:\\\\.|(?!%22).)*%22|\S+/', $cari['q'], $matches);
				foreach ($matches[0] as $term) {
					$term = trim($term);
					if (!empty($term)) {
						$term = str_replace('"', "", $term);
						$query .= "OR i.id_invoice LIKE '%" . $term . "%' ";
						$query .= "OR i.seri LIKE '%" . $term . "%' ";
						$query .= "OR p.nama_pelanggan LIKE '%" . $term . "%' ";
						$query .= "OR k.nama_pelanggan LIKE '%" . $term . "%' ";
						$query .= "OR p.hp LIKE '%" . $term . "%' ";
						$query .= "OR k.hp LIKE '%" . $term . "%' ";
						$query .= "OR p.alamat LIKE '%" . $term . "%' ";
						$query .= "OR k.alamat LIKE '%" . $term . "%' ";
						$query .= "OR i.keterangan LIKE '%" . $term . "%' ";
						$query .= "OR sx.resi LIKE '%" . $term . "%' ";
					}
				}

				$query .= ")";
				$inv->where($query);
			}
		}

		if ($juragan_id !== NULL) {
			$inv->having('i.juragan_id', $juragan_id);
		}

		switch ($hal) {
			case 'selesai':
				$inv->where('i.status_pengiriman', '3');
				break;

			case 'belum-proses':
				$inv->where('i.status_pesanan', '1');
				break;

			case 'cek-bayar':
				$inv->whereIn('i.status_pembayaran', ['2', '3']);
				break;

			case 'dalam-proses':
				$inv->where('i.status_pesanan', '2');
				$inv->whereNotIn('i.status_pengiriman', ['3']);
				break;
		}

		$inv->where('i.deleted_at', NULL);

		/*$inv->orderBy("CASE 
			WHEN i.status_pembayaran = '2' THEN 0 #perlu dicek (belum ada pembayaran sebelumnya)
			WHEN i.status_pembayaran = '3' THEN 1 #perlu dicek 2 (sudah ada pembayaran sebelumnya)
			WHEN i.status_pembayaran = '4' THEN 2 #pembayaran kredit
			WHEN i.status_pembayaran = '6' THEN 3 #pembayaran lunas
			WHEN i.status_pesanan = '2' THEN 4 #pesanan diproses
			WHEN i.status_pembayaran = '1' THEN 5 #belum ada pembayaran
			WHEN i.status_pembayaran = '5' THEN 6 #pembayaran ada kelebihan
			WHEN i.status_pesanan = '3' THEN 7 #pesanan dibatalkan
			END");
			*/
		$inv->orderBy('i.status_pesanan ASC, i.tanggal_pesan DESC, i.update_at DESC');

		if ($limit !== NULL && $offset !== NULL) {
			$inv->limit($limit, $offset);
		}

		$inv->groupBy("i.id_invoice");

		return $inv;
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

		$builder->select('(SELECT SUM(p.qty_kirim) FROM ' . $db->prefixTable('pengiriman') . ' p WHERE p.invoice_id=' . $invoice_id . ') AS sudah_kirim', FALSE);

		$builder->select('(SELECT SUM(d.qty) FROM ' . $db->prefixTable('dibeli') . ' d WHERE d.invoice_id=' . $invoice_id . ') AS wajib_kirim', FALSE);

		return $builder->get();
	}

	// ------------------------------------------------------------------------

	public function counter_terkirim()
	{
		$awalBulanIni 	= date('Y-m-', strtotime(date('Y-m') . " -1 month")) . '26';
		$akhirBulanIni 	= date('Y-m-', strtotime(date('Y-m'))) . '25';

		$awalBulanLalu 	= date('Y-m-', strtotime(date('Y-m') . " -2 month")) . '26';
		$akhirBulanLalu	= date('Y-m-', strtotime(date('Y-m') . " -1 month")) . '25';

		$counter = $this->db->table('juragan j');
		$counter->select('j.*');

		$counter->select('COUNT(DISTINCT(CASE WHEN i.deleted_at IS NULL AND i.tanggal_pesan between "' . $awalBulanIni . '" AND "' . $akhirBulanIni . '" THEN i.id_invoice END)) as jumlahOrderBulanIni');

		$counter->select('COUNT(DISTINCT(CASE WHEN i.deleted_at IS NULL AND i.tanggal_pesan between "' . $awalBulanLalu . '" AND "' . $akhirBulanLalu . '" THEN i.id_invoice END)) as jumlahOrderBulanLalu');

		$counter->select('SUM(CASE WHEN i.deleted_at IS NULL AND i.status_pengiriman = "3" AND DATE_FORMAT(FROM_UNIXTIME(s.tanggal_kirim), "%Y-%m-%d") between "' . $awalBulanIni . '" AND "' . $akhirBulanIni . '" THEN s.qty_kirim ELSE 0 END) as terkirimBulanIni');

		$counter->select('SUM(CASE WHEN i.deleted_at IS NULL AND i.status_pengiriman = "3" AND DATE_FORMAT(FROM_UNIXTIME(s.tanggal_kirim), "%Y-%m-%d") between "' . $awalBulanLalu . '" AND "' . $akhirBulanLalu . '" THEN s.qty_kirim ELSE 0 END) as terkirimBulanLalu');

		$counter->join('invoice i', 'j.id_juragan = i.juragan_id', 'left outer');
		$counter->join('dibeli b', 'b.invoice_id = i.id_invoice', 'left outer');
		$counter->join('pengiriman s', 's.invoice_id = i.id_invoice', 'left outer');

		$counter->groupBy('j.id_juragan');
		$query = $counter->get();

		return $query;
	}

	// ------------------------------------------------------------------------

}
