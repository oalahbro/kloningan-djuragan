<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php echo $title; ?></title>

	<?php echo link_tag('assets/css/bootstrap.min.css'); ?>

    <!-- Main styles for this application -->
    <?php echo link_tag('assets/css/style.css'); ?>

	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'                  - Fixed Header

// Sidebar options
1. '.sidebar-fixed'                 - Fixed Sidebar
2. '.sidebar-hidden'                - Hidden Sidebar
3. '.sidebar-off-canvas'        - Off Canvas Sidebar
4. '.sidebar-compact'               - Compact Sidebar Navigation (Only icons)

// Aside options
1. '.aside-menu-fixed'          - Fixed Aside Menu
2. '.aside-menu-hidden'         - Hidden Aside Menu
3. '.aside-menu-off-canvas' - Off Canvas Aside Menu

// Footer options
1. 'footer-fixed'                       - Fixed footer

-->
<body>

<div class="zto">
<div class="collapse" id="navbarToggleExternalContent">
	<div class="bg-inverse p-4">
		<h4 class="text-white">Collapsed content</h4>
		<span class="text-muted">Toggleable<br/>via<br/>the<br/>navbar<br/>brand.</span>
	</div>
</div>
</div>

	<header>
		<nav class="navbar fixed-top navbar-toggleable-md navbar-light bg-faded">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<a class="navbar-brand" href="#">Hidden brand</a>
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation" href="#">Link</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="#">Disabled</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="text" placeholder="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>

				
			</div>
		</nav>
	</header>
<?php /*
	<header class="app-header navbar">
		<button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
		<?php echo anchor('admin/dashboard', '&nbsp;', array('class' => 'navbar-brand')); ?>
		<ul class="nav navbar-nav hidden-md-down">
			<li class="nav-item">
				<a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
			</li>
	
			<li class="nav-item  px-1 dropdown">
				<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
					Pesanan 
				</a>
				<div class="dropdown-menu dropdown-menu-left dropdown-menu-lg">
					<?php 
					echo anchor('admin/pesanan/lihat/semua/semua', 'Semua', array('class' => 'dropdown-item'));
					echo anchor('admin/pesanan/lihat/semua/terkirim', 'Terkirim', array('class' => 'dropdown-item'));
					echo anchor('admin/pesanan/lihat/semua/pending', 'Pending', array('class' => 'dropdown-item'));
					?>
				</div>
			</li>

			<li class="nav-item px-1">
				<?php echo anchor('admin/statistics', 'Statistik', array('class' => 'nav-link')); ?>
			</li>
			<li class="nav-item px-1">
				<a class="nav-link" href="#">Stock</a>
			</li>

		</ul>
		<ul class="nav navbar-nav ml-auto">
			<li class="nav-item dropdown hidden-md-down">
				<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="icon-bell"></i>
					<span class="badge badge-pill badge-danger"><?php echo pengguna_baru() + count_pesanan('semua', 'pending'); ?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">

					<div class="dropdown-header text-center">
						<strong>Notifikasi</strong>
					</div>

					<?php if(pengguna_baru() > 0) { ?>
					<a href="<?php echo site_url('admin/pengaturan/juragan/baru'); ?>" class="dropdown-item">
						<i class="icon-user-follow text-success"></i> User Baru
						<span class="badge badge-success"><?php echo pengguna_baru(); ?></span>
					</a>
					<?php } ?>

					<a href="#" class="dropdown-item">
						<i class="icon-basket-loaded text-primary"></i> Pesanan Pending
						<span class="badge badge-primary"><?php echo count_pesanan('semua', 'pending'); ?></span>
					</a>

					<div class="dropdown-header text-center">
						<strong>Status</strong>
					</div>

					<a href="#" class="dropdown-item">
						<div class="text-uppercase mb-q">
							<small><b>Pesanan</b></small>
						</div>
						<span class="progress progress-xs">
							<div class="progress-bar bg-info" role="progressbar" style="width: <?php echo persen(count_pesanan('semua', 'terkirim'),count_pesanan()); ?>%" aria-valuenow="<?php echo persen(count_pesanan('semua', 'terkirim'),count_pesanan()); ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</span>
						<small class="text-muted"><?php echo count_pesanan('semua', 'terkirim'); ?> / <?php echo count_pesanan(); ?></small>
					</a>
			

				</div>
			</li>

			<li class="nav-item dropdown hidden-md-down px-1">
				<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="hidden-md-down">Pengaturan</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="#"><i class="fa fa-cogs"></i> Web</a>
					<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Juragan</a>
				</div>
			</li>

			<li class="nav-item dropdown px-1">
				<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<?php echo data_session('nama') ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<div class="dropdown-header text-center">
						<strong>Profil</strong>
					</div>

					<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Ubah Profil</a>
					<div class="divider"></div>
					<a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
				</div>
			</li>
		</ul>
	</header>

	<div class="app-body">
		<div class="sidebar">

			<nav class="sidebar-nav">
				<ul class="nav">
					<li class="nav-title">
						Dashboard
					</li>
					<?php 
					foreach ($this->juragan->anbil_data()->result() as $j) {
						echo '<li class="nav-item">';
						echo anchor('admin/pesanan/lihat/' . $j->nama_alias, '<i class="icon-user"></i>' . $j->nama, array('class' => 'nav-link'));
						echo '</li>';
					}
					?>

				</ul>
			</nav>
		</div>
		*/ ?>