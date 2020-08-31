<?php 
/**
 * login_view.php
 *
 * by mylastof@gmail.com 
 * --- checked 21/12/2014 ---
 */
?>
<div class="container login">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 col-xs-12">
			<div class="form-login">
				<h2 class="text-center"><?php echo title('name'); ?> <sup class="text-success"><small>v<?php echo title('ver') ?></small></sup></h2>
				<div class="well well-sm">
					<?php echo form_open('login') .
								form_input('username','', 'class="form-control input-lg" placeholder="username"') .
								form_password('password','', 'class="form-control input-lg" placeholder="password"') .
								form_button(array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'content' => 'MASUK')) .
								form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>    