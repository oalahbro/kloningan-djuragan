<?php

use App\Libraries\Ongkir;
use CodeIgniter\I18n\Time;

$sekarang = new Time('now');
$pager    = \Config\Services::pager();
$session  = \Config\Services::session();
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
	<?php $parts = $_SERVER['REQUEST_URI'];
	//echo $parts; 
	?>
	<div class="wrap-btn-filter mb-3">
		<?php if (preg_match("/" . preg_quote("semua/semua", "/") . "/", $parts)) { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/semua', 'Semua Orderan <b><span class="badge rounded-pill bg-white text-primary">' . count($pesanans) . '</span></b>', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'semua' ? 'primary' : 'outline-secondary')]); ?><?php } else { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/semua', 'Semua Orderan', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'semua' ? 'primary' : 'outline-secondary')]); ?>
		<?php } ?>
		<?php if (preg_match("/" . preg_quote("semua/cek-bayar", "/") . "/", $parts) or $parts == "/admin/invoices") { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/cek-bayar', 'Cek Pembayaran <b><span class="badge rounded-pill bg-white text-primary">' . count($pesanans) . '</span></b>', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'cek-bayar' ? 'primary' : 'outline-secondary')]); ?><?php } else { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/cek-bayar', 'Cek Pembayaran', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'cek-bayar' ? 'primary' : 'outline-secondary')]); ?>
		<?php } ?>
		<?php if (preg_match("/" . preg_quote("semua/belum-proses", "/") . "/", $parts)) { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/belum-proses', 'Belum Proses <b><span class="badge rounded-pill bg-white text-primary">' . count($pesanans) . '</span></b>', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'belum-proses' ? 'primary' : 'outline-secondary')]); ?><?php } else { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/belum-proses', 'Belum Proses', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'belum-proses' ? 'primary' : 'outline-secondary')]); ?>
		<?php } ?>
		<?php if (preg_match("/" . preg_quote("semua/dalam-proses", "/") . "/", $parts)) { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/dalam-proses', 'Dalam Proses <b><span class="badge rounded-pill bg-white text-primary">' . count($pesanans) . '</span></b>', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'dalam-proses' ? 'primary' : 'outline-secondary')]); ?><?php } else { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/dalam-proses', 'Dalam Proses', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'dalam-proses' ? 'primary' : 'outline-secondary')]); ?>
		<?php } ?>
		<?php if (preg_match("/" . preg_quote("semua/selesai", "/") . "/", $parts)) { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/selesai', 'Orderan Selesai <b><span class="badge rounded-pill bg-white text-primary">' . count($pesanans) . '</span></b>', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'selesai' ? 'primary' : 'outline-secondary')]); ?><?php } else { ?>
			<?= anchor('admin/invoices/lihat/' . $jrgn . '/selesai', 'Orderan Selesai', ['class' => 'mb-2 btn rounded-pill mr-1 btn-' . ($hal === 'selesai' ? 'primary' : 'outline-secondary')]); ?>
		<?php } ?>
		<a class="mb-2 btn btn-warning rounded-pill mr-1" data-target="#modalCari" data-toggle="modal" href="#!"><i class="fal fa-search"></i></a>
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
								$juragan    = json_decode($pesanan->juragan);
								$pengguna   = json_decode($pesanan->pengguna);
								$pengiriman = json_decode($pesanan->pengiriman);
								$statuss    = json_decode($pesanan->status);
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
											<i class="fal fa-plus-circle icon d-block"></i>
											<?= '<span><abbr title="' . $time->humanize() . '">' . $time->day . '/' . $time->month . '</abbr></span>'; ?>
										</div>
									</div>
								</li>

								<?= status_pembayaran($pesanan->pembayaran, $pesanan->status_pembayaran); ?>

								<?php
								$dipacking = false;

								if ($statuss !== null) {
									foreach ($statuss as $status) {
										echo status_orderan($status->status, $status->tanggal_masuk, $status->tanggal_selesai, $status->keterangan_masuk, $status->keterangan_selesai);

										if (isset($status->status) && $status->status == 7) {
											if ($status->tanggal_selesai !== null) {
												$dipacking = true;
											}
										}
									}
								}
								?>
								<?php if ($dipacking) { ?>
									<?= status_pengiriman($pesanan->pengiriman, $pesanan->status_pengiriman); ?>
								<?php }
								?>
							</ul>
						</div>
					</div>
					<hr class="mt-0" />

					<div class="row">
						<div class="col-12 col-sm-3 mb-3">
							<div class="mb-3">
								<div class="card-subtitle text-muted text-uppercase small"><?= ($pesanan->kirimKepada_id === $pesanan->pemesan_id ? 'Pemesan / Kirim Kepada' : 'Pemesan') ?></div>

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

											$kec  = strtoupper($ongkir->kecamatan($PKab, $PKec)['subdistrict_name']);
											$kab  = strtoupper(($kota['type'] === 'Kabupaten' ? '' : '(Kota) ') . $kota['city_name']);
											$prov = strtoupper($ongkir->provinsi($PPro)['province']);

											echo $pelanggan->alamat . '<br/>' . $kec . ', ' . $kab . '<br/>' . $prov . ' - ' . $pelanggan->kodepos;
										}
										?>
									</span>
								</div>
							</div>

							<?php if ($pesanan->kirimKepada_id !== $pesanan->pemesan_id) { ?>
								<div class="mb-3">
									<div class="card-subtitle text-muted text-uppercase small">Kirim Kepada</div>

									<div class="border-bottom pb-2">
										<?php $kirimKe = json_decode($pesanan->kirimKe); ?>
										<span class="d-block font-weight-bold"><?= strtoupper($kirimKe->nama); ?></span>
										<span class="d-block lead">
											<?php
											for ($i = 0; $i < count($kirimKe->hp); $i++) {
												if ($i === 1) {
													echo '<span class="sr-only">/</span>';
												}
												echo '<span class="badge bg-secondary mr-1 font-weight-light">' . $kirimKe->hp[$i] . '</span>';
											}
											?>
										</span>
										<span class="d-block">
											<?php
											if ($kirimKe->cod === 1) {
												echo 'C.O.D';
											} else {
												//
												$ongkir = new Ongkir();

												$PPro = $kirimKe->provinsi;
												$PKab = $kirimKe->kabupaten;
												$PKec = $kirimKe->kecamatan;
												$kota = $ongkir->kota($PPro, $PKab);

												$kec  = strtoupper($ongkir->kecamatan($PKab, $PKec)['subdistrict_name']);
												$kab  = strtoupper(($kota['type'] === 'Kabupaten' ? '' : '(Kota) ') . $kota['city_name']);
												$prov = strtoupper($ongkir->provinsi($PPro)['province']);

												echo $kirimKe->alamat . '<br/>' . $kec . ', ' . $kab . '<br/>' . $prov . ' - ' . $kirimKe->kodepos;
											}
											?>
										</span>
									</div>
								</div>
							<?php } ?>

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
									$wajib_bayar  = 0;
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
												'data-toggle'  => 'popHarga',
												'data-content' => $content,
												'content'      => '<i class="fal fa-info-circle"></i> <span class="sr-only">info</span>',
												'class'        => 'btn btn-link btn-sm text-secondary',
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
										if ($pesanan->biaya !== null) {
											foreach (json_decode($pesanan->biaya) as $c) {
												$wajib_bayar += $c->nominal; ?>

												<div class="d-flex justify-content-between align-items-center">
													<div class="small d-flex text-muted text-uppercase text-truncate">
														<span class="font-weight-bold">
															<?php
															$biaya = 'Lainnya';

															if ($c->biaya_id === 1) {
																$biaya = 'Ongkir';
															}
															$label = $c->label;

															if ($c->label !== 'null' && $c->biaya_id !== 1) {
																$biaya = $c->label;
																$label = '';
															} elseif ($c->label === 'null') {
																$label = '';
															} ?>
															<?= $biaya; ?>
														</span>&nbsp;
														<?= $label; ?>
													</div>
													<div class="font-weight-bold text-nowrap pl-2 <?= ($c->nominal < 0 ? 'text-danger' : ''); ?>"><?= number_to_currency($c->nominal, 'IDR'); ?></div>
												</div>
											<?php
											}
										}
										echo '<hr/>';
										$sudah_bayar = status_pembayaran($pesanan->pembayaran, $pesanan->status_pembayaran, 'sudah_bayar');

										if ($sudah_bayar > 0) {
											?>

											<div class="d-flex justify-content-between align-items-center">
												<div class="small d-flex text-muted text-uppercase"><span class="font-weight-bold">
														Sudah</span>&nbsp;Bayar
													<?= form_button([
														'class'        => 'text-dark ml-1 pesanBayar',
														'content'      => '<i class="fal fa-info-circle"></i> <span class="sr-only">info</span>',
														'data-invoice' => $pesanan->id_invoice,
														'data-juragan' => $juragan->id,
														'data-target'  => '#modalBayar',
														'data-toggle'  => 'modal',
														'style'        => 'border:none; background:transparent',
													]); ?>
												</div>
												<div class="font-weight-bold"><?= number_to_currency($sudah_bayar, 'IDR'); ?></div>
											</div>
										<?php
										}

										if (($wajib_bayar - $sudah_bayar) > 0) {
										?>
											<div class="d-flex justify-content-between align-items-center">
												<div class="small d-flex text-muted text-uppercase"><span class="font-weight-bold">Kurang</span>&nbsp;Bayar</div>
												<div class="font-weight-bold text-danger"><?= number_to_currency(- ($wajib_bayar - $sudah_bayar), 'IDR'); ?></div>
											</div>
										<?php
										}

										if ($sudah_bayar > $wajib_bayar) {
										?>
											<div class="d-flex justify-content-between align-items-center">
												<div class="small d-flex text-muted text-uppercase"><span class="font-weight-bold">Lebih</span>&nbsp;Bayar</div>
												<div class="font-weight-bold"><?= number_to_currency(($sudah_bayar - $wajib_bayar), 'IDR'); ?></div>
											</div>
										<?php
										}
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
								<?php if ($pesanan->keterangan !== null) { ?>
									<div class="card-subtitle text-muted text-uppercase small">Keterangan</div>
									<p class="keterangan mb-3" id="keterangan-<?= $pesanan->id_invoice; ?>">
										<?= nl2br($pesanan->keterangan); ?>
									</p>
								<?php } ?>

								<?php if ($pesanan->status_pengiriman !== '1' && $pengiriman !== null) { ?>
									<div class="card-subtitle text-muted text-uppercase small">Resi</div>

									<?php
									foreach ($pengiriman as $key => $kirim) { ?>
										<div class="border-bottom mb-2 pb-2">
											<?php $tanggal_kirim = Time::createFromTimestamp($kirim->tanggal_kirim); ?>
											<h6 class="mb-0">
												<?= $kirim->kurir; ?>
												<?= form_button([
													'class'        => 'bg-transparent border-0 text-primary ml-1 suntingResi',
													'content'      => '<i class="fal fa-money-check-edit fa-flip-horizontal"></i>',
													'data-id'      => $kirim->id,
													'data-invoice' => $pesanan->id_invoice,
												]); ?>
											</h6>
											<div class="lead"><?= $kirim->resi; ?></div>
											<p class="mb-0 text-muted">
												<?= $tanggal_kirim->toLocalizedString('EEEE, d MMMM yyyy'); ?>
												<?php if ($kirim->ongkir > 0) { ?>
													<br />ongkir fix (<?= $kirim->qty . 'pcs'; ?>): <u><?= number_to_currency($kirim->ongkir, 'IDR'); ?></u>
												<?php } ?>
											</p>
										</div>
									<?php
									} ?>
								<?php } ?>
							</div>
						</div>
					</div>
					<hr />

					<div class="d-flex align-items-center justify-content-between ">
						<div>
							<div class="btn-group active">
								<?= anchor('admin/invoices/sunting/' . $pesanan->seri, '<i class="fal fa-pencil"></i> Sunting', ['class' => 'btn btn-outline-secondary', 'role' => 'button']); ?>
								<button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu ">
									<li><a class="dropdown-item" href="#">Print Label</a></li>
									<li><a class="dropdown-item" target="_blank" href="<?= site_url('download/invoice/' . $pesanan->seri); ?>">Unduh Invoice (PDF)</a></li>
									<li>
										<hr class="dropdown-divider" />
									</li>
									<li>
										<?php
										$lunas = $pesanan->status_pembayaran;
										if ($lunas == 6) { ?>
											<?= form_button([
												'class'        => 'dropdown-item disabled ',
												'content'      => 'Tambah Pembayaran',
											]); ?>

										<?php } else { ?>
											<?= form_button([
												'class'        => 'dropdown-item tambahBayar',
												'content'      => 'Tambah Pembayaran',
												'data-invoice' => $pesanan->id_invoice,
												'data-juragan' => $juragan->id,
												'data-kurang'  => $wajib_bayar - $sudah_bayar,
												'data-seri'    => $pesanan->seri,
												'data-target'  => '#modalTambahBayar',
												'data-toggle'  => 'modal',
											]); ?>
										<?php } ?>

									</li>
									<li>
										<hr class="dropdown-divider" />
									</li>
									<li>
										<?= form_button([
											'class'        => 'dropdown-item hapusOrderan text-danger',
											'content'      => 'Hapus',
											'data-invoice' => $pesanan->id_invoice,
											'data-seri'    => $pesanan->seri,
										]); ?>
									</li>
								</ul>
							</div>

							<?php if ((int) $pesanan->status_pembayaran > 2 && !$dipacking) {

								// tombol proses pesanan
								echo form_button([
									'class'        => 'btn btn-dark ml-1 pesanStatus',
									'content'      => '<i class="fal fa-comment-alt-plus"></i> Proses Orderan',
									'data-invoice' => $pesanan->id_invoice,
									'data-seri'    => $pesanan->seri,
									'data-target'  => '#modalProgress',
									'data-toggle'  => 'modal',
								]);
							}

							if ($pesanan->status_pembayaran === '2' || $pesanan->status_pembayaran === '3') {
								// tombol cek pembayaran
								// hanya tampil jika ada pembayaran yang perlu dicek
								echo form_button([
									'class'        => 'btn btn-warning ml-1 pesanBayar',
									'content'      => '<i class="fal fa-wallet"></i> Cek Pembayaran',
									'data-invoice' => $pesanan->id_invoice,
									'data-juragan' => $juragan->id,
									'data-target'  => '#modalBayar',
									'data-toggle'  => 'modal',
								]);
							}
							//
							if ($dipacking && (int) $pesanan->status_pengiriman < 3) {
								echo form_button([
									'class'        => 'btn btn-warning ml-1 kirimResi',
									'content'      => '<i class="fal fa-paper-plane"></i> Input Resi',
									'data-count'   => $count_barang,
									'data-invoice' => $pesanan->id_invoice,
								]);
							} ?>
						</div>

						<div class="form-check form-check-inline">
							<?= form_checkbox(['name' => 'cetak[]', 'class' => 'form-check-input', 'id' => 'printLabel-' . $pesanan->id_invoice], $pesanan->id_invoice) ?>
							<?= form_label('Print Label Masal', 'printLabel-' . $pesanan->id_invoice, ['class' => 'form-check-label']); ?>
						</div>
					</div>
				</div>
			</div>
	<?php
		}
		echo $pager->makeLinks($page, $limit, $totalPage, 'front_full');
	} else {
		echo '<div class="text-center my-5"><i class="fal fa-5x fa-box-open text-primary"></i><br/>orderan masih kosong</div>';
	}
	?>

</div>

<!-- Modal orderan status-->
<div class="modal fade" id="modalProgress" tabindex="-1" aria-labelledby="modalProgressLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<?= form_open('', ['class' => 'modal-content', 'id' => 'newStatus'], ['id_invoice' => '']); ?>
		<div class="modal-header">
			<h5 class="modal-title" id="modalProgressLabel">Status Proses Orderan</h5>
			<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="mb-3">
				<?= form_label('Pilih Status', 'status', ['class' => 'form-label']); ?>
				<div class="input-group mb-3">
					<?php
					$list_status = [
						''  => 'Pilih status',
						'1' => 'Data Pesanan',
						'2' => 'Bahan Produk',
						'3' => 'Sablon',
						'4' => 'Bordir',
						'5' => 'Penjahit',
						'6' => 'QC',
						'7' => 'Packing',
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
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

<!-- Modal input resi -->
<div class="modal fade" id="modalKirim" tabindex="-1" aria-labelledby="modalKirimLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<?= form_open('', ['id' => 'submitResi', 'class' => 'modal-content'], ['invoice_id' => '1']); ?>
		<div class="modal-header">
			<h5 class="modal-title" id="modalKirimLabel">Modal title</h5>
			<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="row gx-2 mb-3">
				<div class="col-4">
					<?= form_label('Kurir', 'kurir', ['class' => 'form-label']); ?>
					<?php
					$options_kurir = ['' => 'Pilih kurir'];

					foreach (config('JuraganConfig')->kurir as $label) {
						$options_kurir[$label] = $label;
					}
					?>

					<?= form_dropdown('kurir', $options_kurir, '', ['class' => 'form-select', 'id' => 'kurir', 'required' => '']); ?>
				</div>
				<div class="col">
					<?= form_label('Lainnya', 'resi', ['class' => 'form-label']); ?>
					<?= form_input([
						'class'       => 'form-control',
						'disabled'    => '',
						'id'          => 'lainnya',
						'name'        => 'lainnya',
						'placeholder' => 'kurir lain',
					]); ?>
				</div>
			</div>

			<div class="mb-3">
				<?= form_label('No Resi', 'resi', ['class' => 'form-label']); ?>
				<?= form_input([
					'class'       => 'form-control',
					'id'          => 'resi',
					'name'        => 'resi',
					'placeholder' => 'JOGxxxxxxxxxxx',
					'required'    => '',
				]); ?>
			</div>


			<div class="row gx-2 mb-3">
				<div class="col-5">
					<div class="mb-3">
						<?= form_label('Tanggal Kirim', 'tanggal_kirim', ['class' => 'form-label']); ?>
						<?= form_input([
							'class'       => 'form-control',
							'id'          => 'tanggal_kirim',
							'max'         => $sekarang->toDateString(),
							'name'        => 'tanggal_kirim',
							'placeholder' => 'JOGxxxxxxxxxxx',
							'required'    => '',
							'type'        => 'date',
							'value'       => $sekarang->toDateString(),
						]); ?>
					</div>
				</div>
				<div class="col">
					<div class="mb-3">
						<?= form_label('Isi Paket', 'isi_paket', ['class' => 'form-label']); ?>
						<?= form_input([
							'class'       => 'form-control',
							'id'          => 'isi_paket',
							'min'         => 1,
							'name'        => 'qty',
							'placeholder' => '1',
							'required'    => '',
							'type'        => 'number',
						]); ?>
					</div>
				</div>
				<div class="col-4">
					<div class="mb-3">
						<?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']); ?>
						<?= form_input([
							'class'       => 'form-control',
							'id'          => 'ongkir',
							'name'        => 'ongkir',
							'placeholder' => '25000',
							'required'    => '',
							'min'         => 0,
							'type'        => 'number',
						]); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn link" data-dismiss="modal">Batal</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
		<?= form_close(); ?>
	</div>
</div>

<!-- Modal pencarian invoice -->
<div class="modal fade" id="modalCari" tabindex="-1" aria-labelledby="modalCariLabel" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<?= form_open('admin/invoices/lihat/' . $jrgn . '/semua', ['method' => 'get']) ?>
				<div class="row g-2 align-items-center">
					<div class="col-4">
						<?= form_label('Status Pembayaran', 'status_pembayaran', ['class' => 'form-label sr-only']); ?>
						<?php
						$opsi_pembayaran = [
							''   => 'Opsi Pembayaran',
							'1'  => 'Belum bayar',
							'2A' => 'Tunggu Konfirmasi Pembayaran',
							'4'  => 'Cicilan / Kredit',
							'5'  => 'Ada kelebihan',
							'6'  => 'Sudah lunas',
						];
						echo form_dropdown('cari[pembayaran]', $opsi_pembayaran, '', ['class' => 'form-select mb-2 mr-sm-2']);
						?>
					</div>

					<div class="col-4">
						<div class="col-12">
							<?= form_label('Status Orderan', 'status_orderan', ['class' => 'form-label sr-only']); ?>
							<?php
							$opsi_orderan = [
								''  => 'Opsi Orderan',
								'1' => 'Belum diproses',
								'2' => 'Sedang/sudah diproses',
								'3' => 'Dibatalkan',
							];
							echo form_dropdown('cari[orderan]', $opsi_orderan, '', ['class' => 'form-select mb-2 mr-sm-2']);
							?>
						</div>
					</div>

					<div class="col-4">
						<?= form_label('Status Pengiriman', 'status_pengiriman', ['class' => 'form-label sr-only']); ?>
						<?php
						$opsi_pengiriman = [
							''   => 'Opsi pengiriman',
							'1'  => 'Belum dikirim',
							'2A' => 'Dikirim',
						];
						echo form_dropdown('cari[pengiriman]', $opsi_pengiriman, '', ['class' => 'form-select mb-2 mr-sm-2']);
						?>
					</div>
				</div>

				<div class="input-group mb-2">
					<?php
					$opsi_kolom = [
						''              => 'Opsi Pencarian',
						'nama'          => 'Nama Pelanggan',
						'hp'            => 'HP Pelanggan',
						'faktur'        => 'Kode Invoice',
						'tanggal_pesan' => 'Tanggal Pesan',
						'kode'          => 'Kode Produk',
					];
					echo form_dropdown('cari[kolom]', $opsi_kolom, '', ['class' => 'form-select']);
					echo form_input(['name' => 'cari[q]', 'class' => 'form-control allow-enter', 'style' => 'flex:2', 'placeholder' => 'cari .....']);
					?>
					<div class="text-muted">untuk pencarian berdasarkan tanggal, gunakan format seperti: <code>2020-09-20</code></div>
				</div>

				<div class="col-12">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				<?= form_close(); ?>

			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?php

$current_user_id         = $session->get('id');
$link_api_get_bank       = site_url('api/juragan/all/');
$link_api_get_pembayaran = site_url('admin/invoices/info_pembayaran');
$link_api_pengiriman     = site_url('api/pengiriman');
$link_api_juragan        = site_url('api/juragan/by_user/');
$link_get_status_invoice = site_url('admin/invoices/detail_status/');
$link_hapus_orderan      = site_url('admin/invoices/hapus_orderan');
$link_invoice            = site_url('admin/invoices/lihat/');
$link_save_progress      = site_url('admin/invoices/save_progress');
$link_tambah_pembayaran  = site_url('admin/invoices/simpan_pembayaran');
$link_update_pembayaran  = site_url('admin/invoices/update_bayar');
$link_api_notif          = site_url('api/notifikasi/');

$codvalue = 'COD' . $sekarang->toLocalizedString('ddMMyyyy');

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
    		var id = {$current_user_id};
    		$('#listLi').html(''),
    		$.getJSON('{$link_api_juragan}', { id: id }, function(b){
    			var a=[];a.push('<li><li><a class="p-2 d-block text-light text-decoration-none" href="{$link_invoice}'+'semua'+'"><i class="fal fa-user-circle"></i> Semua Juragan</li></li>');
    			
    			$.each(b[id].juragan,function(c,b){
    				a.push('<li><a class="p-2 d-block text-light text-decoration-none" href="{$link_invoice}'+b.slug+'"><i class="fal fa-user-circle"></i> '+b.nama+'</li>');
    			}),

    			$(a.join('')).appendTo('#listLi');
    		});
    	});

    	// notifikasi
    	// ------------------------------------------------------------------------
    	function getNotif(page = 1, dibaca = 0){
    		var id = {$current_user_id};
    		$.getJSON('{$link_api_notif}' + 'get', { id: id, page: page, dibaca: dibaca }, function(b){
    			var a=[],
    				data = b.results;

    			if (b.count > 0) {
    				$('.btnSettingNotif').show();
    				a.push('');

    				$.each(data,function(c,b){
    					a.push(`<div class="list-group-item list-group-item-action">
    						<div class="d-flex">
    							<div class="mr-auto">
    								<div class="text-muted small">`+b.created_at +`</div>
    								<a class="d-block text-decoration-none" href="{$link_invoice}/semua/semua?cari[kolom]=faktur&cari[q]=`+b.invoice+`">`+ b.notif+`</a>
    							</div>
    							<div class="d-flex justify-content-right flex-column actionNotif">
    								<button data-id="`+b.id+`" class="markAs border-0 bg-transparent text-primary small" type="button"><i class="fal fa-circle"></i></button>
    							</div>
    						</div>
    					</div>`);
    				}),
    				$(a.join('')).appendTo('#notifDisini');
    				var next = '';

    				if (b.next) {
    					$('<button type="button" class="list-group-item list-group-item-action text-center lanjutNotif" data-page="'+ (b.page+1) +'">lanjut ...</button>').appendTo('#notifDisini');
    				}
    			}
    			else {
    				$('.btnSettingNotif').hide();

    				$('<div class="d-flex justify-content-center align-items-center" style="height: 90vh"><i class="fal fa-bell-slash fa-5x"></i></div>').appendTo('#notifDisini');
    			}
    		});
    	}

    	$(document).on('click', '.lanjutNotif',function(){
    		getNotif($(this).data('page'));
    		$(this).attr('disabled', true).html(`<div class="text-center">
    			<div class="spinner-border" role="status">
    				<span class="sr-only">Loading...</span>
    			</div>
    		</div>`).remove();
    	});

    	$('#notif-pane').on('show.bs.collapse',function(){
    		var id = {$current_user_id};
    		$('#notifDisini').empty(),
    		getNotif();

    		var a=$('<div>',{'class':'modal-backdrop fade show'});
    		$('body').toggleClass('modal-open').append(a),
    		a.click(function(){
    			$('#notif-pane').collapse('hide'),
    			a.remove(),
    			$('body').toggleClass('modal-open');
    		});
    	});

    	counter_notif();

    	setInterval(function(){ 
    		counter_notif();
    	}, 10000);

    	function counter_notif() {
    		var id = {$current_user_id};
    		$.getJSON('{$link_api_notif}' + 'get', { id: id }, function(b){
    			$('.counter').text(b.count);
    		});
    	}

    	$(document).on('click', '.actionNotif .markAs', function() { // markAs
    		var action = '';

    		if ($(this).hasClass( "text-primary" )) {
    			$(this).removeClass('text-primary').addClass('text-muted');	
    			action = 'sudahBaca';
    		}
    		else {
    			$(this).removeClass('text-muted').addClass('text-primary');
    			action = 'belumBaca';
    		}

    		$.post( '{$link_api_notif}' + 'mark', { action: action, id: $(this).data('id') });
    	});

    	$('.tandaiSemuaTerbaca').on('click',function(){ 
    		var id = {$current_user_id};

    		$.post( '{$link_api_notif}' + 'mark_all', { id: id }, function() {
    			// 
    			$('.actionNotif .markAs').removeClass('text-primary').addClass('text-muted');
    		});
    	});

    	//
    	// ------------------------------------------------------------------------
    	$('.pesanStatus').on('click',function(){
    		let id = $(this).data('invoice');

    		$('#newStatus [name="id_invoice"]').val(id);
    		$("#status option").prop('disabled', false);
    		$('#stat option').prop('disabled', false);
    		$.get("{$link_get_status_invoice}" + id, function(data, status){

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
    			url: "{$link_save_progress}",
    			type: "post",
    			data: serializedData
    		});

    		// Callback handler that will be called on success
    		request.done(function (response, textStatus, jqXHR){
    			// redirect
    			document.location.href = response.url;
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
    		let juragan = $(this).data('juragan'),
    			id = $(this).data('invoice'),
    			dv_list =$("<div/>").addClass('list-group list-group-flushs').attr('id', 'list_pembayaran');

    		$.getJSON('{$link_api_get_pembayaran}', {id:id}, function(bayar){
    			for (let i = 0; i < bayar.length; i++) {
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
    							<i class="fal fa-ellipsis-h"></i>
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
    						<i class="fal fa-`+ ico +` fa-2x mr-3"></i>
    						<div>
    							<span class="mr-1">`+ bank.toUpperCase() +`</span> <span class="mr-1">`+ bayar[i].nominal +`</span> <span>(`+ tanggal(bayar[i].tanggal_bayar) +`)</span>
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
    		});
    	});

    	// tambah pembayaran
    	$('.tambahBayar').on('click',function(){
    		let juragan = $(this).data('juragan'),
    			id = $(this).data('invoice'),
    			kekurangan = $(this).data('kurang'),
    			ttl = $('#myTabContent [name="total_pembayaran"]');

    		// invoice_id
    		$('#myTabContent [name="invoice_id"]').val(id);
    		ttl.val('');
    		if (parseInt(kekurangan)>0) {
    			ttl.val(kekurangan);	
    		}
    		
    		// set dropdown sumber_dana
    		$.getJSON('{$link_api_get_bank}', function(data){
    			var banks = data[juragan].bank;
    			var apnd = '<option value="">Pilih Tujuan</option>';
    			for (var i in banks) {
    				apnd += "<option value = '" + banks[i].id + " '>" + banks[i].nama.toUpperCase() + ' (' + banks[i].atas_nama + ')' + " </option>";
    			}
    			$("#modalTambahBayar #tujuan").empty().append(apnd);
    		});
    	});

    	var req_pay,
    		tambah_pay=$('#tambahPembayaran');
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
    			url: "{$link_tambah_pembayaran}",
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
    				url: "{$link_update_pembayaran}",
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
    				url: "{$link_hapus_orderan}",
    				data: { invoice_id: id }
    			})
    			.done(function( msg ) {
    				// console.log( "Data Saved: " + msg );
    				document.location.href = msg.url;
    			});
    		}
    	});

    	// submit resi
    	$('.kirimResi').on('click',function(){
    		var modal = new bootstrap.Modal(document.getElementById('modalKirim')),
    			invoice = $(this).data('invoice'),
    			count = $(this).data('count'),
    			qty = $('#submitResi [name="qty"]');

    		$('#submitResi [name="invoice_id"]').val(invoice);
    		qty.val(count).attr('readonly', true);

    		if (parseInt( count ) > 1 ) {
    			// remove readonly
    			qty.attr('readonly', false);			
    		}

    		modal.show();
    	});

    	// source: https://stackoverflow.com/a/27521981/2094645
    	function dropdownToArray(target) {
            var targets = $(target + " option");
            var results = [];
            targets.each(function () {
                var val = $(this).val();
                if (val !== '') results.push(val);
            });
            return results;
    	}

    	// sunting resi
    	$('.suntingResi').on('click', function() {
    		var id = $(this).data('id'), // id pengiriman
    			modal = new bootstrap.Modal(document.getElementById('modalKirim')),
    			invoice = $(this).data('invoice');

    		$('#modalKirim .modal-title').text('Sunting Resi');

    		$('#submitResi').attr('id', 'suntingResi');

    		$('#suntingResi [name="invoice_id"]').val(invoice);
    		
    		// get data
    		// source: https://stackoverflow.com/a/18867652/2094645
    		$.getJSON('{$link_api_pengiriman}/get', { id: id }, function(data) {
    			// set array
    			var arr = dropdownToArray('#suntingResi #kurir');
    			if(jQuery.inArray(data.kurir, arr) != -1) {
    				$('#suntingResi #kurir').val(data.kurir);
    				$('#suntingResi #lainnya').attr('disabled', true);
    			} else {
    				$('#suntingResi #kurir').val('lainnya');
    				$('#suntingResi #lainnya').attr('disabled', false).val(data.kurir);
    			} 

    			$('#suntingResi #resi').val(data.resi);
    			var date = new Date(data.tanggal_kirim * 1000),
    				tggl = date.getFullYear() +'-'+("0" + date.getMonth()).slice(-2) + '-'+ ("0" + date.getDate()).slice(-2);

    			console.log(tggl);
    			$('#suntingResi #tanggal_kirim').val(tggl);
    			$('#suntingResi #isi_paket').val(data.qty_kirim).attr('readonly', true);
    			$('#suntingResi #ongkir').val(data.ongkir);

    			$('#suntingResi [name="invoice_id"]').after($('<input>').attr({
    				type: 'hidden',
    				name: 'id_pengiriman'
    			}));

    			$('#suntingResi [name="id_pengiriman"]').val(id);

    		});

    		modal.show();
    	});

    	// kurir
    	$('#submitResi #kurir').on('change', function() {
    		var lainnya = $('#submitResi #lainnya');
    		var resi = $('#submitResi #resi');
    		if ($(this).val() === "lainnya") {
    			lainnya.attr('disabled', false);
    			lainnya.attr('required', true);
    		} else {
    			lainnya.attr('disabled', true);
    		}

    		if ($(this).val() === "COD") {
    			
    			resi.val('{$codvalue}');
    		} else {
    			resi.val('');
    		}
    	});


    	// Variable to hold request
    	var request_resi;

    	// Bind to the submit event of our form
    	$(document).on('submit', "#submitResi", function(event){

    		// Prevent default posting of form - put here to work in case of errors
    		event.preventDefault();

    		// Abort any pending request
    		if (request_resi) {
    			request_resi.abort();
    		}
    		// setup some local variables
    		var form = $(this);

    		// Let's select and cache all the fields
    		var inputs = form.find("input, select, button, textarea");

    		// Serialize the data in the form
    		var serializedData = form.serialize();

    		// Let's disable the inputs for the duration of the Ajax request.
    		// Note: we disable elements AFTER the form data has been serialized.
    		// Disabled form elements will not be serialized.
    		inputs.prop("disabled", true);

    		// Fire off the request to /form.php
    		request_resi = $.ajax({
    			url: "{$link_api_pengiriman}/save",
    			type: "post",
    			data: serializedData
    		});

    		// Callback handler that will be called on success
    		request_resi.done(function (response, textStatus, jqXHR){
    			document.location.href = response.url;
    		});

    		// Callback handler that will be called on failure
    		request_resi.fail(function (jqXHR, textStatus, errorThrown){
    			// Log the error to the console
    			console.error(
    				"The following error occurred: "+
    				textStatus, errorThrown
    			);
    		});

    		// Callback handler that will be called regardless
    		// if the request failed or succeeded
    		request_resi.always(function () {
    			// Reenable the inputs
    			inputs.prop("disabled", false);
    		});

    	});

    	var request_suntingResi;
    	$(document).on('submit', "#suntingResi", function(event){

    		// Prevent default posting of form - put here to work in case of errors
    		event.preventDefault();

    		// Abort any pending request
    		if (request_suntingResi) {
    			request_suntingResi.abort();
    		}
    		// setup some local variables
    		var form = $(this);

    		// Let's select and cache all the fields
    		var inputs = form.find("input, select, button, textarea");

    		// Serialize the data in the form
    		var serializedData = form.serialize();

    		// Let's disable the inputs for the duration of the Ajax request.
    		// Note: we disable elements AFTER the form data has been serialized.
    		// Disabled form elements will not be serialized.
    		inputs.prop("disabled", true);

    		// Fire off the request to /form.php
    		request_suntingResi = $.ajax({
    			url: "{$link_api_pengiriman}/save",
    			type: "post",
    			data: serializedData
    		});

    		// Callback handler that will be called on success
    		request_suntingResi.done(function (response, textStatus, jqXHR){
    			document.location.href = response.url;
    		});

    		// Callback handler that will be called on failure
    		request_suntingResi.fail(function (jqXHR, textStatus, errorThrown){
    			// Log the error to the console
    			console.error(
    				"The following error occurred: "+
    				textStatus, errorThrown
    			);
    		});

    		// Callback handler that will be called regardless
    		// if the request failed or succeeded
    		request_suntingResi.always(function () {
    			// Reenable the inputs
    			inputs.prop("disabled", false);
    		});

    	});

    	//
    	var maxLength = 7;
    	$(".keterangan").each(function(){
    		var myStr = $(this).html(),
    			lines = myStr.replace(/^\s+|\s+$|\s+(?=\s)/g, "").split("<br>"); // https://stackoverflow.com/a/18066013/2094645
    		
    		if (lines.length > maxLength) {
    			var newStr = lines.slice(0, maxLength),
    				hideStr = lines.slice(maxLength, lines.length);

    			$(this).empty().html(newStr.join('<br/>'));
    			$(this).append('<a href="javascript:void(0);" class="read-more ml-1">lanjut ...</a>');
    			$(this).append('<span class="more-text"><br/>' + hideStr.join('<br/>') + '</span>');
    		}
    	});
    	$(".read-more").on('click', function(){
    		$(this).siblings(".more-text").contents().unwrap();
    		$(this).remove();
    	});

    	// disable hit enter
    	// https://stackoverflow.com/a/895231/2094645
    	$(document).on("keydown", ":input:not(textarea):not(.allow-enter)", function(event) {
    		if(event.keyCode == 13) {
    			event.preventDefault();
    			return false;
    		}
    	});

    	// create date from unix
    	function tanggal(unixtime) {
    		var u = new Date(unixtime*1000);

    		return ('0' + u.getDate()).slice(-2) + '/' + ('0' + u.getMonth()).slice(-2) + '/' + u.getFullYear();
    	};
    });
    JS;

$packer    = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>