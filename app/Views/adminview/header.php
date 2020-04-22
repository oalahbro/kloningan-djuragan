<!doctype html>
<html lang="id">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"/>
	
	<title><?= $title; ?></title>

	<style type="text/css">
		.btn-juragans{
			border:1px solid #fff;
			background:0 0;
			color:#fff;
			border-radius:5px;
			width:50px;
			height:39px;
			padding:0;
			margin:0;
			font-size:larger
		}
		.btn-juragans:hover{
			background:rgba(255,255,255,.75);
			color:#333;
			cursor:pointer;
		}

		#sidebar {
			width:250px;
			position:fixed;
			top:0;
			left:-250px;
			height:100vh;
			-moz-box-sizing:border-box;
			box-sizing:border-box;
			z-index:1050;
			transition:all .3s
		}
		#sidebar.show {
			left:0
		}
		#dismiss {
			width:35px;
			height:35px;
			line-height:35px;
			text-align:center;
			background:#7386d5;
			position:absolute;
			top:10px;
			right:10px;
			cursor:pointer;
			-webkit-transition:all .3s;
			-o-transition:all .3s;
			transition:all .3s
		}
		#dismiss:hover {
			background:#fff;
			color:#7386d5
		}
		.overlay {
			position:fixed;
			top:0;
			left:0;
			z-index:1040;
			width:100vw;
			height:100vh;
			display:none;
			background:rgba(0,0,0,.6);
			transition:all .5s ease-in-out
		}
		.overlay.active {
			display:block
		}
		.sidebar {
			overflow-y:scroll;
			height:100%;
			-moz-box-sizing:border-box;
			box-sizing:border-box
		}
		.sidebar ul li a {
			display:block;
			padding:.75rem 1rem;
			color:rgba(255,255,255,.75);
			text-decoration:none
		}
		.sidebar ul li a:hover,.sidebar ul .active a {
			color:#fff;
			background:rgba(0,0,0,.25)
		}
		.sidebar ul ul a {
			padding-left:2.5rem;
			background:rgba(0,0,0,.25)
		}
		.sidebar [data-toggle=collapse] {
			position:relative
		}
		.sidebar [data-toggle=collapse]:before {
			content:"\f0d7";
			font-family:"font awesome 5 free";
			font-weight:900;
			position:absolute;right:1rem
		}
		.sidebar [aria-expanded=true] {
			background:rgba(0,0,0,.25)
		}
		.sidebar [aria-expanded=true]:before {
			content:"\f0d8"
		}
	
	</style>
   
</head>
<body class="mt-5">

	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
		<div>
			<?php echo anchor('', 'Pesanan Juragan', ['class' => 'navbar-brand']); ?>

			<?php echo form_button(array('class' => 'btn-juragan btn btn-outline-light', 'data-toggle' => "collapse", 'data-target' => "#sidebar", 'id' => 'sidebarCollapse', 'content' => '<i class="fas fa-user-circle"></i>')); ?>
		</div>

	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

	    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<?php // echo anchor('faktur/tambah', 'Tulis Pesanan', array('class'=>'nav-link')) ?>
				</li>
				<li class="nav-item">
					<?php // echo anchor('chart', 'Chart', array('class'=>'nav-link')) ?>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item dropdown" id="notif">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="badge badge-danger counter" id="count">0</span> Notifikasi
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<?php // echo anchor('notifikasi', 'Lihat semua <span class="counter"></span>', array('class' => 'small d-block px-3 py-2 text-primary')); ?>
						<div id="notifKonten" class="notifikasiDrop"></div>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Pengaturan
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<?php 
						// echo anchor('pengaturan/juragan', 'Juragan', array('class' => 'dropdown-item'));
						// echo anchor('pengaturan/pengguna', 'Pengguna', array('class' => 'dropdown-item'));
						// echo anchor('pengaturan/index', 'Sistem', array('class' => 'dropdown-item'));
						?>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php // echo $_SESSION['nama']; ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<?php // echo anchor('keluar', 'Keluar', array('class' => 'dropdown-item')); ?>
					</div>
				</li>
			</ul>
	    </div>
	</nav>



