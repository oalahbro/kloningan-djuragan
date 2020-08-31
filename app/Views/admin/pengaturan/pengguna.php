<?php
use CodeIgniter\I18n\Time;
$pager = \Config\Services::pager();
?>
<?= $this->extend('template/logged') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

	<h1 class="h3 mt-5">Pengaturan Pengguna</h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb p-0">
			<li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
			<li class="breadcrumb-item"><?= anchor('settings', 'Pengaturan'); ?></li>
			<li class="breadcrumb-item active" aria-current="page">Pengguna</li>
		</ol>
	</nav>
</div>
<div class="container">

	<?php // var_dump($jj); 

	
	?>

	<div class="row">
		<div class="col-sm-8 mb-3">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Pengguna</th>
									<th>Level</th>
									<th colspan="2">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($penggunas as $pengguna) { 
								?>

								<tr>
									<td>
										<div>
											<div class="lead"><?= $pengguna->name; ?><span class="ml-2 badge rounded-pill bg-secondary font-weight-normal"><?= $pengguna->username; ?></span></div>
											<div><?= $pengguna->email; ?></div>
										</div>    									
									</td>
									<td><?= ucwords($pengguna->level); ?></td>
									<td><?= ucwords($pengguna->status); ?></td>
									<td class="text-right"><!-- Example split danger button -->
										<div class="btn-group">
											<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" 
											data-target="#modalSuntingPengguna" 
											data-id="<?= $pengguna->id; ?>" 
											data-nama="<?= $pengguna->name; ?>" 
											data-email="<?= $pengguna->email; ?>" 
											data-username="<?= $pengguna->username; ?>" 
											data-level="<?= strtolower($pengguna->level); ?>" 
											data-status="<?= strtolower($pengguna->status); ?>"
											>Sunting</button>
											<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<ul class="dropdown-menu">
												<li><button class="dropdown-item" href="#">Hapus</button></li>
											</ul>
										</div>
									</td>
								</tr>

								<?php 
								}
								?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 mb-3">
			<div class="card sticky-top" style="top: 60px">
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<span class="nav-link active" aria-current="true">Tambah Pengguna</span>
						</li>
					</ul>
				</div>
				<div class="card-body">

					<?= form_open('settings/save_pengguna'); ?>
					<div class="mb-3 row gx-2 bg-warning rounded pb-1">
						<div class="col-6">
							<?= form_label('Username', 'username', ['class' => 'form-label']); ?>
							<?= form_input('username', '', ['class' => 'form-control', 'id' => 'username', 'required' => '', 'placeholder' => 'username']); ?>
						</div>
						<div class="col-6">
							<?= form_label('Password', 'password', ['class' => 'form-label']); ?>
							<?= form_password('password', '', ['class' => 'form-control', 'id' => 'password', 'required' => '', 'placeholder' => 'password']); ?>
						</div>
					</div>
					<div class="mb-3">
						<?= form_label('Nama Lengkap', 'nama', ['class' => 'form-label']); ?>
						<?= form_input('nama', '', ['class' => 'form-control', 'id' => 'nama', 'required' => '', 'placeholder' => 'nama lengkap pengguna']); ?>
					</div>
					<div class="mb-3">
						<?= form_label('Email', 'email', ['class' => 'form-label']); ?>
						<?= form_input('email', '', ['class' => 'form-control', 'id' => 'email', 'required' => '', 'placeholder' => 'alamat@email'], 'email'); ?>
					</div>
					<div class="mb-3 row gx-2">
						<div class="col-6">
							<?= form_label('Level', 'level', ['class' => 'form-label']); ?>
							<?php 
							$options_level = array(
								'superadmin' => 'Superadmin',
								'admin' => 'Admin',
								'cs' => 'CS',
								'viewer' => 'Viewer',
								'reseller' => 'Reseller'
							);

							echo form_dropdown('level', $options_level, 'cs', ['class'=> 'form-select', 'id' => 'level', 'required' => '']);
							?>

						</div>
						<div class="col-6">
							<?= form_label('Status', 'status', ['class' => 'form-label']); ?>
							<?php 
							$options_status = array(
								'pending' => 'Pending',
								'inactive' => 'Tidak Aktif',
								'active' => 'Aktif',
								'blocked' => 'Blokir'
							);

							echo form_dropdown('status', $options_status, 'active', ['class'=> 'form-select', 'id' => 'status', 'required' => '']);
							?>
						</div>
					</div>
					<div class="mb-3">
							<?= form_label('Juragan', 'juragan', ['class' => 'form-label']); ?>
							<?php 
							foreach ($juragans as $juragan) {
								$options_juragan[$juragan->id_juragan] = $juragan->nama_juragan;
							}

							echo form_multiselect('juragan[]', $options_juragan, [], ['class'=> 'form-select', 'id' => 'juragan']);
							?>
							<div class="form-text">tekan CTRL untuk memilih lebih dari 1</div>
						</div>
					<hr/>
					<div class="mb-3">
						<button class="btn btn-primary btn-block" type="submit"><i class="fad fa-save"></i> Tambahkan</button>
					</div>
					<?= form_close(); ?>

				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalSuntingPengguna" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalSuntingPenggunaLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<?= form_open('settings/update_pengguna', '', ['id' => '']); ?>
			<div class="modal-header">
				<h5 class="modal-title" id="modalSuntingPenggunaLabel">Update Pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			
				<div class="mb-3 row gx-2 bg-warning rounded pb-1">
					<div class="col-6">
						<?= form_label('Username', 'username_', ['class' => 'form-label']); ?>
						<?= form_input('username', '', ['class' => 'form-control', 'id' => 'username_', 'required' => '', 'placeholder' => 'username', 'disabled' => '']); ?>
					</div>
					<div class="col-6">
						<?= form_label('Password', 'password_', ['class' => 'form-label']); ?>
						<?= form_password('password', '', ['class' => 'form-control', 'id' => 'password_', 'placeholder' => 'password - isi jika diganti']); ?>
					</div>
				</div>
				<div class="mb-3">
					<?= form_label('Nama Lengkap', 'nama_', ['class' => 'form-label']); ?>
					<?= form_input('nama', '', ['class' => 'form-control', 'id' => 'nama_', 'required' => '', 'placeholder' => 'nama lengkap pengguna']); ?>
				</div>
				<div class="mb-3">
					<?= form_label('Email', 'email_', ['class' => 'form-label']); ?>
					<?= form_input('email', '', ['class' => 'form-control', 'id' => 'email_', 'required' => '', 'placeholder' => 'alamat@email'], 'email'); ?>
				</div>
				<div class="mb-3 row gx-2">
					<div class="col-6">
						<?= form_label('Level', 'level_', ['class' => 'form-label']); ?>
						<?php 
						$options_level = array(
							'superadmin' => 'Superadmin',
							'admin' => 'Admin',
							'cs' => 'CS',
							'viewer' => 'Viewer',
							'reseller' => 'Reseller'
						);

						echo form_dropdown('level', $options_level, 'cs', ['class'=> 'form-select', 'id' => 'level_', 'required' => '']);
						?>

					</div>
					<div class="col-6">
						<?= form_label('Status', 'status_', ['class' => 'form-label']); ?>
						<?php 
						$options_status = array(
							'pending' => 'Pending',
							'inactive' => 'Tidak Aktif',
							'active' => 'Aktif',
							'blocked' => 'Blokir'
						);

						echo form_dropdown('status', $options_status, 'active', ['class'=> 'form-select', 'id' => 'status_', 'required' => '']);
						?>
					</div>
				</div>
				<div class="mb-3">
					<?= form_label('Juragan', 'juragan_', ['class' => 'form-label']); ?>
					<?php 
					foreach ($juragans as $juragan) {
						$options_juragan[$juragan->id_juragan] = $juragan->nama_juragan;
					}

					echo form_multiselect('juragan[]', $options_juragan, [], ['class'=> 'form-select', 'id' => 'juragan_']);
					?>
					<div class="form-text">tekan CTRL untuk memilih lebih dari 1</div>
				</div>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link text-decoration-none" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary"><i class="fad fa-save"></i> Simpan</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<?= $this->endSection() ?>