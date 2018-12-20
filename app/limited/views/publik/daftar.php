<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container login">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 col-xs-12">
			<div class="form-login">
				<h2 class="text-center"><?php echo judul('name'); ?> <sup class="text-success"><small>v<?php echo judul('version') ?></small></sup></h2>
				<div class="lembar">
					<?php echo validation_errors(); ?>
					<?php 
					echo form_open();
						echo form_input(array('name' => 'nama','class' => 'form-control input-lg','placeholder' => 'nama', 'required' => 'required'), set_value('nama'));
						echo form_input(array('name' => 'username','class' => 'form-control input-lg','placeholder' => 'username', 'required' => 'required'), set_value('username'));
						echo form_input(array('name' => 'email','class' => 'form-control input-lg','placeholder' => 'email', 'required' => 'required'), set_value('email'));
						echo form_password(array('name' => 'password','class' => 'form-control input-lg','placeholder' => 'password', 'required' => 'required'));
						echo form_button(array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'content' => 'DAFTAR'));
					echo form_close(); 
					?>
				</div>
				<?php 
				echo anchor('login', 'sudah punya akun, masuk?', array('class' => 'pull-right'));
				echo '<div class="clearfix"></div>';
				?>
			</div>
		</div>
	</div>
</div>
