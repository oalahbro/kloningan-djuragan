<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class JuraganConfig extends BaseConfig
{
	public $rajaongkir  = '75f538ed88e26297a2fabed240ed8bf0'; // ID rajaongkir

	public $label = array(
		'1' => 'Blibli',
		'12' => 'OLX',
		'2' => 'Bukalapak',
		'3' => 'Facebook',
		'4' => 'Instagram',
		'5' => 'Lazada',
		'7' => 'Shopee',
		'11' => 'Tokopedia',
		'9' => 'WhatsApp',
		'10' => 'Zalora',
		'13' => 'Meesho',
		'8' => 'Web/App lain',
		'6' => 'Offline Store/COD'
	);

	public $size = array(
		'atasan' => array(
			's' => 'S',
			'm' => 'M',
			'l' => 'L',
			'xl' => 'XL',
			'xxl' => 'XXL',
			'xxxl' => 'XXXL'
		),
		'bawahan' => array(
			'28' => '28',
			'29' => '29',
			'30' => '30',
			'31' => '31',
			'32' => '32',
			'33' => '33',
			'34' => '34'
		)
		// custom
	);

	public $kurir = [
		'POS',
		'JNE',
		'COD',
		'First Logistic',
		'TIKI',
		'Wahana',
		'J&T',
		'RPX',
		'lainnya'
	];

	public $notifikasi = [
		'1' => '<i class="fad fa-plus-circle text-success"></i> {nama} membuat invoice {invoice}',
		'2' => '<i class="fad fa-pencil text-info"></i> {nama} merubah invoice {invoice}',
		'3' => '<i class="fad fa-trash text-danger"></i> {nama} menghapus invoice {invoice}',
		'4' => '<i class="fad fa-wallet text-info"></i> {nama} menambahkan pembayaran baru pada invoice {invoice}',
		'5' => '<i class="fad fa-wallet text-success"></i> {nama} men-set "Pembayaran Ada" pada invoice {invoice}',
		'6' => '<i class="fad fa-wallet text-danger"></i> {nama} men-set "Pembayaran Tidak Ada" pada invoice {invoice}',
		'7' => '<i class="fad fa-file-alt text-warning"></i> "Data pesanan" invoice {invoice} belum lengkap',
		'8' => '<i class="fad fa-file-alt text-success"></i> "Data pesanan" invoice {invoice} sudah lengkap',
		'9' => '<i class="fad fa-layer-group text-warning"></i> "Bahan produk" untuk invoice {invoice} belum ada',
		'10' => '<i class="fad fa-layer-group text-success"></i> "Bahan produk" untuk invoice {invoice} ada',
		'11' => '<i class="fad fa-print text-warning"></i> Orderan pada invoice {invoice} sedang masuk proses sablon',
		'12' => '<i class="fad fa-print text-success"></i> Orderan pada invoice {invoice} selesai proses sablon',
		'13' => '<i class="fad fa-waveform-path fa-rotate-90 text-warning"></i> Orderan pada invoice {invoice} sedang masuk proses bordir',
		'14' => '<i class="fad fa-waveform-path fa-rotate-90 text-success"></i> Orderan pada invoice {invoice} selesai proses bordir',
		'15' => '<i class="fad fa-cut fa-rotate-270 text-warning"></i> Orderan pada invoice {invoice} masuk proses jahit',
		'16' => '<i class="fad fa-cut fa-rotate-270 text-success"></i> Orderan pada invoice {invoice} selesai proses jahit',
		'17' => '<i class="fad fa-tasks text-warning"></i> Orderan pada invoice {invoice} mulai proses QC (Quality Control)',
		'18' => '<i class="fad fa-tasks text-success"></i> Orderan pada invoice {invoice} selesai proses QC (Quality Control)',
		'19' => '<i class="fad fa-box-alt text-warning"></i> Orderan pada invoice {invoice} mulai dipacking',
		'20' => '<i class="fad fa-box-alt text-success"></i> Orderan pada invoice {invoice} selesai packing',
		'21' => '<i class="fad fa-truck text-warning"></i> Orderan pada invoice {invoice} dikirim beberapa dulu',
		'22' => '<i class="fad fa-truck text-success"></i> Orderan pada invoice {invoice} telah dikirimkan'
	];
}
