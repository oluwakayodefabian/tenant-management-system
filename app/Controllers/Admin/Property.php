<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Property extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }
    public function manage_properties()
    {
        $data = ['title' => "admin|property|manage"];
        return view('admin/properties/manage_properties', $data);
    }

    public function add_property()
    {
        $data = ['title' => "admin|property|add"];

        $property_data = [
            'country' => $this->request->getPost('country'),
            'state' => $this->request->getPost('state'),
            'city' => $this->request->getPost('city'),
            'address' => $this->request->getPost('address'),
            'rent_amount' => $this->request->getPost('rent_amount'),
            'description' => $this->request->getPost('description'),
            'property_status' => $this->request->getPost('property_status'),
            'property_status' => $this->request->getPost('property_status'),
            'rent_starting_date' => $this->request->getPost('rent_starting_date'),
            'rent_ending_date' => $this->request->getPost('rent_ending_date'),
        ];
        return view('admin/properties/add_property', $data);
    }
}
