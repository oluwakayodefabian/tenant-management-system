<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table      = 'admin_users';
    protected $primaryKey = 'admin_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['first_name', 'last_name', 'admin_email', 'admin_username', 'admin_type', 'password', 'unique_id', 'created_on'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_on';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function verifyEmail($email)
    {
        $builder = $this->builder();
        $query = $builder->select('*')->where(['admin_email' => $email])->get();
        $result = $query->getRowObject();
        if ($result) return $result;
        return 0;
    }
}
