<?php

namespace app\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'email', 'password', 'nameSurname', 'telephoneNumber', 'gender', 'status', 'registrationDate', 'registrationIpAddress', 'activationCode', 'deletionStatus'];

    public function getUser($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addUser($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

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
