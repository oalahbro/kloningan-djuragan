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
							<div class="row">
								<?php if( empty(input_get('pegawai')) ) { ?>
								<?php foreach($dropdown_header->result() as $row) { ?>
								<div class="col-sm-4"><?php echo anchor('pesanan/tambah?pegawai='.$row->user_id, '<i class="glyphicon glyphicon-plus"></i> '.$row->juragan, array('class' => 'btn btn-block btn-default btn-lg btn-tambah')); ?></div>
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
												<?php 
													$array = array('q','ew','w');
													$array2 = array('2','3','4');
													$str="one  ,two  ,       three    "; 
													$array3 = array_map('trim',explode(",",$str));
													 for ($i = 0; $i < count($array); ++$i) {
    
												?>
												<div class="entry input-group multiple-form-group">
													<span class="input-group-addon">kode</span>
													<input class="form-control" name="fields[]" type="text" value="<?php echo $array3[$i] ?>" placeholder="Type something" />
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
													<input class="form-control" name="fields[]" type="text" value="<?php echo $array[$i] ?>" placeholder="Type something" />
													<span class="input-group-addon">warna</span>
													<input class="form-control" name="fields[]" type="text" value="<?php echo $array2[$i] ?>" placeholder="Type something" />
													<span class="input-group-btn">
														<button class="btn btn-success btn-add" type="button">
															<span class="glyphicon glyphicon-plus"></span>
														</button>
													</span>
												</div>
												<?php } ?>
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


	