	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<!-- start .page-title -->
				<div class="page-header">
					<h2><?php echo $halaman ?></h2>
				</div>
				<!-- end .page-title -->

				<!-- start .page-content -->
				<div class="page-content">
					<?php echo $this->load->view('admin/tab_menu_view'); ?>

					<div class="tab-content">
						<div class="tab-pane active">
							<form enctype="multipart/form-data" id="form" method="post" class="form-horizontal" action="system/adm_submit.php" role="form" data-toggle="validator">
								<input name="id" value="10" type="hidden">
								<!-- field nama -->
								<div class="form-group">
									<label for="orderNama" class="col-sm-2 control-label">CS</label>
									<div class="col-sm-5">
										<input readonly="" required="" class="form-control" id="orderNama" placeholder="nama" name="usern" value="Fashion Cowok" type="text">
									</div>
								</div>

								<!-- field nama -->
								<div class="form-group">
									<label for="orderNama" class="col-sm-2 control-label">Nama</label>
									<div class="col-sm-5">
										<input autocomplete="off" required="" class="form-control" id="orderNama" placeholder="nama" name="nama" value="" type="text">
									</div>
								</div>

								<!-- field alamat -->
								<div class="form-group">
									<label for="orderAlamat" class="col-sm-2 control-label">Alamat</label>
									<div class="col-sm-8">
										<textarea required="" class="form-control" id="orderAlamat" placeholder="Jl. Sukun, Gg. Mawar No 133A, Karang Bendo, Banguntapan, Bantul, Yogyakarta" name="alamat"></textarea>
									</div>
								</div>

								<!-- field hape -->
								<div class="form-group">
									<label for="orderHape" class="col-sm-2 control-label">HP</label>
									<div class="col-sm-3">
										<input maxlength="12" required="" class="form-control" id="orderNama" placeholder="08xxxxxxxxx" name="hape" value="" type="tel">
									</div>
								</div>

								<!-- field kode & size -->
								<div class="form-group">
									<label for="orderKode" class="col-sm-2 control-label">Kode Barang &amp; Size</label>
									<div class="col-sm-3">
										<input autocomplete="on" required="" class="form-control" id="orderKode" placeholder="BK-01 (M)" name="kode" value="" type="text">
									</div>
								</div>

								<!-- field jumlah -->
								<div class="form-group">
									<label for="orderJumlah" class="col-sm-2 control-label">Jumlah Barang</label>
									<div class="col-sm-2">
										<div class="input-group">
											<input min="1" autocomplete="on" required="" class="form-control" id="orderJumlah" placeholder="2" name="jumlah" value="" type="number">
											<span class="input-group-addon">pcs</span> </div>
										</div>
									</div>

									<!-- field harga -->
									<div class="form-group">
										<label for="orderHarga" class="col-sm-2 control-label">Harga Barang</label>
										<div class="col-sm-3">
											<div class="input-group"> <span class="input-group-addon">Rp</span>
												<input autocomplete="on" required="" class="form-control" id="orderHarga" placeholder="280000" name="harga" value="" type="text">
											</div>
										</div>
									</div>

									<!-- field ongkir -->
									<div class="form-group">
										<label for="orderOngkir" class="col-sm-2 control-label">Ongkir</label>
										<div class="col-sm-3">
											<div class="input-group"> <span class="input-group-addon">Rp</span>
												<input autocomplete="on" required="" class="form-control" id="orderOngkir" placeholder="280000" name="ongkir" value="" type="text">
											</div>
										</div>
									</div>

									<!-- field transfer -->
									<div class="form-group">
										<label for="orderTransfer" class="col-sm-2 control-label">Total Transfer</label>
										<div class="col-sm-3">
											<div class="input-group"> <span class="input-group-addon">Rp</span>
												<input autocomplete="on" required="" class="form-control" id="orderTransfer" placeholder="280000" name="transfer" value="" type="text">
											</div>
										</div>
									</div>

									<!-- field transfer -->
									<div class="form-group">
										<label for="orderStatus" class="col-sm-2 control-label">Status Pembayaran</label>
										<div class="col-sm-3">
											<div class="radio">
												<label>
													<input required="" id="orderStatus1" value="DP" name="status" type="radio">
													DP </label>
												</div>
												<div class="radio">
													<label>
														<input required="" id="orderStatus2" value="Lunas" name="status" type="radio">
														Lunas </label>
													</div>
												</div>
											</div>

											<!-- field bank -->
											<div class="form-group">
												<label for="orderBank" class="col-sm-2 control-label">BANK</label>
												<div class="col-sm-2">
													<input maxlength="12" required="" class="form-control" id="orderBank" placeholder="MANDIRI" name="bank" value="" type="text">
												</div>
											</div>

											<!-- field keterangan -->
											<div class="form-group">
												<label for="orderKeterangan" class="col-sm-2 control-label">Keterangan</label>
												<div class="col-sm-8">
													<textarea class="form-control" id="orderKeterangan" placeholder="" name="keterangan"></textarea>
												</div>
											</div>

											<!-- custom gambar -->
											<div class="form-group">
												<label for="customGambar" class="col-sm-2 control-label">Custom Gambar</label>
												<div class="col-sm-3">
													<div class="input-group">
														<input id="customGambar" name="image" type="file">
													</div>
												</div>
											</div>

											<!-- tombol submit -->
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<input name="edit" value="Submit" type="hidden">
													<button type="submit" class="btn btn-success btn-lg"> Simpan </button>
												</div>
											</div>
										</form>




										<div class="row">
											<?php if( empty(input_get('juragan')) ) { ?>
											<?php foreach($dropdown_header->result() as $row) { ?>
											<div class="col-sm-4"><?php echo anchor('pesanan/tambah?juragan='.$row->user_id, '<i class="glyphicon glyphicon-plus"></i> '.$row->juragan, array('class' => 'btn btn-block btn-default btn-lg btn-tambah')); ?></div>
											<?php } ?>
											<?php } else { ?>
											<div class="col-sm-8 col-sm-offset-2">
												<div class="panel panel-default">
													<div class="panel-body controls">
														<?php echo form_open() ?>
														<div class="form-group">
															<label for="exampleInputEmail1">Email address</label>
															<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
														</div>
														<div class="form-group">
															<label for="exampleInputPassword1">Password</label>
															<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
														</div>
														<div class="form-group">
															<label for="exampleInputFile">Kode / Size</label>

															<div class="entry input-group multiple-form-group">
																<span class="input-group-addon">kode</span>

																<?php echo form_dropdown('produk[]',$dropdown_produk, '', 'placeholder="pilih produk" tabindex="2" class="chosen-select form-control"'); ?>
																
																<span class="input-group-addon">size</span>
																<select class="form-control">
																	<option>XS</option>
																	<option>S</option>
																	<option>M</option>
																	<option>L</option>
																	<option>XL</option>
																	<option>XXL</option>
																	<option>XXXL</option>
																	<option>XXXXL</option>
																	<option>CUSTOM</option>
																</select>
																<span class="input-group-addon">jumlah</span>
																<input class="form-control" name="fields[]" type="text" value="<?php // echo $array[$i] ?>" placeholder="Type something" />
																<span class="input-group-addon">warna</span>
																<input class="form-control" name="fields[]" type="text" value="<?php // echo $array2[$i] ?>" placeholder="Type something" />
																<span class="input-group-btn">
																	<button class="btn btn-success btn-add" type="button">
																		<span class="glyphicon glyphicon-plus"></span>
																	</button>
																</span>
															</div>

															<p class="help-block">Example block-level help text here.</p>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox"> Check me out
															</label>
														</div>
														<button type="submit" class="btn btn-default">Submit</button>
														<?php echo form_close()?>
											<?php /*

											$str="one  ,two  ,       three    "; 
											$array = array_map('trim',explode(",",$str));
											print_r($array);

											print_r(array_combine($array, Array(1,2,3)));

											echo count($array);
											*/
											?>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>


				</div>
				<!-- end .page-content -->
			</div>
		</div>
	</div> 