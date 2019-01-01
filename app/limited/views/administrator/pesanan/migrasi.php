<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$pesanan = $this->pesanan->ambil_satu()->row();
?>

    <div class="konten" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><?php echo $judul; ?></h1>
                <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
            </div>
        </div>

<?php

print('<pre>');
print_r($pesanan);
print('</pre>');

$buyer = json_decode( $pesanan->pemesan );
$detail = json_decode( $pesanan->detail );
$biaya = json_decode( $pesanan->biaya );
?>
        <div class="container">
        <?php echo validation_errors(); ?>
            <?php echo form_open('', array('class' =>'mb-5'), array('image' => (isset($detail->i) ? json_encode($detail->i) : ''), 'tanggal_dibuat' => $pesanan->tanggal_submit, 'slug' => $pesanan->slug)); ?>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            $det_jur = $this->juragan->_detail($pesanan->juragan)->row();

                            $short = $det_jur->short;

                            $faktur = $short . mdate('%y%m%d%H%i%s', $pesanan->tanggal_submit);

                            echo form_label('Faktur', 'faktur');
                            echo form_input(array('name' => 'faktur', 'id'=> 'faktur', 'class' => 'form-control', 'required' => ''), set_value('faktur', $faktur));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            $j = $this->juragan->_semua()->result();
                            $option = array(''=> 'Pilih Juragan');
                            foreach ($j as $juragan) {
                                $option[$juragan->id] = $juragan->nama;
                            }
                            echo form_label('Juragan', 'juragan_id');
                            echo form_dropdown('juragan_id', $option, $pesanan->juragan, array('id' => 'juragan_id','class'=> 'custom-select', 'required' => ''));
                            // echo form_input(array('name' => 'nama', 'id'=> 'nama', 'class' => 'form-control'));
                        ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?php
                            $j = $this->pengguna->_semua(TRUE)->result();
                            $option = array(''=> 'Pilih CS');
                            foreach ($j as $pengguna) {
                                if ($pengguna->level === 'cs') {
                                    $option[$pengguna->id] = $pengguna->nama;
                                }
                            }
                            echo form_label('CS', 'pengguna_id');
                            echo form_dropdown('pengguna_id', $option, $pesanan->oleh, array('id' => 'pengguna_id', 'class'=> 'custom-select', 'required' => ''), set_value('pengguna_id', $pesanan->oleh));
                            // echo form_input(array('name' => 'nama', 'id'=> 'nama', 'class' => 'form-control'));
                        ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            echo form_label('Nama', 'nama');
                            echo form_input(array('name' => 'nama', 'id'=> 'nama', 'class' => 'form-control', 'required' => ''), set_value('nama', $buyer->n));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <?php
                            echo form_label('Hp/Kontak 1', 'hp1');
                            echo form_input(array('name' => 'hp1', 'id'=> 'hp1', 'class' => 'form-control', 'required' => '', 'pattern' => '^(0[2-9])[0-9]{8,}$'), set_value('nama', $buyer->p[0]));
                        ?>
                    </div>
                    <div class="form-group col-sm-4">
                        <?php
                            echo form_label('Hp/Kontak 2', 'hp2');
                            echo form_input(array('name' => 'hp2', 'id'=> 'hp2', 'class' => 'form-control', 'pattern' => '^(0[2-9])[0-9]{8,}$'),set_value('nama', (isset($buyer->p[1])? $buyer->p[1]:'') ));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php
                        echo form_label('Alamat', 'alamat');
                        echo form_textarea(array('name' => 'alamat', 'rows' => 3, 'id'=> 'alamat', 'class' => 'form-control','required' => '', 'placeholder' => 'alamat lengkap'),set_value('nama', $buyer->a));
                    ?>
                </div>
                
                <div class="form-group" id="ngok">
                    <label for="kode">Produk dipesan</label>
                    <?php 
                    $p = 1;
                    foreach ($detail->p as $produk) {
                    ?>
                    <div class="mb-2 cloning-me" id="dup" data-prod="<?php echo $p; ?>">
                        <div class="form-row" id="main-form">
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Kode</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk['.$p.'][kode]', 'id'=> 'kode', 'class' => 'form-control kode', 'placeholder' => 'kode', 'required' => 'required'), set_value('produk['.$p.'][kode]', $produk->c));
                                    ?>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Harga @</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk['.$p.'][harga]', 'id'=> 'harga', 'class' => 'form-control calc harga', 'placeholder' => '250000', 'pattern' => '^(?:[1-9]\d*|0)$', 'required' => '', 'type' => 'number', 'min' => '0'), set_value('produk['.$p.'][kode]', $produk->h));
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Ukuran</span></div>
                                    <?php
                                    $opt = array('' => '-- pilih ukuran --');
                                    $size_j = json_decode($this->config->item("list_size"), true);

                                    foreach ($size_j as $key ) {
                                        $opt[$key] = $key;
                                    }
                                    echo form_dropdown('produk['.$p.'][ukuran]', $opt, $produk->s, array('id' => 'ukuran', 'class'=> 'custom-select ukuran', 'required' => ''));
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-2 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Jumlah</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk['.$p.'][jumlah]', 'id'=> 'jumlah', 'class' => 'form-control calc jumlah', 'placeholder' => '1', 'min' => '1', 'pattern' => '^\d+$', 'required' => '', 'type' => 'number'), set_value('produk['.$p.'][kode]', $produk->q));
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-1 mb-2">
                                <button type="button" class="btn btn-success btnAdd"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php
                    $p++;
                    }
                    ?>
                </div>

                <hr/>
                <div class="row">
                    <div class="col-sm-5">

                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('Diskon', 'diskon');
                                            echo form_input(array('name' => 'diskon', 'id'=> 'diskon', 'class' => 'form-control diskon', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('diskon',(isset($biaya->m->d) ? $biaya->m->d: 0 )));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('Tarif Ongkir', 'ongkir');
                                            echo form_input(array('name' => 'ongkir', 'id'=> 'ongkir', 'class' => 'form-control ongkir', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('ongkir', (isset($biaya->m->o) ? $biaya->m->o: 0 )));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('3 digit angka unik', 'unik');
                                            echo form_input(array('name' => 'unik', 'id'=> 'unik', 'class' => 'form-control unik', 'type' => 'number', 'min' => '0','required' => ''), (isset($biaya->m->u) ? $biaya->m->u: 0 ));
                                        ?>
                                    </div>
                                </div>
                                <small class="text-muted">3 digit angka unik diisi otomatis, dambil dari 3 digit angka hp terakhir, beri angka 0 jika tidak dibutuhkan</small>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="Lead total_harga_produk" ></div>

                        <div class="card bg-light border-primary">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <?php echo form_label('Pesanan Marketplace?', 'nama'); ?>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" name="marketplace_">
                                                </div>
                                            </div>
                                            <input type="text" disabled="" placeholder="misal: Tokopedia, Shopee,..." name="marketplace" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div id="multiBayar">
                                    <label for="rekening">Pembayaran via transfer / cash</label>
                                    <div class="listPembayaran" id="pembayaranViaTransfer" data-transfer="0">
                                        <div class="form-row mb-0 pb-0" id="formTransfer">
                                            <div class="form-group col">
                                                <?php
                                                    //echo form_label('Rekening', 'rekening');
                                                    echo form_input(array('name' => 'pembayaran[0][rekening]', 'id'=> 'rekening', 'class' => 'form-control rekening bankir', 'placeholder' => 'Cash / Bank','required' => ''), set_value('pembayaran[0][rekening]', $biaya->b));
                                                ?>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <?php
                                                    //echo form_label('Tanggal Transfer', 'tanggal_transfer');
                                                    echo form_input(array('name' => 'pembayaran[0][tanggal]', 'id'=> 'tanggal_transfer', 'class' => 'form-control tanggal_transfer bankir', 'type' => 'date','required' => ''), mdate('%Y-%m-%d', $pesanan->tanggal_submit));
                                                ?>
                                            </div>
                                            <div class="form-group col">
                                                <?php
                                                    //echo form_label('Jumlah ', 'transfer');
                                                    echo form_input(array('name' => 'pembayaran[0][jumlah]', 'id'=> 'jumlah_transfer', 'class' => 'form-control transfer bankir', 'type' => 'number', 'min' => '0','required' => ''), set_value('pembayaran[0][jumlah]', ($biaya->m->t === NULL? '0': $biaya->m->t)));
                                                ?>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <?php
                                                    //echo form_label('Tanggal Transfer', 'tanggal_transfer');
                                                    echo form_input(array('name' => 'pembayaran[0][cek]', 'id'=> 'tanggal_cek', 'class' => 'form-control tanggal_cek bankir', 'type' => 'date'), set_value('pembayaran[0][cek]', ($pesanan->tanggal_cek_transfer === NULL? '': mdate('%Y-%m-%d', $pesanan->tanggal_cek_transfer) )));
                                                ?>
                                            </div>
                                            <div class="form-group col-2 col-sm-1">
                                                <?php
                                                echo form_button(array('class' => 'btn btn-success btnAddTransfer btn-block bankir', 'content' => '<i class="fas fa-plus"></i>'));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="terkirim" id="inlineRadio1" value="b_dikirim">
                    <label class="form-check-label" for="inlineRadio1">dikirim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="terkirim" id="inlineRadio2" value="c_diambil">
                    <label class="form-check-label" for="inlineRadio2">diambil</label>
                </div>
               
                <div id="multiKirim">
                    <label for="rekening">Pengiriman</label>
                    <div class="listPengiriman" id="pengiriman" data-kirim="0">
                        <div class="form-row mb-0 pb-0" id="formKirim">
                            <div class="form-group col">
                                <?php
                                    //echo form_label('Rekening', 'rekening');
                                    echo form_input(array('name' => 'pengiriman[0][kurir]', 'id'=> 'kurir', 'class' => 'form-control rekening senter', 'placeholder' => 'kurir','required' => ''), set_value('pengiriman[0][rekening]', $detail->s->k));
                                ?>
                            </div>
                            <div class="form-group col-sm-3">
                                <?php
                                    //echo form_label('Tanggal Transfer', 'tanggal_transfer');
                                    echo form_input(array('name' => 'pengiriman[0][resi]', 'id'=> 'resi', 'class' => 'form-control tanggal_transfer senter', 'required' => ''), set_value('pengiriman[0][resi]', $detail->s->n) );
                                ?>
                            </div>
                            <div class="form-group col">
                                <?php
                                    //echo form_label('Jumlah ', 'transfer');
                                    echo form_input(array('name' => 'pengiriman[0][ongkir]', 'id'=> 'ongkir', 'class' => 'form-control transfer senter', 'type' => 'number', 'min' => '0','required' => ''), set_value('pengiriman[0][ongkir]', (isset($biaya->m->of)? $biaya->m->of: '0')));
                                ?>
                            </div>
                            <div class="form-group col-sm-3">
                                <?php
                                    //echo form_label('Tanggal Transfer', 'tanggal_transfer');
                                    echo form_input(array('name' => 'pengiriman[0][tanggal_kirim]', 'id'=> 'tanggal_kirim', 'class' => 'form-control tanggal_kirim senter', 'type' => 'date'), set_value('pengiriman[0][tanggal_kirim]', ($pesanan->tanggal_cek_kirim === NULL? '': mdate('%Y-%m-%d', $pesanan->tanggal_cek_kirim) )));
                                ?>
                            </div>
                            <div class="form-group col-2 col-sm-1">
                                <?php
                                echo form_button(array('class' => 'btn btn-success btnAddKirim btn-block senter', 'content' => '<i class="fas fa-plus"></i>'));
                                ?>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <hr/>

                <div class="form-group">
                    <?php
                        echo form_label('Keterangan', 'keterangan');
                        echo form_textarea(array('name' => 'keterangan', 'rows' => 3, 'id'=> 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan tambahan'), $detail->n);
                    ?>
                </div>

                <div class="form-group">
                    <label for="customgambar">Custom Gambar</label>
                    <div class="tombol-picker">
                        <button type="button" class="btn btn-dark" id="DOCS_IMAGES">Pilih / Unggah Gambar</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody id="result"></tbody>
                        </table>
                    </div>
                </div>

                <hr/>
                <button type="submit" class="btn btn-primary">Submit</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

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



     // pembayaran multiple via transfer
     var ti = $("#multiKirim .listPembayaran").length;
        $(document).on("click", ".btnAddKirim", function(e){
            e.preventDefault();
            ti++;
            var clone = $('#pengiriman').clone('#formKirim');

            clone.attr('data-kirim', ti);

            clone.find("#kurir").attr({name: 'pengiriman['+ti+'][kurir]', id: 'kurir-'+ti}).val('');
            clone.find("#resi").attr({name: 'pengiriman['+ti+'][resi]', id: 'resi-'+ti}).val('');
            clone.find("#ongkir").attr({name: 'pengiriman['+ti+'][ongkir]', id: 'ongkir-'+ti}).val('0');
            clone.find("#tanggal_kirim").attr({name: 'pengiriman['+ti+'][tanggal_kirim]', id: 'tanggal_kirim-'+ti}).val("<?php echo mdate('%Y-%m-%d', now()); ?>");

            $('#multiKirim').append(clone);

            $('[data-kirim="'+ti+'"] .btnAddKirim').replaceWith( '<button type="button" class="btn btn-outline-danger senter btn-block btnDelKirim"><i class="fas fa-minus"></i></button>' );
        });
</script>