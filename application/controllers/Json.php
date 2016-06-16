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
    	$response['date'] = date('dmYhis');

    	$array2 = array('');
    	$array3 = array('');

    	$arr = array_merge($this->input_hari_ini(), $array2,$array3);

    	$response['items'] = $arr;

    	$this->output
	    	 ->set_status_header(200)
	    	 ->set_content_type('application/json', 'utf-8')
	    	 ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	    	 ->_display();
    	exit;
    }

    public function status_ranking() {
    	$array = array();
    }

    public function input_hari_ini() {
    	$array = array();

    	$kecuali_user_id = data_session('id');
    	$q = $this->pesanan->today_input($kecuali_user_id);

    	if($q->num_rows() > 0) {
	    	foreach ($q->result() as $key ) {
	    		$array[] = $key->nama . ' udah masukin ' . $key->jumlah_pesanan . ' data closingan hari ini dengan total pesanan sebanyak ' .  $key->total_pesanan . 'pcs.';
	    	}
	    }
	    else {
	    	$gak_ada_data = array(
				"Kok sepi sih datanya ? Kamu ngapain aja nih ..",
				"Udah ngiklan belum ?",
				"Semangat lagi ya, masak datanya kosong begini.",
				"Kepo boleh kan ? data closingan nya mana bos ?",
				"Dari kemarin sepi banget, kamu kemana aja kok gak ngisi data ?",
				"Stock nya numpuk tuh, ayo sikat abis."
			);

	    	$array[] = random_element($gak_ada_data);
	    }
    	shuffle($array);
    	return $array;
    }




}