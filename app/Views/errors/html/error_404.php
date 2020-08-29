<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />

	<title>404 Page Not Found</title>

	
</head>

<body>
	<div class="page-wrap d-flex flex-row align-items-center" style="min-height: 100vh">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 text-center">
					<span class="display-1 d-block">404<span class="sr-only"> - File Not Found</span></span>
					<div class="mb-4 lead">
						<?php if (!empty($message) && $message !== '(null)') : ?>
							<?= esc($message) ?>
						<?php else : ?>
							Sorry! Cannot seem to find the page you were looking for.
						<?php endif ?>
					</div>
					<?= anchor('/','Kembali ke Beranda', ['class' => 'btn btn-link']); ?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>