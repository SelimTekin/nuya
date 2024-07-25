<?php

namespace app\Models;

use CodeIgniter\Model;

class ProductVariantsModel extends Model
{

    protected $table      = 'productvariants';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'productId', 'variantName', 'stockQuantity'];

    public function getProductVariant($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addProductVariant($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateProductVariant($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $urunVaryanti = $this->find($id);
        if (empty($urunVaryanti)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteProductVariant($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
