<?php

namespace app\Models;

use CodeIgniter\Model;

class AdvicesModel extends Model
{

    protected $table      = 'advices';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'productId', 'userId', 'transactionDate', 'purchaseStatus'];

    public function getAdvice($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addAdvice($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateAdvice($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $advice = $this->find($id);
        if (empty($advice)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteAdvice($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
