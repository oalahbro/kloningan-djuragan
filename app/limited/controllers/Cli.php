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
        $this->db->delete('notifikasi', array('tanggal <' => 'UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 DAY))','dibaca' => '1'));
        $this->db->delete('notifikasi', array('tanggal <' => 'UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 DAY))'));

        echo 'del';
    }
}
