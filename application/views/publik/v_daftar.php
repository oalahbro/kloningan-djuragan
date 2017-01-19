<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card-group mb-0">
	<div class="card p-2">
		<div class="card-block">
			<div class="card-block">
				<h1>Daftar</h1>
				<p class="text-muted">Daftar Akun untuk request hak akses</p>
				<?php echo validation_errors(); ?>
				<?php 
				echo form_open();

				echo '<div class="input-group mb-1">';
				echo '<span class="input-group-addon"><i class="icon-user"></i></span>';
				echo form_input(array('name' => 'nama', 'placeholder' => 'Nama Lengkap', 'class' => 'form-control'), set_value('nama'));
				echo '</div>';

				echo '<div class="input-group mb-1">';
				echo '<span class="input-group-addon">@</span>';
				echo form_input(array('name' => 'username', 'placeholder' => 'Username', 'class' => 'form-control'), set_value('username'));
				echo '</div>';

				echo '<div class="input-group mb-1">';
				echo '<span class="input-group-addon"><i class="icon-envelope"></i></span>';
				echo form_input(array('name' => 'email', 'placeholder' => 'Alamat Email', 'class' => 'form-control'), set_value('email'));
				echo '</div>';

				echo '<div class="input-group mb-1">';
				echo '<span class="input-group-addon"><i class="icon-lock"></i></span>';
				echo form_password(array('name' => 'sandi1', 'placeholder' => 'Sandi', 'class' => 'form-control'));
				echo '</div>';

				echo '<div class="input-group mb-1">';
				echo '<span class="input-group-addon"><i class="icon-lock"></i></span>';
				echo form_password(array('name' => 'sandi2', 'placeholder' => 'Ulangi Sandi', 'class' => 'form-control'));
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
