<?php namespace App\Controllers;
use CodeIgniter\Controller; 

class Migrate extends \CodeIgniter\Controller
{

	public function index()
	{
		$migrate = \Config\Services::migrations();

		try
		{
		  $migrate->latest();
		}
		catch (\Exception $e)
		{
		  // Do something with the error here...
			echo 'Error';
		}
	}

}