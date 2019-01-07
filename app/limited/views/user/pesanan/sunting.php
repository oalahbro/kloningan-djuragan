<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
            <?php echo form_open('', array('class' =>'mb-5'), array('image' => $faktur->gambar, 'id_faktur' => $faktur->id_faktur )); ?>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            $j = $this->pengguna->_juragan_cs($_SESSION['username'])->result();
                            $option = array(''=> 'Pilih Juragan');
                            foreach ($j as $juragan) {
                                $option[$juragan->id] = $juragan->nama;
                            }
                            echo form_label('Juragan', 'juragan_id');
                            echo form_dropdown('juragan_id', $option, $faktur->juragan_id, array('id' => 'juragan_id','class'=> 'custom-select', 'required' => ''));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            echo form_label('Nama', 'nama');
                            echo form_input(array('name' => 'nama', 'id'=> 'nama', 'class' => 'form-control', 'required' => '', 'placeholder' => 'nama'), set_value('nama', $faktur->nama));
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <?php
                            echo form_label('Hp/Kontak 1', 'hp1');
                            echo form_input(array('name' => 'hp1', 'id'=> 'hp1', 'class' => 'form-control', 'required' => '', 'pattern' => '^(0[2-9])[0-9]{8,}$', 'placeholder' => '08.............'), set_value('hp1', $faktur->hp1));
                        ?>
                    </div>
                    <div class="form-group col-sm-4">
                        <?php
                            echo form_label('Hp/Kontak 2', 'hp2');
                            echo form_input(array('name' => 'hp2', 'id'=> 'hp2', 'class' => 'form-control', 'pattern' => '^(0[2-9])[0-9]{8,}$', 'placeholder' => '08............. (opsional)'), set_value('hp2', $faktur->hp2));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php
                        echo form_label('Alamat', 'alamat');
                        echo form_textarea(array('name' => 'alamat', 'rows' => 3, 'id'=> 'alamat', 'class' => 'form-control','required' => '', 'placeholder' => 'alamat lengkap'), set_value('alamat', $faktur->alamat));
                    ?>
                </div>
                
                <div class="form-group" id="ngok">
                    <label for="kode">Produk dipesan</label>
                    <?php 
                    $harga_produk = 0;
                    $produkIndex = 1;
                    $pesan = explode(',', $faktur->produk);
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
                        $harga_produk += $arr_produk[$kunci][2] * $arr_produk[$kunci][3];
                        $produkIndex++;
                    }
                    ?>
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
                                            echo form_input(array('name' => 'diskon', 'id'=> 'diskon', 'class' => 'form-control diskon calc', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('diskon', $faktur->diskon));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('Tarif Ongkir', 'ongkir');
                                            echo form_input(array('name' => 'ongkir', 'id'=> 'ongkir', 'class' => 'form-control ongkir calc', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('ongkir', $faktur->ongkir));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('3 digit angka unik', 'unik');
                                            echo form_input(array('name' => 'unik', 'id'=> 'unik', 'class' => 'form-control unik calc', 'type' => 'number', 'min' => '0','required' => ''), set_value('unik', $faktur->unik));
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
                                    <?php
                                    if($faktur->tipe !== NULL) {
                                        $arr_input = array();
                                        $arr_check = array(
                                            'checked' => TRUE
                                        );
                                    }
                                    else {
                                        $arr_input = array(
                                            'disabled' => ''
                                        );
                                        $arr_check = array(
                                            'checked' => FALSE
                                        );
                                    }

                                    $data_checkbox = array(
                                        'name'          => 'marketplace_',
                                        'id'            => 'marketplace_',
                                        'value'         => 'on'
                                    );

                                    echo form_checkbox(array_merge($data_checkbox, $arr_check));
                                    ?>
                                </div>
                            </div>
                            <?php
                            
                            echo form_input(array_merge(array('class' => 'form-control', 'name' => 'marketplace', 'placeholder' => 'misal: Tokopedia, Shopee, ...', 'required' => ''), $arr_input), set_value('marketplace', $faktur->tipe));
                            ?>
                        </div>
                    </div>
                </div>

                <hr/>

                <div class="custom-control custom-switch mb-2">
                    <?php 
                    if ($faktur->pembayaran !== NULL) {
                        $arr_check_bayar = array(
                            'checked' => FALSE
                        );
                        $cl_byr = 'show';
                        $inpt_act = array(
                        );
                    }
                    else {
                        $arr_check_bayar = array(
                            'checked' => TRUE
                        );
                        $cl_byr = '';
                        $inpt_act = array(
                            'disabled' => ''
                        );
                    }

                    $data_checkbox_bayar = array(
                        'name'          => 'pembayaran_',
                        'id'            => 'pembayaran_',
                        'class'         => 'custom-control-input',
                        'value'         => 'ya'
                    );
                    
                    echo form_checkbox(array_merge($data_checkbox_bayar, $arr_check_bayar));
                    echo form_label('Menunggu pembayaran/pencairan?', 'pembayaran_', array('class' => 'custom-control-label'));
                    ?>
                </div>

                <div class="card bg-light mb-3 collapse <?php echo $cl_byr; ?>" id="dataPembayaran">
                    <div class="card-body">
                        <div id="multiBayar">
                            <label for="rekening">Data Pembayaran</label>
                            <?php 
                            if ($faktur->pembayaran !== NULL) {
                                $bayarIndex = 1;
                                $bayar = explode(',', $faktur->pembayaran);

                                foreach($bayar as $kunci => $str) { 
                                    $arr_bayar[$kunci] = explode('|', $str);
                            ?>
                            <div class="listPembayaran" id="pembayaranViaTransfer" data-transfer="0">
                                <div class="form-row mb-0 pb-0" id="formTransfer">

                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rek?</span>
                                        </div>
                                        <?php
                                            $data_byr_h = array(
                                                'type'  => 'hidden',
                                                'name'  => 'pembayaran['.$bayarIndex.'][id_pembayaran]',
                                                'id'    => 'id_pembayaran',
                                                'value' => $arr_bayar[$kunci][4],
                                            );
                                            
                                            echo form_input($data_byr_h);
                                            echo form_input(array_merge($inpt_act, array('name' => 'pembayaran['.$bayarIndex.'][rekening]', 'id'=> 'rekening', 'class' => 'form-control rekening bankir', 'placeholder' => 'Cash / Bank','required' => '')), set_value('pembayaran['.$bayarIndex.'][rekening]', $arr_bayar[$kunci][0]));
                                        ?>
                                    </div>

                                    <div class="input-group mb-3 col-sm-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Tggl Bayar</span>
                                        </div>
                                        <?php
                                            //echo form_label('Tanggal Transfer', 'tanggal_transfer');
                                            echo form_input(array_merge($inpt_act, array('name' => 'pembayaran['.$bayarIndex.'][tanggal]', 'id'=> 'tanggal_transfer', 'class' => 'form-control tanggal_transfer bankir', 'type' => 'date','required' => '')), mdate('%Y-%m-%d', $arr_bayar[$kunci][2]));
                                        ?>
                                    </div>
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Jumlah</span>
                                        </div>
                                        <?php
                                            //echo form_label('Jumlah ', 'transfer');
                                            echo form_input(array_merge($inpt_act, array('name' => 'pembayaran['.$bayarIndex.'][jumlah]', 'id'=> 'jumlah_transfer', 'class' => 'form-control transfer bankir', 'type' => 'number', 'min' => '0','required' => '')), set_value('pembayaran['.$bayarIndex.'][jumlah]',$arr_bayar[$kunci][1]));
                                        ?>
                                    </div>
                                    <div class="input-group mb-3 col-sm-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <div class="form-check">
                                                    <?php
                                                    $data_ck = array(
                                                        'name'          => 'pembayaran[0][sudah_cek]',
                                                        'id'            => 'sudah_cek-0',
                                                        'class'         => 'form-check-input sudah_cek mt-2',
                                                        'checked'       => FALSE,
                                                        'value'         => 'ya',
                                                        'disabled'      => ''
                                                    );
                                                    
                                                    echo form_checkbox($data_ck);
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
                                            if($bayarIndex === 1) {
                                                echo form_button(array('class' => 'btn btn-success btnAddTransfer bankir', 'content' => '<i class="fas fa-plus"></i>'));
                                            }
                                            else {
                                                echo form_button(array('class' => 'btn btn-outline-danger btnDelTransfer bankir', 'content' => '<i class="fas fa-minus"></i>'));
                                            }
                                            
                                            ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $bayarIndex++;
                                }
                            }
                            else {
                                ?>
                                    <div class="listPembayaran" id="pembayaranViaTransfer" data-transfer="0">
                                        <div class="form-row mb-0 pb-0" id="formTransfer">
    
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rek?</span>
                                                </div>
                                                <?php
                                                    echo form_input(array('name' => 'pembayaran[0][rekening]', 'id'=> 'rekening', 'class' => 'form-control rekening bankir', 'placeholder' => 'Cash / Bank','required' => '', 'disabled' => ''));
                                                ?>
                                            </div>
    
                                            <div class="input-group mb-3 col-sm-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Tggl Bayar</span>
                                                </div>
                                                <?php
                                                    echo form_input(array('name' => 'pembayaran[0][tanggal]', 'id'=> 'tanggal_transfer', 'class' => 'form-control tanggal_transfer bankir', 'type' => 'date','required' => '', 'disabled' => ''), mdate('%Y-%m-%d', now()));
                                                ?>
                                            </div>
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Jumlah</span>
                                                </div>
                                                <?php
                                                    echo form_input(array('name' => 'pembayaran[0][jumlah]', 'id'=> 'jumlah_transfer', 'class' => 'form-control transfer bankir', 'type' => 'number', 'min' => '0','required' => '', 'disabled' => ''), '0');
                                                ?>
                                            </div>
                                            <div class="input-group mb-3 col-sm-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <div class="form-check">
                                                            <?php
                                                            $data_ck = array(
                                                                'name'          => 'pembayaran[0][sudah_cek]',
                                                                'id'            => 'sudah_cek-0',
                                                                'class'         => 'form-check-input sudah_cek mt-2',
                                                                'checked'       => FALSE,
                                                                'value'         => 'ya',
                                                                'disabled'      => ''
                                                            );
    
                                                            $arr_by_cek = array();
                                                            $arr_by_cek_input = array();
                                                            
    
                                                            echo form_checkbox(array_merge($data_ck, $arr_by_cek));
                                                            echo form_label('Cek', 'sudah_cek-0', array('class' => 'form-check-label'));
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    echo form_input(array_merge($arr_by_cek_input,array('name' => 'pembayaran[0][cek]', 'id'=> 'tanggal_cek', 'class' => 'form-control tanggal_cek sudah_cek-0', 'type' => 'date', 'disabled' => '')), mdate('%Y-%m-%d', now()));
                                                ?>
                                            </div>
                                            <div class="form-group col-2 col-sm-1">
                                                <?php
                                                    echo form_button(array('class' => 'btn btn-success btnAddTransfer bankir', 'content' => '<i class="fas fa-plus"></i>'));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                        </div>
                        <small class="text-muted">Pembayaran DP / Kredit cukup masukkan dana awal, sisanya nanti dapat diperbarui</small>
                    </div>
                </div>

                <hr/>

                <div class="form-group">
                    <?php
                        echo form_label('Keterangan', 'keterangan');
                        echo form_textarea(array('name' => 'keterangan', 'rows' => 3, 'id'=> 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan tambahan'), set_value('keterangan', $faktur->keterangan));
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