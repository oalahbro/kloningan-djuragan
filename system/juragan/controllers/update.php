<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Update extends CI_Controller {

    public function index() {
if(is_login())
		{
			if(is_user('superadmin') || is_user('admin'))
			{
    	$this->form_validation->set_rules('id[]', 'is', 'required');

    	if($this->form_validation->run() === FALSE) {

$this->db->where('data', 'lama');
		$this->db->limit(100);
		$q= $this->db->get('order');

	    	$data = array(
	    		'q' => $q
	    		);
	    	$this->load->view('update', $data);
	    }
	    else {
	    	$id = $this->input->post('id'); //array of id
			$pesanan = $this->input->post('pesanan'); //array of item name
			

			$updateArray = array();

			for($x = 0; $x < sizeof($id); $x++){

				// $total[] = $price[$x] * $qty[$x];
				$updateArray[] = array(
					'id'=>$id[$x],
					'pesanan' => $pesanan[$x],
					'kode' => '',
					'data' => 'baru'
					);
			}      
			$this->db->update_batch('order',$updateArray, 'id'); 
			redirect('update#sukses');
	    }
    }

    }
    }


}