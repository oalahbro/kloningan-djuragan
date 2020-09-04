<?php

use CodeIgniter\I18n\Time;

$sekarang = new Time('now');
?>

<?= $this->extend('template/default_admin') ?>

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

	<?= form_open('admin/invoices/save', ['class' => 'row', 'id' => 'iForm']); ?>
	<div class="col-sm-4 mb-3">

		<div class="sticky-top" style="top: 60px">
			<div class="card mb-3">
				<div class="card-body">
					<div class="mb-3">
						<?= form_label('Tanggal Order', 'tanggal_order', ['class' => 'form-label']); ?>
						<?= form_input('tanggal_order', set_value('tanggal_order', $sekarang->toDateString()), ['class' => 'form-control', 'id' => 'tanggal_order', 'required' => '', 'max' => $sekarang->toDateString()], 'date'); ?>
					</div>
					<div class="mb-3">
						<div class="">
							<?= form_label('Pelanggan', 'pelanggan', ['class' => 'form-label']); ?>
							<?= form_hidden('pelanggan', ''); ?>
						</div>
						<div class="mb-3 btn-nambahPelanggan">
							<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modalTambahPelanggan" data-action="1" data-judul="Tambah Pelanggan"><i class="fad fa-plus"></i> Tambah Pelanggan</button>
						</div>

						<div class="mb-3">
							<button class="btn btn-link text-decoration-none btn-sm float-right btn-sunting" type="button" data-toggle="modal" data-target="#modalTambahPelanggan" data-action="2" data-judul="Sunting Pelanggan" style="display:none">
								<i class="fad fa-pencil"></i>
							</button>
							<span id="alamat_pemesan"></span>
						</div>
					</div>
					<div class="mb-3">
						<?= form_label('Note / Keterangan', 'keterangan', ['class' => 'form-label']); ?>
						<?= form_textarea(['name' => 'keterangan', 'id' => 'keterangan', 'class' => 'form-control', 'rows' => '3', 'placeholder' => 'opsional']); ?>
					</div>
				</div>
			</div>

			<div class="card mb-3">
				<div class="card-body">
					<div class="mb-3">
						<div class="row gx-2 mb-3">
							<div class="col">
								<?= form_label('Juragan', 'juragan', ['class' => 'form-label']); ?>
								<?= form_dropdown('juragan', ['' => 'Pilih Juragan'], '', ['class' => 'form-select', 'id' => 'juragan', 'required' => '']); ?>
							</div>
							<div class="col">
								<?= form_label('Admin/CS', 'pengguna', ['class' => 'form-label']); ?>
								<?= form_dropdown('pengguna', ['' => 'Pilih Admin/CS'], '', ['class' => 'form-select', 'id' => 'pengguna', 'required' => '']); ?>
							</div>
						</div>
						<div class="row gx-2">
							<div class="col-sm-5">
								<?= form_label('Asal Orderan', 'asal_orderan', ['class' => 'form-label']); ?>
								<?php
								$options_label = array('' => 'Pilih asal');
								foreach (config('JuraganConfig')->label as $key => $label) {
									$options_label[$key] = $label;
								}
								?>
								<?= form_dropdown('asal_orderan', $options_label, '', ['class' => 'form-select', 'id' => 'asal_orderan', 'required' => '']); ?>
							</div>
							<div class="col-sm-7">
								<?= form_label('Label', 'label', ['class' => 'form-label']); ?>
								<?= form_input('label', '', ['class' => 'form-control', 'id' => 'label', 'placeholder' => 'label - opsional, max: 50 karakter']); ?>
							</div>
						</div>
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
					<li class="nav-item">
						<a href="#!" class="nav-link" data-toggle="modal" data-target="#tambahProduk">
							<i class="fad fa-plus"></i>
						</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Produk</th>
								<th scope="col">Harga</th>
								<th scope="col">QTY</th>
								<th scope="col" class="text-right">Subtotal</th>
							</tr>
						</thead>
						<tbody class="list-orderan" data-length="1">
							<tr class="orderan-kosong">
								<td class="text-center" colspan="4">
									<div class="py-5"><i class="fad text-warning fa-<?= random_element(['shopping-cart', 'shopping-bag', 'shopping-basket', 'bags-shopping', 'dolly-flatbed-empty', 'dolly-empty']) ?> fa-4x"></i>
										<p class="mb-0"><?= random_element(['orderan kosong?', 'isi dulu orderannya ya?', 'jangan lupa isi orderannya ya?']) ?></p>
									</div>
								</td>
							</tr>
						</tbody>
						<tfoot class="customBiaya d-none listBiaya">
							<tr>
								<td colspan="3" class="text-right">Subtotal</td>
								<td class="text-right" data-totalbiaya="0" data-subtotal="0" id="subTotal"></td>
							</tr>
						</tfoot>
					</table>
				</div>

				<div class="border-bottom pb-3 customBiaya d-none">
					<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#biayaOrder" data-biayaID="1" data-judul="Ongkir" data-operasi="1"><i class="fad fa-plus"></i> Ongkir</button>
					<button type="button" class="btn btn-sm btn-outline-primary" data-target="#biayaOrder" data-toggle="modal" data-biayaID="2" data-judul="Lain-lain" data-operasi="1"><i class="fad fa-plus"></i> Biaya Lain</button>
				</div>
				<div class="customBiaya d-none">
					<div class="d-flex justify-content-between align-items-center">
						<h6 class="font-weight-bold">TOTAL</h6>
						<div class="h2 text-primary" id="grandTotal"></div>
					</div>
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

		<hr />
		<button type="submit" class="btn btn-primary btn-block text-uppercase">
			<i class="fad fa-save"></i> Simpan
		</button>
	</div>
	<?= form_close(); ?>

</div>

<!-- Modal tambah pelanggan -->
<div class="modal fade" id="modalTambahPelanggan" data-backdrop="static" tabindex="-1" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<?= form_open('', ['id' => 'tambahPelanggan', 'class' => 'modal-content']); ?>
		<div class="modal-header">
			<h5 class="modal-title" id="modalTambahPelangganLabel"></h5>
			<button type="button" data-reset="false" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="mb-3">
				<?= form_label('Nama Pelanggan', 'nama_pelanggan', ['class' => 'form-label']); ?>
				<?= form_input('nama_pelanggan', '', ['class' => 'form-control input', 'id' => 'nama_pelanggan', 'required' => '', 'placeholder' => 'nama pelanggan', 'autocomplete' => 'off']); ?>
			</div>
			<div class="row gx-2 mb-3">
				<div class="col-6">
					<?= form_label('HP 1', 'hp1', ['class' => 'form-label']); ?>
					<?= form_input('hp[0]', '', ['class' => 'form-control input', 'id' => 'hp1', 'required' => '', 'placeholder' => 'HP', 'autocomplete' => 'off']); ?>
				</div>
				<div class="col-6">
					<?= form_label('HP 2', 'hp2', ['class' => 'form-label']); ?>
					<?= form_input('hp[1]', '', ['class' => 'form-control input', 'id' => 'hp2', 'placeholder' => 'HP 2 - opsional', 'autocomplete' => 'off']); ?>
				</div>
			</div>
			<div class="mb-3">
				<div class="form-check form-switch">
					<?= form_label('COD', 'cod', ['class' => 'form-check-label']); ?>
					<?= form_checkbox('cod', 'ya', TRUE, ['class' => 'form-check-input swictCOD', 'id' => 'cod']); ?>
				</div>
			</div>

			<div class="collapse" id="nonCOD">
				<div class="mb-3">
					<?= form_label('Alamat', 'alamat', ['class' => 'form-label']); ?>
					<?= form_textarea(['name' => 'alamat', 'class' => 'form-control input',  'id' => 'alamat', 'required' => '', 'placeholder' => 'RT/RW, Nama Kampung/Perumahan, No Rumah, Desa/Kelurahan', 'rows' => '3', 'disabled' => '']); ?>
				</div>

				<div class="row gx-2 mb-3">
					<div class="col">
						<?= form_label('Provinsi', 'provinsi', ['class' => 'form-label']); ?>
						<?= form_dropdown('provinsi', ['' => 'Pilih Provinsi'], '', ['class' => 'form-select input', 'id' => 'provinsi', 'required' => '', 'disabled' => '']); ?>
					</div>
					<div class="col">
						<?= form_label('Kab/Kota', 'kabupaten', ['class' => 'form-label']); ?>
						<?= form_dropdown('kabupaten', ['' => 'Pilih Kab/Kota'], '', ['class' => 'form-select input', 'id' => 'kabupaten', 'required' => '', 'disabled' => '']); ?>
					</div>
					<div class="col">
						<?= form_label('Kecamatan', 'kecamatan', ['class' => 'form-label']); ?>
						<?= form_dropdown('kecamatan', ['' => 'Pilih Kecamatan'], '', ['class' => 'form-select input', 'id' => 'kecamatan', 'required' => '', 'disabled' => '']);
						?>
					</div>
				</div>

				<div class="row gx-2 mb-3">
					<div class="col-4">
						<?= form_label('Kode Pos', 'kodepos', ['class' => 'form-label']); ?>
						<?= form_input('kodepos', '', ['class' => 'form-control input', 'id' => 'kodepos', 'placeholder' => 'xxxxx', 'autocomplete' => 'off', 'disabled' => '']); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-reset="false" class="btn btn-link text-decoration-none" data-dismiss="modal">Batal</button>

			<button type="button" disabled class="btn loading btn-primary" style="display:none">
				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Simpan
			</button>
			<button type="submit" class="btn submit btn-primary">
				<i class="fad fa-save"></i> Simpan
			</button>
		</div>
		<?= form_close(); ?>
	</div>
</div>

<!-- Modal tambah biaya -->
<div class="modal fade" id="biayaOrder" data-backdrop="static" tabindex="-1" aria-labelledby="biayaOrderLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="biayaOrderLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('', ['id' => 'tambahBiaya'], ['biayaId' => '']); ?>
			<div class="modal-body">
				<div class="mb-3">
					<?= form_label('Nominal', 'nominalBiaya', ['class' => 'form-label']); ?>
					<?= form_input(['name' => 'nominal_biaya', 'id' => 'nominalBiaya', 'class' => 'form-control', 'required' => '', 'placeholder' => 'cth: ' . random_element(['10000', '20000', '25000', '30000']), 'type' => 'number']); ?>
					<div class="form-text" id="biayaHelp">Gunakan tanda ( <b>-</b> ) untuk mengurangi. misal untuk diskon: <b>-2000</b></div>
				</div>

				<div class="mb-3">
					<?= form_label('Label', 'labelBiaya', ['class' => 'form-label']); ?>
					<?= form_input(['name' => 'label_biaya', 'id' => 'labelBiaya', 'class' => 'form-control', 'placeholder' => 'label biaya - opsional, max: 20 karakter', 'maxlength' => '20']); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link text-decoration-none" data-dismiss="modal">Batal</button>
				<button type="submit" id="submit-form" class="btn btn-primary addBiaya">Tambahkan</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<!-- Modal tambah produk -->
<div class="modal fade" id="tambahProduk" data-backdrop="static" tabindex="-1" aria-labelledby="tambahProdukLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahProdukLabel">Tambah Orderan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('', ['id' => 'nambahProduk']); ?>
			<div class="modal-body">
				<div class="row gx-2">
					<div class="col col-sm-6 col-md-3">
						<?= form_label('Kode Produk', 'kode_produk', ['class' => 'form-label']); ?>
						<?= form_input(['name' => 'kode_produk', 'id' => 'kode_produk', 'class' => 'form-control', 'required' => '', 'placeholder' => 'cth: ' . random_element(['SK-45', 'BK-01', 'Z-01'])]); ?>
					</div>
					<div class="col col-sm-6 col-md-3">
						<?= form_label('Harga Satuan', 'harga_satuan', ['class' => 'form-label']); ?>
						<?= form_input(['name' => 'harga_satuan', 'min' => '0', 'id' => 'harga_satuan', 'class' => 'form-control', 'required' => '', 'placeholder' => 'cth: ' . random_element(['225000', '280000', '295000', '320000']), 'type' => 'number']); ?>
					</div>
					<div class="col col-sm-6 col-md-3">
						<?= form_label('Ukuran', 'ukuran', ['class' => 'form-label']); ?>
						<?php
						echo '<select name="ukuran" class="form-select" id="ukuran" required="">';
						echo '<option value="" disabled="" selected="">Pilih ukuran</option>';
						foreach (config('JuraganConfig')->size as $k => $v) {

							echo '<optgroup label="' . $k . '">';
							foreach ($v as $k2 => $v2) {
								echo '<option value="' . $k2 . '">' . $v2 . '</option>';
							}
							echo '</optgroup>';
						}
						echo '<option value="custom">Custom</option>';
						echo '</select>';
						?>
					</div>
					<div class="col col-sm-6 col-md-3">
						<?= form_label('QTY', 'QTY', ['class' => 'form-label']); ?>
						<?= form_input(['name' => 'QTY', 'id' => 'QTY', 'class' => 'form-control', 'required' => '', 'placeholder' => 'cth: ' . rand(1, 20), 'type' => 'number', 'min' => '1']); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link text-decoration-none" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary addBiaya">Tambahkan</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>



<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?php

$link_api_juragan = site_url("api/get_juragan");
$link_api_pengguna = site_url('api/get_pengguna');
$link_api_provinsi = site_url('rajaongkir/provinsi');
$link_api_kota = site_url('rajaongkir/kota');
$link_api_kecamatan = site_url('rajaongkir/kecamatan');
$link_post_pelanggan = site_url('pelanggan/baru');
$link_invoice = site_url('admin/invoices/lihat/');
$link_api_invoice = site_url('admin/invoices/save');

$js = <<< JS
$(function() { 
	'use strict';
	// collapse sidebar
	// ------------------------------------------------------------------------
	$('#sidebar').on('show.bs.collapse',function(){
		var a=$('<div>',{'class':'modal-backdrop fade show'});
		$('body').toggleClass('modal-open').append(a),
		a.click(function(){
			$('#sidebar').collapse('hide'),
			a.remove(),
			$('body').toggleClass('modal-open');
		});
	});

	$('#sidebarCollapse').on('click',function(){
		$('#listLi').html(''),
		$.getJSON('$link_api_juragan',function(b){
			var a=[];a.push('<li><li><a class="p-2 d-block text-light text-decoration-none" href="$link_invoice"><i class="fad fa-user-circle"></i> Semua Juragan</li></li>'),
			$.each(b,function(c,b){
				a.push('<li><a class="p-2 d-block text-light text-decoration-none" href="$link_invoice'+b.juragan+'"><i class="fad fa-user-circle"></i> '+b.nama_juragan+'</li>');
			}),
			$(a.join('')).appendTo('#listLi');
		});
	});

	// load juragan
	// ------------------------------------------------------------------------
	$.ajax({
		method:'GET',
		url:'$link_api_juragan'
	}).done(function(a){
		$.each(a,function(b,a){
			$('<option />',{value:a.id_juragan,text:a.nama_juragan}).appendTo($('select[name="juragan"]'))
		;});
	});

	// load admin/cs
	// ------------------------------------------------------------------------
	$.ajax({
		method:'GET',
		url:'$link_api_pengguna'
	}).done(function(a){
		$.each(a,function(b,a){
			$('<option />',{value:a.id,text:a.name}).appendTo($('select[name="pengguna"]'));
		});
	});

	// modal tambah pelanggan
	// ------------------------------------------------------------------------
	var mpel=document.getElementById('modalTambahPelanggan');
	mpel.addEventListener('show.bs.modal',function(g){
		var a=g.relatedTarget,
			c=a.getAttribute('data-judul'),
			e=mpel.querySelector('.modal-title');
		e.textContent=c;
	});

	var CoN = document.getElementById('nonCOD');
	CoN.addEventListener('show.bs.collapse', function () {
		var b=mpel.querySelector('[name="provinsi"]');

		$.ajax({
			method:'GET',
			url:'$link_api_provinsi'
		}).done(function(a){
			$.each(a,function(c,a){
				$('<option />',{value:a.province_id,text:a.province}).appendTo(b);
			});
		});
	});

	$(document).on("keyup change", '.swictCOD',function(){
        if(this.checked) {
            // disable "semua" form alamat
            $('#nonCOD .input').prop('disabled', true);
            $('#nonCOD').collapse('hide');
        }
        else {
            $('#nonCOD .input').prop('disabled', false);
            $('#nonCOD').collapse('show');
        }
    });

	var kab=mpel.querySelector('#modalTambahPelanggan [name="kabupaten"]'),
		kec=mpel.querySelector('#modalTambahPelanggan [name="kecamatan"]'),
		fpel=$('#tambahPelanggan');
	fpel.on('submit',function(b){
		b.preventDefault(),
		b.stopPropagation();

		var s=$('#tambahPelanggan .submit'),
			l=$('#tambahPelanggan .loading'),
			f=$('#tambahPelanggan .input');

		$(l).show(),
		$(s).hide(),
		$(f).attr('readonly',true);

		//
		var fd=$(fpel).serialize();
		$.ajax({
			method:'POST',
			url:'$link_post_pelanggan',
			data:fd,
			dataType: "json"
		})
		.done(function(a){
			var c='';
			c+='<span class="d-block font-weight-bold">'+a.nama_pelanggan+'</span>',
			c+='<span class="d-block">';
			$.each(a.hp, function (i,v){
				if(i==1) {
					c+='<span class="sr-only"> / </span><span class="mr-3"></span>';
				}
				c+=v;				
			});
			c+='</span>';
			c+='<span class="d-block">';
			if (a.cod === '0') {
				c+=a.alamat+', '+ a.nama_kecamatan+', '+a.nama_kabupaten +', '+ a.nama_provinsi+', '+ a.kodepos;
			}
			else {
				c+= 'C.O.D';
			}
			c+='</span>',
			$('#alamat_pemesan').empty(),
			$(c).appendTo('#alamat_pemesan');
			if ($('#tambahPelanggan [name="id_pelanggan"]').length > 0) {
				$(this).remove();
			} else {
				$('<input>').attr({
					type: 'hidden',
					name: 'id_pelanggan',
					value: a.id_pelanggan
				}).appendTo(fpel);
			}

			$('[name="pelanggan"]').val(a.id_pelanggan),
			$(mpel).modal('hide'),
			$('.btn-nambahPelanggan').hide(),
			$('#alamat_pemesan').addClass('border rounded p-2 d-block'),
			$('.btn-sunting').show(),
			$(l).hide(),
			$(s).show(),
			$(f).attr('readonly',false);
		})
		.fail(function(a,b,c) {
			$(l).hide(),
			$(s).show(),
			$(f).attr('readonly',false);
		});
	}),
	$('select[name="provinsi"]').on('change',function(){
		$.ajax({
			method:'GET',
			url:'$link_api_kota',
			data:{prov:this.value}
		}).done(function(a){
			$('[name="kabupaten"]').empty(),
			$('[name="kecamatan"]').empty(),
			$('<option />',{value:'',text:'Pilih Kab/Kota'}).appendTo(kab),
			$('<option />',{value:'',text:'Pilih Kecamatan'}).appendTo(kec),
			$.each(a,function(c,a){
				var b=a.city_name;
				a.type=='Kota'&&(b=a.type+' '+a.city_name),
				$('<option />',{value:a.city_id,text:b}).attr('data-kodepos',a.postal_code).appendTo(kab);
			});
		});
	}),
	$('select[name="kabupaten"]').on('change',function(){
		$.ajax({
			method:'GET',
			url:'$link_api_kecamatan',
			data:{kota:this.value}
		}).done(function(a){
			$('[name="kecamatan"]').empty(),
			$('<option />',{value:'',text:'Pilih Kecamatan'}).appendTo(kec),
			$.each(a,function(b,a){
				$('<option />',{value:a.subdistrict_id,text:a.subdistrict_name}).appendTo(kec);
			});
		});
	});

	// modal tambah produk
	// ------------------------------------------------------------------------
	function listOrder(){
		var a=$('.orderan-kosong'),
			c=$('.customBiaya'),
			b=$('.list-orderan').data('length');
		b>1?a.hide():a.show();
		b>1?c.removeClass('d-none'):c.addClass('d-none');
	}

	function newRow(a,b){
		var c = $('<tr/>');
		for(var i=0; i<b.length; i++){
			var d = $('<td/>').append(b[i]);
			c.append(d);
		}
		a.append(c);
	}

	function price(n){
		// untuk menampilkan label harga
		var a = new Intl.NumberFormat(
			'id-ID',{
				style:'currency',
				currency:'IDR',
				unitDisplay:'narrow',
				minimumFractionDigits:0
				}
			).format(n);
		return a;
	}

	var pl='';
	listOrder();
	
	var fpro=$('#nambahProduk');
	fpro.on('submit',function(c){
		c.preventDefault(),
		c.stopPropagation();
		var d=fpro.find('[name="kode_produk"]').val(),
			a=fpro.find('[name="harga_satuan"]').val(),
			e=fpro.find('[name="ukuran"]').val(),
			b=fpro.find('[name="QTY"]').val(),
			f=price(a),
			g=price(a*b),
			j = uniqId(),
			ik = $('<input/>',{'type':'hidden','name': 'produk['+j+'][kode]', 'value': d}),
			ip = $('<input/>',{'type':'hidden','name': 'produk['+j+'][harga]', 'value': a}),
			iz = $('<input/>',{'type':'hidden','name': 'produk['+j+'][ukuran]', 'value': e}),
			iq = $('<input/>',{'type':'hidden','name': 'produk['+j+'][qty]', 'value': b}),
			bt = $('<button />', {'class' : 'close hapus_row orderan mr-1', html:'<span aria-hidden="true"><i class="fad fa-trash-alt h6"></i></span>'}),
			t = $('<div/>').append(bt).append(d+' ( '+e+' )'),
			tb = $('.list-orderan'),
			p = $('<div/>', {'class' : 'text-right', 'data-uang1': a*b}).append(g).append(ik).append(ip).append(iz).append(iq);
	
		newRow(tb,[t,f,b,p]);
		subtotal();

		pl=$('.list-orderan').data('length'),
		$('.list-orderan').data('length',pl+1),
		listOrder(),
		$('#tambahProduk').modal('hide');
	}),
	$(document).on('click','.hapus_row',function(){
		this.closest('tr').remove(),
		$(this).hasClass('orderan')&&(
			pl=$('.list-orderan').data('length'),
			$('.list-orderan').data('length',
			pl-1),
			listOrder(),
			subtotal()
		),
		totalbiaya();
	});

	var mPro=document.getElementById('tambahProduk');
	mPro.addEventListener('hidden.bs.modal',function(){
		var a=$('#nambahProduk');
		a.removeClass('was-validated')[0].reset();
	});

	function subtotal(){
		// hitung subtotal produk
		var r=$('.list-orderan').find('[data-uang1'),
			a=0;
		// console.log(r);
		r.each(function() {
			a+=Number($(this).data('uang1'));
			// console.log($(this).data('uang1'));
		});
		$('#subTotal').attr('data-subtotal', a).empty().html(price(a));
		$(document).trigger('data-attribute-changed');
		
		$('.customBiaya').show();
		// grandtotal();
	}

	$(document).on('data-attribute-changed', function() {
		var a = $('#subTotal')[0]['attributes'],
			b = a.getNamedItem("data-subtotal")['nodeValue'],
			c = a.getNamedItem("data-totalbiaya")['nodeValue'],
			d = parseInt(b) + parseInt(c);

		$('#grandTotal').empty().html(price(d));
	});

	function totalbiaya(){
		var r=$('.listBiaya').find('[data-biaya]'),
			a=0;
		// console.log(r);
		r.each(function() {
			a+=Number($(this).data('biaya'));
			// console.log($(this).data('uang1'));
		});
		$('#subTotal').attr('data-totalbiaya', a);
		$(document).trigger('data-attribute-changed');
		// grandtotal();
	}	

	// modal tambah biaya
	// ------------------------------------------------------------------------
	var mBia=document.getElementById('biayaOrder');
	mBia.addEventListener('show.bs.modal',function(f){
		var a=f.relatedTarget;
		var c=a.getAttribute('data-judul');
		var b=a.getAttribute('data-biayaID');
		var d=mBia.querySelector('.modal-title');
		var e=mBia.querySelector('.modal-content [name="biayaId"]');
		d.textContent='Biaya '+c,b=='1'&&$('#biayaHelp').addClass('d-none'),e.value=b;
	}),
	mBia.addEventListener('hidden.bs.modal',function(b){
		var a=$('#tambahBiaya');
		a.removeClass('was-validated')[0].reset(),
		$('#biayaHelp').removeClass('d-none');
	});
	
	var fBia=$('#tambahBiaya');
	fBia.on('submit',function(f){
		f.preventDefault(),
		f.stopPropagation();

		var a=fBia.find('[name="nominal_biaya"]').val();
		var c=fBia.find('[name="label_biaya"]').val();
		var g=fBia.find('[name="biayaId"]').val();
		var d='';
		c!=''&&(d='<span class="text-muted ml-1">'+c+'</span>');
		var b='';
		switch(parseInt(g)){
			case 1:b='Ongkir';
			break;

			default:b='Lain-lain';
		}
		
		if(parseInt(a)!=0){
			var e='',
				u=parseInt(a);
			u<0&&(e='text-danger');
			var h=price(u),
				j = uniqId(),
				id = $('<input/>',{'type':'hidden','name': 'biaya['+j+'][biaya_id]', 'value': g}),
				no = $('<input/>',{'type':'hidden','name': 'biaya['+j+'][nominal]', 'value': u}),
				la = $('<input/>',{'type':'hidden','name': 'biaya['+j+'][label]', 'value': c}),
				r=$('<tr/>'),
				c1=$('<td/>', {'colspan': '3', 'class': 'text-right'}).append('<button type="button" class="close hapus_row mr-1" aria-label="Close"><span aria-hidden="true"><i class="fad fa-trash-alt h6"></i></span></button>'+b+d),
				c2=$('<td/>').append('<div data-biaya="'+u+'" class="text-right '+e+'">'+h+'</div>').append(id).append(no).append(la),
				q = r.append(c1).append(c2);
			$(q).appendTo('.listBiaya');
			totalbiaya();
		}
		$('#biayaOrder').modal('hide');
	});

	// main form
	var emef=$('#iForm');
	var request;
	emef.on('submit',function(f){
		f.preventDefault(),
		f.stopPropagation();
		
		// Abort any pending request
		if (request) {
			request.abort();
		}
		// setup some local variables
		var f = $(this);

		// Let's select and cache all the fields
		var inputs = f.find("input, select, button, textarea");

		// Serialize the data in the form
		var serializedData = f.serialize();

		// Let's disable the inputs for the duration of the Ajax request.
		// Note: we disable elements AFTER the form data has been serialized.
		// Disabled form elements will not be serialized.
		inputs.prop("disabled", true);

		// Fire off the request to /form.php
		request = $.ajax({
			url: "$link_api_invoice",
			type: "post",
			data: serializedData
		});

		// Callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR){
			// Log a message to the console
			console.log("Hooray, it worked!");
		});

		// Callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown){
			// 
			// console.log( Object.keys(jqXHR['responseJSON']).length);
			$( Object.entries(jqXHR['responseJSON']) ).each(function( i,v ) {
				var Tid = 't-'+uniqId();

				// console.log(v);
				$('#lTo').append(makeToast(Tid, v[1], 'Galat'));
				$('#'+Tid).toast('show');
			});
			
			
			var myToastEl = document.getElementsByClassName('toast')[0];
			myToastEl.addEventListener('hidden.bs.toast', function () {
				// do something...
				$(this).remove();
			});

		});

		// Callback handler that will be called regardless
		// if the request failed or succeeded
		request.always(function () {
			// Reenable the inputs
			inputs.prop("disabled", false);
			
		});		
	});

	


	function makeToast(id,text,status) {
		return `<div id="`+id+`" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
  <div class="toast-header">
    <strong class="mr-auto">`+status+`</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">`+text+`</div>
</div>`;
	}

	//
	function uniqId() {
		return Math.round(new Date().getTime() + (Math.random() * 100));
	}

});

JS;

$packer = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>