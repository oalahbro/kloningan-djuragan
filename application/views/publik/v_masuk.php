<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="d-flex justify-content-center align-items-center logon pt-3 pb-3">
	<div class="judul">
		
	</div>
	<div class="card bayangan">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<?php echo anchor('masuk', 'Masuk', array('class' => 'nav-link active')) ?>
				</li>
				<li class="nav-item">
					<?php echo anchor('daftar', 'Daftar', array('class' => 'nav-link')) ?>
				</li>
				<li class="nav-item">
					<?php echo anchor('lupa', 'Lupa sandi ?', array('class' => 'nav-link')) ?>
				</li>
			</ul>
		</div>
		<div class="card-block">
			<div>
				<?php echo form_open(); ?>

					<?php 
					$err_username = '';
					if( ! empty(form_error('username')) ) {
						$err_username = ' has-danger';
					}

					$err_password = '';
					if( ! empty(form_error('password')) ) {
						$err_password = ' has-danger';
					}
					?>
					<div class="form-group<?php echo $err_username; ?>">
						<?php
							$username = array(
								'name' => 'username',
								'id' => 'username',
								'class' => 'form-control',
								'placeholder' => 'username'
								);
							// echo form_label('Username', 'username');
							echo form_input($username);
							echo form_error('username');
						?>
					</div>
					<div class="form-group<?php echo $err_password; ?>">
						<?php
							$password = array(
								'name' => 'password',
								'id' => 'password',
								'class' => 'form-control',
								'placeholder' => 'sandi'
								);
							// echo form_label('Sandi', 'password');
							echo form_password($password);
							echo form_error('password');
						?>
					</div>
					<div class="tombol">
						<?php echo form_button(array('class' => 'btn btn-primary', 'type' => 'submit', 'content' => 'Masuk')); ?>
					</div>
				<?php echo form_close(); ?>
			</div>

		</div>
	</div>
</div>