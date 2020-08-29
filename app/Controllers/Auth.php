<?php

namespace App\Controllers;

class Auth extends BaseController
{

	// ------------------------------------------------------------------------

	public function index()
	{
		// cek sudah login atau belum
		// kalo sudah redirect
		if ($this->isLogged()) {
			// redirect 
			if ($this->isAdmin()) {
				$redirect = 'admin';
			}
			else {
				$redirect = 'user';
			}

			return redirect()->to($redirect);
		}

		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('signin');
		}

		if (!$this->validation->withRequest($this->request)->run()) {
			$data = [
				'title' => 'Masuk',
				'validation' => $this->validation
			];
			echo view('masuk', $data);
		} else {
			$get = $this->user->where('username', $this->request->getPost('username'))->first();

			if ($get === NULL or empty($get)) {
				$arr = [
					'sesi' => [
						'logged' => FALSE
					],
					'redirect' => '/auth/index',
					'status' => '<div class="alert alert-danger"><strong class="d-block">Nay!</strong>Kamu siapa? daftar aja dulu.</div>'
				];
			} else {
				$post_pswd = $this->request->getPost('password');
				// cek length password in db
				if (strlen($get->password) === 32) {
					// jika password gunakan md5()
					// ini berguna untuk edit password lewat phpmyadmin

					if (md5($post_pswd) === $get->password) {
						// jika password sama
						$arr = $this->_pass($get, $post_pswd);
					}
				} else {
					if (password_verify($this->request->getPost('password'), $get->password)) {
						// jika password menggunakan password_hash()
						$arr = $this->_pass($get);
					} else {
						$arr = [
							'sesi' => [
								'logged' => FALSE
							],
							'redirect' => '/auth/index',
							'status' => '<div class="alert alert-warning"><strong class="d-block">Nay!</strong>Ingat lagi apa kata sandimu, ku tungguin deh.</div>'
						];
					}
				}
			}

			$this->session->set($arr['sesi']);
			return redirect()->to($arr['redirect'])->with('status', $arr['status']);
		}
	}

	// ------------------------------------------------------------------------

	protected function _pass($db, $password_to_update = FALSE)
	{
		switch ($db->status) {
			case 'pending':
				$arr = [
					'sesi' => [
						'logged' => FALSE
					],
					'redirect' => '/auth/index',
					'status' => '<div class="alert alert-warning"><strong class="d-block">Nay!</strong>Kamu sudah terdaftar kok, tapi cek email dulu ya.</div>'
				];
				break;

			case 'blocked':
				$arr = [
					'sesi' => [
						'logged' => FALSE
					],
					'redirect' => '/auth/index',
					'status' => '<div class="alert alert-danger"><strong class="d-block">Grrrr!</strong>Kamu dilarang masuk.</div>'
				];
				break;

			case 'inactive':
				$arr = [
					'sesi' => [
						'logged' => FALSE
					],
					'redirect' => '/auth/index',
					'status' => '<div class="alert alert-warning"><strong class="d-block">Nay!</strong>Tunggu validasi dari admin ya, atau hubungi admin segera.</div>'
				];

				break;
			default:
				// save for update `login_terakhir`
				$data['id'] 			= $db->id;
				$data['login_terakhir'] = now();

				// jika password dari md5() perlu diupdate
				if ($password_to_update !== FALSE) {
					$data['password'] 	= password_hash($password_to_update, PASSWORD_BCRYPT);
				}

				$this->user->save($data);

				$arr = [
					'sesi' => [
						'id'  		=> $db->id,
						'username'  => $db->username,
						'name'  	=> $db->name,
						'email'  	=> $db->email,
						'level'  	=> $db->level,
						'logged'	=> TRUE
					],
					'redirect' => '/invoices',
					'status' => '<div class="alert alert-sucess"><strong class="d-block">Hay!</strong>Jangan lupa bahagia ya.</div>'
				];
				break;
		}

		return $arr;
	}

	// ------------------------------------------------------------------------

	public function daftar()
	{
		// cek sudah login atau belum
		// kalo sudah redirect
		if ($this->isLogged()) {
			// redirect 
			if ($this->isAdmin()) {
				$redirect = 'admin';
			}
			else {
				$redirect = 'user';
			}

			return redirect()->to($redirect);
		}

		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('signup');
		}

		if (!$this->validation->withRequest($this->request)->run()) {
			$data = [
				'title' => 'Daftar',
				'validation' => $this->validation
			];
			echo view('daftar', $data);
		} else {
			$this->user->insert([
				'username' => $this->request->getPost('username'),
				'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
				'name' => $this->request->getPost('nama'),
				'email' => $this->request->getPost('email')
			]);

			return redirect()->to('/auth/daftar')->with('status', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Kamu sudah terdaftar, cek email dulu ya.</div>');
		}
	}

	// ------------------------------------------------------------------------

	public function lupa()
	{
		// cek sudah login atau belum
		// kalo sudah redirect
		if ($this->isLogged()) {
			// redirect 
			if ($this->isAdmin()) {
				$redirect = 'admin';
			}
			else {
				$redirect = 'user';
			}

			return redirect()->to($redirect);
		}

		if ($this->request->getPost()) {
			$this->validation->setRuleGroup('forgot');
		}

		if (!$this->validation->withRequest($this->request)->run()) {
			$data = [
				'title' => 'Lupa Sandi',
				'validation' => $this->validation
			];
			echo view('lupa', $data);
		} else {
			$this->user->insert([
				'username' => $this->request->getPost('username'),
				'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
				'name' => $this->request->getPost('nama'),
				'email' => $this->request->getPost('email')
			]);

			return redirect()->to('/auth/daftar')->with('status', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Kamu sudah terdaftar, cek email dulu ya.</div>');
		}
	}

	// ------------------------------------------------------------------------

	public function keluar()
	{
		// hapus sesion
		$this->session->destroy();
		return redirect()->to('/');
	}

	// ------------------------------------------------------------------------
	
}
