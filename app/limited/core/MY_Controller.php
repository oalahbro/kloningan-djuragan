<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();		
	}
}


class public_controller extends MY_Controller {
    public function __construct() {
    	parent::__construct();
    	if($this->session->logged) {
    		if($this->session->level === 'admin' OR $this->session->level === 'superadmin') {
				redirect('admin');
			}
			elseif($this->session->level === 'reseller') {
				redirect('pesanan');
			}
			else {
				// ambil juragan yg diijinkan berdasarkan slug
				$user_slug = $this->session->username;
				$juragan = $this->pengguna->_juragan_terakhir($user_slug);
				$juragan = $this->juragan->_slug($juragan);
				redirect($juragan);
			}
		}
    }
}


class admin_controller extends MY_Controller {
	public function __construct() {
		parent::__construct();

		if($this->session->logged) {
			if($this->session->level === 'cs') {
				$user_slug = $this->session->username;
				$juragan = $this->pengguna->_juragan_terakhir($user_slug);
				$juragan = $this->juragan->_slug($juragan);
				redirect($juragan);
			}
			else if($this->session->level === 'reseller') {
				redirect('pesanan');
			}
		}
		else {
			redirect('');
		}
	}
}

class user_controller extends MY_Controller {
	public function __construct() {
		parent::__construct();

		if($this->session->logged) {
			if($this->session->level !== 'cs') {
				redirect('');
			}
		}
		else {
			redirect('');
		}
	}
}

class reseller_controller extends MY_Controller {
	public function __construct() {
		parent::__construct();

		if($this->session->logged) {
			if($this->session->level !== 'reseller') {
				redirect('');
			}
		}
		else {
			redirect('');
		}
	}
}