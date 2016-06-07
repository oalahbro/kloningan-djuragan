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
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
	<style type="text/css">
    	@import url(https://fonts.googleapis.com/css?family=Pacifico);
    	body {
    		margin-top: 70px;
    	}
    	a.navbar-brand, .title-page small {
    		font-family: 'Pacifico', cursive;
    	}
    	/* CSS used here will be applied after bootstrap.css */
    	.badge-notify{
    		background: #D73C3C;
    		position:relative;
    		top: -15px;
    		left: 0;
    	}
    	.navbar {
    		margin-bottom:0;
    	}

    	.subnav {
    		margin:0;
    		top: 0px;
    		z-index: 1020;
    		background-color: rgb(247,247,247); 
    		border-bottom: 1px solid #E1E1E1;
    		padding: 8px 0px 5px 0px;
    		transition: all 2s ease;
    		-webkit-transition: all 2s ease;
		    -moz-transition: all 2s ease;
		    -o-transition: all 2s ease;
    	}
    	.subnav.affix {
    		position: fixed;
    		top: 70px;
    		width: 100%;
    		z-index:10;
    	}
    	.title-page {
		    text-align: center;
		    margin-top: 10px;
		    padding-bottom: 9px;
			margin: 40px 0 20px;
		}
		.title-page i, .title-page small {
		    display: block;
		    color: teal;
		}
    	.page-content {
    		min-height: 70vh;
    	}
    	.btn-margin {
		    margin-top: 5px;
		}
    	.label-info2 {
		    background-color: #5BC0DE;
		}
		table .label {
		    font-size: 0.9em;
		}
    	.btn-clean.disabled,
    	.btn-clean[disabled],
    	fieldset[disabled] .btn-clean,
    	.btn-clean.disabled:hover,
    	.btn-clean[disabled]:hover,
    	fieldset[disabled] .btn-clean:hover,
    	.btn-clean.disabled:focus,
    	.btn-clean[disabled]:focus,
    	fieldset[disabled] .btn-clean:focus,
    	.btn-clean.disabled.focus,
    	.btn-clean.focus[disabled],
    	fieldset[disabled] .btn-clean.focus,
    	.btn-clean.disabled:active,
    	.btn-clean[disabled]:active,
    	fieldset[disabled] .btn-clean:active,
    	.btn-clean.disabled.active,
    	.btn-clean.active[disabled],
    	fieldset[disabled] .btn-clean.active {
		    background-color: transparent;
		    border-color: transparent;
		    border-bottom-width: 2px;
		    border-bottom-color: black;
		    border-top-width: 2px;
		    border-top-color: black;
		    color: black;
		    font-weight: bold;
		    cursor: default;
		}

		.btn-lunas.disabled,
		.btn-lunas[disabled],
		fieldset[disabled] .btn-lunas,
		.btn-lunas.disabled:hover,
		.btn-lunas[disabled]:hover,
		fieldset[disabled] .btn-lunas:hover,
		.btn-lunas.disabled:focus,
		.btn-lunas[disabled]:focus,
		fieldset[disabled] .btn-lunas:focus,
		.btn-lunas.disabled.focus,
		.btn-lunas.focus[disabled],
		fieldset[disabled] .btn-lunas.focus,
		.btn-lunas.disabled:active,
		.btn-lunas[disabled]:active,
		fieldset[disabled] .btn-lunas:active,
		.btn-lunas.disabled.active,
		.btn-lunas.active[disabled],
		fieldset[disabled] .btn-lunas.active {
		    background-color: transparent;
		    border-color: transparent;
		    border-top-width: 2px;
		    border-top-color: green;
		    border-bottom-width: 2px;
		    border-bottom-color: green;
		    color: green;
		    font-weight: bold;
		    cursor: default;
		}

		.btn-dp.disabled,
		.btn-dp[disabled],
		fieldset[disabled] .btn-dp,
		.btn-dp.disabled:hover,
		.btn-dp[disabled]:hover,
		fieldset[disabled] .btn-dp:hover,
		.btn-dp.disabled:focus,
		.btn-dp[disabled]:focus,
		fieldset[disabled] .btn-dp:focus,
		.btn-dp.disabled.focus,
		.btn-dp.focus[disabled],
		fieldset[disabled] .btn-dp.focus,
		.btn-dp.disabled:active,
		.btn-dp[disabled]:active,
		fieldset[disabled] .btn-dp:active,
		.btn-dp.disabled.active,
		.btn-dp.active[disabled],
		fieldset[disabled] .btn-dp.active {
		    background-color: transparent;
		    border-color: transparent;
		    border-top-width: 2px;
		    border-top-color: red;
		    border-bottom-width: 2px;
		    border-bottom-color: red;
		    color: red;
		    font-weight: bold;
		    cursor: default;
		}

		.bootstrap-datetimepicker-widget {
	top: 0;
	left: 0;
	width: 250px;
	padding: 4px;
	margin-top: 1px;
	z-index: 99999 !important;
	border-radius: 4px;
}
.bootstrap-datetimepicker-widget.timepicker-sbs {
	width: 600px;
}
.bootstrap-datetimepicker-widget.bottom:before {
	content: '';
	display: inline-block;
	border-left: 7px solid transparent;
	border-right: 7px solid transparent;
	border-bottom: 7px solid #ccc;
	border-bottom-color: rgba(0, 0, 0, 0.2);
	position: absolute;
	top: -7px;
	left: 7px;
}
.bootstrap-datetimepicker-widget.bottom:after {
	content: '';
	display: inline-block;
	border-left: 6px solid transparent;
	border-right: 6px solid transparent;
	border-bottom: 6px solid white;
	position: absolute;
	top: -6px;
	left: 8px;
}
.bootstrap-datetimepicker-widget.top:before {
	content: '';
	display: inline-block;
	border-left: 7px solid transparent;
	border-right: 7px solid transparent;
	border-top: 7px solid #ccc;
	border-top-color: rgba(0, 0, 0, 0.2);
	position: absolute;
	bottom: -7px;
	left: 6px;
}
.bootstrap-datetimepicker-widget.top:after {
	content: '';
	display: inline-block;
	border-left: 6px solid transparent;
	border-right: 6px solid transparent;
	border-top: 6px solid white;
	position: absolute;
	bottom: -6px;
	left: 7px;
}
.bootstrap-datetimepicker-widget .dow {
	width: 14.2857%;
}
.bootstrap-datetimepicker-widget.pull-right:before {
	left: auto;
	right: 6px;
}
.bootstrap-datetimepicker-widget.pull-right:after {
	left: auto;
	right: 7px;
}
.bootstrap-datetimepicker-widget > ul {
	list-style-type: none;
	margin: 0;
}
.bootstrap-datetimepicker-widget a[data-action] {
	padding: 6px 0;
}
.bootstrap-datetimepicker-widget a[data-action]:active {
	box-shadow: none;
}
.bootstrap-datetimepicker-widget .timepicker-hour,
.bootstrap-datetimepicker-widget .timepicker-minute,
.bootstrap-datetimepicker-widget .timepicker-second {
	width: 54px;
	font-weight: bold;
	font-size: 1.2em;
	margin: 0;
}
.bootstrap-datetimepicker-widget button[data-action] {
	padding: 6px;
}
.bootstrap-datetimepicker-widget table[data-hour-format="12"] .separator {
	width: 4px;
	padding: 0;
	margin: 0;
}
.bootstrap-datetimepicker-widget .datepicker > div {
	display: none;
}
.bootstrap-datetimepicker-widget .picker-switch {
	text-align: center;
}
.bootstrap-datetimepicker-widget table {
	width: 100%;
	margin: 0;
}
.bootstrap-datetimepicker-widget td,
.bootstrap-datetimepicker-widget th {
	text-align: center;
	border-radius: 4px;
}
.bootstrap-datetimepicker-widget td {
	height: 54px;
	line-height: 54px;
	width: 54px;
}
.bootstrap-datetimepicker-widget td.cw {
	font-size: 10px;
	height: 20px;
	line-height: 20px;
	color: #777777;
}
.bootstrap-datetimepicker-widget td.day {
	height: 20px;
	line-height: 20px;
	width: 20px;
}
.bootstrap-datetimepicker-widget td.day:hover,
.bootstrap-datetimepicker-widget td.hour:hover,
.bootstrap-datetimepicker-widget td.minute:hover,
.bootstrap-datetimepicker-widget td.second:hover {
	background: #eeeeee;
	cursor: pointer;
}
.bootstrap-datetimepicker-widget td.old,
.bootstrap-datetimepicker-widget td.new {
	color: #777777;
}
.bootstrap-datetimepicker-widget td.today {
	position: relative;
}
.bootstrap-datetimepicker-widget td.today:before {
	content: '';
	display: inline-block;
	border-left: 7px solid transparent;
	border-bottom: 7px solid #2A3342;
	border-top-color: rgba(0, 0, 0, 0.2);
	position: absolute;
	bottom: 4px;
	right: 4px;
}
.bootstrap-datetimepicker-widget td.active,
.bootstrap-datetimepicker-widget td.active:hover {
	background-color: #2A3342;
	color: #ffffff;
	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}
.bootstrap-datetimepicker-widget td.active.today:before {
	border-bottom-color: #fff;
}
.bootstrap-datetimepicker-widget td.disabled,
.bootstrap-datetimepicker-widget td.disabled:hover {
	background: none;
	color: #777777;
	cursor: not-allowed;
}
.bootstrap-datetimepicker-widget td span {
	display: inline-block;
	width: 54px;
	height: 54px;
	line-height: 54px;
	margin: 2px 1.5px;
	cursor: pointer;
	border-radius: 4px;
}
.bootstrap-datetimepicker-widget td span:hover {
	background: #eeeeee;
}
.bootstrap-datetimepicker-widget td span.active {
	background-color: #2A3342;
	color: #ffffff;
	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}
.bootstrap-datetimepicker-widget td span.old {
	color: #777777;
}
.bootstrap-datetimepicker-widget td span.disabled,
.bootstrap-datetimepicker-widget td span.disabled:hover {
	background: none;
	color: #777777;
	cursor: not-allowed;
}
.bootstrap-datetimepicker-widget th {
	height: 20px;
	line-height: 20px;
	width: 20px;
}
.bootstrap-datetimepicker-widget th.picker-switch {
	width: 145px;
}
.bootstrap-datetimepicker-widget th.next,
.bootstrap-datetimepicker-widget th.prev {
	font-size: 21px;
}
.bootstrap-datetimepicker-widget th.disabled,
.bootstrap-datetimepicker-widget th.disabled:hover {
	background: none;
	color: #777777;
	cursor: not-allowed;
}
.bootstrap-datetimepicker-widget thead tr:first-child th {
	cursor: pointer;
}
.bootstrap-datetimepicker-widget thead tr:first-child th:hover {
	background: #eeeeee;
}
    </style>

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
	