<?php 
use CodeIgniter\I18n\Time;

$sekarang = new Time('now');
?>

<?= $this->extend('template/logged') ?>

<?= $this->section('content') ?>

<div class="container-xxl mb-3">

	<h1 class="h3 mt-5">Tulis Orderan</h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb p-0">
			<li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
			<li class="breadcrumb-item"><?= anchor('invoices', 'Orderan'); ?></li>
			<li class="breadcrumb-item active" aria-current="page">Tulis Orderan</li>
		</ol>
	</nav>

</div>

<div class="container mb-5">

	<div class="row">
		<div class="col-sm-4 mb-3">
			
			<div class="card mb-3">
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<span class="nav-link active" aria-current="true">Juragan & Admin/CS</span>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<div class="mb-3">
						<div class="row g-2">
							<div class="col">	
								<?= form_label('Juragan', 'juragan', ['class' => 'form-label']); ?>
								<?= form_dropdown('juragan', ['' => 'Pilih Juragan'], '', ['class'=> 'form-select', 'id' => 'juragan', 'required' => '']);
								?>
							</div>
							<div class="col">
								<?= form_label('Admin/CS', 'pengguna', ['class' => 'form-label']); ?>
								<?= form_dropdown('pengguna', ['' => 'Pilih Admin/CS'], '', ['class'=> 'form-select', 'id' => 'pengguna', 'required' => '']);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card mb-3">
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<span class="nav-link active" aria-current="true">Asal Orderan</span>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<div class="mb-3">
						<?= form_label('Asal Orderan', 'asal_orderan', ['class' => 'form-label']); ?>
						<?php 
						$options_label = array('' => 'Pilih satu');
						foreach (config('JuraganConfig')->label as $key => $label) {
							$options_label[$key] = $label;
						}
						?>
						<?= form_dropdown('asal_orderan', $options_label, '', ['class'=> 'form-select', 'id' => 'asal_orderan', 'required' => '']); ?>
					</div>
					<div class="mb-3">
						<?= form_label('Label', 'label', ['class' => 'form-label']); ?>
						<?= form_input('label', '', ['class' => 'form-control', 'id' => 'label', 'placeholder' => 'label - opsional, max: 50 karakter']); ?>
					</div>
				</div>
			</div>

			<div class="sticky-top" style="top: 60px">
				<div class="card mb-3">
					<div class="card-body">
						<div class="mb-3">
							<?= form_label('Tanggal Order', 'tanggal_order', ['class' => 'form-label']); ?>
							<?= form_input('tanggal_order', set_value('tanggal_order',  $sekarang->toDateString()), ['class' => 'form-control', 'id' => 'tanggal_order', 'required' => ''], 'date'); ?>
						</div>
						<div class="mb-3">
							<?= form_label('Pemesan', 'pemesan', ['class' => 'form-label']); ?>
							<div class="input-group">
								<?= form_input('pemesan', '', ['class' => 'form-control', 'id' => 'pemesan', 'required' => '', 'placeholder' => 'Pemesan']); ?>
								<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalTambahPelanggan"><i class="fad fa-plus"></i></button>
							</div>
						</div>
						<div class="mb-3">
							<?= form_label('Dikirm kepada', 'dikirim', ['class' => 'form-label']); ?>
							<div class="input-group">
								<?= form_input('dikirim', '', ['class' => 'form-control', 'id' => 'dikirim', 'required' => '', 'placeholder' => 'Dikirim kepada']); ?>
								<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalTambahPelanggan"><i class="fad fa-plus"></i></button>
							</div>
						</div>
						<div class="mb-3">
							<label for="exampleFormControlTextarea1" class="form-label">Note / Keterangan</label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
					</div>
				</div>


			</div>

		</div>
		<div class="col-sm-8 mb-3">
			<div class="card mb-3">
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<span class="nav-link active" aria-current="true">Orderan</span>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">Nama</th>
									<th scope="col">Harga</th>
									<th scope="col">QTY</th>
									<th scope="col">Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Mark</td>
									<td>Otto</td>
									<td class="text-right">@mdo</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Jacob</td>
									<td>Thornton</td>
									<td class="text-right">@fat</td>
								</tr>
								<tr>
									<td>3</td>
									<td colspan="2">Larry the Bird</td>
									<td class="text-right">@twitter</td>
								</tr>
							</tbody>
							<tfoot id="tabelx" class="customBiaya">
								<tr>
									<td colspan="3" class="text-right">Subtotal</td>
									<td class="text-right">Rp30000</td>
								</tr>
								
							</tfoot>
						</table>
					</div>

					<button class="btn btn-sm btn-outline-primary" 
						data-toggle="modal" 
						data-target="#biayaOrder" 
						data-biayaID="1"
						data-judul="Diskon" 
						data-operasi="2" 
						><i class="fad fa-plus"></i> Diskon Order</button>
					<button class="btn btn-sm btn-outline-primary" 
						data-toggle="modal" 
						data-target="#biayaOrder" 
						data-biayaID="2"
						data-judul="Ongkir" 
						data-operasi="1" 
						><i class="fad fa-plus"></i> Ongkir</button>
					<button class="btn btn-sm btn-outline-primary" 
						data-target="#biayaOrder" 
						data-toggle="modal" 
						data-biayaID="3"
						data-judul="Lain-lain" 
						data-operasi="1" 
						><i class="fad fa-plus"></i> Biaya Lain</button>
					<hr/>
					<div class="d-flex justify-content-between align-items-center">
						<h6 class="font-weight-bold">TOTAL</h6>
						<div class="h2 text-primary">Rp-32987958</div>
					</div>
				</div>
			</div>

			<div class="mb-3 row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-tabs card-header-tabs">
								<li class="nav-item">
									<span class="nav-link active" aria-current="true">Pembayaran</span>
								</li>
								<li class="nav-item">
									<a href="#!" class="nav-link" aria-current="false"><i class="fad fa-plus"></i></a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<div class="list-group list-group-flush">
								<div class="list-group-item d-flex justify-content-between">
									<div class="d-flex align-items-center">
										<div class="mr-2">
											<i class="fad fa-times-circle text-danger fa-2x"></i>
										</div>
										<div>
											<div class="font-weight-bold">Rp 20.000 <span class="font-weight-normal">( 20/7/2020 )</span></div>
											<small class="text-muted">BCA - 490853549</small>
										</div>
									</div>
									<div>
										<button class="btn btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
											<i class="fad fa-ellipsis-h"></i>
										</button>
										<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
											<li><a class="dropdown-item" href="#">Action</a></li>
											<li><a class="dropdown-item" href="#">Another action</a></li>
											<li><a class="dropdown-item" href="#">Something else here</a></li>
										</ul>
									</div>
								</div>

								<div class="list-group-item d-flex justify-content-between">
									<div class="d-flex align-items-center">
										<div class="mr-2">
											<i class="fad fa-check-circle text-success fa-2x"></i>
										</div>
										<div>
											<div class="font-weight-bold">Rp 20.000 <span class="font-weight-normal">( 20/7/2020 )</span></div>
											<small class="text-muted">BCA - 490853549</small>
										</div>
									</div>
									<div>
										<button class="btn btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
											<i class="fad fa-ellipsis-h"></i>
										</button>
										<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
											<li><a class="dropdown-item" href="#">Action</a></li>
											<li><a class="dropdown-item" href="#">Another action</a></li>
											<li><a class="dropdown-item" href="#">Something else here</a></li>
										</ul>
									</div>
								</div>

								<div class="list-group-item d-flex justify-content-between">
									<div class="d-flex align-items-center">
										<div class="mr-2">
											<i class="fad fa-circle fa-2x"></i>
										</div>
										<div>
											<div class="font-weight-bold">Rp 20.000 <span class="font-weight-normal">( 20/7/2020 )</span></div>
											<small class="text-muted">BCA - 490853549</small>
										</div>
									</div>
									<div>
										<button class="btn btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
											<i class="fad fa-ellipsis-h"></i>
										</button>
										<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
											<li><a class="dropdown-item" href="#">Action</a></li>
											<li><a class="dropdown-item" href="#">Another action</a></li>
											<li><a class="dropdown-item" href="#">Something else here</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-tabs card-header-tabs">
								<li class="nav-item">
									<span class="nav-link active" aria-current="true">Pengiriman</span>
								</li>
								<li class="nav-item">
									<a href="#!" class="nav-link" aria-current="false"><i class="fad fa-plus"></i></a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<div class="row g-3">
								<div class="col">
									<label for="juragan_id" class="form-label">Status Pengiriman</label>
									<select name="juragan_id" id="juragan_id" class="form-select" required="">
										<option selected="selected" value="1">Belum Dikirim</option>
										<option value="2">Sebagian Dikirim</option>
										<option value="3">Sudah Dikirim Semua</option>
									</select>
								</div>
								<div class="col">
									
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			

			<hr/>
			<button class="btn btn-primary btn-block text-uppercase">
				<i class="fad fa-save"></i> Simpan				
			</button>

		</div>
	</div>

</div>

<!-- Modal tambah pelanggan -->
<div class="modal fade" id="modalTambahPelanggan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<?= form_open('pelanggan/simpan', ['class' => 'modal-content']); ?>
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambahPelangganLabel">Tambah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<?= form_label('Juragan', 'juragan', ['class' => 'form-label']); ?>
					<?= form_dropdown('juragan', ['' => 'Pilih Juragan'], '', ['class'=> 'form-select', 'id' => 'juragan', 'required' => '']);
					?>
				</div>
				<div class="mb-3">
					<?= form_label('Nama Pelanggan', 'nama_pelanggan', ['class' => 'form-label']); ?>
					<?= form_input('nama_pelanggan', '', ['class' => 'form-control', 'id' => 'nama_pelanggan', 'required' => '', 'placeholder' => 'nama pelanggan']); ?>
				</div>
				<div class="row gx-2 mb-3">
					<div class="col-6">
						<?= form_label('HP 1', 'hp1', ['class' => 'form-label']); ?>
						<?= form_input('hp1', '', ['class' => 'form-control', 'id' => 'hp1', 'required' => '', 'placeholder' => 'HP']); ?>
					</div>
					<div class="col-6">
						<?= form_label('HP 2', 'hp2', ['class' => 'form-label']); ?>
						<?= form_input('hp2', '', ['class' => 'form-control', 'id' => 'hp2', 'placeholder' => 'HP 2 - opsional']); ?>
					</div>
				</div>
				<div class="mb-3">
					<?= form_label('Alamat', 'alamat', ['class' => 'form-label']); ?>
					<?= form_textarea(['name' => 'alamat', 'class' => 'form-control',  'id' => 'alamat', 'required' => '', 'placeholder' => 'alamat lengkap', 'rows' => '3']); ?>
				</div>
				<div class="row gx-2 mb-3">
					<div class="col">
						<?= form_label('Provinsi', 'provinsi', ['class' => 'form-label']); ?>
						<?= form_dropdown('provinsi', ['' => 'Pilih provinsi'], '', ['class'=> 'form-select', 'id' => 'provinsi', 'required' => '']); ?>
					</div>
					<div class="col">
						<?= form_label('Kab/Kota', 'kabupaten', ['class' => 'form-label']); ?>
						<?= form_dropdown('kabupaten', ['' => 'Pilih Kab/Kota'], '', ['class'=> 'form-select', 'id' => 'kabupaten', 'required' => '']); ?>
					</div>
					<div class="col">
						<?= form_label('Kecamatan', 'kecamatan', ['class' => 'form-label']); ?>
						<?= form_dropdown('kecamatan', ['' => 'Pilih Kecamatan'], '', ['class'=> 'form-select', 'id' => 'kecamatan', 'required' => '']);
						?>
					</div>
				</div>

				<div class="row gx-2 mb-3">
					
					<div class="col-4">
						<?= form_label('Kode Pos', 'kodepos', ['class' => 'form-label']); ?>
						<?= form_input('kodepos', '', ['class' => 'form-control', 'id' => 'kodepos', 'placeholder' => 'xxxxx']); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary"><i class="fad fa-save"></i> Simpan</button>
			</div>
		<?= form_close(); ?>
	</div>
</div>

<!-- Modal tambah biaya -->
<div class="modal fade" id="biayaOrder" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="biayaOrderLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="biayaOrderLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= form_open('', ['id' => 'tambahBiaya'], ['biayaId' => '']); ?>
				<div class="mb-3">
					<div class="toggle-radio">
						<?= form_radio(['name' => 'plusminus','id' => 'yes','value' => '1']); ?>
						<?= form_radio(['name' => 'plusminus','id' => 'no','value' => '2']); ?>
						<div class="switch position-relative d-flex justify-content-center align-items-center rounded-pill">
							<?= form_label('<i class="fad fa-plus-circle"></i> tambahi', 'yes', ['class' => 'text-left text-uppercase']); ?>
							<?= form_label('kurangi <i class="fad fa-minus-circle"></i>', 'no', ['class' => 'text-right text-uppercase']); ?>
							<span></span>
						</div>
					</div>
				</div>

				<div class=" mb-3">
					<?= form_label('Nominal', 'nominalBiaya', ['class' => 'form-label']); ?>
					<?= form_input(['name' => 'nominal_biaya', 'id' => 'nominalBiaya', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nominal biaya']); ?>
				</div>
				
				<div class=" mb-3">
					<?= form_label('Lebel', 'labelBiaya', ['class' => 'form-label']); ?>
					<?= form_input(['name' => 'label_biaya', 'id' => 'labelBiaya', 'class' => 'form-control', 'placeholder' => 'label biaya - opsional']); ?>
				</div>

				<input type="submit" id="real-submit" style="visibility: hidden" />
				<?= form_close(); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
				<button type="button" id="submit-form" class="btn btn-primary addBiaya">Tambahkan</button>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>