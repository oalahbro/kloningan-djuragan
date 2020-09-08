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

    public function cari()
    {
        if (!$this->isLogged()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // if ($this->request->isAJAX()) {
        // } else {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        $match = $this->request->getGet('q');
        $pelanggan     = new PelangganModel();
        $ongkir = new Ongkir();

        $builder = $pelanggan->builder();
        if ($this->request->getVar('q') && $match !== null) {
            $builder->like('nama_pelanggan', $match, 'both');
            $builder->orLike('hp', $match, 'both');
        }
        $builder->limit(10);

        $s = [];
        $i = 0;
        foreach ($builder->get()->getResult() as $u) {
            $s[$i] = [
                'id'    => (int) $u->id_pelanggan,
                'nama'  => $u->nama_pelanggan,
                'hp'    => json_decode($u->hp),
                'cod'   => (int) $u->cod,
                'full'  => 'C.O.D'

            ];

            if ($u->cod === '0') {

                $id_kecamatan = (int) $u->kecamatan;
                $id_kabupaten = (int) $u->kabupaten;
                $id_provinsi = (int) $u->provinsi;

                $kota = $ongkir->kota($id_provinsi, $id_kabupaten);

                $nama_kecamatan = strtoupper($ongkir->kecamatan($id_kabupaten, $id_kecamatan)['subdistrict_name']);
                $nama_kabupaten = strtoupper(($kota['type'] === 'Kabupaten' ? '' : '(Kota) ') . $kota['city_name']);
                $nama_provinsi = strtoupper($ongkir->provinsi($id_provinsi)['province']);

                $s[$i]['nama_kecamatan'] = $nama_kecamatan;
                $s[$i]['kecamatan']     = $id_kecamatan;
                $s[$i]['nama_kabupaten'] = $nama_kabupaten;
                $s[$i]['kabupaten']     = $id_kabupaten;
                $s[$i]['nama_provinsi'] = $nama_provinsi;
                $s[$i]['provinsi']      = $id_provinsi;
                $s[$i]['alamat']        = $u->alamat;
                $s[$i]['kodepos']       = $u->kodepos;
                $s[$i]['full']          = $u->alamat . ', ' . $nama_kecamatan . ', ' . $nama_kabupaten . ', ' . $nama_provinsi . ' - ' . $u->kodepos;
            }

            $i++;
        }

        $return = [
            'query'     => $match,
            'results'   => $s
        ];

        return $this->response->setJSON($return);
    }

    // ------------------------------------------------------------------------

}
