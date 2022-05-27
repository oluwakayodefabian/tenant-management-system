<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertiesModel;
use App\Models\TenantsModel;

class Tenants extends BaseController
{
    public function __construct()
    {
        helper(['form', 'text']);
    }
    public function manage_tenants()
    {
        $data = ['title' => 'Admin|Manage|Tenants'];
        return view("admin/tenants/manage_tenants", $data);
    }

    public function add_tenants()
    {
        $data = ['title' => 'Members|Add'];
        $propertiesModel = new PropertiesModel();
        $data['properties'] = $propertiesModel->findAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenant_data = [
                "first_name"    => $this->request->getPost('first_name'),
                "last_name"     => $this->request->getPost('last_name'),
                "gender"        => $this->request->getPost('gender'),
                "email" => $this->request->getPost('residential_address'),
                "state"         => $this->request->getPost('state'),
                "lga"           => $this->request->getPost('lga'),
                "phone_no"  => $this->request->getPost('phone_number'),
                "property_id"   => $this->request->getPost('property_id'),
                'tenant_username' => $this->request->getPost('first_name') . $this->request->getPost('last_name'),
                'unique_id' => uniqid() . random_string()
            ];

            if (!$this->validate('add_tenant')) {
                $data['validation'] = $this->validator;
            } else {
                $tenantModel = new TenantsModel();
                if ($tenantModel->insert($tenant_data)) {
                    return redirect()->to('admin/tenants/manage')->with('success', 'Tenant added');
                }
            }
        }
        return view("admin/tenants/add_tenants", $data);
    }
}
