<?php
<<<<<<< HEAD
use CodeIgniter\I18n\Time;
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
$pager = \Config\Services::pager();
?>
<?= $this->extend('template/logged') ?>
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
<<<<<<< HEAD
                            <?php 
=======
                            <?php
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
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
<<<<<<< HEAD
                                        <button class="btn btn-outline-secondary"><i class="fad fa-pencil"></i></button>
                                    </td>
                                </tr>
                            <?php 
=======
                                        <?php if ($bank->id_bank > 2) { // COD not editable
                                        ?>
                                            <button class="btn btn-outline-secondary"><i class="fad fa-pencil"></i></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
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
<<<<<<< HEAD
                            <span class="nav-link active" aria-current="true">Tambah Bank</span>
=======
                            <span class="nav-link active" aria-current="true">Tambah Bank / EDC</span>
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <?= form_open('settings/save_bank'); ?>
                    <div class="mb-3">
<<<<<<< HEAD
                        <?= form_label('Nama Bank', 'nama_bank', ['class' => 'form-label']); ?>
                        <select name="nama_bank" id="nama_bank" class="form-select" required="">
                            <option value="" selected="selected" disabled="">Pilih bank</option>
=======
                        <?= form_label('Tipe Akun', 'nama_bank', ['class' => 'form-label']); ?>
                        <select name="nama_bank" id="nama_bank" class="form-select" required="">
                            <option value="" selected="selected" disabled="">Pilih tipe</option>
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
                            <option value="bca">BCA</option>
                            <option value="bni">BNI</option>
                            <option value="bri">BRI</option>
                            <option value="mandiri">Mandiri</option>
<<<<<<< HEAD
=======
                            <option value="edc">EDC</option>
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
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
<<<<<<< HEAD
=======
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
});
JS;

$packer = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
<?= $this->endSection() ?>