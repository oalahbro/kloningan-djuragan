<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5'); ?>
<html>
<head>
	<meta charset="utf-8"/>
	<?php
	$meta = array(
		array(
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1'
			),
		);

	echo meta($meta);
	// 
	echo link_tag('berkas/css/bootstrap.min.css');
	echo link_tag('berkas/css/front.css');
	?>
	<title><?php echo judul('full'); ?></title>

</head>

<body class="text-center">