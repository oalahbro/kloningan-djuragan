<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login_model
 *
 * @package     Juragan
 * @version 	6.0.0
 * @author      Toto Prayogo
 * @link        http://toto-id.blogspot.com
 * @since 		5.x.x
 */

class Login_model extends CI_Model {

	public function login($username, $password) {
		$query = $this->db->get_where('user', array('username' => $username));
		$datestring = '%Y-%m-%d %H:%i:%s';
		$time = now('Asia/Jakarta');

		if ($query->num_rows() === 1) {
			$row = $query->row();

			$hash = hash('sha256', $row->unik . hash('sha256', $password) );

			if($row->katasandi === $hash) {
				$sess_array = array(
					'id' => $row->id,
					'nama' => $row->nama,
					'level' => $row->level,
					'login' => TRUE
					//'last_login' => $row->last_login
					);
				$this->session->set_userdata('logged_in', $sess_array);

				// update table
				$unik = random_string('alnum', 4);
				$katasandi = hash('sha256', $unik . hash('sha256', $password) );
				$last_login = mdate($datestring, $time);

				$this->db->where('id', $row->id);
				$this->db->update('user', array('katasandi' => $katasandi, 'unik' => $unik, 'last_login' => $last_login ));

				return true;
			}
		}
	}
}