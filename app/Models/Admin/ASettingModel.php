<?php
namespace App\Models\Admin;

use CodeIgniter\Model;

class ASettingModel extends Model {
    // Admin Setting Model

        /* Update */

    public function updSetting($data){
        $db = \Config\Database::connect();
        $result = $db->table("setting")->where("id", 1)->update($data);
        return $result;
    }
}

?>