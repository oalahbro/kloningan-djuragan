<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="d-flex justify-content-center align-items-center logon pt-3 pb-3">
	<div class="card bayangan">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<?php echo anchor('masuk', 'Masuk', array('class' => 'nav-link')) ?>
				</li>
				<li class="nav-item">
					<?php echo anchor('daftar', 'Daftar', array('class' => 'nav-link active')) ?>
				</li>
				<li class="nav-item">
					<?php echo anchor('lupa', 'Lupa sandi ?', array('class' => 'nav-link')) ?>
				</li>
			</ul>
		</div>
		<div class="card-block">
			<div>
				<?php 
				echo form_open();

				// nama lengkap
				$err_nama = '';
				if( ! empty(form_error('nama')) ) {
					$err_nama = 'has-danger';
				}
				echo '<div class="form-group '.$err_nama.'">';
					// echo form_label('Nama Lengkap', 'nama', array('class' => 'form-control-label'));
					echo form_input(array('name' => 'nama', 'placeholder' => 'nama lengkap', 'class' => 'form-control'), set_value('nama'));
					echo form_error('nama');
				echo '</div>';

				// username
				$err_username = '';
				if( ! empty(form_error('username')) ) {
					$err_username = 'has-danger';
				}
				echo '<div class="form-group '.$err_username.'">';
					// echo form_label('Username', 'username', array('class' => 'form-control-label'));
					echo form_input(array('name' => 'username', 'placeholder' => 'username', 'class' => 'form-control'), set_value('username'));
					echo form_error('username');
				echo '</div>';

				// email
				$err_email = '';
				if( ! empty(form_error('email')) ) {
					$err_email = 'has-danger';
				}
				echo '<div class="form-group '.$err_email.'">';
					// echo form_label('Email', 'email', array('class' => 'form-control-label'));
					echo form_input(array('name' => 'email', 'placeholder' => 'alamat@email', 'class' => 'form-control'), set_value('email'));
					echo form_error('email');
				echo '</div>';


				// sandi1
				$err_sandi1 = '';
				if( ! empty(form_error('sandi1')) ) {
					$err_sandi1 = 'has-danger';
				}
				echo '<div class="form-group '.$err_sandi1.'">';
					// echo form_label('Sandi', 'sandi1', array('class' => 'form-control-label'));
					echo form_password(array('name' => 'sandi1', 'placeholder' => 'sandi', 'class' => 'form-control'));
					echo form_error('sandi1');
				echo '</div>';

				// sandi2
				$err_sandi2 = '';
				if( ! empty(form_error('sandi2')) ) {
					$err_sandi2 = 'has-danger';
				}
				echo '<div class="form-group '.$err_sandi2.'">';
					// echo form_label('Ulangi sandi', 'sandi2', array('class' => 'form-control-label'));
					echo form_password(array('name' => 'sandi2', 'placeholder' => 'ulangi sandi', 'class' => 'form-control'));
					echo form_error('sandi2');
				echo '</div>';



				// echo '<div class=""><p>Setelah melakukan pendaftaran, harap hubungi admin.</p></div>';

				echo form_button(array('class' => 'btn btn-primary', 'content' => 'Daftar', 'type' => 'submit'));

				echo form_close();
				?>
			</div>
			</div>
			</div>
			</div>
