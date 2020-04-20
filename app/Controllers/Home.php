<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if ( ! $this->isAuthorized())
		{
			return redirect()->to('/auth');
		}

		return view('welcome_message');
	}

	//--------------------------------------------------------------------

}
