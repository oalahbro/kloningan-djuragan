<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$detail_pesanan = json_decode($pesanan->detail);
$biaya = json_decode($pesanan->biaya);
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">

	<style>
		@page { margin: 0; }
		body { margin: 0; font-family: 'Open Sans', sans-serif;}
		header{ border-bottom: 1px solid #eee; }
		.isi {padding-top: 40px; padding-left: 50px; padding-right: 50px; font-size: 11px;}
		.infonya { margin-top: 30px; margin-bottom: 10px}
		.infonya:after {
			clear: both;
			display: block;
			content: "";
		}
		table.info { float: left; border: 0; width: 50%; }
		table.info > thead { font-weight: bold; text-transform: uppercase; }

		table.pesanan { width: 100%; border: 1px solid #eee; border-collapse: collapse;}
		table.pesanan thead {  background: #777; color: #fff; text-align: center; }
		table.pesanan td {  border: 1px solid #eee; }
		table .kanan { text-align: right; }
		table .tengah { text-align: center; }
		table .no { width: 20px; }
		table .size { width: 90px; }
		table .total { background-color: #eee; font-size: 120%; }

		td { vertical-align: top; }
		.pull-right { float: right; }
	</style>
</head>
<body>

	<img src="<?php echo base_url('assets/img/logo-pdf.png') ?>" style="float:right; max-height: 120px; margin-right: 30px; height: auto; ">
	<div class="isi">
		<header>
			ID Book : <?php echo $pesanan->slug; ?><br/>
			Tanggal cetak : <?php echo mdate('%d-%M-%y', now()); ?><br/>
			<br/>
			<?php 
			$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
			echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($pesanan->slug, $generator::TYPE_CODE_128, 1, 40)) . '">';
			?>
			&nbsp;
			<br/>
		</header>
		<main class="main">
			<div class="infonya">
				<table class="info">
					<thead>
						<tr>
							<td colspan="2">Data Pemesan</td>
						</tr>
					</thead>

					<?php 
					$pemesan = json_decode($pesanan->pemesan);
					?>
					<tbody>
						<tr>
							<td>Nama<span class="pull-right">:</span></td>
							<td><?php echo strtoupper( $pemesan->n ); ?></td>
						</tr>
						<tr>
							<td>Hp<span class="pull-right">:</span></td>
							<td><?php echo $pemesan->p[0]; echo (isset($pemesan->p[1]) ? ', ' . $pemesan->p[1] : ''); ?></td>
						</tr>
						<tr>
							<td>Alamat<span class="pull-right">:</span></td>
							<td><?php echo strtoupper( $pemesan->a ); ?></td>
						</tr>

					</tbody>
				</table>

				<table class="info">
					<thead>
						<tr>
						<td colspan="2">Detail Transaksi</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>No Invoice (Faktur)<span class="pull-right">:</span></td>
							<td>#<?php echo $pesanan->id_pesanan; ?></td>
						</tr>
						<tr>
							<td>Status Pembayaran<span class="pull-right">:</span></td>
							<td><?php echo ($pesanan->status_transfer === 'ada' ? 'Lunas' : 'Belum Lunas' ); ?></td>
						</tr>
						<tr>
							<td>Tipe Transaksi<span class="pull-right">:</span></td>
							<td><?php echo strtoupper($biaya->b); ?></td>
						</tr>
						<tr>
							<td>Tanggal Pesan<span class="pull-right">:</span></td>
							<td><?php echo mdate('%d-%M-%y', $pesanan->tanggal_submit); ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div>
			<strong>DETAIL PESANAN</strong>
			<table class="pesanan">
				<thead>
					<tr>
						<td class="no">No</td>
						<td>Produk</td>
						<td class="size">Jumlah (pcs)</td>
						<td>Harga</td>
						<td>Total</td>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($detail_pesanan->p) === 1) {

						$i = 1;
						foreach ($detail_pesanan->p as $p) { ?>
							<tr>
								<td class="tengah"><?php echo $i++; ?></td>
								<td><?php echo strtoupper($p->c . ' ('. $p->s . ')'); ?></td>
								<td class="tengah"><?php echo $p->q; ?></td>

								<?php  $harga = $biaya->m->h / $p->q; ?>

								<td class="kanan"><?php echo (isset($p->h) ? harga($p->h) : harga($harga) ); ?></td>
								<td class="kanan"><?php echo (isset($p->h) ? harga((int) $p->h * (int) $p->q) : harga($biaya->m->h) ); ?></td>
							</tr>
						<?php }
					} else {
						$i = 1;
						foreach ($detail_pesanan->p as $p) { ?>
							<tr>
								<td class="tengah"><?php echo $i++; ?></td>
								<td><?php echo strtoupper($p->c . ' ('. $p->s . ')'); ?></td>
								<td class="tengah"><?php echo $p->q; ?></td>
								<td class="kanan"><?php echo (isset($p->h) ? harga($p->h) : '-' ); ?></td>
								<td class="kanan"><?php echo (isset($p->h) ? harga((int) $p->h * (int) $p->q) : '-' ); ?></td>
							</tr>
						<?php }
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" class="kanan">Subtotal</td>
						<td class="kanan"><?php echo harga($biaya->m->h); ?></td>
					</tr>
					<tr>
						<td colspan="4" class="kanan">Tarif Ongkir</td>
						<td class="kanan"><?php echo (isset($biaya->m->o)? harga($biaya->m->o) : 0); ?></td>
					</tr>
					<?php if(isset($biaya->m->u) && $biaya->m->u > 0) { ?>
					<tr>
						<td colspan="4" class="kanan">Angka Unik</td>
						<td class="kanan"><?php echo harga($biaya->m->u); ?></td>
					</tr>
					<?php } if(isset($biaya->m->d) && $biaya->m->d > 0) { ?>
					<tr>
						<td colspan="4" class="kanan">Diskon</td>
						<td class="kanan" style="color: red;">- <?php echo harga($biaya->m->d); ?></td>
					</tr>
					<?php } ?>
					<?php 
					if($biaya->s === 'dp') {

					}
					?>
					<tr class="total">
						<td colspan="4" class="kanan">Total Akhir</td>
						<td class="kanan"><?php echo harga($biaya->m->t); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
		</main>
	</div>
</body>
</html>