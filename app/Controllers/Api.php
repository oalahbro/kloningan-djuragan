<?php

namespace App\Controllers;

class Api extends BaseController
{
	public function __construct()
	{
		$session = \Config\Services::session();

		if ($session->has('logged')) {
			if (!$session->get('logged')) {
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}

	// ------------------------------------------------------------------------

	public function get_juragan()
	{
		$nama_cache = 'list_juragan';
		$i = 0;
		if (!$ngelist = $this->cache->get($nama_cache)) {
			$listJuragan_ = $this->juragan->ambil()->get()->getResult();

			$ngelist = array();
			foreach ($listJuragan_ as $juragan) {
				$ngelist[$i]['id_juragan'] = (int) $juragan->id_juragan;
				$ngelist[$i]['juragan'] = $juragan->juragan;
				$ngelist[$i]['nama_juragan'] = $juragan->nama_juragan;
				$ngelist[$i]['bank'] = json_decode(html_entity_decode($juragan->bank, ENT_QUOTES));

				$i++;
			}

			// simpan cache selama 5 menit
			$this->cache->save($nama_cache, $ngelist, 60 * 5);
		}

		return $this->response->setJSON($ngelist);
	}

	// ------------------------------------------------------------------------

	public function get_pengguna()
	{
		$nama_cache = 'list_admincs';
		if (!$listJuragan = $this->cache->get($nama_cache)) {
			$listJuragan = $this->user->orderBy('name', 'ASC')->findAll();

			// simpan cache selama 5 menit
			$this->cache->save($nama_cache, $listJuragan, 60 * 5);
		}

		return $this->response->setJSON($listJuragan);
	}

	// ------------------------------------------------------------------------

	public function get_kecamatan()
	{
		$kecamatan = $this->rajaongkir->getSubdistricts();

		return $this->response->setJSON($kecamatan);
	}
}
