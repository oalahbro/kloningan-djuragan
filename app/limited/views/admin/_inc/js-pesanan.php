<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
///////////////////////
var row = $( "#main-table tbody tr" ),
    tanggal_sekarang = "<?php echo mdate('%Y-%m-%d', now()); ?>",
    spinner = '<div class="text-center"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>',
    spinner_btn = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';

var i = 0; // the index we're using
var cmd; // basically a var just so we don't have to keep calling cmd_files[i]
var totalCommands = row.length; // basically how many iterations to do

function loadingData(i, callback) {
    if (i >= totalCommands) return; // end it if it's done
    cmd = row.eq( i );
    var pid = $( cmd ).attr('id');
    var id = pid.split('-');

    // do ajax
    load_juragan('#'+pid +' .juragan', id[1], function() {
        i++;
        loadingData(i, function(){});
    });
    load_pembayaran('#'+pid +' .pesanan','#'+pid +' .status', '#'+pid +' .pembayaran', id[1], function() {load_tooltips();});
    load_keterangan('#'+pid +' .keterangan', id[1]);
    callback();
}

loadingData(0, function(){}); // start the first iteration manually

function load_tooltips() {
    $(document).find('[data-toggle="tooltip"]').tooltip();
}

function load_juragan(el, id, callback) {
    var url = "<?php echo site_url() ?>/",
        json_url = url + 'admin/faktur/json_juragan/' + id;

    $.getJSON(json_url, function( b ) {
        var juragan = '<a href="' + url + 'pesanan/' + b.slug + '">'+ b.nama +'</a>';
        var pengguna = '<hr/><span class="text-muted small">CS: ' + b.nama_cs + '</span>';

        $(el).empty().append( juragan + pengguna );
        callback();
    });
}

function load_pembayaran(el1, el2, el3, id, callback) {
    var url = "<?php echo site_url('admin/faktur/json_pembayaran') ?>/" + id;

    $.getJSON(url, function( b ) {
        var unik='',
            ongkir='',
            diskon='',
            kurang = 0,
            tipe = '',
            terbayar = '',
            produk = '',
            setting = '';
            
        switch (b.status) {
            case 1:
                var cl = 'border-warning',
                    tx = 'Kredit';
                break;
            case 2:
                var cl = 'border-success',
                    tx = 'Lunas';
                break;
            case 3:
                var cl = 'border-primary',
                    tx = 'Kelebihan';
                break;
            case 4:
                var cl = 'border-danger',
                    tx = 'Belum Lunas';
                break;
        }

        var status_bayar = '<span id="status_pesan" class="d-block text-center border '+cl+' text-uppercase py-1 font-weight-bold rounded">'+tx+'</span>';

        var harga_produk = '<span class="d-block text-right">harga produk : <span class="badge badge-info">'+ b.harga_produk +'</span></span>';

        if(typeof b.ongkir != 'undefined') {
            ongkir = '<span class="d-block text-right">tarif ongkir : <span class="badge badge-dark">'+ b.ongkir +'</span></span>';
        }

        if(typeof b.unik != 'undefined') {
            unik = '<span class="d-block text-right">digit unik : <span class="badge badge-secondary">'+ b.unik +'</span></span>';
        }

        if(typeof b.diskon != 'undefined') {
            diskon = '<span class="d-block text-right">diskon : <span class="badge badge-warning">-'+ b.diskon +'</span></span>';
        }

        var wajib_bayar = '<span class="d-block text-right">wajib bayar : <span class="badge badge-success">'+ b.wajib_bayar +'</span></span>';

        if(typeof b.terbayar != 'undefined') {
            terbayar = '<span class="d-block text-right">dibayar : <span class="badge badge-danger">'+ b.terbayar +'</span></span>';
        }

        var stt_btn = '<div class="mn" data-statustransfer="'+b.status_transfer+'" data-kurang="0" data-faktur="'+b.seri_faktur+'" data-id="'+b.id_faktur+'">',
            $c_trf, $a_trf, $i_trf, $t_trf,
            $c_pkt, $i_pkt, $mi_pkt, $t_pkt, $a_krm, $s_pkt;

            // status transfer
            switch (b.status_transfer) {
                case "3":
                    // sudah lunas
                    $c_trf = 'text-success';
                    $a_trf = 'cek_pembayaran ckbyr';
                    $i_trf = 'fa-check-double';
                    $t_trf = 'Pembayaran Lunas';
                    break;
                case "4":
                    // sudah lunas dan mempunyai kelebihan
                    $c_trf = 'text-info';
                    $a_trf = 'cek_pembayaran ckbyr';
                    $i_trf = 'fa-plus';
                    $t_trf = 'Pembayaran Lunas & memiliki kelebihan';
                    break;
                case "2":
                    // belum lunas / dp yang dibayarkan sudah ada
                    $c_trf = 'text-warning';
                    $a_trf = 'cek_pembayaran ckbyr';
                    $i_trf = 'fa-ellipsis-h';
                    $t_trf = 'Pembayaran belum lunas';
                    break;
                case "1":
                    // pembayaran lanjutan dp perlu dicek
                    $c_trf = 'text-primary';
                    $a_trf = 'cek_pembayaran ckbyr';
                    $i_trf = 'fa-redo fa-spin';
                    $t_trf = 'Pembayaran ada yang perlu dicek';
                    break;
                default:
                    // belum ada
                    $c_trf = 'text-danger';
                    $a_trf = 'tambah_pembayaran ckbyr';
                    $i_trf = 'fa-times';
                    $t_trf = 'Pembayaran Belum ada';
            }
            
            stt_btn += '<div class="fa-2x d-inline-block '+ $a_trf +'" data-toggle="tooltip" data-placement="top" title="'+ $t_trf +'">';
            stt_btn += '<span class="fa-layers fa-fw">';
            stt_btn += '<i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>';
            stt_btn += '<i class="fas fa-wallet text-secondary" data-fa-transform="shrink-6"></i>';
            stt_btn += '<span class="fa-layers fa-fw">';
            stt_btn += '<i class="fas fa-circle ' + $c_trf + '" data-fa-transform="shrink-8 down-1 right-5"></i>';
            stt_btn += '<i class="fas ' + $i_trf + ' text-light" data-fa-transform="shrink-10 down-1 right-5"></i>';
            stt_btn += '</span>';
            stt_btn += '</span>';
            stt_btn += '</div>';

            // status paket
            switch (b.status_paket) {
                case "1":
                    // paket diproses
                    $c_pkt = 'text-success';
                    $i_pkt = 'fa-check-double';
                    $mi_pkt = 'fa-box';
                    $t_pkt = 'Pesanan diproses';
                    $a_krm = 'set_kirim';
                    $s_pkt = 'diproses';
                    break;
                case "2":
                    // paket diproses
                    $c_pkt = 'text-danger';
                    $i_pkt = 'fa-ban';
                    $mi_pkt = 'fa-box';
                    $t_pkt = 'Pesanan dibatalkan';
                    $a_krm = 'cset_kirim';
                    $s_pkt = 'dibatalkan';
                    break;
                default:
                    // belum diproses
                    $c_pkt = 'text-warning';
                    $i_pkt = 'fa-times';
                    $mi_pkt = 'fa-box-open';
                    $t_pkt = 'Pesanan Belum diproses';
                    $a_krm = 'cant_kirim';
                    $s_pkt = 'belumproses';
            }
            
            stt_btn += '<div class="fa-2x d-inline-block set_paket" data-status="'+ $s_pkt +'" data-toggle="tooltip" data-placement="top" title="'+ $t_pkt + '">';
            stt_btn += '<span class="fa-layers fa-fw">';
            stt_btn += '<i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>';
            stt_btn += '<i class="fas '+ $mi_pkt +' text-secondary" data-fa-transform="shrink-6"></i>';
            stt_btn += '<span class="fa-layers fa-fw">';
            stt_btn += '<i class="fas fa-circle '+ $c_pkt +'" data-fa-transform="shrink-8 down-1 right-5"></i>';
            stt_btn += '<i class="fas '+ $i_pkt +' text-light" data-fa-transform="shrink-10 down-1 right-5"></i>';
            stt_btn += '</span>';
            stt_btn += '</span>';
            stt_btn += '</div>';

            // status kirim
            switch (true) {
                case (b.status_kirim === '2' && b.status_kiriman === '2'):
                    // pesanan dikirim
                    $c_krm = 'text-success';
                    $i_krm = 'fa-check-double';
                    $mi_krm = 'fa-plane-departure';
                    $t_krm = 'Pesanan telah dikirim';
                    break;
            
                case (b.status_kirim === '2' && b.status_kiriman === '1'):
                    // pesanan diambil
                    $c_krm = 'text-success';
                    $i_krm = 'fa-check-double';
                    $mi_krm = 'fa-people-carry';
                    $t_krm = 'Pesanan diambil';
                    break;
            
                case (b.status_kirim === '1'):
                    // pesanan dikirim / diambil sebagian
                    $c_krm = 'text-warning';
                    $i_krm = 'fa-ellipsis-h';
                    $mi_krm = 'fa-cubes';
                    $t_krm = 'Pesanan telah dikirim sebagian';
                    break;
            
                default:
                    // belum kirim / ambil
                    $c_krm = 'text-danger';
                    $i_krm = 'fa-times';
                    $mi_krm = 'fa-cubes';
                    $t_krm = 'Pesanan Belum dikirim';
                    break;
            }
            
            stt_btn += '<div class="fa-2x d-inline-block '+ $a_krm +'" data-toggle="tooltip" data-placement="top" title="'+ $t_krm +'">';
            stt_btn += '<span class="fa-layers fa-fw">';
            stt_btn += '<i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>';
            stt_btn += '<i class="fas '+ $mi_krm +' text-secondary" data-fa-transform="shrink-6"></i>';
            stt_btn += '<span class="fa-layers fa-fw">';
            stt_btn += '<i class="fas fa-circle '+ $c_krm +'" data-fa-transform="shrink-8 down-1 right-5"></i>';
            stt_btn += '<i class="fas '+ $i_krm +' text-light" data-fa-transform="shrink-10 down-1 right-5"></i>';
            stt_btn += '</span>';
            stt_btn += '</span>';
            stt_btn += '</div>';

            // tombol dropdown
            stt_btn += '<div class="dropdown dropright">';
            stt_btn += '<button class="btn btn-outline-primary btn-sm btn-block" type="button" id="setting-'+b.id_faktur+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog fa-spin"></i></button>';

            stt_btn += '<div class="dropdown-menu"aria-labelledby="setting-'+b.id_faktur+'">';
            
            stt_btn += '<button class="cek_pembayaran dropdown-item">Cek Pembayaran</button>';
            stt_btn += '<button class="tambah_pembayaran dropdown-item">Tambah Pembayaran</button>';

            stt_btn += '<div class="dropdown-divider"></div>';
            stt_btn += '<button class="ubah_status dropdown-item">Ubah Status Paket</button>';

            stt_btn += '<div class="dropdown-divider"></div>';
            stt_btn += '<button class="cek_pengiriman dropdown-item">Cek Pengiriman</button>';
            stt_btn += '<button class="tambah_pengiriman dropdown-item">Tambah Pengiriman</button>';
                                                                    
            stt_btn += '<div class="dropdown-divider"></div>';
            stt_btn += '<h6 class="dropdown-header">Lainnya</h6>';
            stt_btn += '<a class="dropdown-item" href="#">Unduh PDF</a>';
            stt_btn += '<a href="http://localhost/juragan.onlinesukses.com/index.php/myorder/sunting/sd190209203834" class="dropdown-item">Sunting</a>';
            stt_btn += '<button class="dropdown-item text-danger hapus_pesanan">Hapus</button>';
                    
            stt_btn += '</div>';
            stt_btn += '</div>';

        stt_btn += '</div>';
        
        if(typeof b.tipe != 'undefined') {
            tipe = '<span class="d-block text-uppercase py-1 text-center text-light font-weight-bold border border-danger bg-danger rounded px-2 mb-1">'+b.tipe+'</span>';
        }

        for (i = 0; i < b.produk.length; i++) {
            produk += '<div>' + b.produk[i].c + ' ('+b.produk[i].s+') = '+b.produk[i].q+'pcs</div>';
        }
        var total = '<hr/><em>total: <span class="badge badge-dark">' +b.total+ '</span> pcs</em>'

        $(el1).empty().append( tipe + produk + total );

        $(el2).empty().append(stt_btn);

        $(el3).empty().append( status_bayar + harga_produk + ongkir + unik + diskon + wajib_bayar + terbayar);
        callback();
    })
}

function load_keterangan(el, id) {
    var url = "<?php echo site_url('admin/faktur/json_keterangan') ?>/" + id,
        btn_keterangan = '',
        keterangan = '',
        btn_resi = '',
        resi = '',
        class_show = 'show';

    $.getJSON(url, function( k ) {
    
        if(typeof k.ket !== 'undefined' || typeof k.gambar !== 'undefined') {
            btn_keterangan = '<button class="btn btn-outline-info dropdown-toggle btn-sm mb-1 mr-1" type="button" data-toggle="collapse" data-target="#collapseKeterangan-'+ k.id + '" aria-expanded="false" aria-controls="collapseKeterangan-'+ k.id + '"><i class="fas fa-scroll"></i> Keterangan</button>';
        }

        if(typeof k.pengiriman !== 'undefined' && k.pengiriman.length > 0) {
            class_show = '';
            btn_resi = '<button class="btn btn-outline-dark btn-sm dropdown-toggle mb-1" type="button" data-toggle="collapse" data-target="#collapseResi-'+k.id+'" aria-expanded="false" aria-controls="collapseResi-'+k.id+'"><i class="fas fa-receipt"></i> Resi Kirim</button>';

            resi = '<div class="collapse show" id="collapseResi-'+k.id+'">';
            resi += '<div class="bg-light border border-dark p-1 mt-2 rounded">';
            resi += '<h6>Pengiriman : </h6>';
            resi += '<ul class="ml-0 pl-3">';
        

            for (i = 0; i < k.pengiriman.length; i++) {
                resi += '<li><span class="font-weight-bold">' +k.pengiriman[i].c+ '</span>';
                resi += '<br/>' + k.pengiriman[i].r;
                if (k.pengiriman[i].o !== null) {
                    resi += '<br/>ongkir: <span class="badge badge-secondary">' +k.pengiriman[i].o+ '</span>';
                }
                resi += '<br/><small class="text-muted">tanggal: ' +k.pengiriman[i].d+ '</small>'
                resi += '</li>';
            }
            resi += '</ul>';
            resi += '</div>';
            resi += '</div>';
        }

        if(typeof k.ket !== 'undefined' || typeof k.gambar !== 'undefined') {

            keterangan += '<div class="collapse '+class_show+'" id="collapseKeterangan-'+k.id+'">';
            
            if(typeof k.ket !== 'undefined') {
                keterangan += '<p class="text-break" style="max-width:200px;">' +k.ket+ '</p>';
            }

            //
            if(typeof k.gambar !== 'undefined') {
                keterangan += '<div class="dropdown mt-3">';
                keterangan += '<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="customGambar-'+k.id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Gambar </button>';

                keterangan += '<div class="dropdown-menu" aria-labelledby="customGambar-'+k.id+'">';

                for (let g = 0; g < k.gambar.length; g++) {
                    var ni = 1;
                    keterangan += '<a class="dropdown-item" target="_blank" href="'+k.gambar[g]+'">Custom Gambar '+ ni  +'</a>'
                    ni++;
                }

                keterangan += '</div>';
                keterangan += '</div>';
            }
        keterangan += '</div>';
        }

        $(el).empty().append( btn_keterangan + btn_resi + resi + keterangan);
    })
}

function load_data_pembayaran(id) {
    var konten = '';
    $.ajax({
        type:"GET",
        url: "<?php echo site_url('get/pembayaran'); ?>",
        data: {id: id},
        dataType: 'json',
        success: (function( data ) {

            konten += '<div class="pt-3">';
            if (data.length === 0) {
                konten += '<p class="alert alert-danger">Tidak ditemukan data pembayaran</p>';
            }
            else {
                konten += '<input name="faktur" type="hidden" value="'+id+'"/>';
                
                konten += '<div id="list_pembayaran" class="list-group">';
                for (i = 0; i < data.length; i++) {
                    const pay = data[i];

                    if(pay.tanggal_cek === null) {
                        var dicek = '';
                        var ico = 'times-circle text-danger';
                    }
                    else {
                        var dicek = '<br/>dicek ada/masuk pada '+pay.tanggal_cek;
                        var ico = 'check-circle text-success';
                    }

                    // konten += '<div class="d-flex w-100 justify-content-between">';
                    konten += '<label class="list-group-item list-group-item-action">';
                        konten += '<div class="d-flex justify-content-between">';
                            konten += '<div class="d-flex w-100 justify-content-start">';
                                konten += '<div class="mr-3 d-flex align-items-center">';
                                    konten += '<i class="fas fa-'+ico+' fa-2x"></i>';
                                konten += '</div>';
                                konten += '<div>';
                                    konten += '<input name="pembayaran['+pay.id+']" type="hidden" value="tidak"/>';

                                    konten += '<input type="checkbox" name="pembayaran['+pay.id+']" data-id="'+pay.id+'" value="ya" class="d-none sbm" id="check'+i+'" '+(pay.tanggal_cek === null ? '/>' : ' checked=""/>');

                                    konten += '<h5 class="mb-1 text-uppercase">' + pay.rekening + ' <span class="badge badge-warning">' + pay.jumlah + '</span></h5>';
                                    
                                    konten += '<p class="mb-1">dibayar  pada ' + pay.tanggal_bayar + dicek + '</p>';
                                konten += '</div>';
                            konten += '</div>';

                            konten += '<div class="dropdown" data-id="'+pay.id+'">';
                                konten += '<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mm-'+i+'" class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-down"></i></button>';

                                konten += '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="mm-'+i+'">';
                                    konten += '<button class="dropdown-item suntingBayar">Sunting</button>';
                                    konten += '<button class="dropdown-item hapusBayar">Hapus</button>';
                                konten += '</div>';
                            konten += '</div>';
                        konten += '</div>';
                    konten += '</label>';
                }
                konten += '</div>';
            }
            konten += '</div>';

            // nav-cek
            $('#nav-cek-tab').html(konten);

        })
    });
}

function load_data_tambahPembayaran(id) {
    var htm = '';
    htm += '<form class="mt-3" method="post" accept-charset="utf-8">';
    htm += '<input name="faktur_id" type="hidden" value="'+id+'"/>';
        htm += '<div class="form-row mb-0">';
            htm += '<div class="col-6 form-group">';
                htm += '<label for="rekening">Tujuan Bayar</label>';
                htm += '<input class="form-control" id="rekening" type="text" name="rek" placeholder="mis: cash, mandiri, bca, bni, ..." required="">';
            htm += '</div>';

            htm += '<div class="col-6 form-group">';
                htm += '<label for="tanggal_bayar">Tanggal Bayar</label>';
                htm += '<input class="form-control" id="tanggal_bayar" type="date" name="tanggal_bayar" value="'+ tanggal_sekarang +'" required="">';
            htm += '</div>';

            htm += '<div class="col-6 form-group">';
                htm += '<label for="nominal">Jumlah Dana</label>';
                htm += '<input class="form-control" id="nominal" type="number" min="0" name="nominal" placeholder="mis: 350000" required="">';
            htm += '</div>';

            htm += '<div class="col-6 form-group">';
                htm += '<label for="tanggal_cek">Dana ada?</label>';
                htm += '<div class="input-group mb-2 mr-sm-2">';
                    htm += '<div class="input-group-prepend">';
                        htm += '<div class="input-group-text">';
                            htm += '<input type="checkbox" name="ada_dana" value="ya">';
                        htm += '</div>';
                    htm += '</div>';
                    htm += '<input type="date" id="tanggal_cek" name="tanggal_cek" value="'+ tanggal_sekarang +'" class="form-control" disabled="" required="">';
                htm += '</div>';
            htm += '</div>';
        htm += '</div>';
        
        htm += '<hr/><button type="button" class="btn btn-primary submitMe">Tambah</button>';
    htm += '</form>';

    $('#nav-tambah-tab').html(htm);
}

// 
function load_data_suntingPembayaran(id) {
    var htm = '',
        json_url = "<?php echo site_url('faktur/detail_pembayaran'); ?>/" + id;

    $('#nav-sunting-tab').html('');    
    $.getJSON(json_url, function( s ) {
        htm += '<form class="mt-3" method="post" accept-charset="utf-8">';
        htm += '<input name="id_pembayaran" type="hidden" value="'+id+'"/>';
        htm += '<input name="faktur_id" type="hidden" value="'+s.faktur_id+'"/>';
            htm += '<div class="form-row mb-0">';
                htm += '<div class="col-6 form-group">';
                    htm += '<label for="rekening">Tujuan Bayar</label>';
                    htm += '<input class="form-control" value="'+s.rekening+'" id="rekening" type="text" name="rek" placeholder="mis: cash, mandiri, bca, bni, ..." required="">';
                htm += '</div>';

                htm += '<div class="col-6 form-group">';
                    htm += '<label for="tanggal_bayar">Tanggal Bayar</label>';
                    htm += '<input class="form-control" id="tanggal_bayar" type="date" name="tanggal_bayar" value="'+ s.tanggal_bayar +'" required="">';
                htm += '</div>';

                htm += '<div class="col-6 form-group">';
                    htm += '<label for="nominal">Jumlah Dana</label>';
                    htm += '<input class="form-control" id="nominal" type="number" min="0" name="nominal" placeholder="mis: 350000" value="'+s.jumlah+'" required="">';
                htm += '</div>';

                htm += '<div class="col-6 form-group">';
                    htm += '<label for="tanggal_cek">Dana ada?</label>';
                    htm += '<div class="input-group mb-2 mr-sm-2">';
                        htm += '<div class="input-group-prepend">';
                            htm += '<div class="input-group-text">';
                                htm += '<input type="checkbox" name="ada_dana" value="ya">';
                            htm += '</div>';
                        htm += '</div>';
                        htm += '<input type="date" id="tanggal_cek" name="tanggal_cek" value="'+ tanggal_sekarang +'" class="form-control" disabled="" required="">';
                    htm += '</div>';
                htm += '</div>';
            htm += '</div>';
            
            htm += '<hr/><button type="button" class="btn btn-primary simpanMe">Simpan</button>';
        htm += '</form>';

        $('#nav-sunting-tab').html(htm);

        if (s.tanggal_cek !== null) {
            $('#nav-sunting-tab input[type="checkbox"]').prop('checked', true);
            $('#nav-sunting-tab input[name="tanggal_cek"]').prop('disabled', false).val(s.tanggal_cek);
        }
    });
}

$(document).on("click", ".ckbyr", function(e){
    e.preventDefault();

    var $div = $(this).closest( ".mn" ),
        id = $div.attr('data-id'),
        faktur = $div.attr('data-faktur'),
        statustransfer = $div.attr('data-statustransfer'),
        konten = '';

    konten += '<nav><div data-id="'+ id +'" class="nav nav-tabs" id="nav-tab" role="tablist">';
    konten += '<a class="nav-item nav-link active" id="nav-cek" data-toggle="tab" href="#nav-cek-tab" role="tab" aria-controls="nav-cek-tab" aria-selected="true">Cek</a>';
    konten += '<a class="nav-item nav-link" id="nav-tambah" data-toggle="tab" href="#nav-tambah-tab" role="tab" aria-controls="nav-tambah-tab" aria-selected="">Tambah</a>';
    konten += '<a class="nav-item nav-link d-none" id="nav-sunting" data-toggle="tab" href="#nav-sunting-tab" role="tab" aria-controls="nav-sunting-tab" aria-selected="true">Sunting</a></div></nav>';

    konten += '<div class="tab-content" id="nav-tabContent">';
    konten += '<div class="tab-pane fade show active" id="nav-cek-tab" role="tabpanel" aria-labelledby="nav-cek-tab">'+ spinner +'</div>';
    konten += '<div class="tab-pane fade" id="nav-tambah-tab" role="tabpanel" aria-labelledby="nav-tambah-tab">'+ spinner +'</div>';
    konten += '<div class="tab-pane fade" data-id="" id="nav-sunting-tab" role="tabpanel" aria-labelledby="nav-sunting-tab">'+ spinner +'</div>';
    konten += '</div>';

    doModal('Pembayaran '+ faktur, konten, 'moodal_status_pembayaran');

    //
    if (statustransfer === '0') {
        $('#nav-tambah').tab('show');
        // $(document).on("shown.bs.tab", "#nav-tambah", function(e) {
            load_data_tambahPembayaran(id);
        // });
    }
    else {
        $('#nav-cek').tab('show');
        // $(document).on("shown.bs.tab", "#nav-cek-tab", function(e) {
            //
            load_data_pembayaran(id);
        // });
    }
});

// 
$(document).on("shown.bs.tab", 'a[data-toggle="tab"]', function(e){
    // var trgt = e.target; // newly activated tab
    // e.relatedTarget // previous active tab

    var $div = $(e.target),
        id = $div.closest('div').data('id'),
        div = $div.attr('id');

    $('#' + div + '-tab').html(spinner);
    if (div === 'nav-tambah') {
        load_data_tambahPembayaran(id);
        $('#nav-sunting').addClass('d-none');
    }
    else if (div === 'nav-cek') {
        load_data_pembayaran(id);
        $('#nav-sunting').addClass('d-none');
    }
});

//
$(document).on("keyup change", '[name="ada_dana"]',function(){
    if(this.checked) {
        $('[name="tanggal_cek"]').prop('disabled', false);
        
        //$('#dataPembayaran').collapse('hide');
    }
    else {
        $('[name="tanggal_cek"]').prop('disabled', true);
        //$('#dataPembayaran').collapse('show');
    }
});

// 
$(document).on('click','.submitMe',function(e){
    e.preventDefault();
    e.stopPropagation();

    var t = $(this),
        $form = t.closest('form'),
        datastring = $form.serialize();

    t.prop('disabled', true).html(spinner_btn);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('faktur/tambah_pembayaran') ?>",
        data: datastring,
        dataType: "json",
        success: function(data) {
            // console.log(data);
            if(data.status) {
                $('#nav-cek').tab('show');
                var pid = '#pesanan-'+ data.faktur_id;
                $(pid +' .pesanan').html(spinner);
                $(pid +' .status').html(spinner);
                $(pid +' .pembayaran').html(spinner);

                load_pembayaran(pid +' .pesanan',pid +' .status', pid +' .pembayaran', data.faktur_id, function() {load_tooltips();});
                createToast(data.title, data.alert);
            }
        },
        error: function() {
            createToast('Error', 'Pastikan form diisi dengan benar.');
            t.prop('disabled', false).html('Tambah');
        }
    });
});

//
$(document).on("keyup change", '#nav-cek-tab .sbm',function(){
    var ths = $(this);
        id_pembayaran = ths.attr('data-id'),
        id_faktur = $('#nav-cek-tab [name="faktur"]').val(),
        checking = '';

    if(this.checked) {
        checking = 'ya';
    }
    else {
        checking = 'tidak';
    }

    ths.prop('disabled', true);
 
    $.post("<?php echo site_url('post/pembayaran'); ?>", {
        id_faktur: id_faktur,
        id_pembayaran: id_pembayaran,
        check: checking
    },
    function(response, status){
       
        var pid = '#pesanan-'+ response.faktur_id;
        $(pid +' .pesanan').html(spinner);
        $(pid +' .status').html(spinner);
        $(pid +' .pembayaran').html(spinner);

        load_pembayaran(pid +' .pesanan',pid +' .status', pid +' .pembayaran', response.faktur_id, function() {load_tooltips();});
        load_data_pembayaran(response.faktur_id);

        createToast(response.title, response.alert);
    });
});

// sunting pembayaran
$(document).on('click','.suntingBayar',function(e){
    var $div = $(this).closest( ".dropdown" ),
        id = $div.attr('data-id');

    $('#nav-sunting').tab('show');
    $('#nav-sunting-tab').attr('data-id', id);

    load_data_suntingPembayaran(id);
    $('#nav-sunting').removeClass('d-none');
});

// 
$(document).on('click','.simpanMe',function(e){
    e.preventDefault();
    e.stopPropagation();

    var t = $(this),
        $form = t.closest('form'),
        datastring = $form.serialize();

    t.prop('disabled', true).html(spinner_btn);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('faktur/simpan_pembayaran') ?>",
        data: datastring,
        dataType: "json",
        success: function(data) {
            // console.log(data);
            if(data.status) {
                $('#nav-cek').tab('show');
                var pid = '#pesanan-'+ data.faktur_id;
                $(pid +' .pesanan').html(spinner);
                $(pid +' .status').html(spinner);
                $(pid +' .pembayaran').html(spinner);

                load_pembayaran(pid +' .pesanan',pid +' .status', pid +' .pembayaran', data.faktur_id, function() {load_tooltips();});
                createToast(data.title, data.alert);
            }
        },
        error: function() {
            createToast('Error', 'Pastikan form diisi dengan benar.');
            t.prop('disabled', false).html('Tambah');
        }
    });
});

// hapus pembayaran
$(document).on('click','.hapusBayar',function(e){
    e.preventDefault();
    var $div = $(this).closest( ".dropdown" ),
        id = $div.attr('data-id');

    $.post("<?php echo site_url('faktur/hapus_pembayaran'); ?>", {
        idpembayaran: id,
    },
    function(response, status){
        var pid = '#pesanan-'+ response.faktur_id;

        $(pid +' .pesanan').html(spinner);
        $(pid +' .status').html(spinner);
        $(pid +' .pembayaran').html(spinner);

        load_pembayaran(pid +' .pesanan',pid +' .status', pid +' .pembayaran', response.faktur_id, function() {load_tooltips();});
        load_data_pembayaran(response.faktur_id);

        createToast(response.title, response.alert);
    });
});
</script>