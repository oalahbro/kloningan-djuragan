<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Download extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function pdf() {
		// echo $seri_faktur;
		$seri_faktur = $this->uri->segment(2);
		if ($this->faktur->check($seri_faktur) > 0) {
			$options = new Options();
			$options->set('isRemoteEnabled', TRUE);
			$dompdf = new Dompdf($options);

			$pdf_data = array(
				'pesanan' => $this->faktur->get_detail($seri_faktur)->row()
				);

			$dompdf->loadHtml($this->load->view('publik/faktur_pdf', $pdf_data, TRUE));

			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('A4');

			// Render the HTML as PDF
			$dompdf->render();

			$dompdf->stream(url_title( 'faktur ' . $seri_faktur), array('compress' => 1, 'Attachment' => 0));
		}
		else {
			show_404();
		}
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