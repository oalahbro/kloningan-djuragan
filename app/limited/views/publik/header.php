<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5'); ?>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<?php
	$meta = array(
		array(
			'name' => 'X-UA-Compatible',
			'content' => 'IE=edge', 'type' => 'equiv'
			),
		array(
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1'
			),
		/*
		array(
			'name' => 'description',
			'content' => 'My Great Site'
			),
		array(
			'name' => 'keywords',
			'content' => 'love, passion, intrigue, deception'
			),
		*/
		);

	echo meta($meta);
	// 
	echo link_tag('assets/css/bootstrap.min.css');
	echo link_tag('assets/css/front.css');
	?>
	<title><?php echo judul('full'); ?></title>

</head>

<body><?php 
$session_pesan = $this->session->userdata('pesan_tampil');
if($session_pesan) { echo '<div class="alert alert-info alert-custom">' . $this->session->userdata('pesan') . '</div>'; $this->session->unset_userdata('pesan');?>
<?php } $this->session->unset_userdata('pesan_tampil');?>