<?php

namespace app\Models;

use CodeIgniter\Model;

class CargoCompaniesModel extends Model
{

    protected $table      = 'cargocompanies';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'cargoCompanyLogo', 'cargoCompanyName'];

    public function getCargoCompany($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addCargoCompany($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateCargoCompany($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $cargoCompany = $this->find($id);
        if (empty($cargoCompany)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteCargoCompany($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
