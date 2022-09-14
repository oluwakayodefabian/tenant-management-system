<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;
use App\Models\AdminUserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $access_control = new AccessControl;
        $access_control->check_if_user_is_admin();
        $data = ["title" => "Dashboard"];
        $adminUserModel  = new AdminUserModel();
        $getAgents = $adminUserModel->builder()->getWhere(['admin_type !=' => 'super_admin'])->getResult();
        $data["total_no_of_admin_users"] = count($getAgents);

        return view('admin/dashboard', $data);
    }
}
