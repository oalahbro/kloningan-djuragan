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

use App\Models\BankModel;
use App\Models\InvoiceModel;
use App\Models\JuraganModel;
use App\Models\PembayaranModel;
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
	protected $helpers = ['date','form','fungsi','number','text','url'];

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
		// E.g.:
		$this->cache = \Config\Services::cache();
		$this->session = \Config\Services::session();
		$this->validation = \Config\Services::validation();

		$this->bank 	= new BankModel();
		$this->invoice 	= new InvoiceModel();
		$this->juragan 	= new JuraganModel();
		$this->pembayaran 	= new PembayaranModel();
		$this->relasi 	= new RelasiModel();
		$this->user 	= new UserModel();

		// migration here
		$migrate = \Config\Services::migrations();
		$migrate->latest();
	}

	// ------------------------------------------------------------------------

	public function isLogged()
	{
		if ($this->session->has('logged')) {
			if (!$this->session->get('logged')) {
				return FALSE;
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}

	// ------------------------------------------------------------------------

	public function isAdmin($superadmin = FALSE)
	{
		$return = FALSE;
		if ($superadmin === TRUE) {
			// jika $superadmin === TRUE, maka yang diambil hanya superadmin
			if ($this->session->get('level') === 'superadmin') {
				$return = TRUE;
			}
		}
		else {
			// levelnya admin dan superadmin
			if ($this->session->get('level') === 'admin' or $this->session->get('level') === 'superadmin') {
				$return = TRUE;
			}
		}

		return $return;
	}

	// ------------------------------------------------------------------------
	
}
