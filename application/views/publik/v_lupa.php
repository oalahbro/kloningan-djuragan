<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card-group mb-0">
	<div class="card p-2">
		<div class="card-block">
			<div class="card-block">
				<h1>Lupa Sandi</h1>
				<p class="text-muted">Untuk reset sandi, silakan isi form berikut.</p>
				<?php 
				echo form_open();

				echo '<div class="input-group mb-1">';
				echo '<span class="input-group-addon">@</span>';
				echo form_input(array('name' => 'username', 'placeholder' => 'Username', 'class' => 'form-control'));
				echo '</div>';

				echo form_button(array('class' => 'btn btn-block btn-success', 'content' => 'Reset'));

				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
