<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upgrade extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}

	public function index() {
		echo anchor('upgrade/status_kiriman', 'Step 1');
	}

	public function status_kiriman() { ?>
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
		// diambil
		$q = $this->db->where(array('status_kirim' => '2', 'status_kiriman' => NULL))->limit(30)->get('faktur');

		foreach ($q->result() as $key) {
            $this->db->where('id_faktur', $key->id_faktur);
            $this->db->update('faktur', array('status_kiriman' => '1'));
		}

		$response = array(
			'updated' => $this->db->where(array('status_kiriman' => '1'))->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('status_kirim' => '2', 'status_kiriman' => NULL))->get('faktur')->num_rows(),
		);

		$this->output
	        ->set_status_header(200)
	        ->set_content_type('application/json', 'utf-8')
	        ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	        ->_display();
	    exit;
	}

	public function status_kiriman_2() { ?>
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
									$( "#message" ).html( 'all data updated' );
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
		// diambil
		$q = $this->db->where(array('status_kirim' => '3', 'status_kiriman' => NULL))->limit(30)->get('faktur');

		foreach ($q->result() as $key) {
            $this->db->where('id_faktur', $key->id_faktur);
            $this->db->update('faktur', array('status_kiriman' => '2', 'status_kirim' => '2'));
		}

		$response = array(
			'updated' => $this->db->where(array('status_kiriman' => '2'))->get('faktur')->num_rows(),
			'yet' => $this->db->where(array('status_kirim' => '3', 'status_kiriman' => NULL))->get('faktur')->num_rows(),
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