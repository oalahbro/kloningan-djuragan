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
					$alert = (int) save_url_decode($err);
					if($alert > 0) {
						echo '<div class="alert alert-warning" role="alert">';
							echo alert_info($alert);
						echo '</div>';
					}
					echo validation_errors();
					
					echo '<div class="well well-sm">Isi form berikut untuk dapatkan link validasi.</div>';
					
					echo form_open('');
						echo form_input(array('type' => 'email','name' => 'email','class' => 'form-control input-lg','placeholder' => 'email', 'required' => 'required'));
						echo form_button(array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'content' => 'Kirim Link Validasi'));
					echo form_close(); 
					?>
				</div>
				<?php 
				echo anchor('login', 'masuk?', array('class' => 'pull-right'));
				echo '<div class="clearfix"></div>';
				?>
			</div>
		</div>
	</div>
</div>
