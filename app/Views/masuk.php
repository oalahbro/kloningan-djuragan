<?= $this->extend('template/main') ?>

<?= $this->section('content') ?>

<div class="container-xxl min-vh-100 px-0">
	<div class="row min-vh-100 gx-0">
		<div class="col-md-4 bg-dark d-flex justify-content-center justify-content-md-end align-items-center text-white">
			<div class="text-center text-md-right m-3">
				<svg xmlns="http://www.w3.org/2000/svg" class style="width: 120px; height:auto" viewBox="0 0 4800 4800"><g fill="#fff"><path d="M3747 4713c-4-3-7-42-7-85v-78h140v170h-63c-35 0-67-3-70-7zM3565 4675c-5-2-22-6-37-9-64-14-128-102-128-175 0-105 77-181 185-181 51 0 119 30 135 59 8 17 5 24-25 46l-34 27-27-21c-49-38-104-22-125 37-13 38 3 97 31 112 30 16 76 12 95-10 18-20 18-20 56 2 22 12 39 27 39 34 0 19-56 62-92 69-18 4-40 8-48 10s-19 2-25 0zM2880 4490v-180h100v360h-100v-180zM3040 4490v-180h39c38 0 43 4 108 87l68 87 3-87 3-87h99v360l-42-1c-41 0-45-3-108-81l-65-82-3 82-3 82h-99v-180zM1123 4205c-29-8-71-24-94-35l-40-21 31-42c18-23 43-58 56-78l24-35 66 33c73 36 152 45 173 19 17-20-7-40-71-62-127-41-168-79-168-153 1-158 166-278 342-250 57 9 168 52 168 64 0 10-101 140-108 139-4 0-29-11-57-24-59-27-131-32-145-10-16 24-7 34 56 58 153 58 190 92 187 173-3 99-74 190-174 222-62 21-174 21-246 2zM1573 4188c3-13 36-155 73-315l68-293h446l-7 33c-4 17-12 52-18 77l-11 45-136 3-136 3-6 31c-3 17-6 34-6 39s50 9 110 9c124 0 120-4 97 85l-13 50-113 3c-123 3-117 0-135 75l-6 27h273l-7 38c-3 20-11 54-16 75l-11 37h-451l5-22zM2266 4183c-3-15-21-147-41-293-19-146-38-275-40-287-5-23-4-23 88-23h94l6 53c3 28 9 114 13 190s10 139 14 142c3 2 52-83 107-188l102-192 90-3c50-1 91 1 91 5s-82 145-183 313l-183 305-76 3-76 3-6-28zM2767 3898c40-172 73-314 73-315 0-2 99-3 220-3 245 0 230-5 211 70-5 19-12 47-15 63l-6 27h-268l-10 40-10 40h114c63 0 114 3 114 8 0 4-4 23-9 42s-12 47-15 63l-6 27h-115c-125 0-116-5-130 68l-7 32h136c75 0 136 2 136 6 0 3-7 36-16 75l-16 69h-455l74-312zM3297 3898c40-172 73-314 73-316s32-2 71 0l71 3 86 155 86 155 31-130c17-72 34-142 38-157 7-28 8-28 92-28 69 0 85 3 85 15 0 11-77 350-135 593-5 20-11 22-78 22h-73l-86-151-86-151-32 139c-17 76-33 144-35 151-3 8-31 12-93 12h-89l74-312zM882 3201c2-5 75-104 163-220l160-211h438c366 0 437 2 430 14-4 7-78 106-163 220l-155 206h-438c-252 0-437-4-435-9zM1447 2448c93-123 258-341 367-485l197-262-108-143c-60-79-221-291-358-473-136-181-252-336-258-342-7-10 80-13 431-13h441l366 486 367 486-364 483-363 484h-443l-443 1 168-222z"/><path d="M2296 2658c4-7 163-220 354-473 190-253 350-466 354-473 5-9-111-171-353-492-199-263-361-481-361-484 0-4 197-6 438-5h437l360 478c198 263 360 485 360 493s-162 229-360 491l-360 477h-438c-348 0-437-3-431-12zM2006 366c-113-151-206-277-206-280 0-4 197-6 438-5h437l195 260c107 142 201 268 209 279 13 20 11 20-426 20h-440l-207-274z"/></g><g fill="#da251d"><path d="M3747 4713c-4-3-7-42-7-85v-78h140v170h-63c-35 0-67-3-70-7zM882 3201c2-5 75-104 163-220l160-211h438c366 0 437 2 430 14-4 7-78 106-163 220l-155 206h-438c-252 0-437-4-435-9zM2006 366c-113-151-206-277-206-280 0-4 197-6 438-5h437l195 260c107 142 201 268 209 279 13 20 11 20-426 20h-440l-207-274z"/></g></svg>
				
				<h1 class="h2">Masuk <span class="font-weight-light">dulu</span></h1>
				<p>hanya akun yang valid yang bisa akses, <br/>kalau belum punya akun <?php echo anchor('auth/daftar', 'daftar disini', ['title' => 'Daftar sekarang']); ?>.</p>
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

						echo form_label('Pengguna', 'username');
						echo form_input('username', set_value('username'), ['class' => $class_username, 'id' => 'username', 'placeholder' => 'username', 'required' => '']);
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
						echo form_input('password', '', ['class' => $class_password, 'id' => 'password', 'placeholder' => 'kata sandi', 'required' => ''], 'password');
						
						if ($validation->hasError('password')) { ?>
							<div class="invalid-feedback">
								<?php echo $validation->getError('password'); ?>
							</div>
						<?php } ?>
					</div>
					<?php 
					echo form_button(['content' => 'Masuk', 'class' => 'btn btn-primary', 'type' => 'submit']);
					echo anchor('auth/lupa', 'Lupa sandi?', ['title' => 'Reset kata sandi', 'class' => 'ml-2 text-muted']);
					?>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>