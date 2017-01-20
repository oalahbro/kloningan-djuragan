<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Alba - Bootstrap 4 Admin Template">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
	<link rel="shortcut icon" href="img/favicon.png">

	<title><?php echo $title; ?></title>

	<!-- Icons -->
	<?php echo link_tag('assets/css/font-awesome.min.css'); ?>
	<?php echo link_tag('assets/css/simple-line-icons.css'); ?>

	<!-- Premium Icons -->
	<!--
	<link href="css/glyphicons.css" rel="stylesheet">
	<link href="css/glyphicons-filetypes.css" rel="stylesheet">
	<link href="css/glyphicons-social.css" rel="stylesheet">
	-->

	<!-- Main styles for this application -->
	<?php echo link_tag('assets/css/style.css'); ?>

	<script src="<?php echo base_url('assets/js/libs/jquery.min.js'); ?>"></script>

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
<body class="app header-fixed sidebar-hidden">
	<header class="app-header navbar">
		<button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
		<?php echo anchor('admin/dashboard', '&nbsp;', array('class' => 'navbar-brand')); ?>
		<ul class="nav navbar-nav hidden-md-down">
			<li class="nav-item">
				<a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
			</li>
			<li class="nav-item  px-1 dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
					Pesanan <span class="icon-options-vertical"></span>
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
					<span class="badge badge-pill badge-danger">5</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">

					<div class="dropdown-header text-center">
						<strong>You have 5 notifications</strong>
					</div>

					<a href="#" class="dropdown-item">
						<i class="icon-user-follow text-success"></i> New user registered
					</a>
					<a href="#" class="dropdown-item">
						<i class="icon-user-unfollow text-danger"></i> User deleted
					</a>
					<a href="#" class="dropdown-item">
						<i class="icon-chart text-info"></i> Sales report is ready
					</a>
					<a href="#" class="dropdown-item">
						<i class="icon-basket-loaded text-primary"></i> New client
					</a>
					<a href="#" class="dropdown-item">
						<i class="icon-speedometer text-warning"></i> Server overloaded
					</a>

					<div class="dropdown-header text-center">
						<strong>Server</strong>
					</div>

					<a href="#" class="dropdown-item">
						<div class="text-uppercase mb-q">
							<small><b>CPU Usage</b>
							</small>
						</div>
						<span class="progress progress-xs">
							<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</span>
						<small class="text-muted">348 Processes. 1/4 Cores.</small>
					</a>
					<a href="#" class="dropdown-item">
						<div class="text-uppercase mb-q">
							<small><b>Memory Usage</b>
							</small>
						</div>
						<span class="progress progress-xs">
							<div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
						</span>
						<small class="text-muted">11444GB/16384MB</small>
					</a>
					<a href="#" class="dropdown-item">
						<div class="text-uppercase mb-q">
							<small><b>SSD 1 Usage</b>
							</small>
						</div>
						<span class="progress progress-xs">
							<div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
						</span>
						<small class="text-muted">243GB/256GB</small>
					</a>

				</div>
			</li>


			<li class="nav-item dropdown hidden-md-down">
				<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
					<span class="hidden-md-down">admin</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right">

					<div class="dropdown-header text-center">
						<strong>Account</strong>
					</div>

					<a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
					<a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
					<a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
					<a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>

					<div class="dropdown-header text-center">
						<strong>Settings</strong>
					</div>

					<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
					<a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
					<a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-default">42</span></a>
					<a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
					<div class="divider"></div>
					<a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
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