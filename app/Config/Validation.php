<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    /**
     * ---------------------------------------------------------------------
     * VALIDATION RULES FOR USERS
     * ---------------------------------------------------------------------
     */

    /**
     * _______________________________________________________________________________________
     * Note: validation for $register_users not working properly, 
     * I created a new set of validation rules directly inside Authentication/register method
     * which is giving me expected result.
     * i have decided to stick with the former
     * _______________________________________________________________________________________
     **/
    public $register_users = [
        'username' => [
            'rules'  => 'required|is_unique[users.username]|alpha_numeric',
            'errors' => [
                'required' => 'Username is required',
                'is_unique' => 'Sorry. That Username has already been taken. Please choose another.',
                'alpha_numeric' => 'Only alphabets and numbers are allowed'
            ]
        ],
        'email' => [
            'rules' => 'required|is_unique[users.email]|valid_email',
            'errors' => [
                'required'         => 'Email is required',
                'is_unique'     => 'Sorry. That Email has already been taken. Please choose another.',
                'valid_email'     => 'Seriously does that email look valid to you'
            ]
        ],
        'profile_img' => [
            'rules'  => 'uploaded[profile_img]|max_size[profile_img, 1024]|is_image[profile_img]|mime_in[profile_img, image/png, image/jpg,image/jpeg]|ext_in[profile_img,png,jpg,gif]',
            'errors' => [
                'uploaded'                => 'No file uploaded',
                'max_size[file, 1024]'     => 'Oops, you can\'t upload a file that is more than 1mb',
                'is_image[file]'         => 'Only Images can be uploaded'
            ]
        ],
        'password'    => [
            'rules'  => 'required|min_length[8]',
            'errors' => [
                'min_length'     => 'Your password is too short. You want to get hacked?'
            ]
        ],
        'password_repeat' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required'         => 'Password Confirmation is required',
                'matches'         => "Passwords do not match"
            ]
        ]
    ];

    public $logged_in_user = [
        'admin_username' => [
            "rules" => "required",
            'errors' => [
                'required' => "Your username is required"
            ]
        ],
        'password' => [
            'rules' => "required",
            'errors' => [
                'required' => 'Your password is required'
            ]
        ]
    ];
    public $profile_data = [
        'username' => [
            "rules" => "required|alpha_numeric",
            'errors' => [
                'required' => "Your username is required"
            ]
        ],
        'email' => [
            'rules' => "required|valid_email",
            'errors' => [
                'required' => 'Your Email is required',
                'valid_email' => 'Your email is invalid'
            ]
        ]
    ];
    public $validate_forgottenPwd_email = [
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required'         => 'Email is required',
                'valid_email'     => 'Seriously does that email look valid to you'
            ]
        ],
    ];
    public $validate_change_password = [
        'password'    => [
            'rules'  => 'required|min_length[8]',
            'errors' => [
                'min_length'     => 'Your password is too short. You want to get hacked?'
            ]
        ],
        'password_repeat' => [
            'rules' => 'matches[password]',
            'errors' => [
                'matches'         => "Passwords do not match"
            ]
        ]
    ];

    /**
     * -----------------------___________-----------------------------------
     *  VALIDATION RULES FOR Tenants CLASS
     * ----------------------_____________-----------------------------------
     */
    public array $add_tenant = [
        'first_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Member\'s first name is required',
            ]
        ],
        'last_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Member\'s last name is required',
            ]
        ],
        'gender' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'You forgot to pick the tenant\'s gender',
            ]
        ],
        'email_address' => [
            'rules'  => 'required|is_unique[tenants.email]|valid_email',
            'errors' => [
                'required' => 'Tenant\'s email address is required',
            ]
        ],
        'state' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tenant\'s state of origin is required',
            ]
        ],
        'lga' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tenant\'s local govt. area is required',
            ]
        ],
        'phone_number' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => 'Tenant\'s phone_number is required',
            ]
        ],
        'property_id' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'You need to assign a property to the tenant',
            ]
        ],
    ];
    public array $edit_tenant = [
        'first_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Member\'s first name is required',
            ]
        ],
        'last_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Member\'s last name is required',
            ]
        ],
        'gender' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'You forgot to pick the tenant\'s gender',
            ]
        ],
        'email_address' => [
            'rules'  => 'required|is_unique[tenants.email]|valid_email',
            'errors' => [
                'required' => 'Tenant\'s email address is required',
            ]
        ],
        'state' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tenant\'s state of origin is required',
            ]
        ],
        'lga' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tenant\'s local govt. area is required',
            ]
        ],
        'phone_number' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => 'Tenant\'s phone_number is required',
            ]
        ],
        'property_id' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'You need to assign a property to the tenant',
            ]
        ],
    ];
    /**
     * -----------------------___________-----------------------------------
     *  VALIDATION RULES FOR PROPERTY CLASS
     * ----------------------_____________-----------------------------------
     */
    public array $validate_add_property = [
        'first_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Member\'s first name is required',
            ]
        ],
        'last_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Member\'s last name is required',
            ]
        ],
        'gender' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'You forgot to pick the tenant\'s gender',
            ]
        ],
        'email_address' => [
            'rules'  => 'required|is_unique[tenants.email]|valid_email',
            'errors' => [
                'required' => 'Tenant\'s email address is required',
            ]
        ],
        'state' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tenant\'s state of origin is required',
            ]
        ],
        'lga' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tenant\'s local govt. area is required',
            ]
        ],
        'phone_number' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => 'Tenant\'s phone_number is required',
            ]
        ],
        'property_id' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'You need to assign a property to the tenant',
            ]
        ],
    ];
    public array $validate_edit_property = [
        'first_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Member\'s first name is required',
            ]
        ],
        'last_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Member\'s last name is required',
            ]
        ],
        'gender' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'You forgot to pick the tenant\'s gender',
            ]
        ],
        'email_address' => [
            'rules'  => 'required|is_unique[tenants.email]|valid_email',
            'errors' => [
                'required' => 'Tenant\'s email address is required',
            ]
        ],
        'state' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tenant\'s state of origin is required',
            ]
        ],
        'lga' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tenant\'s local govt. area is required',
            ]
        ],
        'phone_number' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => 'Tenant\'s phone_number is required',
            ]
        ],
        'property_id' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'You need to assign a property to the tenant',
            ]
        ],
    ];
}
