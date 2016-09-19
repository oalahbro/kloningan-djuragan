<div class="container-fluid">
	<!-- start .page-content -->
	<div class="page-content">
		<?php echo $this->load->view('admin/include/menu_satu'); ?>
		
		<div class="content-inti" id="reload">	
			<div class="" id="load"></div>
			<div class="row">
				<div class="col-sm-2 col-sm-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							Pengaturan tanggal
						</div>
						<div class="panel-body">
							<?php echo form_open('administrator/pengaturan_update'); ?>
							<?php $ck = $this->config->item('config_tanggal_range'); 
							
							if($ck === '1')
							{
								$disable = '';
								$checkbox = 'checked=""';
							}
							else
							{
								$disable = 'readonly=""';
								$checkbox = '';
							}
							?>
							<div class="form-group">
								<label for="tanggal_mulai">Tanggal Mulai</label>
								<?php echo form_input('tanggal_mulai', $this->config->item('config_tanggal_mulai'), 'class="form-control disable" id="tanggal_mulai"' . $disable ); ?>
							</div>
							<div class="form-group">
								<label for="tanggal_selesai">Tanggal Akhir</label>
								<?php echo form_input('tanggal_selesai', $this->config->item('config_tanggal_selesai'), 'class="form-control disable" id="tanggal_selesai"' . $disable ); ?>
							</div>

							<div class="checkbox">
								<label>
								<input class="enable" type="checkbox" name="config_tanggal_range" value="1" <?php echo $checkbox; ?> />
								Custom Setting
								</label>
							</div>

							<?php echo form_button(array('content' => 'Simpan', 'class' => 'btn btn-primary', 'type' => 'submit')) ?>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="panel panel-info">
						<div class="panel-heading">
							Daftar Kurir
						</div>
						<ul class="list-group">
							<?php if ($kurir->num_rows() > 0)
							{
								foreach ($kurir->result() as $row)
									{ ?>
								<li class="list-group-item"><?php echo $row->nama ?><?php echo form_button(array('content' => '<i class="glyphicon glyphicon-trash"></i>', 'class' => 'btn btn-danger btn-xs pull-right btn-remove-kurir', 'id' => $row->nama)) ?></li>
								<?php } 
							}?>
						</ul>
						<div class="panel-body">
							<?php echo form_open('administrator/tambah_kurir') ?>
							<div class="form-group">
								<label for="KURIR">Tambah Kurir</label>
								<div class="input-group">
									<?php echo form_input(array('name' => 'kurir', 'id' => 'kurir', 'class' => 'form-control', 'placeholder' => 'nama kurir')) ?>
									<span class="input-group-btn">
										<?php echo form_button(array('content' => '<i class="glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-primary', 'type' => 'submit')) ?>
									</span>
								</div>
							</div>
							<?php echo form_close() ?>
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="panel panel-warning">
						<div class="panel-heading">
							Daftar Size
						</div>
						<ul class="list-group">
							<?php if ($size->num_rows() > 0)
							{
								foreach ($size->result() as $row)
									{ ?>
								<li class="list-group-item"><?php echo $row->size ?><?php echo form_button(array('content' => '<i class="glyphicon glyphicon-trash"></i>', 'class' => 'btn btn-danger btn-xs pull-right btn-remove-size', 'id' => $row->size)) ?></li>
								<?php } 
							}?>
						</ul>
						<div class="panel-body">
							<?php echo form_open('administrator/tambah_size') ?>
							<div class="form-group">
								<label for="size">Tambah Size</label>
								<div class="input-group">
									<?php echo form_input(array('name' => 'size', 'id' => 'size', 'class' => 'form-control', 'placeholder' => 'nama kurir')) ?>
									<span class="input-group-btn">
										<?php echo form_button(array('content' => '<i class="glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-primary', 'type' => 'submit')) ?>
									</span>
								</div>
							</div>
							<?php echo form_close() ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- hapus -->
<div class="modal fade" id="hapus_alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<?php echo form_open('administrator/hapus_pengaturan', '', array('id' => '', 'data' => '')) ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Hapus Data  <span class="delid"></span></h4>
			</div>
			<div class="modal-body">
				<div class="well well-sm">
					Hapus data <u><span class="delid"></span></u>.<br/>Penghapusan data tidak dapat dibatalkan.
				</div>
			</div>
			<div class="modal-footer">
				<?php echo form_button(array('class' => 'btn btn-default', 'data-dismiss' => 'modal', 'content' => '<i class="glyphicon glyphicon-remove"></i>')).
				form_button(array('class' => 'btn btn-danger', 'type' => 'submit', 'content' => '<i class="glyphicon glyphicon-trash"></i> Hapus')) ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<!-- hapus -->