<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Settings extends BaseController
{
	public function index()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		$data = [
			'title'     => 'Pengaturan Situs',
			'banks'     => $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
		];

		echo view('admin/pengaturan/situs', $data);
	}

	// ------------------------------------------------------------------------

	public function save_bank()
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

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
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		$data = [
			'title' 	=> 'Pengaturan Juragan',
			'banks' 	=> $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
		];

		echo view('admin/pengaturan/juragan', $data);
	}

	// ------------------------------------------------------------------------

	public function save_juragan() // new insert
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

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

			// simpan ke tabel relasi (juragan-bank)
			if ($db->affectedRows() > 0) {
				foreach ($banks as $bank) {
					$this->relasi->insert([
						'table' => 2, // juragan-bank
						'juragan_id' => $id,
						'val_id' => $bank
					]);
				}
			}
			// simpan relasi untuk semua admin / superadmin

		}
		return redirect()->to('/admin/settings/juragan');
	}

	// ------------------------------------------------------------------------

	public function update_juragan() // update if exist
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

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
						'table' => 2, // juragan-bank
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
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

		$data = [
			'title' 	=> 'Pengaturan Pengguna'
		];

		echo view('admin/pengaturan/pengguna', $data);
	}

	// ------------------------------------------------------------------------

	public function save_pengguna() // new insert
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

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


			$juragans = $this->request->getPost('juragan');

			if ($db->affectedRows() > 0) {
				foreach ($juragans as $juragan) {
					$this->relasi->insert([
						'table' => 1, // juragan-user
						'juragan_id' => $juragan,
						'val_id' => $id
					]);
				}
			}
		}
		return redirect()->to('/admin/settings/pengguna');
	}

	// ------------------------------------------------------------------------

	public function update_pengguna() // update if exist
	{
		if (!$this->isLogged()) {
			return redirect()->to('/auth');
		} else {
			if (!$this->isAdmin()) {
				return redirect()->to('/auth');
			}
		}

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

				$juragans = $this->request->getPost('juragan');

				foreach ($juragans as $juragan) {
					$this->relasi->insert([
						'table' => 1, // juragan-user
						'juragan_id' => $juragan,
						'val_id' => $id
					]);
				}
			}
		}
		return redirect()->to('/admin/settings/pengguna');
	}

	// ------------------------------------------------------------------------

}
