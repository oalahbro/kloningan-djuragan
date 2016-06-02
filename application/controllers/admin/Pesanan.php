<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

	public function __construct() {
    	parent::__construct();
    	if(is_login() === TRUE) {
			if((is_user_level('admin') === TRUE) || (is_user_level('superadmin') === TRUE)) {
				redirect('admin');
			}
			else {
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