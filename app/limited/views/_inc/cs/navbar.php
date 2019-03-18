<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
	<div>
		<?php echo anchor('', judul('name') , array('class' => 'navbar-brand')); ?>
		<?php echo form_button(array('class' => 'btn-juragan', 'data-toggle' => "collapse", 'data-target' => "#sidebar", 'id' => 'sidebarCollapse', 'content' => '<i class="fas fa-user-circle"></i>')); ?>
	</div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item">
				<?php echo anchor('faktur/tambah', 'Tulis Pesanan', array('class'=>'nav-link')) ?>
			</li>
			<li class="nav-item">
				<?php echo anchor('chart', 'Chart', array('class'=>'nav-link')) ?>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<li class="nav-item dropdown" id="notif">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="badge badge-danger counter" id="count">0</span> Notifikasi
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<?php echo anchor('notifikasi', 'Lihat semua <span class="counter"></span>', array('class' => 'small d-block px-3 py-2 text-primary')); ?>
					<div id="notifKonten" class="notifikasiDrop"></div>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo $_SESSION['nama']; ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<?php echo anchor('keluar', 'Keluar', array('class' => 'dropdown-item')); ?>
				</div>
			</li>
		</ul>
    </div>
</nav>

<div class="wrapper">
	<nav id="sidebar" class="collapse bg-dark">
		<div class="sidebar" id="listJuragan"></div>
	</nav>
	<div class="d-flex align-items-stretch">
	