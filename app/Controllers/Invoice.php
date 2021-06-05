<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Invoice extends ResourceController
{
    protected $modelName = 'App\Models\InvoiceModel';
    protected $format    = 'json';

    public function index()
    {
        $rows = $this->model->ambil_data()->get()->getResult();

        $response = [];
        foreach ($rows as $pesanan) {
            $juragan  = json_decode($pesanan->juragan);
            $pengguna = json_decode($pesanan->pengguna);
            $pemesan  = json_decode($pesanan->pelanggan);
            $kirim    = json_decode($pesanan->kirimKe);
            $barang   = json_decode($pesanan->barang);

            $dibeli = [];
            foreach ($barang as $p) {
                $dibeli[] = [
                    'id'       => $p->id,
                    'id_stock' => $p->stok_id,
                    'code'     => strtoupper($p->kode),
                    'size'     => strtoupper($p->ukuran),
                    'price'    => $p->harga,
                    'qty'      => $p->qty

                ];
            }

            $response[] = [
                'id'            => (int) $pesanan->id_invoice,
                'invoice'       => $pesanan->seri,
                'tanggal_pesan' => $pesanan->tanggal_pesan, // "2020-09-10",
                'status'        => [
                    'pesanan'    => $pesanan->status_pesanan,
                    'pembayaran' => $pesanan->status_pembayaran,
                    'pengiriman' => $pesanan->status_pengiriman
                ],
                'sumber' => [
                    'id'    => (int) $pesanan->source_id,
                    'label' => $pesanan->label_asal
                ],
                'juragan' => [
                    'id'   => $juragan->id,
                    'nama' => $juragan->nama,
                    'slug' => $juragan->slug
                ],
                'pengguna' => [
                    'id'       => $pengguna->id,
                    'nama'     => $pengguna->nama,
                    'username' => $pengguna->username
                ],
                'pelanggan' => [
                    'pemesan' => [
                        'id'        => $pemesan->id,
                        'nama'      => $pemesan->nama,
                        'cod'       => ($pemesan->cod === 0 ? false : true),
                        'alamat'    => ($pemesan->cod === 0 ? $pemesan->alamat : null),
                        'kecamatan' => $pemesan->kecamatan,
                        'kabupaten' => $pemesan->kabupaten,
                        'provinsi'  => $pemesan->provinsi,
                        'kodepos'   => $pemesan->kodepos

                    ],
                    'alamat_kirim' => [
                        'id'        => $kirim->id,
                        'nama'      => $kirim->nama,
                        'cod'       => ($kirim->cod === 0 ? false : true),
                        'alamat'    => ($kirim->cod === 0 ? $kirim->alamat : null),
                        'kecamatan' => $kirim->kecamatan,
                        'kabupaten' => $kirim->kabupaten,
                        'provinsi'  => $kirim->provinsi,
                        'kodepos'   => $kirim->kodepos

                    ]
                ],
                'barang_dibeli' => $dibeli

                /*


                "juragan_id": "2",
                "pemesan_id": "26",
                "kirimKepada_id": "27",
                "user_id": "2",
                // "status_pesanan": "1",
                // "status_pembayaran": "6",
                // "status_pengiriman": "1",
                "keterangan": null,
                "created_at": "1599710648",
                "update_at": "1599916883",
                "deleted_at": null,

                "barang": "[{\"id\":7, \"stok_id\":\"null\", \"kode\":\"SK-20\", \"ukuran\":\"s\", \"harga\":234000, \"qty\":1},{\"id\":8, \"stok_id\":\"null\", \"kode\":\"BK-01\", \"ukuran\":\"custom\", \"harga\":900000, \"qty\":1}]",
                "biaya": "[{\"id\":4, \"biaya_id\":2, \"nominal\":\"-300000\", \"label\":\"DISKON HEBAT\"}]",
                "status": null,
                "pembayaran": "[{\"id\":35, \"sumber\":1, \"nama\":\"cod\", \"atas_nama\":\"C.O.D\", \"nominal\":834000, \"status\":2, \"tanggal_bayar\":1599843600, \"tanggal_cek\":1599916302},{\"id\":36, \"sumber\":4, \"nama\":\"edc\", \"atas_nama\":\"EDC BNI\", \"nominal\":834000, \"status\":3, \"tanggal_bayar\":1599843600, \"tanggal_cek\":1599916883}]"
                */
            ];
        }

        return $this->respond($response);
    }

    // ...
    public function tes($id)
    {
        $hasil = $this->model->jumlah_produk($id)->getResult()[0];



        return $this->respond($hasil);
        # code...
    }
}
