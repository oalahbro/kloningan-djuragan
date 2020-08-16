<?php namespace Config;

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
}