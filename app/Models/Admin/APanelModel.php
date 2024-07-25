<?php
namespace App\Models\Admin;

use CodeIgniter\Model;

class APanelModel extends Model {
    // Admin Panel Model

        /* Check */

    public function sumMenu(){
        $db = \Config\Database::connect();
        $result = $db->table("menu")->countAllResults();
        return $result;
    }
    public function sumCategory(){
        $db = \Config\Database::connect();
        $result = $db->table("menu")->countAllResults();
        return $result;
    }
    public function sumProduct(){
        $db = \Config\Database::connect();
        $result = $db->table("product")->countAllResults();
        return $result;
    }
    public function sumOwner(){
        $db = \Config\Database::connect();
        $result = $db->table("owner")->countAllResults();
        return $result;
    }
    public function sumLanguage(){
        $db = \Config\Database::connect();
        $result = $db->table("language")->where("active","1")->countAllResults();
        return $result;
    }
    public function sumLog(){
        $db = \Config\Database::connect();
        $result = $db->table("log")->countAllResults();
        return $result;
    }
}

?>