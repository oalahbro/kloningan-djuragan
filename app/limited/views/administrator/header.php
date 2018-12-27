<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5'); 
$dr = $this->juragan->_semua();
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
				<?php echo anchor('add/pesanan', 'Tulis Pesanan', array('class'=>'nav-link')) ?>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Arsip Pesanan
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<?php
					echo anchor('arsip', 'Semua Juragan', array('class'=> 'dropdown-item'));
					echo '<div class="dropdown-divider"></div>';
					foreach ($dr->result() as $key) {
						echo anchor('arsip/pesanan/' . $key->slug . '/all', $key->nama, array('class'=> 'dropdown-item'));
					}
					?>
				</div>
			</li>
		</ul>
  </div>
</nav>

<div class="d-flex align-items-stretch">
    <div class="sidebar bg-dark toggled">
        <ul class="list-unstyled">
			<?php
			echo '<li>' .anchor('pesanan/s_juragan', '<i class="fas fa-users"></i> Semua Juragan') . '</li>';
			foreach ($dr->result() as $key) {
				echo '<li>';
					echo anchor('pesanan/' . $key->slug, '<i class="fas fa-user-circle"></i> ' . $key->nama);
				echo '</li>';
			}
			?>
        </ul>
    </div>