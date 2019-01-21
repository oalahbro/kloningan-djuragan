<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <div class="konten" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4"><?php echo $judul; ?></h1>
                <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><canvas id="jumlah_pesanan" width="400" height="400"></canvas></div>
                <div class="col-sm-6"><canvas id="jumlah_pesanan_lunas" width="400" height="400"></canvas></div>
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>


    <?php

    $tanggal_m = tanggal_default('mulai'); // '26-04-2017'
    $tanggal_a = tanggal_default('akhir'); // '25-05-2017'

    $bulan_kemarin = date('F', strtotime($tanggal_m)); // nama bulan kemarin

    $juragan = $this->juragan->_semua();
    $list_juragan = array();
    foreach ($juragan->result() as $juragan) {
        $list_juragan[] = $juragan->nama;
        // $_terkirim_bln_ini[] = $this->pesanan->_count($juragan->id, $tanggal_m, $tanggal_a, 'kirim');
        // $_terkirim_bln_kemarin[] = $this->pesanan->_count($juragan->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'kirim');
        // $_transfer_bln_ini[] = $this->pesanan->_count($juragan->id, $tanggal_m, $tanggal_a, 'transfer');
        // $_transfer_bln_kemarin[] = $this->pesanan->_count($juragan->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'transfer');
        $_pesanan_bln_ini[] = $this->faktur->count_faktur($juragan->id, $tanggal_m, $tanggal_a, 'semua')->num_rows();
        $_pesanan_bln_kemarin[] = $this->faktur->count_faktur($juragan->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'semua')->num_rows();

        // $pending_saat_ini[] = $this->pesanan->_count($juragan->id, $tanggal_m, $tanggal_a, 'pending');
    }

    ?>

    <script>
    var ctx = document.getElementById("jumlah_pesanan").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: <?php echo json_encode($list_juragan) ?>,
            datasets: [
            {
                label: 'kemarin',
                data: <?php echo json_encode($_pesanan_bln_kemarin) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1
            },
            {
                label: 'sekarang',
                data: <?php echo json_encode($_pesanan_bln_ini) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }
            ]
        },
        options: {
            title: {
                display: true,
                text: ['Berdasarkan Jumlah Pesanan Diproses', 'per <?php echo $tanggal_a . " | " . $tanggal_m; ?>']
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>
