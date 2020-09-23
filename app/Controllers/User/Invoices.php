<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Invoices extends BaseController
{
	//
	public function tulis()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if ($this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		$data = [
			'title' => 'Tulis Orderan Baru'
		];
		return view('user/invoice/tulis', $data);
	}

	// ------------------------------------------------------------------------

	public function save()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if ($this->isAdmin()) {
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
					'url' => site_url('user/invoices/lihat?q=seri:' . $seri)
				];
				return $this->response->setJSON($ret);
			}
		}
	}

	// ------------------------------------------------------------------------
	// menampilkan semua invoice
	public function lihat($juragan = '', $hal = 'dalam-proses')
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if ($this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		if (!in_array($hal, ['semua', 'cek-bayar', 'dalam-proses', 'belum-proses', 'selesai'])) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$user_id = $this->session->get('id');

		if ($juragan === '') {
			$juragan = $this->juraganBy($user_id);
			return redirect()->to('/user/invoices/lihat/' . $juragan->juragan);
		}

		// diijinkan atau tidak
		if ($this->allowedJuragan($user_id, $juragan)) {
			// 
			$juragans = $this->juragan->where('juragan', $juragan)->findAll();
			$title = $juragans[0]->nama_juragan;
			$id_juragan = $juragans[0]->id_juragan;

			$limit = config('Pager')->perPage;
			$page = (int) $this->request->getGet('page');

			if (!isset($page) || $page === 0 || $page === 1) {
				$page = 1;
				$offset = 0;
			} else {
				$offset = ($page - 1) * $limit;
				$page = $page;
			}

			$data = [
				'title'     => 'Invoice ' . $title,
				'pesanans' 	=> $this->invoice->ambil_data(NULL, $id_juragan, $hal, $limit, $offset)->get()->getResult(),
				'totalPage' => $this->invoice->ambil_data(NULL, $id_juragan, $hal, NULL, NULL)->countAllResults(),
				'juragan' 	=> $juragan,
				'hal' 		=> $hal,
				'limit' 	=> $limit,
				'page' 		=> $page
			];
			echo view('user/invoice/lihat', $data);
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}

	// ------------------------------------------------------------------------
	// tambah pembayaran
	public function simpan_pembayaran()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if ($this->isAdmin()) {
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

	private function _update_status_pembayaran($invoice_id)
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if ($this->isAdmin()) {
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
	// hapus invoice
	public function hapus_orderan()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if ($this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		if ($this->request->isAJAX()) {
			$invoice_id = $this->request->getPost('invoice_id');
			$this->invoice->delete($invoice_id);

			return $this->response->setJSON(['status' => 'Orderan dihapus', 'url' => site_url('user/invoices')]);
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}

	// ------------------------------------------------------------------------

	public function info_pembayaran()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if ($this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		if ($this->request->isAJAX()) {
			$invoice_id = $this->request->getGet('id');
			$x = $this->pembayaran->ambil($invoice_id)->get()->getResult();

			$res = [];

			foreach ($x as $bayar) {
				$res[] = [
					'id' => (int) $bayar->id,
					'nama' => $bayar->nama,
					'atas_nama' => $bayar->atas_nama,
					'nominal' => number_to_currency($bayar->nominal, 'IDR'), //(int) $bayar->nominal,
					'status' => (int) $bayar->status,
					'tanggal_bayar' => (int) $bayar->tanggal_pembayaran,
					'tanggal_cek' => ($bayar->tanggal_cek !== NULL ? (int) $bayar->tanggal_cek : NULL)
				];
			}


			return $this->response->setJSON($res);
		}
	}

	// ------------------------------------------------------------------------

}
