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

        <div class="container">
        <?php echo validation_errors(); ?>
            <?php echo form_open('', array('class' =>'mb-5'), array('image' => '', 'pengguna_id' => $this->pengguna->_id($_SESSION['username']) )); ?>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            $j = $this->pengguna->_juragan_cs($_SESSION['username'])->result();
                            $option = array(''=> 'Pilih Juragan');
                            foreach ($j as $juragan) {
                                $option[$juragan->id] = $juragan->nama;
                            }
                            echo form_label('Juragan', 'juragan_id');
                            echo form_dropdown('juragan_id', $option, '', array('id' => 'juragan_id','class'=> 'custom-select', 'required' => ''));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            echo form_label('Nama', 'nama');
                            echo form_input(array('name' => 'nama', 'id'=> 'nama', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nama'), set_value('nama'));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <?php
                            echo form_label('Hp/Kontak 1', 'hp1');
                            echo form_input(array('name' => 'hp1', 'id'=> 'hp1', 'class' => 'form-control', 'required' => '', 'pattern' => '^(0[2-9])[0-9]{8,}$', 'placeholder' => '08.............'), set_value('hp1'));
                        ?>
                    </div>
                    <div class="form-group col-sm-4">
                        <?php
                            echo form_label('Hp/Kontak 2', 'hp2');
                            echo form_input(array('name' => 'hp2', 'id'=> 'hp2', 'class' => 'form-control', 'pattern' => '^(0[2-9])[0-9]{8,}$', 'placeholder' => '08............. (opsional)'), set_value('hp2'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php
                        echo form_label('Alamat', 'alamat');
                        echo form_textarea(array('name' => 'alamat', 'rows' => 3, 'id'=> 'alamat', 'class' => 'form-control','required' => '', 'placeholder' => 'alamat lengkap'), set_value('alamat'));
                    ?>
                </div>
                
                <div class="form-group" id="ngok">
                    <label for="kode">Produk dipesan</label>
                    <div class="mb-2 cloning-me" id="dup" data-prod="1">
                        <div class="form-row" id="main-form">
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Kode</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk[1][kode]', 'id'=> 'kode', 'class' => 'form-control kode', 'placeholder' => 'kode', 'required' => 'required'));
                                    ?>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Harga @</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk[1][harga]', 'id'=> 'harga', 'class' => 'form-control calc harga', 'placeholder' => '250000', 'pattern' => '^(?:[1-9]\d*|0)$', 'required' => '', 'type' => 'number', 'min' => '0'), '0');
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
                                    echo form_dropdown('produk[1][ukuran]', $opt, '', array('id' => 'ukuran', 'class'=> 'custom-select ukuran', 'required' => ''));
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-2 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Jumlah</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk[1][jumlah]', 'id'=> 'jumlah', 'class' => 'form-control calc jumlah', 'placeholder' => '1', 'min' => '1', 'pattern' => '^\d+$', 'required' => '', 'type' => 'number'),1);
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-1 mb-2">
                                <button type="button" class="btn btn-success btnAdd"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr/>

                <div class="row">
                    <div class="col-sm-7 mb-3">

                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('Diskon', 'diskon');
                                            echo form_input(array('name' => 'diskon', 'id'=> 'diskon', 'class' => 'form-control diskon calc', 'type' => 'number', 'min' => '0', 'required' => ''), '0');
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('Tarif Ongkir', 'ongkir');
                                            echo form_input(array('name' => 'ongkir', 'id'=> 'ongkir', 'class' => 'form-control ongkir calc', 'type' => 'number', 'min' => '0', 'required' => ''), '0');
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('3 digit angka unik', 'unik');
                                            echo form_input(array('name' => 'unik', 'id'=> 'unik', 'class' => 'form-control unik calc', 'type' => 'number', 'min' => '0','required' => ''), '0');
                                        ?>
                                    </div>
                                </div>
                                <small class="text-muted">3 digit angka unik diisi otomatis, dambil dari 3 digit angka hp terakhir, beri angka 0 jika tidak dibutuhkan</small>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-5 mb-3">
                        <h6>Ulasan Biaya</h6>
                        <div class="lead">
                            <div>Total Harga Produk <span class="float-right total_harga_produk">0</span></div>
                            <div>Tarif Ongkir <span class="float-right tarif_ongkir">0</span></div>
                            <div>Angka Unik <span class="float-right angka_unik">0</span></div>
                            <div>Diskon <span class="float-right total_diskon">0</span></div>
                            <div>Biaya Wajib Dibayar <span class="float-right wajib_dibayar">0</span></div>
                        </div>                        
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-5">
                        <?php echo form_label('Pesanan Marketplace?', 'marketplace_'); ?>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="marketplace_" id="marketplace_">
                                </div>
                            </div>
                            <?php
                            echo form_input(array('class' => 'form-control', 'name' => 'marketplace', 'placeholder' => 'misal: Tokopedia, Shopee, ...', 'disabled' => '', 'required' => ''));
                            ?>
                        </div>
                    </div>
                </div>

                <hr/>

                <div class="custom-control custom-switch mb-2">
                    <?php 
                    $data = array(
                        'name'          => 'pembayaran_',
                        'id'            => 'pembayaran_',
                        'class'         => 'custom-control-input',
                        'checked'       => TRUE,
                        'value'         => 'ya'
                    );
                    
                    echo form_checkbox($data);
                    echo form_label('Menunggu pembayaran/pencairan?', 'pembayaran_', array('class' => 'custom-control-label'));
                    ?>
                </div>

                <div class="card bg-light mb-3 collapse" id="dataPembayaran">
                    <div class="card-body">
                        <div id="multiBayar">
                            <label for="rekening">Data Pembayaran</label>
                            <div class="listPembayaran" id="pembayaranViaTransfer" data-transfer="0">
                                <div class="form-row mb-0 pb-0" id="formTransfer">

                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rek?</span>
                                        </div>
                                        <?php
                                            //echo form_label('Rekening', 'rekening');
                                            echo form_input(array('name' => 'pembayaran[0][rekening]', 'id'=> 'rekening', 'class' => 'form-control rekening bankir', 'placeholder' => 'Cash / Bank','required' => '', 'disabled' => ''));
                                        ?>
                                    </div>

                                    <div class="input-group mb-3 col-sm-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Tggl Bayar</span>
                                        </div>
                                        <?php
                                            //echo form_label('Tanggal Transfer', 'tanggal_transfer');
                                            echo form_input(array('name' => 'pembayaran[0][tanggal]', 'id'=> 'tanggal_transfer', 'class' => 'form-control tanggal_transfer bankir', 'type' => 'date','required' => '', 'disabled' => ''), mdate('%Y-%m-%d', now()));
                                        ?>
                                    </div>
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Jumlah</span>
                                        </div>
                                        <?php
                                            //echo form_label('Jumlah ', 'transfer');
                                            echo form_input(array('name' => 'pembayaran[0][jumlah]', 'id'=> 'jumlah_transfer', 'class' => 'form-control transfer bankir', 'type' => 'number', 'min' => '0','required' => '', 'disabled' => ''), '0');
                                        ?>
                                    </div>
                                    <div class="input-group mb-3 col-sm-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <div class="form-check">
                                                    <?php
                                                    $data = array(
                                                        'name'          => 'pembayaran[0][sudah_cek]',
                                                        'id'            => 'sudah_cek-0',
                                                        'class'         => 'form-check-input sudah_cek mt-2',
                                                        'checked'       => FALSE,
                                                        'value'         => 'ya',
                                                        'disabled'      => ''
                                                    );
                                                    
                                                    echo form_checkbox($data);
                                                    echo form_label('Ada', 'sudah_cek-0', array('class' => 'form-check-label'));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            //echo form_label('Tanggal Transfer', 'tanggal_transfer');
                                            echo form_input(array('name' => 'pembayaran[0][cek]', 'id'=> 'tanggal_cek', 'class' => 'form-control sudah_cek-0 tanggal_cek', 'type' => 'date', 'disabled' => ''));
                                        ?>
                                    </div>
                                    <div class="form-group col-2 col-sm-1">
                                        <?php
                                        echo form_button(array('class' => 'btn btn-success btnAddTransfer bankir', 'content' => '<i class="fas fa-plus"></i>'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <small class="text-muted">Pembayaran DP / Kredit cukup masukkan dana awal, sisanya nanti dapat diperbarui</small>
                    </div>
                </div>

                <hr/>

                <div class="form-group">
                    <?php
                        echo form_label('Keterangan', 'keterangan');
                        echo form_textarea(array('name' => 'keterangan', 'rows' => 3, 'id'=> 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan tambahan'));
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
</script>