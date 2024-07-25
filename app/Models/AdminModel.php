<?php

namespace app\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{

    protected $table      = 'admins';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'username', 'password', 'nameSurname', 'email', 'telephoneNumber', 'cntDeletedAdminStatus'];

    public function getAdmin($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addAdmin($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateAdmin($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $admin = $this->find($id);
        if (empty($admin)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteAdmin($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
