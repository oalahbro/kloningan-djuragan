<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$pesanan = $q->row();
?>

<?php echo $this->load->view("_inc/header", $judul, TRUE) ?>
<?php echo $this->load->view("admin/_inc/navbar", '', TRUE) ?>

    <div class="konten" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3 class="display-4"><?php echo $judul; ?></h3>
                <p class="lead"><?php echo $sub_judul; ?></p>
            </div>
        </div>

        <div class="container">
        <?php echo validation_errors(); ?>
            <?php echo form_open('', array('class' =>'mb-5'), array('id_faktur' => $pesanan->id_faktur, 'image' => '', 'tanggal_paket' => $pesanan->tanggal_paket, 'waktu_dibuat' => mdate('%H:%i:%s', $pesanan->tanggal_dibuat))); ?>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?php
                            echo form_label('Tanggal', 'tanggal_dibuat');
                            echo form_input(array('name' => 'tanggal_dibuat', 'id'=> 'tanggal_dibuat', 'type' => 'date', 'class' => 'form-control', 'required' => ''), set_value('tanggal_dibuat', mdate('%Y-%m-%d', $pesanan->tanggal_dibuat)));
                        ?>
                    </div>
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
                            echo form_input(array('name' => 'hp2', 'id'=> 'hp2', 'class' => 'form-control calc', 'pattern' => '^(0[2-9])[0-9]{8,}$', 'placeholder' => '08...........'), set_value('hp1', $pesanan->hp2));
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
                    $harga_produk = 0;
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
                                            echo form_input(array('name' => 'diskon', 'id'=> 'diskon', 'class' => 'form-control diskon calc', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('diskon', (!isset($pesanan->diskon)? 0: $pesanan->diskon)));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('Tarif Ongkir', 'ongkir');
                                            echo form_input(array('name' => 'ongkir', 'id'=> 'ongkir', 'class' => 'form-control ongkir calc', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('ongkir', (!isset($pesanan->ongkir)? 0: $pesanan->ongkir)));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('3 digit angka unik', 'unik');
                                            echo form_input(array('name' => 'unik', 'id'=> 'unik', 'class' => 'form-control unik calc', 'type' => 'number', 'min' => '0','required' => ''), set_value('unik', (!isset($pesanan->unik)? 0: $pesanan->unik)));
                                        ?>
                                    </div>
                                </div>
                                <small class="text-muted">3 digit angka unik diisi otomatis, dambil dari 3 digit angka hp terakhir,<br/>beri nilai 0 jika tidak dibutuhkan</small>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-5 mb-3">
                        <h6>Ulasan Biaya</h6>
                        <div class="lead">
                            <div>Total Harga Produk <span class="float-right total_harga_produk"><?php echo harga($harga_produk); ?></span></div>
                            <div>Tarif Ongkir <span class="float-right tarif_ongkir"><?php echo harga($pesanan->ongkir); ?></span></div>
                            <div>Angka Unik <span class="float-right angka_unik"><?php echo harga($pesanan->unik); ?></span></div>
                            <div>Diskon <span class="float-right total_diskon"><?php echo harga($pesanan->diskon); ?></span></div>
                            <div>Biaya Wajib Dibayar <span class="float-right wajib_dibayar"><?php echo harga($harga_produk + $pesanan->ongkir + $pesanan->unik - $pesanan->diskon) ?></span></div>
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
                                    $data = array(
                                        'name'          => 'marketplace_',
                                        'id'            => 'marketplace_',
                                        'value'         => 'on',
                                        'checked'       => ($pesanan->tipe !== NULL? TRUE: FALSE ),
                                    );
                                    
                                    echo form_checkbox($data);
                                    ?>
                                </div>
                            </div>
                            <?php
                            $arr = array();
                            if ($pesanan->tipe === NULL) {
                                $arr = array('disabled' => '');
                            }
                            echo form_input(array_merge(array('class' => 'form-control', 'name' => 'marketplace', 'placeholder' => 'misal: Tokopedia, Shopee, ...', 'required' => ''), $arr), $pesanan->tipe);
                            ?>
                        </div>
                    </div>

                    <div class="form-group col-sm-3">
                        <?php echo form_label('Status Paket', 'status_paket'); ?>
                            <?php
                            $opsi_paket_ = array(
                                '0' => 'Belum Diproses',
                                '1' => 'Diproses',
                                '2' => 'Dibatalkan'
                            );
                            
                            echo form_dropdown('status_paket', $opsi_paket_, $pesanan->status_paket, array('class' => 'custom-select', 'id' => 'status_paket'));
                            ?>
                    </div>                
                </div>
                
                <div class="custom-control custom-switch mb-2">
                    <?php 
                    $data_c = array(
                        'name'          => 'pembayaran_',
                        'id'            => 'pembayaran_',
                        'class'         => 'custom-control-input',
                        'value'         => 'ya'
                    );

                    $arr_tr = array('checked' => FALSE);
                    if ($pesanan->status_transfer === '0') {
                        $arr_tr = array('checked' => TRUE);
                    } 
                    
                    echo form_checkbox(array_merge($data_c, $arr_tr));
                    echo form_label('Menunggu pembayaran/pencairan?', 'pembayaran_', array('class' => 'custom-control-label'));
                    ?>
                </div>

                <div class="card bg-light mb-3 collapse <?php echo ($pesanan->status_transfer === '0'? '': 'show') ?>" id="dataPembayaran">
                    <div class="card-body">
                        <div id="multiBayar">
                            <label for="rekening">Data Pembayaran</label>
                            <?php 
                            if ($pesanan->pembayaran !== NULL) {
                                $bayarIndex = 1;
                                $bayar = explode(',', $pesanan->pembayaran);

                                foreach($bayar as $kunci => $str) { 
                                    $arr_bayar[$kunci] = explode('|', $str);
                                ?>
                                <div class="listPembayaran" id="pembayaranViaTransfer" data-transfer="<?php echo $bayarIndex; ?>">
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
                                                echo form_input(array('name' => 'pembayaran['.$bayarIndex.'][rekening]', 'id'=> 'rekening', 'class' => 'form-control rekening bankir', 'placeholder' => 'Cash / Bank','required' => ''), $arr_bayar[$kunci][0]);
                                            ?>
                                        </div>

                                        <div class="input-group mb-3 col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Tggl Bayar</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pembayaran['.$bayarIndex.'][tanggal]', 'id'=> 'tanggal_transfer', 'class' => 'form-control tanggal_transfer bankir', 'type' => 'date','required' => ''), mdate('%Y-%m-%d', $arr_bayar[$kunci][2]));
                                            ?>
                                        </div>
                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Jumlah</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pembayaran['.$bayarIndex.'][jumlah]', 'id'=> 'jumlah_transfer', 'class' => 'form-control transfer bankir', 'type' => 'number', 'min' => '0','required' => ''), $arr_bayar[$kunci][1]);
                                            ?>
                                        </div>
                                        <div class="input-group mb-3 col-sm-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <div class="form-check">
                                                        <?php
                                                        $data_ck = array(
                                                            'name'          => 'pembayaran['.$bayarIndex.'][sudah_cek]',
                                                            'id'            => 'sudah_cek-'. $bayarIndex,
                                                            'class'         => 'form-check-input sudah_cek mt-2',
                                                            'checked'       => FALSE,
                                                            'value'         => 'ya'
                                                        );
                                                        
                                                        if($arr_bayar[$kunci][3] !== 'NULL') {
                                                            $arr_by_cek = array('checked' => TRUE);
                                                            $wct = $arr_bayar[$kunci][3];
                                                            $arr_by_cek_input = array();
                                                        }
                                                        else {
                                                            $arr_by_cek = array('checked' => FALSE);
                                                            $arr_by_cek_input = array('disabled' => '');
                                                            $wct = now();
                                                        }

                                                        echo form_checkbox(array_merge($data_ck, $arr_by_cek));
                                                        echo form_label('Cek', 'sudah_cek-'.$bayarIndex, array('class' => 'form-check-label'));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                echo form_input(array_merge($arr_by_cek_input,array('name' => 'pembayaran['.$bayarIndex.'][cek]', 'id'=> 'tanggal_cek', 'class' => 'form-control tanggal_cek sudah_cek-'.$bayarIndex, 'type' => 'date')), mdate('%Y-%m-%d', $wct));
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
                                                            'value'         => 'ya'
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
                        <small class="text-muted">Pembayaran DP / Kredit cukup masukkan dana awal yang diterima</small>
                    </div>
                </div>
                
                <div class="custom-control custom-switch mb-2">
                    <?php 
                    $data_kir = array(
                        'name'          => 'pengiriman_',
                        'id'            => 'pengiriman_',
                        'class'         => 'custom-control-input',
                        'value'         => 'ya'
                    );
                    
                    if($pesanan->status_kirim === '0' && $pesanan->status_paket !== '1') {
                        $arr_kir = array(
                            'checked' => FALSE,
                            'disabled' => ''
                        );
                    }
                    else if($pesanan->status_kirim === '0' && $pesanan->status_paket === '1') {
                        $arr_kir = array(
                            'checked' => FALSE
                        );
                    }
                    else {
                        $arr_kir = array(
                            'checked' => TRUE
                        );
                    }

                    echo form_checkbox(array_merge($data_kir, $arr_kir));
                    echo form_label('Sudah dikirim/ diambil?', 'pengiriman_', array('class' => 'custom-control-label'));
                    ?>
                </div>
                
                <div class="card bg-light collapse <?php echo ($pesanan->status_kirim === '0'? '': 'show') ?>" id="dataPengiriman">
                    <div class="card-body">
                        <div id="multiKirim">
                            <label for="rekening">Data Pengiriman</label>
                            <?php 
                            if($pesanan->pengiriman !== NULL) {
                                $kirimIndex = 1;
                                $kirim = explode(',', $pesanan->pengiriman);

                                foreach($kirim as $kunci => $str) { 
                                    $arr_kirim[$kunci] = explode('|', $str);
                                ?>
                                <div class="listPengiriman" id="pengiriman" data-kirim="<?php echo $kirimIndex; ?>">
                                    <div class="form-row mb-0 pb-0" id="formkirim">

                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Kurir</span>
                                            </div>
                                            <?php
                                                $data_byr_h = array(
                                                    'type'  => 'hidden',
                                                    'name'  => 'pengiriman['.$kirimIndex.'][id_pengiriman]',
                                                    'id'    => 'id_pengiriman',
                                                    'value' => $arr_kirim[$kunci][4],
                                                );
                                                
                                                echo form_input($data_byr_h);
                                                echo form_input(array('name' => 'pengiriman['.$kirimIndex.'][kurir]', 'id'=> 'kurir', 'class' => 'form-control kurir carry', 'placeholder' => 'kurir','required' => ''), $arr_kirim[$kunci][0]);
                                            ?>
                                        </div>

                                        <div class="input-group mb-3 col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Resi</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pengiriman['.$kirimIndex.'][resi]', 'id'=> 'resi', 'class' => 'form-control resi carry', 'placeholder' => 'nomor resi','required' => ''), $arr_kirim[$kunci][1]);
                                            ?>
                                        </div>

                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Ongkir</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pengiriman['.$kirimIndex.'][ongkir]', 'id'=> 'ongkir_fix', 'class' => 'form-control transfer carry', 'type' => 'number', 'min' => '0','required' => ''), $arr_kirim[$kunci][3]);
                                            ?>
                                        </div>

                                        <div class="input-group mb-3 col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Tggl Kirim</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pengiriman['.$kirimIndex.'][tanggal_kirim]', 'id'=> 'tanggal_kirim', 'class' => 'form-control tanggal_kirim carry', 'type' => 'date','required' => ''), mdate('%Y-%m-%d', $arr_kirim[$kunci][2]));
                                            ?>
                                        </div>

                                        <div class="form-group col-2 col-sm-1">
                                            <?php
                                            if($kirimIndex === 1) {
                                                echo form_button(array('class' => 'btn btn-success btnAddKirim carry', 'content' => '<i class="fas fa-plus"></i>'));
                                            }
                                            else {
                                                echo form_button(array('class' => 'btn btn-outline-danger btnDelKirim carry', 'content' => '<i class="fas fa-minus"></i>'));
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                                $kirimIndex++;
                                }
                            }
                            else {
                            ?>
                            <div class="listPengiriman" id="pengiriman" data-kirim="1">
                                <div class="form-row mb-0 pb-0" id="formkirim">

                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Kurir</span>
                                        </div>
                                        <?php
                                            echo form_input(array('name' => 'pengiriman[1][kurir]', 'id'=> 'kurir', 'class' => 'form-control kurir carry', 'placeholder' => 'kurir','required' => '', 'disabled' => ''));
                                        ?>
                                    </div>

                                    <div class="input-group mb-3 col-sm-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Resi</span>
                                        </div>
                                        <?php
                                            echo form_input(array('name' => 'pengiriman[1][resi]', 'id'=> 'resi', 'class' => 'form-control resi carry', 'placeholder' => 'nomor resi','required' => '', 'disabled' => ''));
                                        ?>
                                    </div>

                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Ongkir</span>
                                        </div>
                                        <?php
                                            echo form_input(array('name' => 'pengiriman[1][ongkir]', 'id'=> 'ongkir_fix', 'class' => 'form-control transfer carry', 'type' => 'number', 'min' => '0','required' => '', 'disabled' => ''), '0');
                                        ?>
                                    </div>

                                    <div class="input-group mb-3 col-sm-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Tggl Kirim</span>
                                        </div>
                                        <?php
                                            echo form_input(array('name' => 'pengiriman[1][tanggal_kirim]', 'id'=> 'tanggal_kirim', 'class' => 'form-control tanggal_kirim carry', 'type' => 'date','required' => '', 'disabled' => ''), mdate('%Y-%m-%d', now()));
                                        ?>
                                    </div>

                                    <div class="form-group col-2 col-sm-1">
                                        <?php
                                        echo form_button(array('class' => 'btn btn-success btnAddKirim carry', 'content' => '<i class="fas fa-plus"></i>'));
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="custom-control custom-switch mb-2">
                            <?php 
                            $data = array(
                                'name'          => 'pengiriman_selesai',
                                'id'            => 'pengiriman_selesai',
                                'class'         => 'custom-control-input',
                                'checked'       => TRUE,
                                'value'         => 'ya'
                            );
                            
                            echo form_checkbox($data);
                            echo form_label('Sudah dikirim semua?', 'pengiriman_selesai', array('class' => 'custom-control-label'));
                            ?>
                        </div>
                    </div>
                </div>
                <hr/>

                <div class="form-group">
                    <?php
                        echo form_label('Keterangan', 'keterangan');
                        echo form_textarea(array('name' => 'keterangan', 'rows' => 3, 'id'=> 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan tambahan'), set_value('keterangan', html_entity_decode($pesanan->keterangan)));
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

<?php echo $this->load->view("admin/_inc/js-global", '', TRUE); ?>
<?php echo $this->load->view("admin/_inc/js-formpesanan", '', TRUE); ?>
<?php echo $this->load->view("_inc/footer", '', TRUE); ?>
