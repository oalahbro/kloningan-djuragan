<?php

namespace App\Controllers;

use Dompdf\Dompdf;

class Download extends BaseController
{
    public function invoice($invoice)
    {
        if (! $this->isLogged()) {
            return redirect()->to('/auth');
        }

        $cari = [
            'kolom' => 'faktur',
            'q'     => $invoice,
        ];

        $get_invoice = $this->invoice->ambil_data(null, 'semua', null, null, $cari)->get()->getResult();

        $filename = time();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('template/invoice', [
            'invoice' => $get_invoice[0],
        ]));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        // $dompdf->stream();

        // Output the generated PDF to Browser
        $dompdf->stream($filename, ['Attachment' => false]);

        exit(0);
    }
}
