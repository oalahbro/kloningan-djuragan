<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Setting_model
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		5.x.x
 */

class Setting_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_all() {
		return $this->db->get('config_data');
	}

	public function update_config($data) {
		$success = true;
		foreach($data as $key=>$value) {
			if(!$this->save($key,$value)) {
				$success=false;
				break;  
			}
		}
		return $success;
	}

	public function save($key,$value) {
		$config_data=array(
			'key'=>$key,
			'value'=>$value
			);
		$this->db->where('key', $key);
		return $this->db->update('config_data',$config_data); 
	}
	
}