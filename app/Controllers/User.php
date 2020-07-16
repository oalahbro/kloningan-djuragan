<?php namespace App\Controllers;

class User extends BaseController 
{
	public function index()
	{
		$data = array(
			'data' => 'not valid'
		);

		return $this->response->setJSON($data);
	}

	public function sunting()
	{
		# code...
	}

}
