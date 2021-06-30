<?php

namespace App\Libraries;

use Steevenz\Rajaongkir;

class Ongkir
{
    protected $rajaongkir;
    protected $cache;

    public function __construct()
    {
        $this->rajaongkir = new Rajaongkir(config('JuraganConfig')->rajaongkir, Rajaongkir::ACCOUNT_PRO);
        $this->cache      = \Config\Services::cache();
    }

    public function provinsi($id_provinsi = '')
    {
        $nama_cache = 'provinsi' . (! empty($id_provinsi) ? '_' . $id_provinsi : '');

        if (! $provinsi = $this->cache->get($nama_cache)) {
            if (! empty($id_provinsi)) {
                $provinsi = $this->rajaongkir->getProvince($id_provinsi);
            } else {
                $provinsi = $this->rajaongkir->getProvinces();
            }

            // simpan cache selama 365 hari
            $this->cache->save($nama_cache, $provinsi, 60 * 60 * 24 * 365);
        }

        return $provinsi;
    }

    public function kota($id_provinsi, $id_kota)
    {
        $nama_cache = 'kota_' . $id_provinsi . '_' . $id_kota;

        if (! $kota = $this->cache->get($nama_cache)) {
            if (! empty($id_provinsi)) {
                $kota = $this->rajaongkir->getCities($id_provinsi);

                if (! empty($id_kota)) {
                    $kota = $this->rajaongkir->getCity($id_kota);
                }

                // simpan cache selama 365 hari
                $this->cache->save($nama_cache, $kota, 60 * 60 * 24 * 365);
            }
        }

        return $kota;
    }

    public function kecamatan($id_kota, $id_kecamatan)
    {
        $nama_cache = 'kecamatan_' . $id_kota . '_' . $id_kecamatan;

        if (! $kecamatan = $this->cache->get($nama_cache)) {
            if (! empty($id_kota)) {
                $kecamatan = $this->rajaongkir->getSubdistricts($id_kota);

                if (! empty($id_kecamatan)) {
                    $kecamatan = $this->rajaongkir->getSubdistrict($id_kecamatan);
                }

                // simpan cache selama 365 hari
                $this->cache->save($nama_cache, $kecamatan, 60 * 60 * 24 * 365);
            }
        }

        return $kecamatan;
    }
}
