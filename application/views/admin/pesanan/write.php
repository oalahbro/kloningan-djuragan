<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="jumbotron jumbotron-fluid" style="margin-top: 100px">
	<div class="container">
		<h1 class="display-3">Tulis Pesanan Baru</h1>
		<p class="lead"><?php echo $lead; ?></p>
	</div>
</div>

<div class="add-pesanan">
	<div class="col-sm-8 offset-sm-1">
		<div class="well">
			<div class="panel panel-danger">
			<?php echo validation_errors(); ?>
				<?php 
				$attr = array(
					'class' => 'form-new',
					'data-toggle' => 'validator'
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

						echo '<div class="form-group ">';
							echo form_label('Nama', 'nama');
							echo '<div class="row">';
								echo '<div class="col-sm-4">';
									echo form_input($form_nama, set_value('nama'));
								echo '</div>';
							echo '</div>';
						echo '</div>';

						// form field hp
						$form_hp = array(
							'name' => 'hp[]',
							'id' => 'hp',
							'class' => 'form-control number_phone',
							'placeholder' => '08xxxxxxxxx',
							'required' => 'required',
							'pattern' => '^(0)[0-9]{9,11}$'
							);

						echo '<div class="form-group ">';
							echo form_label('HP', 'hp');
							echo '<div class="row">';
								echo '<div class="col-sm-3 clonedInput_2" id="phone1">';
									echo form_input($form_hp, set_value('hp[]'));
								echo '</div>';

								echo '<div class="col-sm-3">';
									echo form_button(array('id' => 'btnAdd_2', 'class' => 'btn btn-success', 'content' => '<i class="icon-plus"></i>'));
									echo form_button(array('id' => 'btnDel_2', 'class' => 'btn btn-default', 'content' => '<i class="icon-min"></i>', 'disabled' => 'disabled'));
								echo '</div>';

							echo '</div>';
						echo '</div>';


						// form field alamat
						$form_alamat = array(
							'name' => 'alamat',
							'id' => 'alamat',
							'class' => 'form-control',
							'placeholder' => 'alamat lengkap',
							'required' => 'required',
							'rows' => 5
							);
						
						echo '<div class="form-group ">';
							echo form_label('Alamat', 'alamat');
							echo '<div class="row">';
								echo '<div class="col-sm-8">';
									echo form_textarea($form_alamat,set_value('alamat'));
								echo '</div>';
							echo '</div>';
						echo '</div>';

						// form field pesanan
						$form_kode = array(
							'name' => 'kode[]',
							'id' => 'kode',
							'class' => 'form-control kode typeahead',
							'placeholder' => 'kode',
							'required' => 'required',
							'autocomplete' => 'off'
							);

						$form_size = array(
							'name' => 'size[]',
							'id' => 'size',
							'class' => 'form-control size',
							'placeholder' => 'size',
							'required' => 'required',
							'autocomplete' => 'off'
							);

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

						echo '<div>';
							echo '<div class="form-group" id="ngok">';
								echo form_label('Kode / Ukuran / Jumlah', 'kode');
								echo '<div class="row clonedInput berijarakbawah" id="entry1">';
									// kode
									echo '<div class="col-sm-4">';
										echo '<div class="input-group"><span class="input-group-addon">Kode</span>';
											echo form_input($form_kode, set_value('kode[]'));
										echo '</div>';
									echo '</div>';

									// ukuran
									echo '<div class="col-sm-4">';
										echo '<div class="input-group"><span class="input-group-addon">Ukuran</span>';
											echo form_input($form_size, set_value('size[]'));
										echo '</div>';
									echo '</div>';

									// jumlah
									echo '<div class="col-sm-3 col-xs-11">';
										echo '<div class="input-group"><span class="input-group-addon">Jumlah</span>';
											echo form_input($form_jumlah, set_value('jumlah[]'));
										echo '</div>';
									echo '</div>';

									//
									echo '<div class="col-xs-1">';
										echo form_button(array('class' => 'btn btn-success btnAdd', 'content' => '<i class="icon-plus"></i>'));
									echo '</div>';
								echo '</div>';
								echo '<div id="form_p_clone"></div>';
							echo '</div>';
						echo '</div>';


						echo '<div class="row" id="status_f">';
							echo '<div class="col-sm-3">';
								// status pembayaran
								echo '<div class="form-group ">';
									echo '<label for="orderStatus">Status Pembayaran</label>
									<div class="clearfix"></div>
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-info active">
										<input type="radio" name="options" id="option1" checked /> Lunas
										</label>
										<label class="btn btn-info">
											<input type="radio" name="options" id="option2" /> DP
										</label>
									</div>';
								echo '</div>';
							echo '</div>';
							echo '<div class="col-sm-3">';
								 // form field bank
								$form_bank = array(
									'name' => 'bank',
									'id' => 'banks',
									'class' => 'form-control typeahead',
									'placeholder' => 'bank',
									'required' => 'required'
									);

								echo '<div class="form-group" id="bank">';
									echo form_label('Bank', 'bank');
									echo form_input($form_bank, set_value('bank'));
								echo '</div>';

							 echo '</div>';

						echo '</div>';


						echo '<div class="row">';
							echo '<div class="col-sm-4">';
								// form field harga barang
								$form_harga = array(
									'name' => 'harga',
									'id' => 'harga',
									'class' => 'form-control harga calc',
									'placeholder' => '280000',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);

								echo '<div class="form-group ">';
									echo form_label('Harga', 'harga');
									echo '<div class="input-group">';
										echo '<span class="input-group-addon" id="addonharga">Rp</span>';
										echo form_input($form_harga, set_value('harga'));
									echo '</div>';
								echo '</div>';

									// form field tarif ongkir
								$form_ongkir = array(
									'name' => 'ongkir',
									'id' => 'ongkir',
									'class' => 'form-control ongkir calc',
									'placeholder' => '20000',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);

								echo '<div class="form-group ">';
									echo form_label('Ongkir', 'ongkir');
									echo '<div class="input-group">';
										echo '<span class="input-group-addon" id="addonongkir">Rp</span>';
										echo form_input($form_ongkir, set_value('ongkir'));
									echo '</div>';
								echo '</div>';


									// form field transfer
								$form_transfer = array(
									'name' => 'transfer',
									'id' => 'transfer',
									'class' => 'form-control transfer',
									'placeholder' => '20000',
									'required' => 'required',
									'pattern' => '^(?:[1-9]\d*|0)$'
									);

								echo '<div class="form-group ">';
									echo form_label('Transfer', 'transfer');
									echo '<div class="input-group">';
										echo '<span class="input-group-addon" id="addontransfer">Rp</span>';
										echo form_input($form_transfer, set_value('transfer'));
									echo '</div>';
								echo '</div>';

							echo '</div>';
							
						echo '</div>';


						// form field keterangan
						$form_keterangan = array(
							'name' => 'keterangan',
							'id' => 'keterangan',
							'class' => 'form-control',
							'placeholder' => 'keterangan -opsional-',
							'rows' => 5
							);
						
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

							<div id="result" class="list-group gambar-uploaded"></div>
						</div>

					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-primary"> Simpan </button>
						<?php echo form_input(array('type' => 'submit', 'name' => 'save_draft', 'class' => 'btn btn-warning'), 'Simpan sebagai draft'); ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php 
echo '<div class="row berijarakbawah hide" id="templatePesanan">';
	// kode
	echo '<div class="col-sm-4">';
		echo '<div class="input-group"><span class="input-group-addon">Kode</span>';
			echo form_input($form_kode, set_value('kode[]'));
		echo '</div>';
	echo '</div>';

	// ukuran
	echo '<div class="col-sm-4">';
		echo '<div class="input-group"><span class="input-group-addon">Ukuran</span>';
			echo form_input($form_size, set_value('size[]'));
		echo '</div>';
	echo '</div>';

	// jumlah
	echo '<div class="col-sm-3">';
		echo '<div class="input-group"><span class="input-group-addon">Jumlah</span>';
			echo form_input($form_jumlah, set_value('jumlah[]'));
		echo '</div>';
	echo '</div>';

	// remove button
	echo '<div class="col-sm-1">';
		echo form_button(array('class' => 'btn btn-default btnDel', 'content' => '<i class="icon-min"></i>'));
	echo '</div>';

echo '</div>';
?>

	<script type="text/javascript">

		$(document).ready(function(){
			$('.calc').bind("change keyup",function(){
				$('.transfer').val( parseInt($('.harga').val()) + parseInt($('.ongkir').val()));
			});
		});

	</script>

	<!-- The Google API Loader script. -->
	<script type="text/javascript">
		// The Browser API key obtained from the Google Developers Console.
		var developerKey = 'AIzaSyDGDXQLFm8vwM2CIxwzH_f50kaINMAQp54';
		// The Client ID obtained from the Google Developers Console. Replace with your own Client ID.
		var clientId = "663338430944-1cn3nqvc6ustvl0dl9sv6vcktga5lko3.apps.googleusercontent.com";
		// Scope to use to access user's photos.
		var scope = ['https://www.googleapis.com/auth/drive'];
		var authApiLoaded = false;
		var pickerApiLoaded = false;
		var oauthToken;
		var viewIdForhandleAuthResult;
		// Use the API Loader script to load google.picker and gapi.auth.
		function onApiLoad() {
			gapi.load('auth', {'callback': onAuthApiLoad});
			gapi.load('picker', {'callback': onPickerApiLoad});
		}
		function onAuthApiLoad() {
			authApiLoaded = true;
		}
		function onPickerApiLoad() {
			pickerApiLoaded = true;
		}
		function handleAuthResult(authResult) {
			if (authResult && !authResult.error) {
				oauthToken = authResult.access_token;
				createPicker(viewIdForhandleAuthResult, true);
			}
		}
		// Create and render a Picker object for picking user Photos.
		function createPicker(viewId, setOAuthToken) {
			if (authApiLoaded && pickerApiLoaded) {
				var picker;
				var folderid = '0BzMirFGUuWHedElDVmM0MHU1U1E';
				var upload = new google.picker.DocsUploadView();
				var dview = new google.picker.DocsView(google.picker.ViewId.DOCS_IMAGES);

				upload.setParent(folderid);
				dview.setParent(folderid);

				if(authApiLoaded && oauthToken && setOAuthToken) {
					picker = new google.picker.PickerBuilder().
					setOAuthToken(oauthToken).
					setDeveloperKey(developerKey).
					setCallback(pickerCallback).
					enableFeature(google.picker.Feature.MULTISELECT_ENABLED).
					enableFeature(google.picker.Feature.SIMPLE_UPLOAD_ENABLED).
					enableFeature(google.picker.Feature.MINE_ONLY).
					setSelectableMimeTypes('image/png,image/jpeg').
					hideTitleBar().
					setLocale('id').
					addView(upload).
					addView(dview).
					setSize(600,400).
					build();
				}
				else {
					picker = new google.picker.PickerBuilder().
					setDeveloperKey(developerKey).
					setCallback(pickerCallback).
					enableFeature(google.picker.Feature.MULTISELECT_ENABLED).
					enableFeature(google.picker.Feature.SIMPLE_UPLOAD_ENABLED).
					enableFeature(google.picker.Feature.MINE_ONLY).
					setSelectableMimeTypes('image/png,image/jpeg').
					hideTitleBar().
					setLocale('id').
					addView(upload).
					addView(dview).
					setSize(600,400).
					build();
				}

				picker.setVisible(true);
			}
		}
		// A simple callback implementation.
		function pickerCallback(data) {
			var linked = [];
			var image = [];

			if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
				for (var i = 0; i < data[google.picker.Response.DOCUMENTS].length; i++) {
					var doc = data[google.picker.Response.DOCUMENTS][i];
					var url = doc[google.picker.Document.URL];
					var icon = doc[google.picker.Document.ICON_URL];
					var name = doc[google.picker.Document.NAME];

					var link = '<a href="'+url+'" target="_blank" class="list-group-item list-group-item-action list-group-item-success"><img src="'+icon+'" alt="icon"/> '+name+'</a>';

					linked.push(link);
					image.push(url);

				}
			}
			document.getElementById('result').innerHTML = linked.toString().replace(/,/g, "");
			document.getElementsByName('image')[0].value = image.toString(); // populated form
		}

	</script>

	<script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>

	<script type="text/javascript">
		var myEl = document.getElementById('DOCS_IMAGES');

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
		

		////// TYPEAHEAD

		var databank = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.whitespace,
			queryTokenizer: Bloodhound.tokenizers.whitespace,

			prefetch: '<?php echo site_url('json/bank'); ?>',
			remote: {
				url: '<?php echo site_url('json/bank'); ?>?juragan=<?php echo $juragan; ?>&q=%cari',
				wildcard: '%cari'
			}
		});

		var dataproduk = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.whitespace,
			queryTokenizer: Bloodhound.tokenizers.whitespace,

			prefetch: '<?php echo site_url('json/produk'); ?>',
			remote: {
				url: '<?php echo site_url('json/produk'); ?>?q=%cari',
				wildcard: '%cari'
			}
		});

		$('#bank .typeahead').typeahead({
			classNames: {
				input: 'Typeahead-input',
				hint: 'Typeahead-hint',
				selectable: 'tt-select',
				menu: 'dropdown-menu',
				suggestion: 'dropdown-item'
			},
			hint: true,
			highlight: true,
			minLength: 1,
		}, {
			name: 'bank',
			display: 'bank',
			source: databank,
			limit: 7,
			templates: {
				suggestion: function (data) {
					return '<div>' + data.bank + '</div>';
				}
			}
		});

		function createTypeahead($el, $name) {
			$($el).typeahead({
				classNames: {
					input: 'Typeahead-input',
					hint: 'Typeahead-hint',
					selectable: 'tt-select',
					menu: 'dropdown-menu',
					suggestion: 'dropdown-item'
				},
				hint: false,
				highlight: true,
				minLength: 1
			}, {
				name: $name,
				display: 'kode',
				source: dataproduk,
				limit: 8,
				templates: {
					suggestion: function (data) {
						return '<div>' + data.kode + '<small class="float-xs-right"><em>Rp ' + data.harga.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '</em></small></div>';
					}
				}
			});
		}


		/** CLONING */
		$(document).ready(function() {
			createTypeahead('[name="kode[]"]', 'kode1');

			var pesananIndex = 0;
			$('.form-new').on('click', '.btnAdd', function() {
				pesananIndex++;
				var $template = $('#templatePesanan'),
					$clone    = $template
										.clone()
										.removeClass('hide')
										.removeAttr('id')
										.attr('data-pesanan-index', pesananIndex)
										.insertBefore($('#form_p_clone'));
				$clone.end();

				createTypeahead('[data-pesanan-index="'+ pesananIndex +'"] [name="kode[]"]', 'kode'+ pesananIndex);

			});

			$('.form-new').on('click', '.btnDel', function() {
				var $row  = $(this).parents('.berijarakbawah');

				swal({
					title: "Kamu yakin akan menghapus?",
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

						$row.slideUp("slow", function() { $(this).remove(); } );

						swal({
							title: "Dihapus!",
							text: "Kolom HP 2 sudah dihapus",
							timer: 1100,
							type: "success",
							showConfirmButton: false
						});
					}
				});
				
			});
		});

	</script>
