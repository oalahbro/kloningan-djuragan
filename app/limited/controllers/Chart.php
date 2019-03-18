<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller
{

	private $template;

	public function __construct() {
        parent::__construct();
        if( ! $this->session->logged) {
            redirect('');
        }
        else {
            switch ($this->session->level) {
                case 'superadmin':
                case 'admin':
                $this->template = 'admin';
					break;
					
				case 'viewer':
				$this->template = 'viewer';
					break;

                case 'cs':
                $this->template = 'cs';
                    break;
                
                default:
                    $this->template = 'reseller';
                    break;
            }
        }
    }

	public function index() {
		$this->data = array(
			'judul' => 'Chart',
			'include' => $this->template
			);

		$this->load->view('chart', $this->data);
	}

}
