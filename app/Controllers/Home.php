<?php namespace App\Controllers;

use App\Libraries\Login;

class Home extends BaseController
{
	protected $login;

	public function __construct()
	{
		$this->login = new Login();
	}

	public function index()
	{
		if ( ! $this->login->isAuthorized()) 
		{
			return redirect()->to('/auth');
		}

		return redirect()->to('/faktur');
	}

	//--------------------------------------------------------------------

}
