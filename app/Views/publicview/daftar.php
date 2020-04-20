<div class="container-fluid min-vh-100">
	<div class="row min-vh-100">
		<div class="col-md-4 bg-dark d-flex justify-content-center justify-content-md-end align-items-center text-white">
			<div class="text-center text-md-right m-3">
				<h1 class="h2">Daftar <span class="font-weight-light">baru</span></h1>
				<p>lengkapi kolom isian dan klik daftar, <br/>tapi kalau sudah punya akun <?php echo anchor('auth', 'masuk disini', ['title' => 'masuk ah']); ?> ya.</p>
			</div>
		</div>
		<div class="col-md-4 d-flex justify-content-start align-items-center">
			<div class="w-100 my-5 my-md-2">
				<div>
					<?= form_open(); ?>
					<div class="form-group">
						<?php 
						echo form_label('Pengguna', 'username');
						echo form_input('username', '', ['class' => 'form-control', 'id' => 'username', 'placeholder' => 'username', 'required' => '']);
						?>
					</div>
					<div class="form-group">
						<?php 
						echo form_label('Kata sandi', 'password');
						echo form_input('password', '', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'kata sandi', 'required' => ''], 'password');
						?>
					</div>
					<div class="form-group">
						<?php 
						echo form_label('Nama', 'nama');
						echo form_input('nama', '', ['class' => 'form-control', 'id' => 'nama', 'placeholder' => 'nama pengguna', 'required' => '']);
						?>
					</div>
					<div class="form-group">
						<?php 
						echo form_label('Email', 'email');
						echo form_input('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'email', 'required' => ''], 'email');
						?>
					</div>
					<?php 
					echo form_button(['content' => 'Daftar', 'class' => 'btn btn-primary', 'type' => 'submit']);
					?>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
