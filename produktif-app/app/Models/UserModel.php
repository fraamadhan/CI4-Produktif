<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_login';
    protected $primaryKey = 'email';
    protected $protectFields = true;
    protected $allowedFields = [
        'email', 'password',
    ];

    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data){
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function deleteAccount($email){
        return $this->delete($email);
    }
}