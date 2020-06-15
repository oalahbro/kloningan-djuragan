<?php namespace App\Controllers;

class Juragan extends BaseController
{
    public function index()
    {
        if ( ! isAuthorized()) {
            return redirect()->to('/auth');
        }
        $limit = 20;
        $offset = (int) $this->request->getGet('page_juragan');
        if( $offset === 0 or $offset === 1) {
            $page = 0;
        }

        if($offset > 1) {
            $page = ($offset * $limit) - $limit; 
        }

        $data = [
            'jrgn' => $this->juragan->asObject()->orderBy('jrgn_diubah', 'desc')->findAll($limit, $page),
            'users' => $this->juragan->paginate($limit, 'juragan'),
            'pager' => $this->juragan->pager,
        ];

        echo view('adminview/header', ['title' => 'Juragan']);
        echo view('adminview/atur/juragan', $data);
        echo view('adminview/footer');
    }

    public function baru()
    {
        if ( ! isAuthorized()) {
            return redirect()->to('/auth');
        }
        
        if($this->request->getPost()) {
            $this->validation->setRuleGroup('addJuragan');
        }
        
        if (! $this->validation->withRequest($this->request)->run()) {
            return redirect()->to('/juragan');
        }
        else
        {
            $nama = $this->request->getPost('nama');

            $this->juragan->insert([
                'juragan' => url_title($nama, '-', TRUE), 
                'nama_jrgn' => $nama,
            ]);
            
            return redirect()->to('/juragan');
        }
    }

    public function sunting()
    {
        if ( ! isAuthorized()) {
            return redirect()->to('/auth');
        }

        if($this->request->getPost()) {
            $this->validation->setRuleGroup('editJuragan');
        }
        
        if (! $this->validation->withRequest($this->request)->run()) {
            return redirect()->to('/juragan');
        }
        else
        {
            $nama = $this->request->getPost('nama');
            $id = $this->request->getPost('id');

            $this->juragan->update($id, [
                'nama_jrgn' => $nama,
            ]);
            
            return redirect()->to('/juragan');
        }
    }

    public function get()
    {
        $nama_cache = 'juragan_admin';
        if ( ! $listJuragan = $this->cache->get($nama_cache)) {

            $listJuragan = $this->juragan->orderBy('nama_jrgn', 'asc')->findAll();

            // simpan cache 
            $this->cache->save($nama_cache, $listJuragan, 60*60*24);
        }

        return $this->response->setJSON($listJuragan);
    }
}
