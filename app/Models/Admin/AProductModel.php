<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AProductModel extends Model
{

        /* Select */

    public function getInsertLastID(){
        $db = \Config\Database::connect();
        $result = $db->insertID();
        return $result;
    }

        /* Add */

    public function setProduct($incomingLink, $incomingPrice, $incomingCount, $incomingMenuID)
    {
        $db = \Config\Database::connect();
        date_default_timezone_set('Europe/Istanbul');
        $data = array(
            "MenuID" => $incomingMenuID,
            "link" => $incomingLink,
            "price" => $incomingPrice,
            "count" => $incomingCount,
            "createDate" => time(),
            "updateDate" => time(),
        );
        $result = $db->table("product")->insert($data);
        return $result;
    }
    public function setProductLanguage($lastID, $incomingName, $incomingText, $language){
        $db = \Config\Database::connect();
        $data = array(
            "name" => $incomingName,
            "text" => $incomingText,
            "ProductID" => $lastID
        );
        $result = $db->table("productdetails" . $language)->insert($data);
        return $result;
    }
    

        /* Update */
        
    public function updProductIDForID($id, $menuID){
        $data = array(
            "MenuID" => $menuID
        );
        $db = \Config\Database::connect();
        $result = $db->table("product")->where("id", $id)->update($data);
        return $result;
    }
    public function updProduct($Id, $link, $price, $count, $image, $MenuID){ 
        date_default_timezone_set('Europe/Istanbul');
        $data = array(
            "link" => $link,
            "price" => $price,
            "count" => $count,
            "image" => $image,
            "MenuID" => $MenuID,
            "updateDate" => time(),
        );
        $db = \Config\Database::connect();
        $result = $db->table("product")->where("id", $Id)->update($data);
        return $result;
    }
    public function updProductLanguage($id, $incomingName, $incomingText, $language){
        $db = \Config\Database::connect();
        $data = array(
            "name" => $incomingName,
            "text" => $incomingText,
        );
        $result = $db->table("productdetails" . $language)->where("ProductID", $id)->update($data);
        return $result;
    }
    public function updProductDetails($id, $newId, $language){
        $db = \Config\Database::connect();
        $data = array(
            "ProductID" => $newId,
        );
        $result = $db->table("productdetails" . $language)->where("id", $id)->update($data);
        return $result;
    }
    public function updProductImg($Id, $data)
    {
        $db = \Config\Database::connect();
        $data["updateDate"] = time();
        $result = $db->table("product")->where("id", $Id)->update($data);
        return $result;
    }

        /* Delete */
        
    public function delProductFMenuID($menuId){
        $db = \Config\Database::connect();
        $data = array(
            "MenuID" => $menuId
        );
        $db->table("product")->where($data)->delete();
        $result = $db->affectedRows();
        return $result;
    }
    public function delProduct($id)
    {
        $db = \Config\Database::connect();
        $data = array(
            "id" => $id
        );
        $db->table("product")->where($data)->limit(1)->delete();
        $result = $db->affectedRows();
        return $result;
    }
    public function delProductDetails($id, $language)
    {
        $db = \Config\Database::connect();
        $data = array(
            "ProductID" => $id
        );
        $db->table("productdetails" . $language)->where($data)->limit(1)->delete();
        $result = $db->affectedRows();
        return $result;
    }
}
