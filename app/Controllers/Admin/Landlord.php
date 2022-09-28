<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;
use App\Models\LandlordModel;
use App\Models\PropertiesModel;
use App\Models\TenantsModel;
use \Hermawan\DataTables\DataTable;

class Landlord extends BaseController
{
    private object $accessControl;
    public function __construct()
    {
        helper(['form', 'text']);
        $this->accessControl = new AccessControl;
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_the_main_admin();
    }
    public function manage_landlords()
    {
        $data = ['title' => 'admin|landlord|manage'];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        return view("admin/landlords/manage_landlord", $data);
    }

    public function add_landlord()
    {
        $data = ['title' => 'Landlord|Add'];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
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

    public function fetch_landlords()
    {
        $db = db_connect();
        $builder = $db->table('landlords')
            ->select('title')
            ->select("CONCAT(landlords.first_name, ' ', landlords.last_name) as full_name")
            ->orderBy('created_on', 'ASC')
            ->select('landlord_id, unique_id, created_on');

        return DataTable::of($builder)
            ->addNumbering('S/N')
            ->hide('landlord_id')
            ->hide('unique_id')
            ->edit('full_name', function ($row) {
                return '<a href="' . base_url('admin/landlord/details/' . $row->unique_id . '') . '" class="list-group-item-action text-primary">' . $row->full_name . '</a>';
            })
            ->format('created_on', function ($value) {
                return date('dS M, Y', strtotime($value));
            })
            ->toJson();
    }

    public function landlord_details($unique_id)
    {
        $data = ['title' => 'Property Details'];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        $landlordModel = new LandlordModel();
        $data['landlord'] = $landlordModel->builder()->select("CONCAT(landlords.first_name, ' ', landlords.last_name) as full_name")
            ->select('landlords.*, landlords.phone_no, landlords.title')
            ->where('unique_id', $unique_id)->get()->getRow();

        $propertyModel = new PropertiesModel();
        $data['properties'] = $propertyModel->builder()->select()->getWhere(['landlord_id' => $data['landlord']->landlord_id])->getResult();
        return view("admin/landlords/landlord_details", $data);
    }

    public function update_landlord_details($unique_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $landlord_data = [
                "title"             => $this->request->getPost('title'),
                "first_name"        => $this->request->getPost('first_name'),
                "last_name"         => $this->request->getPost('last_name'),
                "gender"            => $this->request->getPost('gender'),
                "email"             => $this->request->getPost('email_address'),
                "state"             => $this->request->getPost('state'),
                "lga"               => $this->request->getPost('lga'),
                "phone_no"          => $this->request->getPost('phone_number'),
            ];

            // $file = $this->request->getFile('property_image');
            // $newFileName = $file->getRandomName();
            if ($this->validate('validate_edit_landlord')) {
                $data['validation'] = $this->validator;
            }
            $landlordModel = new LandlordModel();
            // $property_data['property_image'] = $newFileName;
            if ($landlordModel->builder()->update($landlord_data, ['unique_id' => $unique_id])) {
                // if ($file->isValid() && !$file->hasMoved()) {
                //     $file->move('uploads/property_images', $newFileName);
                return redirect()->to(base_url("admin/landlord/manage"))->with("success", "Landlord Updated successfully");
                // }
            }
        }
    }
}
