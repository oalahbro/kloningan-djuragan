<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upgrade extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}

	public function index() {
		echo anchor('upgrade/insert_faktur', 'Step 1');
	}


	public function insert_faktur() { 
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
								$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
							}
							else {
								//
								alert('all data updated');
								$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/hapus_status_paket_belum_proses", "next"); ?>' );
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

		$q = $this->db->where(array('key' => 's_paket', 'val' => 'diproses'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
            $this->db->where('id_faktur', $key->faktur_id);
            $this->db->update('faktur', array('status_paket' => '1', 'status_edit' => 'ya'));
            
            $this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_paket'));
		}

		$response = array(
			'updated' => $this->db->where(array('status_edit' => 'ya'))->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('val' => 'diproses'))->get('keterangan')->num_rows(),
		);

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public function hapus_status_paket_belum_proses()
	{
		$this->db->delete('keterangan', array('key' => 's_paket', 'val' => 'belum_diproses'));

		echo anchor('upgrade/hapus_status_paket_batal', 'next hapus batalan');
	}

	public function hapus_status_paket_batal()
	{
		$q = $this->db->where(array('key' => 's_paket', 'val' => 'proses_batal'))->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('status_paket' => '2', 'status_edit' => 'ya'));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_paket'));
		}

		echo anchor('upgrade/insert_faktur_status_kirim', 'next status kirim');
	}

	public function insert_faktur_status_kirim() { 
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
	            		url: "<?php echo site_url('upgrade/progress_dua') ?>",
	            		// data: { name: "John", location: "Boston" }
						success: function(data) {
							if (data.yet !== 0) {
								// 
								updateStatus();
								$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
							}
							else {
								//
								alert('all data updated');
								$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/insert_faktur_status_kirim_dua", "next"); ?>' );
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

	public function progress_dua() {

		$q = $this->db->where(array('key' => 's_kirim', 'val' => 'b_dikirim'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$kir = $this->db->order_by('tanggal_kirim DESC')->where('faktur_id', $key->faktur_id)->get('pengiriman')->row();

            $this->db->where('id_faktur', $key->faktur_id);
            $this->db->update('faktur', array('status_kirim' => '3', 'status_edit' => 'kir_ya', 'tanggal_kirim' => $kir->tanggal_kirim));
            
            $this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_kirim'));
		}

		$response = array(
			'updated' => $this->db->where(array('status_edit' => 'kir_ya'))->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('val' => 'b_dikirim'))->get('keterangan')->num_rows(),
		);

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public function insert_faktur_status_kirim_dua() { ?>
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
	            		url: "<?php echo site_url('upgrade/progress_dua_dua') ?>",
	            		// data: { name: "John", location: "Boston" }
						success: function(data) {
							if (data.yet !== 0) {
								// 
								updateStatus();
								$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
							}
							else {
								//
								alert('all data updated');
								$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/hapus_status_kirim_belum", "next"); ?>' );
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

	public function progress_dua_dua() {

		$q = $this->db->where(array('key' => 's_kirim', 'val' => 'c_diambil'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$kir = $this->db->order_by('tanggal_kirim DESC')->where('faktur_id', $key->faktur_id)->get('pengiriman')->row();

            $this->db->where('id_faktur', $key->faktur_id);
            $this->db->update('faktur', array('status_kirim' => '2', 'status_edit' => 'amb_ya', 'tanggal_kirim' => $kir->tanggal_kirim));
            
            $this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_kirim'));
		}

		$response = array(
			'updated' => $this->db->where(array('status_edit' => 'amb_ya'))->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('val' => 'c_diambil'))->get('keterangan')->num_rows(),
		);

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public function hapus_status_kirim_belum()
	{
		$q = $this->db->where(array('key' => 's_kirim', 'val' => 'belum_kirim'))->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('status_kirim' => '0', 'status_edit' => 'kir_no'));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_kirim'));
		}

		echo anchor('upgrade/insert_faktur_status_transfer', 'next status transfer');
	}

	public function insert_faktur_status_transfer() { ?>
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
							url: "<?php echo site_url('upgrade/progress_tiga') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/hapus_status_transfer_lebih", "next"); ?>' );
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

	public function progress_tiga() {

		$q = $this->db->where(array('key' => 's_transfer', 'val' => 'd_lunas'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$kir = $this->db->order_by('tanggal_cek DESC')->where('faktur_id', $key->faktur_id)->get('pembayaran')->row();

			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('status_transfer' => '3', 'status_edit' => 'lun_ya', 'tanggal_transfer' => $kir->tanggal_cek));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_transfer'));
		}

		$response = array(
			'updated' => $this->db->where(array('status_edit' => 'lun_ya'))->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('val' => 'd_lunas'))->get('keterangan')->num_rows(),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function hapus_status_transfer_lebih()
	{
		$q = $this->db->where(array('key' => 's_transfer', 'val' => 'e_lebih'))->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('status_transfer' => '4', 'status_edit' => 'bay_leb'));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_transfer'));
		}

		echo anchor('upgrade/hapus_status_transfer_sebagian', 'next status transfer');
	}

	public function hapus_status_transfer_sebagian()
	{
		$q = $this->db->where(array('key' => 's_transfer', 'val' => 'c_sebagian'))->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('status_transfer' => '2', 'status_edit' => 'bay_seb'));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_transfer'));
		}

		echo anchor('upgrade/hapus_status_transfer_menunggu', 'next status transfer');
	}

	public function hapus_status_transfer_menunggu()
	{
		$q = $this->db->where(array('key' => 's_transfer', 'val' => 'b_menunggu'))->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('status_transfer' => '1', 'status_edit' => 'bay_seb'));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_transfer'));
		}

		echo anchor('upgrade/hapus_status_belum_transfer', 'next status transfer');
	}

	public function hapus_status_belum_transfer()
	{
		$q = $this->db->where(array('key' => 's_transfer', 'val' => 'belum_transfer'))->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('status_transfer' => '0', 'status_edit' => 'bay_seb'));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 's_transfer'));
		}

		echo anchor('upgrade/insert_unik', 'next status transfer');
	}

	public function insert_unik() { ?>
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
							url: "<?php echo site_url('upgrade/progress_unik') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/insert_diskon", "next"); ?>' );
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

	public function progress_unik() {

		$q = $this->db->where(array('key' => 'unik'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->insert('biaya_unik', array('faktur_id' => $key->faktur_id, 'nominal' => $key->val));
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 'unik'));
		}

		$response = array(
			'updated' => $this->db->get('biaya_unik')->num_rows(),
			'yet' => $this->db->where(array('key' => 'unik'))->get('keterangan')->num_rows(),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function insert_diskon() { ?>
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
							url: "<?php echo site_url('upgrade/progress_diskon') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/insert_ongkir", "next"); ?>' );
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

	public function progress_diskon() {

		$q = $this->db->where(array('key' => 'diskon'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->insert('biaya_diskon', array('faktur_id' => $key->faktur_id, 'nominal' => $key->val));
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 'diskon'));
		}

		$response = array(
			'updated' => $this->db->get('biaya_diskon')->num_rows(),
			'yet' => $this->db->where(array('key' => 'diskon'))->get('keterangan')->num_rows(),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function insert_ongkir() { ?>
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
							url: "<?php echo site_url('upgrade/progress_ongkir') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/insert_hp2", "next"); ?>' );
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

	public function progress_ongkir() {

		$q = $this->db->where(array('key' => 'ongkir'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->insert('biaya_ongkir', array('faktur_id' => $key->faktur_id, 'nominal' => $key->val));
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 'ongkir'));
		}

		$response = array(
			'updated' => $this->db->get('biaya_ongkir')->num_rows(),
			'yet' => $this->db->where(array('key' => 'ongkir'))->get('keterangan')->num_rows(),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function insert_hp2() { ?>
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
							url: "<?php echo site_url('upgrade/progress_hp2') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/insert_gambar", "next"); ?>' );
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

	public function progress_hp2() {

		$q = $this->db->where(array('key' => 'hp'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('hp2' => $key->val));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 'hp'));
		}

		$response = array(
			'updated' => $this->db->where('hp2 !=', NULL)->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('key' => 'hp'))->get('keterangan')->num_rows(),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function insert_gambar() { ?>
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
							url: "<?php echo site_url('upgrade/progress_gambar') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/insert_keterangan", "next"); ?>' );
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

	public function progress_gambar() {

		$q = $this->db->where(array('key' => 'gambar'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('gambar' => $key->val));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 'gambar'));
		}

		$response = array(
			'updated' => $this->db->where('hp2 !=', NULL)->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('key' => 'gambar'))->get('keterangan')->num_rows(),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function insert_keterangan() { ?>
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
							url: "<?php echo site_url('upgrade/progress_keterangan') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/insert_tipe", "next"); ?>' );
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

	public function progress_keterangan() {

		$q = $this->db->where(array('key' => 'keterangan'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('keterangan' => $key->val));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 'keterangan'));
		}

		$response = array(
			'updated' => $this->db->where('keterangan !=', NULL)->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('key' => 'keterangan'))->get('keterangan')->num_rows(),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function insert_tipe() { ?>
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
							url: "<?php echo site_url('upgrade/progress_tipe') ?>",
							// data: { name: "John", location: "Boston" }
							success: function(data) {
								if (data.yet !== 0) {
									// 
									updateStatus();
									$( "#message" ).html( data.updated + ' diupdate dan menunggu ' + data.yet +' data lagi' );
								}
								else {
									//
									alert('all data updated');
									$( "#message" ).html( 'all data updated <?php echo anchor("upgrade/insert_tipe", "next"); ?>' );
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

	public function progress_tipe() {

		$q = $this->db->where(array('key' => 'tipe'))->limit(30)->get('keterangan');

		foreach ($q->result() as $key) {
			$this->db->where('id_faktur', $key->faktur_id);
			$this->db->update('faktur', array('tipe' => strtolower($key->val)));
			
			$this->db->delete('keterangan', array('faktur_id' => $key->faktur_id, 'key' => 'tipe'));
		}

		$response = array(
			'updated' => $this->db->where('tipe !=', NULL)->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('key' => 'tipe'))->get('keterangan')->num_rows(),
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}
}
// 10029590307b552f1b