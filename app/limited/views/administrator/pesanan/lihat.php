<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="konten" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><?php echo $judul; ?></h1>
                <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
            </div>
        </div>

        <div class="px-sm-3">
            <?php 
                echo form_open('', array('class' => 'form-inline px-3 px-sm-0', 'method' => 'get'));
                // form pembayaran
                $opsi_pembayaran = array(
                    ''              => 'Opsi Pembayaran',
                    'belum_transfer' => 'Belum Lunas',
                    'b_menunggu'    => 'Menuggu Konfirmasi',
                    'c_sebagian'    => 'Sebagian Lunas / Kredit',
                    'd_lunas'       => 'Lunas',
                    'e_lebih'       => 'Ada Kelebihan'
                );
                echo form_dropdown('cari[pembayaran]', $opsi_pembayaran, $this->input->get('cari[pembayaran]'), array('class' => 'custom-select mb-2 mr-sm-2'));
                
                // form paket
                $opsi_paket = array(
                    ''              => 'Opsi Paket',
                    'diproses'      => 'Diproses',
                    'belum_diproses' => 'Belum Diproses',
                );

                echo form_dropdown('cari[paket]', $opsi_paket, $this->input->get('cari[paket]'), array('class' => 'custom-select mb-2 mr-sm-2'));
                
                // form pengiriman
                $opsi_pengiriman = array(
                    ''              => 'Opsi Pengiriman',
                    'belum_kirim'   => 'Belum Dikirim',
                    'd_sebagian'    => 'Dikirim Sebagian',
                    'dikirim'       => 'Dikirim',
                );

                echo form_dropdown('cari[pengiriman]', $opsi_pengiriman, $this->input->get('cari[pengiriman]'), array('class' => 'custom-select mb-2 mr-sm-2'));
                ?>

                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend"> 
                        <div class="input-group-text"> 
                            <?php 
                            if( $this->input->get('cari[cek_tanggal]') === 'ya' ) {
                                $check_ = TRUE;
                                $disable_ = array();
                            }
                            else {
                                $check_ = FALSE;
                                $disable_ = array('disabled' => '');
                            }

                            echo form_checkbox('cari[cek_tanggal]', 'ya', $check_);

                            $val_tgl = $this->input->get('cari[tanggal]');
                            if( ! isset($val_tgl)) {
                                $val_tgl = mdate('%Y-%m-%d', now());
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                        echo form_input(array_merge(array('class' => 'form-control', 'type' => 'date','name' => 'cari[tanggal]', 'placeholder' => 'tanggal data masuk'), $disable_), $val_tgl);
                    ?>
                </div>

                <div class="form-check mb-2 mr-sm-2">
                    <?php
                     if( $this->input->get('cari[marketplace]') === 'ya' ) {
                        $check_m = TRUE;
                    }
                    else {
                        $check_m = FALSE;
                    }
                    echo form_checkbox('cari[marketplace]', 'ya', $check_m, array('class' => 'form-check-input', 'id' => 'marketplace' ));
                    echo form_label('Marketplace?', 'marketplace');
                    ?>
                </div>

                <?php
                    echo form_input(array('class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'cari data','name' => 'cari[q]'), $this->input->get('cari[q]'));
                ?>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            <?php echo form_close(); ?>
            <div id="main-table">
                <div class="table-responsive" id="table-pesanan">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 120px">Faktur #</th>
                                <th style="width: 120px">Juragan</th>
                                <th style="width: 160px">Status</th>
                                <th>Pemesan</th>
                                <th style="width: 200px">Pesanan</th>
                                <th style="width: 240px">Biaya</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($query->num_rows() > 0) { ?>
                                <?php foreach ($query->result() as $pesanan) { 
                                ?>
                                <tr id="pesanan-<?php echo $pesanan->id_faktur; ?>">
                                    <td>
                                        <?php 
                                        echo strtoupper($pesanan->seri_faktur);
                                        echo '<span class="d-block"><abbr title="'.unix_to_human($pesanan->tanggal_dibuat).'"><i class="fas fa-calendar-day"></i> ' . mdate('%d-%M-%y', $pesanan->tanggal_dibuat) . '</abbr></span>';
                                        ?>
                                    </td>
                                    <td class="juragan">
                                        <div class="text-center">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="status">
                                        <div class="text-center">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        echo '<span class="font-weight-bold">' . strtoupper( $pesanan->nama ) . '</span><br/>';
                                        echo '<span class="badge badge-dark">' . $pesanan->hp1 . '</span>' . ($pesanan->hp2 !== NULL? '<span class="sr-only"> / </span><span class="ml-1 badge badge-dark">' . $pesanan->hp2 . '</span>': '') . '<br/>';
                                        echo nl2br(strtoupper($pesanan->alamat));
                                        ?>
                                    </td>
                                    <td class="pesanan">
                                        <div class="text-center">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>                                  
                                    </td>
                                    <td class="pembayaran">
                                        <div class="text-center">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="keterangan">
                                        <div class="text-center">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" class="table-warning text-center">Data tidak ada</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<script>
///////////////////////
var row = $( "#main-table tbody tr" );

var i = 0; // the index we're using
var cmd; // basically a var just so we don't have to keep calling cmd_files[i]
var totalCommands = row.length; // basically how many iterations to do

function sendNextCommand(i, callback) {
    if (i >= totalCommands) return; // end it if it's done
    cmd = row.eq( i ); // again, just so we don't have to keep calling cmd_files[i]
    var pid = $( cmd ).attr('id');
    var id = pid.split('-');
    var url = "<?php echo site_url('admin/faktur') ?>/";
    var tipe = '';

    // do ajax
    load_juragan('#'+pid +' .juragan', id[1], function() {
        i++;
        sendNextCommand(i, function(){});
    });    
    load_pembayaran('#'+pid +' .pesanan','#'+pid +' .status', '#'+pid +' .pembayaran', id[1], function() {});
    load_keterangan('#'+pid +' .keterangan', id[1]);
    
}

sendNextCommand(0, function(){}); // start the first iteration manually

function load_juragan(el, id, callback) {
    var url = "<?php echo site_url() ?>/",
        json_url = url + 'admin/faktur/json_juragan/' + id;

    $.getJSON(json_url, function( b ) {
        var juragan = '<a href="' + url + 'pesanan/' + b.slug + '">'+ b.nama +'</a>';
        var pengguna = '<hr/><span class="text-muted small">CS: ' + b.nama_cs + '</span>';

        $(el).empty().append( juragan + pengguna );
        $(document).find('[data-toggle="tooltip"]').tooltip();
        callback();
    });
}

function load_pembayaran(el1, el2, el3, id, callback) {
    var url = "<?php echo site_url('admin/faktur/json_pembayaran') ?>/" + id;

    $.getJSON(url, function( b ) {
        var unik='',
            ongkir='',
            diskon='',
            tipe = '',
            terbayar = ''
            produk = '';
            
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

        var stt_btn = '<div class="mn" data-kurang="0" data-faktur="'+b.seri_faktur+'" data-id="'+b.id_faktur+'">',
            $c_trf, $a_trf, $i_trf, $t_trf,
            $c_pkt, $i_pkt, $mi_pkt, $t_pkt, $a_krm, $s_pkt;

            // status transfer
            switch (b.status_transfer) {
                case "3":
                    // sudah lunas
                    $c_trf = 'text-success';
                    $a_trf = 'cek_pembayaran';
                    $i_trf = 'fa-check-double';
                    $t_trf = 'Pembayaran Lunas';
                    break;
                case "4":
                    // sudah lunas dan mempunyai kelebihan
                    $c_trf = 'text-info';
                    $a_trf = 'cek_pembayaran';
                    $i_trf = 'fa-plus';
                    $t_trf = 'Pembayaran Lunas & memiliki kelebihan';
                    break;
                case "2":
                    // belum lunas / dp yang dibayarkan sudah ada
                    $c_trf = 'text-warning';
                    $a_trf = 'cek_pembayaran';
                    $i_trf = 'fa-ellipsis-h';
                    $t_trf = 'Pembayaran belum lunas';
                    break;
                case "1":
                    // pembayaran lanjutan dp perlu dicek
                    $c_trf = 'text-primary';
                    $a_trf = 'cek_pembayaran';
                    $i_trf = 'fa-redo fa-spin';
                    $t_trf = 'Pembayaran ada yang perlu dicek';
                    break;
                default:
                    // belum ada
                    $c_trf = 'text-danger';
                    $a_trf = 'tambah_pembayaran';
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
        $(document).find('[data-toggle="tooltip"]').tooltip();
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
                keterangan += '<p>' +k.ket+ '</p>';
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
        $(document).find('[data-toggle="tooltip"]').tooltip();
    })
}
</script>