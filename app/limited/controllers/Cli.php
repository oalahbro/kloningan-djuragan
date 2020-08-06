<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
        echo "Hello!".PHP_EOL;
    }
    
    public function hapus_notif() {
        $c = $this->db->get_where('notifikasi', array('tanggal < UNIX_TIMESTAMP(NOW() - INTERVAL 3 WEEK )' => NULL))->num_rows();
        if($c > 0) {
            $this->db->delete('notifikasi', array('tanggal < UNIX_TIMESTAMP(NOW() - INTERVAL 3 WEEK )' => NULL));
        }

        $response = array(
            'count' => $c,
            'deleted' => ($c > 0? TRUE: FALSE)
        );

        $this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
    }
}
