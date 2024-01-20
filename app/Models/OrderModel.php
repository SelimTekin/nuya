<?php

namespace app\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{

    protected $table      = 'orders';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'userId', 'orderNumber', 'productId', 'productType', 'productName', 'productPrice', 'kdv', 'productCount', 'totalProductPrice', 'cargoCompanySelection', 'cargoPrice', 'productImageOne', 'variantTitle', 'variantSelection', 'addressNameSurname', 'addressDetail', 'addressTelephone', 'paymentSelection', 'installmentSelection', 'orederDate', 'orderIpAddress', 'approvalStatus', 'cargoStatus', 'cargoShipmentCode'];

    public function getOrder($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addOrder($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateOrder($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $order = $this->find($id);
        if (empty($order)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteOrder($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
