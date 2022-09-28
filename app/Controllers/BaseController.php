<?php

namespace App\Controllers;

use App\Models\TenantsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
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
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['message', 'text'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    public function fetch_expiry_dates()
    {
        $tenantModel = new TenantsModel();
        $tenants = $tenantModel->builder()->select()->get()->getResult();
        $alert = '';
        foreach ($tenants as $tenant) {
            $end = date('F d, Y H:i:s', strtotime($tenant->rent_ending_date));
            $time = Time::parse($end, 'Africa/Lagos');
            $due_date_for_expiration = $time->humanize();
            $alert .= '
                 <a class="dropdown-item d-flex align-items-center" href="' . base_url('admin/tenant/details/' . $tenant->unique_id . '') . '">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">' . date('J d, Y') . '</div>' . $tenant->title . ' ' . $tenant->first_name . '\'s tenancy period is due to expire ' . $due_date_for_expiration . '!
                            </div>
                        </a>
            ';
        }
        return $alert;
    }
}
