<?php
namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model {
    // Setting Model

        /* Select */

    public function getSettings(){
        $db = \Config\Database::connect();
        $result = $db->table("setting")->where("id","1")->get()->getRow();
        return $result;
    }
}

?>