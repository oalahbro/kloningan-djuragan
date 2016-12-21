<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}


	public function bank() {
		$q = $this->input->get('q');
		$juragan = $this->input->get('juragan');

		$juragan_id = $this->juragan->ambil_juragan_id_by_username($juragan);
		
		$this->db->select('bank, COUNT(UPPER(bank)) as count');
		$this->db->from('pesanan');

		if( ! empty($q)) {
			$this->db->like('bank', $q,'both');
		}
		if( ! empty($juragan)) {
			$this->db->where('juragan_id', $juragan_id);
		}

		$this->db->group_by('UPPER(bank)');
		$this->db->order_by('count', 'DESC');
		
		$q = $this->db->get();

		$a = array();
		$i = 0;
		foreach ($q->result() as $r) {
			$a[] = array( 'bank' => strtoupper($r->bank), 'count' => $r->count);
		}

		$this->output
	         ->set_status_header(200)
	         ->set_content_type('application/json', 'utf-8')
	         ->set_output(json_encode($a, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	         ->_display();
	    exit;


	}

}
