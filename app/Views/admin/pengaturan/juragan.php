<?php
use CodeIgniter\I18n\Time;
$pager = \Config\Services::pager();
?>
<?= $this->extend('template/logged') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

	<h1 class="h3 mt-5">Semua Juragan</h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb p-0">
			<li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
			<li class="breadcrumb-item active" aria-current="page">Juragan</li>
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
									<th>Juragan</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($juragans as $juragan) { 

	                            $jbanks = html_entity_decode($juragan->bank, ENT_QUOTES);
	                            $jjb = '';
	                            foreach (json_decode($jbanks) as $bank) {
	                            	$jjb .= $bank->id .",";
	                            }

								?>

								<tr>
									<td>
										<div class="d-flex justify-content-between">
											<div class="lead"><?= $juragan->nama_juragan; ?></div>
											<div class="">
												<?= anchor('invoices/' . $juragan->juragan, '<i class="fad fa-file-search"></i> lihat orderan'); ?>

												<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalSuntingJuragan" data-selected="<?= reduce_multiples($jjb, ", ", TRUE); ?>" data-id="<?= $juragan->id_juragan; ?>" data-nama="<?= $juragan->nama_juragan; ?>"><i class="fad fa-pencil"></i> sunting</button>

												<a href="" class="text-decoration-none"><i class="fad fa-trash"></i> hapus</a>
											</div>
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
							<span class="nav-link active" aria-current="true">Tambah Juragan</span>
						</li>
					</ul>
				</div>
				<div class="card-body">

					<?= form_open('settings/save_juragan'); ?>
					<div class="mb-3">
						<?= form_label('Nama Juragan', 'nama_juragan', ['class' => 'form-label']); ?>
						<?= form_input('nama_juragan', '', ['class' => 'form-control', 'id' => 'nama_juragan', 'required' => '', 'placeholder' => 'nama juragan']); ?>
					</div>
					<div class="mb-3">
						<?= form_label('Rekening Bank', 'bank', ['class' => 'form-label']); ?>
						<?php 
						foreach ($banks as $bank) {
							$options[$bank->id_bank] = strtoupper( $bank->nama_bank ) . ' - ' . $bank->atas_nama;
						}

						echo form_multiselect('bank[]', $options, [], ['class'=> 'form-select', 'required' => '']);
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


<div class="modal fade" id="modalSuntingJuragan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalSuntingJuraganLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<?= form_open('settings/update_juragan', '', ['id' => '']); ?>
			<div class="modal-header">
				<h5 class="modal-title" id="modalSuntingJuraganLabel">Update Juragan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div class="mb-3">
					<?= form_label('Nama Juragan', 'nama_juragan', ['class' => 'form-label']); ?>
					<?= form_input('nama_juragan', '', ['class' => 'form-control', 'id' => 'nama_juragan', 'required' => '', 'placeholder' => 'nama juragan']); ?>
				</div>
				<div class="mb-3">
					<?= form_label('Rekening Bank', 'bank', ['class' => 'form-label']); ?>
					<?php 

					echo form_multiselect('bank[]', $options, [], ['class'=> 'form-select mybanks', 'required' => '']);
					?>
					<div class="form-text">tekan CTRL untuk memilih lebih dari 1</div>
				</div>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary"><i class="fad fa-save"></i> Simpan</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<?= $this->endSection() ?>