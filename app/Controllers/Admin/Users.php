<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use App\Libraries\AccessControl;
use App\Models\ProfileModel;
use Hermawan\DataTables\DataTable;

class Users extends BaseController
{
    public $session;
    public object $model;
    private object $accessControl;

    public function __construct()
    {
        helper(["message", "form", "text"]);
        $this->session  = \Config\Services::session();
        $this->model    = new AdminUserModel();
        $this->accessControl = new AccessControl();
    }

    public function manage_users()
    {
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_the_main_admin();

        $data = ["title" => "Users | manage"];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();

        return view("admin/users/manageUsers", $data);
    }

    public function fetch_users()
    {
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_the_main_admin();

        $db = db_connect();
        $builder = $db->table('admin_users')->select('admin_id,unique_id, admin_username, admin_email, admin_type')->where(['admin_id !=' => session()->get('admin_id')]);

        return DataTable::of($builder)
            ->add('action', function ($row) {
                if (session()->get('admin') !== 'sub_admin') {
                    return '
                        <a role="button" class="btn btn-warning btn-sm" href=' . base_url("admin/users/edit/$row->unique_id") . ' id="tooltipstudview" data-toggle="tooltip" data-placement="top" title="edit department details"><i class="fas fa-edit"></i> Edit</a>
                        <a href="#" class="btn btn-danger" id="deleteUser" value=' . $row->unique_id . ' title="Delete user details"><i class="fas fa-trash-alt"></i></a>
                         <a role="button" class="btn btn-success btn-sm" href=' . base_url("admin/users/activity_log/$row->admin_id") . ' id="tooltipstudview" data-toggle="tooltip" data-placement="top" title="view login activity"><i class="fas fa-edit"></i> View login activity</a>
                    ';
                }
            })
            ->addNumbering('S/N')
            ->hide('unique_id')
            ->hide('admin_id')
            ->toJson();
    }

    public function delete_user()
    {
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_the_main_admin();
        $delete_id     = $this->request->getPost('deleteID');
        $db            = \Config\Database::connect();
        $query         = 'DELETE FROM admin_users WHERE unique_id=?';
        $execute_query = $db->query($query, [$delete_id]);

        if ($execute_query) {
            $ajax_data = ["response" => "success"];
        } else {
            $ajax_data = ["response" => "error"];
        }
        return $this->response->setJSON($ajax_data);
    }

    public function activate()
    {
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_the_main_admin();
        $db         = \Config\Database::connect();
        $builder    = $db->table('admin_users');
        $activated  = $this->request->getGet('activated');
        $user_id    = $this->request->getGet('user_id');

        $update_activated_status = $builder->update(['is_activated' => $activated], ['unique_id' => $user_id]);

        if ($activated == 1) {
            return redirect()->to(base_url('admin/users/manage'))->with('success', "User account has been activated");
        } else {
            return redirect()->to(base_url('admin/users/manage'))->with('success', "User account has been deactivated");
        }
    }

    public function edit($uniqueID)
    {
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $this->accessControl->check_if_user_is_the_main_admin();

        $data = ['title' => 'Edit'];
        $data['user'] = $this->model->builder()->getWhere(['unique_id' => $uniqueID])->getRow();
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        return view('admin/users/edit_user', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin_id = $this->request->getPost('admin_id');
            $admin_data = [
                "admin_type" => $this->request->getPost('role')
            ];

            $adminModel = new AdminUserModel();
            if ($adminModel->builder()->update($admin_data, ['admin_id' => $admin_id])) {
                return redirect()->to('admin/users/manage')->with('success', 'Admin\'s role updated');
            }
        }
    }

    public function change_password($uniqueID = null)
    {
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $data = ['title' => "Change_password"];
        $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
        $validation     = \Config\Services::validation();

        $adminModel = new AdminUserModel();
        $get_user_current_password = $adminModel->builder()->select('password')->getWhere(['unique_id' => $uniqueID])->getRow();
        $current_password = $this->request->getPost('current-password');
        if (empty($current_password)) {
            $data['current_password_error'] = "The password you were using before is needed";
        } else {
            $verify_password = password_verify($current_password, $get_user_current_password->password);
            if ($verify_password == true) {
                $this->data = ["password" => password_hash($this->request->getPost("admin_password"), PASSWORD_BCRYPT)];

                $validation_rules = [
                    'admin_password'    => [
                        'rules'  => 'required|min_length[8]',
                        'errors' => [
                            'required'       => 'Password is required',
                            'min_length'     => 'Your password is too short. You want to get hacked?'
                        ]
                    ],
                    'confirm_admin_password' => [
                        'rules' => 'required|matches[admin_password]',
                        'errors' => [
                            'required'        => 'Password Confirmation is required',
                            'matches'         => "Passwords do not match"
                        ]
                    ]
                ];

                if (!$this->validate($validation_rules)) {
                    session()->setFlashdata('error', $validation->listErrors());
                } else {
                    $update_password = $adminModel->builder()->update(['password' => $this->data], ['unique_id' => $uniqueID]);
                    if ($update_password) {
                        return redirect()->to(base_url('admin/dashboard'))->with('success', "Password changed successfully");
                    }
                }
            } else {
                session()->setFlashdata('error', 'The password given is incorrect');
            }
        }

        return view("admin/users/change_password", $data);
    }

    public function profile()
    {
        $this->accessControl->check_if_user_is_logged_in();
        $this->accessControl->check_if_user_is_admin();
        $model = new AdminUserModel();
        $user_info = $model->builder()
            ->select()
            ->getWhere(['unique_id' => session()->get('uniqueID')])
            ->getRow();
        return $this->response->setJSON($user_info);
    }

    public function activity_log($id)
    {
        $this->accessControl->check_if_user_is_logged_in();
        $data['title']      = 'Login Activity';
        $model              = new ProfileModel();

        $user_login_details = $model->builder()
            ->select('agent, ip_address,login_time,logout_time, admin_users.first_name, admin_users.last_name')
            ->join('admin_users', 'login_activity.admin_id=admin_users.admin_id')
            ->where(['login_activity.admin_id' => $id])
            ->limit(10)
            ->orderBy('login_activity.logout_time', 'ASC')
            ->get()
            ->getResult();

        if (count($user_login_details) == 0) {
            die('No login activity for this user yet!');
        } else {
            $data['user_login_activity'] = $user_login_details;
            $data['tenants_with_expiry_dates'] = $this->fetch_expiry_dates();
            return view("admin/users/login_activity", $data);
        }
    }

    /**
     * returns the agent that the user is currently using to access the web app
     * The agent could be a browser, mobile, etc.
     * @return $current_agent
     */
    public function getAgent()
    {
        $this->accessControl->check_if_user_is_logged_in();
        $agent = \Config\Services::request()->getUserAgent();
        if ($agent->isBrowser()) {
            $current_agent = $agent->getBrowser();
        } elseif ($agent->isMobile()) {
            $current_agent = $agent->getMobile();
        } elseif ($agent->isRobot()) {
            $current_agent = $agent->getRobot();
        } else {
            $current_agent = "Unrecognized agent";
        }
        return $current_agent;
    }
}
