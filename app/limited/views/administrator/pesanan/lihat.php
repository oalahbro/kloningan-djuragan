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
            <form class="form-inline px-3 px-sm-0">
                <select class="custom-select mb-2 mr-sm-2">
                    <option selected="" disabled="">Opsi Pembayaran</option>
                    <option value="1">Menunggu Konfirmasi</option>
                    <option value="2">Sudah Lunas</option>
                    <option value="3">Sebagian</option>
                    <option value="3">Ada Kelebihan</option>
                </select>

                <select class="custom-select mb-2 mr-sm-2">
                    <option selected="" disabled="">Opsi Paket</option>
                    <option value="1">Diproses</option>
                    <option value="2">Belum Diproses</option>
                </select>

                <select class="custom-select mb-2 mr-sm-2">
                    <option selected="" disabled="">Opsi Pengiriman</option>
                    <option value="1">Dikirim</option>
                    <option value="2">Diambil</option>
                    <option value="3">Sebagian</option>
                </select>

                <div class="form-check mb-2 mr-sm-2">
                    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                    <label class="form-check-label" for="inlineFormCheck">
                    Marketplace?
                    </label>
                </div>

                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="cari data">
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
            <div id="main-table">
                <div class="table-responsive" id="table-pesanan">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 120px">Faktur #</th>
                                <th style="width: 120px">Juragan</th>
                                <th style="width: 160px;">Status</th>
                                <th>Pemesan</th>
                                <th style="width: 200px;">Pesanan</th>
                                <th style="width: 240px">Biaya</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($query->num_rows() > 0) { ?>
                                <?php foreach ($query->result() as $pesanan) { 
                                    // pembayaran
                                    $wajib_bayar = 0;
                                    $dibayar = 0;

                                    $array = array();
                                    $bayar = array();
                                    if ($pesanan->pembayaran !== NULL) {
                                        $pembayaran = explode(',', $pesanan->pembayaran);
                                        foreach($pembayaran as $key => $str) {
                                            $array[$key] = explode('|', $str);
                                            $data_ = array();
                                            for ($i=0; $i < count($array); $i++) { 
                                                $data_['bank'] = $array[$i][0];
                                                $data_['jumlah'] = $array[$i][1];
                                                $data_['tanggal_bayar'] = $array[$i][2];
                                                $data_['tanggal_cek'] = ($array[$i][3] === 'NULL'? NULL: $array[$i][3]);
                                            }
                                            $bayar[] = (object) $data_;
                                        }

                                        foreach ($bayar as $ter) {
                                            if($ter->tanggal_cek !== NULL) {
                                                // yang sudah dicek
                                                $dibayar += $ter->jumlah;
                                            }
                                        }
                                    }

                                    // pesanan produk
                                    $jumlah_produk = 0;
                                    $harga_total = 0;
                                    $hproduk = '';

                                    $arr_produk = array();
                                    $dipesan = array();
                                    $pesan = explode(',', $pesanan->produk);
                                    foreach($pesan as $key => $str) {
                                        $arr_produk[$key] = explode('|', $str);
                                        $data_ = array();
                                        for ($i=0; $i < count($arr_produk); $i++) { 
                                            $data_['kode'] = $arr_produk[$i][0];
                                            $data_['ukuran'] = $arr_produk[$i][1];
                                            $data_['jumlah'] = $arr_produk[$i][2];
                                            $data_['harga'] = $arr_produk[$i][3];
                                        }
                                        $dipesan[] = (object) $data_;
                                    }

                                    foreach ($dipesan as $produk) {
                                        $jumlah_produk += $produk->jumlah;
                                        $harga_total += ($produk->harga * $produk->jumlah); // kalkulasi harga
                                        $hproduk .= '<div>' . strtoupper($produk->kode . ' (' . $produk->ukuran . ') = ') . $produk->jumlah . 'pcs</div>';
                                    }

                                    // cal
                                    $wajib_bayar += $harga_total;
                                    $wajib_bayar += $pesanan->ongkir;
                                    $wajib_bayar += $pesanan->unik;
                                    $wajib_bayar -= $pesanan->diskon;

                                    $kekurangan = $wajib_bayar - $dibayar;
                                ?>
                                <tr id="pesanan-<?php echo $pesanan->id_faktur; ?>">
                                    <td>
                                        <?php 
                                        echo strtoupper($pesanan->seri_faktur);
                                        echo '<span class="d-block"><abbr title="'.unix_to_human($pesanan->tanggal_dibuat).'"><i class="fas fa-calendar-day"></i> ' . mdate('%d-%M-%y', $pesanan->tanggal_dibuat) . '</abbr></span>';
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo anchor('pesanan/' .$pesanan->slug, $pesanan->nama_juragan); 
                                        echo '<hr/><span class="text-muted small">CS: '.$pesanan->nama_cs.'</span>';
                                        ?>
                                    </td>
                                    <td>
                                        <div class="mn" data-kurang="<?php echo $kekurangan; ?>" data-faktur="<?php echo strtoupper($pesanan->seri_faktur); ?>" data-id="<?php echo $pesanan->id_faktur?>" >
                                            <?php 
                                            // status transfer
                                            switch ($pesanan->status_transfer) {
                                                case "d_lunas":
                                                    // sudah lunas
                                                    $c_trf = 'text-success';
                                                    $a_trf = 'cek_pembayaran';
                                                    $i_trf = 'fa-check-double';
                                                    $t_trf = 'Pembayaran Lunas';
                                                    break;
                                                case "e_lebih":
                                                    // sudah lunas dan mempunyai kelebihan
                                                    $c_trf = 'text-info';
                                                    $a_trf = 'cek_pembayaran';
                                                    $i_trf = 'fa-plus';
                                                    $t_trf = 'Pembayaran Lunas & memiliki kelebihan';
                                                    break;
                                                case "c_sebagian":
                                                    // belum lunas / dp yang dibayarkan sudah ada
                                                    $c_trf = 'text-warning';
                                                    $a_trf = 'cek_pembayaran';
                                                    $i_trf = 'fa-ellipsis-h';
                                                    $t_trf = 'Pembayaran belum lunas';
                                                    break;
                                                case "b_menunggu":
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
                                            ?>
                                            <div class="fa-2x d-inline-block <?php echo $a_trf; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $t_trf; ?>">
                                                <span class="fa-layers fa-fw">
                                                    <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>
                                                    <i class="fas fa-wallet text-secondary" data-fa-transform="shrink-6"></i>
                                                    <span class="fa-layers fa-fw">                            
                                                        <i class="fas fa-circle <?php echo $c_trf; ?>" data-fa-transform="shrink-8 down-1 right-5"></i>
                                                        <i class="fas <?php echo $i_trf; ?> text-light" data-fa-transform="shrink-10 down-1 right-5"></i>
                                                    </span>
                                                </span>
                                            </div>

                                            <?php
                                            // status paket
                                            switch ($pesanan->status_paket) {
                                                case "diproses":
                                                    // paket diproses
                                                    $c_pkt = 'text-success';
                                                    $i_pkt = 'fa-check-double';
                                                    $mi_pkt = 'fa-box';
                                                    $t_pkt = 'Pesanan diproses';
                                                    $a_krm = 'set_kirim';
                                                    $s_pkt = 'batal proses';
                                                    break;
                                                default:
                                                    // belum diproses
                                                    $c_pkt = 'text-danger';
                                                    $i_pkt = 'fa-times';
                                                    $mi_pkt = 'fa-box-open';
                                                    $t_pkt = 'Pesanan Belum diproses';
                                                    $a_krm = 'cant_kirim';
                                                    $s_pkt = 'diproses';
                                            }
                                            ?>
                                            <div class="fa-2x d-inline-block set_paket" data-status="<?php echo $s_pkt; ?>" data-faktur="<?php echo $pesanan->seri_faktur; ?>" data-id="<?php echo $pesanan->id_faktur?>" data-toggle="tooltip" data-placement="top" title="<?php echo $t_pkt; ?>">
                                                <span class="fa-layers fa-fw">
                                                    <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>
                                                    <i class="fas <?php echo $mi_pkt; ?> text-secondary" data-fa-transform="shrink-6"></i>
                                                    <span class="fa-layers fa-fw">
                                                        <i class="fas fa-circle <?php echo $c_pkt; ?>" data-fa-transform="shrink-8 down-1 right-5"></i>
                                                        <i class="fas <?php echo $i_pkt; ?> text-light" data-fa-transform="shrink-10 down-1 right-5"></i>
                                                    </span>
                                                </span>
                                            </div>

                                            <?php
                                            // status kirim
                                            switch ($pesanan->status_kirim) {
                                                
                                                case "b_dikirim":
                                                    // pesanan dikirim
                                                    $c_krm = 'text-success';
                                                    $i_krm = 'fa-check-double';
                                                    $mi_krm = 'fa-plane-departure';
                                                    $t_krm = 'Pesanan telah dikirim';
                                                    break;
                                                case "d_sebagian":
                                                    // pesanan dikirim / diambil sebagian
                                                    $c_krm = 'text-warning';
                                                    $i_krm = 'fa-ellipsis-h';
                                                    $mi_krm = 'fa-cubes';
                                                    $t_krm = 'Pesanan telah dikirim sebagian';
                                                    break;
                                                case "c_diambil":
                                                    // pesanan diambil
                                                    $c_krm = 'text-success';
                                                    $i_krm = 'fa-check-double';
                                                    $mi_krm = 'fa-people-carry';
                                                    $t_krm = 'Pesanan diambil';
                                                    break;
                                                default:
                                                    // belum kirim / ambil
                                                    $c_krm = 'text-danger';
                                                    $i_krm = 'fa-times';
                                                    $mi_krm = 'fa-cubes';
                                                    $t_krm = 'Pesanan Belum dikirim';
                                            }
                                            ?>
                                            <div class="fa-2x d-inline-block <?php echo $a_krm; ?>" data-faktur="<?php echo $pesanan->seri_faktur; ?>" data-id="<?php echo $pesanan->id_faktur?>" data-toggle="tooltip" data-placement="top" title="<?php echo $t_krm; ?>">
                                                <span class="fa-layers fa-fw">
                                                    <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>
                                                    <i class="fas <?php echo $mi_krm; ?> text-secondary" data-fa-transform="shrink-6"></i>
                                                    <span class="fa-layers fa-fw">
                                                        <i class="fas fa-circle <?php echo $c_krm; ?>" data-fa-transform="shrink-8 down-1 right-5"></i>
                                                        <i class="fas <?php echo $i_krm; ?> text-light" data-fa-transform="shrink-10 down-1 right-5"></i>
                                                    </span>
                                                </span>
                                            </div>

                                        </div>
                                        
                                        <div class="dropdown dropright">
                                            <button class="btn btn-outline-primary btn-sm btn-block" type="button" id="buttonDropdown-<?php echo $pesanan->id_faktur?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog fa-spin"></i>
                                            </button>
                                            <div class="dropdown-menu mn" data-kurang="<?php echo $kekurangan; ?>" data-faktur="<?php echo strtoupper($pesanan->seri_faktur); ?>" data-id="<?php echo $pesanan->id_faktur?>" aria-labelledby="buttonDropdown-<?php echo $pesanan->id_faktur?>">
                                                <h6 class="dropdown-header">Status Pembayaran</h6>
                                                <a class="cek_pembayaran dropdown-item" href="#!">Cek Pembayaran</a>
                                                <a class="tambah_pembayaran dropdown-item">Tambah Pembayaran</a>
                                                <div class="dropdown-divider"></div>
                                                <h6 class="dropdown-header">Status Pengiriman</h6>
                                                <a class="dropdown-item <?php echo $a_krm; ?>" href="#!">Set / Sunting</a>
                                                <div class="dropdown-divider"></div>
                                                <h6 class="dropdown-header">Lainnya</h6>
                                                <?php echo anchor('pesanan/sunting/' . $pesanan->seri_faktur, 'Sunting', array('class' => 'dropdown-item') ); ?>
                                                <a class="dropdown-item" href="#">Unduh PDF</a>
                                                <a class="text-danger hapus_pesanan dropdown-item" href="#!">Hapus</a>
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
                                    <td>
                                        <?php
                                        echo ($pesanan->tipe === NULL? '': '<span class="d-block text-uppercase py-1 text-center text-light font-weight-bold border border-danger bg-danger rounded px-2 mb-1">'.$pesanan->tipe.'</span>');

                                        echo $hproduk;
                                        echo '<hr/><em>total: <span class="badge badge-dark">' . $jumlah_produk . '</span> pcs</em>';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                       if($wajib_bayar > $dibayar && $dibayar > 0) {
                                            $status_bayar = '<span class="d-block text-center border border-warning text-uppercase py-1 font-weight-bold rounded">Kredit</span>';
                                        }
                                        else if($wajib_bayar === $dibayar) {
                                            $status_bayar = '<span class="d-block text-center border border-success text-uppercase py-1 font-weight-bold rounded">Lunas</span>';
                                        }
                                        else if($wajib_bayar < $dibayar) {
                                            $status_bayar = '<span class="d-block text-center border border-primary text-uppercase py-1 font-weight-bold rounded">Kelebihan</span>';
                                        }
                                        else {
                                            $status_bayar = '<span class="d-block text-center border border-danger text-uppercase py-1 font-weight-bold rounded">Belum Lunas</span>';
                                        }

                                        //
                                        echo $status_bayar;
                                        echo '<span class="d-block text-right">harga produk : <span class="badge badge-info">'. harga($harga_total)  .'</span></span>';
                                        if($pesanan->ongkir > 0) {
                                            echo '<span class="d-block text-right">tarif ongkir : <span class="badge badge-dark">'. harga($pesanan->ongkir)  .'</span></span>';
                                        }
                                        if($pesanan->unik > 0) {
                                            echo '<span class="d-block text-right">digit unik : <span class="badge badge-secondary">'. harga($pesanan->unik)  .'</span></span>';
                                        }
                                        if($pesanan->diskon > 0) {
                                            echo '<span class="d-block text-right">diskon : <span class="badge badge-warning">-'. harga($pesanan->diskon)  .'</span></span>';
                                        }

                                        echo '<span class="d-block text-right">wajib bayar : <span class="badge badge-success">'. harga($wajib_bayar)  .'</span></span>';

                                        if($dibayar > 0) {
                                            echo '<span class="d-block text-right">dibayar : <span class="badge badge-danger">'. harga($dibayar)  .'</span></span>';
                                        }
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        // pengiriman
                                        $arr_kirim = array();
                                        $kirim = array();
                                        if($pesanan->pengiriman !== NULL) {
                                            $pengiriman = explode(',', $pesanan->pengiriman);
                                            foreach($pengiriman as $key => $str) {
                                                $arr_kirim[$key] = explode('|', $str);
                                                $data_ = array();
                                                for ($i=0; $i < count($arr_kirim); $i++) { 
                                                    $data_['kurir'] = $arr_kirim[$i][0];
                                                    $data_['resi'] = $arr_kirim[$i][1];
                                                    $data_['tanggal_kirim'] = $arr_kirim[$i][2];
                                                    $data_['ongkir'] = $arr_kirim[$i][3];
                                                }
                                                $kirim[] = (object) $data_;
                                            }
                                        }
                                
                                        //
                                        ?>
                                        <?php
                                        if($pesanan->keterangan !== NULL || $pesanan->gambar !== NULL) { ?>
                                            <button class="btn btn-outline-info dropdown-toggle btn-sm" type="button" data-toggle="collapse" data-target="#collapseKeterangan<?php echo $pesanan->id_faktur; ?>" aria-expanded="false" aria-controls="collapseKeterangan<?php echo $pesanan->id_faktur; ?>">
                                                <i class="fas fa-scroll"></i> Keterangan
                                            </button>
                                        <?php 
                                        } 
                                        if($pesanan->pengiriman !== NULL) {
                                        ?>
                                        <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapseResi<?php echo $pesanan->id_faktur; ?>" aria-expanded="false" aria-controls="collapseResi<?php echo $pesanan->id_faktur; ?>">
                                            <i class="fas fa-receipt"></i> Resi Kirim
                                        </button>
                                        <div class="collapse show" id="collapseResi<?php echo $pesanan->id_faktur; ?>">
                                            <div class="bg-light border border-dark p-1 mt-2 rounded">
                                                <?php 
                                                echo '<h6>Pengiriman : </h6>';
                                                echo '<ul class="ml-0 pl-3">';
                                                foreach ($kirim as $kirim) {
                                                    echo '<li><span class="font-weight-bold">' . strtoupper($kirim->kurir) . '</span>';
                                                    echo '<br/>' . $kirim->resi;
                                                    echo '<br/><small class="text-muted">tanggal: ' . mdate('%d-%m-%Y', $kirim->tanggal_kirim) . '</small>';
                                                    echo ($kirim->ongkir > 0? '<br/>ongkir: <span class="badge badge-secondary">' . harga($kirim->ongkir) . '</span>': '');
                                                    echo '</li>';
                                                }
                                                echo '</ul>';
                                                ?>
                                            </div>
                                        </div>

                                        <?php }
                                        if($pesanan->keterangan !== NULL  || $pesanan->gambar !== NULL) { ?>
                                        <div class="collapse<?php echo ($pesanan->pengiriman !== NULL? '': ' show'); ?>" id="collapseKeterangan<?php echo $pesanan->id_faktur; ?>">
                                            <?php 
                                            if($pesanan->keterangan !== NULL) {
                                                echo '<p>' . nl2br($pesanan->keterangan) . '</p>';
                                            }
                                            //
                                            if($pesanan->gambar !== NULL) { ?>
                                            <div class="dropdown mt-3">
                                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="customGambar<?php echo $pesanan->id_faktur; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Gambar
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="customGambar<?php echo $pesanan->id_faktur; ?>">
                                                    <?php 
                                                        $i = 1;
                                                        $gmb= json_decode($pesanan->gambar);
                                                        foreach ($gmb as $image) {
                                                        echo anchor($image, 'Custom Gambar ' . $i++, array('target' => '_blank', 'class' => 'dropdown-item'));
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
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
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>
