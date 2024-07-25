<?php

namespace app\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{

    protected $table      = 'banners';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'bannerArea', 'bannerName', 'bannerImage', 'viewsCount'];

    public function getBanner($where = []){

        return empty($where) ? false : $this->select()->where($where)->find();

    }

    public function addBanner($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateeBanner($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $banner = $this->find($id);
        if (empty($banner)) {
            return false;
        }

        return $this->update($id, $data);
    }

    public function deleteBanner($data = []){
        return empty($data) || !is_array($data) ? false : $this->delete($data);
    }

}
