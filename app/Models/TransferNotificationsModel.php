<?php

namespace app\Models;

use CodeIgniter\Model;

class TransferNotificationsModel extends Model
{

    protected $table      = 'transfernotifications';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'bankId', 'nameSurname', 'email', 'telephoneNumber', 'description', 'transactionDate', 'status'];

    public function getTransferNotification($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addTransferNotification($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateTransferNotification($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $transferNotification = $this->find($id);
        if (empty($transferNotification)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteTransferNotification($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
