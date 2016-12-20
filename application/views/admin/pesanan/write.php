<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="jumbotron jumbotron-fluid" style="margin-top: 100px">
	<div class="container">
		<h1 class="display-3">Tulis Pesanan Baru</h1>
		<p class="lead"><?php echo $lead; ?></p>
	</div>
</div>

<div>
    <div class="col-sm-8 offset-sm-1">
        <div class="well">
            <div class="panel panel-danger">
            	<?php 
            	$attr = array(
            		'class' => 'form-new'
            		);

            	$hide = array(
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
                    		'required' => 'required'
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
                    		'class' => 'form-control kode',
                    		'placeholder' => 'kode',
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
                    		'type' => 'number'
                    		);

                    	echo '<div class="form-group ">';
                        	echo form_label('Kode / Ukuran / Jumlah', 'kode');
                        	echo '<div class="row clonedInput" id="entry1">';
                        		// kode
                        		echo '<div class="col-sm-4">';
                        			echo '<div class="input-group"><span class="input-group-addon">Kode</span>';
                        				echo form_input($form_kode, set_value('kode[]'));
                        			echo '</div>';
                                echo '</div>';

                                // ukuran
                                echo '<div class="col-sm-4">';
                        			echo '<div class="input-group"><span class="input-group-addon">Ukuran</span>';
                        				echo form_input($form_kode, set_value('ukuran[]'));
                        			echo '</div>';
                                echo '</div>';

                                // jumlah
                                echo '<div class="col-sm-4">';
                        			echo '<div class="input-group"><span class="input-group-addon">Jumlah</span>';
                        				echo form_input($form_jumlah, set_value('jumlah[]'));
                        			echo '</div>';
                                echo '</div>';

                            echo '</div>';

                            echo form_button(array('id' => 'btnAdd', 'class' => 'btn btn-success', 'content' => '<i class="icon-plus"></i>'));
                            echo form_button(array('id' => 'btnDel', 'class' => 'btn btn-default', 'content' => '<i class="icon-min"></i>', 'disabled' => 'disabled'));
                        echo '</div>';


                        // status pembayaran
                        echo '<label for="orderStatus">Status Pembayaran</label>
                    	<div class="clearfix"></div>
                    	<div class="btn-group" data-toggle="buttons">
                    		<label class="btn btn-info active">
                    		<input type="radio" name="options" id="option1" autocomplete="off" checked /> Lunas
                    		</label>
                    		<label class="btn btn-info">
                    			<input type="radio" name="options" id="option2" autocomplete="off" /> DP
                    		</label>
                    	</div>';

                    	echo '<div class="row">';
                    		echo '<div class="col-sm-4">';
		                        // form field harga barang
	                    		$form_harga = array(
	                    			'name' => 'harga',
	                    			'id' => 'harga',
	                    			'class' => 'form-control harga calc',
	                    			'placeholder' => '280000',
	                    			'required' => 'required',
	                    			'type' => 'number',
	                    			'min' => 0
	                    			);

	                    		echo '<div class="form-group ">';
	                    			echo form_label('Harga', 'harga');
	                    			echo '<div class="input-group">';
	                    				echo '<span class="input-group-addon" id="basic-addon1">Rp</span>';
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
	                    			'type' => 'number',
	                    			'min' => 0
	                    			);

	                    		echo '<div class="form-group ">';
		                    		echo form_label('Ongkir', 'ongkir');
		                    		echo '<div class="input-group">';
		                    			echo '<span class="input-group-addon" id="basic-addon1">Rp</span>';
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
	                    			'type' => 'number',
	                    			'min' => 0
	                    			);

	                    		echo '<div class="form-group ">';
	                    			echo form_label('Transfer', 'transfer');
	                    			echo '<div class="input-group">';
	                    				echo '<span class="input-group-addon" id="basic-addon1">Rp</span>';
	                    				echo form_input($form_transfer, set_value('transfer'));
	                    			echo '</div>';
	                    		echo '</div>';

                    		echo '</div>';
                    		echo '<div class="col-sm-3">';
		                     	 // form field bank
	                    		$form_bank = array(
	                    			'name' => 'bank',
	                    			'id' => 'bank',
	                    			'class' => 'form-control',
	                    			'placeholder' => 'bank',
	                    			'required' => 'required'
	                    			);

                    			echo '<div class="form-group ">';
                    				echo form_label('Bank', 'bank');
                    				echo form_input($form_bank, set_value('bank'));
                    			echo '</div>';

		                     echo '</div>';
                        echo '</div>';


                        // form field keterangan
                    	$form_keterangan = array(
                    		'name' => 'keterangan',
                    		'id' => 'keterangan',
                    		'class' => 'form-control',
                    		'placeholder' => 'keterangan -opsional-',
                    		'required' => 'required',
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
                    		<label for="custom gambar">Custom Gambar</label>
                    		<div class="tombol-picker">
                    			<button type="button" class="btn btn-info" id="DOCS_IMAGES">Pilih / Unggah Gambar</button>
                    		</div>

                    		<div class="row">
                    			<div class="col-sm-6">
                    				<pre id="result">Tidak ada gambar</pre>
                    			</div>
                    		</div>
                    	</div>



                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary"> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/clone-form.js'); ?>"></script>
<script type="text/javascript">

	$(document).ready(function(){
		$('.calc').on('keyup', function(){
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
	    	var arr = [];
	    	if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
	    		for (var i = 0; i < data[google.picker.Response.DOCUMENTS].length; i++) {
	    			var doc = data[google.picker.Response.DOCUMENTS][i],
	    				FILEID = doc[google.picker.Document.URL];
	    			arr.push(
	    				FILEID
	    				);

	    		}
	    		var js1 = arr.toString().replace(/,/g, "<br/>");
	    		var js2 = arr.toString();
	    	}
	    	// var message = 'Gambar Terpilih: <br>' + arrs;
	    	document.getElementById('result').innerHTML = js1;
	    	document.getElementsByName('image')[0].value = js2; // populated form
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
	</script>