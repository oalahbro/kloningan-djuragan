<?php namespace App\Controllers;

class Ongkir extends BaseController 
{
	public function index()
	{
		if ( ! $this->login->isAuthorized()) {
			return redirect()->to('/auth');
		}

		$nama_cache = 'prov';
		if ( ! $provinsi = cache($nama_cache)) {

			$provinsi = $this->rajaongkir->province()->data;

			// simpan cache selama 365 hari
			cache()->save($nama_cache, $provinsi, 60*60*24*365);
		}

		return $this->response->setJSON($provinsi);
	}

	public function provinsi()
	{
		$id_provinsi = $this->request->getGet('prov');
		$nama_cache = 'provinsi' . (!empty($id_provinsi)? '_'. $id_provinsi: '');

		if ( ! $provinsi = $this->cache->get($nama_cache)) {
			if(!empty($id_provinsi)) {
				$provinsi = $this->rajaongkir->province($id_provinsi)->data;
			}
			else {
				$provinsi = $this->rajaongkir->province()->data;
			}

			// simpan cache selama 365 hari
			$this->cache->save($nama_cache, $provinsi, 60*60*24*365);
		}

		return $this->response->setJSON($provinsi);
	}
  
	public function kota()
	{
		$id_provinsi = $this->request->getGet('prov');
		$id_kota = $this->request->getGet('kota');

		$nama_cache = 'kota_' . $id_provinsi . $id_kota;

		if ( ! $kota = $this->cache->get($nama_cache)) {
			if (! empty($id_provinsi)) {
				$kota = $this->rajaongkir->city($id_provinsi)->data;
				if(!empty($id_kota)) {
					$kota = $this->rajaongkir->city($id_provinsi, $id_kota)->data;
				}

				// simpan cache selama 365 hari
				$this->cache->save($nama_cache, $kota, 60*60*24*365);
			}
		}

		return $this->response->setJSON($kota);
	}
  
	public function kecamatan()
	{
		$id_kota = $this->request->getGet('kota');
		$id_kecamatan = $this->request->getGet('kec');

		$nama_cache = 'kecamatan_' . $id_kota . $id_kecamatan;

		if ( ! $kecamatan = $this->cache->get($nama_cache)) {
			if (! empty($id_kota)) {
				$kecamatan = $this->rajaongkir->subdistrict($id_kota)->data;
				if(!empty($id_kecamatan)) {
					$kecamatan = $this->rajaongkir->subdistrict($id_kota, $id_kecamatan)->data;
				}

				// simpan cache selama 365 hari
				$this->cache->save($nama_cache, $kota, 60*60*24*365);
			}
		}

		return $this->response->setJSON($kecamatan);
	}

	public function get()
	{
		$subdistrict = $this->request->getGet('kec');
		$weight = $this->request->getGet('berat');

		$cost = $this->rajaongkir->cost(['city' => 501], ['subdistrict' => $subdistrict], $weight, 'jne:pos:jnt')->data;
		return $this->response->setJSON($cost);
	}
}
