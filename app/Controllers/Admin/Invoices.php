<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Invoices extends BaseController
{
	// tampilkan detail berdasarkan nomor seri
	public function baca($seri = '')
	{
	}

	// ------------------------------------------------------------------------
	// halaman untuk membuat invoice baru
	public function tulis()
	{
		$data = [
			'title' => 'Tulis Orderan Baru'
		];
		return view('admin/invoice/tulis', $data);
	}

	// ------------------------------------------------------------------------
	// menampilkan semua invoice
	public function lihat($juragan = 'semua')
	{
		// 
		$title = 'Semua Juragan';
		if ($juragan !== 'semua') {
			$juragans = $this->juragan->where('juragan', $juragan)->findAll();
			if (count($juragans) < 1) {
				return redirect()->to('/faktur?juragan_notfound=' . $juragan);
			}
			$title = $juragans[0]->nama_juragan;
		}

		$data = [
			'title' 	=> 'Invoice ' . $title,
			'pesanans' 	=> $this->invoice->ambil_data()->get()->getResult()
		];
		echo view('admin/invoice/lihat', $data);
	}

	// ------------------------------------------------------------------------
	// halaman untuk menyunting invoice verdasarkan $seri
	public function sunting($seri = '')
	{
		if ($seri === '' or empty($seri)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		else {
			// cek di database
			$pesanan = $this->invoice->ambil_data()->get()->getResult();
			if (count($pesanan) > 0) {
			
				$data = [
					'title' 	=> 'Sunting Invoice #' . $seri,
					'pesanans' 	=> $pesanan
				];
				return view('admin/invoice/lihat', $data);
			}
			else {
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}
		}
	}

	// ------------------------------------------------------------------------
	// hapus invoice
	public function hapus()
	{
		# code...
	}

	// ------------------------------------------------------------------------

	public function save()
	{
		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('addInvoice');
		}

		if ($this->request->isAJAX()) {
			if (!$this->validation->withRequest($this->request)->run()) {

				$this->response->setStatusCode(406);
				$errors = $this->validation->getErrors();

				return $this->response->setJSON($errors);
			} else {
				$db = \Config\Database::connect();

				$user_id = $this->request->getPost('pengguna');
				$t = $this->user->find($user_id);

				$data_invoice = [
					'tanggal_pesan' => $this->request->getPost('tanggal_order'),
					'seri'			=> strtoupper(first_letter($t->name) . time()),
					'pelanggan_id' 	=> $this->request->getPost('pelanggan'),
					'juragan_id' 	=> $this->request->getPost('juragan'),
					'user_id' 		=> $user_id,
					// 'status_pesanan'=> '',
					// 'status_pembayaran'=> '',
					// 'status_pengiriman'=> '',
					'keterangan' 	=> ($this->request->getPost('keterangan') !== "" ? $this->request->getPost('keterangan') : NULL)
				];

				// simpan ke database
				$this->invoice->insert($data_invoice);

				// 
				if ($db->affectedRows() > 0) {
					$invoice_id = $db->insertID();

					// simpan asal orderan
					$data_asal = [
						'invoice_id' => $invoice_id,
						'source_id' => $this->request->getPost('asal_orderan'),
						'label' 	=> ($this->request->getPost('label') !== "" ? $this->request->getPost('label') : NULL)
					];
					$db->table('label_invoice')->insert($data_asal);

					// simpan produk
					$produks =  $this->request->getPost('produk');

					// tambahkan `invoice_id` untuk tiap pesanan
					$produk = [];
					foreach ($produks as $k => $v) {
						foreach ($v as $p => $d) {
							$produk[$k]['invoice_id'] = $invoice_id;
							$produk[$k][$p] = $d;
						}
					}
					$db->table('dibeli')->insertBatch($produk);

					// simpan biaya
					if ($this->request->getVar('biaya') !== NULL) {
						//
						$biayas =  $this->request->getPost('biaya');

						// tambahkan `invoice_id` untuk tiap biaya
						$biaya = [];
						foreach ($biayas as $k => $v) {
							foreach ($v as $p => $d) {
								$biaya[$k]['invoice_id'] = $invoice_id;
								$biaya[$k][$p] = ($d !== "" ? $d : NULL);
							}
						}
						$db->table('biaya')->insertBatch($biaya);
					}
				}
				return $this->response->setJSON($this->request->getPost());
			}
		}
	}

	// ------------------------------------------------------------------------

	public function save_progress()
	{
		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('simpanProgress');
		}

		if ($this->request->isAJAX()) {
			if (!$this->validation->withRequest($this->request)->run()) {

				$this->response->setStatusCode(406);
				$errors = $this->validation->getErrors();

				return $this->response->setJSON($errors);
			} else {
				$db = \Config\Database::connect();
				$builder = $db->table('invoice_status');

				$invoice_id = $this->request->getPost('id_invoice');
				$status = $this->request->getPost('status');
				$stat = $this->request->getPost('stat');
				$keterangan = $this->request->getPost('keterangan');

				// 
				$builder->where([
					'invoice_id' 	=> $invoice_id,
					'status' 		=> $status
				]);

				$obj = $builder->get()->getResult();

				if (empty($obj)) {
					// create new status
					$data = [
						'invoice_id' => $invoice_id,
						'status' => $status,
						'tanggal_masuk' => time(),
						'keterangan_masuk' => ($keterangan !== '' ? $keterangan : NULL)
					];

					$builder->set($data);
					$builder->insert();
				} else {
					// edit if not complete, or create new if complete
					// get array of status
					$item = [];
					foreach ($obj as $struct) {
						if ($status == $struct->status) {
							$item[] = $struct;
							// break;
						}
					}

					$last_array = end($item);

					switch ($stat) {
						case '1':
							if ($last_array->tanggal_selesai === NULL) {
								// edit for current
								// add `tanggal selesai`
								$data = [
									'invoice_id' => $invoice_id,
									'status' => $status,
									'tanggal_selesai' => time(),
									'keterangan_selesai' => ($keterangan !== '' ? $keterangan : NULL)
								];

								$builder->set($data);
								$builder->where('id_status', $last_array->id_status);
								$builder->update();
							} else {
								// new status with start-end
								$data = [
									'invoice_id' => $invoice_id,
									'status' => $status,
									'tanggal_masuk' => time(),
									'tanggal_selesai' => time(),
									'keterangan_selesai' => ($keterangan !== '' ? $keterangan : NULL)
								];

								$builder->set($data);
								$builder->insert();
							}
							break;

						default:
							// create new status
							$data = [
								'invoice_id' => $invoice_id,
								'status' => $status,
								'tanggal_masuk' => time(),
								'keterangan_masuk' => ($keterangan !== '' ? $keterangan : NULL)
							];

							$builder->set($data);
							$builder->insert();
							break;
					}
				}
				return $this->response->setJSON($obj);
			}
		}
	}

	// ------------------------------------------------------------------------
	// update status pembayaran
	public function update_bayar()
	{
		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('updatePembayaran');
		}

		if ($this->request->isAJAX()) {
			if (!$this->validation->withRequest($this->request)->run()) {

				$this->response->setStatusCode(406);
				$errors = $this->validation->getErrors();

				return $this->response->setJSON($errors);
			} else {
				$status = $this->request->getPost('status');
				$data = [
					'id_pembayaran' => $this->request->getPost('id_pembayaran'),
					'status' 		=> $status,
					'tanggal_cek' 	=> time()
				];
				$this->pembayaran->save($data);

				// 
				$invoice_id = $this->request->getPost('invoice_id');

				$res = [
					'status' => 'data tersimpan',
					'url' 	=> site_url('admin/invoices/lihat?q=id:' . $invoice_id)
				];

				return $this->response->setJSON($res);
			}
		}
	}

}
