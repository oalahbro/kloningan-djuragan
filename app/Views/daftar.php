<?= $this->extend('template/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid min-vh-100 px-0">
	<div class="row min-vh-100 gx-0">
		<div class="col-md-4 bg-dark d-flex justify-content-center justify-content-md-end align-items-center text-white">
			<div class="text-center text-md-right m-3">
				<div class="d-flex justify-content-center justify-content-md-end">
					<div style="width:120px"><?= LOGO ?></div>
				</div>

				<h1 class="h2">Daftar <span class="font-weight-light">baru</span></h1>
				<p>lengkapi kolom isian dan klik daftar, <br />tapi kalau sudah punya akun <?= anchor('auth', 'masuk disini', ['title' => 'masuk ah']) ?> ya.</p>
			</div>
		</div>
		<div class="col-md-4 d-flex justify-content-start align-items-center">
			<div class="w-100 my-5 my-md-2 px-3">
				<div>
					<?= ($_SESSION['status'] ?? ''); ?>
					<?= form_open(); ?>
					<div class="form-group mb-2">
						<?php
                        $class_username = 'form-control';

                        if ($validation->hasError('username')) {
                            $class_username .= ' is-invalid';
                        }

                        echo form_label('Pengguna', 'username');
                        echo form_input('username', set_value('username'), ['class' => $class_username, 'id' => 'username', 'placeholder' => 'username', 'required' => '', 'tabindex' => '1']);

                        if ($validation->hasError('username')) { ?>
							<div class="invalid-feedback">
								<?= $validation->getError('username'); ?>
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
								<?= $validation->getError('password'); ?>
							</div>
						<?php } ?>
					</div>
					<div class="form-group mb-2">
						<?php
                        $class_nama = 'form-control';

                        if ($validation->hasError('nama')) {
                            $class_nama .= ' is-invalid';
                        }

                        echo form_label('Nama', 'nama');
                        echo form_input('nama', set_value('nama'), ['class' => $class_nama, 'id' => 'nama', 'placeholder' => 'nama pengguna', 'required' => '', 'tabindex' => '3']);

                        if ($validation->hasError('nama')) { ?>
							<div class="invalid-feedback">
								<?= $validation->getError('nama'); ?>
							</div>
						<?php } ?>
					</div>
					<div class="form-group mb-2">
						<?php
                        $class_email = 'form-control';

                        if ($validation->hasError('email')) {
                            $class_email .= ' is-invalid';
                        }

                        echo form_label('Email', 'email');
                        echo form_input('email', set_value('email'), ['class' => $class_email, 'id' => 'email', 'placeholder' => 'email', 'required' => '', 'tabindex' => '4'], 'email');

                        if ($validation->hasError('email')) { ?>
							<div class="invalid-feedback">
								<?= $validation->getError('email'); ?>
							</div>
						<?php } ?>
					</div>
					<?= form_button(['content' => 'Daftar', 'class' => 'btn btn-primary', 'type' => 'submit', 'tabindex' => '5']);
                    ?>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>