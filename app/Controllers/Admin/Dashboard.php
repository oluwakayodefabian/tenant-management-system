<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;
use App\Models\AdminUserModel;
use App\Models\LandlordModel;
use App\Models\PropertiesModel;
use App\Models\TenantsModel;
use CodeIgniter\I18n\Time;
use Dompdf\Dompdf;

class Dashboard extends BaseController
{
    public function index()
    {
        $access_control = new AccessControl;
        $access_control->check_if_user_is_admin();
        $data = ["title" => "Dashboard"];
        $adminUserModel  = new AdminUserModel();
        $propertyModel = new PropertiesModel();
        $landlordModel = new LandlordModel();
        $tenantModel = new TenantsModel();
        $getAgents = $adminUserModel->builder()->getWhere(['admin_type !=' => 'super_admin'])->getResult();
        $getProperties = $propertyModel->builder()->select()->getWhere(['admin_id' => session()->get('admin_id')])->getResult();
        $getLandlords = $landlordModel->builder()->select()->get()->getResult();
        $getTenants = $tenantModel->builder()->select()->get()->getResult();
        $data["total_no_of_admin_users"] = count($getAgents);
        $data["total_no_of_properties"] = count($getProperties);
        $data["total_no_of_landlords"] = count($getLandlords);
        $data["total_no_of_tenants"] = count($getTenants);
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        return view('admin/dashboard', $data);
    }

    public function generate_report()
    {
        $access_control = new AccessControl();
        $access_control->check_if_user_is_logged_in();

        $this->response->setContentType('application/pdf');

        $adminUserModel  = new AdminUserModel();
        $propertyModel = new PropertiesModel();
        $landlordModel = new LandlordModel();
        $tenantModel = new TenantsModel();
        $getAgents = $adminUserModel->builder()->getWhere(['admin_type !=' => 'super_admin'])->getResult();
        $getProperties = $propertyModel->builder()->select()->getWhere(['admin_id' => session()->get('admin_id')])->getResult();
        $getLandlords = $landlordModel->builder()->select()->get()->getResult();
        $getTenants = $tenantModel->builder()->select()->get()->getResult();
        $total_no_of_admin_users = count($getAgents);
        $total_no_of_properties = count($getProperties);
        $total_no_of_landlords = count($getLandlords);
        $total_no_of_tenants = count($getTenants);

        $base = base_url();
        $output = '<body style="margin:0;padding:0;box-sizing:border-box; font-family: Arial, sans-serif">';
        $output .= '<center><img src=' . base_url("resources/images/logo.png") . ' alt="LOGO" /></center>';
        $output .= "<h2 style='margin-bottom: 3rem;'>REPORT</h2>";
        $output .= '<div style="width: 100%;">';
        $output .= "<table width='100%' cellpadding='5' border='1' cellspacing='0'>
                    <tr>
                        <th>Total No of Landlords</th>
                        <th>Total No of Properties</th>
                        <th>Total No of Tenants</th>
                    </tr>";
        $output .= '
                    <tr>
                        <td>' . $total_no_of_properties . '</td>
                        <td>' . $total_no_of_landlords . '</td>
                        <td>' . $total_no_of_tenants . '</td>
                    </tr>';
        $output .= "</table>";
        $output .= "<p style='margin-top: 1rem'>Report generated from $base";
        $output .= '</div>';
        $pdf = new Dompdf();
        $pdf->setPaper('letter', 'portrait');
        $filename = "Report.pdf";
        $options = $pdf->getOptions();
        $options->setChroot([base_url('resources/')]);
        $options->setIsRemoteEnabled(true);
        $options->setDefaultFont('Arial');
        $pdf->setOptions($options);
        $pdf->loadHtml($output);
        $pdf->render();
        $pdf->stream($filename, ['Attachment' => true]);
    }
}
