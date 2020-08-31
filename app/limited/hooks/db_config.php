<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function load_config() {
	$CI =& get_instance();
	foreach($CI->pengaturan->get_all()->result() as $site_config) {
		$CI->config->set_item($site_config->key,$site_config->value);
	}
}