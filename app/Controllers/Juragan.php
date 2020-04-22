<?php namespace App\Controllers;

class Faktur extends BaseController
{
    /*
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
        switch ($this->session->level) {
            case 'superadmin':
            case 'admin':
                redirect('pesanan/s_juragan');
                break;
            
            case 'cs':
                $user_slug = $this->session->username;
                $juragan = $this->pengguna->_juragan_terakhir($user_slug);
                $juragan = $this->juragan->_slug($juragan);
                redirect('pesanan/' . $juragan);
                break;
            
            default:
                # code...
                break;
        }
	}

	// ambil data juragan
	public function ambil() {
		$username = $this->session->userdata('username');
		$jur = $this->pengguna->_juragan_cs($username)->result();

		$data = array();
		foreach ($jur as $juragan) {
			$data[] = array(
				'nama' => $juragan->nama,
				'slug' => $juragan->slug
			);
		}

		$response = array(
			'data' => $data
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
    */
}
