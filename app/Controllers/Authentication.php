<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\AccessControl;


use App\Models\{AdminUserModel, ProfileModel};

class Authentication extends BaseController
{
    public array $data;
    public object $model;
    private $access_control;
    const SENDER = 'oluwakayodefabian@gmail.com';

    public function __construct()
    {
        helper(['form', 'text']);
        $this->access_control = new AccessControl();
    }

    public function register()
    {
        $this->access_control->check_if_user_is_logged_in();
        $this->access_control->check_if_user_is_the_main_admin();

        $validation = \Config\Services::validation();
        $data = ["title" => "Register"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validation rules
            $rules = [
                'first_name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required'      => 'First name is required',
                    ]
                ],
                'last_name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required'      => 'Last name is required',
                    ]
                ],
                'admin_username' => [
                    'rules'  => 'required|is_unique[admin_users.admin_username]|alpha_numeric',
                    'errors' => [
                        'required'      => 'All accounts must have usernames provided',
                        'is_unique'     => 'Sorry. That Username has already been taken. Please choose another.',
                        'alpha_numeric' => 'Only alphabets and numbers are allowed'
                    ]
                ],
                'admin_email' => [
                    'rules' => 'required|is_unique[admin_users.admin_email]|valid_email',
                    'errors' => [
                        'required'          => 'Email is required',
                        'is_unique'         => 'Sorry. That Email has already been used. Please choose another.',
                        'valid_email'       => 'Seriously does that email look valid to you'
                    ]
                ],
                'admin_password'    => [
                    'rules'  => 'required|min_length[8]',
                    'errors' => [
                        'required'       => 'Password is required',
                        'min_length'     => 'Your password is too short. You want to get hacked?'
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required'        => 'Role is required',
                    ]
                ]
            ];

            $receiver_email = $this->request->getPost("admin_email", FILTER_SANITIZE_EMAIL);
            $username       = $this->request->getPost("admin_username");
            $password       = $this->request->getPost("admin_password");
            $this->data = [
                'first_name'       => $this->request->getPost('first_name'),
                'last_name'        => $this->request->getPost('last_name'),
                "admin_type"       => $this->request->getPost('role'),
                "admin_username"   => $username,
                "admin_email"      => $receiver_email,
                'unique_id'        => uniqid() . random_string('md5'),
                'created_on'       => date('Y-m-d H:i:s'),
            ];

            if (!$this->validate($rules)) {
                $data["error"] = $validation->listErrors();
            } else {
                // Prepare Message
                $subject = 'Account Login Credentials';
                $sender  = self::SENDER;
                $message = "<p>Hello, {$receiver_email}, Below is the Login credentials to the account. created for you by " . 'This site' . ", It is advisable you change it after you are logged in!</p>";
                $message .= "<p><strong>Username:</strong> $username <br/> <strong>Password:</strong> $password</p>";
                $message .= "<p>Click link below to visit the login page:</p>";
                $message .= '<p><a href=' . base_url() . '/admin/login' . ' style="font-size:1.5rem">Go to Login page</a></p>';

                $this->data['password'] = password_hash($password, PASSWORD_BCRYPT);
                $adminModel = new AdminUserModel();
                if ($adminModel->insert($this->data)) {
                    return redirect()->to(base_url('admin/register'))->with('success', 'Account created successfully');
                } else {
                    $data['error'] = 'An Error occurred, Please register again :)';
                }
            }
        }

        return view("admin/authentication/register", $data);
    }

    public function login()
    {
        $this->access_control->guest_only();
        $data           = ['title' => "Welcome back"];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username       = $this->request->getPost('admin_username');
            $password       = $this->request->getPost('password');

            if (!$this->validate('logged_in_user')) {
                $data['validation'] = $this->validator;
            } else {
                $this->model = new AdminUserModel();
                $user = $this->model->builder()->select()->getWhere(['admin_username' => $username])->getRow();
                if ($user) {
                    $verify_password = password_verify($password, $user->password);
                    if ($user->admin_username && $verify_password) {
                        $users    = new Admin\Users();
                        $profileModel   = new ProfileModel();
                        session()->set('user_id', $user->admin_id);

                        $login_data = [
                            'admin_id'      => session()->get('user_id'),
                            'agent'         => $users->getAgent(),
                            'ip_address'    => $this->request->getIPAddress(),
                            'login_time'    => date('Y-m-d H:i:s'),
                        ];

                        $ProfileInsertId = $profileModel->insert($login_data);
                        ($ProfileInsertId) ? session()->set('logging_activity_id',  $ProfileInsertId) : false;

                        $this->access_control->log_admin_in($user);
                    } else {
                        $data['error'] = "Invalid login details, try again :(";
                    }
                } else {
                    $data['error'] = "Oops, it seems you don't have a registered account with us yet :(";
                }
            }
        }
        return view('admin/authentication/login', $data);
    }

    public function logout()
    {
        $this->access_control->check_if_user_is_logged_in();
        $profileModel = new ProfileModel();
        $profileModel->update(session()->get('logging_activity_id'), ['logout_time' => date('Y-m-d H:i:s')]);
        session()->destroy();
        return redirect()->to(base_url("?msg=You have logged out!"));
    }

    public function forget_password()
    {
        $data = ['title' => 'Forget Password'];
        $validation = \Config\Services::validation();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $this->request->getPost("email");
            $this->data = [
                "email" => $email
            ];
            if ($validation->run($this->data, "validate_forgottenPwd_email") == false) {
                $data["error"] = $validation->listErrors();
            } else {
                $AdminUserModel = new AdminUserModel();
                $token_model    = new \App\Models\TokenModel();
                $user_data      = $AdminUserModel->verifyEmail($email);

                if ($user_data) {
                    // if there's any row existing in the userToken table with a matching email, delete it
                    $token_model->where(['email' => $user_data->email])->delete();
                    // then create a new one
                    $token = random_string('alnum', 15);
                    $token .= random_string('md5', 15);
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'created_at' => time()
                    ];
                    $insertToken = $token_model->insert($user_token);

                    // prepare message to be sent through email
                    $subject = 'RESET PASSWORD';
                    $sender  = self::SENDER;
                    $message = "<p>Hi {$user_data->username} <br /><br /> Your reset password request has been received.</p>";
                    $message .= "<p>Please click link below to reset your password.</p>";
                    $message .= '<p><a href=' . base_url() . '/admin/change_password/' . urlencode($token) . '>Reset password</a></p>';

                    // send mail
                    if ($this->sendEmail($sender, $email, $subject, $message)) {
                        session()->set("userEmail", $email);
                        $data["success"] = "Reset password link has been sent to your registered email, please verify within a day";
                    } elseif (!$this->sendEmail($sender, $email, $subject, $message)) {
                        $data["error"] = 'Failed to send Reset password Link, try again';
                    }
                } else {
                    $data['error'] = 'Email does not exist';
                }
            }
        }

        return view('admin/authentication/forgetPassword', $data);
    }

    public function change_password($token = null)
    {
        $data = ['title' => "Change password"];
        $validation = \Config\Services::validation();

        if (!empty($token)) {
            $tokenModel     = new \App\Models\TokenModel();
            $verify_token   = $tokenModel->verifyToken($token);
            if ($verify_token) {
                // check for time expiration
                if (time() - $verify_token->created_on < (DAY)) {
                    $this->data = [
                        "password" => password_hash($this->request->getPost("password"), PASSWORD_BCRYPT)
                    ];

                    $validation_rules = [
                        'password'    => [
                            'rules'  => 'required|min_length[8]',
                            'errors' => [
                                'required'       => 'Password is required',
                                'min_length'     => 'Your password is too short. You want to get hacked?'
                            ]
                        ],
                        'password_repeat' => [
                            'rules' => 'required|matches[password]',
                            'errors' => [
                                'required'        => 'Password Confirmation is required',
                                'matches'         => "Passwords do not match"
                            ]
                        ]
                    ];

                    if (!$this->validate($validation_rules)) {
                        $data['error'] = $validation->listErrors();
                    } else {
                        $AdminUserModel = new AdminUserModel();

                        $update_password = $AdminUserModel->builder()->update(['password' => $this->data], ['email' => $verify_token->email]);
                        if ($update_password) {
                            unset($_SESSION['userEmail']);
                            $tokenModel->where(['email' => $verify_token->email])->delete();
                            return redirect()->to(base_url())->with('success', "Password changed successfully");
                        }
                    }
                } else {
                    $tokenModel->where(['email' => $verify_token->email])->delete();
                    echo "<h1 style='color:red'>Reset Password link has expired</h1>";
                    echo '<p><a href=' . base_url('admin/login') . '>Back to login page</a></p>';
                    die;
                }
            } else {
                echo "<h1 style='color:red'>User account not found</h1>";
                echo "<a href=" . base_url() . ">Home</a>";
                die;
            }
        } elseif (is_null($token) || empty($token)) {
            return redirect()->to(base_url('forgot_password'))->with('error', 'Unauthorized access');
        }
        return view("admin/authentication/change_password", $data);
    }

    private function sendEmail($sender, $receiver_email, $subject, $message)
    {
        $email = \Config\Services::email();
        $email->setFrom($sender, getenv("SITE_NAME"));
        $email->setTo($receiver_email);
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->setAltMessage(strip_tags($message));

        if ($email->send(false)) {
            return true;
        } else {
            echo "<pre>";
            print_r($email->printDebugger());
            echo "</pre>";
        }
    }
}
