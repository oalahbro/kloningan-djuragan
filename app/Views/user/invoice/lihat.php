<?php

use CodeIgniter\I18n\Time;
use App\Libraries\Ongkir;

$sekarang = new Time('now');
$pager = \Config\Services::pager();
$session = \Config\Services::session();
?>
<?= $this->extend('template/default_user') ?>

<?= $this->section('content') ?>

<div class="container-xxl">

	<h1 class="h3 mt-5"><?= $title; ?></h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb p-0">
			<li class="breadcrumb-item"><?= anchor('', 'Dasbor'); ?></li>
			<li class="breadcrumb-item"><?= anchor('user/invoices', 'Orderan'); ?></li>
			<li class="breadcrumb-item active" aria-current="page">Semua Orderan</li>
		</ol>
	</nav>

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
								$juragan 	= json_decode($pesanan->juragan);
								$pengguna 	= json_decode($pesanan->pengguna);
								$pengiriman = json_decode($pesanan->pengiriman);
								$statuss 	= json_decode($pesanan->status);
								?>
								<span class="text-muted text-lowercase">Juragan:</span> <?= anchor('user/invoices/lihat/' . $juragan->slug, $juragan->nama); ?><br />
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

											$kec = strtoupper($ongkir->kecamatan($PKab, $PKec)['subdistrict_name']);
											$kab = strtoupper(($kota['type'] === 'Kabupaten' ? '' : '(Kota) ') . $kota['city_name']);
											$prov = strtoupper($ongkir->provinsi($PPro)['province']);

											echo $pelanggan->alamat . '<br/>' . $kec . ', ' . $kab  . '<br/>' . $prov . ' - ' . $pelanggan->kodepos;
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

												$kec = strtoupper($ongkir->kecamatan($PKab, $PKec)['subdistrict_name']);
												$kab = strtoupper(($kota['type'] === 'Kabupaten' ? '' : '(Kota) ') . $kota['city_name']);
												$prov = strtoupper($ongkir->provinsi($PPro)['province']);

												echo $kirimKe->alamat . '<br/>' . $kec . ', ' . $kab  . '<br/>' . $prov . ' - ' . $kirimKe->kodepos;
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
															} elseif ($c->label === 'null') {
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
								<?php if ($pesanan->keterangan !== NULL) { ?>
									<div class="card-subtitle text-muted text-uppercase small">Keterangan</div>
									<p class="keterangan mb-3" id="keterangan-<?= $pesanan->id_invoice; ?>">
										<?= nl2br($pesanan->keterangan); ?>
									</p>
								<?php } ?>

								<?php if ($pesanan->status_pengiriman !== '1') { ?>
									<div class="card-subtitle text-muted text-uppercase small">Resi</div>

									<?php
									foreach ($pengiriman as $key => $kirim) { ?>
										<div class="border-bottom mb-2 pb-2">
											<?php $tanggal_kirim = Time::createFromTimestamp($kirim->tanggal_kirim); ?>
											<h6 class="mb-0"><?= $kirim->kurir; ?></h6>
											<div class="lead"><?= $kirim->resi; ?></div>
											<p class="mb-0 text-muted">
												<?= $tanggal_kirim->toLocalizedString('EEEE, d MMMM yyyy'); ?>
												<?php if ($kirim->ongkir > 0) { ?>
													<br />ongkir fix (<?= $kirim->qty . 'pcs'; ?>): <u><?= number_to_currency($kirim->ongkir, 'IDR'); ?></u>
												<?php } ?>
											</p>
										</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
					<hr />

					<!-- Example split danger button -->
					<div class="btn-group">
						<?= form_button([
							'class' 		=> 'btn btn-outline-secondary tambahBayar',
							'content' 		=> 'Tambah Pembayaran',
							'data-invoice' 	=> $pesanan->id_invoice,
							'data-juragan' 	=> $juragan->id,
							'data-kurang' 	=> $wajib_bayar - $sudah_bayar,
							'data-seri' 	=> $pesanan->seri,
							'data-target' 	=> '#modalTambahBayar',
							'data-toggle' 	=> 'modal'
						]); ?>
						<button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item belumFungsi" href="#!">Unduh Invoice (PDF)</a></li>
							<li>
								<hr class="dropdown-divider" />
							</li>
							<li>
								<?= form_button([
									'class' 		=> 'dropdown-item belumFungsi',
									'content' 		=> 'Sunting'
								]); ?>
							</li>
						</ul>
					</div>

					<?php if ($pesanan->status_pembayaran !== '1') {

						if ($pesanan->status_pembayaran === '2' or $pesanan->status_pembayaran === '3') {
							// tombol cek pembayaran
							// hanya tampil jika ada pembayaran yang perlu dicek
							echo form_button([
								'class' 		=> 'btn btn-warning ml-1 pesanBayar',
								'content' 		=> '<i class="fad fa-wallet"></i> Cek Pembayaran',
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
		echo $pager->makeLinks($page, $limit, $totalPage, 'front_full');
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

$current_user_id = $session->get('id');
$link_api_get_bank = site_url("api/juragan/all/");
$link_api_get_pembayaran = site_url("user/invoices/info_pembayaran");
$link_api_juragan = site_url("api/juragan/by_user/");
$link_get_status_invoice = site_url('admin/invoices/detail_status/');
$link_hapus_orderan = site_url('user/invoices/hapus_orderan/');
$link_invoice = site_url('user/invoices/lihat/');
$link_tambah_pembayaran = site_url('user/invoices/simpan_pembayaran');

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
		var id = $current_user_id;
		$('#listLi').html(''),
		$.getJSON('$link_api_juragan', { id: id }, function(b){
			var a=[];			
			$.each(b[id].juragan,function(c,b){
				a.push('<li><a class="p-2 d-block text-light text-decoration-none" href="$link_invoice'+b.slug+'"><i class="fad fa-user-circle"></i> '+b.nama+'</li>');
			}),

			$(a.join('')).appendTo('#listLi');
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

	// cek pembayaran
	$('.pesanBayar').on('click',function(){
		let juragan = $(this).data('juragan'),
			id = $(this).data('invoice'),
			dv_list =$("<div/>").addClass('list-group list-group-flushs').attr('id', 'list_pembayaran');

			$.getJSON('$link_api_get_pembayaran', {id:id}, function(bayar){
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
						btn = ``;
						ico = 'minus-circle text-info';
						info = 'dana belum dicek';
						break;
				}

				var bta = ``;

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
		$.getJSON('$link_api_get_bank', function(data){
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

	$('.belumFungsi').on('click',function(){
		alert('Fungsi ini belum tersedia');
	});

	// 
	var maxLength = 300;
	$(".keterangan").each(function(){
		var myStr = $(this).text();
		if($.trim(myStr).length > maxLength){
			var newStr = myStr.substring(0, maxLength);
			var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
			$(this).empty().html(newStr);
			$(this).append(' <a href="javascript:void(0);" class="read-more">lanjut ...</a>');
			$(this).append('<span class="more-text">' + removedStr + '</span>');
		}
	});
	$(".read-more").click(function(){
		$(this).siblings(".more-text").contents().unwrap();
		$(this).remove();
	});

	// disable hit enter
	// https://stackoverflow.com/a/895231/2094645
	$(document).on("keydown", ":input:not(textarea)", function(event) {
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

$packer = new Tholu\Packer\Packer($js, 'Normal', true, false, true);
$packed_js = $packer->pack();
echo '<script>' . $packed_js . '</script>';
?>
<?= $this->endSection() ?>