<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * logout.php
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		1.x.x
 */

class Logout extends CI_Controller {

	public function index() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		
		redirect('login');
	}

}