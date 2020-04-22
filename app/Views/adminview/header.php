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

	<div class="wrapper">
	    <nav id="sidebar" class="bg-dark collapse" style="">
	        <div class="sidebar" id="listJuragan">
	            <h6 class="dropdown-header">Pilih Juragan</h6>
	            <ul class="list-unstyled" id="listLi">
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/s_juragan">
	                        <svg class="svg-inline--fa fa-users fa-w-20" aria-hidden="true" data-prefix="fas" data-icon="users" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-users"></i> -->Semua Juragan</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/f4acdd10d99ae0db5dc7d84e87967f52cc028f9b">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Blazer Jaket</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/3dd239573c69034ee59e32917af7143f60659d55">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Custom Juragan</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/fd7ca78cec2c0e23e562af5f9cb68b5845a19b2f">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Dayat</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/fb6b50d82d52a317c7d49f75fdcc872b8c8ae700">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->DistroKorea.com</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/c24e478be38171a73eaf49f5b5b35f93f549ac8a">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Fashion Cowok</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/8fdd3935f6d38bfdeff266bc9c32041e9ae655b8">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Fashion Lelaki</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/f84f7201d42f739346f5c5791ff38297205b5f92">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Indonesia Shop</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/8aafc86dd00d77347baf4743d2c28a1e4e707e2d">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Jaket Anime</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/20d775ae223933aa32f362a6f96bcec69ea36060">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Jaket Korean</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/53b444fc767fdfc35c921f61c1ee0e5aa692d283">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Joker</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/dcb04dbb7ed071fa08ae16b1d7d8c769dd2eba2f">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Juragan Jaket</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/b838e6659f5e8ebac8e12191577d2efa73249388">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Juragan Jaket 2</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/09df3b75f869e33a80950ed4976c9d7d011420a8">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Korea Hunter</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/23276c77d251d86d4eaa0e2a396e00ca65b3a646">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Limited Shoping</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/6c973e8803b3fbaabfb09dd916e295ed24da1d43">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->No Rules</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/b1bbba32759b15be469977e4879ec38b7198256g">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->RA</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/27d0178da19e7f05f397d901545a0e5de8b2a98e">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Reseller</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/3b1658d8d3c5a6e4df1b822f2e415c929cb9c855">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Reseller Nine</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/403d3ddc6f70385f9ce228cdd0e50ac4f5b007c1">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->SayCleo</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/3ffeb39fe3773285105b7048192123337929a8ab">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Seven Domu</a>
	                </li>
	                <li>
	                    <a href="https://djuragan.com/new/index.php/faktur/data/b1bbba32759b15be469977e4879ec38b71982551">
	                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
	                            <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
	                        </svg>
	                        <!-- <i class="fas fa-user-circle"></i> -->Suit Men tailor</a>
	                </li>
	            </ul>
	        </div>
	    </nav>