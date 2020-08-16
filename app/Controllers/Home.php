<?php namespace App\Controllers;

class Home extends BaseController
{
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
}
