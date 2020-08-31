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

use CodeIgniter\Controller;

=======
use CodeIgniter\Controller;

use App\Models\BankModel;
use App\Models\FakturModel;
use App\Models\JuraganModel;
use App\Models\RelasiModel;
use App\Models\UserModel;

>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
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
	protected $helpers = [];
=======
	protected $helpers = ['date','form','fungsi','number','text','url'];
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

<<<<<<< HEAD
=======
		$config = config('JuraganConfig');
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
<<<<<<< HEAD
		// $this->session = \Config\Services::session();
	}

=======
		$this->cache = \Config\Services::cache();
		$this->session = \Config\Services::session();
		$this->validation = \Config\Services::validation();

		$this->bank 	= new BankModel();
		$this->faktur 	= new FakturModel();
		$this->juragan 	= new JuraganModel();
		$this->relasi 	= new RelasiModel();
		$this->user 	= new UserModel();
	}
>>>>>>> a3f02c4b0f4736440cdd0afc6ed9b10879e6dbef
}
