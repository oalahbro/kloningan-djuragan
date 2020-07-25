<?php namespace App\Controllers;

class Settings extends BaseController
{
	public function index()
	{
		if (! isAuthorized())
		{
			return redirect()->to('/auth');
		}

		$data = [
			'title'     => 'Pengaturan Situs',
			'banks'     => $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
		];

		echo view(base_user() . '/pengaturan/situs', $data);
	}

	public function save_bank()
	{
		if (! isAuthorized()) 
		{
			return redirect()->to('/auth');
		}

		if($this->request->getPost()) {
			$this->validation->setRuleGroup('addBank');
		}


		if ( ! $this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			// var_dump($errors);
		}
		else {
			$this->bank->insert([
				'nama_bank' => $this->request->getPost('nama_bank'),
				'rekening' => $this->request->getPost('nomor_rekening'),
				'atas_nama' => $this->request->getPost('atas_nama')
			]);

			return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
		}


		// var_dump($this->request->getPost());

		return redirect()->to('/settings');
	}

	public function juragan()
	{
		if ( ! isAuthorized()) {
			return redirect()->to('/auth');
		}

		$builder = $this->juragan->builder();

		$data = [
			'title' 	=> 'Pengaturan Juragan',
			'juragans' 	=> $this->juragan->ambil()->getResult(),
			'banks' 	=> $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
		];

		echo view(base_user() . '/pengaturan/juragan', $data);
	}

	public function save_juragan() // new insert
	{
		if (! isAuthorized()) 
		{
			return redirect()->to('/auth');
		}

		if($this->request->getPost()) {
			$this->validation->setRuleGroup('addJuragan');
		}

		if ( ! $this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			// var_dump($errors);
		}
		else {
			$db = \Config\Database::connect();

			$nama_juragan = $this->request->getPost('nama_juragan');
			$banks = $this->request->getPost('bank');

			$this->juragan->save([
				'juragan' => random_string('sha1', 40), // url_title( $nama_juragan, '-', TRUE ),
				'nama_juragan' => $nama_juragan
			]);
			$id = $db->insertID();

			// simpan ke tabel relasi
			if ($db->affectedRows() > 0) {
				foreach ($banks as $bank) {
					$this->relasi->insert([
						'table' => 2,
						'juragan_id' => $id,
						'val_id' => $bank
					]);
				}
			}

			// return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
		}
		return redirect()->to('/settings/juragan');
	}

	public function update_juragan() // update if exist
	{
		if (! isAuthorized()) 
		{
			return redirect()->to('/auth');
		}

		if($this->request->getPost()) {
			$this->validation->setRuleGroup('editJuragan');
		}

		if ( ! $this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			// var_dump($errors);
		}
		else {
			$db = \Config\Database::connect();

			$banks = $this->request->getPost('bank');
			$id_juragan = $this->request->getPost('id');
			$nama_juragan = $this->request->getPost('nama_juragan');

			$this->juragan->save([
				'id_juragan' => $id_juragan,
				// 'juragan' => url_title( $nama_juragan, '-', TRUE ),
				'nama_juragan' => $nama_juragan
			]);

			// hapus semua tabel relasi
			$this->relasi->where(['table' => '2', 'juragan_id' => $id_juragan])->delete();

			// simpan ulang semua data relasi
			if ($db->affectedRows() > -1) {
				foreach ($banks as $bank) {
					$this->relasi->insert([
						'table' => 2,
						'juragan_id' => $id_juragan,
						'val_id' => $bank
					]);
				}
			}

			// return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
		}
		return redirect()->to('/settings/juragan');
	}

	public function pengguna()
	{
	}
}
