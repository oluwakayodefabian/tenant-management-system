<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;
use App\Models\LandlordModel;
use App\Models\PropertiesModel;
use App\Models\TenantsModel;
use \Hermawan\DataTables\DataTable;
use CodeIgniter\I18n\Time;

class Tenants extends BaseController
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
    public function manage_tenants()
    {
        $data = ['title' => 'Admin|Manage|Tenants'];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        return view("admin/tenants/manage_tenants", $data);
    }

    public function add_tenants()
    {
        $data = ['title' => 'Tenants|Add'];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        $propertiesModel = new PropertiesModel();
        $data['properties'] = $propertiesModel->findAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenant_data = [
                "title"             => $this->request->getPost('title'),
                "first_name"        => $this->request->getPost('first_name'),
                "last_name"         => $this->request->getPost('last_name'),
                "gender"            => $this->request->getPost('gender'),
                "email"             => $this->request->getPost('email_address'),
                "state"             => $this->request->getPost('state'),
                "lga"               => $this->request->getPost('lga'),
                "phone_no"          => $this->request->getPost('phone_number'),
                "property_id"       => $this->request->getPost('property_id'),
                'tenant_username'   => $this->request->getPost('first_name') . $this->request->getPost('last_name'),
                'rent_starting_date'   => $this->request->getPost('rent_starting_date') . ' ' . $this->request->getPost('rent_starting_time'),
                'rent_ending_date'   => $this->request->getPost('rent_ending_date') . ' ' . $this->request->getPost('rent_ending_time'),
                'unique_id'         => uniqid() . random_string(),
                'created_on'         => date('Y-m-d H:i:s'),
            ];

            if (!$this->validate('add_tenant')) {
                $data['validation'] = $this->validator;
            } else {
                $tenantModel = new TenantsModel();
                if ($tenantModel->insert($tenant_data)) {
                    $propertiesModel->builder()->update(['property_status' => 'occupied'], ['property_id' => $tenant_data['property_id']]);
                    return redirect()->to('admin/tenants/manage')->with('success', 'Tenant added');
                }
            }
        }
        return view("admin/tenants/add_tenants", $data);
    }

    public function fetch_tenants()
    {
        $db = db_connect();
        $builder = $db->table('tenants')
            ->select("CONCAT(tenants.first_name, ' ', tenants.last_name) as full_name")
            ->orderBy('created_on', 'ASC')
            ->select('tenant_id, unique_id, created_on');

        return DataTable::of($builder)
            ->addNumbering('S/N')
            ->hide('tenant_id')
            ->hide('unique_id')
            ->edit('full_name', function ($row) {
                return '<a href="' . base_url('admin/tenant/details/' . $row->unique_id . '') . '" class="list-group-item-action text-primary">' . $row->full_name . '</a>';
            })
            ->format('created_on', function ($value) {
                return date('dS M, Y', strtotime($value));
            })
            ->toJson();
    }

    public function tenant_details($unique_id)
    {
        helper(['number']);
        $data = ['title' => 'Tenant Details'];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        $tenantModel = new TenantsModel();
        $data['tenant'] = $tenantModel->builder()->select("CONCAT(tenants.first_name, ' ', tenants.last_name) as full_name")
            ->select('tenants.*, tenants.phone_no')
            ->where('unique_id', $unique_id)->get()->getRow();

        $propertyModel = new PropertiesModel();
        $data['property'] = $propertyModel->builder()->select()->getWhere(['property_id' => $data['tenant']->property_id])->getRow();
        $data['properties'] = $propertyModel->builder()->select()->getWhere(['property_status' => 'vacant'])->getResult();
        $end = date('F d, Y H:i:s', strtotime($data['tenant']->rent_ending_date));
        // Assume current time is: March 10, 2017 (America/Chicago)
        $time = Time::parse($end, 'Africa/Lagos');
        // echo $end . "<br />";
        $data['due_date_for_expiration'] = $time->humanize(); // 1 year ago
        return view("admin/tenants/tenant_details", $data);
    }

    public function update_tenant_details($unique_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tenant_data = [
                "first_name"        => $this->request->getPost('first_name'),
                "last_name"         => $this->request->getPost('last_name'),
                "gender"            => $this->request->getPost('gender'),
                "email"             => $this->request->getPost('email_address'),
                "state"             => $this->request->getPost('state'),
                "lga"               => $this->request->getPost('lga'),
                "phone_no"          => $this->request->getPost('phone_number'),
                "property_id"       => $this->request->getPost('property_id'),
                'tenant_username'   => $this->request->getPost('first_name') . $this->request->getPost('last_name'),
                'rent_starting_date'   => $this->request->getPost('rent_starting_date') . ' ' . $this->request->getPost('rent_starting_time'),
                'rent_ending_date'   => $this->request->getPost('rent_ending_date') . ' ' . $this->request->getPost('rent_ending_time'),
                'unique_id'         => uniqid() . random_string(),
            ];

            // echo '<pre>';
            // print_r($tenant_data);
            // die;
            // $file = $this->request->getFile('property_image');
            // $newFileName = $file->getRandomName();
            if ($this->validate('validate_edit_tenant')) {
                $data['validation'] = $this->validator;
            }
            $tenant_model = new TenantsModel();
            // $property_data['property_image'] = $newFileName;
            if ($tenant_model->builder()->update($tenant_data, ['unique_id' => $unique_id])) {
                $propertiesModel = new PropertiesModel();
                $propertiesModel->builder()->update(['property_status' => 'occupied'], ['property_id' => $tenant_data['property_id']]);
                // if ($file->isValid() && !$file->hasMoved()) {
                //     $file->move('uploads/property_images', $newFileName);
                return redirect()->to(base_url("admin/tenants/manage"))->with("success", "Tenant Updated successfully");
                // }
            }
        }
    }

    public function fetch_rent_date($unique_id)
    {
        $tenantModel = new TenantsModel();
        $body = $tenantModel->builder()->select('rent_starting_date, rent_ending_date')->getWhere(['unique_id' => $unique_id])->getRow();
        $end = date('F d, Y H:i:s', strtotime($body->rent_ending_date));
        $data = ['start' => $body->rent_starting_date, 'end' => $end];
        return $this->response->setJSON($data);
    }

    public function view_rent_due_dates()
    {
        $data = ['title' => 'Due Dates'];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        return view('admin/tenants/view_rent_due_date', $data);
    }

    public function delete_tenant($unique_id)
    {
        $tenantModel = new TenantsModel();
        if ($tenantModel->builder()->delete(['unique_id' => $unique_id])) {
            return redirect()->to(base_url("admin/tenants/manage"))->with("success", "Tenant Deleted successfully");
        }
    }
}
