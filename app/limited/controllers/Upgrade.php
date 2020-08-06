<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Upgrade extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}

	public function index() {
		echo anchor('upgrade/rename_config_db', 'Step 1');
	}

	public function rename_config_db() {
		if ( ! $this->db->table_exists('pengaturan')) {
			$fields = array(
				'kunci' => array(
					'type' => 'VARCHAR',
					'constraint' => 100,
					'unique' => TRUE,
					),
				'gembok' => array(
					'type' => 'TEXT'
					)
				);
			$this->dbforge->add_field($fields);
			// $this->dbforge->add_key('id', TRUE);
			$c = $this->dbforge->create_table('pengaturan');

			if($c) {
				$q = $this->db->get('config_data');

				foreach ($q->result() as $key) {
					$this->db->insert('pengaturan', array('kunci' => $key->key, 'gembok' => $key->value));
				}

				$this->insert_size();
				$this->insert_kurir();
			}
		}
		//else {
			echo anchor('upgrade/create_table_juragan', 'Step 2');
		//}
	}

	function insert_size() {
		$kunci = 'list_size';
		$gembok = array('XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'Custom');
		$this->db->insert('pengaturan', array('kunci' => $kunci, 'gembok' => json_encode($gembok)));
	}

	function insert_kurir() {
		$kunci_kurir = 'list_kurir';
		$gembok_kurir = array();
		$kr = $this->db->get('kurir');

		foreach ($kr->result() as $kurir) {
			$gembok_kurir[] = $kurir->nama;
		}

		$this->db->insert('pengaturan', array('kunci' => $kunci_kurir, 'gembok' => json_encode($gembok_kurir)));
	}

	public function create_table_juragan() {
		// membuat tabel `juragan`
		if ( ! $this->db->table_exists('juragan')) {
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
					),
				'nama' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
					// 'unique' => TRUE,
					),
				'membership' => array(
					'type' => 'ENUM("ya","tidak")',
					// 'constraint' => '100',
					'default' => "tidak"
					),
				'short' => array(
					'type' =>'VARCHAR',
					'constraint' => '5',
					'unique' => TRUE,
					),
				'slug' => array(
					'type' =>'VARCHAR',
					'constraint' => '100',
					'unique' => TRUE,
					),
				);

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('juragan');

			$this->db->where('level', 'user');
			$q = $this->db->get('user');

			foreach ($q->result() as $user) {
				$data_jrg = array(
					'id' => $user->id,
					'nama' => $user->nama,
					'membership' => ($user->membership === '0' ? 'tidak' : 'ya'),
					'short' => strtolower( $user->short ),
					'slug' => url_title($user->username, '-', TRUE)
					);

				$this->db->insert('juragan', $data_jrg);
			}

		}

		echo anchor('upgrade/create_table_pengguna', 'Step 3');
	}

	public function create_table_pengguna()	{
		if ( ! $this->db->table_exists('pengguna')) {
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
					),
				'nama' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
					// 'unique' => TRUE,
					),
				'username' => array(
					'type' =>'VARCHAR',
					'constraint' => '100',
					'unique' => TRUE,
					),
				'sandi' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					),
				'email' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					),
				'level' => array(
					'type' => 'ENUM("superadmin","admin","cs","reseller")',
					'default' => "cs"
					),
				'aktif' => array(
					'type' => 'ENUM("ya","tidak")',
					'default' => "tidak"
					),
				'blokir' => array(
					'type' => 'ENUM("ya","tidak")',
					'default' => "tidak"
					),
				'valid' => array(
					'type' => 'ENUM("ya","tidak")',
					'default' => "tidak"
					),
				'login_terakhir' => array(
					'type' => 'VARCHAR',
					'constraint' => '10',
					),
				'juragan' => array(
					'type' => 'TEXT',
					'default' => NULL,
					),
				
				);

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('pengguna');
		}

		echo anchor('upgrade/create_table_pesanan', 'Step 4');
	}

	public function create_table_pesanan() {
		if ( ! $this->db->table_exists('pesanan')) {
			$fields = array(
				'id_pesanan' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
					),
				'juragan' => array(
					'type' => 'INT',
					'constraint' => 11,
					),
				'oleh' => array(
					'type' => 'INT',
					'constraint' => 11,
					'default' => NULL
					),
				'tanggal_submit' => array(
					'type' =>'VARCHAR',
					'constraint' => 10,
					),
				'tanggal_cek_transfer' => array(
					'type' =>'VARCHAR',
					'constraint' => 10,
					'default' => NULL
					),
				'tanggal_cek_kirim' => array(
					'type' =>'VARCHAR',
					'constraint' => 10,
					'default' => NULL
					),
				'pemesan' => array(
					'type' => 'TEXT',
					),
				'biaya' => array(
					'type' => 'TEXT',
					),
				'status_transfer' => array(
					'type' => 'ENUM("ada","tidak")',
					'default' => "tidak"
					),
				'status_kirim' => array(
					'type' => 'ENUM("terkirim","pending")',
					'default' => "pending"
					),
				'detail' => array(
					'type' => 'TEXT',
					'default' => NULL,
					),
				'count' => array(
					'type' => 'INT',
					'constraint' => 5,
					'default' => 0,
					'null' => FALSE
					),
				'slug' => array(
					'type' => 'VARCHAR',
					'constraint' => 18,
					'unique' => TRUE
					)
				
				);

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id_pesanan', TRUE);
			$this->dbforge->create_table('pesanan');

			$update = array(
				'migrate' => array('type' => 'VARCHAR', 'constraint' => 40, 'default' => 'belum')
				);

			$this->dbforge->add_column('order', $update);

		}
		echo anchor('upgrade/insert_table_pesanan', 'Step 5');
	}

	public function insert_table_pesanan() { 
		?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Upgrade</title>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
	            // setTimeout(getProgress,1000);
	            $('#execute').click(function(){
	            	// $('#message').hide();
                /*
                    call the updateStatus() function every 3 second to update progress bar value.
                    */
                    updateStatus();
                    /*
                    */
                });



	            function updateStatus(){
	            	$.ajax({
	            		method: "GET",
	            		url: "<?php echo site_url('upgrade/progress') ?>",
	            		// data: { name: "John", location: "Boston" }
	            	})
	            	.success(function( data ) {
	            		//
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
	            	});


	            } 
	        });
		</script>
	</html>


	<?php 
	}

	public function progress() {

		$qs = $this->db->where('migrate', 'belum')->where('barang', 'Terkirim')->get('order');
		$qa = $this->db->get('order');
		$q_u = $this->db->where('migrate !=', 'belum')->where('barang', 'Terkirim')->get('order');
		//$this->session->set_userdata('total', $qs->num_rows());
		//$get_t = $this->input->get('total');
		//$pg = $this->input->get('page');
	
		$q = $this->db->limit(55)->where('migrate', 'belum')->get('order');

		foreach ($q->result() as $p) {
			$pemesan = array(
				'n' => $p->nama,
				'p' => array($p->hp),
				'a' => str_replace('<br />', '', $p->alamat)
				);

			$biaya['m']['h'] = (int) $p->harga;

			$o = (int) $p->ongkir;
			if($o > 1000) {
				$biaya['m']['o'] = (int) $p->ongkir;
			}
			$biaya['m']['t'] = (int) $p->transfer;

			if($p->ongkir_fix !== NULL) {
				$biaya['m']['of'] = (int) $p->ongkir_fix;
			}

			$biaya['b'] = $p->bank;
			$biaya['s'] = strtolower($p->status);

			$ps = explode('#', $p->pesanan);
			$count = 0;
			foreach ($ps as $key) {
				$k = explode(',', $key);

				$keterangan['p'][] = array(
					'c' => $k[0],
					's' => $k[1],
					'q' => (int) $k[2]
					);

				$count = $count + (int) $k[2];
			}


			if( $p->keterangan !== '') {
				$keterangan['n'] = str_replace('<br />', '', $p->keterangan);
			}

			if($p->resi !== NULL && $p->kurir !== NULL) {
				$keterangan['s'] = array(
					'k' => $p->kurir,
					'n' => $p->resi,
					'd' => ($p->cek_kirim !== NULL ? human_to_unix($p->cek_kirim) : NULL)
					);
			}

			$m_id = (int) $p->member_id;
			if( $m_id > 0) {
				$keterangan['m'] = $m_id;
			}
			
			$gmb = explode(',', $p->customgambar);

			// if( ! empty($gmb)) {
			if($p->customgambar !== NULL) {

				$gmbbb = array();
				for ($i=0; $i < count($gmb) ; $i++) { 
					if( $gmb[$i] !== ""){
						$keterangan['i'][] = $gmb[$i];
					}
				}
				//unset($keterangan['i']);
			}

			$data = array(
				'id_pesanan' => (int) $p->id,
				'juragan' => (int) $p->user_id,
				'tanggal_submit' => human_to_unix($p->tanggal_order),
				'tanggal_cek_kirim' => ($p->cek_kirim !== NULL ? human_to_unix($p->cek_kirim) : NULL),
				'tanggal_cek_transfer' => ($p->cek_transfer !== NULL ? human_to_unix($p->cek_transfer) : NULL),
				'pemesan' => json_encode($pemesan),
				// 'pesanan' => json_encode($pesanan),
				'biaya' =>  json_encode($biaya),
				'detail' => json_encode($keterangan),
				'status_transfer' => ($p->status_transfer === 'Belum' ? 'tidak' : 'ada'),
				'status_kirim' => ($p->barang === 'Pending' ? 'pending' : 'terkirim'),
				'count' => $count,
				'slug' => (mdate('%Y', time()) + (int) $p->user_id) . uniqid()
				);

			$this->db->insert('pesanan', $data);

			$this->db->where('id', $p->id)
					->update('order', array('migrate' => 'ya'));

			unset($pemesan);
			unset($pesanan);
			unset($biaya);
			unset($keterangan);

		    //$this->session->set_userdata('progress', $count++);
		    // 101015908395b0614d
		    // sleep(1);
		}

		$up = $q_u->num_rows();
		$to = $qa->num_rows();
		$yet = $qs->num_rows();

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

}
// 10029590307b552f1b