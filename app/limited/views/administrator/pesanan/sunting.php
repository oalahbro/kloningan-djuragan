<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$pesanan = $q->row();
?>
    <div class="konten" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><?php echo $judul; ?></h1>
                <p class="lead"><?php echo $sub_judul; ?></p>
            </div>
        </div>

        <div class="container">
        <?php echo validation_errors(); ?>
            <?php echo form_open('', array('class' =>'mb-5'), array('image' => '', 'id_faktur' => $pesanan->id_faktur)); ?>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            $j = $this->juragan->_semua()->result();
                            $option = array(''=> 'Pilih Juragan');
                            foreach ($j as $juragan) {
                                $option[$juragan->id] = $juragan->nama;
                            }
                            echo form_label('Juragan', 'juragan_id');
                            echo form_dropdown('juragan_id', $option, $pesanan->juragan_id, array('id' => 'juragan_id','class'=> 'custom-select', 'required' => ''));
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
                            echo form_dropdown('pengguna_id', $option, $pesanan->pengguna_id, array('id' => 'pengguna_id', 'class'=> 'custom-select', 'required' => ''));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            echo form_label('Nama', 'nama');
                            echo form_input(array('name' => 'nama', 'id'=> 'nama', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nama'), set_value('nama', $pesanan->nama));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <?php
                            echo form_label('Hp/Kontak 1', 'hp1');
                            echo form_input(array('name' => 'hp1', 'id'=> 'hp1', 'class' => 'form-control', 'required' => '', 'pattern' => '^(0[2-9])[0-9]{8,}$', 'placeholder' => '08...........'), set_value('hp1', $pesanan->hp1));
                        ?>
                    </div>
                    <div class="form-group col-sm-4">
                        <?php
                            echo form_label('Hp/Kontak 2', 'hp2');
                            echo form_input(array('name' => 'hp2', 'id'=> 'hp2', 'class' => 'form-control', 'pattern' => '^(0[2-9])[0-9]{8,}$', 'placeholder' => '08...........'), set_value('hp1', $pesanan->hp2));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php
                        echo form_label('Alamat', 'alamat');
                        echo form_textarea(array('name' => 'alamat', 'rows' => 3, 'id'=> 'alamat', 'class' => 'form-control','required' => '', 'placeholder' => 'alamat lengkap'), set_value('hp2', $pesanan->alamat));
                    ?>
                </div>
                
                <div class="form-group" id="ngok">
                    <label for="kode">Produk dipesan</label>
                    <?php 
                    $produkIndex = 1;
                    $pesan = explode(',', $pesanan->produk);
                    foreach($pesan as $kunci => $str) { 
                        $arr_produk[$kunci] = explode('|', $str);
                    ?>
                    <div class="mb-2 cloning-me" id="dup" data-prod="<?php echo $produkIndex; ?>">
                        <div class="form-row" id="main-form">
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Kode</span></div>
                                    <?php
                                        echo form_hidden('produk['.$produkIndex.'][id_pesanproduk]', $arr_produk[$kunci][4]);
                                        echo form_input(array('name' => 'produk['.$produkIndex.'][kode]', 'id'=> 'kode-' . $produkIndex, 'class' => 'form-control kode', 'placeholder' => 'kode', 'required' => 'required'), set_value('', $arr_produk[$kunci][0]));
                                    ?>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Harga @</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk['.$produkIndex.'][harga]', 'id'=> 'harga-' . $produkIndex, 'class' => 'form-control calc harga', 'placeholder' => '250000', 'pattern' => '^(?:[1-9]\d*|0)$', 'required' => '', 'type' => 'number', 'min' => '0'), set_value('', $arr_produk[$kunci][3]));
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

                                    echo form_dropdown('produk['.$produkIndex.'][ukuran]', $opt, $arr_produk[$kunci][1], array('id' => 'ukuran-' . $produkIndex, 'class'=> 'custom-select ukuran', 'required' => ''));
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-2 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Jumlah</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk['.$produkIndex.'][jumlah]', 'id'=> 'jumlah-' . $produkIndex, 'class' => 'form-control calc jumlah', 'placeholder' => '1', 'min' => '1', 'pattern' => '^\d+$', 'required' => '', 'type' => 'number'), set_value('produk['.$produkIndex.'][jumlah]', $arr_produk[$kunci][2]));
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-1 mb-2">
                                <?php
                                if ($produkIndex === 1) { ?>
                                    <button type="button" class="btn btn-success btnAdd"><i class="fas fa-plus"></i></button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-outline-danger btnDel"><i class="fas fa-minus"></i></button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $produkIndex++;
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
                                            echo form_input(array('name' => 'diskon', 'id'=> 'diskon', 'class' => 'form-control diskon', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('diskon', $pesanan->diskon));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('Tariff Ongkir', 'ongkir');
                                            echo form_input(array('name' => 'ongkir', 'id'=> 'ongkir', 'class' => 'form-control ongkir', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('ongkir', $pesanan->ongkir));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('3 digit angka unik', 'unik');
                                            echo form_input(array('name' => 'unik', 'id'=> 'unik', 'class' => 'form-control unik', 'type' => 'number', 'min' => '0','required' => ''), set_value('unik', $pesanan->unik));
                                        ?>
                                    </div>
                                </div>
                                <small class="text-muted">3 digit angka unik diisi otomatis, dambil dari 3 digit angka hp terakhir, beri angka 0 jika tidak dibutuhkan</small>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-sm-7">
                        <div class="card bg-light border-primary">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <?php echo form_label('Pesanan Marketplace?', 'nama'); ?>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <?php echo form_checkbox('marketplace_', 'on', ($pesanan->tipe !== NULL? TRUE: FALSE)); ?>
                                                </div>
                                            </div>
                                            <?php
                                                $dis = array();
                                                if($pesanan->tipe === NULL) {
                                                    $dis = array('disabled' => '');
                                                }
                                                echo form_input(array_merge(array('name' => 'marketplace', 'class' => 'form-control', 'placeholder' => 'misal: Tokopedia, Shopee,...','required' => ''), $dis ), set_value('marketplace', $pesanan->tipe));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted">Untuk merubah data pembayaran, langsung dihalaman/tabel utama ya :)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr/>

                <div class="form-group">
                    <?php
                        echo form_label('Keterangan', 'keterangan');
                        echo form_textarea(array('name' => 'keterangan', 'rows' => 3, 'id'=> 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan tambahan'), set_value('keterangan', $pesanan->keterangan));
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