<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{
	private $tabel;

	public function __construct() {
		parent::__construct();
		$this->tabel = 'notifikasi';
	}

	public function set($pengguna_id, $type, $juragan_id, $seri_faktur, $adm_or_cs = 'cs') {

        switch ($adm_or_cs) {
            case 'admin':
                # code...
                $users = $this->pengguna->get_admin();
                break;
            
            default:
                # code...
                $users = $this->pengguna->_cs_juragan($juragan_id);
                break;
        }
		
		$a = 0;
		foreach ($users->result() as $user) {
			$id_notif = array();
			$notif_id = $this->faktur->_primary('notifikasi', 'id_notifikasi', $users->num_rows(), $a);
			if ((int) $notif_id !== 0) {
				$id_notif = array(
					'id_notifikasi' => $notif_id
				);
			}

			$data_notif = array(
				'tanggal' => now(),
				'dari' => $pengguna_id,
				'kepada' => $user->id,
				'type' => $type,
				'juragan' => $juragan_id,
				'url' => $seri_faktur
			);
			$this->faktur->add_notif(array_merge($id_notif, $data_notif));
			$a++;
        }
        return TRUE;
	}
}