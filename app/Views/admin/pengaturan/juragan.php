<?php
$pager   = \Config\Services::pager();
$session = \Config\Services::session();
?>
<?= $this->extend('template/default_admin') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

	<h1 class="h3 mt-5">Pengaturan Juragan</h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb p-0">
			<li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
			<li class="breadcrumb-item"><?= anchor('admin/settings', 'Pengaturan'); ?></li>
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
							<tbody id="juragans">
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
						<button class="btn btn-primary btn-block" type="submit"><i class="fal fa-save"></i> Tambahkan</button>
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
				<button type="button" class="btn-close" data-dismiss="modal"aria-label="Close">
					
				</button>
			</div>
			<div class="modal-body">

				<div class="mb-3">
					<?= form_label('Nama Juragan', 'nama_juragan', ['class' => 'form-label']); ?>
					<?= form_input('nama_juragan', '', ['class' => 'form-control', 'id' => 'nama_juragan', 'required' => '', 'placeholder' => 'nama juragan']); ?>
				</div>
				<div class="mb-3">
					<?= form_label('Rekening Bank', 'bank', ['class' => 'form-label']); ?>
					<?= form_multiselect('bank[]', $options, [], ['class' => 'form-select mybanks', 'required' => '']);
                    ?>
					<div class="form-text">tekan CTRL untuk memilih lebih dari 1</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link text-decoration-none" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Simpan</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?php

$current_user_id      = $session->get('id');
$link_api_juragan     = site_url('api/juragan/by_user/');
$link_api_juragan_all = site_url('api/juragan/all/');
$link_invoice         = site_url('admin/invoices/lihat/');
$link_api_notif       = site_url('api/notifikasi/');

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

    	$.getJSON('{$link_api_juragan_all}', function(b){
    		var a=[];		
    		$.each(b,function(c,b){
    			var selected = '';

    			var banks = b.bank;
    			for(var i in banks){
    				// console.log(i); //  key
    				// console.log(banks[i]); // key's value

    				selected += i + ',';
    			}

    			a.push(`<tr><td>
    				<div class="d-flex justify-content-between">
    					<div class="lead">`+b.nama+`</div>
    					<div>
    						<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalSuntingJuragan" data-selected="`+selected.replace(/,\s*$/, "")+`" data-id="`+b.id+`" data-nama="`+b.nama+`"><i class="fal fa-pencil"></i> sunting</button>

    						<a href="" class="text-decoration-none"><i class="fal fa-trash"></i> hapus</a>
    					</div>
    				</div>
    			</td></tr>`);
    		}),

    		$(a.join('')).appendTo('#juragans');
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

$packer    = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>