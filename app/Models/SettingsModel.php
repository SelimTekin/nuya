<?php

namespace app\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{

    protected $table      = 'settings';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'siteName', 'siteTitle', 'siteDescription', 'siteKeywords', 'siteCopyrightText', 'siteLogo', 'siteLink', 'siteEmail', 'sitePassword', 'siteHostAddress', 'facebook', 'twitter', 'linkedin', 'instagram', 'pinterest', 'youtube', 'dollarExchangeRate', 'euroExchangeRate', 'freeCargoPrice', 'clientId', 'storeKey', 'apiUser', 'apiPassword'];

    public function getSettings(){

        return $this->find();

    }

    public function addSettings($data = []){

        if(empty($data)){
            return false;
        }
        
        $insert = $this->insert($data);

        if($insert){
            return true;
        }

        return false;

    }

    public function updateSettings($id = false, $data = []){

        if (empty($data) || $id === false) {
            return false;
        }

        // return error if couldn't find data for update  
        $settings = $this->find($id);
        if (empty($settings)) {
            return false;
        }

        return $this->update($id, $data);
    }

    // TRUNCATE TABLE (already 1 row exits)
    public function deleteSettings(){
        return $this->truncate();
    }

}
