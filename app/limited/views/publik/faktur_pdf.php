<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        table .center { text-align: center }
        table .right { text-align: right }
		table .size { width: 90px; }
		table .total { background-color: #eee; font-size: 120%; }

		td { vertical-align: top; }
		.pull-right { float: right; }
	</style>
</head>
<body>

	<img src="<?php echo base_url('berkas/img/logo.png') ?>" style="float:right; max-height: 120px; margin-right: 30px; height: auto; ">
	<div class="isi">
		<header>
			Tanggal cetak : <?php echo mdate('%d-%M-%y', now()); ?><br/>
			<br/>
			<?php 
			$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
			echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($pesanan->seri_faktur, $generator::TYPE_CODE_128, 1, 40)) . '">';
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
					<tbody>
						<tr>
							<td>Nama<span class="pull-right">:</span></td>
							<td><?php echo strtoupper( $pesanan->nama ); ?></td>
						</tr>
						<tr>
							<td>Hp<span class="pull-right">:</span></td>
							<td><?php echo $pesanan->hp1; echo (isset($pesanan->hp2) ? ', ' . $pesanan->hp2 : ''); ?></td>
						</tr>
						<tr>
							<td>Alamat<span class="pull-right">:</span></td>
							<td><?php echo strtoupper( $pesanan->alamat ); ?></td>
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
							<td>No. Faktur<span class="pull-right">:</span></td>
							<td><?php echo strtoupper( $pesanan->seri_faktur ); ?></td>
						</tr>
                        <?php /*
						<tr>
							<td>Status Pembayaran<span class="pull-right">:</span></td>
							<td><?php echo ($pesanan->status_transfer === 'ada' ? 'Lunas' : 'Belum Lunas' ); ?></td>
						</tr>
						<tr>
							<td>Tipe Transaksi<span class="pull-right">:</span></td>
							<td><?php echo strtoupper($biaya->b); ?></td>
                        </tr>
                        */ ?>
						<tr>
							<td>Tanggal Pesan<span class="pull-right">:</span></td>
							<td><?php echo mdate('%d-%M-%y', $pesanan->tanggal_dibuat); ?></td>
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
						<td>Harga @</td>
						<td>Total</td>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $jumlah_produk = 0;
                    $harga_total = 0;
                    $harga_final = 0;

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

                    
                    $pi = 1;
                    foreach ($dipesan as $produk) {
                        echo '<tr>';
                        $jumlah_produk += $produk->jumlah;
                        $harga_total += ($produk->harga * $produk->jumlah); // kalkulasi harga

                        echo '<td class="center">' . $pi . '</td>';
                        echo '<td>' . strtoupper($produk->kode . ' (' . $produk->ukuran . ')') . '</td>';
                        echo '<td class="center">' . $produk->jumlah . '</td>';
                        echo '<td class="right">' . harga($produk->harga) . '</td>';
                        echo '<td class="right">' . harga($harga_total) . '</td>';
                        echo '</tr>';
                        $pi++;
                    }

                     // cal
                     /*
                     $wajib_bayar += $harga_total;
                     $wajib_bayar += $pesanan->ongkir;
                     $wajib_bayar += $pesanan->unik;
                     $wajib_bayar -= $pesanan->diskon;
                     */

                     // $kekurangan = $wajib_bayar - $dibayar;
                    ?>
				</tbody>
				<tfoot>
					<tr> 
						<td colspan="4" class="kanan">Subtotal</td>
						<td class="kanan"><?php $harga_final += $harga_total; echo harga($harga_total); ?></td>
					</tr>
                    <?php 
                    // ongkir
                    if ($pesanan->ongkir > 0) { ?>
                        <tr>
                            <td colspan="4" class="kanan">Tarif Ongkir</td>
                            <td class="kanan"><?php $harga_final += $pesanan->ongkir;  echo harga($pesanan->ongkir); ?></td>
                        </tr>
                    <?php
                    }
                    // unik
                    if ($pesanan->unik > 0) { ?>
                        <tr>
                            <td colspan="4" class="kanan">Angka Unik</td>
                            <td class="kanan"><?php $harga_final += $pesanan->unik; echo harga($pesanan->unik); ?></td>
                        </tr>
                    <?php
                    }

                    // diskon
                    if ($pesanan->diskon > 0) { ?>
                        <tr>
                            <td colspan="4" class="kanan">Diskon</td>
                            <td class="kanan">- <?php $harga_final -= $pesanan->diskon; echo harga($pesanan->diskon); ?></td>
                        </tr>
                    <?php
                    }
                    ?>

					<tr class="total">
						<td colspan="4" class="kanan">Total Akhir</td>
						<td class="kanan"><?php echo harga($harga_final); ?></td>
                    </tr>
                    ?>
				</tfoot>
			</table>
		</div>
		</main>
	</div>
</body>
</html>