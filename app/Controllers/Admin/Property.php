<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;
use App\Models\LandlordModel;
use App\Models\PropertiesModel;

use \Hermawan\DataTables\DataTable;

class Property extends BaseController
{
    private object $accessControl;
    public function __construct()
    {
        helper(['form']);
        $this->accessControl = new AccessControl;
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_the_main_admin();
    }
    public function manage_properties()
    {
        $data = ['title' => "admin|property|manage"];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        return view('admin/properties/manage_properties', $data);
    }

    public function add_property()
    {
        $data = ['title' => "admin|property|add"];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        $landlordModel = new LandlordModel();
        $data['landlords'] = $landlordModel->findAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $property_data = [
                'property_name'     => $this->request->getPost('property_name'),
                'admin_id'          => session()->get('admin_id'),
                'landlord_id'       => $this->request->getPost('landlord_id'),
                'country'           => $this->request->getPost('country'),
                'state'             => $this->request->getPost('state'),
                'city'              => $this->request->getPost('city'),
                'address'           => $this->request->getPost('address'),
                'rent_amount'       => $this->request->getPost('rent_amount'),
                'description'       => $this->request->getPost('description'),
                'property_status'   => $this->request->getPost('property_status'),
                'unique_id'         => uniqid() . random_string('alnum', 20),
            ];

            // $file = $this->request->getFile('property_image');
            // $newFileName = $file->getRandomName();
            if ($this->validate('validate_add_property')) {
                $data['validation'] = $this->validator;
            }
            $propertyModel = new PropertiesModel();
            // $property_data['property_image'] = $newFileName;
            if ($propertyModel->insert($property_data)) {
                // if ($file->isValid() && !$file->hasMoved()) {
                //     $file->move('uploads/property_images', $newFileName);
                return redirect()->to(base_url("admin/property/manage"))->with("success", "New property added successfully");
                // }
            }
        }

        return view('admin/properties/add_property', $data);
    }

    public function fetch_properties()
    {
        $db = db_connect();
        $builder = $db->table('properties')
            // ->select('user_id')
            // ->select("CONCAT(landlords.first_name, ' ', landlords.last_name) as full_name")
            ->orderBy('properties.created_on', 'ASC')
            ->select('property_id, properties.unique_id, property_name, address, description, rent_amount, property_status, properties.created_on')
            // ->join('landlords', 'properties.landlord_id=landlords.landlord_id')
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
                return '<a href="' . base_url('admin/property/details/' . $row->unique_id . '') . '" class="list-group-item-action text-primary">' . $row->property_name . '</a>';
            })
            ->format('created_on', function ($value) {
                return date('dS M, Y', strtotime($value));
            })
            ->toJson();
    }

    public function property_details($unique_id)
    {
        $data = ['title' => 'Property Details'];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        $propertyModel = new PropertiesModel();
        $data['property'] = $propertyModel->builder()->select("CONCAT(landlords.first_name, ' ', landlords.last_name) as full_name")
            ->orderBy('properties.created_on', 'ASC')
            ->select('properties.*, landlords.phone_no, landlords.title')
            ->join('landlords', 'properties.landlord_id=landlords.landlord_id')
            ->where('admin_id', session()->get('admin_id'))->get()->getRow();
        $landlordModel = new LandlordModel();
        $data['landlords'] = $landlordModel->findAll();
        return view("admin/properties/property_details", $data);
    }

    public function update_property_details($unique_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $property_data = [
                'property_name'     => $this->request->getPost('property_name'),
                'landlord_id'       => $this->request->getPost('landlord_id'),
                'country'           => $this->request->getPost('country'),
                'state'             => $this->request->getPost('state'),
                'city'              => $this->request->getPost('city'),
                'address'           => $this->request->getPost('address'),
                'rent_amount'       => $this->request->getPost('rent_amount'),
                'description'       => $this->request->getPost('description'),
                'property_status'   => $this->request->getPost('property_status'),
            ];

            // $file = $this->request->getFile('property_image');
            // $newFileName = $file->getRandomName();
            if ($this->validate('validate_edit_property')) {
                $data['validation'] = $this->validator;
            }
            $propertyModel = new PropertiesModel();
            // $property_data['property_image'] = $newFileName;
            if ($propertyModel->builder()->update($property_data, ['unique_id' => $unique_id])) {
                // if ($file->isValid() && !$file->hasMoved()) {
                //     $file->move('uploads/property_images', $newFileName);
                return redirect()->to(base_url("admin/property/manage"))->with("success", "Property Updated successfully");
                // }
            }
        }
    }

    public function delete_property($unique_id)
    {
        $propertyModel = new PropertiesModel();
        if ($propertyModel->builder()->delete(['unique_id' => $unique_id])) {
            return redirect()->to(base_url("admin/property/manage"))->with("success", "Property Deleted successfully");
        }
    }
}
