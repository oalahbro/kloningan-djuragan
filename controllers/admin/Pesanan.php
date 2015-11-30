<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * admin/Pesanan.php
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		6.0.0
 */

class Pesanan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        if( ! is_login()) {
        	redirect('login');
        }
        else {
			if(is_user('user')) {
				redirect('user');
			}
		}
    }

	public function semua($juragan = '') {
		$juragan = $this->uri->segment(4, 'alljuragan');

		$this->data = array(
			'title' => '',
			'menu_active' => 'pesanan',
			'sub_active' => 'semua',
			'juragan' => $juragan,
			'halaman' => 'semua'
		);

		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/pesanan/pesanan_view', $this->data);
		$this->load->view('admin/footer', $this->data);
	}

	public function load($value='')
	{
		$halaman = $this->uri->segment(4);
		$juragan = $this->uri->segment(5);
		$submit  = input_get('submit');
		$cari 	 = input_get('cari');
		$page 	 = input_get('per_page');
		$offset  = '20';

		$data_pesanan = $this->pesanan->get_all($halaman, $page, $offset, $cari, $juragan);

		$numrow = $this->pesanan->get_all($halaman, NULL, NULL, $cari, $juragan)->num_rows();
		
		$base = site_url('administrator/lihat_data/'.$halaman.'/'.$juragan.'?cari='.$cari);
		
		$config['page_query_string']= TRUE;
		$config['base_url'] 		= $base;
		$config['total_rows'] 		= $numrow;
		$config['per_page']			= $offset;
		$config['num_links'] 		= 5;
		
		$this->pagination->initialize($config);

		$this->data = array(
			'halaman' => get_halaman($halaman),
			'juragan' => get_juragan($juragan),
			'table' => $this->table->generate(),
			'pagination' => $this->pagination->create_links(),
			'pesanan' => $data_pesanan
		);

		// if($submit === 'yes')
// 		{
			$this->load->view('admin/pesanan/pesanan_loader_view', $this->data);
		// }
		// else
		// {
			// show_404();
		// }
	}

}