<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    // form tambah pesanan
    $(document).on("keyup change", "#hp1",function(){
        var isi = $(this).val();
        var str = isi.substr(isi.length - 3); // DXB
        if ( ! isNaN(str)) {
            str = str;
        } 
        else {
            str = 0;
        }
        $('input[name="unik"]').val(str);
    });

    $(document).on("keyup change", '[name="marketplace_"]',function(){
        if(this.checked) {
            //Do stuff
            $('[name="marketplace"]').prop('disabled', false);
            // $('.bankir').prop('disabled', true);
        }
        else {
            $('[name="marketplace"]').prop('disabled', true);
            // $('.bankir').prop('disabled', false);
        }
    });

    $(document).on("keyup change", '[name="status_paket"]',function(){
        if($(this).val() === '1') {
            $('[name="pengiriman_"]').prop('disabled', false);
            //$('.carry').prop('disabled', false);
        }
        else {
            $('[name="pengiriman_"]').prop('disabled', true);
            $('#dataPengiriman').collapse('hide');
            $('[name="pengiriman_"]').prop('checked', false);
            $('.carry').prop('disabled', true);
        }
    });

    $(document).on("keyup change", '[name="pembayaran_"]',function(){
        if(this.checked) {
            //Do stuff
            $('.bankir').prop('disabled', true);
            $('#dataPembayaran').collapse('hide');
        }
        else {
            $('.bankir').prop('disabled', false);
            $('#dataPembayaran').collapse('show');
        }
    });

    $(document).on("keyup change", '.sudah_cek',function(){
        var $t = $(this).attr('id');
        if(this.checked) {
            //Do stuff
            $('.'+$t).prop('disabled', false);
        }
        else {
            $('.'+$t).prop('disabled', true);
        }
    });

    $(document).on("keyup change", '[name="pengiriman_"]',function(){
        $('#dataPengiriman').collapse('toggle');
        if(this.checked) {
            //Do stuff
            $('.carry').prop('disabled', false);
            $('#pengiriman_selesai').prop('disabled', false);
        }
        else {
            $('.carry').prop('disabled', true);
            $('#pengiriman_selesai').prop('disabled', true);
        }
    });

// cloning form produk
var pesananIndex = $("#ngok .cloning-me").length;
    $(document).on("click", ".btnAdd", function(e){
        e.preventDefault();
        pesananIndex++;
        var clone = $('#dup').clone('#main-form');

        clone.attr('data-prod', pesananIndex);
        clone.find(".kode").attr({name: 'produk['+pesananIndex+'][kode]', id: 'kode-'+pesananIndex}).val('');
        clone.find(".harga").attr({name: 'produk['+pesananIndex+'][harga]', id: 'harga-'+pesananIndex}).val('0');
        clone.find(".ukuran").attr({name: 'produk['+pesananIndex+'][ukuran]', id: 'ukuran-'+pesananIndex}).val('');
        clone.find(".jumlah").attr({name: 'produk['+pesananIndex+'][jumlah]', id: 'jumlah-'+pesananIndex}).val('1');
        
        $('#ngok').append(clone);
        $('[data-prod="'+pesananIndex+'"] .btnAdd').replaceWith( '<button type="button" class="btn btn-outline-danger btnDel"><i class="fas fa-minus"></i></button>' );            
    });

    // cloning form pembayaran
    var ti = $("#multiBayar .listPembayaran").length;
    $(document).on("click", ".btnAddTransfer", function(e){
        e.preventDefault();
        ti++;
        var clone = $('#pembayaranViaTransfer').clone('#formTransfer');

        clone.attr('data-transfer', ti);
        clone.find("#id_pembayaran").remove();
        clone.find("#rekening").attr({name: 'pembayaran['+ti+'][rekening]', id: 'rekening-'+ti}).val('');
        clone.find("#tanggal_transfer").attr({name: 'pembayaran['+ti+'][tanggal]', id: 'tanggal_transfer-'+ti}).val("<?php echo mdate('%Y-%m-%d', now()); ?>");
        clone.find("#jumlah_transfer").attr({name: 'pembayaran['+ti+'][jumlah]', id: 'jumlah_transfer-'+ti}).val('0');
        clone.find("#tanggal_cek").attr({name: 'pembayaran['+ti+'][cek]', class: 'form-control tanggal_cek bankir sudah_cek-'+ti, id: 'tanggal_cek-'+ti}).prop('disabled', true).val("<?php echo mdate('%Y-%m-%d', now()); ?>");
        clone.find(".form-check-input").attr({name: 'pembayaran['+ti+'][sudah_cek]', id: 'sudah_cek-'+ti}).attr('checked', false);
        clone.find(".form-check-label").attr({for: 'sudah_cek-'+ti});

        $('#multiBayar').append(clone);

        $('[data-transfer="'+ti+'"] .btnAddTransfer').replaceWith( '<button type="button" class="btn btn-outline-danger bankir btnDelTransfer"><i class="fas fa-minus"></i></button>' );
    });

    // cloning form pengiriman
    var ki = $("#multiKirim .listPengiriman").length;
    $(document).on("click", ".btnAddKirim", function(e){
        e.preventDefault();
        ki++;
        var clone = $('#pengiriman').clone('#formkirim');

        clone.attr('data-kirim', ki);
        clone.find("#id_pengiriman").remove();
        clone.find("#kurir").attr({name: 'pengiriman['+ki+'][kurir]', id: 'kurir-'+ki}).val('');
        clone.find("#resi").attr({name: 'pengiriman['+ki+'][resi]', id: 'resi-'+ki}).val('');
        clone.find("#ongkir_fix").attr({name: 'pengiriman['+ki+'][ongkir]', id: 'ongkir_fix-'+ki}).val('0');
        clone.find("#tanggal_kirim").attr({name: 'pengiriman['+ki+'][tanggal_kirim]', id: 'tanggal_kirim-'+ki}).val("<?php echo mdate('%Y-%m-%d', now()); ?>");

        $('#multiKirim').append(clone);

        $('[data-kirim="'+ki+'"] .btnAddKirim').replaceWith( '<button type="button" class="btn btn-outline-danger bankir btnDelKirim"><i class="fas fa-minus"></i></button>' );
    });

    // hapus cloning form pengiriman
    $(document).on("click", ".btnDelKirim", function(e){
        var $row  = $(this).parents('#pengiriman');
        $row.slideUp("slow", function() { $(this).remove(); } );
    });

    // hapus cloning form produk
    $(document).on("click", ".btnDel", function(e){
        var $row  = $(this).parents('#dup');
        $row.slideUp("slow", function() { $(this).remove(); } );
    });

    // hapus cloning form pembayaran
    $(document).on("click", ".btnDelTransfer", function(e){
        var $row  = $(this).parents('#pembayaranViaTransfer');
        $row.slideUp("slow", function() { $(this).remove(); } );
    });

    // kalkulasi form
    $(document).on("change", ".calc", function(e){
        var $form = $('#konten');
        var $row = $form.find('[data-prod]'),
            $diskon = parseInt($('.diskon').val(), 10),
            $ongkir = parseInt($('.ongkir').val(), 10),
            $unik = parseInt($('.unik').val(), 10),
            $total = 0,
            $finaltotal = 0;

        $row.each(function () {
            var i = $(this).attr("data-prod");
            console.log(i);

            var h = parseInt($('[name="produk['+i+'][harga]"]').val(), 10);
            var q = parseInt($('[name="produk['+i+'][jumlah]"]').val(), 10);
            var t = h * q;
            if ( ! isNaN(t)) $total += t;
        });

        $finaltotal += $total;
        $finaltotal += $ongkir;
        $finaltotal += $unik;
        $finaltotal -= $diskon;

        $('.wajib_dibayar').text('Rp '+ format($finaltotal));
        $('.angka_unik').text('Rp '+ format($unik));
        $('.tarif_ongkir').text('Rp '+ format($ongkir));
        $('.total_diskon').text('Rp '+ format($diskon));
        $('.total_harga_produk').text('Rp '+ format($total));
    });

    function format(n, sep, decimals) {
        sep = sep || "."; // Default to period as decimal separator
        //decimals = decimals || 2; // Default to 2 decimals

        return n.toLocaleString().split(sep)[0] + ',-'
            // + sep
            //+ n.toFixed(decimals).split(sep)[1];
    }
</script>