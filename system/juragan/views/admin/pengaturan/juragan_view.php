<div class="container-fluid">
	<!-- start .page-content -->
	<div class="page-content">
		<?php echo $this->load->view('admin/include/menu_satu'); ?>
		
		<div class="content-inti row" id="reload">	
			<div class="" id="load"></div>

			<div class="col-sm-3">
				<div class="panel panel-warning">
					<div class="panel-heading">Daftar Juragan</div>
					<div class="panel-body">
						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#tambah_juragan" aria-expanded="false" aria-controls="tambah_juragan">Tambah Juragan</button>

						<div class="collapse" id="tambah_juragan">
							<div class="well">
								<?php echo form_open('administrator/tambah_juragan')?>
								<div class="form-group">
									<label for="nama">Nama Juragan</label>
									<?php echo form_input(array('name' => 'nama', 'value' => set_value('nama'), 'id' => 'nama', 'class' => 'form-control', 'placeholder' => 'nama juragan')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('nama'); ?></span>
								</div>
								<div class="form-group">
									<label for="short">Shortcode</label>
									<?php echo form_input(array('name' => 'short', 'value' => set_value('short'), 'id' => 'short', 'class' => 'form-control', 'placeholder' => 'misal - FC')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('short'); ?></span>
								</div>
								<div class="form-group">
									<label for="username">Username</label>
									<?php echo form_input(array('name' => 'username', 'value' => set_value('username'), 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'username')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('username'); ?></span>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'password')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('password'); ?></span>
								</div>
								<div class="form-group">
									<label for="password_c">Ulangi Password</label>
									<?php echo form_password(array('name' => 'password_c', 'id' => 'password_c', 'class' => 'form-control', 'placeholder' => 'ulangi password')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('password_c'); ?></span>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="membership" value="aktif">
										Fitur Membership Aktif
									</label>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
								<?php echo form_close()?>
							</div>
						</div>
					</div>
					<div class="list-group">
						<?php foreach(dropdown_user()->result() as $row) { ?>
						<div class="list-group-item">
							<div class="pull-right">
								<div class="btn-group btn-group-xs" role="group" aria-label="...">
									<?php echo anchor('administrator/edit_juragan/' . $row->user_id, '<i class="glyphicon glyphicon-edit"></i>', array('class' => 'btn btn-default manual', 'id' => 'edit_' . $row->user_id)) ?>
									<?php echo anchor('administrator/hapus_juragan/alert/' . $row->user_id, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-danger manual', 'id' => 'hapus_' . $row->user_id)) ?>
								</div>
							</div>
							<?php echo $row->juragan ?> - <small><em class="text-muted"><?php echo $row->username ?></em></small>
							<div class=""><i class="glyphicon glyphicon-bullhorn"></i> <?php echo $row->transfer . ' / ' . $row->kirim ?>
							<br/>
							<?php 
							if($row->membership === '1') {
								echo anchor('administrator/membership/' .  $row->username, 'membership', array('class' => 'btn btn-xs btn-warning'));
							}
							?></div>
						</div>
						<?php } ?>

					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="panel panel-success">
					<div class="panel-heading">
						Daftar Admin
					</div>
					<div class="panel-body">
						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#tambah_admin" aria-expanded="false" aria-controls="tambah_admin">Tambah Admin</button>

						<div class="collapse" id="tambah_admin">
							<div class="well">
								<?php echo form_open('administrator/tambah_admin')?>
								<div class="form-group">
									<label for="nama">Nama Admin</label>
									<?php echo form_input(array('name' => 'nama', 'value' => set_value('nama'), 'id' => 'nama', 'class' => 'form-control', 'placeholder' => 'nama admin')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('nama'); ?></span>
								</div>
								<div class="form-group">
									<label for="username">Username</label>
									<?php echo form_input(array('name' => 'username', 'value' => set_value('username'), 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'username')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('username'); ?></span>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'password')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('password'); ?></span>
								</div>
								<div class="form-group">
									<label for="password_c">Ulangi Password</label>
									<?php echo form_password(array('name' => 'password_c', 'id' => 'password_c', 'class' => 'form-control', 'placeholder' => 'ulangi password')); ?>
									<span id="helpBlock" class="help-block"><?php echo form_error('password_c'); ?></span>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
								<?php echo form_close()?>
							</div>
						</div>
					</div>
					<div class="list-group">
						<?php foreach($this->juragan_model->get_admin()->result() as $row) { ?>
						<div class="list-group-item">
							<div class="pull-right">
								<div class="btn-group btn-group-xs" role="group" aria-label="...">
									<?php echo anchor('administrator/edit_juragan/' . $row->id, '<i class="glyphicon glyphicon-edit"></i>', array('class' => 'btn btn-default manual', 'id' => 'edit_' . $row->id)) ?>
									<?php // echo anchor('administrator/hapus_juragan/alert/' . $row->id, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-danger manual', 'id' => 'hapus_' . $row->id)) ?>
								</div>
							</div>
							<?php echo $row->nama ?> - <small><em class="text-muted"><?php echo $row->username ?></em></small>
						</div>
						
						<?php } ?> 
					</div>

				</div>
			</div>

		</div>
	</div>
</div>    