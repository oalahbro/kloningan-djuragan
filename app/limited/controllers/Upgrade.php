<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upgrade extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}

	public function index() {
		echo anchor('upgrade/migrating', 'Step 1');
	}

	public function migrating() { ?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>Upgrade</title>
			<script src="<?php echo base_url('berkas/js/jquery-3.3.1.min.js') ?>"></script>
			<style>
			.com code {font-size:87.5%;color:#e83e8c;word-break:break-word}
			.com:after { content: ", "}
			</style>
		</head>
		<body>
			<div id="message">
				
			</div>
			<div id="fetch-snowfall-data">
				<?php echo form_button(array('content' => 'update', 'id' => 'execute')) ?>
			</div>

			<div id="response_container2">
				
			</div>

			<script>
				jQuery(document).ready(function($) {
					// setTimeout(getProgress,1000);
					$('#execute').click(function(){
						// $('#message').hide();
					/*
						call the updateStatus() function every 3 second to update progress bar value.
						*/
						updateStatus();
						//alert('klik');
						/*
						*/
					});

					function updateStatus(){
						$.ajax({
							method: "GET",
							url: "<?php echo site_url('upgrade/progress_satu') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									// $( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
									$('<span class="com"><code>'+data.id+'</code></span>, ').appendTo( "#message" );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/status_kiriman_2", "next"); ?>' );
								}
							}
						})
					} 
				});
			</script>
			</body>
		</html>
	<?php 
	}

	public function progress_satu() {
		$migrasi = $this->db->where(array('status_transfer' => '2', 'status_kirim' => '2') )->get('faktur')->row();


		// hitung ulang 
		// ambil total yang wajib dibayar
		$bayar_db = $this->faktur->get_pays($migrasi->id_faktur);

		$wajib_bayar = 0;
		$dibayar = 0;

		if ($bayar_db->num_rows() > 0) {
			foreach ($bayar_db->result() as $ter) {
				if($ter->tanggal_cek !== NULL) {
					// yang sudah dicek
					$dibayar += $ter->jumlah;
					$id_pembayaran = $ter->id_pembayaran;
				}
			}
		}
		
		$produk_db = $this->faktur->get_orders($migrasi->id_faktur);
		$jumlah_produk = 0;
		$harga_total = 0;
		$hproduk = '';

		$arr_produk = array();
		$dipesan = array();

		foreach ($produk_db->result() as $produk) {
			$jumlah_produk += $produk->jumlah;
			$harga_total += ($produk->harga * $produk->jumlah); // kalkulasi harga
			$hproduk .= '<div>' . strtoupper($produk->kode . ' (' . $produk->ukuran . ') = ') . $produk->jumlah . 'pcs</div>';
		}

		$diskonku = $this->faktur->get_biaya($migrasi->id_faktur, 'diskon');
		$ongkirku = $this->faktur->get_biaya($migrasi->id_faktur, 'ongkir');
		$unikku = $this->faktur->get_biaya($migrasi->id_faktur, 'unik');

		// cal
		$wajib_bayar += $harga_total;
		$wajib_bayar += $ongkirku;
		$wajib_bayar += $unikku;
		$wajib_bayar -= $diskonku;

		$kekurangan = $wajib_bayar - $dibayar;

		if($wajib_bayar > $dibayar) {
			$this->faktur->update_pay($id_pembayaran, array('jumlah' => $wajib_bayar));
			$this->faktur->calc_pembayaran($migrasi->id_faktur);
		}


	
		$response = array(
			'id' => $migrasi->id_faktur,
			//'data' => $data,
			'yet' => $migrasi = $this->db->where(array('status_transfer' => '2', 'status_kirim' => '2') )->get('faktur')->num_rows()
		);
	

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

}