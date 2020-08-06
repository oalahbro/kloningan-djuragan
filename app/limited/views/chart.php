<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo $this->load->view("_inc/header", $judul, TRUE) ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<?php echo $this->load->view("_inc/".$include."/navbar", '', TRUE) ?>

    <div class="konten" id="konten">
        <div class="jumbotron jumbotron-fluid">
            <div class="container-fluid">
                <h3><?php echo $judul; ?></h3>
                <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><canvas id="jumlah_pesanan" width="400" height="400"></canvas></div>
                <div class="col-sm-6"><canvas id="pesanan_terkirim" width="400" height="400"></canvas></div>
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

<?php echo $this->load->view("_inc/".$include."/js-global", '', TRUE); ?>
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

        $_pesanan_terkirim_ini[] = (int) $this->faktur->counter($juragan->id, $tanggal_m, $tanggal_a, 'terkirim')->row()->pcs;
        $_pesanan_terkirim_kemarin[] = (int) $this->faktur->counter($juragan->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'terkirim')->row()->pcs;


        $_pesanan_diproses_ini[] = $this->faktur->counter($juragan->id, $tanggal_m, $tanggal_a, 'diproses')->num_rows();
        $_pesanan_diproses_kemarin[] = $this->faktur->counter($juragan->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'diproses')->num_rows();
        $_pesanan_belum_proses_ini[] = $this->faktur->counter($juragan->id, $tanggal_m, $tanggal_a, 'belum_proses')->num_rows();
        $_pesanan_belum_proses_kemarin[] = $this->faktur->counter($juragan->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'belum_proses')->num_rows();

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
                    label: 'belum diproses kemarin',
                    stack: 'Stack 0',
                    data: <?php echo json_encode($_pesanan_belum_proses_kemarin) ?>,
                    backgroundColor: 'rgba(255, 99, 132, 1)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                },
                {
                    label: 'belum diproses sekarang',
                    stack: 'Stack 1',
                    data: <?php echo json_encode($_pesanan_belum_proses_ini) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 1)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'diproses kemarin',
                    stack: 'Stack 0',
                    data: <?php echo json_encode($_pesanan_diproses_kemarin) ?>,
                    backgroundColor: 'rgba(255, 9, 132, 0.2)',
                    borderColor: 'rgba(255,9,132,1)',
                    borderWidth: 1
                },
                {
                    label: 'diproses sekarang',
                    stack: 'Stack 1',
                    data: <?php echo json_encode($_pesanan_diproses_ini) ?>,
                    backgroundColor: 'rgba(154, 102, 235, 0.2)',
                    borderColor: 'rgba(154, 102, 235, 1)',
                    borderWidth: 1
                }
                
            ]
        },
        options: {
            title: {
                display: true,
                text: ['Berdasarkan Jumlah Pesanan', 'per <?php echo $tanggal_m . " | " . $tanggal_a; ?>']
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    },
                    stacked: true
                }]
            }
        }
    });

    // 
    var ctx = document.getElementById("pesanan_terkirim").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: <?php echo json_encode($list_juragan) ?>,
            datasets: [
                {
                    label: 'terkirim kemarin',
                    stack: 'Stack 0',
                    data: <?php echo json_encode($_pesanan_terkirim_kemarin) ?>,
                    backgroundColor: 'rgba(255, 99, 132, 1)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                },
                {
                    label: 'terkirim sekarang',
                    stack: 'Stack 1',
                    data: <?php echo json_encode($_pesanan_terkirim_ini) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 1)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }                
            ]
        },
        options: {
            title: {
                display: true,
                text: ['Berdasarkan Jumlah Pesanan Terkirim (pcs)', 'per <?php echo $tanggal_m . " | " . $tanggal_a; ?>']
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    },
                    stacked: true
                }]
            }
        }
    });
    </script>


<?php echo $this->load->view("_inc/footer", '', TRUE); ?>

    