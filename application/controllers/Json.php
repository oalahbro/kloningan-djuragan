<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Json
 *
 * Menampilkan status message
 * 
 * @package 	Juragan
 * @version 	7.0
 * @author 	Toto Prayogo
 * @link 	http://totoprayogo.com
 */
class Json extends CI_Controller {

	/*
	public function __construct() {
    	parent::__construct();
    	if(is_login() !== TRUE) {
			redirect('login');
		}
    }
    */


    public function index() {

    	$response['items'] = array(
    							'Korea Hunter baru saja memasukkan data pesanan baru sejumlah 1pcs',
    							'Orderan Kamu tertinggal dari 3 juragan lainnya',
    							'Limited Shoping baru saja memasukkan data pesanan baru sejumlah 4pcs'
    						);

    	$this->output
	    	 ->set_status_header(200)
	    	 ->set_content_type('application/json', 'utf-8')
	    	 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	    	 ->_display();
    	exit;
    }
}