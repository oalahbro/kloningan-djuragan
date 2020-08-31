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
					$juragan = $this->juragan->ambil_username_by_id($pesanan->user_id);
					echo anchor('admin/pesanan/read/' . $juragan . '/all', '<i class="glyphicon glyphicon-th-large"></i> Semua', array('class' => 'btn btn-default'));
					echo anchor('admin/pesanan/read/' . $juragan . '/terkirim', '<i class="glyphicon glyphicon-thumbs-up"></i> Terkirim', array('class' => 'btn btn-default'));
					echo anchor('admin/pesanan/read/' . $juragan . '/pending', '<i class="glyphicon glyphicon-repeat"></i> Pending', array('class' => 'btn btn-default'));
					echo anchor('admin/pesanan/create/' . $juragan, '<i class="glyphicon glyphicon-plus"></i> Tambah', array('class' => 'btn btn-default'));
					echo anchor('admin/pesanan/read/' . $juragan, '<i class="glyphicon glyphicon-edit"></i> Sunting', array('class' => 'btn btn-primary'));
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
					$hidden_form = array('image' => $pesanan->customgambar, 'id' => $pesanan->id);
					echo form_open('', $atribut_form, $hidden_form);
				?>
				<div class="panel-body">
					<?php
					$juragan = $this->juragan->ambil_username_by_id($pesanan->user_id);
					$member = $this->juragan->memberlist($juragan);
					if($pesanan->member_id !== '0') { ?>
						<!-- field nama member -->
						<div class="form-group">
							<label for="nama">Nama Member</label>
							<div class="row">
								<div class="col-sm-4">
									<?php 
									$options = array();
									$options['0'] = '-- pilih member --';
									foreach ($member->result() as $members) {
										$options[$members->id] = strtoupper($members->nama_member) . ' (' . $members->user_card . ')';
									}
									echo form_dropdown('member_id', $options, $pesanan->member_id, array('id' => 'size', 'class' => 'form-control size'));
									?>
								</div>
							</div>
						</div>
					<?php } ?>

					<!-- field nama -->
					<div class="form-group">
						<label for="nama">Nama</label>
						<div class="row">
							<div class="col-sm-4">
								<?php echo form_input(array( 'name' => 'nama', 'id' => 'nama', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nama'),
								$pesanan->nama); ?>
							</div>
						</div>
					</div>

					<!-- field alamat -->
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<div class="row">
							<div class="col-sm-8">
								<?php echo form_textarea(array('name' => 'alamat', 'id' => 'alamat', 'class' => 'form-control', 'required' => '', 'placeholder' => 'alamat lengkap', 'rows' => '4'),
								str_ireplace('<br />', '', $pesanan->alamat)); ?>
							</div>
						</div>
					</div>

					<!-- field hape -->
					<div class="form-group">
						<label for="hp">HP</label>
						<div class="row">
							<div class="col-sm-3">
								<?php echo form_input(array('name' => 'hp', 'id' => 'hp', 'class' => 'form-control', 'required' => '', 'placeholder' => '08xxxxxxxx', 'maxlength' => '14'),
								$pesanan->hp); ?>
							</div>
						</div>
					</div>

					<!-- field kode, size, jumlah -->
					<div class="form-group">
						<label>Kode / Ukuran / Jumlah</label>

						<?php 
	                    $s = explode('#', $pesanan->pesanan);
	                    $ukuran = array_map('trim',explode("#", $pesanan->pesanan));
	                    $jumlah_array = count($ukuran);
	                    $mines_one = $jumlah_array-1;

	                    for ($i = 0; $i <  $jumlah_array; $i++) {
	                    	$data = array_map('trim',explode(",",$s[$i]));
	                    ?>

						<div class="clonedInput cloning" id="entry<?php echo $i+1; ?>">
							<div class="row multiple-form-group entry" >
								<div class="col-sm-5">
									<div class="input-group">
										<span class="input-group-addon">KODE</span>
										<?php echo form_input(array('autocomplete' => 'off', 'data-items' => '3', 'class' => 'form-control kode typeahead', 'required' => '', 'name' => 'kode[]', 'placeholder' => 'kode produk', 'id' => 'kode' . $i+1), strtoupper($data[0])) ?>
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

											echo form_dropdown('size[]', $options, $data[1], array('id' => 'size' . $i+1, 'class' => 'form-control size'));
										 ?>
									</div>
								</div> <!-- /size -->
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">JUMLAH</span>
										<?php echo form_input(array('id' => 'jumlah' . $i+1, 'class' => 'form-control jumlah', 'required' => '', 'name' => 'jumlah[]', 'placeholder' => 'jumlah', 'type' => 'number', 'min' => '1'),
											strtoupper($data[2])) ?>
									</div>
								</div> <!-- /jumlah -->
							</div>
						</div>

						<?php } ?>
						
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
									<?php echo form_input(array('name' => 'harga', 'id' => 'harga', 'class' => 'form-control', 'required' => '', 'placeholder' => '280000'),
								$pesanan->harga); ?>
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
									<?php echo form_input(array('name' => 'ongkir', 'id' => 'ongkir', 'class' => 'form-control', 'required' => '', 'placeholder' => '20000'),
								$pesanan->ongkir); ?>
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
									<?php echo form_input(array('name' => 'transfer', 'id' => 'transfer', 'class' => 'form-control', 'required' => '', 'placeholder' => '300000'),
								$pesanan->transfer); ?>
								</div>
							</div>
						</div>
					</div>

					<!-- field transfer -->
					<div class="form-group">
						<label for="orderStatus">Status Pembayaran</label>

						<div class="radio">
							<label>
								<input required="" id="orderStatus2" value="Lunas" type="radio" name="status" <?php if($pesanan->status === 'Lunas') { echo set_radio('status', 'Lunas', TRUE); } ?>>
								<span class="label label-success">Lunas</span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input required="" id="orderStatus1" value="DP" type="radio" name="status"<?php if($pesanan->status === 'DP') { echo set_radio('status', 'DP', TRUE); } ?>>
								<span class="label label-warning">DP</span> <small><em>--down payment--</em></small>
							</label>
						</div>
					</div>

					<!-- field bank -->
					<div class="form-group">
						<label for="bank">BANK</label>
						<div class="row">
							<div class="col-sm-2">
								<?php echo form_input(array('name' => 'bank', 'id' => 'bank', 'class' => 'form-control', 'required' => '', 'placeholder' => 'bank'),
								$pesanan->bank); ?>
							</div>
						</div>
					</div>

					<!-- field keterangan -->
					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<div class="row">
							<div class="col-sm-6">
								<?php echo form_textarea(array('name' => 'keterangan', 'id' => 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan', 'rows' => '4'),
								str_ireplace('<br />', '', $pesanan->keterangan)); ?>
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
							<?php
								echo '<pre id="result">';
								 
								$gmb = explode(',', $pesanan->customgambar);
								foreach ($gmb as $key ) {
									echo $key . '<br />';
								}
								echo '</pre>';
								?>
								
							</div>
						</div>
					</div>

				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
