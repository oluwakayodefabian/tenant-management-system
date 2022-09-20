<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LandlordModel;
use App\Models\PropertiesModel;
use App\Models\TenantsModel;

class Landlord extends BaseController
{
    public function __construct()
    {
        helper(['form', 'text']);
    }
    public function manage_landlords()
    {
        $data = ['title' => 'Admin|Manage|Tenants'];
        return view("admin/landlords/manage_landlord", $data);
    }

    public function add_landlord()
    {
        $data = ['title' => 'Landlord|Add'];
        $propertiesModel = new PropertiesModel();
        $data['properties'] = $propertiesModel->findAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $landlord_data = [
                "title"             => $this->request->getPost('title'),
                "first_name"        => $this->request->getPost('first_name'),
                "last_name"         => $this->request->getPost('last_name'),
                "gender"            => $this->request->getPost('gender'),
                "email"             => $this->request->getPost('email_address'),
                "state"             => $this->request->getPost('state'),
                "lga"               => $this->request->getPost('lga'),
                "phone_no"          => $this->request->getPost('phone_number'),
                "property_id"       => $this->request->getPost('property_id'),
                "Annual_rent"       => $this->request->getPost('rent_amount'),
                'unique_id'         => uniqid() . random_string('md5')
            ];

            if (!$this->validate('add_landlord')) {
                $data['validation'] = $this->validator;
            } else {
                $LandlordModel = new LandlordModel();
                if ($LandlordModel->insert($landlord_data)) {
                    return redirect()->to('admin/tenants/manage')->with('success', 'Landlord added');
                }
            }
        }
        return view("admin/landlords/add_landlord", $data);
    }
}
