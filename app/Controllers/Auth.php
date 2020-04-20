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

		if ($this->isAuthorized())
		{
			return redirect()->to('/faktur');
		}

		$validate = [
			'username' => 'required',
			'password' => 'required'
		];
		
		if (! $this->validate($validate))
		{

			echo view('publicview/header', ['title' => 'Masuk']);
			echo view('publicview/masuk', [
				'validation' => $this->validator
			]);
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
		if ($this->isAuthorized())
		{
			return redirect()->to('/faktur');
		}

		$validate = [
			'username' 	=> 'required|min_length[3]|max_length[255]|is_unique[user.username]',
			'password' 	=> 'required',
			'nama' 		=> 'required|min_length[3]|max_length[50]',
			'email'		=> 'required|valid_email|max_length[100]|is_unique[user.email]',
		];
		
		if (! $this->validate($validate))
		{
			echo view('publicview/header', ['title' => 'Daftar']);
			echo view('publicview/daftar', [
				'validation' => $this->validator
			]);
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

	public function uji()
	{
		$userModel = new UserModel();
		try {

			$users = $userModel->where('username', 'adminweb')->findAll();
			// $user = $this->user->->where('username', 'adminweb')->findAll();

			var_dump($users);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}

	
		
		# code...
	}

}
