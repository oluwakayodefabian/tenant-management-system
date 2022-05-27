<?php

namespace App\Controllers\Customers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;
use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = ["title" => "Customer|Dashboard"];
        $customersModel = new CustomersModel();
        $data['customerDetails'] = $customersModel->builder()->select('account_balance, currency, account_name, account_number')->getWhere(['customer_id' => session()->get('customer_id')])->getRow();

        // $time = Time::parse('May 6, 2022 10:00:00', 'Africa/Lagos');
        // echo $time->humanize(); // 1 year ago
        $hour = date('H');
        if ($hour <= 11) {
            $data["greeting"] = "Good Morning";
        } else if ($hour == 12 || $hour >= 15) {
            $data["greeting"] = "Good Afternoon";
        } else if ($hour == 16 || $hour <= 23) {
            $data["greeting"] = "Good Evening";
        }


        return view('customers/dashboard', $data);
    }
}
