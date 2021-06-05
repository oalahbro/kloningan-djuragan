<?php

namespace App\Controllers;

use App\Controllers\Juragan as Jrgn;
use App\Models\BankModel;
use App\Models\InvoiceModel;
use App\Models\JuraganModel;
use App\Models\PembayaranModel;
use App\Models\PengirimanModel;
use App\Models\RelasiModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest|CLIRequest
     */
    protected $request;

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
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param LoggerInterface   $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------

        $this->cache      = \Config\Services::cache();
        $this->session    = \Config\Services::session();
        $this->validation = \Config\Services::validation();

        $this->bank 	     = new BankModel();
        $this->invoice 	  = new InvoiceModel();
        $this->juragan 	  = new JuraganModel();
        $this->pembayaran = new PembayaranModel();
        $this->pengiriman = new PengirimanModel();
        $this->relasi 	   = new RelasiModel();
        $this->user 	     = new UserModel();

        // migration here
        // $migrate = \Config\Services::migrations();
        // $migrate->latest();
    }

    public function isLogged()
    {
        $r = false;

        if ($this->session->has('logged') && $this->session->get('logged')) {
            $r = true;
        }

        return $r;
    }

    public function isAdmin($superadmin = false)
    {
        $return = false;

        if ($this->isLogged()) {
            if ($superadmin === true) {
                // jika $superadmin === TRUE, maka yang diambil hanya superadmin
                if ($this->session->get('level') === 'superadmin') {
                    $return = true;
                }
            } else {
                // levelnya admin dan superadmin
                if ($this->session->get('level') === 'admin' or $this->session->get('level') === 'superadmin') {
                    $return = true;
                }
            }
        }

        return $return;
    }

    public function juraganBy($user_id)
    {
        $juragan = Jrgn::by_user($user_id);

        $ids = [];
        foreach ($juragan[$user_id]['juragan'] as $r) {
            $ids = array_merge($ids, [$r['id']]);
        }

        $return = $this->juragan->terakhir_update($ids);

        if ($return === null) {
            //  $juragan[$user_id]['juragan'];
            $arr = [];
            foreach ($juragan[$user_id]['juragan'] as $r => $v) {
                $arr['id_juragan']   = $v['id'];
                $arr['juragan']      = $v['slug'];
                $arr['nama_juragan'] = $v['nama'];

                break;
            }

            $return = (object) $arr;
        }

        return $return;
    }

    public function isJuragan($juragan)
    {
        $get = $this->juragan->where('juragan', $juragan)->findAll();

        $return = false;

        if (count($get) > 0) {
            $return = true;
        }

        return $return;
    }

    public function allowedJuragan($user_id, $juragan)
    {
        $juragans = Jrgn::by_user($user_id);

        $return = false;

        if ($this->isJuragan($juragan)) {
            $get = $this->juragan->where('juragan', $juragan)->findAll();

            $result = array_search($get[0]->id_juragan, array_column($juragans[$user_id]['juragan'], 'id'));  // false if not found, key off array if exist

            $return = false;

            if ($result !== false) {
                $return = true;
            }
        }

        return $return;
    }
}
