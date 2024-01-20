<?php

namespace app\Models;

use CodeIgniter\Model;

class ShoppingCartModel extends Model
{

    protected $table      = 'shoppingcart';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'shoppingCartNumber', 'userId', 'productId', 'addressId', 'variantId', 'cargoId', 'productCount', 'paymentSelection', 'installmentSelection'];

    public function getShoppingCart($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addShoppingCart($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateShoppingCart($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $shoppingCart = $this->find($id);
        if (empty($shoppingCart)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteShoppingCart($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
