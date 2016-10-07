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
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<?php echo form_open('admin/setting/user/tambah'); ?>
			<div class="panel-body">
			
				<div class="form-group">
					<?php 
					// menampilkan form nama CS
					echo form_label('Nama CS', 'nama');
					echo form_input(
						array(
							'name' 	=> 'nama',
							'id' 	=> 'nama',
							'class' => 'form-control',
							'placeholder' 	=> 'nama CS'
							),
						set_value('nama')
						);
					?>
					<span id="helpBlock" class="help-block"><?php echo form_error('nama'); ?></span>
				</div>

				<div class="form-group">
					<?php 
					// menampilkan form username
					echo form_label('Username', 'username');
					echo form_input(
						array(
							'name' 	=> 'username',
							'id' 	=> 'username',
							'class' => 'form-control',
							'placeholder' 	=> 'username'
							),
						set_value('username')
						);
					?>
					<span id="helpBlock" class="help-block"><?php echo form_error('username'); ?></span>
				</div>

				<div class="form-group">
					<?php 
					// menampilkan multiselect juragan
					echo form_label('Juragan yang diijinkan', 'juragan');

					$array_juragan = array();
					foreach($this->juragan->ambil()->result() as $row) {
						$array_juragan[$row->user_id] = $row->nama;
					}
					echo form_multiselect('juragan[]', $array_juragan, set_value('juragan[]'), array('class' => 'form-control', 'id' => 'juragan'));
					?>
					<span id="helpBlock" class="help-block"><?php echo form_error('juragan'); ?></span>
				</div>

				<div class="well well-sm">
					<div class="form-group">
						<?php 
						// menampilkan password
						echo form_label('Password', 'password');
						echo form_input(
							array(
								'name' 	=> 'password',
								'id' 	=> 'password',
								'class' => 'form-control',
								'placeholder' 	=> 'Password'
								)
							);
						?>
						<span id="helpBlock" class="help-block"><?php echo form_error('password'); ?></span>
					</div>

					<div class="form-group">
						<?php 
						// menampilkan form repeat password
						echo form_label('Ulangi Password', 'password_r');
						echo form_input(
							array(
								'name' 	=> 'password_r',
								'id' 	=> 'password_r',
								'class' => 'form-control',
								'placeholder' 	=> 'Ulangi Password'
								)
							);
						?>
						<span id="helpBlock" class="help-block"><?php echo form_error('password_r'); ?></span>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="submit-form">
					<button class="btn btn-primary">Tambah User</button>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>
	</div>
</div>
