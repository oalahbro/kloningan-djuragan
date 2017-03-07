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

<body class="sidebar-fixed sidebar-hidden">
	<header>
		<nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse bg-faded">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<button class="sidebar-toggler openNav" type="button">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<a class="navbar-brand" href="#">Hidden brand</a>
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
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

	<div class="app-body">
		<div class="sidebar">
			<nav class="sidebar-nav">
				<ul class="nav">
					<?php 
					foreach ($this->juragan->anbil_data()->result() as $j) {
						echo '<li class="nav-item">';
						echo anchor('admin/pesanan/lihat/' . $j->nama_alias, $j->nama . '<span class="badge badge-info">NEW</span>', array('class' => 'nav-link'));
						echo '</li>';
					}
					?>
				</ul>
			</nav>
		</div>

