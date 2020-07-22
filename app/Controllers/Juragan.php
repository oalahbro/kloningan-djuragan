<?php namespace App\Controllers;

class Juragan extends BaseController
{
    

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

            // simpan cache selama 12 jam
            $this->cache->save($nama_cache, $listJuragan, 60*60*12);
        }

        return $this->response->setJSON($listJuragan);
    }
}
