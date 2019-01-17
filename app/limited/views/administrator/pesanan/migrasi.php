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
            <?php echo form_open('', array('class' =>'mb-5'), array('image' => (isset($detail->i) ? json_encode($detail->i) : ''), 'tanggal_paket' => $pesanan->tanggal_submit, 'waktu_dibuat' => mdate('%H:%i:%s', $pesanan->tanggal_submit), 'slug' => $pesanan->slug)); ?>
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
                    <div class="form-group col-md-4">
                        <?php
                            echo form_label('Tanggal', 'tanggal_dibuat');
                            echo form_input(array('name' => 'tanggal_dibuat', 'id'=> 'tanggal_dibuat', 'type' => 'date', 'class' => 'form-control', 'required' => ''), set_value('tanggal_dibuat', mdate('%Y-%m-%d', $pesanan->tanggal_submit)));
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
                    $harga_produk = 0;
                    $produkIndex = 1;
                    foreach ($detail->p as $produk) {
                    ?>
                    <div class="mb-2 cloning-me" id="dup" data-prod="<?php echo $produkIndex; ?>">
                        <div class="form-row" id="main-form">
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Kode</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk['.$produkIndex.'][kode]', 'id'=> 'kode-' . $produkIndex, 'class' => 'form-control kode', 'placeholder' => 'kode', 'required' => 'required'), set_value('', $produk->c));
                                    ?>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Harga @</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk['.$produkIndex.'][harga]', 'id'=> 'harga-' . $produkIndex, 'class' => 'form-control calc harga', 'placeholder' => '250000', 'pattern' => '^(?:[1-9]\d*|0)$', 'required' => '', 'type' => 'number', 'min' => '0'), set_value('', (isset($produk->h)?$produk->h: $biaya->m->h/$pesanan->count)));
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

                                    echo form_dropdown('produk['.$produkIndex.'][ukuran]', $opt, $produk->s, array('id' => 'ukuran-' . $produkIndex, 'class'=> 'custom-select ukuran', 'required' => ''));
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-2 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Jumlah</span></div>
                                    <?php
                                        echo form_input(array('name' => 'produk['.$produkIndex.'][jumlah]', 'id'=> 'jumlah-' . $produkIndex, 'class' => 'form-control calc jumlah', 'placeholder' => '1', 'min' => '1', 'pattern' => '^\d+$', 'required' => '', 'type' => 'number'), set_value('produk['.$produkIndex.'][jumlah]', $produk->q));
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
                        $harga_produk += (isset($produk->h)?$produk->h: $biaya->m->h/$pesanan->count) * $produk->q;
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
                                            echo form_input(array('name' => 'diskon', 'id'=> 'diskon', 'class' => 'form-control diskon calc', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('diskon', (isset($biaya->m->d) ? $biaya->m->d: 0 )));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('Tarif Ongkir', 'ongkir');
                                            echo form_input(array('name' => 'ongkir', 'id'=> 'ongkir', 'class' => 'form-control ongkir calc', 'type' => 'number', 'min' => '0', 'required' => ''), set_value('diskon', (isset($biaya->m->o) ? $biaya->m->o: 0 )));
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <?php
                                            echo form_label('3 digit angka unik', 'unik');
                                            echo form_input(array('name' => 'unik', 'id'=> 'unik', 'class' => 'form-control unik calc', 'type' => 'number', 'min' => '0','required' => ''), set_value('diskon', (isset($biaya->m->u) ? $biaya->m->u: 0 )));
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
                            <div>Tarif Ongkir <span class="float-right tarif_ongkir"><?php 
                            $ongkir_ = (isset($biaya->m->o) ? $biaya->m->o: 0 );
                            echo harga($ongkir_); ?></span></div>
                            <div>Angka Unik <span class="float-right angka_unik"><?php 
                            $unik_ = (isset($biaya->m->u) ? $biaya->m->u: 0 );
                            echo harga($unik_); ?></span></div>
                            <div>Diskon <span class="float-right total_diskon"><?php 
                            $diskon_ = (isset($biaya->m->d) ? $biaya->m->d: 0 );
                            echo harga($diskon_); ?></span></div>
                            <div>Biaya Wajib Dibayar <span class="float-right wajib_dibayar"><?php
                            
                            echo harga($harga_produk + $ongkir_ + $unik_ - $diskon_) ?></span></div>
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
                                        'checked'       => FALSE,
                                    );
                                    
                                    echo form_checkbox($data);
                                    ?>
                                </div>
                            </div>
                            <?php
                        
                            $arr = array('disabled' => '');
                            
                            echo form_input(array_merge(array('class' => 'form-control', 'name' => 'marketplace', 'placeholder' => 'misal: Tokopedia, Shopee, ...', 'required' => ''), $arr));
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
                            
                            echo form_dropdown('status_paket', $opsi_paket_, '1', array('class' => 'custom-select', 'id' => 'status_paket'));
                            ?>
                    </div>                
                </div>

                <div class="custom-control custom-switch mb-2">
                    <?php 
                    $data = array(
                        'name'          => 'pembayaran_',
                        'id'            => 'pembayaran_',
                        'class'         => 'custom-control-input',
                        'value'         => 'ya'
                    );

                    $arr_tr = array('checked' => FALSE);
                    if ($pesanan->status_transfer === 'belum_transfer') {
                        $arr_tr = array('checked' => TRUE);
                    } 
                    
                    echo form_checkbox(array_merge($data,$arr_tr));
                    echo form_label('Menunggu pembayaran/pencairan?', 'pembayaran_', array('class' => 'custom-control-label'));
                    ?>
                </div>

                <div class="card bg-light mb-3 collapse <?php echo ($pesanan->status_transfer === 'belum'? '': 'show') ?>" id="dataPembayaran">
                    <div class="card-body">
                        <div id="multiBayar">
                            <label for="rekening">Data Pembayaran</label>
                            <?php 
                            if ($biaya->m !== NULL) {
                                $bayarIndex = 1;
                                // $bayar = explode(',', $detail->p);

                                //foreach($biaya->m as $bayar) { 
                                    // $arr_bayar[$kunci] = explode('|', $str);
                                ?>
                                <div class="listPembayaran" id="pembayaranViaTransfer" data-transfer="<?php echo $bayarIndex; ?>">
                                    <div class="form-row mb-0 pb-0" id="formTransfer">

                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rek?</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pembayaran['.$bayarIndex.'][rekening]', 'id'=> 'rekening', 'class' => 'form-control rekening bankir', 'placeholder' => 'Cash / Bank','required' => ''), $biaya->b);
                                            ?>
                                        </div>

                                        <div class="input-group mb-3 col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Tggl Bayar</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pembayaran['.$bayarIndex.'][tanggal]', 'id'=> 'tanggal_transfer', 'class' => 'form-control tanggal_transfer bankir', 'type' => 'date','required' => ''), mdate('%Y-%m-%d', $pesanan->tanggal_submit));
                                            ?>
                                        </div>
                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Jumlah</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pembayaran['.$bayarIndex.'][jumlah]', 'id'=> 'jumlah_transfer', 'class' => 'form-control transfer bankir', 'type' => 'number', 'min' => '0','required' => ''), ($biaya->m->t === NULL? '0': $biaya->m->t));
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
                                                        
                                                        if($pesanan->tanggal_cek_transfer !== 'NULL') {
                                                            $arr_by_cek = array('checked' => TRUE);
                                                            $wct = $pesanan->tanggal_cek_transfer;
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
                                //}
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
                    
                    if($pesanan->status_kirim === 'pending' ) {
                        $arr_kir = array(
                            'checked' => FALSE,
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
                
                <div class="card bg-light collapse <?php echo ($pesanan->status_kirim !== 'terkirim'? '': 'show') ?>" id="dataPengiriman">
                    <div class="card-body">
                        <div id="multiKirim">
                            <label for="rekening">Data Pengiriman</label>
                            <?php 
                                $kirimIndex = 0; ?>
                             
                                <div class="listPengiriman" id="pengiriman" data-kirim="<?php echo $kirimIndex; ?>">
                                    <div class="form-row mb-0 pb-0" id="formkirim">

                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Kurir</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pengiriman['.$kirimIndex.'][kurir]', 'id'=> 'kurir', 'class' => 'form-control kurir carry', 'placeholder' => 'kurir','required' => ''), (isset($detail->s->k)? $detail->s->k: 'Unknown'));
                                            ?>
                                        </div>

                                        <div class="input-group mb-3 col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Resi</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pengiriman['.$kirimIndex.'][resi]', 'id'=> 'resi', 'class' => 'form-control resi carry', 'placeholder' => 'nomor resi','required' => ''), (isset($detail->s->n)?$detail->s->n: 'Unknown'));
                                            ?>
                                        </div>

                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Ongkir</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pengiriman['.$kirimIndex.'][ongkir]', 'id'=> 'ongkir_fix', 'class' => 'form-control transfer carry', 'type' => 'number', 'min' => '0','required' => ''), (isset($biaya->m->of)? $biaya->m->of: '0' ));
                                            ?>
                                        </div>

                                        <div class="input-group mb-3 col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Tggl Kirim</span>
                                            </div>
                                            <?php
                                                echo form_input(array('name' => 'pengiriman['.$kirimIndex.'][tanggal_kirim]', 'id'=> 'tanggal_kirim', 'class' => 'form-control tanggal_kirim carry', 'type' => 'date','required' => ''), mdate('%Y-%m-%d', $pesanan->tanggal_cek_kirim));
                                            ?>
                                        </div>

                                        <div class="form-group col-2 col-sm-1">
                                            <?php
                                            if($kirimIndex === 0) {
                                                echo form_button(array('class' => 'btn btn-success btnAddKirim carry', 'content' => '<i class="fas fa-plus"></i>'));
                                            }
                                            else {
                                                echo form_button(array('class' => 'btn btn-outline-danger btnDelKirim carry', 'content' => '<i class="fas fa-minus"></i>'));
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
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
                        echo form_textarea(array('name' => 'keterangan', 'rows' => 3, 'id'=> 'keterangan', 'class' => 'form-control', 'placeholder' => 'keterangan tambahan'), (isset($detail->n)? $detail->n:''));
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