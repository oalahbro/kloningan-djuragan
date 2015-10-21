<?php 
/**
 * pesanan()
 *
 * by mylastof@gmail.com 
 * --- checked 23/12/2014 ---
 */
 ?>
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
			<?php echo anchor('administrator', title('name') . '<sup class="text-danger"><small>v'. title('ver') .'</small></sup>', array('class' => 'navbar-brand')) ?>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="menu_navbar">
			<div id="menus">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-th-large"></i> Daftar Pesanan <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<?php foreach(dropdown_user()->result() as $row) { ?>
							<?php if($row->transfer > 0){ $txt_transfer = 'text-danger text-bold'; } else {$txt_transfer = 'text-muted';}
							if($row->kirim > 0) {$txt_kirim = 'text-danger text-bold';} else {$txt_kirim = 'text-muted';}
							if($row->kirim > 0 || $row->transfer > 0) {$text_alert = 'text-warning';} else {$text_alert = 'text-muted';}

							$nama = $row->juragan . ' <small><i class="glyphicon glyphicon-bullhorn ' . $text_alert .'"></i>
							<span class="' .$txt_transfer. '">' . $row->transfer . '</span> / <span class="' .$txt_kirim. '">' . $row->kirim . '</span></small>';
							?>
							<li><?php echo anchor('administrator?pg=' .$halaman. '&juragan='.$row->user_id, $nama); ?></li>
							<?php } ?>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-plus"></i> Tambah Pesanan <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<?php foreach(dropdown_user()->result() as $row) { ?>
							<li><?php echo anchor('administrator/tambah/'.$row->user_id, $row->juragan); ?></li>
							<?php } ?>
						</ul>
					</li>
					<li><?php echo anchor('administrator/status', '<i class="glyphicon glyphicon-sort-by-order"></i> Status' ) ?></li>
					<li><?php echo anchor('administrator/stock', '<i class="glyphicon glyphicon-compressed"></i> Stock' ) ?></li>
					<li><?php echo anchor('administrator/export', '<i class="glyphicon glyphicon-save"></i> Export') ?></li>
				</ul>
				
				<?php 
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

				?>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-bullhorn"></i> Notifikasi <span class="label label-danger"><?php echo $pendingan ?></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?php echo anchor('administrator?pg=pending', '<span class="label label-danger">'. $kiriman .'</span> kiriman pending') ?></li>
							<li><?php echo anchor('administrator?pg=pending', '<span class="label label-danger">'. $transferan .'</span> transfer pending') ?></li>
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