<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Chart extends BaseController
{
    //
    public function index()
    {
        if (!$this->isLogged()) {
            return redirect()->to('/auth');
        } else {
            if ($this->isAdmin()) {
                return redirect()->to('/auth');
            }
        }

        $data = [
            'title' => 'Chart'
        ];
        return view('user/chart', $data);
    }

    // ------------------------------------------------------------------------

}
