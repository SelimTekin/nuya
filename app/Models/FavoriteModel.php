<?php

namespace app\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{

    protected $table      = 'favorites';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'productId', 'userId'];

    public function getFavorite($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addFavorite($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateFavorite($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $favorite = $this->find($id);
        if (empty($favorite)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteFavorite($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
