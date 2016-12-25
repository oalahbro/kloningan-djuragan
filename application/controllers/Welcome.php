<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	

	public function index() {
        $results = $this->juragan->get_chart_data();
        $data['chart_data'] = $results;
        $data['juragan'] = $results['juragan'];
        $data['juragan_id'] = $results['juragan_id'];
        $data['bulan'] = $results['bulan'];
        $data['jumlah_juragan'] = count($results['juragan']);


        

        $this->load->view('welcome_message', $data);

        // $this->output
	         // ->set_content_type('application/json')
	         // ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
