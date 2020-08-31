<div class="container-fluid">
	<!-- start .page-content -->
	<div class="page-content">
		<?php echo $this->load->view('admin/include/menu_satu'); ?>
		<div class="isi-status" id="">
			<div class="content-inti" id="reload">
				<div class="well">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<?php echo form_open('administrator/exports', array('method' => 'post')) ?>
							<div class="row">
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">Juragan</span>
										<?php 
										$list = array( '0' => 'All' );
										foreach( $dft_juragan as $type => $val )
										{
											$list[$val['id']]  = $val['nama'];
										}

										echo form_dropdown('juragan', $list, '0',  'class="form-control"');
										?>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">Tanggal Mulai</span>
										<?php echo form_input(array('name' => 'tanggal_mulai', 'value' => $tanggal_mulai ,'class' => 'bg-white form-control form-bulan', 'id' => 'datetimepicker9', 'data-date-format' => 'YYYY-MM-DD', 'autocomplete' => 'off', 'readonly' => ''))?>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">Tanggal Akhir</span>
										<?php echo form_input(array('name' => 'tanggal_akhir', 'value' => $tanggal_akhir ,'class' => 'bg-white form-control form-bulan', 'id' => 'datetimepicker10', 'data-date-format' => 'YYYY-MM-DD', 'autocomplete' => 'off', 'readonly' => ''))?>
									</div>
								</div>
								<div class="col-sm-3">
									<?php echo form_button(array('content' => '<i class="glyphicon glyphicon-save"></i>', 'class' => 'btn btn-block btn-primary', 'type' => 'submit')) ?>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end .page-content -->
	</div>    