<<<<<<< HEAD
<?php namespace App\Controllers;

use App\Libraries\Ongkir;

class Rajaongkir extends BaseController 
=======
<?php

namespace App\Controllers;

use App\Libraries\Ongkir;

class Rajaongkir extends BaseController
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
{
	public function index()
	{
		$data = array(
			'data' => 'not valid'
		);

		return $this->response->setJSON($data);
	}

<<<<<<< HEAD
=======
	// ------------------------------------------------------------------------

>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
	public function provinsi()
	{
		$id_provinsi = $this->request->getGet('prov');

		$ongkir = new Ongkir();
<<<<<<< HEAD
        $provinsi = $ongkir->provinsi($id_provinsi);

		return $this->response->setJSON($provinsi);
	}
  
=======
		$provinsi = $ongkir->provinsi($id_provinsi);

		return $this->response->setJSON($provinsi);
	}

	// ------------------------------------------------------------------------

>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
	public function kota()
	{
		$id_provinsi = $this->request->getGet('prov');
		$id_kota = $this->request->getGet('kota');

		$ongkir = new Ongkir();
<<<<<<< HEAD
        $kota = $ongkir->kota($id_provinsi, $id_kota);

		return $this->response->setJSON($kota);
	}
  
=======
		$kota = $ongkir->kota($id_provinsi, $id_kota);

		return $this->response->setJSON($kota);
	}

	// ------------------------------------------------------------------------

>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
	public function kecamatan()
	{
		$id_kota = $this->request->getGet('kota');
		$id_kecamatan = $this->request->getGet('kec');

		$ongkir = new Ongkir();
<<<<<<< HEAD
        $kecamatan = $ongkir->kecamatan($id_kota, $id_kecamatan);

		return $this->response->setJSON($kecamatan);
	}
=======
		$kecamatan = $ongkir->kecamatan($id_kota, $id_kecamatan);

		return $this->response->setJSON($kecamatan);
	}
	
	// ------------------------------------------------------------------------
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

	public function get()
	{
		$subdistrict = $this->request->getGet('kec');
		$weight = $this->request->getGet('berat');

		$cost = $this->rajaongkir->cost(['city' => 501], ['subdistrict' => $subdistrict], $weight, 'jne:pos:jnt')->data;
		return $this->response->setJSON($cost);
	}
}
