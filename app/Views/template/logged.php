<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />
	<title>
		<?= $title; ?>
	</title>
	<style type="text/css">
	body,
	.breadcrumb {
		background-color: #eee;
	}

	.bg-paid {
		background: rgba(52, 180, 113, .1)
	}

	.bg-unpaid {
		background: rgba(249, 103, 108, .1)
	}

	.bg-credit {
		background: rgba(240, 173, 78, .1)
	}

	.mainnav {
		z-index: 1030 !important;
	}

	.logo svg {
		width: 50px;
		height: auto
	}

	.timeline {
		font-size: 0;
	}

	.timeline li {
		display: inline-flex;
		position: relative;
		text-align: center;
		height: 60px;
		width: 40px;
		align-items: center;
		flex-direction: column;
		justify-content: center;
		color: #ddd
	}

	.timeline li:before {
		content: "";
		position: absolute;
		width: 100%;
		height: 2px;
		background: #ddd;
	}

	.timeline li.start:before {
		width: 50%;
		left: 50%;
	}

	.timeline li.end:before {
		width: 50%;
		right: 50%;
	}

	.timeline li:after {
		content: "";
		width: 10px;
		height: 10px;
		background: #ddd;
		border-radius: 50%;
		position: absolute;
		bottom: 25px;
	}

	.timeline li.full {
		color: #28a745 !important;
	}

	.timeline li.full:before,
	.timeline li.full:after {
		background-color: #28a745 !important;
	}

	.timeline li.half {
		color: #ffc107 !important;
	}

	.timeline li.half:before,
	.timeline li.half:after {
		background-color: #ffc107 !important;
	}

	.timeline li>.icon {
		position: relative;
		top: -15px;
		font-size: 22px !important;
	}

	.timeline li>span {
		font-size: 10px !important;
	}


	.dropdown-menu.notify-drop {
		min-width: 330px;
		min-height: 360px;
		max-height: 360px;
	}

	.dropdown-menu.notify-drop .drop-content {
		min-height: 280px;
		max-height: 280px;
		overflow-y: scroll;
	}

	#listJuragan {
		z-index: 10000;
		width: 100%;
		height: calc(100% - 50px);
		overflow-y: scroll;
	}

	#listJuragan a:hover {
		background: rgba(255, 255, 255, .5);
		text-decoration: none;
		color: white !important;
	}

	.sidebarcollapse {
		top: 0;
		height: 100vh;
		left: -250px;
		width: 250px;
		transition: all 0.4s ease;
		display: block;
		z-index: 10000;
	}

	.sidebarcollapse.collapsing {
		height: auto !important;
		margin-right: 50%;
		left: -250px;
		transition: all 0.2s ease;
	}

	.sidebarcollapse.show {
		left: 0;
	}

	.amplop::before,
	.amplop::after {
		content: '';
		height: 10px;
		display: block;
		margin-top: -4px;
		margin-left: -4px;
		margin-right: -4px;
		margin-bottom: 5px;
		border-top-left-radius: 0.25rem;
		border-top-right-radius: 0.25rem;
		background-image: repeating-linear-gradient(135deg, #F29B91 0px, #F09290 15px, transparent 15px, transparent 25px, #83B3DB 25px, #84ADCB 40px, transparent 40px, transparent 50px);
	}

	.amplop::after {
		margin-top: 5px;
		margin-bottom: -4px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		border-bottom-left-radius: 0.25rem;
		border-bottom-right-radius: 0.25rem;
	}

	@media (max-width: 767.98px) {
		.navbar-nav-scroll {
			width: 100%
		}
	}

	.mt-n5 {
		margin-top: -3.60em;
	}
	</style>
</head>

<body>
	<nav class="sticky-top mainnav navbar navbar-expand navbar-dark bg-dark bg-gradient">
		<div class="container-xxl d-flex flex-wrap flex-md-nowrap align-items-center justify-content-between">
			<div class="d-flex align-items-center mr-3" id="logo">
				<?php echo form_button(array('class' => 'btn-juragan btn btn-outline-light', 'data-toggle' => "collapse", 'data-target' => "#sidebar", 'id' => 'sidebarCollapse', 'content' => '<i class="fad fa-align-left fa-flip-vertical"></i>')); ?>
				<?php echo anchor('', 'Pesanan Juragan', ['class' => 'navbar-brand ml-3']); ?>
			</div>
			<div id="menu" class="order-3 order-md-0 navbar-nav-scroll d-flex justify-content-center">
				<ul class="navbar-nav bd-navbar-nav flex-row py-2 py-md-0">
					<li class="nav-item">
						<?= anchor('invoices/baru', 'Tulis Pesanan', ['class'=>'nav-link']) ?>
					</li>
					<li class="nav-item">
						<?= anchor('pelanggan', 'Customer', ['class'=>'nav-link']) ?>
					</li>
					<li class="nav-item">
						<?= anchor('produk', 'Produk', ['class'=>'nav-link']) ?>
					</li>
				</ul>
			</div>
			<div id="topmenu" class="ml-sm-auto">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link" id="dropSetting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fad fa-cogs d-block d-md-none"></i> <span class="d-none d-md-inline-block">Pengaturan</span></a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropUser">
							<?= anchor('settings', '<i class="fad fa-globe"></i> Situs', array('class' => 'dropdown-item')); ?>
							<hr class="dropdown-divider" />
							<?= anchor('settings/juragan', '<i class="fad fa-user-circle"></i> Juragan', array('class' => 'dropdown-item')); ?>
							<?= anchor('settings/pengguna', '<i class="fad fa-users"></i> Pengguna', array('class' => 'dropdown-item')); ?>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" href="#" id="dropUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fad fa-user d-block d-md-none"></i> <span class="d-none d-md-inline-block">
								<?= $_SESSION['name']; ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropUser">
							<?= anchor('user/sunting', 'Ubah Profil', array('class' => 'dropdown-item')); ?>
							<?= anchor('auth/keluar', 'Keluar', array('class' => 'dropdown-item')); ?>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<nav id="sidebar" class="position-fixed bg-dark collapse sidebarcollapse" style="">
		<div class="d-block border-bottom border-secondary shadow">
			<h6 class="dropdown-header py-3">Pilih Juragan</h6>
		</div>
		<div class="sidebar position-relative" id="listJuragan">
			<ul class="list-unstyled " id="listLi"></ul>
		</div>
	</nav>
	<?= $this->renderSection('content') ?>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

	<script>
	var popOverSettings = {
		trigger: 'focus',
		placement: 'right',
		container: 'body',
		html: true,
		selector: '[data-toggle="popHarga"]',
		template: '<div class="popover shadow" role="tooltip"><div class="popover-arrow"></div><div class="popover-body"></div></div>'
	}
	$('#editJuragan').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data('whatever') // Extract info from data-* attributes
		var id = button.data('id')
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('.modal-title').text('Sunting ' + recipient)
		modal.find('.modal-body input[name="nama"]').val(recipient)
		modal.find('.modal-body input[name="id"]').val(id)
	});
	$('body').popover(popOverSettings);
	$('#sidebar').on('show.bs.collapse', function() {
		var $div = $("<div>", { "class": "modal-backdrop fade show" });
		$("body").toggleClass('modal-open').append($div);
		$div.click(function() {
			$('#sidebar').collapse('hide');
			$div.remove();
			$("body").toggleClass('modal-open');
		});
	});
	$(function() {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
		// juragan
		$("#sidebarCollapse").click(function() {
			$('#listLi').html('');
			$.getJSON("<?= site_url('api/get_juragan'); ?>", function( data ) {
				var items = []; items.push('<li><?= anchor('faktur/index', '<i class="fad fa-users"></i> Semua Juragan', ['class' => 'p-2 d-block text-light text-decoration-none']); ?> </li>');
					$.each(data, function(i, list) {
						items.push('<li><a class="p-2 d-block text-light text-decoration-none" href="<?= site_url('faktur/index/') ?>' + list.juragan + '"><i class="fad fa-user-circle"></i> ' + list.nama_juragan + '</li>');
					}); $(items.join("")).appendTo("#listLi");
				})
		});

		<?php if (uri_string(current_url()) === 'settings/juragan') { ?>

		var suntingModalJuragan = document.getElementById('modalSuntingJuragan')
		suntingModalJuragan.addEventListener('show.bs.modal', function (event) {
			// Button that triggered the modal
			var button = event.relatedTarget
			// Extract info from data-* attributes
			var bank_selected = button.getAttribute('data-selected')
			var id_juragan = button.getAttribute('data-id')
			var nama_juragan = button.getAttribute('data-nama')
			// If necessary, you could initiate an AJAX request here
			// and then do the updating in a callback.
			//
			// Update the modal's content.
			var modalTitle = suntingModalJuragan.querySelector('.modal-title')
			var inputNamaJuragan = suntingModalJuragan.querySelector('#modalSuntingJuragan input#nama_juragan')
			var inputIdJuragan = suntingModalJuragan.querySelector('#modalSuntingJuragan input[name="id"]')
			modalTitle.textContent = 'Perbarui ' + nama_juragan
			inputNamaJuragan.value = nama_juragan
			inputIdJuragan.value = id_juragan

			// alert(hidValue);
			var selectedOptions = bank_selected.split(",");
			for(var i in selectedOptions) {
				var optionVal = selectedOptions[i];
				$("select.mybanks").find("option[value="+optionVal+"]").prop("selected", "selected");
			}
			$("select.mybanks").multiselect('refresh');
		});
		<?php } ?>
		<?php if (uri_string(current_url()) === 'settings/pengguna') { ?>

		var suntingModalPengguna = document.getElementById('modalSuntingPengguna')
		suntingModalPengguna.addEventListener('show.bs.modal', function (event) {
			// Button that triggered the modal
			var button = event.relatedTarget
			// Extract info from data-* attributes
			var id_pengguna = button.getAttribute('data-id')
			var nama = button.getAttribute('data-nama')
			var username = button.getAttribute('data-username')
			var email = button.getAttribute('data-email')
			var level = button.getAttribute('data-level')
			var status = button.getAttribute('data-status')
			// If necessary, you could initiate an AJAX request here
			// and then do the updating in a callback.
			//
			// Update the modal's content.
			var modalTitle = suntingModalPengguna.querySelector('.modal-title')
			var inputId = suntingModalPengguna.querySelector('#modalSuntingPengguna input[name="id"]') 
			var inputNama = suntingModalPengguna.querySelector('#modalSuntingPengguna input[name="nama"]') 
			var inputUsername = suntingModalPengguna.querySelector('#modalSuntingPengguna input[name="username"]') 
			var inputEmail = suntingModalPengguna.querySelector('#modalSuntingPengguna input[name="email"]') 
			var inputLevel = suntingModalPengguna.querySelector('#modalSuntingPengguna select[name="level"]') 
			var inputStatus = suntingModalPengguna.querySelector('#modalSuntingPengguna select[name="status"]') 

			modalTitle.textContent = 'Perbarui ' + nama
			inputId.value = id_pengguna
			inputNama.value = nama
			inputUsername.value = username
			inputEmail.value = email
			inputLevel.value = level
			inputStatus.value = status

			// relasi
			$.ajax({
				method: "GET",
				// headers: {'X-Requested-With': 'XMLHttpRequest'},
				url: "<?= site_url('settings/pengguna_relasi'); ?>",
				data: { id: id_pengguna }
			})
			.done(function( msg ) {
				$.each(msg, function(i,val) {
					$("select#juragan_").find("option[value="+val+"]").prop("selected", "selected");
				})
			});			
		});
		<?php } ?>
		<?php if (uri_string(current_url()) === 'invoices/baru') { ?>
			
			// load juragan
			var j = $('select[name="juragan"]');
			$.ajax({
				method: "GET",
				// headers: {'X-Requested-With': 'XMLHttpRequest'},
				url: "<?= site_url('api/get_juragan'); ?>"
			})
			.done(function( msg ) {
				$.each(msg, function(i,val) {
					$('<option />', {value: val.id_juragan, text: val.nama_juragan}).appendTo(j);
				})
			});

			// load admin/cs
			var p = $('select[name="pengguna"]');
			$.ajax({
				method: "GET",
				// headers: {'X-Requested-With': 'XMLHttpRequest'},
				url: "<?= site_url('api/get_pengguna'); ?>"
			})
			.done(function( msg ) {
				$.each(msg, function(i,val) {
					$('<option />', {value: val.id, text: val.name}).appendTo(p);
				})
			});

			var tambahPengguna = document.getElementById('modalTambahPelanggan')
			tambahPengguna.addEventListener('show.bs.modal', function (e) {
				var p = tambahPengguna.querySelector('#modalTambahPelanggan [name="provinsi"]')
				$.ajax({
					method: "GET",
					// headers: {'X-Requested-With': 'XMLHttpRequest'},
					url: "<?= site_url('ongkir/provinsi'); ?>"
				})
				.done(function( msg ) {
					$.each(msg, function(i,val) {
						$('<option />', {value: val.province_id, text: val.province}).appendTo(p);
					})
				});
			})

			var kab = tambahPengguna.querySelector('#modalTambahPelanggan [name="kabupaten"]');
			var kec = tambahPengguna.querySelector('#modalTambahPelanggan [name="kecamatan"]');

			// 
			$('select[name="provinsi"]').on('change', function() {
				$.ajax({
					method: "GET",
					// headers: {'X-Requested-With': 'XMLHttpRequest'},
					url: "<?= site_url('ongkir/kota'); ?>",
					data: {prov: this.value}
				})
				.done(function( msg ) {
					$('[name="kabupaten"]').empty();
					$('[name="kecamatan"]').empty();
					// $('[name="kodepos"]').val('');
					$('<option />', {value: '', text: 'Pilih Kab/Kota'}).appendTo(kab);
					$('<option />', {value: '', text: 'Pilih Kecamatan'}).appendTo(kec);
					$.each(msg, function(i,val) {
						var nama_kab = val.city_name;
						if (val.type == 'Kota') {
							nama_kab = val.type + ' ' + val.city_name;
						}
						$('<option />', {value: val.city_id, text: nama_kab}).attr('data-kodepos', val.postal_code).appendTo(kab);
					})
				});
			});

			// 
			$('select[name="kabupaten"]').on('change', function() {
				// var kodepos = $(this).find(':selected').data('kodepos');
				$.ajax({
					method: "GET",
					// headers: {'X-Requested-With': 'XMLHttpRequest'},
					url: "<?= site_url('ongkir/kecamatan'); ?>",
					data: {kota: this.value}
				})
				.done(function( msg ) {
					// $('[name="kodepos"]').val(kodepos);
					
					$('[name="kecamatan"]').empty();
					$('<option />', {value: '', text: 'Pilih Kecamatan'}).appendTo(kec);
					$.each(msg, function(i,val) {
						$('<option />', {value: val.subdistrict_id, text: val.subdistrict_name}).appendTo(kec);
					})
				});
			});


		<?php } ?>

	});
	</script>
	<?php /*
	// source fontawesome: https://github.com/carlosproductions/Portfolio-Home-Page2
	// or can use https://kit.fontawesome.com/22a9d93fa2.js
	*/
	?>
	<script defer src="https://kit.fontawesome.com/9bdc906322.js" data-auto-replace-svg="nest" crossorigin="anonymous"></script>
	<!--
		Page rendered in {elapsed_time} seconds
		Environment: <?= ENVIRONMENT ?> 
		-->
</body>

</html>