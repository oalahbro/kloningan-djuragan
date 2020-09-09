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

			<div class="card mb-3">
				<div class="card-body">
					<div class="mb-3">
						<?= form_label('Tanggal Order', 'tanggal_order', ['class' => 'form-label']); ?>
						<?= form_input('tanggal_order', set_value('tanggal_order', $sekarang->toDateString()), ['class' => 'form-control', 'id' => 'tanggal_order', 'required' => '', 'max' => $sekarang->toDateString()], 'date'); ?>
					</div>
					<div class="mb-3">
						<div class="hidden_id">
							<?= form_label('Pelanggan', 'pelanggan', ['class' => 'form-label']); ?>
							<?= form_hidden('id_pemesan', ''); ?>
							<?= form_hidden('id_kirimKe', ''); ?>
						</div>

						<div class="input-group mb-3 mycustom form_pemesan">
							<?= form_input([
								'class' 	=> 'form-control cari_pelanggan pemesan',
								'id' 		=> 'cari_pemesan',
								'placeholder' => 'cari data pelanggan',
								'type' 		=> 'search'
							]); ?>
							<?= form_button([
								'class' 	=> 'btn btn-dark',
								'content' 	=> '<i class="fad fa-plus"></i> Tambah',
								'data-target' => '#modalTambahPelanggan',
								'data-toggle' => 'modal',
								'id' 		=> 'tambah_pemesan_kirimKe',
								'title' 	=> 'Tambah Data Pemesan'
							]); ?>
						</div>

						<div class="mb-3 info-data-pemesan" style="display: none;">
							<?= form_button([
								'class' 	=> 'btn btn-link text-danger text-decoration-none btn-sm float-right btn-hapus-alamat pemesan',
								'content' 	=> '<i class="fad fa-trash"></i> <span class="sr-only">Hapus</span>',
								'title' 	=> 'Hapus Pemesan'
							]); ?>
							<span id="alamat_pemesan" class="border rounded p-2 d-block"></span>
						</div>

						<div class="input-group mb-3 mycustom form_kirimKe" style="display: none">
							<?= form_input([
								'class' 	=> 'form-control cari_pelanggan kirimKe',
								'id' 		=> 'cari_kirimKe',
								'placeholder' => 'cari data pelanggan',
								'type' 		=> 'search'
							]); ?>
							<?= form_button([
								'class' 	=> 'btn btn-dark',
								'content' 	=> '<i class="fad fa-plus"></i> Tambah',
								'data-target' => '#modalTambahPelanggan',
								'data-toggle' => 'modal',
								'id' 		=> 'tambah_kirimKe',
								'title' 	=> 'Tambah Data Kirim Kepada'
							]); ?>
						</div>

						<div class="mb-3 info-data-kirimKe" style="display: none;">
							<?= form_button([
								'class' 	=> 'btn btn-link text-danger text-decoration-none btn-sm float-right btn-hapus-alamat kirimKe',
								'content' 	=> '<i class="fad fa-trash"></i> <span class="sr-only">Hapus</span>',
								'title' 	=> 'Hapus Kirim'
							]); ?>
							<span id="alamat_kirimKe" class="border rounded p-2 d-block"></span>
						</div>
					</div>
					<div class="mb-3">
						<?= form_label('Note / Keterangan', 'keterangan', ['class' => 'form-label']); ?>
						<?= form_textarea(['name' => 'keterangan', 'id' => 'keterangan', 'class' => 'form-control', 'rows' => '3', 'placeholder' => 'opsional']); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8 mb-3">
		<div class="sticky-top" style="top: 60px">
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

			<hr />
			<button type="submit" class="btn btn-primary btn-block text-uppercase">
				<i class="fad fa-save"></i> Simpan
			</button>
		</div>
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

				<div id="auto-results"></div>
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
$link_cari_pelanggan = site_url('pelanggan/cari');
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

	// ambil data juragan 
	// ketika klik tombol menu sidebar diatas
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

	// ------------------------------------------------------------------------
	// autocomplete
	// cari pelanggan jika ada pelanggan lama repeat order
	$(".cari_pelanggan").autocomplete({
		showNoSuggestionNotice: true,
		noSuggestionNotice: '<p class="p-2 bg-warning">Data tidak ada</p>',
		lookup: function (query, done) {
			// Do Ajax call or lookup locally, when done,
			// call the callback and pass your results:
			var result = null;
			$.ajax({
				'async': false,
				'type': "GET",
				'url': "$link_cari_pelanggan",
				'data': { 'q': query, 'juragan_id': $('[name="juragan"]').val()},
				'success': function (data) {
					result =  {
						suggestions: $.map(data.results, function(item) {
							return { value: item.nama, data: item };
						})
					};
				}
			});

			done(result);
		},
		formatResult: function (suggestion, currentValue) {
			let hp = '';
			let ph = suggestion.data.hp
			for (let i = 0; i < ph.length; i++) {
				if (i > 0) {
					hp+= ' / ';
				}
				hp += ph[i];
			}
			return '<h6 class="mb-0">' +suggestion.value + '</h6>' + hp + '<br/>' + suggestion.data.full;
		},
		onSelect: function (suggestion) {
			var c='';
			c+='<span class="d-block font-weight-bold">'+ suggestion.data.nama +'</span>',
			c+='<span class="d-block">';
			$.each(suggestion.data.hp, function (i,v){
				if(i>0) {
					c+='<span> / </span>'; // pemisah nomor hp
				}
				c+=v;				
			});
			c+='</span>';
			c+='<span class="d-block">'+ suggestion.data.full + '</span>';

			var form = $('.form_pemesan');
			// sisipkan data kirim kepada
			// hanya & jika input tidak memiliki .ganti-data-pemesan
			if (!$(this).hasClass("ganti-data-pemesan")) {
				$('#alamat_kirimKe').empty().append('<h6 class="text-muted font-weight-normal">Kirim Kepada</h6>' + c),
				$('.info-data-kirimKe').show(); // tampilkan data alamat kirim Kepada

				$('.form_kirimKe').hide();

				$('.hidden_id [name="id_kirimKe"]').val(suggestion.data.id);
			}

			// sisipkan data pemesan
			// hanya & jika form .pemesan & .ganti-data-pemesan
			if ($(this).hasClass("pemesan") || $(this).hasClass("ganti-data-pemesan")  ) {
				$('#alamat_pemesan').empty().append('<h6 class="text-muted font-weight-normal">Pemesan</h6>' + c),
				$('.info-data-pemesan').show(); // tampilkan data alamat pemesan
				form.hide(); // sembunyikan form cari / tombol tambah pelanggan

				$('.hidden_id [name="id_pemesan"]').val(suggestion.data.id);
			}
			
			$(this).autocomplete('clear').val(''); // hapus cache dan selected
		}
	});

	// hapus data pemesan / kirim kepada
	$('.btn-hapus-alamat').on('click', function(){
		if($(this).hasClass("pemesan")) {
			$('#alamat_pemesan').empty(); // hapus alamat pemesan
			$('.form_pemesan').show();
			$('#cari_pemesan').show().addClass('ganti-data-pemesan');
			$('.info-data-pemesan').hide();

			$('.hidden_id [name="id_pemesan"]').val('');

			if ($('.hidden_id [name="id_kirimKe"]').val() == '') {
				$('.form_kirimKe').hide();
				$('.info-data-kirimKe').hide();

				$(".cari_pelanggan").removeClass('ganti-data-pemesan');
			}
		}
		else if($(this).hasClass("kirimKe")) {
			$('#alamat_kirimKe').empty(); // hapus alamat pemesan
			$('.form_kirimKe').show();
			$('#cari_kirimKe').show().addClass('ganti-data-kirimKe');
			$('.info-data-kirimKe').hide();

			$('.hidden_id [name="id_kirimKe"]').val('');

			if ($('.hidden_id [name="id_pemesan"]').val() == '') {
				// $('.form_pemesan').hide();
				$('.form_kirimKe').hide();

				$(".cari_pelanggan").removeClass('ganti-data-kirimKe');
			}
		}
	});

	// ------------------------------------------------------------------------
	// load juragan
	// embed langsung ke form select - dropdown
	$.ajax({
		method:'GET',
		url:'$link_api_juragan'
	}).done(function(a){
		$.each(a,function(b,a){
			$('<option />',{value:a.id_juragan,text:a.nama_juragan}).appendTo($('select[name="juragan"]'))
		;});
	});

	// ------------------------------------------------------------------------
	// load admin/cs
	// embed langsung ke form select - dropdown
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
			c=a.getAttribute('title'),
			d=a.getAttribute('id'),
			e=mpel.querySelector('.modal-title');
		e.textContent=c;
		$('#tambahPelanggan').addClass(d);
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
		fpel=$('#tambahPelanggan'),
		request_pelanggan;

	fpel.on('submit',function(event){
		// Prevent default posting of form - put here to work in case of errors
		event.preventDefault();

		// Abort any pending request
		if (request_pelanggan) {
			request_pelanggan.abort();
		}
		// setup some local variables
		var form = $(this);

		// Let's select and cache all the fields
		var inputs = form.find("input, select, button, textarea");

		// Serialize the data in the form
		var serializedData = form.serialize();

		// Let's disable the inputs for the duration of the Ajax request.
		// Note: we disable elements AFTER the form data has been serialized.
		// Disabled form elements will not be serialized.
		inputs.prop("disabled", true);

		// Fire off the request to /form.php
		request_pelanggan = $.ajax({
			url: "$link_post_pelanggan",
			type: "post",
			data: serializedData
		});

		// Callback handler that will be called on success
		request_pelanggan.done(function (response, textStatus, jqXHR){
			var c='';
			c+='<span class="d-block font-weight-bold">'+response.nama_pelanggan+'</span>',
			c+='<span class="d-block">';
			$.each(response.hp, function (i,v){
				if(i==1) {
					c+='<span class="sr-only"> / </span><span class="mr-3"></span>';
				}
				c+=v;				
			});
			c+='</span>';
			c+='<span class="d-block">';
			if (response.cod === '0') {
				c+=response.alamat+', '+ response.nama_kecamatan+', '+response.nama_kabupaten +', '+ response.nama_provinsi+', '+response.kodepos;
			}
			else {
				c+= 'C.O.D';
			}
			c+='</span>';

			if (form.hasClass('tambah_pemesan_kirimKe')) {
				// sisipkan dikedua
				$('#alamat_pemesan').empty().append(c);
				$('#alamat_kirimKe').empty().append(c);

				$('.hidden_id [name="id_pemesan"]').val(response.id_pelanggan);
				$('.hidden_id [name="id_kirimKe"]').val(response.id_pelanggan);

				$('.form_pemesan').hide();

				$('.info-data-pemesan').show();
				$('.info-data-kirimKe').show();

				form.removeClass('tambah_pemesan_kirimKe'),
				$('#tambah_pemesan_kirimKe').attr("id","tambah_pemesan");
			}
			else if (form.hasClass('tambah_pemesan')) {
				// sisipkan hanya untuk pemesan
				$('#alamat_pemesan').empty().append(c);
				$('.hidden_id [name="id_pemesan"]').val(response.id_pelanggan);

				$('.form_pemesan').hide();
				$('.info-data-pemesan').show();
			}
			else if (form.hasClass('tambah_kirimKe')) {
				// sisipkan hanya untuk kirim kepada
				$('#alamat_kirimKe').empty().append(c);
				$('.hidden_id [name="id_kirimKe"]').val(response.id_pelanggan);

				$('.form_kirimKe').hide();
				$('.info-data-kirimKe').show();
			}
			$(mpel).modal('hide');
		});

		// Callback handler that will be called on failure
		request_pelanggan.fail(function (jqXHR, textStatus, errorThrown){
			// Log the error to the console
			console.error(
				"The following error occurred: "+
				textStatus, errorThrown
			);
		});

		// Callback handler that will be called regardless
		// if the request failed or succeeded
		request_pelanggan.always(function () {
			// Reenable the inputs
			inputs.prop("disabled", false);
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
echo '<script>' . $js . '</script>';
?>
<?= $this->endSection() ?>