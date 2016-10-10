<?php
$warna = $this->session->userdata('juragan')['warna_juragan'];

$rgb = _HTMLToRGB($warna);
$hsl = _RGBToHSL($rgb);
if($hsl->lightness > 150) {
	$class_navbar = 'light';
}
else {
	$class_navbar = 'dark';
}

?>

<div class="pos-f-t">
	<div class="collapse" id="navbar-header">
		<div class="container-fluid bg-inverse p-a-1">
			<h3>Pilih Juragan yang akan dikelola</h3>
			<ul class="list list-inline">
			<?php 
			$row = _auth()->row();
			$list = explode(',' , $row->allow_id);
			shuffle($list);

			foreach($list as $i => $key) {
				$username = $this->juragan->ambil_username_by_id($key);
				$nama = $this->juragan->ambil_nama_by_id($key);
				$url_nama = url_title($nama, '-', TRUE);

				$hsl_ = _RGBToHSL(_HTMLToRGB(_warna($url_nama)));
				if($hsl_->lightness > 150) {
					$btn_class = 'light';
				}
				else {
					$btn_class = 'dark';
				}

				echo '<li class="list-inline-item">';
				echo anchor('juragan/pesanan/pilih_juragan/' . $key . '/' . $url_nama, $nama, array('class' => 'btn btn-'. $btn_class, 'style' => 'background-color:' . _warna($url_nama) . ';') );
				echo '</li>';
			} ?>
		</ul>
		</div>
	</div>
	<div id="scrolll" class="navbar clearHeader navbar-full navbar-<?php echo $class_navbar; ?> bg-faded navbar-static-top" style="background-color:<?php echo $warna; ?>;" role="navigation">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-header">
			&#9776;
		</button>
		<?php echo anchor('', $juragan, array('class' => 'navbar-brand')); ?>

		<div id="sticker">
			<ul class="nav navbar-nav">
				<li class="nav-item btn-group">
					<a class="dropdown-toggle nav-link" id="dropdown-pesanan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Pesanan
					</a>
					<div class="dropdown-menu" aria-labelledby="dropdown-pesanan">
						<?php
						echo anchor('juragan/pesanan/daftar/all', 'Semua', array('class' => 'dropdown-item'));
						echo anchor('juragan/pesanan/daftar/terkirim', 'Terkirim', array('class' => 'dropdown-item'));
						echo anchor('juragan/pesanan/daftar/pending', 'Pending', array('class' => 'dropdown-item'));
						?>
					</div>
				</li>
				<li class="nav-item"><?php echo anchor('juragan/pesanan/tulis-baru', 'Tambah Pesanan', array('class' => 'nav-link'));?></li>
				<li class="nav-item"><?php echo anchor('juragan/stock', 'Stok', array('class' => 'nav-link'));?></li>
				<li class="nav-item"><?php echo anchor('juragan/status', 'Status', array('class' => 'nav-link'));?></li>
			</ul>
			
			<ul class="nav navbar-nav pull-xs-right">
				<li class="nav-item btn-group">
					<a class="dropdown-toggle nav-link" id="dropdown-pesanan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo data_session('nama'); ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-pesanan">
						<?php
						echo anchor('juragan/profil', 'Ubah Password', array('class' => 'dropdown-item'));
						echo anchor('logout', 'Keluar', array('class' => 'dropdown-item'));
						?>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>