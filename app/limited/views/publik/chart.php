<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$ju = $this->juragan->_semua();

$juragan = array();

$tanggal_m = tanggal_default('mulai'); // '26-04-2017'
$tanggal_a = tanggal_default('akhir'); // '25-05-2017'

$bulan_ini = date('F', strtotime($tanggal_a)); // nama bulan ini
$bulan_kemarin = date('F', strtotime($tanggal_m)); // nama bulan kemarin

$_terkirim_bln_kemarin = array();
$_terkirim_bln_ini = array();
$_transfer_bln_kemarin = array();
$_transfer_bln_ini = array();
$_masuk_bln_kemarin = array();
$_masuk_bln_ini = array();
$pending_saat_ini = array();

foreach ($ju->result() as $j) {
	$juragan[] = $j->nama;
	$_terkirim_bln_ini[] = $this->pesanan->_count($j->id, $tanggal_m, $tanggal_a, 'kirim');
	$_terkirim_bln_kemarin[] = $this->pesanan->_count($j->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'kirim');
    $_transfer_bln_ini[] = $this->pesanan->_count($j->id, $tanggal_m, $tanggal_a, 'transfer');
    $_transfer_bln_kemarin[] = $this->pesanan->_count($j->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'transfer');
    $_masuk_bln_ini[] = $this->pesanan->_count($j->id, $tanggal_m, $tanggal_a, 'masuk');
    $_masuk_bln_kemarin[] = $this->pesanan->_count($j->id, satu_bulan_sebelumnya($tanggal_m), satu_bulan_sebelumnya($tanggal_a), 'masuk');
    $pending_saat_ini[] = $this->pesanan->_count($j->id, $tanggal_m, $tanggal_a, 'pending');
}



if($this->session->level === 'cs') {
    $id_juragan = $this->juragan->_id($this->uri->segment(1));

    $nama_juragan = $this->juragan->_nama($id_juragan);

    $tahun_ini = date('Y', time());
    $tahun_lalu = date('Y', strtotime('-1 year', time()));
    $tahun_lalu2 = date('Y', strtotime('-2 year', time()));

    $list_tahun_ini = array();
    $variable = $this->pesanan->_count_year($tahun_ini, $id_juragan)->result();
    foreach ($variable as $cs) {
        $list_tahun_ini[$cs->bln] = (int) $cs->count;
    }

    $list_tahun_lalu = array();
    $variable = $this->pesanan->_count_year($tahun_lalu, $id_juragan)->result();
    foreach ($variable as $cs) {
        $list_tahun_lalu[$cs->bln] = (int) $cs->count;
    }

    $list_tahun_lalu2 = array();
    $variable = $this->pesanan->_count_year($tahun_lalu2, $id_juragan)->result();
    foreach ($variable as $cs) {
        $list_tahun_lalu2[$cs->bln] = (int) $cs->count;
    }

    $bulan_sebenarnya = array();
    for ($i=1; $i <= 12; $i++) { 
        $bulan_sebenarnya[$i] = 0;
    }

    $th_ini = array_replace($bulan_sebenarnya, $list_tahun_ini);

    $arr_th_i = array();
    foreach ($th_ini as $th_) {
        $arr_th_i[] = (int) $th_;
    }

    $th_lalu = array_replace($bulan_sebenarnya, $list_tahun_lalu);

    $arr_th_l = array();
    foreach ($th_lalu as $th_) {
        $arr_th_l[] = (int) $th_;
    }

    $th_lalu2 = array_replace($bulan_sebenarnya, $list_tahun_lalu2);

    $arr_th_l2 = array();
    foreach ($th_lalu2 as $th_) {
        $arr_th_l2[] = (int) $th_;
    }

    $c_tahun_ini = json_encode($arr_th_i);
    $c_tahun_lalu = json_encode($arr_th_l);
    $c_tahun_lalu2 = json_encode($arr_th_l2);
}
?>
<div class="" id="">
	<div class="page-header">
		<h1><?php echo $judul; ?></h1>
	</div>

	<div class="utama">
		<div class="container-fluid">
            <?php if($this->session->level === 'cs') { ?> <div id="container2" style="width: 100%; height: 300px; margin: 20px auto"></div> <?php } ?>
            <div class="row">
                <div class="col-sm-6">
                    <div id="total_masuk" style="width: 100%; height: 500px; margin: 0 auto"></div>
                </div>
                <div class="col-sm-6">
                    <div id="total_pesanan_terkirim" style="width: 100%; height: 500px; margin: 0 auto"></div>
                </div>
                <div class="col-sm-6">
                    <div id="total_transfer" style="width: 100%; height: 500px; margin: 0 auto"></div>
                </div>
                <div class="col-sm-6">
                    <div id="total_pending" style="width: 100%; height: 500px; margin: 0 auto"></div>
                </div>
            </div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
	$(document).ready(function(){
		$.getMultiScripts = function(arr, path) {
			var _arr = $.map(arr, function(scr) {
				return $.getScript( (path||"") + scr );
			});

			_arr.push($.Deferred(function( deferred ){
				$( deferred.resolve );
			}));

			return $.when.apply($, _arr);
		}

		var script_arr = [
		'<?php echo base_url('assets/js/bootstrap.min.js'); ?>', 
		'<?php echo base_url('assets/js/pace.min.js'); ?>'
		];

		$.getMultiScripts(script_arr).done(function() {
            // all scripts loaded
             $('.deropdowen').dropdown();
        });
	});
</script>

<script type="text/javascript">
  Highcharts.chart('total_pesanan_terkirim', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Diagram Berdasarkan Total Pesanan Terkirim (PCS)'
    },
    subtitle: {
        text: 'Data per tanggal pembukuan <?php echo $tanggal_m; ?> ~ <?php echo $tanggal_a; ?>'
    },
    xAxis: {
        categories: <?php echo json_encode($juragan); ?>,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Pesanan',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' pcs',
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        //borderWidth: 0,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: '<?php echo $bulan_kemarin; ?>',
        data: <?php echo json_encode($_terkirim_bln_kemarin); ?>
    }, {
        name: '<?php echo $bulan_ini; ?>',
        data: <?php echo json_encode($_terkirim_bln_ini); ?>
    }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('total_transfer', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Diagram Berdasarkan Total Transfer Masuk'
    },
    subtitle: {
        text: 'Data per tanggal pembukuan <?php echo $tanggal_m; ?> ~ <?php echo $tanggal_a; ?>'
    },
    xAxis: {
        categories: <?php echo json_encode($juragan); ?>,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Pesanan',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' pesanan',
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        //borderWidth: 0,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: '<?php echo $bulan_kemarin; ?>',
        data: <?php echo json_encode($_transfer_bln_kemarin); ?>
    }, {
        name: '<?php echo $bulan_ini; ?>',
        data: <?php echo json_encode($_transfer_bln_ini); ?>
    }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('total_masuk', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Diagram Berdasarkan Total Pesanan Masuk (PCS)'
    },
    subtitle: {
        text: 'Data per tanggal pembukuan <?php echo $tanggal_m; ?> ~ <?php echo $tanggal_a; ?>'
    },
    xAxis: {
        categories: <?php echo json_encode($juragan); ?>,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Pesanan',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' pcs',
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        //borderWidth: 0,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: '<?php echo $bulan_kemarin; ?>',
        data: <?php echo json_encode($_masuk_bln_kemarin); ?>
    }, {
        name: '<?php echo $bulan_ini; ?>',
        data: <?php echo json_encode($_masuk_bln_ini); ?>
    }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('total_pending', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Diagram Berdasarkan Total Pesanan Pending (PCS)'
    },
    subtitle: {
        text: 'Data dari semua tanggal'
    },
    xAxis: {
        categories: <?php echo json_encode($juragan); ?>,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Pesanan',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' pcs',
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        enabled: false
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Pending',
        data: <?php echo json_encode($pending_saat_ini); ?>
    }]
});
</script>

<?php if($this->session->level === 'cs') { ?>
<script type="text/javascript">
    Highcharts.chart('container2', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Perbandingan Pesanan antara tahun <?php echo $tahun_lalu2; ?>, <?php echo $tahun_lalu; ?> dan <?php echo $tahun_ini; ?>'
    },
    subtitle: {
        text: 'Juragan : <?php echo $nama_juragan; ?>'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Pesanan'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true,
        valueSuffix: ' pesanan'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Tahun <?php echo $tahun_lalu2; ?>',
        marker: {
            symbol: 'square'
        },
        data: <?php echo $c_tahun_lalu2; ?>

    },{
        name: 'Tahun <?php echo $tahun_lalu; ?>',
        marker: {
            symbol: 'dot'
        },
        data: <?php echo $c_tahun_lalu; ?>

    }, {
        name: 'Tahun <?php echo $tahun_ini; ?>',
        marker: {
            symbol: 'diamond'
        },
        data: <?php echo $c_tahun_ini; ?>
    }]
});
</script>
<?php } ?>