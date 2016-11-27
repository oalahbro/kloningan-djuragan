<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?php echo $title; ?></title>

	<?php echo link_tag('assets/css/bootstrap.min.css'); ?>

	<style type="text/css">
		
	.login {
		margin-top: 50%;
	}
	.login .form-control {
		margin-bottom: 5px;
	}

	</style>

</head>
<body>

	<div class="pos-f-t">
		<div class="collapse" id="navbar-header">
			<div class="container-fluid p-1">
				<h3>Collapsed content</h3>
				<p>Toggleable via the navbar brand.</p>
			</div>
		</div>
		<div class="navbar navbar-full bg-faded navbar-static-top navbar-dark bg-inverse">
			<?php echo anchor('admin/pesanan', $nama_juragan, array('class' => 'navbar-brand')); ?>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header" aria-expanded="false" aria-label="Toggle navigation"></button>

			<span class="navbar-text text-muted"><?php echo $title_navbar; ?></span>

			<div class="form-inline float-xs-right">
				<button class="btn btn-outline-warning hidden-sm-up" type="button" data-toggle="collapse" data-target="#menu-navbar-" aria-controls="menu-navbar-" aria-expanded="false" aria-label="Toggle navigation">Menu</button>
				</div>
			<div class="collapse navbar-toggleable-xs" id="menu-navbar-">
				<ul class="nav navbar-nav">
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="#!" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Daftar Pesanan
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<?php echo anchor('admin/pesanan/lihat/semua/semua', 'Semua', array('class' => 'dropdown-item')); ?>
							<?php echo anchor('admin/pesanan/lihat/semua/pending', 'Pending', array('class' => 'dropdown-item')); ?>
							<?php echo anchor('admin/pesanan/lihat/semua/terkirim', 'Terkirim', array('class' => 'dropdown-item')); ?>
							<div class="dropdown-divider"></div>
							<?php echo anchor('admin/pesanan/lihat/semua/draft', 'Draft', array('class' => 'dropdown-item')); ?>

						</div>
					</li>

					<li class="nav-item"><?php echo anchor('admin/pesanan/tulis', 'Tulis Pesanan', array('class' => 'nav-link')); ?></li>
					<li class="nav-item"><?php echo anchor('admin/statistics', 'Statistik', array('class' => 'nav-link')); ?></li>
					<li class="nav-item"><?php echo anchor('admin/stock', 'Stok', array('class' => 'nav-link')); ?></li>
					<li class="nav-item"><?php echo anchor('admin/pesanan/export', 'Eksport', array('class' => 'nav-link')); ?></li>
				</ul>
			</div>
		</div>
	</div>