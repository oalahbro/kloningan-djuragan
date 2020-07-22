<?php namespace App\Controllers;

class Settings extends BaseController
{
	public function index()
	{
		if (! isAuthorized())
		{
			return redirect()->to('/auth');
		}

		$data = [
            'title'     => 'Pengaturan Situs',
            'banks'     => $this->bank->orderBy('atas_nama ASC, nama_bank ASC')->findAll()
            //'jrgn'    => $this->juragan->asObject()->orderBy('jrgn_diubah', 'desc')->findAll($limit, $page),
            //'users'   => $this->juragan->paginate($limit, 'juragan'),
            //'pager'   => $this->juragan->pager,
        ];

        echo view(base_user() . '/pengaturan/situs', $data);
	}

    public function save_bank()
    {
        if (! isAuthorized()) 
        {
            return redirect()->to('/auth');
        }

        if($this->request->getPost()) {
            $this->validation->setRuleGroup('addBank');
        }


        if ( ! $this->validation->withRequest($this->request)->run()) {
            $errors = $this->validation->getErrors();

            // var_dump($errors);
        }
        else {
            $this->bank->insert([
                'nama_bank' => $this->request->getPost('nama_bank'),
                'rekening' => $this->request->getPost('nomor_rekening'),
                'atas_nama' => $this->request->getPost('atas_nama')
            ]);

            return redirect()->to('/settings')->with('notif', '<div class="alert alert-info"><strong class="d-block">Yay!</strong>Penambahan </div>');
        }


        // var_dump($this->request->getPost());

        return redirect()->to('/settings');

    }

	public function juragan()
    {
        if ( ! isAuthorized()) {
            return redirect()->to('/auth');
        }
        /*
        $limit = 20;
        $offset = (int) $this->request->getGet('page_juragan');
        if( $offset === 0 or $offset === 1) {
            $page = 0;
        }

        if($offset > 1) {
            $page = ($offset * $limit) - $limit; 
        }
        */

        $data = [
            'title'     => 'Pengaturan Juragan'
            //'jrgn'    => $this->juragan->asObject()->orderBy('jrgn_diubah', 'desc')->findAll($limit, $page),
            //'users'   => $this->juragan->paginate($limit, 'juragan'),
            //'pager'   => $this->juragan->pager,
        ];

        echo view(base_user() . '/pengaturan/juragan', $data);
    }

}
