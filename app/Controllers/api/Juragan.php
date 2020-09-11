<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
// use CodeIgniter\HTTP\Response;

class Juragan extends \CodeIgniter\Controller
{
	use ResponseTrait;

	public function all()
	{
		$juragan = new \App\Models\JuraganModel();
		$cache = \Config\Services::cache();

		// $response = service('response');

		$nama_cache = 'all_juragan';
		if (!$json = $cache->get($nama_cache)) {
			$x = $juragan->findAll();

			$json = [];
			foreach ($x as $a) {
				$list_bank = [];
				$banks = $juragan->ambil_bank($a->id_juragan)->getResult();
				foreach ($banks as $b) {
					$list_bank[$b->id_bank] = [
						'id' => (int) $b->id_bank,
						'nama' => $b->nama_bank,
						'tipe' => $b->tipe_bank,
						'rekening' => $b->rekening,
						'atas_nama' => $b->atas_nama
					];
				}

				$json[$a->id_juragan] = [
					'id' => (int) $a->id_juragan,
					'nama' => $a->nama_juragan,
					'slug' => $a->juragan,
					'bank' => $list_bank
				];
			}

			// simpan cache selama 30 menit
			$cache->save($nama_cache, $json, 60 * 1);
		}

		

		// Respond with 201 status code
		// $this->response->setHeader('Content-type', 'application/json; charset=UTF-8');
		return $this->respond($json);
		// return $this->response->setJSON($json);
		// header('Content-type:application/json; charset=UTF-8');
		
		// $response->setHeader('Content-type', 'application/json; charset=UTF-8'); //->setContentType('application/json');
		// return json_encode($json);
	}

	public function by_user()
	{
		$juragan = new \App\Models\JuraganModel();
		$cache = \Config\Services::cache();

		$user_id = $this->request->getGet('id'); // numeric
		$bank = $this->request->getGet('bank'); // yes = true

		$nama_cache = 'juragan_by_user_' . $user_id . ($bank === 'yes' ? '_bank' : '');
		if (!$json = $cache->get($nama_cache)) {
			$x = $juragan->byUserId($user_id)->getResult();

			$json = [];
			$juragans = [];
			foreach ($x as $a) {
				$list_bank = [];
				if ($bank === 'yes') {
					$banks = $juragan->ambil_bank($a->id_juragan)->getResult();
					foreach ($banks as $b) {
						$list_bank[$b->id_bank] = [
							'id' => (int) $b->id_bank,
							'nama' => $b->nama_bank,
							'tipe' => $b->tipe_bank,
							'rekening' => $b->rekening,
							'atas_nama' => $b->atas_nama
						];
					}
				}

				$juragans[$a->id_juragan] = [
					'id' => (int) $a->id_juragan,
					'nama' => $a->nama_juragan,
					'slug' => $a->juragan
				];

				if ($bank === 'yes') {
					$juragans[$a->id_juragan]['bank'] = $list_bank;
				}

				$json[$a->user_id] = [
					'id' => (int) $a->user_id,
					'nama' => $a->nama_user,
					'username' => $a->username,
					'email' => $a->email,
					'juragan' => $juragans

				];
			}

			// simpan cache selama 30 menit
			$cache->save($nama_cache, $json, 60 * 30);
		}

		return $this->response->setJSON($json);
	}
}
