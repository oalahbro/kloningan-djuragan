<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5'); ?>
<html>
<head>
	<meta charset="utf-8"/>
	<?php
	$meta = array(
		array(
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1'
			),
		);

	echo meta($meta);
	// 
	echo link_tag('berkas/css/bootstrap.min.css');
	echo link_tag('berkas/css/backend.css');
	// echo link_tag('berkas/css/fontawesome.css');
	// echo link_tag('berkas/css/solid.css');
	?>
	

	<title><?php echo judul('full'); ?></title>
	<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('berkas/js/backend.js'); ?>"></script>
	<script src="https://use.fontawesome.com/releases/v5.6.3/js/solid.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.6.3/js/fontawesome.js"></script>
</head>

<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
	<div>
		<?php echo anchor('', judul('name') , array('class' => 'navbar-brand')); ?>
		<button class="sidebar-toggle"><i class="fas fa-folder"></i> Pesanan</button>
	</div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
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
  </div>
</nav>

<div class="d-flex align-items-stretch">
    <div class="sidebar bg-dark toggled">
        <ul class="list-unstyled">
			<?php
			$username = $this->session->userdata('username');
			$dr = $this->pengguna->_juragan_cs($username);

			foreach ($dr->result() as $key) {
				echo '<li>';
					echo anchor('j_' . $key->slug, '<i class="fas fa-user-circle"></i> ' . $key->nama, array());
				echo '</li>';
			}
			?>
        </ul>
    </div>
<?php


?>
	<?php /*
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
*/ ?>