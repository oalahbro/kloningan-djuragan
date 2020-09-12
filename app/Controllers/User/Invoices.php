<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Invoices extends BaseController
{
    // menampilkan semua invoice
    public function lihat($juragan = '')
    {
        if (!$this->isLogged()) {
            return redirect()->to('/auth');
        } else {
            if ($this->isAdmin()) {
                return redirect()->to('/auth');
            }
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

            $data = [
                'title'     => 'Invoice ' . $title,
                'pesanans'  => $this->invoice->ambil_data()->getResult()
            ];
            echo view('user/invoice/lihat', $data);
        }
        else {
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

}
