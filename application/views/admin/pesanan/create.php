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
							$hidden_form = array();
							echo form_open_multipart('', $atribut_form, $hidden_form);
						?>
						<div class="panel-body">

							<!-- field nama -->
							<div class="form-group <?php // if( ! empty(form_error('nama'))) {echo 'has-error';} ?>">
								<label for="nama">Nama</label>
								<div class="row">
									<div class="col-sm-4">
										<?php echo form_input(array( 'value' => set_value('nama'), 'name' => 'nama', 'id' => 'nama', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nama')); ?>
									</div>
								</div>
							</div>

							<!-- field alamat -->
							<div class="form-group <?php // if( ! empty(form_error('alamat'))) {echo 'has-error';} ?>">
								<label for="alamat">Alamat</label>
								<div class="row">
									<div class="col-sm-8">
										<?php echo form_textarea(array( 'value' => set_value('alamat'), 'name' => 'alamat', 'id' => 'alamat', 'class' => 'form-control', 'required' => '', 'placeholder' => 'alamat lengkap', 'rows' => '4')); ?>
									</div>
								</div>
							</div>

							<!-- field hape -->
							<div class="form-group <?php // if( ! empty(form_error('hp'))) {echo 'has-error';} ?>">
								<label for="hp">HP</label>
								<div class="row">
									<div class="col-sm-3">
										<?php echo form_input(array('value' => set_value('hp'), 'name' => 'hp', 'id' => 'hp', 'class' => 'form-control', 'required' => '', 'placeholder' => '08xxxxxxxx', 'maxlength' => '14')); ?>
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
												<?php echo form_input(array('autocomplete' => 'off', 'value' => set_value('kode[]'), 'data-items' => '3', 'class' => 'form-control kode typeahead', 'required' => '', 'name' => 'kode[]', 'placeholder' => 'kode produk')) ?>
											</div>
										</div> <!-- /kode -->
										<div class="col-sm-4">
											<div class="input-group">
												<span class="input-group-addon">UKURAN</span>
												<select required="" name="size[]" class="form-control size">
													<option selected="" disabled="">-- ukuran --</option>
													<?php /* $query = $this->produk_model->get_size()->result();
													foreach ($query as $size) { ?>
													<option value="<?php echo $size->size; ?>" <?php echo set_select('size[]', $size->size); ?>><?php echo $size->size; ?></option>
													<?php } */ ?>
												</select>
											</div>
										</div> <!-- /size -->
										<div class="col-sm-3">
											<div class="input-group">
												<span class="input-group-addon">JUMLAH</span>
												<?php echo form_input(array('value' => set_value('jumlah[]'), 'class' => 'form-control jumlah', 'required' => '', 'name' => 'jumlah[]', 'placeholder' => 'jumlah', 'type' => 'number', 'min' => '1')) ?>
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
							<div class="form-group <?php // if( ! empty(form_error('harga'))) {echo 'has-error';} ?>">
								<label for="harga">Harga Barang</label>
								<div class="row">
									<div class="col-sm-3">
										<div class="input-group"> 
											<span class="input-group-addon">Rp</span>
											<?php echo form_input(array('value' => set_value('harga'), 'name' => 'harga', 'id' => 'harga', 'class' => 'form-control', 'required' => '', 'placeholder' => '280000')); ?>
										</div>
									</div>
								</div>
							</div>

							<!-- field ongkir -->
							<div class="form-group <?php  // if( ! empty(form_error('ongkir'))) {echo 'has-error';} ?>">
								<label for="ongkir">Ongkir</label>
								<div class="row">
									<div class="col-sm-3">
										<div class="input-group">
											<span class="input-group-addon">Rp</span>
											<?php echo form_input(array('value' => set_value('ongkir'), 'name' => 'ongkir', 'id' => 'ongkir', 'class' => 'form-control', 'required' => '', 'placeholder' => '20000')); ?>
										</div>
									</div>
								</div>
							</div>

							<!-- field transfer -->
							<div class="form-group <?php // if( ! empty(form_error('transfer'))) {echo 'has-error';} ?>">
								<label for="transfer">Total Transfer</label>
								<div class="row">
									<div class="col-sm-3">
										<div class="input-group">
											<span class="input-group-addon">Rp</span>
											<?php echo form_input(array('value' => set_value('transfer') ,'name' => 'transfer', 'id' => 'transfer', 'class' => 'form-control', 'required' => '', 'placeholder' => '300000')); ?>
										</div>
									</div>
								</div>
							</div>

							<!-- field transfer -->
							<div class="form-group <?php // if( ! empty(form_error('status'))) {echo 'has-error';} ?>">
								<label for="orderStatus">Status Pembayaran</label>

								<div class="radio">
									<label>
										<input required="" id="orderStatus2" value="Lunas" type="radio" name="status" <?php echo set_radio('status', 'Lunas'); ?>>
										<span class="label label-success">Lunas</span>
									</label>
								</div>
								<div class="radio">
									<label>
										<input required="" id="orderStatus1" value="DP" type="radio" name="status" <?php echo set_radio('status', 'DP'); ?>>
										<span class="label label-warning">DP</span> <small><em>--down payment--</em></small>
									</label>
								</div>
							</div>

							<!-- field bank -->
							<div class="form-group <?php // if( ! empty(form_error('bank'))) {echo 'has-error';} ?>">
								<label for="bank">BANK</label>
								<div class="row">
									<div class="col-sm-2">
										<?php echo form_input(array('value' => set_value('bank'), 'name' => 'bank', 'id' => 'bank', 'class' => 'form-control', 'required' => '', 'placeholder' => 'bank')); ?>
									</div>
								</div>
							</div>

							<!-- field keterangan -->
							<div class="form-group">
								<label for="keterangan">Keterangan</label>
								<div class="row">
									<div class="col-sm-6">
										<?php echo form_textarea(array('value' => set_value('keterangan'), 'name' => 'keterangan', 'id' => 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan', 'rows' => '4')); ?>
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
