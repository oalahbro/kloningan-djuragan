<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Menjalankan config dari database
 *
 * @return      string
 */
function load_config() {
	$CI =& get_instance();
	foreach($CI->pengaturan->ambil_semua()->result() as $pengaturan) {
		$CI->config->set_item($pengaturan->kunci, $pengaturan->gembok);
	}
}
