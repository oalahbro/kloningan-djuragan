<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Download extends CI_Controller
{

	public function __construct() {
		parent::__construct();
	}

	public function index() {

		$en_id = $this->input->get('id');

		$slug = save_url_decode($en_id);

		// cek ketersediaan data di database
		$cek = $this->pesanan->cek($slug);
		$invoice_id = $this->pesanan->invoice_id($slug);

		if($cek) {
			$options = new Options();
			$options->set('isRemoteEnabled', TRUE);
			$dompdf = new Dompdf($options);

			$additional = array(
				'pesanan' => $this->pesanan->_detail($slug)->row()
				);

			$dompdf->loadHtml($this->load->view('invoices', $additional, TRUE));

			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('A4');

			// Render the HTML as PDF
			$dompdf->render();

			$dompdf->stream(url_title( 'invoice ' . $invoice_id), array('compress' => 1, 'Attachment' => 0));
		}
		else {
			show_404();
		}
	}





}


