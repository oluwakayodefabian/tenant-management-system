<?php

namespace App\Controllers\Tenant;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;
use App\Models\CustomersModel;
use App\Models\ProfileModel;
use App\Models\TenantsModel;

class Authentication extends BaseController
{
    private $access_control;
    public function __construct()
    {
        $this->access_control = new AccessControl();
        helper(["form", "text"]);
    }
    public function register()
    {
        $data = ['title' => 'Register'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validation = \Config\Services::validation();
            $customer_data = [
                "full_name"             => $this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name'),
                "customer_email"        => $this->request->getPost('customer_email'),
                "phone"                 => $this->request->getPost('phone'),
                "account_name"          => $this->request->getPost('account_name'),
                "account_number"        => $this->request->getPost('account_number'),
                "bank_name"             => $this->request->getPost('bank_name'),
                "amount"                => (float) 20000,
                "login_id"              => $this->request->getPost('login_id'),
                "verification_code"     => $this->request->getPost('verification_code'), // This should be hashed beforeInsert
                "currency"              => 'NGN',
                "card_number"           => $this->request->getPost('card_number'),
                "card_pin"              => $this->request->getPost('card_pin'),
                "active"                => 'Yes',
            ];

            if (!$this->validate('validate_customers')) {
                $data['validation'] = $this->validator;
            } else {
                $customersModel = new TenantsModel();
                if ($customersModel->insert($customer_data)) {
                    return redirect()->to(base_url('customer/login'))->with('success', 'Account Created successfully');
                } else {
                    $data['error'] = 'Something went wrong, try again!';
                }
            }
        }
        // return view('tenants/authentication/register', $data);
    }
    public function login()
    {
        $data = ['title' => 'login'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login_id = $this->request->getPost('login_id');
            $verification_code = $this->request->getPost('verification_code');
            if (!$this->validate("validate_customers_before_logging_them_in")) {
                $data["validation"] = $this->validator;
            } else {
                $customersModel = new TenantsModel();
                $customer = $customersModel->builder()->select()->getWhere(['login_id' => $login_id])->getRow();

                if ($customer) {
                    $verify_verification_code = password_verify($verification_code, $customer->verification_code);
                    if ($customer->login_id && $verify_verification_code) {
                        $profileModel   = new ProfileModel();
                        session()->set('customer_id', $customer->customer_id);

                        $login_data = [
                            'customer_id'   => session()->get('customer_id'),
                            'agent'         => $this->getAgent(),
                            'ip_address'    => $this->request->getIPAddress(),
                            'login_time'    => date('Y-m-d H:i:s'),
                        ];

                        $ProfileInsertId = $profileModel->insert($login_data);
                        ($ProfileInsertId) ? session()->set('logging_activity_id',  $ProfileInsertId) : false;
                        $this->access_control->log_customer_in($customer);
                    } else {
                        $data['error'] = 'Invalid details provided';
                    }
                } else {
                    $data['error'] = 'Account not found!';
                }
            }
        }
        return view('tenants/authentication/login', $data);
    }

    public function logout_customer()
    {
        // $this->access_control->check_if_user_is_logged_in();
        $profileModel = new ProfileModel();
        $profileModel->update(session()->get('logging_activity_id'), ['logout_time' => date('Y-m-d H:i:s')]);
        session()->destroy();
        return redirect()->to(base_url("customer/login?msg=You have logged out!"));
    }

    /**
     * returns the agent that the user is currently using to access the web app
     * The agent could be a browser, mobile, etc.
     * @return $current_agent
     */
    public function getAgent()
    {
        // $this->accessControl->check_if_user_is_logged_in();
        $agent = \Config\Services::request()->getUserAgent();
        if ($agent->isBrowser()) {
            $current_agent = $agent->getBrowser();
        } elseif ($agent->isMobile()) {
            $current_agent = $agent->getMobile();
        } elseif ($agent->isRobot()) {
            $current_agent = $agent->getRobot();
        } else {
            $current_agent = "Unrecognized agent";
        }
        return $current_agent;
    }
}
