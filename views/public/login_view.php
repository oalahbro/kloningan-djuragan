<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * public/login_view.php
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		1.x.x
 */

?>
<div class="container login">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 col-xs-12">
			<div class="form-login">
				<h2 class="text-center">
					<?php 
					echo title('name');
					echo '<sup class="text-success"><small>v' . title('ver') . '</small></sup>'
					?>
				</h2>
				<div class="well well-sm">
					<?php 
					echo form_open('login');
					echo form_input(array('name' => 'username', 'class' => 'form-control input-lg', 'placeholder' => 'username'), set_value('username'));
					echo form_password(array('name' => 'password', 'class' => 'form-control input-lg', 'placeholder' => 'password'));
					echo form_button(array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'content' => 'MASUK'));
					echo form_close(); 
					?>
				</div>
			</div>
		</div>
	</div>
</div>