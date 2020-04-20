<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5'); 
?>
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
	echo link_tag('berkas/css/style.css');
	?>

	<title><?php echo $judul; ?></title>
    <script src="<?php echo base_url('berkas/js/jquery-3.3.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('berkas/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?php echo base_url('berkas/js/backend.js'); ?>"></script>
	<script src="https://use.fontawesome.com/releases/v5.6.3/js/solid.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.6.3/js/fontawesome.js"></script>
</head>
<body>