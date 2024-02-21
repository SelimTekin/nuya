<?php

namespace app\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'email', 'password', 'name', 'surname', 'telephoneNumber', 'gender', 'status', 'registrationDate', 'registrationIpAddress', 'activationCode', 'deletionStatus'];

    public function getUser($where = []){

        return $this->select()->where($where)->first();

    }

    public function addUser($data = []){

        return $this->insert($data);

    }

    public function updateUser($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $user = $this->find($id);
        if (empty($user)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteUser($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
