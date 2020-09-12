<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

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

}
