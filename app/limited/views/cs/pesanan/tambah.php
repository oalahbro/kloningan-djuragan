<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$id_juragan = $this->juragan->_id($juragan);
$nama_juragan = $this->juragan->_nama($id_juragan);
?>
<div class="" id="">
	<div class="page-header">
		<h1><?php echo $judul; ?> <small><?php echo $nama_juragan; ?></small></h1>
	</div>

	<div class="container-fluid navigasi">
		<ul class="nav nav-tabs">
			<li role="presentation"><?php echo anchor($juragan . '/pesanan/all', 'Semua'); ?></li>
			<li role="presentation"><?php echo anchor($juragan . '/pesanan/pending', 'Pending'); ?></li>
			<li role="presentation"><?php echo anchor($juragan . '/pesanan/terkirim', 'Terkirim'); ?></li>
			<li role="presentation" class="active"><?php echo anchor(current_url(), 'Tambah'); ?></li>
		</ul>
	</div>

	<div class="utama">
		<div class="container-fluid">
			<div class="add-pesanan">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="well">
						<div class="panel panel-danger">
							<?php echo validation_errors(); ?>
							<?php 
							$attr = array(
								'class' => 'form-new',
								'id' => 'AddNew'
								);

							$hide = array(
								'image' => ''
								);

							echo form_open('', $attr, $hide);
							?>
							<div class="panel-body">  
								<?php 
								// form field nama
								$form_nama = array(
									'name' => 'nama',
									'id' => 'nama',
									'class' => 'form-control',
									'placeholder' => 'nama lengkap',
									'required' => 'required'
									);

								// form field hp
								$form_hp = array(
									'name' => 'hp[]',
									'id' => 'hp',
									'class' => 'form-control number_phone calc',
									'placeholder' => '08xxxxxxxxx',
									'required' => 'required',
									'pattern' => '^(0[2-9])[0-9]{8,}$'
									);

								// form field alamat
								$form_alamat = array(
									'name' => 'alamat',
									'id' => 'alamat',
									'class' => 'form-control',
									'placeholder' => 'alamat lengkap',
									'required' => 'required',
									'rows' => 5
									);

								// form field pesanan
								$form_kode = array(
									'name' => 'kode[]',
									'id' => 'kode',
									'class' => 'form-control kode typeahead',
									'placeholder' => 'kode',
									'required' => 'required',
									'autocomplete' => 'off'
									);

								$form_harga_a = array(
									'name' => 'harga_a[]',
									// 'id' => 'harga_a',
									'class' => 'form-control harga_a',
									'placeholder' => 'harga satuan',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);


								$arr = json_decode($this->config->item('list_size'));

								$uk = array();
								foreach ($arr as $key) {
									$uk[$key] = $key;
								}

								$options = array_merge(array('' => '-- pilih ukuran --'), $uk);

								$form_jumlah = array(
									'name' => 'jumlah[]',
									'id' => 'jumlah',
									'class' => 'form-control jumlah',
									'placeholder' => 'jumlah',
									'required' => 'required',
									'autocomplete' => 'off',
									'min' => 1,
									'type' => 'number',
									'pattern' => '^\d+$'
									);

								// form field bank
								$form_bank = array(
									'name' => 'bank',
									'id' => 'banks',
									'class' => 'form-control typeahead',
									'placeholder' => 'bank',
									'required' => 'required'
									);

								// form field harga barang
								$form_harga = array(
									'name' => 'harga',
									'id' => 'harga_total',
									'class' => 'form-control harga calc',
									'placeholder' => '280000',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);

								// form field tarif ongkir
								$form_ongkir = array(
									'name' => 'ongkir',
									'id' => 'ongkir',
									'class' => 'form-control ongkir calc',
									'placeholder' => '20000',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);

								// form field transfer
								$form_transfer = array(
									'name' => 'transfer',
									'id' => 'transfer',
									'class' => 'form-control transfer',
									'placeholder' => '300000',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);

								// form field keterangan
								$form_keterangan = array(
									'name' => 'keterangan',
									'id' => 'keterangan',
									'class' => 'form-control',
									'placeholder' => 'keterangan -opsional-',
									'rows' => 5
									);

								// form field diskon
								$form_diskon = array(
									'name' => 'diskon',
									'id' => 'diskon',
									'class' => 'form-control diskon calc',
									'placeholder' => '30000',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);

								// form field unik
								$form_unik = array(
									'name' => 'unik',
									'id' => 'unik',
									'class' => 'form-control unik calc',
									'placeholder' => '123',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);

								echo '<div class="form-group nama_field">';
									echo form_label('Nama', 'nama');
									echo '<div class="row">';
										echo '<div class="col-sm-4">';
											echo form_input($form_nama, set_value('nama'));
										echo '</div>';
									echo '</div>';
								echo '</div>'; // end .form-group.nama_field

								echo '<div class="form-group hp_fields">';
									echo form_label('HP', 'hp');
									echo '<div class="row">';
										echo '<div class="col-sm-3" id="cloneHP">';
											echo form_input($form_hp, set_value('hp[0]'));
										echo '</div>';

										$displayA = 'inline-block';
										$displayR = 'none';
										if(count(set_value('hp[]')) > 1) {
											echo '<div class="col-sm-3 isihp">';
												echo form_input($form_hp, set_value('hp[1]'));
											echo '</div>';
											$displayA = 'none';
											$displayR = 'inline-block';
										}

										echo '<div class="col-sm-3">';
											echo form_button(array('id' => 'btnAdd_2', 'style' => 'display: '. $displayA, 'class' => 'btn btn-success', 'content' => '<i class="glyphicon glyphicon-plus"></i>'));
											echo form_button(array('id' => 'btnDel_2', 'style' => 'display: '. $displayR, 'class' => 'btn btn-default', 'content' => '<i class="glyphicon glyphicon-remove"></i>'));
										echo '</div>';

									echo '</div>';
								echo '</div>'; // end .form-group.hp_fields

								echo '<div class="form-group alamat_field">';
									echo form_label('Alamat', 'alamat');
									echo '<div class="row">';
										echo '<div class="col-sm-8">';
											echo form_textarea($form_alamat,set_value('alamat'));
										echo '</div>';
									echo '</div>';
								echo '</div>'; // end .form-group.alamat_field

								
								echo '<div>';
									echo '<div class="form-group" id="ngok">';
										echo form_label('Kode / Harga / Ukuran / Jumlah', 'kode');
										echo '<div class="row clonedInput berijarakbawah kalkulasi" data-pesanan-index="0" id="entry1">';
										
											// kode
											echo '<div class="col-sm-3">';
												echo '<div class="input-group"><span class="input-group-addon">Kode</span>';
													echo form_input($form_kode, set_value('kode[0]'));
												echo '</div>';
											echo '</div>';

											// harga per pcs
											echo '<div class="col-sm-3">';
												echo '<div class="input-group"><span class="input-group-addon">Harga @</span>';
													echo form_input($form_harga_a, set_value('harga_a[0]', 0));
												echo '</div>';
											echo '</div>';

											// ukuran
											echo '<div class="col-sm-3">';
												echo '<div class="input-group"><span class="input-group-addon">Ukuran</span>';
													echo form_dropdown('size[]', $options, set_value('size[0]'), array('class' => 'form-control' ));
												echo '</div>';
											echo '</div>';

											// jumlah
											echo '<div class="col-sm-2">';
												echo '<div class="input-group"><span class="input-group-addon">Jumlah</span>';
													echo form_input($form_jumlah, set_value('jumlah[0]', 1));
												echo '</div>';
											echo '</div>';

											// button
											echo '<div class="col-xs-1">';
												echo form_button(array('class' => 'btn btn-success btnAdd', 'content' => '<i class="glyphicon glyphicon-plus"></i>'));
											echo '</div>';

										echo '</div>';

										// untuk input pesanan lebih dari satu
										for ($i=1; $i < count(set_value('kode[]')); $i++) { 
											echo '<div class="row berijarakbawah" data-pesanan-index="'.$i.'">';
											
												// kode
												echo '<div class="col-sm-3">';
													echo '<div class="input-group"><span class="input-group-addon">Kode</span>';
														echo form_input($form_kode, set_value('kode['.$i.']'));
													echo '</div>';
												echo '</div>';

												// harga per pcs
												echo '<div class="col-sm-3">';
													echo '<div class="input-group"><span class="input-group-addon">Harga @</span>';
														echo form_input($form_harga_a, set_value('harga_a['.$i.']'));
													echo '</div>';
												echo '</div>';

												// ukuran
												echo '<div class="col-sm-3">';
													echo '<div class="input-group"><span class="input-group-addon">Ukuran</span>';
														// echo form_input($form_size, set_value('size['.$i.']'));
														
														echo form_dropdown('size[]', $options, set_value('size['.$i.']'), array('class' => 'form-control' ));
													echo '</div>';
												echo '</div>';

												// jumlah
												echo '<div class="col-sm-2">';
													echo '<div class="input-group"><span class="input-group-addon">Jumlah</span>';
														echo form_input($form_jumlah, set_value('jumlah['.$i.']'));
													echo '</div>';
												echo '</div>';

												// button
												echo '<div class="col-sm-1">';
													echo form_button(array('class' => 'btn btn-default btnDel', 'content' => '<i class="glyphicon glyphicon-remove"></i>'));
												echo '</div>';

											echo '</div>';
										}
										echo '<div id="form_p_clone"></div>';
									echo '</div>';
								echo '</div>';

								echo '<div class="row" id="status_f">';
									echo '<div class="col-sm-3">';
										echo form_label('Status Pembayaran', 'sttb');

										// status pembayaran
										echo '<div class="form-group">';
											echo '<div class="form-check">';
												echo '<label class="form-check-label">';
													echo form_radio('status_transfer', 'lunas', NULL, set_radio('status_transfer', 'lunas', TRUE));
													
													echo '<span class="tag tag-success">Lunas</span>';
												echo '</label>';
											echo '</div>';

											echo '<div class="form-check">';
												echo '<label class="form-check-label">';
													echo form_radio('status_transfer', 'dp', NULL, set_radio('status_transfer', 'dp'));
													echo '<span class="tag tag-warning">DP</span> <em>--Down Payment--</em>';
												echo '</label>';
											echo '</div>';
										echo '</div>';
									echo '</div>';

									echo '<div class="col-sm-3">';
										echo '<div class="form-group" id="bank">';
											echo form_label('Bank', 'bank');
											echo form_input($form_bank, set_value('bank'));
										echo '</div>';
									echo '</div>';
								echo '</div>';

								echo '<div class="row">';
									echo '<div class="col-sm-4">';
										echo '<div class="form-group">';
											echo form_label('Total Harga Produk', 'harga');
											echo '<div class="input-group">';
												echo '<span class="input-group-addon" id="addonharga">Rp</span>';
												echo form_input($form_harga, set_value('harga', 0));
											echo '</div>';
										echo '</div>';

								
										echo '<div class="form-group ">';
											echo form_label('Ongkir', 'ongkir');
											echo '<div class="input-group">';
												echo '<span class="input-group-addon" id="addonongkir">Rp</span>';
												echo form_input($form_ongkir, set_value('ongkir', 0));
											echo '</div>';
										echo '</div>';

										echo '<div class="form-group ">';
											echo form_label('Transfer', 'transfer');
											echo '<div class="input-group">';
												echo '<span class="input-group-addon" id="addontransfer">Rp</span>';
												echo form_input($form_transfer, set_value('transfer', 0));
											echo '</div>';
										echo '</div>';
									echo '</div>';

									echo '<div class="col-sm-4">';
										echo '<div class="form-group">';
											echo form_label('Diskon', 'diskon');
											echo '<div class="input-group">';
												echo '<span class="input-group-addon" id="addondiskon">Rp</span>';
												echo form_input($form_diskon, set_value('diskon', 0));
											echo '</div>';
										echo '</div>';

										echo '<div class="form-group">';
											echo form_label('3 digit no unik', 'unik');
											echo '<div class="input-group">';
												echo '<span class="input-group-addon" id="addonunik">Rp</span>';
												echo form_input($form_unik, set_value('unik', 0));
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';

								echo '<div class="form-group ">';
									echo form_label('Keterangan', 'keterangan');
									echo '<div class="row">';
										echo '<div class="col-sm-8">';
											echo form_textarea($form_keterangan,set_value('keterangan'));
										echo '</div>';
									echo '</div>';
								echo '</div>';

								?>


								<!-- custom gambar -->
								<div class="form-group">
									<label for="customgambar">Custom Gambar</label>
									<div class="tombol-picker">
										<button type="button" class="btn btn-info" id="DOCS_IMAGES">Pilih / Unggah Gambar</button>
									</div>

									<div class="table-responsive">
										<table class="table table-hover">
											<tbody id="result"></tbody>
										</table>
									</div>
								</div>

							</div>
							<div class="panel-footer">
								<button type="submit" class="btn btn-primary"> Simpan </button>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>


<?php 
echo '<div class="row berijarakbawah hide" id="templatePesanan">';
	// kode
echo '<div class="col-sm-3">';
echo '<div class="input-group"><span class="input-group-addon">Kode</span>';
echo form_input($form_kode);
echo '</div>';
echo '</div>';

echo '<div class="col-sm-3">';
echo '<div class="input-group"><span class="input-group-addon">Harga @</span>';
echo form_input($form_harga_a, 0);
echo '</div>';
echo '</div>';

	// ukuran
echo '<div class="col-sm-3">';
echo '<div class="input-group"><span class="input-group-addon">Ukuran</span>';
echo form_dropdown('size[]', $options, '', array('class' => 'form-control' ));
echo '</div>';
echo '</div>';

	// jumlah
echo '<div class="col-sm-2">';
echo '<div class="input-group"><span class="input-group-addon">Jumlah</span>';
echo form_input($form_jumlah, 1);
echo '</div>';
echo '</div>';

	// remove button
echo '<div class="col-sm-1">';
echo form_button(array('class' => 'btn btn-default btnDel', 'content' => '<i class="glyphicon glyphicon-remove"></i>'));
echo '</div>';

echo '</div>';
?>

<script src="https://cdn.rawgit.com/t4t5/sweetalert/32bd141c/dist/sweetalert.min.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap3-typeahead.min.js'); ?>"></script>
<!-- The Google API Loader script. -->
<script src="<?php echo base_url('assets/js/mypicker.js'); ?>"></script>
<script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>

<script>
	$(document).ready(function(){
		$.getMultiScripts = function(arr, path) {
			var _arr = $.map(arr, function(scr) {
				return $.getScript( (path||"") + scr );
			});

			_arr.push($.Deferred(function( deferred ){
				$( deferred.resolve );
			}));

			return $.when.apply($, _arr);
		}

		var script_arr = [
		'<?php echo base_url('assets/js/bootstrap.min.js'); ?>', 
		'<?php echo base_url('assets/js/pace.min.js'); ?>'
		];

		$.getMultiScripts(script_arr).done(function() {
            // all scripts loaded
             $('.deropdowen').dropdown();
        });
	});
</script>

<script type="text/javascript">
   	
	$(document).ready(function() {


		// Use an Array method on list of dom elements
		var delay = (function(){
        	var timer = 0;
        	return function(callback, ms){
        		clearTimeout (timer);
        		timer = setTimeout(callback, ms);
        	};
        })();

        var transfer_field = $('.transfer'),
			diskon_field = $('.diskon'),
			ongkir_field = $('.ongkir'),
			unik_field = $('.unik'),
			harga_field = $('#harga_total')
			myEl = document.getElementById('DOCS_IMAGES'),
        	pesananIndex = $("#ngok .berijarakbawah").length,
        	$form = $('#AddNew');

        function dont_select(el) {
	        $(el).prop('disabled',true);
	    }

		function kalkulasi_total_transfer() {
			var set_transfer = 0;
			set_transfer += parseInt(harga_field.val());
			set_transfer += parseInt(unik_field.val());
			set_transfer += parseInt(ongkir_field.val());
			var diskonnya = parseInt(diskon_field.val());

			transfer_field.val(set_transfer - diskonnya );
		}

		function kalkulasi_jumlah_harga_produk() {
			var $kolom = $form.find('[data-pesanan-index]'),
			sum = 0;
        	$kolom.each(function () {
        		var th = $(this).data('pesanan-index');
        		var value = parseInt($('[data-pesanan-index="' + th + '"] .harga_a').val()) * parseInt($('[data-pesanan-index="' + th + '"] .jumlah').val());
        		if ( ! isNaN(value)) sum += value;
        	});

        	harga_field.val(sum);
		}

		function ambil_harga_produk(target, display) {
			var mycode = $(target).val();
			delay(function(){
           		$.getJSON( "<?php echo site_url('api/ambil_harga') ?>/" + mycode, function( json ) {
					$(display).val(json);
				});
        	}, 500 );
		}

	   	myEl.addEventListener('click', function() {
	   		var id = this.id;
	   		var viewId = google.picker.ViewId.DOCS_IMAGES;
	   		var setOAuthToken = true;

	   		if(authApiLoaded && !oauthToken) {
	   			viewIdForhandleAuthResult = viewId;
	   			window.gapi.auth.authorize({
	   				'client_id': clientId,
	   				'scope': scope,
	   				'immediate': false
	   			},handleAuthResult);
	   		} else {
	   			createPicker(viewId, setOAuthToken);
	   		}

	   	}, false);

	   	$('#hp').on("change keyup", function(e) {
			var insd = $(this).val();
			var str = insd.substr(insd.length - 3); // DXB
			
			$('input[name="unik"]').val(str);
		});

		$(document).on("change keyup click",function(){
			kalkulasi_jumlah_harga_produk();
			kalkulasi_total_transfer();
		});

	   	$.get("<?php echo site_url('api/list_kode'); ?>", function(data){
			$('[name="kode[]"]').typeahead({ source:data });
		},'json');

		$('[name="kode[]"]').on("change keyup",function(){
			ambil_harga_produk(this, '[data-pesanan-index="0"] [name="harga_a[]"]' );
		});
		dont_select('[data-pesanan-index="0"] select option[value=""]');
		dont_select('[name="juragan"] option[value=""]');

        $('.form-new').on('click', '.btnAdd', function() {
        	pesananIndex++;
        	var $template = $('#templatePesanan'),
        	$clone    = $template
        	.clone()
        	.removeClass('hide')
        	.addClass('kalkulasi')
        	.removeAttr('id')
        	.attr('data-pesanan-index', pesananIndex)
        	.insertBefore($('#form_p_clone'));
        	$clone.end();


            $.get("<?php echo site_url('api/list_kode'); ?>", function(data){
				$('[data-pesanan-index="'+ pesananIndex +'"] [name="kode[]"]').typeahead({ source:data });
			},'json');

			$('[data-pesanan-index="'+ pesananIndex +'"] [name="kode[]"]').on("change keyup",function(){
				ambil_harga_produk(this, '[data-pesanan-index="'+ pesananIndex +'"] [name="harga_a[]"]');
			});
			dont_select('[data-pesanan-index="'+ pesananIndex +'"] select option[value=""]');
        });

        $('.form-new').on('click', '.btnDel', function() {
        	var $row  = $(this).parents('.berijarakbawah');

        	swal({
        		title: "Hapus kolom?",
        		text: "Kolom pesanan akan dihapus dan proses ini tidak daat dibatalkan",
        		type: "warning",
        		animation: "slide-from-top",
        		showCancelButton: true,
        		confirmButtonColor: "#DD6B55",
        		confirmButtonText: "Yup, hapus!",
        		cancelButtonText: "Tidak",
        		closeOnConfirm: false,
        		closeOnCancel: true
        	},
        	function(isConfirm){
        		if (isConfirm) {

        			$row.slideUp("slow", function() { $(this).remove(); } );

        			swal({
        				title: "Dihapus!",
        				text: "Kolom pesanan sudah dihapus",
        				timer: 1100,
        				type: "success",
        				showConfirmButton: false
        			});
        		}
        	});
        });
        
        $('.form-new').on('click', '#btnAdd_2', function() {
        	var $template = $('#cloneHP'),
        	$clone    = $template
        	.clone()
        	.removeClass('hide')
        	.removeAttr('id')
        	.addClass('isihp')
        	.insertAfter($('#cloneHP'));
        	$clone.end();
        	$('.isihp input[name="hp[]"]').val("");
        	$('#btnAdd_2').prop('disabled', true).hide('slow');
        	$('#btnDel_2').prop('disabled', false).show('slow');

        });

        $('.form-new').on('click', '#btnDel_2', function() {
        	var $row  = $('.isihp');

        	swal({
        		title: "Hapus kolom?",
        		text: "Kolom HP 2 akan dihapus dan tidak dapat dibatalkan",
        		type: "warning",
        		animation: "slide-from-top",
        		showCancelButton: true,
        		confirmButtonColor: "#DD6B55",
        		confirmButtonText: "Yup, hapus!",
        		cancelButtonText: "Tidak",
        		closeOnConfirm: false,
        		closeOnCancel: true
        	},
        	function(isConfirm){
        		if (isConfirm) {

        			$row.toggle("slow", function() { $(this).remove(); } );
        			$('#btnAdd_2').prop('disabled', false).show('slow');
        			$('#btnDel_2').prop('disabled', true).hide('slow');

        			swal({
        				title: "Dihapus!",
        				text: "Kolom HP 2 sudah dihapus",
        				timer: 1000,
        				type: "success",
        				showConfirmButton: false
        			});
        		}
        	});
        });
    });
</script>