<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;
use App\Models\AdminUserModel;
use App\Models\PropertiesModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $access_control = new AccessControl;
        $access_control->check_if_user_is_admin();
        $data = ["title" => "Dashboard"];
        $adminUserModel  = new AdminUserModel();
        $propertyModel = new PropertiesModel();
        $getAgents = $adminUserModel->builder()->getWhere(['admin_type !=' => 'super_admin'])->getResult();
        $getProperties = $adminUserModel->builder()->select()->getWhere(['admin_id' => session()->get('admin_id')])->getResult();
        $data["total_no_of_admin_users"] = count($getAgents);
        $data["total_no_of_properties"] = count($getProperties);

        return view('admin/dashboard', $data);
    }
}
