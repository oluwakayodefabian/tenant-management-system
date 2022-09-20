<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertiesModel;

use \Hermawan\DataTables\DataTable;

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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $property_data = [
                'property_name'     => $this->request->getPost('property_name'),
                'country'           => $this->request->getPost('country'),
                'admin_id'          => session()->get('admin_id'),
                'state'             => $this->request->getPost('state'),
                'city'              => $this->request->getPost('city'),
                'address'           => $this->request->getPost('address'),
                'rent_amount'       => $this->request->getPost('rent_amount'),
                'description'       => $this->request->getPost('description'),
                'property_status'   => $this->request->getPost('property_status'),
                'unique_id'         => uniqid() . random_string('alnum', 20),
                // 'rent_starting_date' => $this->request->getPost('rent_starting_date') . ' ' . $this->request->getPost('rent_starting_time'),
                // 'rent_ending_date' => $this->request->getPost('rent_ending_date') . ' ' . $this->request->getPost('rent_ending_time'),
            ];

            $file = $this->request->getFile('property_image');
            $newFileName = $file->getRandomName();
            if ($this->validate('validate_add_property')) {
                $data['validation'] = $this->validator;
            }
            $propertyModel = new PropertiesModel();
            $property_data['property_image'] = $newFileName;
            if ($propertyModel->insert($property_data)) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move('uploads/property_images', $newFileName);
                    return redirect()->to(base_url("admin/property/manage"))->with("success", "New property added successfully");
                }
            }
        }

        return view('admin/properties/add_property', $data);
    }

    public function fetch_properties()
    {
        $db = db_connect();
        $builder = $db->table('properties')
            // ->select('user_id')
            // ->select("CONCAT(first_name, ' ', last_name) as full_name")
            ->select('property_id, unique_id, property_name, address, description, rent_amount, property_status, created_on')
            ->where('admin_id', session()->get('admin_id'));

        return DataTable::of($builder)
            // ->add('Verified', function ($row) {
            //     return '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>';
            // })
            // ->add('Disabled', function ($row) {
            //     return '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i> ';
            // })
            ->addNumbering('S/N')
            ->hide('property_id')
            ->hide('unique_id')
            ->edit('property_name', function ($row) {
                return '<a href="' . base_url('admin/properties/details/' . $row->unique_id . '') . '" class="list-group-item-action text-primary">' . $row->property_name . '</a>';
            })
            ->format('created_on', function ($value) {
                return date('dS M, Y', strtotime($value));
            })
            ->toJson();
    }
}
