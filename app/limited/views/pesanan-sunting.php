<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo $this->load->view("_inc/header", $judul, TRUE) ?>
<?php echo $this->load->view("_inc/".$include."/navbar", '', TRUE) ?>

    <div class="konten" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container-fluid">
                <h3><?php echo $judul; ?></h3>
                <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
            </div>
        </div>

        <?php echo $this->load->view("_inc/".$include."/form-sunting", $q, TRUE); ?>
    </div>
</div>

<script src="<?php echo base_url('berkas/js/gpicker.js'); ?>"></script>
<script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>

<script>
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

<?php echo $this->load->view("_inc/".$include."/js-global", '', TRUE); ?>
<?php echo $this->load->view("_inc/js-formpesanan", '', TRUE); ?>
<?php echo $this->load->view("_inc/footer", '', TRUE); ?>