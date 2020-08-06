<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5'); ?>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<?php
	$meta = array(
		array(
			'name' => 'X-UA-Compatible',
			'content' => 'IE=edge', 'type' => 'equiv'
			),
		array(
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1'
			),
		/*
		array(
			'name' => 'description',
			'content' => 'My Great Site'
			),
		array(
			'name' => 'keywords',
			'content' => 'love, passion, intrigue, deception'
			),
		*/
			);

	echo meta($meta);
	// 
	echo link_tag('assets/css/bootstrap.min.css');
	echo link_tag('assets/css/backend.css');
	echo link_tag('https://cdn.rawgit.com/t4t5/sweetalert/32bd141c/dist/sweetalert.css');
	?>
	<title><?php echo judul('full'); ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>

<body><?php 
	$session_pesan = $this->session->userdata('pesan_tampil');
	if($session_pesan) { echo '<div class="alert alert-info alert-custom">' . $this->session->userdata('pesan') . '</div>'; $this->session->unset_userdata('pesan');?>
	<?php } $this->session->unset_userdata('pesan_tampil');?>

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
				<?php echo anchor('admin', judul('name') . '<sup class="text-danger"><small>v' . judul('version') . '</small></sup>' , array('class' => 'navbar-brand')); ?>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle deropdowen" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pesanan <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php
							$username = $this->session->userdata('username');
							$dr = $this->pengguna->_juragan_cs($username);
							foreach ($dr->result() as $j) {
								$_transfer = $this->pesanan->count('transfer', 'tidak', $j->id);
								$_kirim = $this->pesanan->count('kirim', 'pending', $j->id);

								$detail_ = ' <i class="glyphicon glyphicon-bullhorn text-muted"></i> ' . $_transfer . ' / ' . $_kirim;
								echo '<li>' . anchor($j->slug, $j->nama . $detail_) . '</li>';
							}
							?>
						</ul>
					</li>
					<li><?php echo anchor($this->uri->segment(1) . '/chart', 'Chart'); ?></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->nama; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<!-- <li><?php echo anchor('auth/sunting/pass', 'Ganti Password'); ?></li> -->
							<li role="separator" class="divider"></li>
							<li><?php echo anchor('logout', 'Keluar'); ?></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
