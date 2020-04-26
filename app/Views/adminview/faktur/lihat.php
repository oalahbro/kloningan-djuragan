<?php
use CodeIgniter\I18n\Time;
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h3>Pesanan Semua Juragan</h3>

    </div>
</div>
<div class="px-sm-3">
    <form action="https://djuragan.com/new/index.php/faktur/data/s_juragan" class="form-inline px-3 px-sm-0" method="get" accept-charset="utf-8">
        <select name="cari[pembayaran]" class="custom-select mb-2 mr-sm-2">
            <option value="" selected="selected">Opsi Pembayaran</option>
            <option value="belum_transfer">Belum Lunas</option>
            <option value="b_menunggu">Menuggu Konfirmasi</option>
            <option value="c_sebagian">Sebagian Lunas / Kredit</option>
            <option value="d_lunas">Lunas</option>
            <option value="e_lebih">Ada Kelebihan</option>
        </select>
        <select name="cari[paket]" class="custom-select mb-2 mr-sm-2">
            <option value="" selected="selected">Opsi Paket</option>
            <option value="diproses">Diproses</option>
            <option value="belum_diproses">Belum Diproses</option>
            <option value="batal_proses">Dibatalkan</option>
        </select>
        <select name="cari[pengiriman]" class="custom-select mb-2 mr-sm-2">
            <option value="" selected="selected">Opsi Pengiriman</option>
            <option value="belum_kirim">Belum Dikirim</option>
            <option value="d_sebagian">Dikirim Sebagian</option>
            <option value="dikirim">Dikirim</option>
        </select>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" name="cari[cek_tanggal]" value="ya">
                </div>
            </div>
            <input type="date" name="cari[tanggal]" value="2020-04-21" class="form-control" placeholder="tanggal data masuk" disabled="">
        </div>
        <div class="form-check mb-2 mr-sm-2">
            <input type="checkbox" name="cari[marketplace]" value="ya" class="form-check-input" id="marketplace">
            <label for="marketplace">Marketplace?</label>
        </div>
        <input type="text" name="cari[q]" value="" class="form-control mb-2 mr-sm-2" placeholder="cari data">
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>

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
                    <?php foreach ($pesanan as $key ) { 
                        $wajib_bayar = 0;
                        $wajib_kirim = 0;
                        $sudah_bayar = 0;
                        $sudah_kirim = 0;
                    ?>
                    <tr id="pesanan-<?= $key->id_fktr; ?>">
                        <td><?php echo strtoupper($key->no); ?>
                            <span class="d-block"><?php
                            $time = Time::createFromTimestamp($key->fktr_dibuat);
                            echo '<abbr title="'.$time.'">';
                            echo $time->toLocalizedString('d-MMM-yyyy');
                            echo '</abbr>';
                             ?></span> </td>
                        <td class="juragan">
                            <?= anchor($key->juragan, $key->nama_jrgn); ?>
                            <hr><span class="text-muted small">CS: Sandra</span></td>
                        <td class="status">
                            <div class="mn" id="buttoncollect-<?= $key->id_fktr; ?>" data-statustransfer="0" data-kurang="0" data-statuskirim="0" data-faktur="JK191212135012" data-id="<?= $key->id_fktr; ?>">
                                <div class="fa-2x d-inline-block ckbyr" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pembayaran Belum ada">
                                    <span class="fa-layers fa-fw">
                                        <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>
                                        <i class="fas fa-wallet text-secondary" data-fa-transform="shrink-6"></i>
                                        <span class="fa-layers fa-fw">
                                            <i class="fas fa-circle text-danger" data-fa-transform="shrink-8 down-1 right-5"></i>
                                            <i class="fas fa-times text-light" data-fa-transform="shrink-10 down-1 right-5"></i>
                                        </span>
                                    </span>
                                </div>
                                <div class="fa-2x d-inline-block set_paket" data-status="belumproses" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pesanan Belum diproses">
                                    <span class="fa-layers fa-fw">

                                        <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>
                                        <i class="fas fa-box-open text-secondary" data-fa-transform="shrink-6"></i>
                                        <span class="fa-layers fa-fw">
                                            <i class="fas fa-circle text-warning" data-fa-transform="shrink-8 down-1 right-5"></i>
                                            <i class="fas fa-times text-light" data-fa-transform="shrink-10 down-1 right-5"></i>
                                        </span>
                                    </span>
                                </div>
                                <div class="fa-2x d-inline-block cant_kirim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pesanan Belum dikirim">
                                    <span class="fa-layers fa-fw">

                                    <i class="fas fa-circle text-light" data-fa-transform="grow-2"></i>
                                    <i class="fas fa-cubes text-secondary" data-fa-transform="shrink-6"></i>
                                    <span class="fa-layers fa-fw">
                                        <i class="fas fa-circle text-danger" data-fa-transform="shrink-8 down-1 right-5"></i>
                                        <i class="fas fa-times text-light" data-fa-transform="shrink-10 down-1 right-5"></i>
                                    </span>
                                </span>
                                </div>
                                <div class="dropdown dropright">
                                    <button class="btn btn-outline-primary btn-sm btn-block" type="button" id="setting-<?= $key->id_fktr; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cog fa-spin"></i>    
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="setting-<?= $key->id_fktr; ?>">
                                        <h6 class="dropdown-header">Atur</h6>
                                        <button class="ckbyr dropdown-item">Pembayaran</button>
                                        <button class="set_paket dropdown-item" data-status="belumproses">Status Paket</button>
                                        <button class="cant_kirim dropdown-item">Pengiriman</button>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">Lainnya</h6><a class="dropdown-item" href="https://djuragan.com/new/index.php/faktur/pdf/JK191212135012">Unduh PDF</a><a href="https://djuragan.com/new/index.php/faktur/sunting/JK191212135012" class="dropdown-item">Sunting</a>
                                        <button class="dropdown-item text-danger hapus_pesanan">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-weight-bold"><?= strtoupper($key->nama_plgn) ?></span><br/>
                            <?php 
                            $hp_pelanggan = json_decode($key->hp); 
                            $p = 0;
                            foreach ($hp_pelanggan as $phone) {
                                $cl = '';
                                if($p ===1) {
                                    echo '<span class="sr-only"> / </span>';
                                    $cl = ' ml-1';
                                }
                                echo '<span class="badge badge-dark'.$cl.'">' .$phone. '</span>';
                                $p++;
                            }

                            echo '<br/>' . strtoupper($key->alamat);
                            ?>
                        </td>
                        <td class="pesanan">
                            <?php
                            $barang = html_entity_decode($key->barang, ENT_QUOTES);
                            foreach (json_decode($barang) as $brg) {
                                $content_pop = '@ <strong>' . number_to_currency($brg->harga, 'IDR') . '</strong>';
                                if ($brg->qty > 1) {
                                    $content_pop .= '<br/>total: <strong>' . number_to_currency($brg->harga*$brg->qty, 'IDR') . '</strong>';
                                }

                                echo '<div>';
                                    echo $brg->kode . ' (' . $brg->size . ') = ' . $brg->qty . 'pcs';
                                    echo form_button([
                                        'content' => '<i class="fas fa-info-circle"></i>',
                                        'class' => 'btn btn-link btn-sm text-secondary p-0 ml-1',
                                        'data-content' => $content_pop,
                                        'data-toggle' => 'popHarga'
                                    ]);
                                echo '</div>';

                                $wajib_bayar += ($brg->harga * $brg->qty);
                                $wajib_kirim += $brg->qty;
                            }

                            ?>
                            <hr/>
                            <em>total: <span class="badge badge-pill badge-dark"><?= $wajib_kirim; ?></span> pcs</em>
                        </td>
                        <td class="pembayaran">
                            <span id="status_pesan" class="d-block text-center border border-danger text-uppercase py-1 font-weight-bold rounded">Belum Lunas</span>
                            <span class="d-block text-right">harga produk : <span class="badge badge-info"><?= number_to_currency($wajib_bayar, 'IDR'); ?></span></span>
                            <?php 
                            $ongkir     = 0;
                            $unik       = 0;
                            $diskon     = 0;
                            if ($key->ongkir !== NULL) {
                                $show_ongkir = 'tarif ongkir : <span class="badge badge-dark">'.number_to_currency($key->ongkir, 'IDR').'</span>';
                            } else {
                                $show_ongkir = '<span class="badge badge-dark">FREE ONGKIR</span>';
                            }
                            echo '<span class="d-block text-right">'. $show_ongkir .'</span>';
                            
                            if ($key->unik !== NULL) {
                                $unik = $key->unik;
                                echo '<span class="d-block text-right">angka unik : <span class="badge badge-secondary">'.number_to_currency($unik, 'IDR').'</span></span>';
                            }
                            if ($key->diskon !== NULL) {
                                $diskon = $key->diskon;
                                echo '<span class="d-block text-right">diskon : <span class="badge badge-warning">'.number_to_currency($diskon, 'IDR').'</span></span>';
                            }

                            $total_bayar = $wajib_bayar + $ongkir + $unik - $diskon;
                            ?>
                            
                            <span class="d-block text-right">wajib bayar : <span class="badge badge-success"><?= number_to_currency($total_bayar, 'IDR'); ?></span></span>
                        </td>
                        <td class="keterangan">
                        <?php if ($key->keterangan !== NULL) { ?>

                            <button class="btn btn-outline-info dropdown-toggle btn-sm mb-1 mr-1" type="button" data-toggle="collapse" data-target="#collapseKeterangan-<?= $key->id_fktr; ?>" aria-expanded="false" aria-controls="collapseKeterangan-<?= $key->id_fktr; ?>">
                                <i class="fas fa-scroll"></i> Keterangan
                            </button>
                            <div class="collapse show" id="collapseKeterangan-<?= $key->id_fktr; ?>">
                                <p class="text-break" style="max-width:200px;"><?= nl2br($key->keterangan); ?></p>
                            </div>

                        <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item active"><a class="page-link" href="#!"><span class="sr-only">(current)</span>1</a></li>
            <li class="page-item"><a href="https://djuragan.com/new/index.php/faktur/data/s_juragan?halaman=25" class="page-link" data-ci-pagination-page="2">2</a></li>
            <li class="page-item"><a href="https://djuragan.com/new/index.php/faktur/data/s_juragan?halaman=50" class="page-link" data-ci-pagination-page="3">3</a></li>
            <li class="page-item">
                <a href="https://djuragan.com/new/index.php/faktur/data/s_juragan?halaman=25" class="page-link" data-ci-pagination-page="2" rel="next">
                    <i class="fas fa-angle-right"></i>    
                </a>
            </li>
            <li class="page-item">
                <a href="https://djuragan.com/new/index.php/faktur/data/s_juragan?halaman=37350" class="page-link" data-ci-pagination-page="1495">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>
