<<<<<<< HEAD
<?php namespace App\Controllers;

class Settings extends BaseController
{
	public function index()
	{
		if (! isAuthorized())
		{
			// tidak login, redirect ke halaman auth
			return redirect()->to('/auth');
		}

=======
<?php

namespace App\Controllers;

class Settings extends BaseController
{
	public function __construct()
	{
		$session = \Config\Services::session();

		if ($session->has('logged')) {
			if (!$session->get('logged')) {
				return redirect()->to('/auth');
			}
		} else {
			return redirect()->to('/auth');
		}
	}

	// ------------------------------------------------------------------------

	public function index()
	{
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		$data = [
			'title'     => 'Pengaturan Situs',
			'banks'     => $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
		];

		echo view(base_user() . '/pengaturan/situs', $data);
	}

<<<<<<< HEAD
	public function save_bank()
	{
		if (! isAuthorized()) 
		{
			// tidak login, redirect ke halaman auth
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
=======
	// ------------------------------------------------------------------------

	public function save_bank()
	{
		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('addBank');
		}

		if (!$this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			var_dump($errors);
		} else {
			$tipe = $this->request->getPost('nama_bank');
			$tipe_bank = NULL;
			if (in_array($tipe, ['bca', 'bni', 'mandiri', 'bri'])) {
				$tipe_bank = '1';
			} else if (in_array($tipe, ['edc'])) {
				$tipe_bank = '2';
			}
			$this->bank->insert([
				'nama_bank' => $tipe,
				'tipe_bank' => $tipe_bank,
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
				'rekening' => $this->request->getPost('nomor_rekening'),
				'atas_nama' => $this->request->getPost('atas_nama')
			]);

<<<<<<< HEAD
			return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
		}


		// var_dump($this->request->getPost());

		return redirect()->to('/settings');
	}

	public function juragan()
	{
		if ( ! isAuthorized())
		{
			// tidak login, redirect ke halaman auth
			return redirect()->to('/auth');
		}

=======
			// return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
		}

		return redirect()->to('/settings');
	}

	// ------------------------------------------------------------------------

	public function juragan()
	{
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		$builder = $this->juragan->builder();

		$data = [
			'title' 	=> 'Pengaturan Juragan',
<<<<<<< HEAD
			'juragans' 	=> $this->juragan->ambil()->getResult(),
=======
			'juragans' 	=> $this->juragan->ambil()->get(),
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
			'banks' 	=> $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
		];

		echo view(base_user() . '/pengaturan/juragan', $data);
	}

<<<<<<< HEAD
	public function save_juragan() // new insert
	{
		if (! isAuthorized()) 
		{
			// tidak login, redirect ke halaman auth
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
=======
	// ------------------------------------------------------------------------

	public function save_juragan() // new insert
	{
		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('addJuragan');
		}

		if (!$this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			// var_dump($errors);
		} else {
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
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
<<<<<<< HEAD

			// return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		}
		return redirect()->to('/settings/juragan');
	}

<<<<<<< HEAD
	public function update_juragan() // update if exist
	{
		if (! isAuthorized()) 
		{
			// tidak login, redirect ke halaman auth
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
=======
	// ------------------------------------------------------------------------

	public function update_juragan() // update if exist
	{
		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('editJuragan');
		}

		if (!$this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			var_dump($errors);
		} else {
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
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
<<<<<<< HEAD

			// return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		}
		return redirect()->to('/settings/juragan');
	}

<<<<<<< HEAD
	public function pengguna()
	{
		if ( ! isAuthorized()) 
		{
			// tidak login, redirect ke halaman auth
			return redirect()->to('/auth');
		}

=======
	// ------------------------------------------------------------------------

	public function pengguna()
	{
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		$builder = $this->juragan->builder();

		$data = [
			'title' 	=> 'Pengaturan Pengguna',
<<<<<<< HEAD
			'juragans' 	=> $this->juragan->ambil()->getResult(),
=======
			'juragans' 	=> $this->juragan->ambil()->get(),
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
			'penggunas' => $this->user->orderBy('status DESC')->findAll()
		];

		echo view(base_user() . '/pengaturan/pengguna', $data);
	}

<<<<<<< HEAD
	public function save_pengguna() // new insert
	{
		if (! isAuthorized()) 
		{
			// tidak login, redirect ke halaman auth
			return redirect()->to('/auth');
		}

		if($this->request->getPost()) {
			$this->validation->setRuleGroup('addPengguna');
		}

		if ( ! $this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			// var_dump($errors);
		}
		else {
=======
	// ------------------------------------------------------------------------

	public function save_pengguna() // new insert
	{
		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('addPengguna');
		}

		if (!$this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			var_dump($errors);
		} else {
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
			$db = \Config\Database::connect();

			$level = $this->request->getPost('level');

			$this->user->save([
<<<<<<< HEAD
				'username' 	=> strtolower( $this->request->getPost('username') ),
				'password' 	=> password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
				'name' 		=> $this->request->getPost('nama'),
				'email' 	=> strtolower( $this->request->getPost('email') ),
=======
				'username' 	=> strtolower($this->request->getPost('username')),
				'password' 	=> password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
				'name' 		=> $this->request->getPost('nama'),
				'email' 	=> strtolower($this->request->getPost('email')),
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
				'level' 	=> $level,
				'status' 	=> $this->request->getPost('status')
			]);
			$id = $db->insertID();

			// simpan ke tabel relasi, selain admin/superadmin
<<<<<<< HEAD
			if ($level === 'superadmin' OR $level === 'admin') {
			}
			else {
=======
			if ($level === 'superadmin' or $level === 'admin') {
			} else {
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
				$juragans = $this->request->getPost('juragan');

				if ($db->affectedRows() > 0) {
					foreach ($juragans as $juragan) {
						$this->relasi->insert([
							'table' => 1,
							'juragan_id' => $juragan,
							'val_id' => $id
						]);
					}
				}
			}
<<<<<<< HEAD
			
			// return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		}
		return redirect()->to('/settings/pengguna');
	}

<<<<<<< HEAD
	public function update_pengguna() // update if exist
	{
		if (! isAuthorized()) 
		{
			// tidak login, redirect ke halaman auth
			return redirect()->to('/auth');
		}

		if($this->request->getPost()) {
			$this->validation->setRuleGroup('editPengguna');
		}

		if ( ! $this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			var_dump($errors);
		}
		else {
=======
	// ------------------------------------------------------------------------

	public function update_pengguna() // update if exist
	{
		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('editPengguna');
		}

		if (!$this->validation->withRequest($this->request)->run()) {
			$errors = $this->validation->getErrors();

			var_dump($errors);
		} else {
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
			$db = \Config\Database::connect();

			$juragans = $this->request->getPost('juragan');
			$id = $this->request->getPost('id');

			$data = array();
			$password = $this->request->getPost('password');
			if (!empty($password) || isset($password)) {
				$data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
			}

			$data['id'] = $this->request->getPost('id');
			$data['name'] = $this->request->getPost('nama');
<<<<<<< HEAD
			$data['email'] = strtolower( $this->request->getPost('email') );
			$level = $this->request->getPost('level');
			$data['level'] = strtolower( $level );
			$data['status'] = strtolower( $this->request->getPost('status') );
=======
			$data['email'] = strtolower($this->request->getPost('email'));
			$level = $this->request->getPost('level');
			$data['level'] = strtolower($level);
			$data['status'] = strtolower($this->request->getPost('status'));
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

			$this->user->save($data);

			// simpan ulang semua data relasi
			if ($db->affectedRows() > -1) {
				// hapus semua relasi 
				$this->relasi->where(['table' => '1', 'val_id' => $id])->delete();

<<<<<<< HEAD
				if ($level === 'superadmin' OR $level === 'admin') {
					// tidak ada yang disimpan untuk superadmin / admin
				}
				else {
					$juragans = $this->request->getPost('juragan');
				
=======
				if ($level === 'superadmin' or $level === 'admin') {
					// tidak ada yang disimpan untuk superadmin / admin
				} else {
					$juragans = $this->request->getPost('juragan');

>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
					foreach ($juragans as $juragan) {
						$this->relasi->insert([
							'table' => 1,
							'juragan_id' => $juragan,
							'val_id' => $id
						]);
					}
<<<<<<< HEAD
					
				}
			}


			// return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
=======
				}
			}
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		}
		return redirect()->to('/settings/pengguna');
	}

<<<<<<< HEAD
	public function pengguna_relasi()
	{
		if ( ! isAuthorized()) 
		{
			// tidak login, redirect ke halaman auth
			return redirect()->to('/auth');
		}

		$id = $this->request->getGet('id');

		if ( ! isset($id) OR empty($id) OR ! is_numeric($id)) {
=======
	// ------------------------------------------------------------------------

	public function pengguna_relasi()
	{
		$id = $this->request->getGet('id');

		if (!isset($id) or empty($id) or !is_numeric($id)) {
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		// ambil data relasi 
		$relasi_pengguna = $this->relasi->where(['table' => 1, 'val_id' => $id])->findAll();

		$data = array();
		foreach ($relasi_pengguna as $rel) {
			$data[$rel->id_relasi] = (int) $rel->juragan_id;
<<<<<<< HEAD
		}		
=======
		}
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

		return $this->response->setJSON($data);
	}
}
