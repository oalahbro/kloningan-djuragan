<div class="container-fluid">
	<!-- start .page-content -->
	<div class="page-content">
		<?php echo $this->load->view('admin/include/menu_satu'); $get_kategori = input_get('kategori'); ?>
		
		<div class="content-inti" id="reload">	
			<div class="" id="load"></div>
			<div class="nav-margin">
				<ul class="nav nav-tabs">
					<?php foreach ($kategori as $kat) { 
						$active = '';
						if($get_kategori === $kat->id)
						{
							$active = ' class="active"';
						}
						echo '<li role="presentation"'. $active.'>' . anchor('administrator/produk?kategori=' . $kat->id, $kat->nama, array()) . '</li>';
						?>
						<?php } ?>
					</ul>
					</div>
				<div class="row">
					<?php	if( ! empty($get_kategori)) { ?>
					<div class="col-sm-8">
					<!-- list produk per kategori -->
						<div class="table-responsive">
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Produk</th>
										<th>Kode </th>
										<th>Harga</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; foreach ($produk->result() as $key) { ?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo anchor('administrator/edit_produk/'.url_title($key->nama).'/'.$key->id, $key->nama, array('class' => 'manual', 'id' => 'edit-'.$key->id)) .
																	 anchor('administrator/hapus_produk/alert/'.$key->id .'/' . $get_kategori, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'manual btn-danger btn btn-xs pull-right', 'id' => 'hapus-'.$key->id)); ?></td>
										<td class="text-center"><?php echo $key->kode; ?></td>
										<td class="text-right"><?php echo harga($key->harga); ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<?php echo anchor('administrator/hapus_kategori/alert/'.$get_kategori, 'Hapus Kategori', array('class' => 'manual btn btn-danger')); ?>
					<!-- list produk per kategori -->
					</div>
					<?php } ?>

					<?php if(empty($get_kategori)) { ?>
					<div class="col-sm-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								Tambah Kategori
							</div>
							<div class="panel-body">
								<?php echo form_open('administrator/tambah_kategori') ?>
								<div class="form-group">
									<label for="nama_produk">Nama Kategori</label>
									<?php echo form_input(array('name' => 'nama_kategori', 'id' => 'nama_produk', 'class' => 'form-control', 'placeholder' => 'nama kategori', 'maxlength' => '100')) ?>
								</div>
								<button type="submit" class="btn btn-primary btn-block">Tambah Kategori</button>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if( ! empty($get_kategori))
					{ ?>
					<div class="col-sm-4">
						<div class="panel panel-success">
							<div class="panel-heading">
								Tambah Produk
							</div>
							<div class="panel-body">
								<?php echo form_open('administrator/tambah_produk', '', array('kategori_id' => $get_kategori));?>
						<div class="form-group">
							<label for="nama_produk">Nama Produk</label>
							<?php echo form_input(array('name' => 'nama_produk', 'id' => 'nama_produk', 'class' => 'form-control', 'placeholder' => 'nama produk -- max.100', 'maxlength' => '100')) ?>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="kode_produk">Kode Produk</label>
									<?php echo form_input(array('name' => 'kode_produk', 'id' => 'kode_produk', 'class' => 'form-control', 'placeholder' => 'kode produk -- max.10', 'maxlength' => '10')) ?>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="form-group">
									<label for="harga_produk">Harga Produk</label>
									<?php echo form_input(array('name' => 'harga_produk', 'id' => 'harga_produk', 'class' => 'form-control', 'placeholder' => 'harga produk -- cukup angka saja tanpa huruf atau tanda apapun', 'maxlength' => '10')) ?>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Tambah Produk</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
</div>