<<<<<<< HEAD
<?php namespace App\Controllers;
use CodeIgniter\Controller; 
=======
<?php

namespace App\Controllers;

use CodeIgniter\Controller;
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

class Migrate extends \CodeIgniter\Controller
{
	public function index()
	{
		$migrate = \Config\Services::migrations();

<<<<<<< HEAD
		try
		{
		  $migrate->latest();
		}
		catch (\Exception $e)
		{
=======
		try {
			$migrate->latest();
		} catch (\Exception $e) {
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
			// Do something with the error here...
			echo 'Error';
		}
	}
<<<<<<< HEAD
}
=======
}
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
