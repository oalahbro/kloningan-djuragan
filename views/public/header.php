<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * public/header.php
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		1.x.x
 */

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?php echo title('namever') ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('assets/css/custom.css'); ?>"/>
</head>

<body><?php /*
$session_pesan = $this->session->userdata('pesan_tampil');
if($session_pesan) { echo '<div class="alert alert-info alert-custom">' . $this->session->userdata('pesan') . '</div>'; $this->session->unset_userdata('pesan');?>
<?php } $this->session->unset_userdata('pesan_tampil'); */ ?>

