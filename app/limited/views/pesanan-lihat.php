<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo $this->load->view("_inc/header", $judul, TRUE) ?>
<?php echo $this->load->view("_inc/".$include."/navbar", '', TRUE) ?>

        <div class="konten" id="konten">
            <div class="jumbotron jumbotron-fluid">
                <div class="container-fluid">
                    <h3><?php echo $judul; ?></h3>
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
                                    <th style="min-width: 220px">Pesanan</th>
                                    <th style="width: 240px">Biaya</th>
                                    <th style="width: 200px">Keterangan</th>
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
</div>

<?php echo $this->load->view("_inc/".$include."/js-global", '', TRUE); ?>
<?php echo $this->load->view("_inc/".$include."/js-pesanan", '', TRUE); ?>
<?php echo $this->load->view("_inc/footer", '', TRUE); ?>