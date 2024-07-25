<?php
namespace App\Models\Admin;

use CodeIgniter\Model;

class AOwnerModel extends Model {
    // Admin Owner Model

        /* Select */
  
    public function getInsertLastID(){
        $db = \Config\Database::connect();
        $result = $db->insertID();
        return $result;
    }
    public function getOwners(){
        $db = \Config\Database::connect();
        $result = $db->table("owner")->get()->getResult();
        return $result;
    }
    public function getOwner($id){
        $db = \Config\Database::connect();
        $data = array(
            "id" => $id
        );
        $result = $db->table("owner")->where($data)->get()->getRow();
        return $result;
    }
    public function getOwnerFU($userName){ // get Owner for User Name
        $db = \Config\Database::connect();
        $data = array(
            "userName" => $userName
        );
        $result = $db->table("owner")->where($data)->get()->getRow();
        return $result;
    }
    public function getOwnerRanks(){
        $db = \Config\Database::connect();
        $result = $db->table("rank")->get()->getResult();
        return $result;
    }

        /* Add */

    public function setOwner($userName, $password, $name, $email, $rank){
        $db = \Config\Database::connect();
        $data = array(
            "userName" => $userName,
            "password" => $password,
            "name" => $name,
            "email" => $email,
            "rankID"  => $rank,
            "securityStatus" => 0
        );
        $result = $db->table("owner")->insert($data);
        return $result;
    }
        /* Update */

    public function updOwner($Id, $data){
        $db = \Config\Database::connect();
        $result = $db->table("owner")->where("id", $Id)->update($data);
        return $result;
    }

        /* Delete */

    public function delOwner($id){ 
        $db = \Config\Database::connect();
        $data = array(
            "id" => $id
        );
        $result = $db->table("owner")->where($data)->delete();
        return $result;
    }
}

?>