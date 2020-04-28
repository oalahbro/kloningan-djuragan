<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if ( ! $this->login->isAuthorized()) 
		{
			return redirect()->to('/auth');
		}

		return redirect()->to('/faktur');
	}
}
