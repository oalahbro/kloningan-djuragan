<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}


	public function bank() {
		$q = $this->input->get('q');
		$this->db->select('bank, COUNT(UPPER(bank)) as count');
		$this->db->from('pesanan');
		if( ! empty($q)) {
			$this->db->like('bank', $q,'both');
		}

		$this->db->group_by('bank');
		$this->db->order_by('count', 'DESC');
		
		//$this->db->limit(10);

		$q = $this->db->get();

		$a = array();
		$i = 0;
		foreach ($q->result() as $r) {
			$a[] = array( 'bank' => $r->bank, 'count' => $r->count);
		}


		$this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json', 'utf-8')
	         ->set_output(json_encode($a, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	         ->_display();
	    exit;


	}

}
