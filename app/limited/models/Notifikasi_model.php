<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{
	private $tabel;

	public function __construct() {
		parent::__construct();
		$this->tabel = 'notifikasi';
	}

	public function notif($kepada, $limit, $all_not, $offset) {
        $this->db->where('kepada', $kepada);

		if($all_not === 'tidak') {
			$this->db->where('dibaca', '0');
		}

		if($limit !== FALSE) {
			$this->db->limit($limit);
        }
        
        if($offset !== FALSE) {
            $this->db->offset($offset);
        }

        $this->db->order_by('tanggal desc');
		$q = $this->db->get('notifikasi');
        return $q;
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
			$this->add_notif(array_merge($id_notif, $data_notif));
			$a++;
        }
        return TRUE;
	}

	public function edit_notif($id_notifikasi, $data) {
        $this->db->where(array('id_notifikasi' => $id_notifikasi));
        $q = $this->db->update('notifikasi', $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
    }

	public function get_notif_detail($id_notifikasi, $tanggal) {
        $this->db->where(array('id_notifikasi' => $id_notifikasi, 'tanggal' => $tanggal));
        $q = $this->db->get('notifikasi');

        return $q;
    }

	public function add_notif($data) {
        $this->db->insert('notifikasi',$data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
	}
	
	public function del_notif($id_notifikasi) {
        $this->db->where(array('id_notifikasi' => $id_notifikasi));
        $q = $this->db->delete('notifikasi');

        if ($this->db->affected_rows() > -1) {
            return TRUE;
        }
    }
}