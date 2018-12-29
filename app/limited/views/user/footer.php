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
            var action = '<?php echo site_url("mypost/pembayaran"); ?>';
            var id = $div.attr('data-id');
            var faktur = $div.attr('data-faktur');

            console.log($div);

            $.ajax({
                type:"GET",
                url: "<?php echo site_url('myget/pembayaran'); ?>",
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
                                konten += '<span class="font-weight-bold">' + pay.rekening + '</span>';
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

            $.get('<?php echo site_url("myget/pengiriman") ?>', {faktur_id: id}, function(response) {
                if (response.length > 0) {
                    konten += '<ul>';
                    for (i = 0; i < response.length; i++) {
                        konten += '<li>';
                            konten += response[i].kurir;
                            konten += '<ul>';
                                konten += '<li>resi: ' + response[i].resi + '</li>';
                                konten += '<li>tanggal kirim: ' + response[i].tanggal_kirim + '</li>';
                                if(response[i].ongkir > 0) {
                                    konten += '<li>tarif ongkir: ' + response[i].ongkir + '</li>';
                                }
                                konten += '</li>';
                            konten += '</ul>';
                        konten += '</li>';
                    }
                    konten += '</ul>';
                }
                else {
                    konten += '<div class="alert alert-info">Belum ada data pengiriman / pengambilan</div>';
                }

                doModal('Data Pengiriman '+ faktur, action, konten);
            });


            
        });

        $(document).on("click", ".cant_kirim", function(e){
            e.preventDefault();
            var $div = $(e.target).closest( ".mn" );
            var id = $div.attr('data-id');
            var faktur = $div.attr('data-faktur');

            status_update(id,faktur, 'Paket Pesanan '+faktur+' belum bisa dikirim, paket belum diproses');
        });

        // set paket
        $(document).on("click", ".set_paket", function(e){
            e.preventDefault();
            var $div = $(e.target).closest( ".mn" );
            var id = $div.attr('data-id');
            var status = $(this).attr('data-status');
            var faktur = $div.attr('data-faktur');

            if (status === 'diproses') {
                status_update(id,faktur, 'Paket Pesanan '+faktur+' belum diproses');
            }
            else {
                status_update(id,faktur, 'Paket Pesanan '+faktur+' telah diproses');
            }
        });

        function status_update(a,b,c) {
            var tm = makeid();
            var notif = '';

            notif += '<div class="toast" id="toast-'+tm+'" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">';
                notif += '<div class="toast-header">';
                    notif += '<strong class="mr-auto text-capitalize">Info</strong>';
                    notif += '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
                    notif += '<span aria-hidden="true">&times;</span>';
                    notif += '</button>';
                notif += '</div>';
                notif += '<div class="toast-body">';
                    notif += c;
                notif += '</div>';
            notif += '</div>';
                
            $('#message').append(notif);
            $('#toast-'+tm).toast('show');
            $('#toast-'+tm).on('hidden.bs.toast', function () {
                $(this).remove();
            });
            // $('#main-table').load(document.URL + ' #table-pesanan');
        }
        
        // hapus pesanan
        $(document).on("click", ".hapus_pesanan", function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var b = $(this).attr('data-faktur');
            var result = confirm("Hapus pesanan? ini tidak dapat dibatalkan.");
            if (result) {
                //
                $.post('<?php echo site_url("del/pesanan") ?>', {faktur_id: id, faktur:b}, function(response) {
                    var notif = '<div class="toast" id="toast-'+tm+'" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">';
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
            
        });

        // form tambah pesanan
        $(document).on("keyup change", "#hp1",function(){
        // $('#hp').on("change keyup", function(e) {
			var isi = $(this).val();
			var str = isi.substr(isi.length - 3); // DXB
			
			$('input[name="unik"]').val(str);
		});

        $(document).on("keyup change", '[name="marketplace_"]',function(){
            if(this.checked) {
                //Do stuff
                $('[name="marketplace"]').prop('disabled', false);
                $('.bankir').prop('disabled', true);
            }
            else {
                $('[name="marketplace"]').prop('disabled', true);
                $('.bankir').prop('disabled', false);
            }
        });

        var transfer_field = $('.transfer'),
			diskon_field = $('.diskon'),
			ongkir_field = $('.ongkir'),
			unik_field = $('.unik'),
			harga_field = $('[name="harga_total"]');

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

        // pembayaran multiple via transfer
        var ti = $("#multiBayar .listPembayaran").length;
        $(document).on("click", ".btnAddTransfer", function(e){
            e.preventDefault();
            ti++;
            var clone = $('#pembayaranViaTransfer').clone('#formTransfer');

            clone.attr('data-transfer', ti);

            clone.find("#rekening").attr({name: 'pembayaran['+ti+'][rekening]', id: 'rekening-'+ti}).val('');
            clone.find("#tanggal_transfer").attr({name: 'pembayaran['+ti+'][tanggal]', id: 'tanggal_transfer-'+ti}).val("<?php echo mdate('%Y-%m-%d', now()); ?>");
            clone.find("#jumlah_transfer").attr({name: 'pembayaran['+ti+'][jumlah]', id: 'jumlah_transfer-'+ti}).val('0');

            $('#multiBayar').append(clone);

            $('[data-transfer="'+ti+'"] .btnAddTransfer').replaceWith( '<button type="button" class="btn btn-outline-danger bankir btn-block btnDelTransfer"><i class="fas fa-minus"></i></button>' );
        });

        $(document).on("click", ".btnDel", function(e){
            var $row  = $(this).parents('#dup');
            $row.slideUp("slow", function() { $(this).remove(); } );
        });

        $(document).on("click", ".btnDelTransfer", function(e){
            var $row  = $(this).parents('#pembayaranViaTransfer');
            $row.slideUp("slow", function() { $(this).remove(); } );
        });

        // create modal 
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

        $("#tambahBayar").click(function(e) {
            e.preventDefault();
            $('#modalTambahPembayaran').modal('show');
            $('#modalPembayaran').modal('hide');
        });

        $("#BatalTambahPembayaran" ).click(function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var faktur = $(this).attr('data-faktur');

            $('#modalTambahPembayaran').modal('hide');
            $('#modalPembayaran').modal('show');
            // $('#modalTambahPembayaran').modal('hide');
            load_pembayaran(id, faktur);
            
        });

        //
        function load_pembayaran(id, faktur) {
            $.ajax({
                type:"GET",
                url: "<?php echo site_url('get/pembayaran'); ?>",
                data: {id: id},
                dataType: 'json',
                success: (function( data ) {
                    $('#dataBayar').empty();
                    $('#infoBayar').empty();
                    $('#modalPembayaranLabel').text('Atur Pembayaran '+ faktur);
                    $('#modalTambahPembayaranLabel').text('Tambah Pembayaran '+ faktur);

                    if (data.length === 0) {
                        $('<p class="alert alert-danger">').text('Tidak ditemukan data pembayaran').appendTo('#infoBayar');
                    }
                    else {
                        for (i = 0; i < data.length; i++) {
                            const pay = data[i];
                            $('<li>').attr({'id': 'bayar'+i}).text(pay.rekening).appendTo('#dataBayar');
                            // tombol hapus pembayaran
                            $('<button>').attr({'type': 'button', 'class' : 'btn btn-outline-secondary ml-2 btn-sm hapus_bayar', 'data-id': pay.id, 'id': 'hapus'+i}).appendTo('#bayar'+i);
                            $('<i class="fas fa-trash">').appendTo('#hapus'+i);
                            // list pembayaran
                            $('<ul>').attr({'id': 'pembayaran'+i}).appendTo('#bayar'+i);
                            $('<li>').text('Tanggal bayar / transfer : ' + pay.tanggal_bayar).appendTo('#pembayaran'+i);
                            $('<li>').text('Jumlah : ' + pay.jumlah).appendTo('#pembayaran'+i);                        
                            $('<div class="custom-control custom-checkbox" id="chk'+i+'">').appendTo('#pembayaran'+i);
                            $('<input>').attr({'value': 'ya', 'name': 'pembayaran['+pay.id+']','type': 'checkbox', 'id': 'check'+i, 'class': 'custom-control-input'}).appendTo('#chk'+i);
                            $('<label>').attr({'class': 'custom-control-label', 'id': 'lbl'+i, 'for': 'check'+i}).text('Dana ada / sudah masuk').appendTo('#chk'+i);

                            //
                            $('#BatalTambahPembayaran').attr({'data-id': id, 'data-faktur': faktur});

                            // default value
                            $('<input>').attr({'value': 'tidak', 'name': 'pembayaran['+pay.id+']','type': 'hidden'}).prependTo('#Bayar');
                            $('<input>').attr({'value': id, 'name': 'faktur','type': 'hidden'}).prependTo('#Bayar');

                            if(pay.tanggal_cek !== null) {
                                $('<div class="small text-muted">').text('dicek pada: ' + pay.tanggal_cek).appendTo('#lbl'+i);
                                $('#check'+i).attr('checked', true);
                            }
                        }
                    }
                    
                })
            })
        }

        

        // hapus pembayaran
        $(document).on("click", ".hapus_bayar", function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');

            $('#modalPembayaran').modal('hide');
            $('.modal_hapus_bayar').modal({backdrop: 'static', show: true, keyboard: false});
        })
    })
    </script>
</body>
</html>