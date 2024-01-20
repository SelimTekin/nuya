<?php

namespace app\Models;

use CodeIgniter\Model;

class MenusModel extends Model
{

    protected $table      = 'menus';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'productType', 'menuName', 'productCount'];

    public function getMenu($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addMenu($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateMenu($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $menu = $this->find($id);
        if (empty($menu)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteMenu($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
