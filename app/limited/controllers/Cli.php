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
        // SELECT * FROM `notifikasi` WHERE tanggal < UNIX_TIMESTAMP(NOW() - INTERVAL 3 WEEK ) AND dibaca='0' 
        $c = $this->db->get_where('notifikasi', array('tanggal < UNIX_TIMESTAMP(NOW() - INTERVAL 3 WEEK )' => NULL))->num_rows();
        $this->db->delete('notifikasi', array('tanggal < UNIX_TIMESTAMP(NOW() - INTERVAL 3 WEEK )' => NULL));
        // $this->db->delete('notifikasi', array('tanggal <' => 'UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 DAY))'));

        echo 'delete ' . $c . ' data';
    }
}
