<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Controllers\Juragan as Jrgn;

use App\Models\BankModel;
use App\Models\InvoiceModel;
use App\Models\JuraganModel;
use App\Models\PembayaranModel;
use App\Models\PengirimanModel;
use App\Models\RelasiModel;
use App\Models\UserModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['date', 'form', 'fungsi', 'number', 'text', 'url'];

	public $cache;
	public $session;
	public $validation;

	public $bank;
	public $invoice;
	public $juragan;
	public $pembayaran;
	public $relasi;
	public $user;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------

		$this->cache = \Config\Services::cache();
		$this->session = \Config\Services::session();
		$this->validation = \Config\Services::validation();

		$this->bank 	= new BankModel();
		$this->invoice 	= new InvoiceModel();
		$this->juragan 	= new JuraganModel();
		$this->pembayaran 	= new PembayaranModel();
		$this->pengiriman 	= new PengirimanModel();
		$this->relasi 	= new RelasiModel();
		$this->user 	= new UserModel();

		// migration here
		// $migrate = \Config\Services::migrations();
		// $migrate->latest();
	}

	// ------------------------------------------------------------------------

	public function isLogged()
	{
		$r = FALSE;
		if ($this->session->has('logged') && $this->session->get('logged')) {
			$r = TRUE;
		}

		return $r;
	}

	// ------------------------------------------------------------------------

	public function isAdmin($superadmin = FALSE)
	{
		$return = FALSE;
		if ($this->isLogged()) {
			if ($superadmin === TRUE) {
				// jika $superadmin === TRUE, maka yang diambil hanya superadmin
				if ($this->session->get('level') === 'superadmin') {
					$return = TRUE;
				}
			} else {
				// levelnya admin dan superadmin
				if ($this->session->get('level') === 'admin' or $this->session->get('level') === 'superadmin') {
					$return = TRUE;
				}
			}
		}

		return $return;
	}

	// ------------------------------------------------------------------------

	public function juraganBy($user_id)
	{
		$juragan = Jrgn::by_user($user_id);

		$ids = [];
		foreach ($juragan[$user_id]['juragan'] as $r) {
			$ids = array_merge($ids, array($r['id']));
		}

		$return = $this->juragan->terakhir_update($ids);

		return $return;
	}

	// ------------------------------------------------------------------------

	public function isJuragan($juragan)
	{
		$get = $this->juragan->where('juragan', $juragan)->findAll();

		$return = FALSE;
		if (count($get) > 0) {
			$return = TRUE;
		}

		return $return;
	}

	// ------------------------------------------------------------------------

	public function allowedJuragan($user_id, $juragan)
	{
		$juragans = Jrgn::by_user($user_id);

		$return = FALSE;
		if ($this->isJuragan($juragan)) {
			$get = $this->juragan->where('juragan', $juragan)->findAll();

			$result = array_search($get[0]->id_juragan, array_column($juragans[$user_id]['juragan'], 'id'));  // false if not found, key off array if exist

			$return = FALSE;
			if ($result !== FALSE) {
				$return = TRUE;
			}
		}

		return $return;
	}

	// ------------------------------------------------------------------------

}
