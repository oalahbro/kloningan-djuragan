<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Welcome to CodeIgniter</title>

	<?php echo link_tag('assets/css/bootstrap.min.css'); ?>

	<style type="text/css">
		
	.login {
		margin-top: 50%;
	}
	.login .form-control {
		margin-bottom: 5px;
	}

	</style>

</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-sm-4 offset-sm-4">
			<div class="card card-outline-primary login">
				<div class="card-header">
					Masuk | Pesanan Limited
				</div>
				<div class="card-block">
					<?php 
					echo form_open();

					// echo heading('Masuk', 2, array('class' => 'text-xs-center'));

					echo form_input(array('name' => 'username', 'placeholder' => 'username', 'class' => 'form-control'));
					echo form_password(array('name' => 'password', 'placeholder' => 'password', 'class' => 'form-control'));
					echo form_button(array('class' => 'btn btn-primary', 'content' => 'Masuk', 'type' => 'submit'));

					echo form_close();
					?>
				</div>
				<!-- <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p> -->
			</div>
		</div>
	</div>
</div>

	<!-- jQuery first, then Tether, then Bootstrap JS. -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

</body>
</html>