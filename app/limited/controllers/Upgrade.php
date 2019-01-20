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
			<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
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
		$migrasi = $this->db->where('status_kirim', 'terkirim')->order_by('count desc')->get('pesanan')->row();

		$buyer = json_decode( $migrasi->pemesan );
		$detail = json_decode( $migrasi->detail );
		$biaya = json_decode( $migrasi->biaya );

		switch (strtolower($biaya->b)) {
			case 'zalora':
			case 'lazada':
			case 'bukalapak':
			case 'blibli':
			case 'shopee':
			case 'zalora':
			case 'berrybenka':
			case 'mataharimall':
			case 'qoo10':
			case 'jd.id':
			case 'zilingo':
				$mrkt = strtolower( $biaya->b );
				break;
			
			default:
				$mrkt = NULL;
				break;
		}

		// `faktur`
		$data = array();
		$data_id = array();
		$oldis = $this->faktur->_primary('faktur', 'id_faktur');
		if((int) $oldis !== 0) {
			$data_id = array(
				'id_faktur' => $oldis
			);
			$id_faktur = $oldis;
		}

		$data_otr = array(
			// 'id_faktur' => 
			'seri_faktur' => $migrasi->id_pesanan,
			'tanggal_dibuat' => strtotime(mdate('%Y-%m-%d %H:%i:%s', $migrasi->tanggal_submit)),
			'juragan_id' => $migrasi->juragan,
			'pengguna_id' => (empty($migrasi->oleh) ? '37': $migrasi->oleh),
			'nama' => $buyer->n,
			'hp1' => $buyer->p[0],
			'hp2' => (isset($buyer->p[1])? $buyer->p[1]: NULL),
			'tipe' => $mrkt,
			'alamat' => $buyer->a,
			'gambar' => (isset($detail->i) ? json_encode($detail->i) : NULL),
			'keterangan' => (isset($detail->n)? $detail->n: NULL),
		);

		$data['faktur'] = array_merge($data_id, $data_otr);

		// simpan to `faktur`
		$this->faktur->add_invoice($data['faktur']);
		if((int) $oldis === 0) {
			//$id_faktur = '00000';
			$id_faktur = $this->db->insert_id(); // get `id_faktur`
		}

		// `pesanan_produk`
		$i = 0;
		$produk_data = array();			
		foreach ($detail->p as $key) {
			$pesprd_id = $this->faktur->_primary('pesanan_produk', 'id_pesanproduk');
			if ((int) $pesprd_id !== 0) {
				$produk_data[$i] = array(
					'id_pesanproduk' => $pesprd_id
				);
			}

			$produk_data[$i]['faktur_id'] = $id_faktur;
			$produk_data[$i]['kode'] = $key->c;
			$produk_data[$i]['ukuran'] = $key->s;
			$produk_data[$i]['jumlah'] = $key->q;
			$produk_data[$i]['harga'] = (isset($produk->h)?$produk->h: $biaya->m->h/$migrasi->count);

			$i++;
		}
		$data['produk'] = $produk_data;
		// simpan to `pesanan_produk`
		$this->faktur->add_orders($data['produk']);

		// `pembayaran`
		$pembayaran_data = array();

		//$p = 0;
		//foreach ($biaya->m as $bayar) {
		$byr_id = $this->faktur->_primary('pembayaran', 'id_pembayaran');
		if ((int) $byr_id !== 0) {
			$pembayaran_data[1] = array(
				'id_pembayaran' => $byr_id
			);
		}
		
		$pembayaran_data[1]['faktur_id'] = $id_faktur;
		$pembayaran_data[1]['tanggal_bayar'] = strtotime(mdate('%Y-%m-%d %H:%i:%s', $migrasi->tanggal_submit));
		$pembayaran_data[1]['jumlah'] = ($biaya->m->t === NULL? '0': $biaya->m->t);
		$pembayaran_data[1]['rekening'] = $biaya->b;
		$pembayaran_data[1]['tanggal_cek'] = strtotime(mdate('%Y-%m-%d %H:%i:%s', $migrasi->tanggal_cek_transfer));

			//$p++;
		//}
		$data['pembayaran'] = $pembayaran_data;
		// simpan to `pesanan_produk`
		$this->faktur->sub_pay($data['pembayaran']);

		// `pengiriman`
		$kurir_terakhir = 'cod';
		$tgl_kirim = 0;

		$krm_id = $this->faktur->_primary('pengiriman', 'id_pengiriman');
		if ((int) $krm_id !== 0) {
			$pengiriman_data[2] = array(
				'id_pengiriman' => $krm_id
			);
		}

		$pengiriman_data[2]['faktur_id'] = $id_faktur;
		$pengiriman_data[2]['tanggal_kirim'] = strtotime(mdate('%Y-%m-%d %H:%i:%s', $migrasi->tanggal_cek_kirim));
		$pengiriman_data[2]['kurir'] = (isset($detail->s->k)? $detail->s->k: 'Unknown');
		$pengiriman_data[2]['resi'] = (isset($detail->s->n)?$detail->s->n: 'Unknown');
		$pengiriman_data[2]['ongkir'] = (isset($biaya->m->of)? $biaya->m->of: '0' );

		$kurir_terakhir = (isset($detail->s->k)? $detail->s->k: 'Unknown');

		$data['pengiriman'] = $pengiriman_data;
		// simpan to `pesanan_produk`
		$this->faktur->sub_carries($data['pengiriman']);

		// 
		$data['diskon'] = (isset($biaya->m->d) ? $biaya->m->d: 0 );
		$data['ongkir'] = (isset($biaya->m->o) ? $biaya->m->o: 0 );
		$data['unik'] = (isset($biaya->m->u) ? $biaya->m->u: 0 );

		$this->faktur->upset_biaya('diskon', $id_faktur, $data['diskon']);
		$this->faktur->upset_biaya('ongkir', $id_faktur, $data['ongkir']);
		$this->faktur->upset_biaya('unik', $id_faktur, $data['unik']);

		$data_update = array(
			'status_paket' => '1',
			'status_kirim' => '2',
			'status_kiriman' => ( strtolower($kurir_terakhir) === 'cod'? '1': '2'),
			'tanggal_paket' => strtotime(mdate('%Y-%m-%d %H:%i:%s', $migrasi->tanggal_cek_transfer)),
			'tanggal_kirim' => strtotime(mdate('%Y-%m-%d %H:%i:%s', $migrasi->tanggal_cek_kirim)),
		);

		$data['status'] = $data_update;

		$this->faktur->edit_invoice($id_faktur, $data_update);

		$this->faktur->calc_pembayaran($id_faktur);
		$this->pesanan->delete($migrasi->slug);

		// diambil
		$q =  $this->db->where('status_kirim', 'terkirim')->get('pesanan');
	
		$response = array(
			'id' => $migrasi->id_pesanan,
			'yet' => $q->num_rows(),
			//'data' => $data
		);
	

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}
}