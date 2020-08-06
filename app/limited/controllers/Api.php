<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Curl\Curl;

class Api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->curl = new Curl();
		$this->curl->setBasicAuthentication('namanama', 'kodekode');

		$this->url = 'http://stock.onlinesukses.com/index.php/';
	}

	public function index() {
	}

	public function produk() {
		$this->curl->get($this->url . 'produk');

		if ($this->curl->error) {
		    echo 'Error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n";
		} else {
		    header('Content-Type: application/json');
		    echo json_encode($this->curl->response);
		}
	}

	public function list_kode() {
		$this->curl->get($this->url . 'produk');

		if ($this->curl->error) {
		    echo 'Error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n";
		} else {
		    header('Content-Type: application/json');
		    $r = $this->curl->response->data;

		    $kode = array();
		    foreach ($r as $r1) {
		    	foreach ($r1 as $r2) {
		    		foreach ($r2->data as $d) {
		    			$kode[] = $d->kode;
		    		}
		    		
		    	}
		    }
		    echo json_encode($kode);
		}
	}

	public function ambil_harga($kode) {
		$this->curl->get($this->url . 'produk/detail/' . $kode);

		if ($this->curl->error) {
		    echo 'Error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n";
		} else {
		    header('Content-Type: application/json');
		    $r = $this->curl->response->data;

		    $kode = array();
		    foreach ($r as $r1) {
		    	foreach ($r1 as $r2) {
		    		foreach ($r2->data as $d) {
		    			$kode[] = (int) $d->harga;
		    		}
		    		
		    	}
		    }
		    echo json_encode($kode);
		}
	}

}
