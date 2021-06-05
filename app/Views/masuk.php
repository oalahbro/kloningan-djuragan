<?= $this->extend('template/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid min-vh-100 px-0">
	<div class="row min-vh-100 gx-0">
		<div class="col-md-4 bg-dark d-flex justify-content-center justify-content-md-end align-items-center text-white">
			<div class="text-center text-md-right m-3">
				<div class="d-flex justify-content-center justify-content-md-end">
					<div style="width:120px"><?= LOGO ?></div>
				</div>

				<h1 class="h2">Masuk <span class="font-weight-light">dulu</span></h1>
				<p>hanya akun yang valid yang bisa akses, <br />kalau belum punya akun <?= anchor('auth/daftar', 'daftar disini', ['title' => 'Daftar sekarang']) ?>.</p>
			</div>
		</div>
		<div class="col-md-4 d-flex justify-content-start align-items-center">
			<div class="w-100 my-5 my-md-2 px-3">
				<div>
					<?= (isset($_SESSION['status']) ? $_SESSION['status'] : ''); ?>
					<?= form_open(); ?>
					<div class="form-group mb-2">
						<?php
                        $class_username = 'form-control';

                        if ($validation->hasError('username')) {
                            $class_username .= ' is-invalid';
                        }

                        echo form_label('Pengguna', 'username');
                        echo form_input('username', set_value('username'), ['class' => $class_username, 'id' => 'username', 'placeholder' => 'username', 'required' => '', 'tabindex' => '1']);
                        ?>
						<?php if ($validation->hasError('username')) { ?>
							<div class="invalid-feedback">
								<?php echo $validation->getError('username'); ?>
							</div>
						<?php } ?>
					</div>
					<div class="form-group mb-2">
						<?php
                        $class_password = 'form-control';

                        if ($validation->hasError('password')) {
                            $class_password .= ' is-invalid';
                        }

                        echo form_label('Kata sandi', 'password');
                        echo form_input('password', '', ['class' => $class_password, 'id' => 'password', 'placeholder' => 'kata sandi', 'required' => '', 'tabindex' => '2'], 'password');

                        if ($validation->hasError('password')) { ?>
							<div class="invalid-feedback">
								<?php echo $validation->getError('password'); ?>
							</div>
						<?php } ?>
					</div>
					<?php
                    echo form_button(['content' => 'Masuk', 'class' => 'btn btn-primary', 'type' => 'submit', 'tabindex' => '3']);
                    echo anchor('auth/lupa', 'Lupa sandi?', ['title' => 'Reset kata sandi', 'class' => 'ml-2 text-muted']);
                    ?>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>