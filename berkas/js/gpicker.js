// The Browser API key obtained from the Google Developers Console.
<<<<<<< HEAD
var developerKey = 'AIzaSyCfnZmPoebdILCa491wJs5Tn6zL6MRu8X4';
        // The Client ID obtained from the Google Developers Console. Replace with your own Client ID.
        var clientId = "663338430944-fd7qipeq8u705hhhgfeq3haobj5bpig0.apps.googleusercontent.com";
=======
var developerKey = 'AIzaSyDOHnZiJhpvGPMIAJhKV_8cVLS5TiZcqgQ';
        // The Client ID obtained from the Google Developers Console. Replace with your own Client ID.
        var clientId = "1042338067390-39cqtc0f9dcqb073n4iu2gbbsivod8rg.apps.googleusercontent.com";
>>>>>>> eb68956f7286b5445022c62d4cf169ba8ee3e9f5
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

                    var link = '<tr><td><a href="' + url + '" target="_blank"> ' + name + '</a></td></tr>';

                    linked.push(link);
                    image.push(url);
                }
            }
            if(image.length > 0) {
                document.getElementById('result').innerHTML = linked.toString().replace(/,/g, "");
                document.getElementsByName('image')[0].value = JSON.stringify(image);
            }
        }