<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title><?php echo $title; ?></title>

    <?php 
        $bg = array(
            base_url('assets/img/bg.jpg'),
            base_url('assets/img/bg2.jpg'),
            );
    ?>

    <style type="text/css">
        html { 
            background: url(<?php echo random_element($bg); ?>) no-repeat center center fixed; 
        }
    </style>

    <link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet" />


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="container">
	<div class="tengahkan">
		<div class="formlogin">
			<h2 class="text-center"><?php echo $this->config->item('site_name'); ?> <small>v<?php echo $this->config->item('site_version'); ?></small></h2>
			<div class="well">
				<?php echo form_open(''); ?>
					<div class="form-group">
						<?php 
						echo form_label('Username', 'username');
						echo form_input(array('name' => 'username', 'class' => 'form-control', 'placeholder' => 'username', 'id' => 'username'))
						?>
					</div>
					<div class="form-group">
						<?php 
						echo form_label('Sandi', 'password');
						echo form_password(array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'password', 'id' => 'password'))
						?>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Masuk</button>
				<?php echo form_close(); ?>
				<small class="text-muted">rendered in <strong>{elapsed_time}</strong> seconds</small>
			</div>			
		</div>
	</div>
</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

</body>
</html>