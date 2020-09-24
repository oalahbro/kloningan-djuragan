<?php
$pager = \Config\Services::pager();
$session = \Config\Services::session();
?>
<?= $this->extend('template/default_admin') ?>
<?= $this->section('content') ?>
<div class="container-xxl">
    <h1 class="h3 mt-5">Pengaturan Situs</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <?= anchor('', 'Dasbor'); ?>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 110px">Logo</th>
                                <th colspan="2">Rekening</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($banks as $bank) { ?>
                                <tr>
                                    <td>
                                        <?= logo_bank($bank->nama_bank); ?>
                                    </td>
                                    <td>
                                        <h5 class="mb-0"><?= $bank->rekening; ?></h5>
                                        <div class="text-muted"><?= $bank->atas_nama; ?></div>
                                    </td>
                                    <td>
                                        <?php if ($bank->id_bank > 2) { // COD not editable
                                        ?>
                                            <button class="btn btn-outline-secondary"><i class="fad fa-pencil"></i></button>
                                        <?php } ?>
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
        <div class="col-sm-4 mb-3">
            <div class="card sticky-top" style="top: 60px">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <span class="nav-link active" aria-current="true">Tambah Bank / EDC</span>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <?= form_open('admin/settings/save_bank'); ?>
                    <div class="mb-3">
                        <?= form_label('Tipe Akun', 'nama_bank', ['class' => 'form-label']); ?>
                        <select name="nama_bank" id="nama_bank" class="form-select" required="">
                            <option value="" selected="selected" disabled="">Pilih tipe</option>
                            <option value="bca">BCA</option>
                            <option value="bni">BNI</option>
                            <option value="bri">BRI</option>
                            <option value="mandiri">Mandiri</option>
                            <option value="edc">EDC</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <?= form_label('Nomor Rekening', 'nomor_rekening', ['class' => 'form-label']); ?>
                        <?= form_input('nomor_rekening', '', ['class' => 'form-control', 'id' => 'nomor_rekening', 'required' => '']); ?>
                    </div>
                    <div class="mb-3">
                        <?= form_label('Atas Nama', 'atas_nama', ['class' => 'form-label']); ?>
                        <?= form_input('atas_nama', '', ['class' => 'form-control', 'id' => 'atas_nama', 'required' => '']); ?>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-block btn-primary" type="submit"><i class="fad fa-save"></i> Tambahkan</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?php

$current_user_id = $session->get('id');
$link_api_juragan = site_url("api/juragan/by_user/");
$link_invoice = site_url('admin/invoices/lihat/');
$link_api_notif = site_url('api/notifikasi/');

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
		var id = $current_user_id;
		$('#listLi').html(''),
		$.getJSON('$link_api_juragan', { id: id }, function(b){
			var a=[];a.push('<li><li><a class="p-2 d-block text-light text-decoration-none" href="$link_invoice'+'semua'+'"><i class="fad fa-user-circle"></i> Semua Juragan</li></li>');
			
			$.each(b[id].juragan,function(c,b){
				a.push('<li><a class="p-2 d-block text-light text-decoration-none" href="$link_invoice'+b.slug+'"><i class="fad fa-user-circle"></i> '+b.nama+'</li>');
			}),

			$(a.join('')).appendTo('#listLi');
		});
	});

    // notifikasi
	// ------------------------------------------------------------------------
	$('#notif-pane').on('show.bs.collapse',function(){
		var id = $current_user_id;
		$('#notifDisini').html(''),
		$.getJSON('$link_api_notif' + 'get', { id: id }, function(b){
			var a=[];
			a.push('');
			
			$.each(b,function(c,b){
				a.push('<a href="$link_invoice/semua/semua?cari[kolom]=faktur&cari[q]='+b.invoice+'" class="list-group-item list-group-item-action"><small class="text-muted">'+b.created_at +'</small><br/>' + b.notif+'</a>');
			}),
			$(a.join('')).appendTo('#notifDisini');
		});

		var a=$('<div>',{'class':'modal-backdrop fade show'});
		$('body').toggleClass('modal-open').append(a),
		a.click(function(){
			$('#notif-pane').collapse('hide'),
			a.remove(),
			$('body').toggleClass('modal-open');
		});
	});

	counter_notif();

	setInterval(function(){ 
		counter_notif();
	}, 10000);

	function counter_notif() {
		var id = $current_user_id;
		$.getJSON('$link_api_notif' + 'count', { id: id }, function(b){
			if(b.belum_baca > 0)
			{
				$('.counter').text(b.belum_baca);
			}
		});
	}

});
JS;

$packer = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>