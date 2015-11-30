<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * admin/Header.php
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		6.0.0
 */
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?php echo title('namever') ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('assets/css/custom.css'); ?>"/>
</head>

<body><?php /*
$session_pesan = $this->session->userdata('pesan_tampil');
if($session_pesan) { echo '<div class="alert alert-info alert-custom">' . $this->session->userdata('pesan') . '</div>'; $this->session->unset_userdata('pesan');?>
<?php } $this->session->unset_userdata('pesan_tampil'); */ ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu_navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo anchor('admin', title('name') . '<sup class="text-danger"><small>v'. title('ver') .'</small></sup>', array('class' => 'navbar-brand')) ?>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="menu_navbar">
			<div id="menus">
				<ul class="nav navbar-nav">
					<li class="dropdown<?php if($menu_active === 'pesanan') {echo ' active';} ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-th-large"></i> Daftar Pesanan <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<?php 
							foreach(show_juragan()->result() as $row) {
								if($row->transfer > 0) {
									$txt_transfer = 'text-danger text-bold';
								}
								else {
									$txt_transfer = 'text-muted';
								}

								if($row->kirim > 0) {
									$txt_kirim = 'text-danger text-bold';
								}
								else {
									$txt_kirim = 'text-muted';
								}

								if($row->kirim > 0 || $row->transfer > 0) {
									$text_alert = 'text-warning';
								}
								else {
									$text_alert = 'text-muted';
								}

								$nama = $row->juragan . ' <small><i class="glyphicon glyphicon-bullhorn ' . $text_alert .'"></i> <span class="' .$txt_transfer. '">' . $row->transfer . '</span> / <span class="' .$txt_kirim. '">' . $row->kirim . '</span></small>';
							
								echo '<li>' . anchor('admin/pesanan/' . $halaman . '/'. $row->username, $nama) . '</li>';
							}
							?>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-plus"></i> Tambah Pesanan <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<?php 
							foreach(show_juragan()->result() as $row) {
								echo '</li>' . anchor('administrator/tambah/'.$row->user_id, $row->juragan) . '</li>';
							}
							?>
						</ul>
					</li>
					<li><?php echo anchor('admini/status', '<i class="glyphicon glyphicon-sort-by-order"></i> Status' ) ?></li>
					<li><?php echo anchor('admini/stock', '<i class="glyphicon glyphicon-compressed"></i> Stock' ) ?></li>
					<li><?php echo anchor('admini/export', '<i class="glyphicon glyphicon-save"></i> Export') ?></li>
				</ul>
				
				<?php /*
				$pending_kirim = get_count(NULL, 'kirim', 'Pending');
				$pending_transfer = get_count(NULL, 'transfer', 'Belum');

				$total_pending = $pending_kirim + $pending_transfer;
				if($total_pending > 0)
				{
					$pendingan = $total_pending;
				}
				else
				{
					$pendingan = '0';
				}

				if($pending_kirim > 0)
				{
					$kiriman = $pending_kirim;
				}
				else
				{
					$kiriman = '0';
				}
				if($pending_transfer > 0)
				{
					$transferan = $pending_transfer;
				}
				else
				{
					$transferan = '0';
				}
				*/
				?>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-bullhorn"></i> Notifikasi <span class="label label-danger"><?php // echo $pendingan ?></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?php // echo anchor('administrator?pg=pending', '<span class="label label-danger">'. $kiriman .'</span> kiriman pending') ?></li>
							<li><?php // echo anchor('administrator?pg=pending', '<span class="label label-danger">'. $transferan .'</span> transfer pending') ?></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> Pengaturan <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?php echo anchor('administrator/produk', 'Produk'); ?></li>
							<li><?php echo anchor('administrator/juragan', 'Juragan'); ?></li>
							<li><?php echo anchor('administrator/pengaturan', 'Lainnya'); ?></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo data_session('nama') ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?php echo anchor('', 'Ubah Password'); ?></li>
							<li class="divider"></li>
							<li><?php echo anchor('logout', 'Logout') ?></li>
						</ul>
					</li>
					
				</ul>
			</div>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

