<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container login">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 col-xs-12">
			<div class="form-login">
				<h2 class="text-center"><?php echo judul('name'); ?> <sup class="text-success"><small>v<?php echo judul('version') ?></small></sup></h2>
				<div class="lembar">
					<?php 
					$err = $this->input->get('alert');
					$alert = (int) save_url_decode($err);
					if($alert > 0) {
						echo '<div class="alert alert-warning" role="alert">';
							echo alert_info($alert);
						echo '</div>';
					}
					
					// form login
					echo form_open();
						echo form_input(array('name' => 'username','class' => 'form-control input-lg','placeholder' => 'username', 'required' => 'required'));
						echo form_password(array('name' => 'password','class' => 'form-control input-lg','placeholder' => 'password', 'required' => 'required'));
						echo form_button(array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'content' => 'MASUK'));
					echo form_close(); 
					?>
				</div>
				<?php 
				echo anchor('register', 'daftar akun baru?', array('class' => 'pull-right'));
				echo anchor('forgot', 'lupa sandi?', array('class' => 'pull-left'));
				echo '<div class="clearfix"></div>';
				?>
			</div>
		</div>
	</div>
</div>
