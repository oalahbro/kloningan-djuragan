<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Upgrade extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}

	public function index() {
		echo anchor('upgrade/insert_pelanggan', 'Step 1');
	}


	public function insert_pelanggan() { 
		?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Upgrade</title>
		<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
	</head>
	<body>
		<div id="message">
			
		</div>
		<div id="fetch-snowfall-data">
			<?php echo form_button(array('content' => 'update', 'id' => 'execute')) ?>
		</div>

		<div id="response_container2">
			
		</div>

	
	</body>
		
		<script type="text/javascript">
			jQuery(document).ready(function($) {
	            // setTimeout(getProgress,1000);
	            $('#execute').click(function(){
	            	// $('#message').hide();
                /*
                    call the updateStatus() function every 3 second to update progress bar value.
                    */
                    updateStatus();
					alert('klik');
                    /*
                    */
                });

	            function updateStatus(){
	            	$.ajax({
	            		method: "GET",
	            		url: "<?php echo site_url('upgrade/progress') ?>",
	            		// data: { name: "John", location: "Boston" }
						success: function(data) {
							if (data.updated < data.total) {
								// 
								updateStatus();
								$( "#message" ).html( data.updated + ' / ' + data.total + '( ' + data.done +'% )' );
							}
							else {
								//
								alert('done');
								$( "#message" ).html( 'all data updated' );
							}
						}
	            	})


	            } 
	        });
		</script>
	</html>


	<?php 
	}

	public function progress() {
		
		$q = $this->db->get('pesanan');
		$terupdate = $this->db->get_where('pesanan', array(	'status_upgrade' =>'DONE'));
		$pending = $this->db->get_where('pesanan', array('status_upgrade' => NULL));

		$qr = $this->db->limit(40)->where('status_upgrade', NULL)->get('pesanan');

		$r = array();
		foreach ($qr->result() as $key) {
			$pelanggan_ = json_decode($key->pemesan);
            $pelanggan = array(
                'nama' => $pelanggan_->n
			);

			$data = array(
				'status_upgrade' => 'DONE'
			);

			$this->db->where('id_pesanan', $key->id_pesanan);
			$this->db->update('pesanan', $data);
	
			$this->db->insert('pelanggan', $pelanggan);
			$id_pelanggan = $this->db->insert_id();
			
			$alamate = array(
				'pelanggan_id' => $id_pelanggan,
				'hp1' => $pelanggan_->p[0],
				'hp2' => (!empty($pelanggan_->p[1])? $pelanggan_->p[1]: NULL),
				'alamat' => $pelanggan_->a
			);
			$this->db->insert('pelanggan_alamat', $alamate);
		}

		$up = $terupdate->num_rows();
		$to = $q->num_rows();
		$yet = $pending->num_rows();

		$response['total'] = $to;
		$response['updated'] = $up;
		$response['yet'] = $yet;
		$response['done'] = round(($up/$to)*100);

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public function upup()
	{
		// $q = $this->db->get('pesanan');
		// $terupdate = $this->db->get_where('pesanan', array(	'status_upgrade' =>'DONE'));
		// $pending = $this->db->get_where('pesanan', array('status_upgrade' => NULL));

		$qr = $this->db->limit(43)->where('status_upgrade', NULL)->order_by('id_pesanan DESC')->get('pesanan');

		$r = array();
		$i=0;
		foreach ($qr->result() as $key) {
			$pelanggan_ = json_decode($key->pemesan);
            $pelanggan = array(
				'id_pelanggan' => '',
                'nama' => $pelanggan_->n
			);

			/*
			$data = array(
				'status_upgrade' => 'DONE'
			);
			*/

			// $this->db->where('id_pesanan', $key->id_pesanan);
			// $this->db->update('pesanan', $data);
	
			// $this->db->insert('pelanggan', $pelanggan);
			// $id_pelanggan = $this->db->insert_id();
			
			$alamate = array(
				'pelanggan_id' => '',//$id_pelanggan,
				'hp1' => $pelanggan_->p[0],
				'hp2' => (!empty($pelanggan_->p[1])? $pelanggan_->p[1]: NULL),
				'alamat' => $pelanggan_->a
			);



			// faktur
			$faktur = array(
				'id_faktur' => $key->id_pesanan,
				'seri_faktur' => '',
				'tanggal_dibuat' => $key->tanggal_submit,
				'juragan_id' => $key->juragan,
				'pelanggan_id' => '',
				'keterangan_id' => ''
			);

			// pembelian
			$beli = json_decode($key->detail);
			$biaya = json_decode($key->biaya);
			$pembelian = array();
			$bought = 0;
			foreach ($beli->p as $buy) {
				$pembelian[$bought] = array(
					'id_pembelian' => '',
					'faktur_id' => $key->id_pesanan,
					'kode_produk' => $buy->c,
					'ukuran' => $buy->s,
					'jumlah' => $buy->q,
					'harga' => (isset($buy->h)? $buy->h: ($biaya->m->h/$key->count)  )
				);
				$bought++;
			}

			// pembayaran
			$pembayaran = array();
			$paid = 0;
			//foreach ($biaya->m as $paid) {
				$pembayaran[] = array(
					'id_keterangan' => '',
					'faktur_id' => $key->id_pesanan,
					'kunci' => 'transfer',
					'isi' => $biaya->m->t,
				);
				if(isset($biaya->m->o)) {
					$pembayaran[] = array(
						'id_keterangan' => '',
						'faktur_id' => $key->id_pesanan,
						'kunci' => 'ongkir',
						'isi' => $biaya->m->o,
					);
				}
				if(isset($biaya->m->d)) {
					$pembayaran[] = array(
						'id_keterangan' => '',
						'faktur_id' => $key->id_pesanan,
						'kunci' => 'diskon',
						'isi' => $biaya->m->d,
					);
				}
				
				/*
				$pembayaran[] = array(
					'id_keterangan' => '',
					'faktur_id' => $key->id_pesanan,
					'kunci' => 'status_transfer',
					'isi' => $biaya->s,
				);
				*/

				$pembayaran[] = array(
					'id_keterangan' => '',
					'faktur_id' => $key->id_pesanan,
					'kunci' => 'rekening',
					'isi' => $biaya->b,
				);

				if($key->tanggal_cek_transfer !== NULL) {
					$pembayaran[] = array(
						'id_keterangan' => '',
						'faktur_id' => $key->id_pesanan,
						'kunci' => 'tanggal_cek_transfer',
						'isi' => $key->tanggal_cek_transfer,
					);
				}
				//$paid++;
			//}

			// pengiriman
			
			$pengiriman = array();
			//foreach ($beli->s as $sent) {
				if(isset($beli->s)) {
					$pengiriman[] = array(
						'id_keterangan' => '',
						'faktur_id' => $key->id_pesanan,
						'kunci' => 'kurir',
						'isi' => $beli->s->k,
					);
					$pengiriman[] = array(
						'id_keterangan' => '',
						'faktur_id' => $key->id_pesanan,
						'kunci' => 'tanggal_kirim',
						'isi' => $beli->s->d,
					);
					$pengiriman[] = array(
						'id_keterangan' => '',
						'faktur_id' => $key->id_pesanan,
						'kunci' => 'resi',
						'isi' => $beli->s->n,
					);
				}
			//}

			$r[$i]['faktur'] = $faktur;
			$r[$i]['pelanggan'] = $pelanggan;
			$r[$i]['alamat'] = $alamate;
			$r[$i]['pembelian'] = $pembelian;
			$r[$i]['pembayaran'] = $pembayaran;
			$r[$i]['pengiriman'] = $pengiriman;
			// $this->db->insert('pelanggan_alamat', $alamate);
			$i++;
		}

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($r, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public function get_user()
	{
		$q = $this->pengguna->_semua($aktif = FALSE, $blokir = FALSE);

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($q->result(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

}
// 10029590307b552f1b