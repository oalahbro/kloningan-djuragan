<?php namespace App\Controllers;

class Invoices extends BaseController
{
	public function index($juragan = 'semua')
	{
		if (! isAuthorized())
		{
			return redirect()->to('/auth');
		}

		/*
		$title = 'Semua Juragan';
		if ($juragan !== 'semua') {
			$debe = $this->juragan->where('juragan', $juragan)->findAll();
			if (count($debe) < 1) {
				return redirect()->to('/faktur?juragan_notfound=' . $juragan);
			}

			$title = $debe[0]['nama_jrgn'];
		}
		*/
		
		$data = [
			'title' => 'Semua ',
			// 'pesanan' => $this->faktur->get($juragan)->getResult(),
			// 'users' => $this->faktur->paginate(1),
			// 'pager' => $this->faktur->pager
		];
		echo view(base_user() . '/invoice/lihat', $data);
	}

	public function baru()
	{
		if (! isAuthorized())
		{
			return redirect()->to('/auth');
		}

		$data = [
			'title' => 'Tulis Baru',
			// 'pesanan' => $this->faktur->get($juragan)->getResult(),
			// 'users' => $this->faktur->paginate(1),
			// 'pager' => $this->faktur->pager
		];
		echo view(base_user() . '/invoice/baru', $data);
	}
}
