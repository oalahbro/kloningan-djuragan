<?php

use MatthiasMullie\Minify;

$CSSmin = new Minify\CSS();
$JSmin = new Minify\JS();
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />
	<title>
		<?= $title; ?>
	</title>
	<style type="text/css">
		<?php $css = '
	body,
	.breadcrumb {
		background-color: #eee;
	}

	.bg-paid {
		background: rgba(52, 180, 113, .1)
	}

	.bg-unpaid {
		background: rgba(249, 103, 108, .1)
	}

	.bg-credit {
		background: rgba(240, 173, 78, .1)
	}

	.mainnav {
		z-index: 1030 !important;
	}

	.logo svg {
		width: 50px;
		height: auto
	}

	.timeliner {
		font-size: 0;
	}
	.timeliner li {
		width: 40px;
	}
	.timeliner li:before {
		content: "";
		position: absolute;
		width: 100%;
		height: 2px;
		background: #ddd;
		bottom: 19px;
	}
	.timeliner li.start:before {
		width: 50%;
		left: 50%;
	}
	.timeliner li.end:before {
		width: 50%;
		right: 50%;
	}
	.timeliner li:after {
		content: "";
		width: 10px;
		height: 10px;
		background: #ddd;
		border-radius: 50%;
		position: absolute;
		bottom: 15px;
		left: calc(50% - (5px));
	}
	.timeliner .icon {
		font-size: 25px !important;
		margin-bottom: 5px;
		color: #ddd;
	}
	.timeliner span {
		font-size: 13px !important;
	}
	.timeliner li.full {
		color: #28a745 !important;
	}
	.timeliner li.full:before,
	.timeliner li.full:after {
		background-color: #28a745 !important;
	}
	.timeliner li.full .icon {
		color: #28a745 !important;
	}
	.timeliner li.half {
		color: #ffc107 !important;
	}
	.timeliner li.half:before,
	.timeliner li.half:after {
		background-color: #ffc107 !important;
	}
	.timeliner li.half .icon {
		color: #ffc107 !important;
	}

	.dropdown-menu.notify-drop {
		min-width: 330px;
		min-height: 360px;
		max-height: 360px;
	}

	.dropdown-menu.notify-drop .drop-content {
		min-height: 280px;
		max-height: 280px;
		overflow-y: scroll;
	}

	#listJuragan {
		z-index: 10000;
		width: 100%;
		height: calc(100% - 50px);
		overflow-y: scroll;
	}

	#listJuragan a:hover {
		background: rgba(255, 255, 255, .5);
		text-decoration: none;
		color: white !important;
	}

	.sidebarcollapse {
		top: 0;
		height: 100vh;
		left: -250px;
		width: 250px;
		transition: all 0.4s ease;
		display: block;
		z-index: 10000;
	}

	.sidebarcollapse.collapsing {
		height: auto !important;
		margin-right: 50%;
		left: -250px;
		transition: all 0.2s ease;
	}

	.sidebarcollapse.show {
		left: 0;
	}

	.amplop::before,
	.amplop::after {
		content: "";
		height: 10px;
		display: block;
		margin-top: -4px;
		margin-left: -4px;
		margin-right: -4px;
		margin-bottom: 5px;
		border-top-left-radius: 0.25rem;
		border-top-right-radius: 0.25rem;
		background-image: repeating-linear-gradient(135deg, #F29B91 0px, #F09290 15px, transparent 15px, transparent 25px, #83B3DB 25px, #84ADCB 40px, transparent 40px, transparent 50px);
	}

	.amplop::after {
		margin-top: 5px;
		margin-bottom: -4px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		border-bottom-left-radius: 0.25rem;
		border-bottom-right-radius: 0.25rem;
	}

	@media (max-width: 767.98px) {
		.navbar-nav-scroll {
			width: 100%
		}
	}

	.mt-n5 {
		margin-top: -3.60em;
	}
	.autocomplete-suggestions { border: 1px solid #ced4da; margin-top: 10px; background: #FFF; overflow: auto; border-radius: .25rem}
	.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; border-bottom: 1px solid #eee; }
	.autocomplete-selected { background: #F0F0F0; }
	.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
	.autocomplete-group { padding: 2px 5px; }
	.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

	.mycustom input[type="search"] {
		border-radius: .25rem !important;
	}
	.mycustom .btn {
		position: absolute;
		right: 4px;
		top: 4px;
		bottom: 4px;
		z-index: 9;
		border-radius: .25rem !important;
		padding: 0 15px
	}
	.keterangan .more-text{
        display: none;
	}
	
	';
		$CSSmin->add($css);
		echo $CSSmin->minify();
		?>
	</style>
</head>

<body>
	<nav class="sticky-top mainnav navbar navbar-expand navbar-dark bg-dark bg-gradient">
		<div class="container-xxl d-flex flex-wrap flex-md-nowrap align-items-center justify-content-between">
			<div class="d-flex align-items-center mr-3" id="logo">
				<?php echo form_button(array('class' => 'btn-juragan btn btn-outline-light', 'data-toggle' => "collapse", 'data-target' => "#sidebar", 'id' => 'sidebarCollapse', 'content' => '<i class="fad fa-align-left fa-flip-vertical"></i>')); ?>
				<?php echo anchor('', 'Pesanan Juragan', ['class' => 'navbar-brand ml-3']); ?>
			</div>
			<div id="menu" class="order-3 order-md-0 navbar-nav-scroll d-flex justify-content-center">
				<ul class="navbar-nav bd-navbar-nav flex-row py-2 py-md-0">
					<li class="nav-item">
						<?= anchor('user/invoices/tulis', 'Tulis Orderan', ['class' => 'nav-link']) ?>
					</li>
					<?php /*
					<li class="nav-item">
						<?= anchor('pelanggan', 'Customer', ['class' => 'nav-link']) ?>
					</li>
					<li class="nav-item">
						<?= anchor('produk', 'Produk', ['class' => 'nav-link']) ?>
					</li>
					*/ ?>
				</ul>
			</div>
			<div id="topmenu" class="ml-sm-auto">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link" href="#" id="dropUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fad fa-user d-block d-md-none"></i> <span class="d-none d-md-inline-block">
								<?= $_SESSION['name']; ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropUser">
							<?= anchor('user/sunting', 'Ubah Profil', array('class' => 'dropdown-item')); ?>
							<?= anchor('auth/keluar', 'Keluar', array('class' => 'dropdown-item')); ?>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<nav id="sidebar" class="position-fixed bg-dark collapse sidebarcollapse">
		<div class="d-block border-bottom border-secondary shadow">
			<h6 class="dropdown-header py-3">Pilih Juragan</h6>
		</div>
		<div class="sidebar position-relative" id="listJuragan">
			<ul class="list-unstyled " id="listLi"></ul>
		</div>
	</nav>
	<?= $this->renderSection('content') ?>
	<div aria-live="polite" aria-atomic="true">
		<div id="lTo" style="position: fixed; top: 65px; right: 10px;">
		</div>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script defer src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
	<script defer src="<?= base_url('assets/js/jquery.autocomplete.min.js'); ?>"></script>
	<?php /*
	// source fontawesome: https://github.com/carlosproductions/Portfolio-Home-Page2
	// or can use https://kit.fontawesome.com/22a9d93fa2.js
	*/
	?><script defer src="https://kit.fontawesome.com/9bdc906322.js" data-auto-replace-svg="nest" crossorigin="anonymous"></script>
	<?= $this->renderSection('js'); ?>

	<!--
		Page rendered in {elapsed_time} seconds
		Environment: <?= ENVIRONMENT ?> 
		-->
</body>

</html>