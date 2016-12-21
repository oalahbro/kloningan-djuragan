<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hsl = _RGBToHSL(_HTMLToRGB($warna));
if($hsl->lightness > 150) {
	$class_navbar = 'light';
}
else {
	$class_navbar = 'dark';
}


?><!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?php echo $title; ?></title>

	<?php echo link_tag('assets/css/bootstrap.min.css'); ?>
	<?php echo link_tag('assets/css/gayabaru.css'); ?>
	<?php echo link_tag('assets/css/sweetalert.css'); ?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.pjax.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/pace.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/typeahead.bundle.js'); ?>"></script>	


	<script type="text/javascript">
		$(document).pjax('a[data-pjax]', '#main', { 
			fragment: '#main', 
			timeout: 3000 
		});
	</script>
</head>
<body>
	<div id="main">
	<div class="pos-f-t">
		<div class="collapse" id="navbar-header">
			<div class="container-fluid p-1">
				<h3>Pilih Juragan</h3>
				<?php 
				// notif
				foreach ($this->juragan->anbil_data()->result() as $j) { 

					$hsl_ = _RGBToHSL(_HTMLToRGB($j->warna_default));
					if($hsl_->lightness > 150) {
						$btn_class = 'light';
					}
					else {
						$btn_class = 'dark';
					}


						$notif_transfer = "<span class='tag tag-pill tag-danger'>".$j->transfer_pending."</span>";

						$notif_kirim = "<span class='tag tag-pill tag-info'>".$j->kirim_pending."</span>";

					$stt = array(
						'class' => 'btn btn-select btn-'. $btn_class, // btn btn-outline-primary btn-select
						'style' => 'background: ' . $j->warna_default
						);

					echo anchor('admin/pesanan/lihat/' . $j->nama_alias, $j->nama, $stt);
					?>
				<?php }

				 ?>
			</div>
		</div>
		<div class="navbar navbar-full bg-faded navbar-static-top navbar-<?php echo $class_navbar; ?>" style="background-color:<?php echo $warna; ?>;">
			<?php echo anchor('admin/pesanan', $nama_juragan, array('class' => 'navbar-brand', 'data-pjax' => '')); ?>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header" aria-expanded="false" aria-label="Toggle navigation"></button>

			<!-- <span class="navbar-text text-muted"><?php echo $title_navbar; ?></span> -->

			<div class="form-inline float-xs-right">
				<button class="btn btn-outline-warning hidden-sm-up" type="button" data-toggle="collapse" data-target="#menu-navbar-" aria-controls="menu-navbar-" aria-expanded="false" aria-label="Toggle navigation">Menu</button>
				</div>
			<div class="collapse navbar-toggleable-xs" id="menu-navbar-">
				<ul class="nav navbar-nav">
					<li class="nav-item dropdown<?php if($active === 'pesanan') {echo ' active';} ?>">
						<a class="nav-link dropdown-toggle" href="#!" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Daftar Pesanan
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<?php echo anchor('admin/pesanan/lihat/' . $juragan . '/semua', 'Semua', array('data-pjax' => '', 'class' => 'dropdown-item')); ?>
							<?php echo anchor('admin/pesanan/lihat/' . $juragan . '/pending', 'Pending', array('data-pjax' => '', 'class' => 'dropdown-item')); ?>
							<?php echo anchor('admin/pesanan/lihat/' . $juragan . '/terkirim', 'Terkirim', array('data-pjax' => '', 'class' => 'dropdown-item')); ?>
							<div class="dropdown-divider"></div>
							<?php echo anchor('admin/pesanan/lihat/' . $juragan . '/draft', 'Draft', array('data-pjax' => '', 'class' => 'dropdown-item')); ?>

						</div>
					</li>

					<li class="nav-item <?php if($active === 'tulis') {echo ' active';} ?>"><?php echo anchor('admin/pesanan/tulis/' . $juragan, 'Tulis Pesanan', array('class' => 'nav-link')); ?></li>
					<li class="nav-item <?php if($active === 'statistik') {echo ' active';} ?>"><?php echo anchor('admin/statistics', 'Statistik', array('class' => 'nav-link')); ?></li>
					<li class="nav-item <?php if($active === 'stok') {echo ' active';} ?>"><?php echo anchor('admin/stock', 'Stok', array('class' => 'nav-link')); ?></li>
					<li class="nav-item <?php if($active === 'eksport') {echo ' active';} ?>"><?php echo anchor('admin/pesanan/export', 'Eksport', array('class' => 'nav-link')); ?></li>
				</ul>

				<ul class="nav navbar-nav float-sm-right">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#!" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pengaturan
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
							<?php echo anchor('admin/pengaturan/produk', 'Data Produk', array('class' => 'dropdown-item')); ?>
							<?php echo anchor('admin/pengaturan/juragan', 'Data Juragan', array('class' => 'dropdown-item')); ?>
							<div class="dropdown-divider"></div>
							<?php echo anchor('admin/pengaturan/lainnya', 'Lainnya', array('class' => 'dropdown-item')); ?>

						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#!" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php echo data_session('nama'); ?>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
							<?php echo anchor('admin/pengaturan/password', 'Ubah Sandi', array('class' => 'dropdown-item')); ?>
							<div class="dropdown-divider"></div>
							<?php echo anchor('keluar', 'Keluar', array('class' => 'dropdown-item')); ?>

						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div id="content">