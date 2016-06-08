<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?php echo $title; ?></title>

	<!-- Bootstrap -->
	<link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet" />


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div id="navtop">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php echo anchor('admin', $this->config->item('site_name'), array('class' => 'navbar-brand')); ?>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-th-large"></i> Daftar Pesanan <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php 
							foreach (list_juragan()->result() as $key) {
								$notifikasi = '';
								if(($key->transfer > 0) OR ($key->kirim > 0)) {
									$notifikasi = '&nbsp;<em><small><span class="text-warning"><i class="glyphicon glyphicon-bullhorn"></i></span> ' . '<span class="text-danger">' . $key->transfer . '</span>' . ' / <span class="text-danger">' . $key->kirim . '</span></small></em>';

								}
								echo '<li>' .  anchor('admin/pesanan/read/' . $key->username, $key->nama . $notifikasi) . '</li>';
							} ?>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-plus"></i> Tambah Pesanan <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php 
							foreach (list_juragan()->result() as $key) {
								echo '<li>' .  anchor('admin/pesanan/create' . $key->username, $key->nama) . '</li>';
							} ?>
						</ul>
					</li>
					<li><?php echo anchor('status', '<i class="glyphicon glyphicon-sort-by-order"></i> Status'); ?></li>
					<li><?php echo anchor('stock', '<i class="glyphicon glyphicon-compressed"></i> Stock'); ?></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><?php echo anchor('', '<span class="glyphicon glyphicon-bullhorn"></span> <span class="label badge-notify">3</span>'); ?></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> Pengaturan <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><?php echo anchor('admin/setting/product', 'Daftar Produk'); ?></li>
							<li><?php echo anchor('admin/setting/juragan', 'Admin / Juragan'); ?></li>
							<li><?php echo anchor('admin/setting', 'Lainnya'); ?></li> 	
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo data_session('nama'); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><?php echo anchor('admin/profile', 'Ubah Sandi'); ?></li>
							<li><?php echo anchor('logout', 'Logout'); ?></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</div>
	