<?php namespace App\Libraries;

class Login {

	function isAuthorized()
	{
		$session = \Config\Services::session();
		
		if($session->has('logged')) {
			if (! $session->get('logged')) {
				return FALSE;
			}
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

}