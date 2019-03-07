<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div> 
<!-- /.wrapper -->
<div class="overlay" data-toggle="collapse" data-target="#sidebar"></div>

    <script src="<?php echo base_url('berkas/js/gpicker.js'); ?>"></script>
    <script src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>
    <script>
    
    $(function () {
        // init notif div's
        var mess = '<div id="message" class="position-fixed mr-3" style="max-width: 500px; top: 70px; right: 0"></div>';
        $('body').append(mess);

        // cek pembayaran
        $(document).on("click", ".cek_pembayaran", function(e){
            e.preventDefault();

            var $div = $(this).closest( ".mn" );

            var konten = '';
            var action = '<?php echo site_url("post/pembayaran"); ?>';
            var id = $div.attr('data-id');
            var faktur = $div.attr('data-faktur');

            $.ajax({
                type:"GET",
                url: "<?php echo site_url('get/pembayaran'); ?>",
                data: {id: id},
                dataType: 'json',
                success: (function( data ) {

                    if (data.length === 0) {
                        konten += '<p class="alert alert-danger">Tidak ditemukan data pembayaran</p>';
                    }
                    else {
                        konten += '<input name="faktur" type="hidden" value="'+id+'"/>';
                        
                        konten += '<ul id="list_pembayaran">';
                        for (i = 0; i < data.length; i++) {
                            const pay = data[i];
                            konten += '<input name="pembayaran['+pay.id+']" type="hidden" value="tidak"/>';

                            konten += '<li>';
                                konten += '<span class="font-weight-bold">' + pay.rekening + '</span> <span class="text-muted">|</span> <a data-id="'+pay.id+'" data-faktur="'+id+'" href="#!" class="text-danger hapusPembayaran small"><i class="fas fa-trash-alt"></i></a>';
                                konten += '<ul>';
                                    konten += '<li>Tanggal bayar/transfer: ' + pay.tanggal_bayar + '</li>';
                                    konten += '<li>Jumlah: ' + pay.jumlah + '</li>';
                                konten += '</ul>';
                                konten += '<div class="custom-control custom-checkbox" id="chk'+i+'">';
                                    konten += '<input type="checkbox" name="pembayaran['+pay.id+']" data-id="'+pay.id+'" value="ya" class="custom-control-input sbm" id="check'+i+'" '+(pay.tanggal_cek === null ? '/>' : ' checked=""/>');

                                    if(pay.tanggal_cek === null) {
                                        var dicek = '';
                                    }
                                    else {
                                        var dicek = '<div class="small text-muted">dicek pada: '+pay.tanggal_cek+'</div>';
                                    }
                                    
                                    konten += '<label for="check'+i+'" class="custom-control-label">Dana ada/sudah masuk?</label>';
                                    konten += dicek;
                                konten += '</div>';
                            konten += '</li>';
                        }
                        konten += '</ul>';
                        
                    }
                    // load modal
                    doModal('Cek Pembayaran '+ faktur, action, konten, 'cekByr', false);
                })
            })
        });

        $(document).on("keyup change", '.cekByr .sbm',function(){
            var id_pembayaran = $(this).attr('data-id'),
                id_faktur = $('.cekByr [name="faktur"]').val(),
                checking = '';

            if(this.checked) {
                checking = 'ya';
            }
            else {
                checking = 'tidak';
            }
            
            $("#dynamicModal").modal('hide');
            $('#main-table tr#pesanan-' + id_faktur + ' .status' ).empty().append('<div class="text-center"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>');

            $.post("<?php echo site_url('post/pembayaran'); ?>", {
                id_faktur: id_faktur,
                id_pembayaran: id_pembayaran,
                check: checking
            },
            function(response, status){
                $.get('<?php echo site_url("pesanan"); ?>?cari[q]='+ response.seri_faktur, function(data) {
                    var oContent = $(data).find('#pesanan-' + id_faktur);

                    // $('#main-table tr#pesanan-' + id_faktur).replaceWith(oContent);
                    load_pembayaran('#pesanan-'+ id_faktur +' .pesanan','#pesanan-'+ id_faktur +' .status', '#pesanan-'+ id_faktur +' .pembayaran', id_faktur, function() {});
                    $('#main-table tr#pesanan-' + id_faktur).delay(100).fadeOut().fadeIn('slow');
                });

                
                createToast(response.title, response.alert);
            });
            
        });

        $(document).on("click", ".hapusPembayaran", function(e){
            var id = $(this).attr('data-id');
            var faktur = $(this).attr('data-faktur');
            var $delel = $(this).closest( "li" );

            $('#main-table tr#pesanan-' + faktur ).empty().append('<td colspan="7" class="text-center"><div class="spinner-border spinner-border-lg" role="status"><span class="sr-only">Loading...</span></div></td>');

            $.post("<?php echo site_url('del/pembayaran'); ?>", {
                idfaktur: faktur,
                idpembayaran: id,
            },
            function(response, status){
                $.get('<?php echo site_url("pesanan"); ?>?cari[q]='+ response.seri_faktur, function(data) {
                    var oContent = $(data).find('#pesanan-' + faktur);

                    $('#main-table tr#pesanan-' + faktur).replaceWith(oContent);
                    $('#main-table tr#pesanan-' + faktur).delay(100).fadeOut().fadeIn('slow');
                });

                $delel.remove();
                $("#dynamicModal").modal('hide');
                createToast(response.title, response.alert);
            });
        });

        // tambah pembayaran
        $(document).on("click", ".tambah_pembayaran", function(e){
            e.preventDefault();
            var konten = '';
            var $div = $(e.target).closest( ".mn" );
            var action = '<?php echo site_url("add/pembayaran"); ?>';
            var id = $div.attr('data-id');
            var faktur = $div.attr('data-faktur');
            var kekurangan = $div.attr('data-kurang');

            konten += '<input name="faktur_id" type="hidden" value="'+id+'"/>';

            konten += '<div class="form-group">';
                konten += '<label for="rekening">Tujuan Transfer</label>';
                konten += '<input type="text" name="rekening" value="" required="" id="rekening" class="form-control" placeholder="misal: BNI, BRI, BCA, Tokopedia ...." />';
            konten += '</div>';

            konten += '<div class="form-row">';
                konten += '<div class="col-sm-6">';
                    konten += '<div class="form-group">';
                        konten += '<label for="jumlah">Jumlah</label>';
                        konten += '<input type="number" min="0" name="jumlah" required="" value="'+kekurangan+'" id="jumlah" class="form-control" placeholder="misal: 200000" step="any" />';
                    konten += '</div>';
                konten += '</div>';
                konten += '<div class="col-sm-6">';
                    konten += '<div class="form-group">';
                        konten += '<label for="tanggal_bayar">Tanggal</label>';
                        konten += '<input type="date" name="tanggal_bayar" required="" value="<?php echo mdate("%Y-%m-%d", now()); ?>" id="tanggal_bayar" class="form-control" placeholder="" />';
                    konten += '</div>';
                konten += '</div>';
            konten += '</div>';

            doModal('Tambah Pembayaran '+ faktur, action, konten, 'addByr');
        });

        $(document).on("keyup change", '.addByr [name="jumlah"]',function(){
            if ($(this).val() > 0) {
                $(this)[0].setCustomValidity('');
                // alert('hhhh');
                return true;
            }
            else {
                $(this)[0].setCustomValidity('The number must not be zero');
                // alert('iii');
                return false;
            }
        });

        $(document).on('submit','.addByr form',function(e){
            e.preventDefault();
            e.stopPropagation();

            var $form = $(this); //wrap this in jQuery
            var faktur_id = $('.addByr [name="faktur_id"]').val();
            // alert('the action is: ' + $form.attr('action'));
            
            var datastring = $form.serialize();

            $("#dynamicModal").modal('hide');
            $('#main-table tr#pesanan-' + faktur_id ).empty().append('<div class="text-center"><div class="spinner-border spinner-border-lg" role="status"><span class="sr-only">Loading...</span></div></div>');

            $.ajax({
                type: "POST",
                url: $form.attr('action'),
                data: datastring,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                    // do what ever you want with the server response
                    $.get('<?php echo site_url("pesanan"); ?>?cari[q]='+ data.seri_faktur, function(data) {
                        var oContent = $(data).find('#pesanan-' + faktur_id);

                        // $('#main-table tr#pesanan-' + faktur_id).replaceWith(oContent);
                        load_pembayaran('#pesanan-'+ faktur_id +' .pesanan','#pesanan-'+ faktur_id +' .status', '#pesanan-'+ faktur_id +' .pembayaran', faktur_id, function() {});
                        $('#main-table tr#pesanan-' + faktur_id).delay(100).fadeOut().fadeIn('slow');
                    });

                    createToast(data.title, data.alert);

                },
                error: function() {
                    alert('error handling here');
                }
            });
        });

        // set kirim
        $(document).on("click", ".set_kirim", function(e){
            e.preventDefault();
            var konten = '';
            var $div = $(e.target).closest( ".mn" );
            var action = '<?php echo site_url("add/pengiriman"); ?>';
            var id = $div.attr('data-id');
            var faktur = $div.attr('data-faktur');
            var option = '';
            var kurir = <?php echo $this->config->item("list_kurir") ?>;

            $.each(kurir, function(i,v){
                option += '<option value="'+v+'">'+v+'</option>';
            });
            
            konten += '<input name="faktur_id" type="hidden" value="'+id+'"/>';
            konten += '<input name="cek" type="hidden" value="tidak"/>';

            konten += '<div class="form-row">';
                konten += '<div class="col-sm-4">';
                    konten += '<div class="form-group">';
                        konten += '<label for="kurir_list">Kurir</label>';
                        konten += '<select name="kurir" class="custom-select" id="kurir_list">';
                        konten += option;
                        konten += '<option value="lainnya">Lainnya</option></select>';
                    konten += '</div>';
                konten += '</div>';

                konten += '<div class="col-sm-8">';
                    konten += '<div class="form-group">';
                        konten += '<label for="lainnya">Kurir Lain</label>';
                        konten += '<input type="text" name="lainnya" disabled="" required="" value="" id="lainnya" class="form-control" placeholder="kurir lainnya" />';
                    konten += '</div>';
                konten += '</div>';
            konten += '</div>';

            konten += '<div class="form-group">';
                konten += '<label for="resi">No Resi</label>';
                konten += '<input type="text" name="resi" value="" required="" id="resi" class="form-control" placeholder="JOG98798777" />';
            konten += '</div>';

            konten += '<div class="form-row">';
                konten += '<div class="col-sm-4">';
                    konten += '<div class="form-group">';
                        konten += '<label for="tanggal_kirim">Tanggal Kirim</label>';
                        konten += '<input type="date" name="tanggal_kirim" required="" value="<?php echo mdate("%Y-%m-%d", now()); ?>" id="tanggal_kirim" class="form-control" placeholder="" />';                       
                    konten += '</div>';
                konten += '</div>';

                konten += '<div class="col-sm-8">';
                    konten += '<div class="form-group">';
                        konten += '<label for="ongkir">Biaya Ongkir</label>';
                        konten += '<input type="number" min="0" name="ongkir" required="" value="0" id="ongkir" class="form-control" placeholder="9000" />';
                    konten += '</div>';
                konten += '</div>';
            konten += '</div>';

            konten += '<div class="custom-control custom-checkbox">';
                konten += '<input type="checkbox" checked="" class="custom-control-input" name="cek" value="ya" id="cek_satu">';
                konten += '<label class="custom-control-label" for="cek_satu">Pesanan "'+faktur+'" selesai dikirimkan dalam satu resi ini</label>';
            konten += '</div>';

            doModal('Tambah Pengiriman '+ faktur, action, konten, 'addKrm');

            $("#kurir_list").change(function() {
                if ($(this).val() === "lainnya") {
                    $('#lainnya').attr('disabled', false);
                    $('#lainnya').attr('required', true);
                } else {
                    $('#lainnya').attr('disabled', true);
                }

                if ($(this).val() === "COD") {
                    $('#resi').val('COD<?php echo date("dmY") ?>');
                } else {
                    $('#resi').val('');
                }
            });
        });

        $(document).on('submit','.addKrm form',function(e){
            e.preventDefault();
            e.stopPropagation();

            var $form = $(this); //wrap this in jQuery
            var faktur_id = $('.addKrm [name="faktur_id"]').val();
            // alert('the action is: ' + $form.attr('action'));
            
            var datastring = $form.serialize();

            $('#main-table tr#pesanan-' + faktur_id ).empty().append('<td colspan="7" class="text-center"><div class="spinner-border spinner-border-lg" role="status"><span class="sr-only">Loading...</span></div></td>');

            $.ajax({
                type: "POST",
                url: $form.attr('action'),
                data: datastring,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                    // do what ever you want with the server response
                    $.get('<?php echo site_url("pesanan"); ?>?cari[q]='+ data.seri_faktur, function(data) {
                        var oContent = $(data).find('#pesanan-' + faktur_id);

                        $('#main-table tr#pesanan-' + faktur_id).replaceWith(oContent);
                        $('#main-table tr#pesanan-' + faktur_id).delay(100).fadeOut().fadeIn('slow');
                    });

                    $("#dynamicModal").modal('hide');
                    createToast(data.title, data.alert);

                },
                error: function() {
                    alert('error handling here');
                }
            });
        })

        $(document).on("click", ".cant_kirim", function(e){
            e.preventDefault();
            var $div = $(e.target).closest( "div" );
            var id = $div.attr('data-id');
            var faktur = $div.attr('data-faktur');
            var tm = makeid();
            createToast('Atur Pengiriman', 'Pesanan '+faktur+' belum dapat di-set kirim karena belum diproses ');
        });

        // set paket
        $(document).on("click", ".set_paket", function(e){
            e.preventDefault();
            var $div = $(e.target).closest( ".mn" );
            var id = $div.attr('data-id');
            var status = $(this).attr('data-status');
            var faktur = $div.attr('data-faktur');
            var action = '<?php echo base_url(); ?>';
            var konten = '<input name="status_paket" type="hidden" value=""/>';

            konten += '<div id="'+id+'" data-faktur="'+faktur+'" data-current="'+status+'" class="button-radios d-flex text-light justify-content-center">';
                konten += '<div data-status="belumproses" class="mx-1 radio border text-center justify-content-center d-flex align-items-center rounded-circle '+ (status === 'belumproses' ? 'bg-primary': 'bg-dark') +'" data-value="0"><span>Belum diproses</span></div>';
                konten += '<div data-status="diproses" class="mx-1 radio border text-center justify-content-center d-flex align-items-center rounded-circle '+(status === 'diproses'? 'bg-primary': 'bg-dark')+'" data-value="1"><span>Diproses</span></div>';
                konten += '<div data-status="dibatalkan" class="mx-1 radio border text-center justify-content-center d-flex align-items-center rounded-circle '+(status === 'dibatalkan'? 'bg-primary': 'bg-dark')+'" data-value="2"><span>Dibatalkan</span></div>';

            konten += '</div>';

            doModal('Atur status paket '+ faktur, action, konten, 'aturpaket', false);
        });

        $(document).on("click", ".button-radios .radio", function(e){
            $(this).parent().find('.radio').removeClass('bg-primary').addClass('bg-dark');
            $(this).removeClass('bg-dark').addClass('bg-primary');
            var status = $(this).attr('data-value');
            var status_text = $(this).attr('data-status');
            var faktur_id = $(this).parent().attr('id');
            var current = $(this).parent().attr('data-current');
            var faktur = $(this).parent().attr('data-faktur');

            if(current === status_text) {
                $("#dynamicModal").modal('hide');
            }
            else {
                $("#dynamicModal").modal('hide');
                $('#main-table tr#pesanan-' + faktur_id + ' .status').empty().append('<div colspan="7" class="text-center"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>');

                $.post('<?php echo site_url("post/paket") ?>', {faktur_id: faktur_id, status: status}, function(response) {

                    $.get('<?php echo site_url("pesanan"); ?>?cari[q]='+ faktur, function(data) {
                        var oContent = $(data).find('#pesanan-' + faktur_id);

                        // $('#main-table tr#pesanan-' + faktur_id).replaceWith(oContent);
                        load_pembayaran('#pesanan-'+ faktur_id +' .pesanan','#pesanan-'+ faktur_id +' .status', '#pesanan-'+ faktur_id +' .pembayaran', faktur_id, function() {});
                        $('#main-table tr#pesanan-' + faktur_id + ' .status').delay(100).fadeOut().fadeIn('slow');
                    });

                    createToast(response.title, response.alert);
                });
            }
        });
        
        // hapus pesanan
        $(document).on("click", ".hapus_pesanan", function(e){
            e.preventDefault();
            var tm = makeid();
            var $div = $(e.target).closest( ".mn" );
            var id = $div.attr('data-id');
            var b = $div.attr('data-faktur');
            var result = confirm("Hapus pesanan? ini tidak dapat dibatalkan.");
            if (result) {
                //
                $.post('<?php echo site_url("del/pesanan") ?>', {faktur_id: id, faktur:b}, function(response) {
                    createToast('Pesanan dihapus', response.notif);
                    $('#main-table tr#pesanan-' + id).hide('slow', function(){ $(this).remove(); });
                });
            }
        });
     
    })
    </script>
</body>
</html>