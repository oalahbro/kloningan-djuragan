<?php

use MatthiasMullie\Minify;

$CSSmin = new Minify\CSS();
$JSmin  = new Minify\JS();
?>
<!doctype html>
<html lang="id">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>" />

	<title>
		<?= $title; ?>
	</title>
</head>

<body>
	<nav class="sticky-top mainnav navbar navbar-expand navbar-dark bg-dark bg-gradient">
		<div class="container-xxl d-flex flex-wrap flex-md-nowrap align-items-center justify-content-between">
			<div class="d-flex align-items-center mr-3" id="logo">
				<?= form_button(['class' => 'btn-juragan btn btn-outline-light', 'data-toggle' => 'collapse', 'data-target' => '#sidebar', 'id' => 'sidebarCollapse', 'content' => '<i class="fal fa-align-left fa-flip-vertical"></i>']); ?>
				<?= anchor('', 'Pesanan Juragan', ['class' => 'navbar-brand ml-3']); ?>
			</div>
			<div id="menu" class="order-3 order-md-0 navbar-nav-scroll d-flex justify-content-center">
				<ul class="navbar-nav bd-navbar-nav flex-row py-2 py-md-0">
					<li class="nav-item">
						<?= anchor('admin/invoices/tulis', 'Tulis Orderan', ['class' => 'nav-link']) ?>
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
						<a href="#!" class="nav-link" id="notif" data-toggle="collapse" data-target="#notif-pane"><span class="d-none d-md-inline-block">Notifikasi</span> <span class="badge rounded-pill bg-danger counter"></span></a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" id="dropSetting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-cogs d-block d-md-none"></i> <span class="d-none d-md-inline-block">Pengaturan</span></a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropUser">
							<?= anchor('admin/settings', '<i class="fal fa-globe"></i> Situs', ['class' => 'dropdown-item']); ?>
							<hr class="dropdown-divider" />
							<?= anchor('admin/settings/juragan', '<i class="fal fa-user-circle"></i> Juragan', ['class' => 'dropdown-item']); ?>
							<?= anchor('admin/settings/pengguna', '<i class="fal fa-users"></i> Pengguna', ['class' => 'dropdown-item']); ?>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" href="#" id="dropUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fal fa-user d-block d-md-none"></i> <span class="d-none d-md-inline-block">
								<?= $_SESSION['name']; ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropUser">
							<?= anchor('user/sunting', 'Ubah Profil', ['class' => 'dropdown-item']); ?>
							<?= anchor('auth/keluar', 'Keluar', ['class' => 'dropdown-item']); ?>
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
	<div class="position-fixed bg-light notifCollapse collapse" id="notif-pane">
		<div class="d-flex flex-column">
			<div class="bg-dark shadow-sm sticky-top text-light d-flex align-items-center px-3 py-2">
				Notifikasi
				<div class="ml-auto">
					<button type="button" class="btn btn-light btn-sm btnSettingNotif" data-toggle="dropdown" aria-expanded="false">
						<span class="fal fa-ellipsis-h-alt"></span>
					</button>
					<ul class="dropdown-menu">
						<li><button class="dropdown-item tandaiSemuaTerbaca" type="button">Tandai semua sudah dibaca</button></li>
					</ul>
				</div>

			</div>
			<div class="list-group list-group-flush" id="notifDisini"></div>
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