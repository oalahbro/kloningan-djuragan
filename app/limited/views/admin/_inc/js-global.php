<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
$(function () {
    var mess = '<div id="message" class="position-fixed mr-3" style="z-index: 1060;max-width: 500px; top: 70px; right: 0"></div>';
    var count = $("#count");

    $('body').append(mess);

    function loadCount() {
        $.getJSON( "<?php echo site_url('session'); ?>", function( response ) {
            if(response.log) {
                $.getJSON( "<?php echo site_url('admin/notifikasi/count'); ?>", function( num ) {
                    count.html(num);
                    if(num > 0) {
                        $(document).attr("title", '('+ num + ') ' + $('.konten h3').text());
                    }
                    else {
                        $(document).attr("title", $('.konten h3').text());
                    }
                });
            }
            else {
                window.location.href = "<?php echo site_url(); ?>";
            }
        });
    }

    // Load on page load (call the function loadCount):
    loadCount()

    // Set the refresh interval and call the function loadCount every 60 seconds):
    var refreshId = setInterval(loadCount, 15000);
    $.ajaxSetup({ cache: false });

    $('#notif').on('show.bs.dropdown', function () {
        $('#notifKonten').empty().html('<div class="text-center my-3"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>');

        $.getJSON("<?php echo site_url('admin/notifikasi/get'); ?>", {'count': 5, 'all': 'tidak'}).done(function( response ) {
            $('#notifKonten').empty().html('<a class="mx-3 mb-2 d-block small" href="<?php echo site_url("admin/notifikasi"); ?>">Lihat Semua Notifikasi ('+response.total+')</a>');
            $.each(response.data, function(index, element) {
                $('#notifKonten').append(
                    $('<div>', {class: 'list-group list-group-flush', html: element.data})
                );
            });
        });
    });

    $('#sidebar').on('show.bs.collapse', function () {
        $("<div>").attr({'class': "overlay active",'data-toggle': "collapse",'data-target': "#sidebar"}).appendTo("body");
        $('#listJuragan').empty().append('<div class="text-center my-3"><div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>');
        $.getJSON("<?php echo site_url('faktur/get_juragan'); ?>").done(function( response ) {
            $('#listJuragan').empty().html('<h6 class="dropdown-header">Pilih Juragan</h6>');
            $('#listJuragan').append(
                $('<ul>', {class: 'list-unstyled', id: 'listLi'})
            );
            $('#listLi').append(
                $('<li>', {html: '<a href="<?php echo site_url("pesanan/s_juragan") ?>"><i class="fas fa-users"></i> Semua Juragan</a>'})
            );
            $.each(response.data, function(index, element) {
                $('#listLi').append(
                    $('<li>', {html: '<a href="<?php echo site_url("pesanan/") ?>'+element.slug+'"><i class="fas fa-user-circle"></i> '+element.nama+'</a>'})
                );
            });
        });

        $('body').toggleClass('modal-open');
    });

    $('#sidebar').on('hidden.bs.collapse', function () {
        $('.overlay').remove();
        $('body').toggleClass('modal-open');

    });
});

// create random string
// https://stackoverflow.com/a/1349426/2094645
function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}
// create dynamic modal 
function doModal(h, c) {
    var a = '<div class="modal fade" id="dynamicModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="dynamicModalTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header">' + ('<h5 class="modal-title" id="dynamicModalTitle">' + h + "</h5>") + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    a += '<div class="modal-body">';
    a += c;
    a += "</div>";
    a += "</div>";
    a += "</div>";
    a += "</div>";
    $("body").append(a);
    $("#dynamicModal").modal();
    $("#dynamicModal").modal("show");
    $("#dynamicModal").on("hidden.bs.modal", function(a) {
        $(this).remove();
    });
}

// create Toast
function createToast(title, content) {
    var notif = '';
    var tm = makeid();

    notif += '<div class="toast" id="toast-'+tm+'" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">';
        notif += '<div class="toast-header">';
            notif += '<strong class="mr-auto text-capitalize">'+title+'</strong>';
            notif += '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
            notif += '<span aria-hidden="true">&times;</span>';
            notif += '</button>';
        notif += '</div>';
        notif += '<div class="toast-body">';
            notif += content;
        notif += '</div>';
    notif += '</div>';

    $('#message').append(notif);
    $('#toast-'+tm).toast('show');
    $('#toast-'+tm).on('hidden.bs.toast', function () {
        $(this).remove();
    });
}


</script>