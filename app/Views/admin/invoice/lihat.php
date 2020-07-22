<?php 
use CodeIgniter\I18n\Time;
$pager = \Config\Services::pager();
?>
<?= $this->extend('template/logged') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

    <h1 class="h3 mt-5">Semua Orderan</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
            <li class="breadcrumb-item"><?= anchor('invoices', 'Orderan'); ?></li>
            <li class="breadcrumb-item active" aria-current="page">Semua Orderan</li>
        </ol>
    </nav>

    <div class="wrap-btn-filter mb-3">
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Semua Orderan</a>
        <a class="mb-2 btn btn-sm btn-primary rounded-pill mr-1" href="#!">Belum Diproses</a>
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Dalam Proses</a>
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Dibatalkan</a>
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Tunggu Konfirmasi Transfer</a>
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Cicilan</a>
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Lunas</a>
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Belum dikirim</a>
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Dikirim Sebagian</a>
        <a class="mb-2 btn btn-sm btn-outline-secondary rounded-pill mr-1" href="#!">Selesai Dikirim</a>
    </div>

    <div class="card rounded-lg shadow-sm mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title mb-0">#283547687</h5>
                    <p class="text-muted small mb-1">(Kamis, 16 Jul 2020 13:08)</p>
                </div>

                <div>
                    <ul class="timeline mb-0 position-relative">
                        <li class="start full" data-toggle="tooltip" data-placement="top" title="Pesanan Ditambahkan">
                            <i class="fad fa-plus-circle icon"></i>
                            <span>16/7</span>
                        </li>
                        <li class="half" data-toggle="tooltip" data-placement="top" title="Dibayar Lunas">
                            <i class="fad fa-wallet icon"></i>
                            <span>16/7</span>
                        </li>
                        <li class="full" data-toggle="tooltip" data-placement="top" title="Data Pesanan Lengkap">
                            <i class="fad fa-file-alt icon"></i>
                            <span>16/7</span>
                        </li>
                        <li class="full" data-toggle="tooltip" data-placement="top" title="Bahan belum ada">
                            <i class="fad fa-layer-group icon"></i>
                            <span>16/7</span>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" title="Sedang di-sablon">
                            <i class="fad fa-print icon"></i>
                            <span>16/7</span>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" title="Sedang di-bordir">
                            <i class="fad fa-waveform-path icon fa-rotate-90"></i>
                            <span>16/7</span>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" title="Belum masuk penjahit">
                            <i class="fad fa-cut fa-rotate-270 icon"></i>
                            <span>16/7</span>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" title="Belum masuk QC">
                            <i class="fad fa-tasks icon"></i>
                            <span>16/7</span>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" title="Belum dipacking">
                            <i class="fad fa-box-alt icon"></i>
                            <span>16/7</span>
                        </li>
                        <li class="end" data-toggle="tooltip" data-placement="top" title="Belum Dikirim">
                            <i class="fad fa-shipping-fast icon"></i>
                            <span>16/7</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="mt-0" />

            <div class="row">
                <div class="col-12 col-sm-3 mb-3">
                    <div class="mb-3">
                        <div class="card-subtitle text-muted text-uppercase small">Pemesan</div>
                        <h3 class="h4">Nama Pemesan</h3>
                    </div>

                    <div class="mb-3">
                        <div class="card-subtitle text-muted text-uppercase small">Dikirim Kepada</div>
                        <h3 class="h4">Nama Pemesan</h3>
                    </div>

                    <div class="small">
                        <span class="text-muted text-lowercase">Juragan:</span> Juragan Saya<br/>
                        <span class="text-muted text-lowercase">Admin/CS:</span> Nama Saya
                    </div>

                </div>
                <div class="col-12 col-sm-3 mb-3">
                    
                    <div class="mb-3">
                        <div class="card-subtitle text-muted text-uppercase small">Info Biaya</div>

                        <div class="list-group">
                            <div class="list-group-item list-group-item-primary">
                                <div class="text-right">
                                    <div class="small text-uppercase">Wajib Bayar</div>
                                    <div class="h1 mb-0">Rp 20.000</div>
                                    <a href="#!" class="badge rounded-pill text-light text-decoration-none bg-dark"><i class="fad fa-info-circle"></i> Detail</a>
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-dark d-flex justify-content-between">
                                <div class="text-left">
                                    <div class="small text-muted text-uppercase">Kekurangan</div>
                                    <div class="lead font-weight-normal">Rp 20.000</div>
                                </div>
                                <div class="text-right">
                                    <div class="small text-muted text-uppercase">Sudah Bayar</div>
                                    <div class="lead font-weight-normal">Rp 20.000</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-2 mb-3">
                    <div class="mb-3">
                        <div class="card-subtitle text-muted text-uppercase small">Produk</div>
                        <ul class="list-unstyled">
                            <li>SK-12 (S) 2pcs 
                                <button data-toggle="popHarga" data-content="harga satuan: <strong>Rp 1.000.000,-</strong><br/>harga total: <strong>Rp 4.000.000,-</strong>" class="btn btn-link btn-sm text-secondary" data-original-title="" title=""><i class="fad fa-info-circle"></i></button>
                            </li>
                            <li>SK-12 (S) 2pcs</li>
                            <li>SK-12 (S) 2pcs</li>
                        </ul>
                    </div>
                    
                </div>

                <div class="col-12 col-sm-4 mb-3">
                    <div class="mb-3">
                        <div class="card-subtitle text-muted text-uppercase small">Kurir</div>
                        
                        <div class="d-flex align-items-center">
                            <div class="logo">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500"><defs/><g fill="none" fill-rule="evenodd"><rect width="500" height="500" fill="#313B97" rx="53"/><path fill="#EC2C25" fill-rule="nonzero" d="M158 258l-1 8 13-2 5-25a798 798 0 00-13 4l-4 15zM26 293l42-11 2-9-3 1-41 19zm248-68l2-8-5 1 3 7zm188-22a1445 1445 0 00-123 6l-12 1-8 41 12-1a1206 1206 0 0150-1h83l9-46h-11zm-241 55l20-2-14-26-6 28z"/><path d="M110 314h-5l-1 8h1l4-1 2-1 1-3-1-2-1-1zm18 0h-5l-1 8h2l5-1 1-2 1-2-1-3h-2z"/><path fill="#FFF" fill-rule="nonzero" d="M65 325h10l1-5H65l1-6h11v-5H63l-4 29h15l1-5H64l1-8zm35-16h-5l-3 5-3 5v-1l-1-4-2-5h-4l5 14-9 15h5l3-4 2-5 2 5 2 4h4l-5-14 9-15zm14 0h-11l-4 29h4l1-11h6l3-1 2-2a13 13 0 001-3l1-5-1-4-2-3zm-2 11l-2 1-4 1h-1l1-8h6v1a5 5 0 011 2l-1 3zm21-11h-12l-4 29h4l2-12h1l2 1 2 3 2 8h4a87 87 0 00-4-12l4-3 2-7-1-4-2-3zm-2 10l-1 2-5 1h-2l1-8h7l1 3-1 2zm6 19h16v-5h-11l1-8h10l1-5h-10l1-6h10l1-5h-15l-4 29zm28-25l3 1 1 2h4l-2-6-6-2-5 2-2 7 1 4 2 2 3 3 3 2v1l1 1-1 3-3 1-4-2v-3h-4l1 5 2 4 5 1c2 0 4-1 5-3 2-2 2-4 2-7l-1-5-4-3-3-3-1-2 1-2 2-1zm23 11l-4-3-3-3v-2-2l3-1 2 1 1 2h4l-2-6-5-2-6 2-1 6v5l2 2 3 3 3 2 1 1v1l-1 3-3 1c-2 0-3-1-3-2l-1-3h-4l1 5 2 4 5 1 6-3 2-7-2-5z"/><path d="M350 327h5l-1-12-4 12zm49-14c-2 0-3 2-5 4a22 22 0 00-1 9l1 5c1 2 2 2 3 2l3-1 3-5 1-6-2-6-3-2z"/><path fill="#FFF" fill-rule="nonzero" d="M337 309l-2 19-6-19h-3l-4 29h3l3-20 5 20h4l4-29h-4zm15 0l-11 29h4l2-7h8v7h4l-3-29h-4zm-3 18l4-12 1 12h-5zm29-18h-15l-1 5h6l-4 24h4l4-24h5l1-5zm0 29h4l4-29h-4l-4 29zm21-30l-5 2-4 4-2 7v5l1 6 2 4c1 2 3 2 5 2l5-2 4-7a28 28 0 002-9l-3-9c-1-2-3-3-5-3zm3 19l-3 5-3 1c-1 0-2 0-3-2l-1-5c0-3 0-6 2-9 1-3 2-4 4-4l4 2 1 5-1 7zm19 1l-5-19h-4l-4 29h4l2-20 6 20h3l4-29h-3l-3 19zm21-4l-4-4-3-2-1-2 1-2 2-1 3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 010 2v2l-3 1-4-1v-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5z"/><path d="M269 313c-2 0-4 2-5 4a22 22 0 00-2 9l1 5c1 2 2 2 4 2l3-1 2-5 1-6-1-6-3-2zm-64 14h5l-1-12-4 12zm44-13h-4l-1 7h6l2-2 1-3-1-2h-3z"/><path fill="#FFF" fill-rule="nonzero" d="M208 309l-11 29h4l2-7h8l1 7h3l-3-29h-4zm-3 18l4-12 1 12h-5zm25 5l-3 1c-1 0-2 0-3-2l-1-5 1-6 2-5 3-2 3 1 1 3h4l-2-6c-2-2-3-3-5-3l-6 2-4 7a30 30 0 00-1 9l2 9c1 2 3 3 6 3l5-2 4-8h-5l-1 4zm24-23h-12l-4 29h4l1-12h4l2 4 2 8h4a84 84 0 00-4-13c2 0 3-1 4-3l2-6-1-4-2-3zm-2 10l-2 2h-6l1-7h7l1 3a6 6 0 01-1 2zm17-11l-5 2-3 4-2 7-1 5 1 6 3 4c1 2 2 2 4 2l6-2 4-7a28 28 0 001-9c0-3 0-6-2-9-1-2-3-3-6-3zm3 19l-2 5-3 1c-2 0-3 0-4-2l-1-5 2-9c1-3 3-4 5-4l3 2 1 5-1 7zm16-14l3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 010 2v2l-3 1-4-1v-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5-4-4-3-2-1-2 1-2 2-1zm23 11l-4-4-3-2-1-2 1-2 2-1 3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 011 2l-1 2-3 1-3-1-1-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5zm70-75l-50 1-8 43h102l7-34h-53l2-10zm-252-88v1l-1 1v3l-13 63a68 68 0 01-1 3l-1 3v5c-2 7-4 12-12 14H74l-4 19-2 8-1 5-1 6v1h53c21-4 33-14 37-25l1-3 1-7 4-16 17-81h-50zm271 0h-50l-10 47 51-4 2-9h52l7-34h-52zm-62 0h-50l-12 56-1 7-4-7-29-55-1-1h-50l-16 78-5 25-6 29h50l7-35 6-28 14 26 20 37h49l9-42 9-42 10-48z"/></g></svg>
                            </div>
                            <div class="mx-2">
                                <div class="lead">3450935488 (2pcs)</div>
                                <p class="mb-0">tarif - Rp 20.000</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="logo">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500"><defs/><g fill="none" fill-rule="evenodd"><rect width="500" height="500" fill="#313B97" rx="53"/><path fill="#EC2C25" fill-rule="nonzero" d="M158 258l-1 8 13-2 5-25a798 798 0 00-13 4l-4 15zM26 293l42-11 2-9-3 1-41 19zm248-68l2-8-5 1 3 7zm188-22a1445 1445 0 00-123 6l-12 1-8 41 12-1a1206 1206 0 0150-1h83l9-46h-11zm-241 55l20-2-14-26-6 28z"/><path d="M110 314h-5l-1 8h1l4-1 2-1 1-3-1-2-1-1zm18 0h-5l-1 8h2l5-1 1-2 1-2-1-3h-2z"/><path fill="#FFF" fill-rule="nonzero" d="M65 325h10l1-5H65l1-6h11v-5H63l-4 29h15l1-5H64l1-8zm35-16h-5l-3 5-3 5v-1l-1-4-2-5h-4l5 14-9 15h5l3-4 2-5 2 5 2 4h4l-5-14 9-15zm14 0h-11l-4 29h4l1-11h6l3-1 2-2a13 13 0 001-3l1-5-1-4-2-3zm-2 11l-2 1-4 1h-1l1-8h6v1a5 5 0 011 2l-1 3zm21-11h-12l-4 29h4l2-12h1l2 1 2 3 2 8h4a87 87 0 00-4-12l4-3 2-7-1-4-2-3zm-2 10l-1 2-5 1h-2l1-8h7l1 3-1 2zm6 19h16v-5h-11l1-8h10l1-5h-10l1-6h10l1-5h-15l-4 29zm28-25l3 1 1 2h4l-2-6-6-2-5 2-2 7 1 4 2 2 3 3 3 2v1l1 1-1 3-3 1-4-2v-3h-4l1 5 2 4 5 1c2 0 4-1 5-3 2-2 2-4 2-7l-1-5-4-3-3-3-1-2 1-2 2-1zm23 11l-4-3-3-3v-2-2l3-1 2 1 1 2h4l-2-6-5-2-6 2-1 6v5l2 2 3 3 3 2 1 1v1l-1 3-3 1c-2 0-3-1-3-2l-1-3h-4l1 5 2 4 5 1 6-3 2-7-2-5z"/><path d="M350 327h5l-1-12-4 12zm49-14c-2 0-3 2-5 4a22 22 0 00-1 9l1 5c1 2 2 2 3 2l3-1 3-5 1-6-2-6-3-2z"/><path fill="#FFF" fill-rule="nonzero" d="M337 309l-2 19-6-19h-3l-4 29h3l3-20 5 20h4l4-29h-4zm15 0l-11 29h4l2-7h8v7h4l-3-29h-4zm-3 18l4-12 1 12h-5zm29-18h-15l-1 5h6l-4 24h4l4-24h5l1-5zm0 29h4l4-29h-4l-4 29zm21-30l-5 2-4 4-2 7v5l1 6 2 4c1 2 3 2 5 2l5-2 4-7a28 28 0 002-9l-3-9c-1-2-3-3-5-3zm3 19l-3 5-3 1c-1 0-2 0-3-2l-1-5c0-3 0-6 2-9 1-3 2-4 4-4l4 2 1 5-1 7zm19 1l-5-19h-4l-4 29h4l2-20 6 20h3l4-29h-3l-3 19zm21-4l-4-4-3-2-1-2 1-2 2-1 3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 010 2v2l-3 1-4-1v-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5z"/><path d="M269 313c-2 0-4 2-5 4a22 22 0 00-2 9l1 5c1 2 2 2 4 2l3-1 2-5 1-6-1-6-3-2zm-64 14h5l-1-12-4 12zm44-13h-4l-1 7h6l2-2 1-3-1-2h-3z"/><path fill="#FFF" fill-rule="nonzero" d="M208 309l-11 29h4l2-7h8l1 7h3l-3-29h-4zm-3 18l4-12 1 12h-5zm25 5l-3 1c-1 0-2 0-3-2l-1-5 1-6 2-5 3-2 3 1 1 3h4l-2-6c-2-2-3-3-5-3l-6 2-4 7a30 30 0 00-1 9l2 9c1 2 3 3 6 3l5-2 4-8h-5l-1 4zm24-23h-12l-4 29h4l1-12h4l2 4 2 8h4a84 84 0 00-4-13c2 0 3-1 4-3l2-6-1-4-2-3zm-2 10l-2 2h-6l1-7h7l1 3a6 6 0 01-1 2zm17-11l-5 2-3 4-2 7-1 5 1 6 3 4c1 2 2 2 4 2l6-2 4-7a28 28 0 001-9c0-3 0-6-2-9-1-2-3-3-6-3zm3 19l-2 5-3 1c-2 0-3 0-4-2l-1-5 2-9c1-3 3-4 5-4l3 2 1 5-1 7zm16-14l3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 010 2v2l-3 1-4-1v-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5-4-4-3-2-1-2 1-2 2-1zm23 11l-4-4-3-2-1-2 1-2 2-1 3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 011 2l-1 2-3 1-3-1-1-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5zm70-75l-50 1-8 43h102l7-34h-53l2-10zm-252-88v1l-1 1v3l-13 63a68 68 0 01-1 3l-1 3v5c-2 7-4 12-12 14H74l-4 19-2 8-1 5-1 6v1h53c21-4 33-14 37-25l1-3 1-7 4-16 17-81h-50zm271 0h-50l-10 47 51-4 2-9h52l7-34h-52zm-62 0h-50l-12 56-1 7-4-7-29-55-1-1h-50l-16 78-5 25-6 29h50l7-35 6-28 14 26 20 37h49l9-42 9-42 10-48z"/></g></svg>
                            </div>
                            <div class="mx-2">
                                <div class="lead">3450935488 (2pcs)</div>
                                <p class="mb-0">tarif - Rp 20.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />

            <!-- Example split danger button -->
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Action</button>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>


        </div>
    </div>
</div>

<?= $this->endSection() ?>