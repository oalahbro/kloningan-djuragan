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
<<<<<<< HEAD
<<<<<<< HEAD

use CodeIgniter\Controller;

=======
use CodeIgniter\Controller;

use App\Models\BankModel;
use App\Models\FakturModel;
=======
use CodeIgniter\Controller;

use App\Models\BankModel;
use App\Models\InvoiceModel;
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
use App\Models\JuraganModel;
use App\Models\RelasiModel;
use App\Models\UserModel;

<<<<<<< HEAD
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
<<<<<<< HEAD
<<<<<<< HEAD
	protected $helpers = [];
=======
	protected $helpers = ['date','form','fungsi','number','text','url'];
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
	protected $helpers = ['date','form','fungsi','number','text','url'];

	public $cache;
	public $session;
	public $validation;

	public $bank;
	public $invoice;
	public $juragan;
	public $relasi;
	public $user;
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

<<<<<<< HEAD
<<<<<<< HEAD
=======
		$config = config('JuraganConfig');
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
<<<<<<< HEAD
<<<<<<< HEAD
		// $this->session = \Config\Services::session();
	}

=======
=======
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		$this->cache = \Config\Services::cache();
		$this->session = \Config\Services::session();
		$this->validation = \Config\Services::validation();

		$this->bank 	= new BankModel();
<<<<<<< HEAD
		$this->faktur 	= new FakturModel();
=======
		$this->invoice 	= new InvoiceModel();
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
		$this->juragan 	= new JuraganModel();
		$this->relasi 	= new RelasiModel();
		$this->user 	= new UserModel();
	}
<<<<<<< HEAD
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
=======

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
	
>>>>>>> 545025698c6c7be18bd842f8bcc798818ed0db11
}
