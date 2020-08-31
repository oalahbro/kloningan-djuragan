<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

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
		$data = [
			'title'     => 'Pengaturan Situs',
			'banks'     => $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
		];

		echo view('admin/pengaturan/situs', $data);
	}

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
				'rekening' => $this->request->getPost('nomor_rekening'),
				'atas_nama' => $this->request->getPost('atas_nama')
			]);

			// return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
		}

		return redirect()->to('/admin/settings');
	}

	// ------------------------------------------------------------------------

	public function juragan()
	{
		$builder = $this->juragan->builder();

		$data = [
			'title' 	=> 'Pengaturan Juragan',
			'juragans' 	=> $this->juragan->ambil()->get(),
			'banks' 	=> $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
		];

		echo view('admin/pengaturan/juragan', $data);
	}

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
		}
		return redirect()->to('/admin/settings/juragan');
	}

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
		}
		return redirect()->to('/admin/settings/juragan');
	}

	// ------------------------------------------------------------------------

	public function pengguna()
	{
		$builder = $this->juragan->builder();

		$data = [
			'title' 	=> 'Pengaturan Pengguna',
			'juragans' 	=> $this->juragan->ambil()->get(),
			'penggunas' => $this->user->orderBy('status DESC')->findAll()
		];

		echo view('admin/pengaturan/pengguna', $data);
	}

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
			$db = \Config\Database::connect();

			$level = $this->request->getPost('level');

			$this->user->save([
				'username' 	=> strtolower($this->request->getPost('username')),
				'password' 	=> password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
				'name' 		=> $this->request->getPost('nama'),
				'email' 	=> strtolower($this->request->getPost('email')),
				'level' 	=> $level,
				'status' 	=> $this->request->getPost('status')
			]);
			$id = $db->insertID();

			// simpan ke tabel relasi, selain admin/superadmin
			if ($level === 'superadmin' or $level === 'admin') {
			} else {
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
		}
		return redirect()->to('/admin/settings/pengguna');
	}

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
			$data['email'] = strtolower($this->request->getPost('email'));
			$level = $this->request->getPost('level');
			$data['level'] = strtolower($level);
			$data['status'] = strtolower($this->request->getPost('status'));

			$this->user->save($data);

			// simpan ulang semua data relasi
			if ($db->affectedRows() > -1) {
				// hapus semua relasi 
				$this->relasi->where(['table' => '1', 'val_id' => $id])->delete();

				if ($level === 'superadmin' or $level === 'admin') {
					// tidak ada yang disimpan untuk superadmin / admin
				} else {
					$juragans = $this->request->getPost('juragan');

					foreach ($juragans as $juragan) {
						$this->relasi->insert([
							'table' => 1,
							'juragan_id' => $juragan,
							'val_id' => $id
						]);
					}
				}
			}
		}
		return redirect()->to('/admin/settings/pengguna');
	}

	// ------------------------------------------------------------------------

	public function pengguna_relasi()
	{
		$id = $this->request->getGet('id');

		if (!isset($id) or empty($id) or !is_numeric($id)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		// ambil data relasi 
		$relasi_pengguna = $this->relasi->where(['table' => 1, 'val_id' => $id])->findAll();

		$data = array();
		foreach ($relasi_pengguna as $rel) {
			$data[$rel->id_relasi] = (int) $rel->juragan_id;
		}

		return $this->response->setJSON($data);
	}
}
