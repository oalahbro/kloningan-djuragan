<?php
$pager = \Config\Services::pager();
?>
<?= $this->extend('template/default_admin') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

	<h1 class="h3 mt-5">Pengaturan Juragan</h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb p-0">
			<li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
			<li class="breadcrumb-item"><?= anchor('settings', 'Pengaturan'); ?></li>
			<li class="breadcrumb-item active" aria-current="page">Juragan</li>
		</ol>
	</nav>
</div>
<div class="container">

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
								if ($juragans->resultID->num_rows > 0) {

									foreach ($juragans->getResult() as $juragan) {

										$jbanks = html_entity_decode($juragan->bank, ENT_QUOTES);
										$jjb = '';
										if ($jbanks !== '') {
											foreach (json_decode($jbanks) as $bank) {
												$jjb .= $bank->id . ",";
											}

											$jjb = reduce_multiples($jjb, ", ", TRUE);
										}
								?>

										<tr>
											<td>
												<div class="d-flex justify-content-between">
													<div class="lead"><?= $juragan->nama_juragan; ?></div>
													<div class="">
														<?= anchor('invoices/' . $juragan->juragan, '<i class="fad fa-file-search"></i> lihat orderan'); ?>

														<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalSuntingJuragan" data-selected="<?= $jjb; ?>" data-id="<?= $juragan->id_juragan; ?>" data-nama="<?= $juragan->nama_juragan; ?>"><i class="fad fa-pencil"></i> sunting</button>

														<a href="" class="text-decoration-none"><i class="fad fa-trash"></i> hapus</a>
													</div>
												</div>
											</td>
										</tr>

								<?php
									}
								} else {
									echo '<tr><td class="text-center"><i class="fad fa-user-circle fa-5x"></i><br/>Juragan masih kosong</td></tr>';
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
					<?= form_open('admin/settings/save_juragan'); ?>
					<div class="mb-3">
						<?= form_label('Nama Juragan', 'nama_juragan', ['class' => 'form-label']); ?>
						<?= form_input('nama_juragan', '', ['class' => 'form-control', 'id' => 'nama_juragan', 'required' => '', 'placeholder' => 'nama juragan']); ?>
					</div>
					<div class="mb-3">
						<?= form_label('Rekening Bank / EDC', 'bank', ['class' => 'form-label']); ?>
						<?php
						foreach ($banks as $bank) {
							$options[$bank->id_bank] = strtoupper($bank->nama_bank) . ' - ' . $bank->atas_nama;
						}

						echo form_multiselect('bank[]', $options, [], ['class' => 'form-select', 'required' => '']);
						?>
						<div class="form-text">tekan CTRL untuk memilih lebih dari 1</div>
					</div>
					<hr />
					<div class="mb-3">
						<button class="btn btn-primary btn-block" type="submit"><i class="fad fa-save"></i> Tambahkan</button>
					</div>
					<?= form_close(); ?>

				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalSuntingJuragan" data-backdrop="static" tabindex="-1" aria-labelledby="modalSuntingJuraganLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<?= form_open('admin/settings/update_juragan', ['id' => 'mf'], ['id' => '']); ?>
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

					echo form_multiselect('bank[]', $options, [], ['class' => 'form-select mybanks', 'required' => '']);
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

<?= $this->section('js') ?>
<?php
$link_api_juragan = site_url("api/get_juragan");
$link_invoice = site_url('invoices/index/');

$js = <<< JS
$(function() { 
	'use strict';
	// sidebar
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

	var mj=document.getElementById('modalSuntingJuragan');
	mj.addEventListener('show.bs.modal',function(h){
		var a=h.relatedTarget;
		var c=a.getAttribute('data-selected');
		var d=a.getAttribute('data-id');
		var b=a.getAttribute('data-nama');
		var e=mj.querySelector('.modal-title');
		var f=mj.querySelector('#modalSuntingJuragan input#nama_juragan');
		var g=mj.querySelector('#modalSuntingJuragan input[name="id"]');

		e.textContent='Perbarui '+b,
		f.value=b,
		g.value=d,
		$.each(c.split(','),function(b,a){
			$("select.mybanks option[value='"+a+"']").prop('selected',!0);
		});
	}),
	mj.addEventListener('hide.bs.modal',function(a){
		document.getElementById('mf').reset();
	});
});
JS;

$packer = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>