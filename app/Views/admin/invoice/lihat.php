<?php

use CodeIgniter\I18n\Time;
use App\Libraries\Ongkir;

$sekarang = new Time('now');
$pager = \Config\Services::pager();
?>
<?= $this->extend('template/default_admin') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

	<h1 class="h3 mt-5"><?= $title; ?></h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb p-0">
			<li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
			<li class="breadcrumb-item"><?= anchor('admin/invoices', 'Orderan'); ?></li>
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

	<?php
	if (count($pesanans) > 0) {
		foreach ($pesanans as $pesanan) { ?>
			<div class="card rounded-lg shadow-sm mb-3">
				<div class="card-body">
					<div class="d-flex flex-column flex-sm-row justify-content-between">
						<div class="d-flex align-items-center">
							<div class="mr-3">
								<h5 class="card-title mb-0">#<?= $pesanan->seri; ?></h5>
								<p class="text-muted small mb-1">
									(
									<?php
									$time = Time::createFromFormat('Y-m-d', $pesanan->tanggal_pesan);
									echo $time->toLocalizedString('EEEE, d MMMM yyyy');
									?>
									)
								</p>
							</div>

							<div class="border-left pl-3">
								<?php
								$juragan = json_decode($pesanan->juragan);
								$pengguna = json_decode($pesanan->pengguna);
								?>
								<span class="text-muted text-lowercase">Juragan:</span> <?= anchor('admin/invoices/lihat/' . $juragan->slug, $juragan->nama); ?><br />
								<span class="text-muted text-lowercase">Admin/CS:</span> <?= $pengguna->nama; ?>
							</div>
						</div>

						<div>
							<ul class="list-inline mb-0 timeliner">
								<li class="list-inline-item mr-0 position-relative start full" data-toggle="tooltip" data-placement="top" title="Pesanan Ditambahkan">
									<div class="d-flex justify-content-center">
										<div class="text-center">
											<i class="fad fa-plus-circle icon d-block"></i>
											<?= '<span><abbr title="' . $time->humanize() . '">' . $time->day . '/' . $time->month . '</abbr></span>'; ?>
										</div>
									</div>
								</li>

								<?= status_pembayaran($pesanan->pembayaran, $pesanan->status_pembayaran); ?>

								<?php
								$statuss = json_decode($pesanan->status);
								$dipacking = FALSE;
								if ($statuss !== NULL) {
									foreach ($statuss as $status) {
										echo status_orderan($status->status, $status->tanggal_masuk, $status->tanggal_selesai, $status->keterangan_masuk, $status->keterangan_selesai);

										if (isset($status->status) && $status->status == 7) {
											if ($status->tanggal_selesai !== NULL) {
												$dipacking = TRUE;
											}
										}
									}
								}
								?>
								<?php if ($dipacking) { ?>
									<li class="list-inline-item mr-0 position-relative end" data-toggle="tooltip" data-placement="top" title="Belum dikirim">
										<div class="d-flex justify-content-center">
											<div class="text-center">
												<i class="fad fa-truck icon d-block"></i>
												<span>??/??</span>
											</div>
										</div>
									</li>
								<?php }
								?>
							</ul>
						</div>
					</div>
					<hr class="mt-0" />

					<div class="row">
						<div class="col-12 col-sm-3 mb-3">
							<div class="mb-3">
								<div class="card-subtitle text-muted text-uppercase small">Pelanggan</div>
								<div class="border-bottom pb-2">
									<?php $pelanggan = json_decode($pesanan->pelanggan); ?>
									<span class="d-block font-weight-bold"><?= strtoupper($pelanggan->nama); ?></span>
									<span class="d-block lead">
										<?php
										for ($i = 0; $i < count($pelanggan->hp); $i++) {
											if ($i === 1) {
												echo '<span class="sr-only">/</span>';
											}
											echo '<span class="badge bg-secondary mr-1 font-weight-light">' . $pelanggan->hp[$i] . '</span>';
										}
										?>
									</span>
									<span class="d-block">
										<?php
										if ($pelanggan->cod === 1) {
											echo 'C.O.D';
										} else {
											//
											$ongkir = new Ongkir();

											$PPro = $pelanggan->provinsi;
											$PKab = $pelanggan->kabupaten;
											$PKec = $pelanggan->kecamatan;
											$kota = $ongkir->kota($PPro, $PKab);

											$kec = strtoupper($ongkir->kecamatan($PKab, $PKec)['subdistrict_name']);
											$kab = strtoupper(($kota['type'] === 'Kabupaten' ? '' : '(Kota) ') . $kota['city_name']);
											$prov = strtoupper($ongkir->provinsi($PPro)['province']);

											echo $pelanggan->alamat . '<br/>' . $kec . ', ' . $kab  . '<br/>' . $prov . ' - ' . $pelanggan->kodepos;
										}
										?>
									</span>
								</div>
							</div>

							<div>
								<div class="card-subtitle text-muted text-uppercase small">Asal Orderan</div>
								<div><?= label_asal($pesanan->source_id, $pesanan->label_asal); ?></div>
							</div>
						</div>

						<div class="col-12 col-sm-2 mb-3">
							<div class="mb-3">
								<div class="card-subtitle text-muted text-uppercase small">Produk</div>
								<ul class="list-unstyled">
									<?php
									$wajib_bayar = 0;
									$count_barang = 0;
									$harga_barang = 0;
									foreach (json_decode($pesanan->barang) as $b) {
										$count_barang += $b->qty;
										$wajib_bayar += $b->qty * $b->harga;
										$harga_barang += $b->qty * $b->harga;
										echo '<li>';
										echo strtoupper($b->kode) . ' (' . strtoupper($b->ukuran) . ')= ' . $b->qty . 'pcs';

										$content = '<div class=\'text-right\'>';
										$content .= 'harga @: <strong>' . number_to_currency($b->harga, 'IDR') . '</strong>';
										if ($b->qty > 1) {
											$content .= '<br/>harga @ x ' . $b->qty . ': <strong>' . number_to_currency($b->harga * $b->qty, 'IDR') . '</strong>';
										}
										$content .= '</div>';

										echo form_button(
											[
												'data-toggle' => 'popHarga',
												'data-content' => $content,
												'content' => '<i class="fad fa-info-circle"></i> <span class="sr-only">info</span>',
												'class' => 'btn btn-link btn-sm text-secondary'
											]
										);
										echo '</li>';
									}
									?>
									<li class="border-top pt-2">total: <span class="badge rounded-pill bg-dark"><?= $count_barang; ?></span> pcs</li>
								</ul>
							</div>
						</div>

						<div class="col-12 col-sm-3 mb-3">
							<div class="mb-3">
								<div class="card-subtitle text-muted text-uppercase small">Info Biaya</div>
								<div class="d-flex flex-column-reverse">
									<div class="p-2 mx-1 list-group-item-secondary">
										<div class="d-flex justify-content-between align-items-center">
											<div class="small d-flex text-muted text-uppercase">Harga Produk</div>
											<div class="font-weight-bold"><?= number_to_currency($harga_barang, 'IDR'); ?></div>
										</div>

										<?php
										if ($pesanan->biaya !== NULL) {
											foreach (json_decode($pesanan->biaya) as $c) {
												$wajib_bayar += $c->nominal;
										?>

												<div class="d-flex justify-content-between align-items-center">
													<div class="small d-flex text-muted text-uppercase text-truncate">
														<span class="font-weight-bold">
															<?php
															$biaya = 'Lainnya';
															if ($c->biaya_id === 1) {
																$biaya = 'Ongkir';
															}
															$label = $c->label;
															if ($c->label !== "null" && $c->biaya_id !== 1) {
																$biaya = $c->label;
																$label = '';
															} elseif ($c->label === 'null' && $c->biaya_id !== 1) {
																$label = '';
															}
															?>
															<?= $biaya; ?>
														</span>&nbsp;
														<?= $label; ?>
													</div>
													<div class="font-weight-bold text-nowrap pl-2 <?= ($c->nominal < 0 ? 'text-danger' : ''); ?>"><?= number_to_currency($c->nominal, 'IDR'); ?></div>
												</div>
											<?php }
										}
										echo '<hr/>';
										$sudah_bayar = status_pembayaran($pesanan->pembayaran, $pesanan->status_pembayaran, 'sudah_bayar');
										if ($sudah_bayar > 0) {
											?>

											<div class="d-flex justify-content-between align-items-center">
												<div class="small d-flex text-muted text-uppercase"><span class="font-weight-bold">
														Sudah</span>&nbsp;Bayar
													<?= form_button([
														'class' 		=> 'text-dark ml-1 pesanBayar',
														'content' 		=> '<i class="fad fa-info-circle"></i> <span class="sr-only">info</span>',
														'data-bayar' 	=> esc($pesanan->pembayaran),
														'data-invoice' 	=> $pesanan->id_invoice,
														'data-juragan' 	=> $juragan->id,
														'data-target' 	=> '#modalBayar',
														'data-toggle' 	=> 'modal',
														'style' 		=> 'border:none; background:transparent'
													]);
													?>
												</div>
												<div class="font-weight-bold"><?= number_to_currency($sudah_bayar, 'IDR'); ?></div>
											</div>
										<?php }
										if (($wajib_bayar - $sudah_bayar) > 0) {
										?>
											<div class="d-flex justify-content-between align-items-center">
												<div class="small d-flex text-muted text-uppercase"><span class="font-weight-bold">Kurang</span>&nbsp;Bayar</div>
												<div class="font-weight-bold text-danger"><?= number_to_currency(- ($wajib_bayar - $sudah_bayar), 'IDR'); ?></div>
											</div>
										<?php }
										if ($sudah_bayar > $wajib_bayar) {
										?>
											<div class="d-flex justify-content-between align-items-center">
												<div class="small d-flex text-muted text-uppercase"><span class="font-weight-bold">Lebih</span>&nbsp;Bayar</div>
												<div class="font-weight-bold"><?= number_to_currency(($sudah_bayar - $wajib_bayar), 'IDR'); ?></div>
											</div>
										<?php }
										?>
									</div>
									<div class="p-2 list-group-item-<?= status_pembayaran($pesanan->pembayaran, $pesanan->status_pembayaran, 'l_class');; ?> shadow rounded rounded-sm">
										<div class="d-flex justify-content-between align-items-center">
											<div class="small text-uppercase">Wajib Bayar</div>
											<div class="h3 mb-0"><?= number_to_currency($wajib_bayar, 'IDR'); ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-sm-4 mb-3">
							<div class="mb-3">
								<div class="card-subtitle text-muted text-uppercase small">Kurir</div>

								<div class="d-flex align-items-center">
									<div class="logo">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
											<defs />
											<g fill="none" fill-rule="evenodd">
												<rect width="500" height="500" fill="#313B97" rx="53" />
												<path fill="#EC2C25" fill-rule="nonzero" d="M158 258l-1 8 13-2 5-25a798 798 0 00-13 4l-4 15zM26 293l42-11 2-9-3 1-41 19zm248-68l2-8-5 1 3 7zm188-22a1445 1445 0 00-123 6l-12 1-8 41 12-1a1206 1206 0 0150-1h83l9-46h-11zm-241 55l20-2-14-26-6 28z" />
												<path d="M110 314h-5l-1 8h1l4-1 2-1 1-3-1-2-1-1zm18 0h-5l-1 8h2l5-1 1-2 1-2-1-3h-2z" />
												<path fill="#FFF" fill-rule="nonzero" d="M65 325h10l1-5H65l1-6h11v-5H63l-4 29h15l1-5H64l1-8zm35-16h-5l-3 5-3 5v-1l-1-4-2-5h-4l5 14-9 15h5l3-4 2-5 2 5 2 4h4l-5-14 9-15zm14 0h-11l-4 29h4l1-11h6l3-1 2-2a13 13 0 001-3l1-5-1-4-2-3zm-2 11l-2 1-4 1h-1l1-8h6v1a5 5 0 011 2l-1 3zm21-11h-12l-4 29h4l2-12h1l2 1 2 3 2 8h4a87 87 0 00-4-12l4-3 2-7-1-4-2-3zm-2 10l-1 2-5 1h-2l1-8h7l1 3-1 2zm6 19h16v-5h-11l1-8h10l1-5h-10l1-6h10l1-5h-15l-4 29zm28-25l3 1 1 2h4l-2-6-6-2-5 2-2 7 1 4 2 2 3 3 3 2v1l1 1-1 3-3 1-4-2v-3h-4l1 5 2 4 5 1c2 0 4-1 5-3 2-2 2-4 2-7l-1-5-4-3-3-3-1-2 1-2 2-1zm23 11l-4-3-3-3v-2-2l3-1 2 1 1 2h4l-2-6-5-2-6 2-1 6v5l2 2 3 3 3 2 1 1v1l-1 3-3 1c-2 0-3-1-3-2l-1-3h-4l1 5 2 4 5 1 6-3 2-7-2-5z" />
												<path d="M350 327h5l-1-12-4 12zm49-14c-2 0-3 2-5 4a22 22 0 00-1 9l1 5c1 2 2 2 3 2l3-1 3-5 1-6-2-6-3-2z" />
												<path fill="#FFF" fill-rule="nonzero" d="M337 309l-2 19-6-19h-3l-4 29h3l3-20 5 20h4l4-29h-4zm15 0l-11 29h4l2-7h8v7h4l-3-29h-4zm-3 18l4-12 1 12h-5zm29-18h-15l-1 5h6l-4 24h4l4-24h5l1-5zm0 29h4l4-29h-4l-4 29zm21-30l-5 2-4 4-2 7v5l1 6 2 4c1 2 3 2 5 2l5-2 4-7a28 28 0 002-9l-3-9c-1-2-3-3-5-3zm3 19l-3 5-3 1c-1 0-2 0-3-2l-1-5c0-3 0-6 2-9 1-3 2-4 4-4l4 2 1 5-1 7zm19 1l-5-19h-4l-4 29h4l2-20 6 20h3l4-29h-3l-3 19zm21-4l-4-4-3-2-1-2 1-2 2-1 3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 010 2v2l-3 1-4-1v-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5z" />
												<path d="M269 313c-2 0-4 2-5 4a22 22 0 00-2 9l1 5c1 2 2 2 4 2l3-1 2-5 1-6-1-6-3-2zm-64 14h5l-1-12-4 12zm44-13h-4l-1 7h6l2-2 1-3-1-2h-3z" />
												<path fill="#FFF" fill-rule="nonzero" d="M208 309l-11 29h4l2-7h8l1 7h3l-3-29h-4zm-3 18l4-12 1 12h-5zm25 5l-3 1c-1 0-2 0-3-2l-1-5 1-6 2-5 3-2 3 1 1 3h4l-2-6c-2-2-3-3-5-3l-6 2-4 7a30 30 0 00-1 9l2 9c1 2 3 3 6 3l5-2 4-8h-5l-1 4zm24-23h-12l-4 29h4l1-12h4l2 4 2 8h4a84 84 0 00-4-13c2 0 3-1 4-3l2-6-1-4-2-3zm-2 10l-2 2h-6l1-7h7l1 3a6 6 0 01-1 2zm17-11l-5 2-3 4-2 7-1 5 1 6 3 4c1 2 2 2 4 2l6-2 4-7a28 28 0 001-9c0-3 0-6-2-9-1-2-3-3-6-3zm3 19l-2 5-3 1c-2 0-3 0-4-2l-1-5 2-9c1-3 3-4 5-4l3 2 1 5-1 7zm16-14l3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 010 2v2l-3 1-4-1v-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5-4-4-3-2-1-2 1-2 2-1zm23 11l-4-4-3-2-1-2 1-2 2-1 3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 011 2l-1 2-3 1-3-1-1-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5zm70-75l-50 1-8 43h102l7-34h-53l2-10zm-252-88v1l-1 1v3l-13 63a68 68 0 01-1 3l-1 3v5c-2 7-4 12-12 14H74l-4 19-2 8-1 5-1 6v1h53c21-4 33-14 37-25l1-3 1-7 4-16 17-81h-50zm271 0h-50l-10 47 51-4 2-9h52l7-34h-52zm-62 0h-50l-12 56-1 7-4-7-29-55-1-1h-50l-16 78-5 25-6 29h50l7-35 6-28 14 26 20 37h49l9-42 9-42 10-48z" />
											</g>
										</svg>
									</div>
									<div class="mx-2">
										<div class="lead">3450935488 (2pcs)</div>
										<p class="mb-0">tarif - Rp 20.000</p>
									</div>
								</div>
								<div class="d-flex align-items-center">
									<div class="logo">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
											<defs />
											<g fill="none" fill-rule="evenodd">
												<rect width="500" height="500" fill="#313B97" rx="53" />
												<path fill="#EC2C25" fill-rule="nonzero" d="M158 258l-1 8 13-2 5-25a798 798 0 00-13 4l-4 15zM26 293l42-11 2-9-3 1-41 19zm248-68l2-8-5 1 3 7zm188-22a1445 1445 0 00-123 6l-12 1-8 41 12-1a1206 1206 0 0150-1h83l9-46h-11zm-241 55l20-2-14-26-6 28z" />
												<path d="M110 314h-5l-1 8h1l4-1 2-1 1-3-1-2-1-1zm18 0h-5l-1 8h2l5-1 1-2 1-2-1-3h-2z" />
												<path fill="#FFF" fill-rule="nonzero" d="M65 325h10l1-5H65l1-6h11v-5H63l-4 29h15l1-5H64l1-8zm35-16h-5l-3 5-3 5v-1l-1-4-2-5h-4l5 14-9 15h5l3-4 2-5 2 5 2 4h4l-5-14 9-15zm14 0h-11l-4 29h4l1-11h6l3-1 2-2a13 13 0 001-3l1-5-1-4-2-3zm-2 11l-2 1-4 1h-1l1-8h6v1a5 5 0 011 2l-1 3zm21-11h-12l-4 29h4l2-12h1l2 1 2 3 2 8h4a87 87 0 00-4-12l4-3 2-7-1-4-2-3zm-2 10l-1 2-5 1h-2l1-8h7l1 3-1 2zm6 19h16v-5h-11l1-8h10l1-5h-10l1-6h10l1-5h-15l-4 29zm28-25l3 1 1 2h4l-2-6-6-2-5 2-2 7 1 4 2 2 3 3 3 2v1l1 1-1 3-3 1-4-2v-3h-4l1 5 2 4 5 1c2 0 4-1 5-3 2-2 2-4 2-7l-1-5-4-3-3-3-1-2 1-2 2-1zm23 11l-4-3-3-3v-2-2l3-1 2 1 1 2h4l-2-6-5-2-6 2-1 6v5l2 2 3 3 3 2 1 1v1l-1 3-3 1c-2 0-3-1-3-2l-1-3h-4l1 5 2 4 5 1 6-3 2-7-2-5z" />
												<path d="M350 327h5l-1-12-4 12zm49-14c-2 0-3 2-5 4a22 22 0 00-1 9l1 5c1 2 2 2 3 2l3-1 3-5 1-6-2-6-3-2z" />
												<path fill="#FFF" fill-rule="nonzero" d="M337 309l-2 19-6-19h-3l-4 29h3l3-20 5 20h4l4-29h-4zm15 0l-11 29h4l2-7h8v7h4l-3-29h-4zm-3 18l4-12 1 12h-5zm29-18h-15l-1 5h6l-4 24h4l4-24h5l1-5zm0 29h4l4-29h-4l-4 29zm21-30l-5 2-4 4-2 7v5l1 6 2 4c1 2 3 2 5 2l5-2 4-7a28 28 0 002-9l-3-9c-1-2-3-3-5-3zm3 19l-3 5-3 1c-1 0-2 0-3-2l-1-5c0-3 0-6 2-9 1-3 2-4 4-4l4 2 1 5-1 7zm19 1l-5-19h-4l-4 29h4l2-20 6 20h3l4-29h-3l-3 19zm21-4l-4-4-3-2-1-2 1-2 2-1 3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 010 2v2l-3 1-4-1v-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5z" />
												<path d="M269 313c-2 0-4 2-5 4a22 22 0 00-2 9l1 5c1 2 2 2 4 2l3-1 2-5 1-6-1-6-3-2zm-64 14h5l-1-12-4 12zm44-13h-4l-1 7h6l2-2 1-3-1-2h-3z" />
												<path fill="#FFF" fill-rule="nonzero" d="M208 309l-11 29h4l2-7h8l1 7h3l-3-29h-4zm-3 18l4-12 1 12h-5zm25 5l-3 1c-1 0-2 0-3-2l-1-5 1-6 2-5 3-2 3 1 1 3h4l-2-6c-2-2-3-3-5-3l-6 2-4 7a30 30 0 00-1 9l2 9c1 2 3 3 6 3l5-2 4-8h-5l-1 4zm24-23h-12l-4 29h4l1-12h4l2 4 2 8h4a84 84 0 00-4-13c2 0 3-1 4-3l2-6-1-4-2-3zm-2 10l-2 2h-6l1-7h7l1 3a6 6 0 01-1 2zm17-11l-5 2-3 4-2 7-1 5 1 6 3 4c1 2 2 2 4 2l6-2 4-7a28 28 0 001-9c0-3 0-6-2-9-1-2-3-3-6-3zm3 19l-2 5-3 1c-2 0-3 0-4-2l-1-5 2-9c1-3 3-4 5-4l3 2 1 5-1 7zm16-14l3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 010 2v2l-3 1-4-1v-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5-4-4-3-2-1-2 1-2 2-1zm23 11l-4-4-3-2-1-2 1-2 2-1 3 1 1 2h4l-2-5c-2-2-3-3-6-3-2 0-4 1-5 3l-2 5v1l1 3 2 3 3 2 3 3a3 3 0 011 2l-1 2-3 1-3-1-1-3h-4l1 5 2 3 5 1c2 0 4 0 5-2 2-2 2-4 2-7l-1-5zm70-75l-50 1-8 43h102l7-34h-53l2-10zm-252-88v1l-1 1v3l-13 63a68 68 0 01-1 3l-1 3v5c-2 7-4 12-12 14H74l-4 19-2 8-1 5-1 6v1h53c21-4 33-14 37-25l1-3 1-7 4-16 17-81h-50zm271 0h-50l-10 47 51-4 2-9h52l7-34h-52zm-62 0h-50l-12 56-1 7-4-7-29-55-1-1h-50l-16 78-5 25-6 29h50l7-35 6-28 14 26 20 37h49l9-42 9-42 10-48z" />
											</g>
										</svg>
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
						<?= anchor('admin/invoices/sunting/' . $pesanan->seri, '<i class="fad fa-pencil"></i> Sunting', ['class' => 'btn btn-outline-secondary', 'role' => 'button']); ?>
						<button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Print Label</a></li>
							<li><a class="dropdown-item" href="#">Unduh Invoice (PDF)</a></li>
							<li>
								<hr class="dropdown-divider" />
							</li>
							<li>
								<?= form_button([
									'class' 		=> 'dropdown-item tambahBayar',
									'content' 		=> 'Tambah Pembayaran',
									'data-invoice' 	=> $pesanan->id_invoice,
									'data-juragan' 	=> $juragan->id,
									'data-kurang' 	=> $wajib_bayar - $sudah_bayar,
									'data-seri' 	=> $pesanan->seri,
									'data-target' 	=> '#modalTambahBayar',
									'data-toggle' 	=> 'modal'
								]); ?>
							</li>
							<li>
								<hr class="dropdown-divider" />
							</li>
							<li>
								<?= form_button([
									'class' 	=> 'dropdown-item hapusOrderan text-danger',
									'content' 	=> 'Hapus',
									'data-invoice' => $pesanan->id_invoice,
									'data-seri' => $pesanan->seri
								]); ?>
							</li>
						</ul>
					</div>

					<?php if ($pesanan->status_pembayaran !== '1') {

						// tombol proses pesanan
						echo form_button([
							'class' 		=> 'btn btn-dark ml-1 pesanStatus',
							'content' 		=> '<i class="fad fa-comment-alt-plus"></i> Proses Orderan',
							'data-invoice' 	=> $pesanan->id_invoice,
							'data-seri' 	=> $pesanan->seri,
							'data-target' 	=> '#modalProgress',
							'data-toggle' 	=> 'modal'
						]);

						if ($pesanan->status_pembayaran === '2' or $pesanan->status_pembayaran === '3') {
							// tombol cek pembayaran
							// hanya tampil jika ada pembayaran yang perlu dicek
							echo form_button([
								'class' 		=> 'btn btn-warning ml-1 pesanBayar',
								'content' 		=> '<i class="fad fa-wallet"></i> Cek Pembayaran',
								'data-bayar' 	=> esc($pesanan->pembayaran),
								'data-invoice' 	=> $pesanan->id_invoice,
								'data-juragan' 	=> $juragan->id,
								'data-target' 	=> '#modalBayar',
								'data-toggle' 	=> 'modal'
							]);
						}
					} ?>
				</div>
			</div>
	<?php
		}
	} else {
		echo '<div class="text-center my-5"><i class="fad fa-5x fa-box-open text-primary"></i><br/>orderan masih kosong</div>';
	}
	?>

</div>

<!-- Modal orderan status-->
<div class="modal fade" id="modalProgress" tabindex="-1" aria-labelledby="modalProgressLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<?= form_open('', ['class' => 'modal-content', 'id' => 'newStatus'], ['id_invoice' => '']); ?>
		<div class="modal-header">
			<h5 class="modal-title" id="modalProgressLabel">Status Proses Orderan</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="mb-3">
				<?= form_label('Pilih Status', 'status', ['class' => 'form-label']); ?>
				<div class="input-group mb-3">
					<?php
					$list_status = [
						'' => 'Pilih status',
						'1' => 'Data Pesanan',
						'2' => 'Bahan Produk',
						'3' => 'Sablon',
						'4' => 'Bordir',
						'5' => 'Penjahit',
						'6' => 'QC',
						'7' => 'Packing'
					];
					echo form_dropdown('status', $list_status, '', ['class' => 'form-select', 'id' => 'status', 'required' => '']);
					echo form_dropdown('stat', ['' => 'Pilih', '1' => 'Ada', '0' => 'Tidak Ada'], '', ['class' => 'form-select', 'id' => 'stat', 'required' => '', 'disabled' => '']);
					?>
				</div>
			</div>

			<div class="mb-3">
				<?= form_label('Note / Keterangan', 'keterangan', ['class' => 'form-label']); ?>
				<?= form_input(['name' => 'keterangan', 'id' => 'keterangan', 'class' => 'form-control', 'placeholder' => 'opsional']); ?>
			</div>

			<div class="bg-warning p-2 border rounded">
				Perlu diingat, penambahan "status proses orderan" ini tidak bisa diubah.
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-link text-decoration-none" data-dismiss="modal">Batal</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
		<?= form_close(); ?>
	</div>
</div>

<!-- Modal cek pembayaran -->
<div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalBayarLabel">Info Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="bg-warning p-2 rounded mb-2">
					Perlu diingat, detail pembayaran tidak bisa dihapus atau diubah
				</div>

				<div id="cek">...</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal tambah pembayaran -->
<div class="modal fade" id="modalTambahBayar" tabindex="-1" aria-labelledby="modalTambahBayarLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambahBayarLabel">Tambah Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="bg-warning p-2 rounded mt-2">
					Perlu diingat, detail pembayaran tidak bisa dihapus atau diubah
				</div>

				<div class="tab-content mt-3" id="myTabContent">
					<?= form_open('', ['id' => 'tambahPembayaran'], ['invoice_id' => '']); ?>
					<div class="row mb-0 gx-2">
						<div class="col-6 form-group mb-3">
							<?= form_label('Tujuan Bayar', 'tujuan', ['class' => 'form-label']); ?>
							<?= form_dropdown('sumber_dana', [], '', ['class' => 'form-select', 'required' => '', 'id' => 'tujuan']); ?>
						</div>
						<div class="col-6 form-group mb-3">
							<?= form_label('Tanggal Bayar', 'tanggal_bayar', ['class' => 'form-label']); ?>
							<?= form_input('tanggal_pembayaran', set_value('tanggal_pembayaran', $sekarang->toDateString()), ['class' => 'form-control', 'id' => 'tanggal_pembayaran', 'required' => '', 'max' => $sekarang->toDateString()], 'date'); ?>
						</div>
						<div class="col-6 form-group mb-3">
							<?= form_label('Jumlah Dana', 'jumlah_dana', ['class' => 'form-label']); ?>
							<?= form_input(['name' => 'total_pembayaran', 'class' => 'form-control', 'id' => 'jumlah_dana', 'required' => '', 'placeholder' => '200000', 'type' => 'number', 'min' => '1']); ?>
						</div>
					</div>
					<hr />
					<button class="btn btn-primary" type="submit">Simpan</button>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?php

$link_api_get_bank = site_url("api/get_bank/");
$link_api_juragan = site_url("api/get_juragan");
$link_get_status_invoice = site_url('admin/invoices/detail_status/');
$link_hapus_orderan = site_url('admin/invoices/hapus_orderan/');
$link_invoice = site_url('admin/invoices/lihat/');
$link_save_progress = site_url('admin/invoices/save_progress');
$link_tambah_pembayaran = site_url('admin/invoices/simpan_pembayaran');
$link_update_pembayaran = site_url('admin/invoices/update_bayar');

$js = <<< JS
$(function() { 
	'use strict';
	// popover 
	// ------------------------------------------------------------------------
	var po = {};
		po.trigger = 'focus';
		po.placement = 'right';
		po.container = 'body';
		po.html = true;
		po.selector = '[data-toggle="popHarga"]';
		po.template = '<div class="popover shadow" role="tooltip"><div class="popover-arrow"></div><div class="popover-body"></div></div>';
	$('body').popover(po);

	// tooltips
	// ------------------------------------------------------------------------
	var tt = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
	var ttl = tt.map(function(e) {
		return new bootstrap.Tooltip(e);
	});

	// sidebar
	// ------------------------------------------------------------------------
	$('#sidebar').on('show.bs.collapse',function(){
		var a=$('<div>',{'class':'modal-backdrop fade show'});
		$('body').toggleClass('modal-open').append(a),
		a.click(function(){
			$('#sidebar').collapse('hide'),
			a.remove(),
			$('body').toggleClass('modal-open');
		});
	});

	$('#sidebarCollapse').on('click',function(){
		$('#listLi').html(''),
		$.getJSON('$link_api_juragan',function(b){
			var a=[];a.push('<li><li><a class="p-2 d-block text-light text-decoration-none" href="$link_invoice'+'semua'+'"><i class="fad fa-user-circle"></i> Semua Juragan</li></li>'),
			$.each(b,function(c,b){
				a.push('<li><a class="p-2 d-block text-light text-decoration-none" href="$link_invoice'+b.juragan+'"><i class="fad fa-user-circle"></i> '+b.nama_juragan+'</li>');
			}),
			$(a.join('')).appendTo('#listLi');
		});
	});

	//
	$('.pesanStatus').on('click',function(){
		let id = $(this).data('invoice');

		$('#newStatus [name="id_invoice"]').val(id);
		$("#status option").prop('disabled', false);
		$('#stat option').prop('disabled', false);
		$.get("$link_get_status_invoice" + id, function(data, status){

			if (data.length === 0) {
				// console.log('data');
				$("#status option").not('option[value=1]').each(function (index) {
					$(this).prop('disabled', true);
				});
			} else {
				// console.log(data);
				if (data[0].tanggal_selesai === null) {
					$("#status option").not('option[value='+data[0].status+']').each(function (index) {
						$(this).prop('disabled', true);
					});
					$('#stat option').not('option[value=1]').prop('disabled', true);
				} else {
					
				}
			}
		});		
	});

	//
	$("#status").change(function() {
		let val = this.value;
		// alert("Selected value is : " + val);
		let stat = $('#stat');
		let v1 = $('#stat option[value=1]');
		let v0 = $('#stat option[value=0]');

		stat.val('');

		if (val !== '') {
			stat.prop('disabled', false);
		}
		else {
			stat.prop('disabled', true);
		}

		if (val == 1) {
			v1.text('Lengkap');
			v0.text('Tidak Lengkap');
		} else if (val == 2) {
			v1.text('Ada');
			v0.text('Belum Ada');
		} else {
			v1.text('Selesai');
			v0.text('Masuk');
		}
	});

	//
	var request;
	var submitform=$('#newStatus');
	submitform.on('submit',function(f){
		f.preventDefault(),
		f.stopPropagation();
		
		// Abort any pending request
		if (request) {
			request.abort();
		}
		// setup some local variables
		var f = $(this);

		// Let's select and cache all the fields
		var inputs = f.find("input, select, button, textarea");

		// Serialize the data in the form
		var serializedData = f.serialize();

		// Let's disable the inputs for the duration of the Ajax request.
		// Note: we disable elements AFTER the form data has been serialized.
		// Disabled form elements will not be serialized.
		inputs.prop("disabled", true);

		// Fire off the request to /form.php
		request = $.ajax({
			url: "$link_save_progress",
			type: "post",
			data: serializedData
		});

		// Callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR){
			// Log a message to the console
			console.log("Hooray, it worked!");
		});

		// Callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown){
			// 
			// console.log( Object.keys(jqXHR['responseJSON']).length);
		});

		// Callback handler that will be called regardless
		// if the request failed or succeeded
		request.always(function () {
			// Reenable the inputs
			inputs.prop("disabled", false);
			
		});		
	});

	// cek pembayaran
	$('.pesanBayar').on('click',function(){
		let juragan = $(this).data('juragan');
		let id = $(this).data('invoice');
		let bayar = $(this).data('bayar');
		let dv_list =$("<div/>").addClass('list-group list-group-flushs').attr('id', 'list_pembayaran');

		// buka tab cek secara default
		// load data pembayaran jika tersedia
		// kalau tidak ada data, tampilkan pesan kosong		
		if (bayar !== '') {
			for(var i in bayar) {
				// console.log(bayar[i].id);
				var label = $('<div/>').addClass('list-group-item list-group-action');

				var info = '';
				var ico = '';
				var btn = '';
				switch (bayar[i].status) {
					case 2:
						btn = ``;
						ico = 'times-circle text-danger';
						info = 'dana tidak ada, sudah cek pada: '+ tanggal(bayar[i].tanggal_cek);
						break;

					case 3:
						btn = ``;
						ico = 'check-circle text-success';
						info = 'dana ada, sudah cek pada: '+ tanggal(bayar[i].tanggal_cek);
						break;

					default:
						btn = `<li>
									<button class="dropdown-item" data-val="3" data-invoice="`+id+`" data-id="`+ bayar[i].id +`">
										Dana ada
									</button>
								</li>
								<li>
									<button class="dropdown-item" data-val="2" data-invoice="`+id+`" data-id="`+ bayar[i].id +`">
										Dana tidak ada
									</button>
								</li>`;
						ico = 'minus-circle text-info';
						info = 'dana belum dicek';
						break;
				}

				var bta = `<div>
					<div class="dropdown">
						<button class="btn btn-outline-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
							<i class="fad fa-ellipsis-h"></i>
						</button>
						<ul class="dropdown-menu btn-action" aria-labelledby="dropdownMenuButton">`+ btn +`</ul>
					</div>
				</div>`;

				if (bayar[i].status !== 1) {
					bta = '';
				}

				var bank = bayar[i].atas_nama;
				if (bayar[i].sumber > 2) {
					bank = bayar[i].nama + ' (' + bayar[i].atas_nama + ')';
				}

				var dv = $(`
				<div class="d-flex justify-content-between">
					<div class="d-flex justify-content-start align-items-center">
						<i class="fad fa-`+ ico +` fa-2x mr-3"></i>
						<div>`+
						
							bank.toUpperCase() +`&nbsp;-&nbsp;`+ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR',maximumSignificantDigits: 2 }).format(bayar[i].nominal) +`&nbsp;(`+ tanggal(bayar[i].tanggal_bayar) +`)
							<div class="text-muted small">`+ info +`</div>
						</div>
					</div>
					`+ bta +`
				</div>
				`);
				
				label.append(dv);
				dv_list.append(label);

				$('#modalBayar #cek').empty().append(dv_list);
			}
		}
		else {
			// console.log('data bayar kosong');
			$('#modalBayar #cek').empty().append('<div class="text-center my-5"><i class="fad fa-wallet fa-4x"></i><br/>data kosong</div>');
		}
	});

	// tambah pembayaran
	$('.tambahBayar').on('click',function(){
		let juragan = $(this).data('juragan');
		let id = $(this).data('invoice');

		// invoice_id
		$('#myTabContent [name="invoice_id"]').val(id);
		
		// set dropdown sumber_dana
		$.get("$link_api_get_bank" + juragan, function(data, status){
			// console.log("Data: " + data[0]['fn']);

			var apnd = '<option value="">Pilih Tujuan</option>';
			for (var i = 0; i < data.length; i++) {
				apnd += "<option value = '" + data[i].bank_id + " '>" + data[i].fn + " </option>";
			}
			$("#modalTambahBayar #tujuan").empty().append(apnd);
		});
	});

	var req_pay;
	var tambah_pay=$('#tambahPembayaran');
	tambah_pay.on('submit',function(f){
		f.preventDefault(),
		f.stopPropagation();
		
		// Abort any pending request
		if (req_pay) {
			req_pay.abort();
		}
		// setup some local variables
		var f = $(this);

		// Let's select and cache all the fields
		var inputs = f.find("input, select, button, textarea");

		// Serialize the data in the form
		var serializedData = f.serialize();

		// Let's disable the inputs for the duration of the Ajax request.
		// Note: we disable elements AFTER the form data has been serialized.
		// Disabled form elements will not be serialized.
		inputs.prop("disabled", true);

		// Fire off the request to /form.php
		req_pay = $.ajax({
			url: "$link_tambah_pembayaran",
			type: "post",
			data: serializedData
		});

		// Callback handler that will be called on success
		req_pay.done(function (response, textStatus, jqXHR){
			// Log a message to the console
			// console.log(response);
			// redirect
			document.location.href = response.url;
		});

		// Callback handler that will be called on failure
		req_pay.fail(function (jqXHR, textStatus, errorThrown){
			// 
			// console.log( Object.keys(jqXHR['responseJSON']).length);
		});

		// Callback handler that will be called regardless
		// if the request failed or succeeded
		req_pay.always(function () {
			// Reenable the inputs
			inputs.prop("disabled", false);
			
		});		
	});

	// set dana 
	$(document).on('click', '.btn-action .dropdown-item',function() {
		var id = $(this).data('id'),
			invoice = $(this).data('invoice'),
			status = $(this).data('val');

		if(confirm("Sudah yakin, ini tidak bisa diubah lho?"))
		{
			$.ajax({
				method: "POST",
				url: "$link_update_pembayaran",
				data: { id_pembayaran: id, status: status, invoice_id: invoice }
			})
			.done(function( msg ) {
				// console.log( "Data Saved: " + msg );
				document.location.href = msg.url;
			});
		}
	});

	$('.hapusOrderan').on('click',function(){
		let seri = $(this).data('seri');
		let id = $(this).data('invoice');

		if(confirm("Hapus orderan " + seri + "? sudah yakin?"))
		{
			$.ajax({
				method: "POST",
				url: "$link_hapus_orderan",
				data: { invoice_id: id }
			})
			.done(function( msg ) {
				// console.log( "Data Saved: " + msg );
				document.location.href = msg.url;
			});
		}
	});

	// create date from unix
	function tanggal(unixtime) {
		var u = new Date(unixtime*1000);

		return ('0' + u.getDate()).slice(-2) + '/' + ('0' + u.getMonth()).slice(-2) + '/' + u.getFullYear();
	};
});
JS;

$packer = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>