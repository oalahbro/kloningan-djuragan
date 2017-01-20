<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card-group mb-0">
	<div class="card p-2">
		<div class="card-block">
			<div class="card-block">
				<h1>Daftar</h1>
				<p class="text-muted">Daftar Akun untuk request hak akses</p>
				<?php 
				echo form_open();

				// nama lengkap
				$err_nama = '';
				if( ! empty(form_error('nama')) ) {
					$err_nama = 'has-danger';
				}
				echo '<div class="form-group '.$err_nama.'">';
					echo '<div class="input-group mb-2 mr-sm-2 mb-sm-0">';
						echo '<div class="input-group-addon"><i class="icon-user"></i></div>';
						echo form_input(array('name' => 'nama', 'placeholder' => 'Nama Lengkap', 'class' => 'form-control'), set_value('nama'));
					echo '</div>';
					echo form_error('nama');
				echo '</div>';

				// username
				$err_username = '';
				if( ! empty(form_error('username')) ) {
					$err_username = 'has-danger';
				}
				echo '<div class="form-group '.$err_username.'">';
					echo '<div class="input-group mb-2 mr-sm-2 mb-sm-0">';
						echo '<div class="input-group-addon">@</div>';
						echo form_input(array('name' => 'username', 'placeholder' => 'Username', 'class' => 'form-control'), set_value('username'));
					echo '</div>';
					echo form_error('username');
				echo '</div>';

				// email
				$err_email = '';
				if( ! empty(form_error('email')) ) {
					$err_email = 'has-danger';
				}
				echo '<div class="form-group '.$err_email.'">';
					echo '<div class="input-group mb-2 mr-sm-2 mb-sm-0">';
						echo '<div class="input-group-addon"><i class="icon-envelope"></i></div>';
						echo form_input(array('name' => 'email', 'placeholder' => 'Alamat Email', 'class' => 'form-control'), set_value('email'));
					echo '</div>';
					echo form_error('email');
				echo '</div>';


				// sandi1
				$err_sandi1 = '';
				if( ! empty(form_error('sandi1')) ) {
					$err_sandi1 = 'has-danger';
				}
				echo '<div class="form-group '.$err_sandi1.'">';
					echo '<div class="input-group mb-2 mr-sm-2 mb-sm-0">';
						echo '<div class="input-group-addon"><i class="icon-lock"></i></div>';
						echo form_password(array('name' => 'sandi1', 'placeholder' => 'Sandi', 'class' => 'form-control'));
					echo '</div>';
					echo form_error('sandi1');
				echo '</div>';

				// sandi2
				$err_sandi2 = '';
				if( ! empty(form_error('sandi2')) ) {
					$err_sandi2 = 'has-danger';
				}
				echo '<div class="form-group '.$err_sandi2.'">';
					echo '<div class="input-group mb-2 mr-sm-2 mb-sm-0">';
						echo '<div class="input-group-addon"><i class="icon-lock"></i></div>';
						echo form_password(array('name' => 'sandi2', 'placeholder' => 'Sandi', 'class' => 'form-control'));
					echo '</div>';
					echo form_error('sandi2');
				echo '</div>';



				echo '<div class=""><p>Setelah melakukan pendaftaran, harap hubungi admin.</p></div>';

				echo form_button(array('class' => 'btn btn-block btn-success', 'content' => 'Daftar', 'type' => 'submit'));

				echo form_close();
				?>
			</div>
			<div class="card-footer p-2">
				<div class="row">
					<div class="col-6">
						<?php echo anchor('masuk', 'Masuk', array('class' => 'btn btn-block btn-primary')); ?>
					</div>
					<div class="col-6">
						<?php echo anchor('lupa', 'Lupa Sandi ?', array('class' => 'btn btn-block btn-link')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
