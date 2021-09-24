<?php

use App\Libraries\Ongkir;

$logo = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4800 4800" style="height:auto;width:120px"><g fill="#000"><path d="M3747 4713c-4-3-7-42-7-85v-78h140v170h-63c-35 0-67-3-70-7zM3565 4675c-5-2-22-6-37-9-64-14-128-102-128-175 0-105 77-181 185-181 51 0 119 30 135 59 8 17 5 24-25 46l-34 27-27-21c-49-38-104-22-125 37-13 38 3 97 31 112 30 16 76 12 95-10 18-20 18-20 56 2 22 12 39 27 39 34 0 19-56 62-92 69-18 4-40 8-48 10s-19 2-25 0zM2880 4490v-180h100v360h-100v-180zM3040 4490v-180h39c38 0 43 4 108 87l68 87 3-87 3-87h99v360l-42-1c-41 0-45-3-108-81l-65-82-3 82-3 82h-99v-180zM1123 4205c-29-8-71-24-94-35l-40-21 31-42c18-23 43-58 56-78l24-35 66 33c73 36 152 45 173 19 17-20-7-40-71-62-127-41-168-79-168-153 1-158 166-278 342-250 57 9 168 52 168 64 0 10-101 140-108 139-4 0-29-11-57-24-59-27-131-32-145-10-16 24-7 34 56 58 153 58 190 92 187 173-3 99-74 190-174 222-62 21-174 21-246 2zM1573 4188c3-13 36-155 73-315l68-293h446l-7 33c-4 17-12 52-18 77l-11 45-136 3-136 3-6 31c-3 17-6 34-6 39s50 9 110 9c124 0 120-4 97 85l-13 50-113 3c-123 3-117 0-135 75l-6 27h273l-7 38c-3 20-11 54-16 75l-11 37h-451l5-22zM2266 4183c-3-15-21-147-41-293-19-146-38-275-40-287-5-23-4-23 88-23h94l6 53c3 28 9 114 13 190s10 139 14 142c3 2 52-83 107-188l102-192 90-3c50-1 91 1 91 5s-82 145-183 313l-183 305-76 3-76 3-6-28zM2767 3898c40-172 73-314 73-315 0-2 99-3 220-3 245 0 230-5 211 70-5 19-12 47-15 63l-6 27h-268l-10 40-10 40h114c63 0 114 3 114 8 0 4-4 23-9 42s-12 47-15 63l-6 27h-115c-125 0-116-5-130 68l-7 32h136c75 0 136 2 136 6 0 3-7 36-16 75l-16 69h-455l74-312zM3297 3898c40-172 73-314 73-316s32-2 71 0l71 3 86 155 86 155 31-130c17-72 34-142 38-157 7-28 8-28 92-28 69 0 85 3 85 15 0 11-77 350-135 593-5 20-11 22-78 22h-73l-86-151-86-151-32 139c-17 76-33 144-35 151-3 8-31 12-93 12h-89l74-312zM882 3201c2-5 75-104 163-220l160-211h438c366 0 437 2 430 14-4 7-78 106-163 220l-155 206h-438c-252 0-437-4-435-9zM1447 2448c93-123 258-341 367-485l197-262-108-143c-60-79-221-291-358-473-136-181-252-336-258-342-7-10 80-13 431-13h441l366 486 367 486-364 483-363 484h-443l-443 1 168-222z"/><path d="M2296 2658c4-7 163-220 354-473 190-253 350-466 354-473 5-9-111-171-353-492-199-263-361-481-361-484 0-4 197-6 438-5h437l360 478c198 263 360 485 360 493s-162 229-360 491l-360 477h-438c-348 0-437-3-431-12zM2006 366c-113-151-206-277-206-280 0-4 197-6 438-5h437l195 260c107 142 201 268 209 279 13 20 11 20-426 20h-440l-207-274z"/></g><g fill="#da251d"><path d="M3747 4713c-4-3-7-42-7-85v-78h140v170h-63c-35 0-67-3-70-7zM882 3201c2-5 75-104 163-220l160-211h438c366 0 437 2 430 14-4 7-78 106-163 220l-155 206h-438c-252 0-437-4-435-9zM2006 366c-113-151-206-277-206-280 0-4 197-6 438-5h437l195 260c107 142 201 268 209 279 13 20 11 20-426 20h-440l-207-274z"/></g></svg>';

$html_logo = '<img src="data:image/svg+xml;base64,' . base64_encode($logo) . '"  width="100" height="100" />';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice <?= $invoice->seri; ?></title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: small;
        }

        table.inv {
            border: 1px solid lightgrey;
        }

        .gray {
            background-color: lightgray
        }

        .bb {
            border-bottom: 1px solid #ddd;
            margin-bottom: 30px;
            padding-bottom: 15px
        }

        .inf {
            text-transform: uppercase;
            color: #ccc;
        }

        .text-danger {
            color: red;
        }

        .ribbon {
            padding-top: 15px;
            padding-bottom: 15px;
            text-align: center;
            width: 400px;
            position: fixed;
            color: white;
            font-size: 18px;
            transform: rotate(45deg);
            top: -20px;
            right: -210px;
        }

        .ribbon.red {
            background: #d9534f;
        }

        .ribbon.green {
            background: #5cb85c;
        }
    </style>

</head>

<body>
    <div class="ribbon top-left <?= ($invoice->status_pembayaran === '6' ? 'green' : 'red'); ?>"><?= ($invoice->status_pembayaran === '6' ? 'Lunas' : 'Belum Lunas'); ?></div>

    <table width="100%" class="bb">
        <tr>
            <td><?= $html_logo; ?></td>
            <td align="right">
                <h3>Seven Inc</h3>
                <p>Karangjambe, Banguntapan<br />Bantul, D.I Yogyakarta - 55198</p>
            </td>
        </tr>

    </table>

    <table width="100%" class="bb">
        <tbody>
            <tr>
                <td>
                    No Invoice: #<?= $invoice->seri; ?><br />
                    Tanggal: <?= $invoice->tanggal_pesan; ?><br />
                    Status: <?= ($invoice->status_pembayaran === '6' ? 'Lunas' : 'Belum Lunas'); ?>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%">
        <?php
        $ongkir  = new Ongkir();
        $pemesan = json_decode($invoice->pelanggan);
        $kirimKe = json_decode($invoice->kirimKe);
        ?>
        <tr>
            <td>
                <span class="inf">Pemesan<?= ($pemesan->id === $kirimKe->id ? ' / Kirim Kepada' : '') ?></span> <br />
                <?= $pemesan->nama; ?><br />
                <?php
                for ($i = 0; $i < count($pemesan->hp); $i++) {
                    if ($i === 1) {
                        echo ' / ';
                    }
                    echo $pemesan->hp[$i];
                }
                ?><br />
                <?php
                if ($pemesan->cod === 1) {
                    echo 'C.O.D';
                } else {
                    $PPro = $pemesan->provinsi;
                    $PKab = $pemesan->kabupaten;
                    $PKec = $pemesan->kecamatan;
                    $kota = $ongkir->kota($PPro, $PKab);

                    $kec  = strtoupper($ongkir->kecamatan($PKab, $PKec)['subdistrict_name']);
                    $kab  = strtoupper(($kota['type'] === 'Kabupaten' ? '' : '(Kota) ') . $kota['city_name']);
                    $prov = strtoupper($ongkir->provinsi($PPro)['province']);

                    echo $pemesan->alamat . '<br/>' . $kec . ', ' . $kab . '<br/>' . $prov . ' - ' . $pemesan->kodepos;
                }
                ?>
            </td>
            <td>
                <?php if ($pemesan->id !== $kirimKe->id) { ?>
                    <span class="inf">Kirim Kepada</span> <br />
                    <?= $kirimKe->nama; ?><br />
                    <?php
                    for ($i = 0; $i < count($kirimKe->hp); $i++) {
                        if ($i === 1) {
                            echo ' / ';
                        }
                        echo $kirimKe->hp[$i];
                    }
                    ?><br />
                    <?php
                    if ($kirimKe->cod === 1) {
                        echo 'C.O.D';
                    } else {
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
                <?php } ?>
            </td>
        </tr>
    </table>

    <br />

    <table width="100%" class="inv">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Deskripsi</th>
                <th>QTY</th>
                <th>Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $wajib_bayar = 0;
            // $count_barang = 0;
            $harga_barang = 0;

            foreach (json_decode($invoice->barang) as $b) {
                // $count_barang += $b->qty;
                $wajib_bayar += $b->qty * $b->harga;
                $harga_barang += $b->qty * $b->harga;
                echo '<tr>';
                echo '<td>' . strtoupper($b->kode) . ' (' . strtoupper($b->ukuran) . ')';

                echo '</td>';
                echo '<td style="text-align:center">' . $b->qty . '</td>';
                echo '<td style="text-align:right">' . number_to_currency($b->harga, 'IDR') . '</td>';
                echo '<td style="text-align:right">' . number_to_currency($b->harga * $b->qty, 'IDR') . '</td>';
                echo '</tr>';
            }
            ?>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td align="right">Subtotal</td>
                <td align="right"><?= number_to_currency($harga_barang, 'IDR'); ?></td>
            </tr>

            <?php
            if ($invoice->biaya !== null) {
                foreach (json_decode($invoice->biaya) as $c) {
                    $wajib_bayar += $c->nominal; ?>
                    <tr>
                        <td colspan="2"></td>
                        <td align="right">
                            <?php
                            $biaya = 'Lainnya';

                            if ($c->biaya_id === 1) {
                                $biaya = 'Ongkir';
                            }
                            $label = $c->label;

                            if ($c->label !== 'null' && $c->biaya_id !== 1) {
                                $biaya = $c->label . ' ';
                                $label = '';
                            } elseif ($c->label === 'null') {
                                $label = '';
                            } ?>
                            <?= $biaya; ?>
                            <?= $label; ?>
                        </td>
                        <td align="right" class="<?= ($c->nominal < 0 ? 'text-danger' : 'normal'); ?>">
                            <?= number_to_currency($c->nominal, 'IDR'); ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
            <tr style="font-size: 1.5em !important;">
                <td colspan="2"></td>
                <td align="right">Total</td>
                <td align="right" class="gray"><?= number_to_currency($wajib_bayar, 'IDR'); ?></td>
            </tr>
        </tfoot>
    </table>

</body>

</html>