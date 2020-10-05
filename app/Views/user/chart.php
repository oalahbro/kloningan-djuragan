<?php

use CodeIgniter\I18n\Time;
use App\Libraries\Ongkir;

$sekarang = new Time('now');
$pager = \Config\Services::pager();
$session = \Config\Services::session();
?>
<?= $this->extend('template/default_user') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

	<h1 class="h3 mt-5"><?= $title; ?></h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb p-0">
			<li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
			<li class="breadcrumb-item active" aria-current="page">Chart</li>
		</ol>
	</nav>

</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?php

$current_user_id = $session->get('id');
$link_api_juragan = site_url("api/juragan/by_user/");
$link_invoice = site_url('user/invoices/lihat/');
$link_api_notif = site_url('api/notifikasi/');

$js = <<< JS
$(function() { 
	'use strict';
	// popover 
	// ------------------------------------------------------------------------
	var po = {};
		po.trigger = 'focus';
		po.placement = 'right';
		po.container = 'body';
		po.html = true;
		po.selector = '[data-toggle="popHarga"]';
		po.template = '<div class="popover shadow" role="tooltip"><div class="popover-arrow"></div><div class="popover-body"></div></div>';
	$('body').popover(po);

	// tooltips
	// ------------------------------------------------------------------------
	var tt = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
	var ttl = tt.map(function(e) {
		return new bootstrap.Tooltip(e);
	});

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
			var a=[];			
			$.each(b[id].juragan,function(c,b){
				a.push('<li><a class="p-2 d-block text-light text-decoration-none" href="$link_invoice'+b.slug+'"><i class="fal fa-user-circle"></i> '+b.nama+'</li>');
			}),

			$(a.join('')).appendTo('#listLi');
		});
	});

	// notifikasi
	// ------------------------------------------------------------------------
	function getNotif(page = 1, dibaca = 0){
		var id = $current_user_id;
		$.getJSON('$link_api_notif' + 'get', { id: id, page: page, dibaca: dibaca }, function(b){
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
								<a class="d-block text-decoration-none" href="$link_invoice`+b.juragan+`/semua?cari[kolom]=faktur&cari[q]=`+b.invoice+`">`+ b.notif+`</a>
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
		var id = $current_user_id;
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
		var id = $current_user_id;
		$.getJSON('$link_api_notif' + 'get', { id: id }, function(b){
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

		$.post( '$link_api_notif' + 'mark', { action: action, id: $(this).data('id') });
	});

	$('.tandaiSemuaTerbaca').on('click',function(){ 
		var id = $current_user_id;

		$.post( '$link_api_notif' + 'mark_all', { id: id }, function() {
			// 
			$('.actionNotif .markAs').removeClass('text-primary').addClass('text-muted');
		});
	});

	
});
JS;

$packer = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>