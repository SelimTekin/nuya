<?php
namespace App\Models\Admin;

use CodeIgniter\Model;

class ACategoryModel extends Model {
    // Admin Category Model
    
        /* Select */

    public function getInsertLastID(){
        $db = \Config\Database::connect();
        $result = $db->insertID();
        return $result;
    }

        /* Add */

    public function setCategory($link,$AltID,$rumuz){
        $db = \Config\Database::connect();
        $data = array(
            "AltID" => $AltID,
            "link" => $link,
            "rumuz" => $rumuz
        );
        $result = $db->table("menu")->insert($data);
        return $result;
    }
    public function setCategoryLanguage($lastID, $incomingName, $language){
        $db = \Config\Database::connect();
        $data = array(
            "name" => $incomingName,
            "MenuID" => $lastID
        );
        $result = $db->table("menudetails" . $language)->insert($data);
        return $result;
    }
        /* Update */

    public function updCategoryImg($Id, $data){
        $db = \Config\Database::connect();
        $result = $db->table("menu")->where("id", $Id)->update($data);
        return $result;
    }
    public function updCategoryAltID($id, $AltID){
        $data = array(
            "AltID" => $AltID,
        );
        $db = \Config\Database::connect();
        $result = $db->table("menu")->where("id", $id)->update($data);
        return $result;
    }
    
    public function updCategory($Id, $AltID, $link, $image, $rumuz){ 
        $data = array(
            "AltID" => $AltID,
            "image" => $image,
            "link" => $link,
            "rumuz" => $rumuz,
        );
        $db = \Config\Database::connect();
        $result = $db->table("menu")->where("id", $Id)->update($data);
        return $result;
    }
    public function updCategoryLanguage($id, $incomingName, $language){
        $db = \Config\Database::connect();
        $data = array(
            "name" => $incomingName,
        );
        $result = $db->table("menudetails" . $language)->where("MenuID", $id)->update($data);
        return $result;
    }
    public function updCategoryDetails($id, $newId, $language){
        $db = \Config\Database::connect();
        $data = array(
            "MenuID" => $newId,
        );
        $result = $db->table("menudetails" . $language)->where("id", $id)->update($data);
        return $result;
    }
        /* Delete */

    public function delCategory($id){
        $db = \Config\Database::connect();
        $data = array(
            "id" => $id
        );
        $result = $db->table("menu")->where($data)->limit(1)->delete();
        return $result;
    }
    public function delCategoryDetails($id, $language){
        $db = \Config\Database::connect();
        $data = array(
            "MenuID" => $id
        );
        $db->table("menudetails" . $language)->where($data)->limit(1)->delete();
        $result = $db->affectedRows();
        return $result;
    }
}

?>
