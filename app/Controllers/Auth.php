<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
	protected $user;
	protected $validation;

	public function __construct()
	{
		$this->user = new UserModel();
		$this->validation = \Config\Services::validation();
	}

	public function index()
	{
		if ($this->isAuthorized())
		{
			return redirect()->to('/faktur');
		}

		if($this->request->getPost()) {
			$this->validation->setRuleGroup('signin');
		}
		
		if (! $this->validation->withRequest($this->request)->run()) {
			echo view('publicview/header', ['title' => 'Masuk']);
			echo view('publicview/masuk', ['validation' => $this->validation]);
			echo view('publicview/footer');
		}
		else
		{
			$get = $this->user->where('username', $this->request->getPost('username'))->first();

			if ($get === NULL or empty($get)) {
				$sesi = [
					'logged'	=> FALSE
				];
				$redirect = '/auth/index';
				$status = '<div class="alert alert-danger"><strong class="d-block">Nay!</strong>Kamu siapa? daftar aja dulu.</div>';				
			}
			else {
				if (password_verify($this->request->getPost('password'), $get['password'])) {
					switch ($get['status']) {
						case 'pending':
							$sesi = [
								'logged'	=> FALSE
							];
							$redirect = '/auth/index';
							$status = '<div class="alert alert-warning"><strong class="d-block">Nay!</strong>Kamu sudah terdaftar kok, tapi cek email dulu ya.</div>';
							break;

						case 'blocked':
							$sesi = [
								'logged'	=> FALSE
							];
							$redirect = '/auth/index';
							$status = '<div class="alert alert-danger"><strong class="d-block">Grrrr!</strong>Kamu dilarang masuk.</div>';
							break;

						case 'inactive':
							$sesi = [
								'logged'	=> FALSE
							];
							$redirect = '/auth/index';
							$status = '<div class="alert alert-warning"><strong class="d-block">Nay!</strong>Tunggu validasi dari admin ya, atau hubungi admin segera.</div>';
							break;
						default:
							$sesi = [
								'id'  		=> $get['id'],
								'username'  => $get['username'],
								'email'  	=> $get['email'],
								'level'  	=> $get['level'],
								'logged'	=> TRUE
							];

							$redirect = '/faktur';
							$status = '<div class="alert alert-sucess"><strong class="d-block">Hay!</strong>Jangan lupa bahagia ya.</div>';
							break;
					}
				}
				else {
					$sesi = [
						'logged'	=> FALSE
					];
					$redirect = '/auth/index';
					$status = '<div class="alert alert-warning"><strong class="d-block">Nay!</strong>Kalo sudah nyerah mengingat kata sandi, bilang ya?</div>';
				}
			}

			$this->session->set($sesi);
			return redirect()->to($redirect)->with('status', $status);
		}
	}

	public function daftar()
	{
		if ($this->isAuthorized())
		{
			return redirect()->to('/faktur');
		}

		if($this->request->getPost()) {
			$this->validation->setRuleGroup('signup');
		}

		if (! $this->validation->withRequest($this->request)->run()) {
			echo view('publicview/header', ['title' => 'Daftar']);
			echo view('publicview/daftar', ['validation' => $this->validation]);
			echo view('publicview/footer');
		}
		else
		{
			$this->user->insert([
				'username' => $this->request->getPost('username'),
				'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
				'name' => $this->request->getPost('nama'),
				'email' => $this->request->getPost('email')
			]);
			
			return redirect()->to('/auth/daftar')->with('status', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Kamu sudah terdaftar, cek email dulu ya.</div>');
		}
	}

	public function lupa()
	{
	}

}
