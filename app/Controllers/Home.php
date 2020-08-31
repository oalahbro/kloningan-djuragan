<?php namespace App\Controllers;

class Home extends BaseController
{
<<<<<<< HEAD
	public function index()
	{
		return view('welcome_message');
	}

	//--------------------------------------------------------------------

=======
	/*
	 * halaman default index
	 * 
	 */
	public function index()
	{
		if ( ! isAuthorized()) 
		{
			// tidak login, redirect ke halaman auth
			return redirect()->to('/auth');
		}

		// default redirect ke halaman invoice
		return redirect()->to('/invoices');
	}
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
}
