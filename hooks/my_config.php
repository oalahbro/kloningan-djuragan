<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * load_config()
 *
 * by mylastof@gmail.com 
 * --- checked 25/12/2014 ---
 */
function load_config()
{
	$CI =& get_instance();
	foreach($CI->setting->get_all()->result() as $site_config)
	{
		$CI->config->set_item($site_config->key,$site_config->value);
	}
}