<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Invoices extends BaseController
{
	// halaman untuk membuat invoice baru
	public function tulis()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		$data = [
			'title' => 'Tulis Orderan Baru'
		];
		return view('admin/invoice/tulis', $data);
	}

	// ------------------------------------------------------------------------
	// menampilkan semua invoice
	public function lihat($juragan = 'semua')
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		// 
		$title = 'Semua Juragan';
		$id_juragan = NULL;
		if ($juragan !== 'semua') {
			$juragans = $this->juragan->where('juragan', $juragan)->findAll();
			if (count($juragans) < 1) {
				return redirect()->to('/faktur?juragan_notfound=' . $juragan);
			}
			$title = $juragans[0]->nama_juragan;

			$id_juragan = $juragans[0]->id_juragan;
		}

		$data = [
			'title' 	=> 'Invoice ' . $title,
			'pesanans' 	=> $this->invoice->ambil_data($id_juragan)->getResult()
		];
		echo view('admin/invoice/lihat', $data);
	}

	// ------------------------------------------------------------------------
	// halaman untuk menyunting invoice verdasarkan $seri
	public function sunting($seri = '')
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		if ($seri === '' or empty($seri)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		} else {
			// cek di database
			$pesanan = $this->invoice->ambil_data()->get()->getResult();
			if (count($pesanan) > 0) {

				$data = [
					'title' 	=> 'Sunting Invoice #' . $seri,
					'pesanans' 	=> $pesanan
				];
				return view('admin/invoice/lihat', $data);
			} else {
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}
		}
	}

	// ------------------------------------------------------------------------
	// hapus invoice
	public function hapus_orderan()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		if ($this->request->isAJAX()) {
			$invoice_id = $this->request->getPost('invoice_id');
			$this->invoice->delete($invoice_id);

			return $this->response->setJSON(['status' => 'Orderan dihapus', 'url' => site_url('admin/invoices')]);
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}

	// ------------------------------------------------------------------------

	public function save()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

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
				$seri = strtoupper(first_letter($t->name) . time());

				$data_invoice = [
					'tanggal_pesan' => $this->request->getPost('tanggal_order'),
					'seri'			=> $seri,
					'pemesan_id' 	=> $this->request->getPost('id_pemesan'),
					'kirimKepada_id' => $this->request->getPost('id_kirimKe'),
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

				$ret = [
					'status' => 'data tersimpan',
					'url' => site_url('admin/invoices/lihat?q=seri:' . $seri)
				];
				return $this->response->setJSON($ret);
			}
		}
	}

	// ------------------------------------------------------------------------

	public function save_progress()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('simpanProgress');
		}

		if ($this->request->isAJAX()) {
			if (!$this->validation->withRequest($this->request)->run()) {

				$this->response->setStatusCode(406);
				$errors = $this->validation->getErrors();

				return $this->response->setJSON($errors);
			} else {
				$invoice_id = $this->request->getPost('id_invoice');
				$status = $this->request->getPost('status');
				$stat = $this->request->getPost('stat'); // if 1 = akhir, 0 = mulai
				$keterangan = $this->request->getPost('keterangan');

				$data = [
					'invoice_id' => $invoice_id,
					'status' 	 => $status,
					'stat' 		 => $stat,
					'keterangan' => ($keterangan !== '' ? $keterangan : NULL)
				];

				// ambil yang terakhir
				$arr = array_slice($this->invoice->status($invoice_id)->getResult(), -1);

				if (empty($arr)) {
					// jika kosong, bikin baru
					$this->_simpan_status($data);

					// update orderan menjadi `diproses` (2)
					$update_invoice = [
						'id_invoice' => $invoice_id,
						'status_pesanan' => '2'
					];
					$this->invoice->save($update_invoice);
				} else {
					// pastinya update yang sudah ada (belum lengkap)
					// atau bikin baru kalau yang terakhir sudah lengkap
					if ($arr[0]->tanggal_selesai === NULL) {
						// update
						$this->_simpan_status($data, $arr[0]->id_status);
					} else {
						// create
						$this->_simpan_status($data);
					}
				}

				return $this->response->setJSON($arr);
			}
		}
	}

	// ------------------------------------------------------------------------

	private function _simpan_status($data, $id_status = FALSE)
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		$db = \Config\Database::connect();
		$builder = $db->table('invoice_status');

		$builder->set('invoice_id', $data['invoice_id']);
		$builder->set('status', $data['status']);
		$builder->set('tanggal_masuk', time());

		if ($data['stat'] === '1') {
			$builder->set('tanggal_selesai', time());
			$builder->set('keterangan_selesai', $data['keterangan']);
		} else {
			$builder->set('keterangan_masuk', $data['keterangan']);
		}

		// 
		if ($id_status === FALSE) {
			$builder->insert();
		} else {
			$builder->where('id_status', $id_status);
			$builder->update();
		}
	}

	// ------------------------------------------------------------------------
	// tambah pembayaran
	public function simpan_pembayaran()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('tambahPembayaran');
		}

		if ($this->request->isAJAX()) {
			if (!$this->validation->withRequest($this->request)->run()) {

				$this->response->setStatusCode(406);
				$errors = $this->validation->getErrors();

				return $this->response->setJSON($errors);
			} else {

				$time = Time::parse($this->request->getPost('tanggal_pembayaran'))->getTimestamp();
				$invoice_id = $this->request->getPost('invoice_id');

				$data = [
					'invoice_id' => $invoice_id,
					'sumber_dana' => $this->request->getPost('sumber_dana'),
					'total_pembayaran' => $this->request->getPost('total_pembayaran'),
					'tanggal_pembayaran' => $time
				];

				$this->pembayaran->save($data);

				// update status pembayaran (invoice)
				$this->_update_status_pembayaran($invoice_id);

				//
				return $this->response->setJSON(['url' => site_url('admin/invoices/lihat/?q=id:' . $invoice_id)]);
			}
		}
	}

	// ------------------------------------------------------------------------
	// update status pembayaran
	public function update_bayar()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

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

				// update status pembayaran (invoice)
				// 
				$this->_update_status_pembayaran($invoice_id);

				$res = [
					'status' => 'data tersimpan',
					'url' 	=> site_url('admin/invoices/lihat?q=id:' . $invoice_id)
				];

				return $this->response->setJSON($res);
			}
		}
	}

	// ------------------------------------------------------------------------

	private function _update_status_pembayaran($invoice_id)
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		$cek = $this->invoice->total_biaya($invoice_id)->getResult()[0];
		// cek yang terbayar dan belum terbayar
		$terbayar = (int) $cek->terbayar;
		$total_bayar = (int) $cek->barang + (int) $cek->lain;
		$belum_bayar = $total_bayar - $terbayar;
		$belum_cek = (int) $cek->belumcek;

		if ($belum_cek > 0) {
			if ($terbayar > 0) { // ada yang belum dicek, tapi sudah ada dana masuk
				$status_bayar = '3';
			} else {
				$status_bayar = '2';
			}
		} else { //  tidak ada yang pelu dicek
			if ($terbayar === 0) {
				$status_bayar = '1';
			} else {
				if ($terbayar === $total_bayar) {
					// sudah lunas
					$status_bayar = '6';
				} elseif ($terbayar < $total_bayar) {
					// masih belum lunas / kredit
					$status_bayar = '4';
				} elseif ($terbayar > $total_bayar) {
					// ada kelebihan
					$status_bayar = '5';
				}
			}
		}

		// update status_pembayaran
		// jadikan status
		$update_invoice = [
			'id_invoice' => $invoice_id,
			'status_pembayaran' => $status_bayar
		];
		$this->invoice->save($update_invoice);

		return TRUE;
	}

	// ------------------------------------------------------------------------

	public function detail_status($invoice_id)
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		if ($this->request->isAJAX()) {
			$arr = array_slice($this->invoice->status($invoice_id)->getResult(), -1);
			return $this->response->setJSON($arr);
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}

	// ------------------------------------------------------------------------

}
