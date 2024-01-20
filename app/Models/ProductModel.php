<?php

namespace app\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'menuId', 'productType', 'productName', 'productPrice', 'currency', 'kdv', 'productDescription', 'productImageOne', 'productImageTwo', 'productImageThree', 'productImageFour', 'variantTitle', 'cargoPrice', 'status', 'totalSalesCount', 'totalSalesAmount', 'commentCount', 'totalCommentScore', 'viewsCount'];

    public function getProduct($where = []){

        return empty($where) ? $this->getRandomProduct() : $this->select()->where($where)->find();

    }

    // get random 4 product
    public function getRandomProduct(){

        return $this->orderBy('RAND()')->limit()->findAll(4, 0);

    }

    public function addProduct($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateProduct($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // Eğer return error if couldn't find data for update
        $product = $this->find($id);
        if (empty($product)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteProduct($data = []){

        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
