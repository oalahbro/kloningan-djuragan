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
        $('#sidebar').on('shown.bs.collapse', function () {
            $('.overlay').toggleClass('active');
            $('body').toggleClass('modal-open');
        });

        $('#sidebar').on('hidden.bs.collapse', function () {
            $('.overlay').toggleClass('active');
            $('body').toggleClass('modal-open');
        })

        // create random string
        // https://stackoverflow.com/a/1349426/2094645
        function makeid() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 5; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }

        // init tooltips
        $(document).find('[data-toggle="tooltip"]').tooltip();

        //
        $(document).on("click", "input[type='number']", function(e){
            $(this).select();
        });

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

            console.log($div);

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
                    doModal('Cek Pembayaran '+ faktur, action, konten);
                })
            })
        });

        $(document).on("click", ".hapusPembayaran", function(e){
            var id = $(this).attr('data-id');
            var faktur = $(this).attr('data-faktur');
            var $delel = $(this).closest( "li" );
            $.post("<?php echo site_url('del/pembayaran'); ?>",
            {
                idfaktur: faktur,
                idpembayaran: id,
            },
            function(data, status){
                
                $delel.remove();
                $('#main-table').load(document.URL + ' #table-pesanan');
            });
        });

        $(document).on("click", ".sunting_pembayaran", function(e){
            e.preventDefault();

            var $div = $(this).closest( ".mn" );

            var konten = '';
            var action = '<?php echo site_url("post/pembayaran"); ?>';
            var id = $div.attr('data-id');
            var faktur = $div.attr('data-faktur');

            console.log($div);

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
                                konten += '<span class="font-weight-bold"><a href="#!" data-id="'+pay.id+'" class="sunting_pembayaran text-reset">' + pay.rekening + '</a></span>';
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
                    doModal('Cek Pembayaran '+ faktur, action, konten);
                })
            })
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

            konten += '<input name="faktur" type="hidden" value="'+id+'"/>';

            konten += '<div class="form-group">';
                konten += '<label for="rekening">Tujuan Transfer</label>';
                konten += '<input type="text" name="rekening" value="" required="" id="rekening" class="form-control" placeholder="misal: BNI, BRI, BCA, Tokopedia ...." />';
            konten += '</div>';

            konten += '<div class="form-row">';
                konten += '<div class="col-sm-6">';
                    konten += '<div class="form-group">';
                        konten += '<label for="jumlah">Jumlah</label>';
                        konten += '<input type="number" min="0" name="jumlah" required="" value="'+kekurangan+'" id="jumlah" class="form-control" placeholder="misal: 200000" />';
                    konten += '</div>';
                konten += '</div>';
                konten += '<div class="col-sm-6">';
                    konten += '<div class="form-group">';
                        konten += '<label for="tanggal_bayar">Tanggal</label>';
                        konten += '<input type="date" name="tanggal_bayar" required="" value="<?php echo mdate("%Y-%m-%d", now()); ?>" id="tanggal_bayar" class="form-control" placeholder="" />';
                    konten += '</div>';
                konten += '</div>';
            konten += '</div>';

            doModal('Tambah Pembayaran '+ faktur, action, konten);
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
            
            konten += '<input name="faktur" type="hidden" value="'+id+'"/>';
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

            doModal('Tambah Pengiriman '+ faktur, action, konten);

            $("#kurir_list").change(function() {
                if ($(this).val() === "lainnya") {
                    $('#lainnya').attr('disabled', false);
                    $('#lainnya').attr('required', true);
                } else {
                    $('#lainnya').attr('disabled', true);
                }

                if ($(this).val() === "COD") {
                    $('#resi').val('COD-<?php echo date("dmY") ?>');
                } else {
                    $('#resi').val('');
                }
            });
        });

        $(document).on("click", ".cant_kirim", function(e){
            e.preventDefault();
            var $div = $(e.target).closest( "div" );
            var id = $div.attr('data-id');
            var faktur = $div.attr('data-faktur');
            var tm = makeid();
            var notif = '';

            notif += '<div class="toast" id="toast-'+tm+'" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">';
                notif += '<div class="toast-header">';
                    notif += '<strong class="mr-auto">Gagal Set</strong>';
                    notif += '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
                    notif += '<span aria-hidden="true">&times;</span>';
                    notif += '</button>';
                notif += '</div>';
                notif += '<div class="toast-body">';
                    notif += 'Pesanan '+faktur+' belum dapat di-set kirim karena belum diproses ';
                notif += '</div>';
            notif += '</div>';

            $('#message').append(notif);

            $('.toast').toast('show');
            $('#toast-'+tm).on('hidden.bs.toast', function () {
                $(this).remove();
            });
        });

        // set paket
        $(document).on("click", ".set_paket", function(e){
            e.preventDefault();
            var $div = $(e.target).closest( ".mn" );
            var id = $div.attr('data-id');
            var status = $(this).attr('data-status');
            var faktur = $div.attr('data-faktur');

            if (status === 'diproses') {
                status_update(id,faktur,status);
            }
            else {
                var result = confirm("Data pengiriman juga akan akan dihapus");
                if (result) {
                    status_update(id,faktur,status);
                }
            }
        });

        function status_update(a,b,c) {
            var tm = makeid();
            var notif = '';

            $.post('<?php echo site_url("post/paket") ?>', {faktur_id: a, faktur:b, status: c}, function(response) {
                notif += '<div class="toast" id="toast-'+tm+'" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">';
                    notif += '<div class="toast-header">';
                        notif += '<strong class="mr-auto text-capitalize">'+c+'</strong>';
                        notif += '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
                        notif += '<span aria-hidden="true">&times;</span>';
                        notif += '</button>';
                    notif += '</div>';
                    notif += '<div class="toast-body">';
                        notif += response.notif;
                    notif += '</div>';
                notif += '</div>';
                    
                $('#message').append(notif);
                $('#toast-'+tm).toast('show');
                $('#toast-'+tm).on('hidden.bs.toast', function () {
                    $(this).remove();
                });
                $('#main-table').load(document.URL + ' #table-pesanan');
            });
        }
        
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
                    var notif = '<div class="toast" id="toast-'+tm+'" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">';
                        notif += '<div class="toast-header">';
                            notif += '<strong class="mr-auto text-capitalize">Dihapus</strong>';
                            notif += '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
                            notif += '<span aria-hidden="true">&times;</span>';
                            notif += '</button>';
                        notif += '</div>';
                        notif += '<div class="toast-body">';
                            notif += response.notif;
                        notif += '</div>';
                    notif += '</div>';
                        
                    $('#message').append(notif);
                    $('#toast-'+tm).toast('show');
                    $('#toast-'+tm).on('hidden.bs.toast', function () {
                        $(this).remove();
                    });
                    $('#main-table').load(document.URL + ' #table-pesanan');
                });
            }
            
        });

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
            if($(this).val() === 'diproses') {
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

        $(document).on("keyup change", '[name="cari[cek_tanggal]"]',function(){
            if(this.checked) {
                //Do stuff
                $('[name="cari[tanggal]"]').prop('disabled', false);
            }
            else {
                $('[name="cari[tanggal]"]').prop('disabled', true);
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

        // create dynamic modal 
        function doModal(heading, action, modalContent, additionalButton='') {
            html =  '<div class="modal fade" id="dynamicModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="dynamicModalTitle" aria-hidden="true">';
            html += '<div class="modal-dialog modal-dialog-centered" role="document">';
            html += '<div class="modal-content">';
            html += '<form action="'+action+'" method="post">';
            html += '<div class="modal-header">';
            html += '<h5 class="modal-title" id="dynamicModalTitle">'+heading+'</h5>'
            html += '</div>';
            html += '<div class="modal-body">';
            html += modalContent;
            html += '</div>';
            html += '<div class="modal-footer">';
            html += '<button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Batal</button>';
            html += '<button class="btn btn-success" type="submit">Simpan</button>';
            html += '</div>';  // content
            html += '</form>';
            html += '</div>';  // dialog
            html += '</div>';  // footer
            html += '</div>';  // modalWindow

            $('body').append(html);
            $("#dynamicModal").modal();
            $("#dynamicModal").modal('show');

            $('#dynamicModal').on('hidden.bs.modal', function (e) {
                $(this).remove();
            });
        }

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
    })
    </script>
</body>
</html>