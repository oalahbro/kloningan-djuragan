<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * admin/Pesanan.php
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		6.0.0
 */

class Pesanan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        if( ! is_login()) {
        	redirect('login');
        }
        else {
			if(is_user('user')) {
				redirect('user');
			}
		}
    }

	public function index() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		
		redirect('login');
	}

}