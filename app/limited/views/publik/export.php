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
            <div class="search">
                <label for="basic-url">Your vanity URL</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
            </div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

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
