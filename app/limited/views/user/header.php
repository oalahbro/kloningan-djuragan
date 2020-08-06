<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5'); 
$username = $this->session->userdata('username');
$dr = $this->pengguna->_juragan_cs($username);
?>
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
	?>

	<title><?php echo $judul; ?></title>
    <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('berkas/js/bootstrap.bundle.min.js'); ?>"></script>
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
				<?php echo anchor('myneworder', 'Tulis Pesanan', array('class'=>'nav-link')) ?>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Arsip Pesanan
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<?php
					foreach ($dr->result() as $key) {
						echo anchor('kardusin/' . $key->slug . '/all', $key->nama, array('class'=> 'dropdown-item'));
					}
					?>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
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

<div class="d-flex align-items-stretch">
    <div class="sidebar bg-dark toggled">
        <ul class="list-unstyled">
			<?php
			foreach ($dr->result() as $key) {
				echo '<li>';
					echo anchor('myorder/' . $key->slug, '<i class="fas fa-user-circle"></i> ' . $key->nama, array());
				echo '</li>';
			}
			?>
        </ul>
    </div>