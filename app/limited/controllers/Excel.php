<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\Border;
use Box\Spout\Writer\Style\BorderBuilder;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;

class Excel extends admin_controller
{

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		
		$fileName = 'bukukeluar-' . uniqid() . '.xlsx';
		$writer = WriterFactory::create(Type::XLSX); // for XLSX files

		$writer->setShouldUseInlineStrings(FALSE);

		$border = (new BorderBuilder())
		    ->setBorderTop(Color::BLACK, Border::WIDTH_THIN)
		    ->setBorderBottom(Color::BLACK, Border::WIDTH_THIN)
		    ->setBorderRight(Color::BLACK, Border::WIDTH_THIN)
		    ->setBorderLeft(Color::BLACK, Border::WIDTH_THIN)
		    ->build();

		$style = (new StyleBuilder())
           //->setFontBold()
           ->setFontSize(12)
           ->setFontColor(Color::BLUE)
           ->setShouldWrapText()
           ->setBorder($border)
           ->setBackgroundColor(Color::YELLOW)
           ->build();

        $style2 = (new StyleBuilder())
		    ->setBorder($border)
		    //->setShouldWrapText()
		    ->build();

		//$writer->openToFile($filePath); // write data to a file or to a PHP stream
		$writer->openToBrowser($fileName); // stream data directly to the browser

		$sheet = $writer->getCurrentSheet();
		$sheet->setName('ALL JURAGAN');

		$q = $this->pesanan->ambil_semua($juragan = FALSE, $oleh = FALSE, $status = 'terkirim', $limit = FALSE, $offset = FALSE, $cari = FALSE, $by = FALSE, $mulai = tanggal_default('mulai'), $akhir = tanggal_default('akhir'));

		$i = 1;
		$r = array();
		$writer->addRows([["BUKU KELUAR JURAGAN"], ["Per Tanggal " . tanggal_default('mulai') . ' ~ '. tanggal_default('akhir')], [""]]); // tulis judul 

		$writer->addRowWithStyle(["NO","TANGGAL TERKIRIM","NAMA JURAGAN", "NO RESI", "NAMA BUYER", "KODE", "SIZE", "JUMLAH TRANSFER", "BANK", "PEMBAYARAN RESI", "HARGA SETELAH DIKURANGIN RESI", "HARGA PRODUK", "DISKON", "PLUS / MINUS", "KET DISKON"], $style);
		//$writer->addRow(); // tulis judul tabel

		foreach ($q->result() as $p) {
			$detail = json_decode($p->detail);
			$pemesan = json_decode($p->pemesan);
			$pesanan = (array) $detail->p;
			$biaya = json_decode($p->biaya);

			$resi = (isset($detail->s->n) && isset($detail->s) && isset($detail->s->k)? '(' .$detail->s->k . ') ' . strtoupper($detail->s->n) : '');

			$nama_juragan = $this->juragan->_nama($p->juragan);
			$tanggal = mdate('%m/%d/%Y', $p->tanggal_cek_kirim);

			$no = $i;
			$date = $tanggal;
			$jur = $nama_juragan;
			$resi = strtoupper($resi);
			$nama = strtoupper($pemesan->n);
			$jml_transfer = (int) $biaya->m->t;
			$bank = strtoupper($biaya->b);
			$ofix = (int) (isset($biaya->m->of) ? $biaya->m->of : 0);
			$diskon = (int) (isset($biaya->m->d) ? $biaya->m->d : 0 );

			for ($psan=0; $psan < count($pesanan); $psan++) { 
				if($psan > 0) {
					$no = "";
					$date = "";
					$jur = "";
					$resi = "";
					$nama = "";
					$jml_transfer = "";
					$ofix = "";
					$bank = "";
					$diskon = "";
				}

				$writer->addRowWithStyle( [ $no, $date, $jur, $resi, $nama, strtoupper( $pesanan[$psan]->c ), $pesanan[$psan]->s, $jml_transfer, $bank, $ofix, "", (int) (isset($pesanan[$psan]->h) ? $pesanan[$psan]->h : 0 ), $diskon, "", "" ], $style2 ); // add a row at a time
			}
			$i++;
		}

		foreach (dropdown_juragan() as $j) {
			$newSheet = $writer->addNewSheetAndMakeItCurrent();
			$qj = $this->pesanan->ambil_semua($j->id, $oleh = FALSE, $status = 'terkirim', $limit = FALSE, $offset = FALSE, $cari = FALSE, $by = FALSE, $mulai = tanggal_default('mulai'), $akhir = tanggal_default('akhir'));

			$i = 1;
			$r = array();
			$writer->addRows([[strtoupper($j->nama)], ["Per Tanggal " . tanggal_default('mulai') . ' ~ '. tanggal_default('akhir')], [""]]); // tulis judul 

			$writer->addRowWithStyle(["NO","TANGGAL TERKIRIM","NAMA JURAGAN", "NO RESI", "NAMA BUYER", "KODE", "SIZE", "JUMLAH TRANSFER", "BANK", "PEMBAYARAN RESI", "HARGA SETELAH DIKURANGIN RESI", "HARGA PRODUK", "DISKON", "PLUS / MINUS", "KET DISKON"], $style);
			//$writer->addRow(); // tulis judul tabel

			foreach ($qj->result() as $p) {
				$detail = json_decode($p->detail);
				$pemesan = json_decode($p->pemesan);
				$pesanan = (array) $detail->p;
				$biaya = json_decode($p->biaya);

				$resi = (isset($detail->s->n) && isset($detail->s) && isset($detail->s->k)? '(' .$detail->s->k . ') ' . strtoupper($detail->s->n) : '');

				$nama_juragan = $this->juragan->_nama($p->juragan);
				$tanggal = mdate('%m/%d/%Y', $p->tanggal_cek_kirim);

				$no = $i;
				$date = $tanggal;
				$jur = $nama_juragan;
				$resi = strtoupper($resi);
				$nama = strtoupper($pemesan->n);
				$jml_transfer = (int) $biaya->m->t;
				$bank = strtoupper($biaya->b);
				$ofix = (int) (isset($biaya->m->of) ? $biaya->m->of : 0);
				$diskon = (int) (isset($biaya->m->d) ? $biaya->m->d : 0 );

				for ($psan=0; $psan < count($pesanan); $psan++) { 
					if($psan > 0) {
						$no = "";
						$date = "";
						$jur = "";
						$resi = "";
						$nama = "";
						$jml_transfer = "";
						$ofix = "";
						$bank = "";
						$diskon = "";
					}

					$writer->addRowWithStyle( [ $no, $date, $jur, $resi, $nama, strtoupper( $pesanan[$psan]->c ), $pesanan[$psan]->s, $jml_transfer, $bank, $ofix, "", (int) (isset($pesanan[$psan]->h) ? $pesanan[$psan]->h : 0 ), $diskon, "", "" ], $style2 ); // add a row at a time
				}
				$i++;
			}
			//$writer->addRow([$j->nama]); // add a row at a time
			$sheet = $writer->getCurrentSheet();
			$sheet->setName($j->nama);
		}

		$writer->close();
	}

	public function cek() {
		$q = $this->pesanan->ambil_semua($juragan = FALSE, $oleh = FALSE, $status = 'terkirim', $limit = 10, $offset = 0, $cari = FALSE, $by = FALSE);

		$i = 1;
		foreach ($q->result() as $p) {
			$detail = json_decode($p->detail);
			$resi = $detail->s->k;
			$pesanan = (array) $detail->p;

			$r = array(
				$i,
				$resi
				);

			$w = json_encode($r);
			echo $w . ' - '. $detail['p']->c .'<br/>';

			
			$i++;
		}

		
	}

}
