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
					<?php echo anchor('daftar', 'Daftar', array('class' => 'nav-link')) ?>
				</li>
				<li class="nav-item">
					<?php echo anchor('lupa', 'Lupa sandi ?', array('class' => 'nav-link active')) ?>
				</li>
			</ul>
		</div>
		<div class="card-block">
			<div>
				<?php 
				echo form_open();

				echo '<div class="form-group">';
				echo form_input(array('name' => 'username', 'placeholder' => 'Username', 'class' => 'form-control'));
				echo '</div>';

				echo form_button(array('class' => 'btn btn-primary', 'content' => 'Reset'));

				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
