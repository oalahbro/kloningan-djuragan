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
					echo anchor('admin/pesanan/read/' . $juragan . '/all', '<i class="glyphicon glyphicon-th-large"></i> Semua', array('class' => 'btn btn-default'));
					echo anchor('admin/pesanan/read/' . $juragan . '/terkirim', '<i class="glyphicon glyphicon-thumbs-up"></i> Terkirim', array('class' => 'btn btn-default'));
					echo anchor('admin/pesanan/read/' . $juragan . '/pending', '<i class="glyphicon glyphicon-repeat"></i> Pending', array('class' => 'btn btn-default'));
					echo anchor('admin/pesanan/create/' . $juragan, '<i class="glyphicon glyphicon-plus"></i> Tambah', array('class' => 'btn btn-primary'));
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-danger">
				<?php 
					$atribut_form = array('class' => 'form-horizontal');
					$hidden_form = array('image' => '');
					echo form_open_multipart('', $atribut_form, $hidden_form);
				?>
				<div class="panel-body">
					<?php if($member !== NULL) { ?>
						<!-- field nama member -->
						<div class="form-group">
							<label for="nama">Nama Member</label>
							<div class="row">
								<div class="col-sm-4">
									<select class="form-control" name="member_id">
										<option selected="" disabled="">- pilih member -</option>
										<?php foreach ($member->result() as $members) { ?>
											<option value="<?php echo $members->id; ?>"><?php echo $members->nama_member; ?> (<?php echo $members->user_card; ?>)</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					<?php } ?>

					<!-- field nama -->
					<div class="form-group">
						<label for="nama">Nama</label>
						<div class="row">
							<div class="col-sm-4">
								<?php 
								echo form_input(
									array(
										'name' => 'nama',
										'id' => 'nama',
										'class' => 'form-control',
										'placeholder' => 'nama'
									),
									set_value('nama')
								);
								?>
							</div>
						</div>
					</div>

					<!-- field alamat -->
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<div class="row">
							<div class="col-sm-8">
								<?php 
								echo form_textarea(
									array(
										'name' => 'alamat',
										'id' => 'alamat',
										'class' => 'form-control',
										'placeholder' => 'alamat lengkap',
										'rows' => '4'
									),
									set_value('alamat')
								);
								?>
							</div>
						</div>
					</div>

					<!-- field hape -->
					<div class="form-group">
						<label for="hp">HP</label>
						<div class="row">
							<div class="col-sm-3">
								<?php
								echo form_input(
									array(
										'name' => 'hp',
										'id' => 'hp',
										'class' => 'form-control',
										'placeholder' => '08xxxxxxxx',
										'maxlength' => '14'
									),
									set_value('hp')
								);
								?>
							</div>
						</div>
					</div>

					<!-- field kode, size, jumlah -->
					<div class="form-group">
						<label>Kode / Ukuran / Jumlah</label>
						<div class="clonedInput cloning" id="entry1">
							<div class="row multiple-form-group entry" > <!-- data-max="3" -->
								<div class="col-sm-5">
									<div class="input-group">
										<span class="input-group-addon">KODE</span>
										<?php
										echo form_input(
											array(
												'autocomplete' => 'off',
												'data-items' => '3',
												'class' => 'form-control kode typeahead',
												'name' => 'kode[]',
												'placeholder' => 'kode produk'
											),
											set_value('kode[]')
										);
										?>
									</div>
								</div> <!-- /kode -->
								<div class="col-sm-4">
									<div class="input-group">
										<span class="input-group-addon">UKURAN</span>
										<?php 
											$query = $this->pesanan->get_size()->result();

											$options = array();
											$options['0'] = '-- pilih size --';
											foreach ($query as $size) {
												$options[$size->size] = $size->size;
											}

											echo form_dropdown('size[]', $options, '', array('id' => 'size' , 'class' => 'form-control size'));
										 ?>
									</div>
								</div> <!-- /size -->
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">JUMLAH</span>
										<?php
										echo form_input(
											array(
												'class' => 'form-control jumlah',
												'name' => 'jumlah[]',
												'placeholder' => 'jumlah',
												'type' => 'number',
												'min' => '1'
											),
											set_value('jumlah[]')
										);
										?>
									</div>
								</div> <!-- /jumlah -->
							</div>
						</div>
						
						<div class="btn-group" role="group" aria-label="...">
							<button type="button" id="btnAdd" name="btnAdd" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
							<button type="button" id="btnDel" name="btnDel" class="btn btn-danger"><i class="glyphicon glyphicon-minus"></i></button>
						</div>
					</div>

					<!-- field harga -->
					<div class="form-group">
						<label for="harga">Harga Barang</label>
						<div class="row">
							<div class="col-sm-3">
								<div class="input-group"> 
									<span class="input-group-addon">Rp</span>
									<?php 
									echo form_input(
										array(
											'name' => 'harga',
											'id' => 'harga',
											'class' => 'form-control',
											'placeholder' => '280000'
										),
										set_value('harga')
									);
									?>
								</div>
							</div>
						</div>
					</div>

					<!-- field ongkir -->
					<div class="form-group">
						<label for="ongkir">Ongkir</label>
						<div class="row">
							<div class="col-sm-3">
								<div class="input-group">
									<span class="input-group-addon">Rp</span>
									<?php
									echo form_input(
										array(
											'name' => 'ongkir',
											'id' => 'ongkir',
											'class' => 'form-control',
											'placeholder' => '20000'
										),
										set_value('ongkir')
									);
									?>
								</div>
							</div>
						</div>
					</div>

					<!-- field transfer -->
					<div class="form-group">
						<label for="transfer">Total Transfer</label>
						<div class="row">
							<div class="col-sm-3">
								<div class="input-group">
									<span class="input-group-addon">Rp</span>
									<?php
									echo form_input(
										array(
											'name' => 'transfer',
											'id' => 'transfer',
											'class' => 'form-control',
											'placeholder' => '300000'
										),
										set_value('transfer')
									);
									?>
								</div>
							</div>
						</div>
					</div>

					<!-- field transfer -->
					<div class="form-group">
						<label for="orderStatus">Status Pembayaran</label>
						<div class="radio">
							<label>
								<input id="orderStatus2" value="Lunas" type="radio" name="status" <?php echo set_radio('status', 'Lunas'); ?>>
								<span class="label label-success">Lunas</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input id="orderStatus1" value="DP" type="radio" name="status" <?php echo set_radio('status', 'DP'); ?>>
								<span class="label label-warning">DP</span> <small><em>--down payment--</em></small>
							</label>
						</div>
					</div>

					<!-- field bank -->
					<div class="form-group">
						<label for="bank">BANK</label>
						<div class="row">
							<div class="col-sm-2">
								<?php
								echo form_input(
									array(
										'name' => 'bank',
										'id' => 'bank',
										'class' => 'form-control',
										'placeholder' => 'bank'
									),
									set_value('bank')
								);
								?>
							</div>
						</div>
					</div>

					<!-- field keterangan -->
					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<div class="row">
							<div class="col-sm-6">
								<?php
								echo form_textarea(
									array(
										'name' => 'keterangan',
										'id' => 'keterangan',
										'class' => 'form-control',
										'placeholder' => 'keterangan',
										'rows' => '4'
									),
									set_value('keterangan')
								);
								?>
							</div>
						</div>
					</div>

					<!-- field custom gambar -->
					<div class="form-group">
						<label for="custom gambar">Custom Gambar</label>
						<div class="tombol-picker">
							<button type="button" class="btn btn-info" id="DOCS_IMAGES">Pilih / Unggah Gambar</button>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<pre id="result">Tidak ada gambar</pre>
							</div>
						</div>
					</div>

				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary"> Simpan </button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
