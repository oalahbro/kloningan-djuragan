<?php

namespace App\Controllers;

use App\Libraries\Ongkir;
use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    public function baru()
    {
        if (!$this->isLogged()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->isAJAX()) {

            $ongkir = new Ongkir();
            $pelanggan     = new PelangganModel();

            $d['nama_pelanggan'] = strtoupper($this->request->getPost('nama_pelanggan'));
            $d['hp']            = json_encode(array_filter($this->request->getPost('hp')));

            $cod = $this->request->getVar('cod');
            $cod = ($cod === NULL ? '0' : '1');

            $d['cod']           = $cod;
            if ($cod === '1') {
                $d['kecamatan']     = NULL;
                $d['kabupaten']     = NULL;
                $d['provinsi']      = NULL;
                $d['alamat']        = NULL;
                $d['kodepos']       = NULL;
            } else {
                $d['kecamatan']     = $this->request->getPost('kecamatan');
                $d['kabupaten']     = $this->request->getPost('kabupaten');
                $d['provinsi']      = $this->request->getPost('provinsi');
                $d['alamat']        = strtoupper($this->request->getPost('alamat'));
                $d['kodepos']       = $this->request->getPost('kodepos');
            }

            if ($this->request->getVar('id_pelanggan')) {
                $d['id_pelanggan'] = (int) $this->request->getPost('id_pelanggan');
            }

            $pelanggan->save($d);

            if ($this->request->getVar('id_pelanggan')) {
                $id = (int) $this->request->getPost('id_pelanggan');
            } else {
                $db = \Config\Database::connect();
                $id = $db->insertID();
            }

            $result = $pelanggan->ambil($id)->getFirstRow();
            $kota = $ongkir->kota($result->provinsi, $result->kabupaten);

            $r['id_pelanggan'] = (int) $result->id_pelanggan;
            $r['hp'] = json_decode($result->hp);
            $r['nama_pelanggan'] = $result->nama_pelanggan;
            $r['cod'] = $result->cod;

            if ($result->cod === '0') {
                $r['nama_kecamatan'] = strtoupper($ongkir->kecamatan($result->kabupaten, $result->kecamatan)['subdistrict_name']);
                $r['kecamatan'] = (int) $result->kecamatan;
                $r['nama_kabupaten'] = strtoupper(($kota['type'] === 'Kabupaten' ? '' : '(Kota) ') . $kota['city_name']);
                $r['kabupaten'] = (int) $result->kabupaten;
                $r['nama_provinsi'] = strtoupper($ongkir->provinsi($result->provinsi)['province']);
                $r['provinsi'] = (int) $result->provinsi;
                $r['alamat'] = $result->alamat;
                $r['kodepos'] = $result->kodepos;
            }

            return $this->response->setJSON($r);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // ------------------------------------------------------------------------

}
