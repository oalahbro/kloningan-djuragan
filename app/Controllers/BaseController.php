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

use App\Libraries\Login;
use App\Models\FakturModel;
use App\Models\JuraganModel;
use App\Models\UserModel;

use Ncaneldiee\Rajaongkir;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url', 'number', 'date'];

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

		$this->faktur = new FakturModel();
		$this->login = new Login();
		$this->juragan = new JuraganModel();
		$this->user = new UserModel();

		$this->rajaongkir = new Rajaongkir\Domestic('75f538ed88e26297a2fabed240ed8bf0', Rajaongkir\Domestic::ACCOUNT_PRO);
	}
}
