<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	if(is_login() !== TRUE) {
    		redirect('login');
    	}
    	else {
			if(is_user_level('user') === TRUE) {
				redirect('juragan');
			}
		}
    }


	public function create() {
	}

	public function read() {
	}

	public function update() {
	}

	public function delete() {
	}
}