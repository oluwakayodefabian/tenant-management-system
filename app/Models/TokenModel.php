<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table      = 'user_token';
    protected $primaryKey = 'token_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['token', 'email', 'created_on'];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**
     * VERIFY TOKEN
     *  @param string $token token
     * @return $result row in an object format
     */
    public function verifyToken($token)
    {
        $builder = $this->builder();
        $build = $builder->select('token, email, created_at')->where(['token' => $token]);
        $query = $builder->get();
        $result = $query->getRowObject();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }
}
