<?php

namespace app\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{

    protected $table      = 'addresses';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'userId', 'nameSurname', 'address', 'town', 'city', 'telephoneNumber'];

    public function getAddress($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addAddress($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateAddress($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update
        $address = $this->find($id);
        if (empty($address)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteAddress($data = []){
        return empty($data) ? false : $this->delete($data);
    }

}
