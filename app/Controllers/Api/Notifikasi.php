<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class Notifikasi extends \CodeIgniter\Controller
{
    use ResponseTrait;

    public function get()
    {
        $notifikasi = new \App\Models\NotifikasiModel();
        helper('fungsi');

        $user_id = $this->request->getGet('id');
        $x = $notifikasi->ambil($user_id)->get()->getResult();

        $res = [];
        foreach ($x as $notif) {
            $notifikasi = replacer(config('JuraganConfig')->notifikasi[$notif->type], ['invoice' => $notif->seri, 'nama' => $notif->name]);
            $tanggal = Time::createFromTimestamp($notif->created_at);

            $res[] = [
                'id' => (int) $notif->id_notifikasi,
                'notif' => $notifikasi,
                'created_at' => $tanggal->toLocalizedString('EEEE, d MMMM yyyy (HH:mm:ss)'),
                'invoice' => $notif->seri,
                'juragan' => $notif->juragan
            ];
        }

        return $this->respond($res);
    }

    // ------------------------------------------------------------------------

    public function count()
    {
        $notifikasi = new \App\Models\NotifikasiModel();

        $user_id = $this->request->getGet('id');
        $x = $notifikasi->ambil($user_id)->countAllResults();

        $res = [
            'belum_baca' => $x
        ];

        return $this->respond($res);
    }

}
