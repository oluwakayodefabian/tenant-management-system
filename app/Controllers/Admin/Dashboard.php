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

        $data["total_no_of_admin_users"] = $adminUserModel->builder()->countAll();

        return view('admin/dashboard', $data);
    }
}
