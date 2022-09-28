<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;
use App\Models\AdminUserModel;
use App\Models\LandlordModel;
use App\Models\PropertiesModel;
use App\Models\TenantsModel;
use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{
    public function index()
    {
        $access_control = new AccessControl;
        $access_control->check_if_user_is_admin();
        $data = ["title" => "Dashboard"];
        $adminUserModel  = new AdminUserModel();
        $propertyModel = new PropertiesModel();
        $landlordModel = new LandlordModel();
        $tenantModel = new TenantsModel();
        $getAgents = $adminUserModel->builder()->getWhere(['admin_type !=' => 'super_admin'])->getResult();
        $getProperties = $propertyModel->builder()->select()->getWhere(['admin_id' => session()->get('admin_id')])->getResult();
        $getLandlords = $landlordModel->builder()->select()->get()->getResult();
        $getTenants = $tenantModel->builder()->select()->get()->getResult();
        $data["total_no_of_admin_users"] = count($getAgents);
        $data["total_no_of_properties"] = count($getProperties);
        $data["total_no_of_landlords"] = count($getLandlords);
        $data["total_no_of_tenants"] = count($getTenants);
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        return view('admin/dashboard', $data);
    }
}
