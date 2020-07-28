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
								<button class="btn btn-primary" type="button"><i class="fad fa-plus"></i></button>
							</div>
						</div>
						<div class="mb-3">
							<?= form_label('Dikirm kepada', 'dikirim', ['class' => 'form-label']); ?>
							<div class="input-group">
								<?= form_input('dikirim', '', ['class' => 'form-control', 'id' => 'dikirim', 'required' => '', 'placeholder' => 'Dikirim kepada']); ?>
								<button class="btn btn-primary" type="button"><i class="fad fa-plus"></i></button>
							</div>
						</div>
						<div class="mb-3">
							<label for="exampleFormControlTextarea1" class="form-label">Note / Keterangan</label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
							<label for="juragan_id" class="form-label">Asal Orderan</label>
							<select name="juragan_id" id="juragan_id" class="form-select" required="">
								<option value="" disabled="" selected="selected">Pilih Salah Satu</option>
								<option value="">Tokopedia</option>
								<option value="">Bukalapak</option>
								<option value="">Shopee</option>
								<option value="">Lazada</option>
								<option value="">Blibli</option>
								<option value="">Zalora</option>
								<option value="">Instagram</option>
								<option value="">WhatsApp</option>
								<option value="">Facebook</option>
								<option value="">Web/App lain</option>
								<option value="">Offline Store/COD</option>
							</select>
						</div>
						<div class="mb-3">
							<?= form_label('Label/Catatan', 'label', ['class' => 'form-label']); ?>
							<?= form_input('label', '', ['class' => 'form-control', 'id' => 'label', 'placeholder' => 'label - opsional, max: 50 karakter']); ?>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-sm-8 mb-3">
			<div class="card mb-3">
				<div class="card-body">
					<div class="">
						<label for="exampleFormControlInput1" class="form-label">Produk</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="cari produk">
					</div>
				</div>
			</div>

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
							<tfoot>
								<tr>
									<td colspan="3">Subtotal</td>
									<td class="text-right">Rp30000</td>
								</tr>
							</tfoot>
						</table>
					</div>

					<button class="btn btn-sm btn-outline-primary"><i class="fad fa-plus"></i> Diskon Order</button>
					<button class="btn btn-sm btn-outline-primary"><i class="fad fa-plus"></i> Ongkir</button>
					<button class="btn btn-sm btn-outline-primary"><i class="fad fa-plus"></i> Biaya Lain</button>
					<hr/>
					<div class="d-flex justify-content-between align-items-center">
						<h6 class="font-weight-bold">TOTAL</h6>
						<div class="h2 text-primary">Rp-32987958</div>
					</div>
				</div>
			</div>


			<div class="card mb-3">
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<span class="nav-link active" aria-current="true">Pembayaran</span>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col">
							<div class="mb-3">
								<label for="juragan_id" class="form-label">Pilih Bank</label>	
								<select class="form-select" aria-label="Default select example">
									<option selected>Open this select menu</option>
									<option value="1" data-img="https://app.ngorder.id/assets/img/bank/bca.svg" data-sub='text'>BCA</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
							</div>
							<div class="mb-3 row gx-2">
								<div class="col col-sm-6">
									<label for="juragan_id" class="form-label">Tanggal Pembayaran</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="cari produk">
								</div>
								<div class="col col-sm-6">
									<label for="juragan_id" class="form-label">Tanggal Cek</label>
									<div class="input-group">
										<div class="input-group-text">
											<input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
										</div>
										<input type="text" class="form-control" aria-label="Text input with checkbox">
									</div>
								</div>
							</div>
							<div class="mb-3">
								<label for="juragan_id" class="form-label">Nominal</label>	
								<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="cari produk">
							</div>
							<div class="mb-3 text-right">
								<button class="btn btn-primary">Tambahkan</button>
							</div>
							
						</div>
						<div class="col">

							<div class="mb-3">
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

				</div>
			</div>


			<div class="card mb-3">
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<span class="nav-link active" aria-current="true">Pengiriman</span>
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

			<hr/>
			<button class="btn btn-primary btn-block text-uppercase">
				<i class="fad fa-save"></i> Simpan				
			</button>

		</div>
	</div>

</div>

<?= $this->endSection() ?>