<div class="page-header">
	<div class="title-page">
		<div class="container-fluid">
			<h1><?php echo $judul; ?></h1>
		</div>
	</div>

	<div class="subnav">
		<div class="container-fluid">
			<div class="row">
				<div class="menu col-sm-9">
					<?php 
							// set aktif tombol semua
					$status_all = 'btn-default';
					if($status === 'all') {
						$status_all = 'btn-primary';
					}

							// set aktif tombol terkirim
					$status_terkirim = 'btn-default';
					if($status === 'terkirim') {
						$status_terkirim = 'btn-primary';
					}

							// set aktif tombol pending
					$status_pending = 'btn-default';
					if($status === 'pending') {
						$status_pending = 'btn-primary';
					}

					echo anchor('admin/pesanan/read/' . $juragan . '/all', '<i class="glyphicon glyphicon-th-large"></i> Semua', array('class' => 'btn ' . $status_all));
					echo anchor('admin/pesanan/read/' . $juragan . '/terkirim', '<i class="glyphicon glyphicon-thumbs-up"></i> Terkirim', array('class' => 'btn ' . $status_terkirim));
					echo anchor('admin/pesanan/read/' . $juragan . '/pending', '<i class="glyphicon glyphicon-repeat"></i> Pending', array('class' => 'btn ' . $status_pending));
					?>
				</div>
				<div class="cari col-sm-3">
					<form name="form">
						<div class="input-group">
							<input type="text" name="name" value="" autocomplete="off" data-date-format="YYYY-MM-DD" id="fn" class="form-control dates" placeholder="pencarian data"/>
							<div class="input-group-btn">
								<button type="submit" id="search-btn" class="btn btn-primary" ><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="container-fluid">

	<div class="page-content" id="daftar_pesanan">

	</div>
</div>
