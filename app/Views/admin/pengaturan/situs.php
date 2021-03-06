<?php
$pager   = \Config\Services::pager();
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
                                            <button class="btn btn-outline-secondary"><i class="fal fa-pencil"></i></button>
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
                        <button class="btn btn-block btn-primary" type="submit"><i class="fal fa-save"></i> Tambahkan</button>
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

$current_user_id  = $session->get('id');
$link_api_juragan = site_url('api/juragan/by_user/');
$link_invoice     = site_url('admin/invoices/lihat/');
$link_api_notif   = site_url('api/notifikasi/');

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
    		var id = {$current_user_id};
    		$('#listLi').html(''),
    		$.getJSON('{$link_api_juragan}', { id: id }, function(b){
    			var a=[];a.push('<li><li><a class="p-2 d-block text-light text-decoration-none" href="{$link_invoice}'+'semua'+'"><i class="fal fa-user-circle"></i> Semua Juragan</li></li>');
    			
    			$.each(b[id].juragan,function(c,b){
    				a.push('<li><a class="p-2 d-block text-light text-decoration-none" href="{$link_invoice}'+b.slug+'"><i class="fal fa-user-circle"></i> '+b.nama+'</li>');
    			}),

    			$(a.join('')).appendTo('#listLi');
    		});
    	});

        // notifikasi
    	// ------------------------------------------------------------------------
    	function getNotif(page = 1, dibaca = 0){
    		var id = {$current_user_id};
    		$.getJSON('{$link_api_notif}' + 'get', { id: id, page: page, dibaca: dibaca }, function(b){
    			var a=[],
    				data = b.results;

    			if (b.count > 0) {
    				$('.btnSettingNotif').show();
    				a.push('');

    				$.each(data,function(c,b){
    					a.push(`<div class="list-group-item list-group-item-action">
    						<div class="d-flex">
    							<div class="mr-auto">
    								<div class="text-muted small">`+b.created_at +`</div>
    								<a class="d-block text-decoration-none" href="{$link_invoice}/semua/semua?cari[kolom]=faktur&cari[q]=`+b.invoice+`">`+ b.notif+`</a>
    							</div>
    							<div class="d-flex justify-content-right flex-column actionNotif">
    								<button data-id="`+b.id+`" class="markAs border-0 bg-transparent text-primary small" type="button"><i class="fal fa-circle"></i></button>
    							</div>
    						</div>
    					</div>`);
    				}),
    				$(a.join('')).appendTo('#notifDisini');
    				var next = '';

    				if (b.next) {
    					$('<button type="button" class="list-group-item list-group-item-action text-center lanjutNotif" data-page="'+ (b.page+1) +'">lanjut ...</button>').appendTo('#notifDisini');
    				}
    			}
    			else {
    				$('.btnSettingNotif').hide();

    				$('<div class="d-flex justify-content-center align-items-center" style="height: 90vh"><i class="fal fa-bell-slash fa-5x"></i></div>').appendTo('#notifDisini');
    			}
    		});
    	}

    	$(document).on('click', '.lanjutNotif',function(){
    		getNotif($(this).data('page'));
    		$(this).attr('disabled', true).html(`<div class="text-center">
    			<div class="spinner-border" role="status">
    				<span class="sr-only">Loading...</span>
    			</div>
    		</div>`).remove();
    	});

    	$('#notif-pane').on('show.bs.collapse',function(){
    		var id = {$current_user_id};
    		$('#notifDisini').empty(),
    		getNotif();

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
    		var id = {$current_user_id};
    		$.getJSON('{$link_api_notif}' + 'get', { id: id }, function(b){
    			$('.counter').text(b.count);
    		});
    	}

    	$(document).on('click', '.actionNotif .markAs', function() { // markAs
    		var action = '';

    		if ($(this).hasClass( "text-primary" )) {
    			$(this).removeClass('text-primary').addClass('text-muted');	
    			action = 'sudahBaca';
    		}
    		else {
    			$(this).removeClass('text-muted').addClass('text-primary');
    			action = 'belumBaca';
    		}

    		$.post( '{$link_api_notif}' + 'mark', { action: action, id: $(this).data('id') });
    	});

    	$('.tandaiSemuaTerbaca').on('click',function(){ 
    		var id = {$current_user_id};

    		$.post( '{$link_api_notif}' + 'mark_all', { id: id }, function() {
    			// 
    			$('.actionNotif .markAs').removeClass('text-primary').addClass('text-muted');
    		});
    	});

    });
    JS;

$packer    = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>