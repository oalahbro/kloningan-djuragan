<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-typeahead.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/clone-form.js'); ?>"></script>

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

    		// var arrs = arr.toString().replace(/,/g, "<br/>");
    		var js = JSON.stringify(arr);
    	}
    	// var message = 'Gambar Terpilih: <br>' + arrs;
    	document.getElementById('result').innerHTML = js;
    	document.getElementsByName('image')[0].value = js; // populated form
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

	<script type="text/javascript">
		(function ($) {
			$('.subnav').affix({
				offset: {
					top: $('.page-header').height()
				}
			});	

			setInterval(function() {
		        $(".bootstrap-flash").fadeOut("slow", function() {
	                $( 'div' ).remove('.bootstrap-flash');
	            })
		    }, 5000);

            $('option[value="0"]').attr('disabled','disabled');

		})(jQuery);
	</script>
	
</body>
</html>