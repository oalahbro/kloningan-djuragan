<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
	protected $user;
	public function __construct()
	{
		$this->user = new UserModel();
	}

	public function index()
	{
		$validation = \Config\Services::validation();

		if ($this->isAuthorized())
		{
			return redirect()->to('/faktur');
		}

		if($this->request->getPost()) {
			$validation->setRuleGroup('signin');
		}

		
		if (! $validation->withRequest($this->request)->run()) {
			echo view('publicview/header', ['title' => 'Masuk']);
			echo view('publicview/masuk', ['validation' => $validation]);
			echo view('publicview/footer');
		}
		else
		{
			$dt = $this->user->addNew([
				'username' => $this->request->getPost('username'),
				'password' => $this->request->getPost('password')
			]);
			var_dump( $dt );
		}
	}

	public function daftar()
	{
		$validation = \Config\Services::validation();

		if ($this->isAuthorized())
		{
			return redirect()->to('/faktur');
		}

		if($this->request->getPost()) {
			$validation->setRuleGroup('signup');
		}

		
		if (! $validation->withRequest($this->request)->run()) {
			echo view('publicview/header', ['title' => 'Daftar']);
			echo view('publicview/daftar', ['validation' => $validation]);
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
			
			return redirect()->to('/auth');
		}
	}
}
