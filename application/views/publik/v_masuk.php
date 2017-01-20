<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card-group mb-0">
	<div class="card p-2">
		<div class="card-block">
			<div class="card-block">
				<h2>Masuk</h2>
				<p class="text-muted">Masuk sistem dengan akun pribadi.<br/><?php echo anchor('daftar', 'Daftar sekarang'); ?> jika belum memiliki akun pribadi.</p>

				<?php 

				echo show_alert();
				$array_items = array('type', 'text');
				$this->session->unset_userdata($array_items);

				echo form_open();

				// username
				$err_username = '';
				if( ! empty(form_error('username')) ) {
					$err_username = 'has-danger';
				}
				echo '<div class="form-group '.$err_username.'">';
					echo '<div class="input-group mb-2 mr-sm-2 mb-sm-0">';
						echo '<div class="input-group-addon"><i class="icon-user"></i></div>';
						echo form_input(array('name' => 'username', 'placeholder' => 'username', 'class' => 'form-control'), set_value('username'));
					echo '</div>';
					echo form_error('username');
				echo '</div>';

				// password
				$err_password = '';
				if( ! empty(form_error('password')) ) {
					$err_password = 'has-danger';
				}
				echo '<div class="form-group '.$err_password.'">';
					echo '<div class="input-group mb-2 mr-sm-2 mb-sm-0">';
						echo '<div class="input-group-addon"><i class="icon-lock"></i></div>';
						echo form_password(array('name' => 'password', 'placeholder' => 'password', 'class' => 'form-control'));
					echo '</div>';
					echo form_error('password');
				echo '</div>';



				echo ' <div class="row">';
				echo '<div class="col-6">';
				echo form_button(array('class' => 'btn btn-primary px-2', 'content' => 'Masuk', 'type' => 'submit'));
				echo '</div>';

				echo '<div class="col-6 text-right">';
				echo anchor('lupa', 'Lupa Sandi?', array('class' => 'btn btn-link px-0'));
				echo '</div>';
				echo '</div>';

				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>