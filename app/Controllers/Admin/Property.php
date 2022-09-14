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
            'country'   => $this->request->getPost('country'),
            'state'     => $this->request->getPost('state'),
            'city'      => $this->request->getPost('city'),
            'address'   => $this->request->getPost('address'),
            'rent_amount' => $this->request->getPost('rent_amount'),
            'description' => $this->request->getPost('description'),
            'property_status' => $this->request->getPost('property_status'),
            'rent_starting_date' => $this->request->getPost('rent_starting_date') . ' ' . $this->request->getPost('rent_starting_time'),
            'rent_ending_date' => $this->request->getPost('rent_ending_date') . ' ' . $this->request->getPost('rent_ending_time'),
        ];

        $file = $this->request->getFile('property_image');
        if ($this->validate('validate_add_property')) {
            $data['validation'] = $this->validator;
        }
        // $this->model = new SermonModel();
        // if ($this->model->insert($this->data)) {
        //     if ($file->isValid() && !$file->hasMoved()) {
        //         $file->move('uploads/sermon_images', $newFileName);
        //         return redirect()->to(base_url("admin/sermon/manage"))->with("success", "New sermon added successfully");
        //     }
        // }
        return view('admin/properties/add_property', $data);
    }
}
