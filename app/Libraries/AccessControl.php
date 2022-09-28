<?php

namespace App\Libraries;

class AccessControl
{
    public $session;
    public $redirect;
    public function __construct()
    {
        $this->session  = \Config\Services::session();
        $this->redirect = \Config\Services::response();
    }
    public function guest_only()
    {
        if ($this->session->has('uniqueID')) {
            $this->session->setFlashdata('error', 'You can\'t view requested page, because you are logged in already');
            $this->redirect->redirect(base_url());
        }
    }

    public function check_if_user_is_logged_in()
    {
        if (!$this->session->has('uniqueID')) {
            $this->session->setFlashdata('error', 'UNAUTHORIZED');
            $this->redirect->redirect(base_url());
        }
    }

    public function check_if_user_is_admin()
    {
        if (!$this->session->has('admin')) {
            $this->session->setFlashdata('error', 'UNAUTHORIZED');
            $this->redirect->redirect(base_url());
        }
    }

    public function check_if_user_is_the_main_admin()
    {
        if (!isset($_SESSION['admin']) || !array_key_exists('admin', $this->session->get()) && $_SESSION['admin'] !== 'super_admin') {
            $this->session->setFlashdata('error', 'FORBIDDEN, You are not allowed to view requested page');
            $this->redirect->redirect(base_url('admin/dashboard'));
        }
    }

    public function log_admin_in($admin)
    {
        if ($admin) {
            $this->session->set('admin_id', $admin->admin_id);
            $this->session->set('admin_username', $admin->first_name . ' ' . $admin->last_name);
            $this->session->set('adminEmail', $admin->admin_email);
            $this->session->set('uniqueID', $admin->unique_id);
            $this->session->set('admin', $admin->admin_type);
            if (isset($admin->admin_type) && !empty($admin->admin_type)) {
                $this->session->setFlashdata('success', 'Welcome ' . $admin->first_name . ' ' . $admin->last_name . ' You are now logged in');
                $this->redirect->redirect(base_url('admin/dashboard'));
            } else {
                die("Forbidden!");
            }
        }
    }
}
