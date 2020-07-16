<?= $this->extend('template/main') ?>

<?= $this->section('content') ?>

<div class="container-xxl min-vh-100 px-0">
	<div class="row min-vh-100 gx-0">
		<div class="col-md-4 bg-dark d-flex justify-content-center justify-content-md-end align-items-center text-white">
			<div class="text-center text-md-right m-3">
				<h1 class="h2">Atur ulang <span class="font-weight-light">sandi</span></h1>
				<p>aku bisa bantu merubah kata sandimu, <br/>tapi kalo dah ingat <?php echo anchor('auth', 'login disini', ['title' => 'Masuk sekarang']); ?>.</p>
			</div>
		</div>
		<div class="col-md-4 d-flex justify-content-start align-items-center">
			<div class="w-100 my-5 my-md-2 px-3">
				<div>
					<?= (isset($_SESSION['status'])? $_SESSION['status'] : ''); ?>
					<?= form_open(); ?>
					<div class="form-group mb-2">
						<?php 
						$class_username = 'form-control';
						if ($validation->hasError('username')) {
							$class_username .= ' is-invalid';
						}

						echo form_label('Email atau Nama pengguna', 'username');
						echo form_input('username', set_value('username'), ['class' => $class_username, 'id' => 'username', 'placeholder' => 'email / username', 'required' => '']);
						?>
						<?php if ($validation->hasError('username')) { ?>
							<div class="invalid-feedback">
								<?php echo $validation->getError('username'); ?>
							</div>
						<?php } ?>
					</div>
					<?php 
					echo form_button(['content' => 'Atur ulang', 'class' => 'btn btn-primary', 'type' => 'submit']);
					?>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>